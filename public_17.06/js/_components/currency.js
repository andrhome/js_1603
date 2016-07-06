function Currency() {

	var self = this;

	var currencyXhr = new XMLHttpRequest();
	currencyXhr.open('GET', 'http://' + location.hostname + '/site/tryCurrency', true);
	currencyXhr.onreadystatechange = function() {

		if(currencyXhr.status == 200 && currencyXhr.readyState == 4) {
			var currXhrObj = JSON.parse(currencyXhr.responseText);

			self.getBankInfo(currXhrObj);
		};
	};

	currencyXhr.send();
};

Currency.prototype.getBankInfo = function(xhrObject) {
    var bankObj = [],
        currentBank = '',
        arrBanks = ["ПриватБанк", "ПУМБ", "Укрсоцбанк"];

    for (var i = 0; i < xhrObject.length; i++) {
        if(currentBank != xhrObject[i].bankName) {
            if(obj && Object.keys(obj).length > 0) {
                bankObj.push(obj); 
            };
            var obj = {};

            if(arrBanks.indexOf(xhrObject[i].bankName) == -1) continue;

            obj.bankName = xhrObject[i].bankName;
            obj[xhrObject[i].codeAlpha] = {
                rateBuy: xhrObject[i].rateBuy,
                rateBuyDelta: xhrObject[i].rateBuyDelta,
                rateSale: xhrObject[i].rateSale,
                rateSaleDelta: xhrObject[i].rateSaleDelta
            };              
        } else {
            obj[xhrObject[i].codeAlpha] = {
                rateBuy: xhrObject[i].rateBuy,
                rateBuyDelta: xhrObject[i].rateBuyDelta,
                rateSale: xhrObject[i].rateSale,
                rateSaleDelta: xhrObject[i].rateSaleDelta
            };
        };
        currentBank = xhrObject[i].bankName; 
    };

   this.currencyTemplate(bankObj);
};

Currency.prototype.genereteBuySaleHtml = function(obj, rate, rateDelta) {
    var eurDelta = function () {
        if (obj.EUR[rateDelta] > 0) {
            return '<i class="-to-hight"> &nbsp; &#9650;</i>'
        } else if (obj.EUR[rateDelta] < 0) {
            return '<i class="-to-low"> &nbsp; &#9660;</i>'
        } else {return ''};
    };
    var usdDelta = function () {
        if (obj.USD[rateDelta] > 0) {
            return '<i class="-to-hight"> &nbsp; &#9650;</i>'
        } else if (obj.USD[rateDelta] < 0) {
            return '<i class="-to-low"> &nbsp; &#9660;</i>'
        } else {return ''};
    };
    var rubDelta = function () {
        if (obj.RUB[rateDelta] > 0) {
            return '<i class="-to-hight"> &nbsp; &#9650;</i>'
        } else if (obj.RUB[rateDelta] < 0) {
            return '<i class="-to-low"> &nbsp; &#9660;</i>'
        } else {return ''};
    };
    var buySaleHtml = '<span>' + 
                            '<mark>' + obj.EUR[rate] + 
                            '</mark>' + (eurDelta()) +
                        '</span>'  +
                        '<span>' + 
                            '<mark>' + obj.USD[rate] + 
                            '</mark>' + (usdDelta()) +
                        '</span>'  +
                        '<span>' + 
                            '<mark>' + obj.RUB[rate] + 
                            '</mark>' + (rubDelta()) +
                        '</span>';
    return buySaleHtml;
};

Currency.prototype.currencyTemplate = function(bankObject) {
    var bank = '';
    for (var i = 0; i < bankObject.length; i++) {
        bank += '<tr>' +
                    '<td>' +
                        '<p><i>' + bankObject[i].bankName + '</i></p>' +
                    '</td>' +
                    '<td>' +
                        '<span>' +
                            '<b>&euro;</b>' +
                        '</span>' +
                        '<span>' +
                            '<b>$</b>' +
                        '</span>' +
                        '<span>' +
                            '<b>R</b>' +
                        '</span>' +
                    '</td>' +
                    '<td>' + 
                        this.genereteBuySaleHtml(bankObject[i], 'rateBuy', 'rateBuyDelta') +
                    '</td>' +
                    '<td>' +
                        this.genereteBuySaleHtml(bankObject[i], 'rateSale', 'rateSaleDelta') +
                    '</td>' +
                '</tr>';
    };

    var valCurrencyText = document.querySelector('.val-currency-text'),
        tableHaed = '<table class="-new-currensy">' +
                '<tr>' +
                    '<th>' +
                        '<span>Банк</span>' +
                    '</th>' +
                    '<th>' +
                        '<span style="font-size: 18px">&#402;</span>' +
                    '</th>' +
                    '<th>' +
                        '<span>Покупка</span>' +
                    '</th>' +
                    '<th>' +
                        '<span>Продажа</span>' +
                    '</th>' +
                '</tr>' +
                bank +
            '</table>';

    valCurrencyText.insertAdjacentHTML('afterBegin', tableHaed);
};
