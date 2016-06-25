function Category() {
	var categXhr = new XMLHttpRequest();
	this.id = 1;
	categXhr.open('GET', '/site/GetCategory?id='+ this.id, true);

	categXhr.onreadystatechange = function() {
		if(categXhr.status == 200 && categXhr.readyState == 4) {
			var fullXhrObj = JSON.parse(categXhr.responseText),
				categorysObj = JSON.parse(fullXhrObj.category),
				newsObj = JSON.parse(fullXhrObj.news);
			console.log(fullXhrObj);
			console.log(categorysObj);
			console.log(newsObj);
		};
	};

	categXhr.send();
};

Category.prototype.categBlockTemplate = function() {
	var fullWidthCategory = document.querySelector('.val-full-width-category'),
		categoryBlock = '<div class="val-category-block">' + 
						'<h2 class="val-title-uppercase-with-line">(Название категории в зависимости от языка)</h2>' + 
							'<div class="val-news-list-category">' + 								
								'(Шаблон для вставки либо с изображениями либо без)' + 
							'</div>' +
						'</div>';
};
