function Weather(weatherBlock) {
    if(!weatherBlock) return;
    
    this.outerForWeather = weatherBlock;
    var xhr = new XMLHttpRequest();

    var self = this;

    xhr.open('GET', 'https://query.yahooapis.com/v1/public/yql?q=select%20item%20from%20weather.forecast%20where%20woeid%3D918233%20and%20u%3D%22c%22&format=json&l=ru', true);

    xhr.onreadystatechange = function() {
        if(xhr.status == 200 && xhr.readyState == 4) {

            var xhrObj = JSON.parse(xhr.responseText);

            self.getProp(xhrObj, 'item', self.constructorNodes, self);

        };
    };

    xhr.send();

    this.getProp = function(obj, propObj, callback, self) {
        for(var key in obj) {
            if(key == propObj) {
                callback(obj[key], self);
            } else if( typeof obj[key] == 'object') {
                self.getProp(obj[key], propObj, callback, self);
            };
        };
    }
};

Weather.prototype.constructorNodes = function(val, self) {
    var html = '<div class="drop-weather-button">' +
                  '<div class="outer-today-ico">' +
                      '<span class="icons-for-c-min icon-weather-min-' + val.condition.code + '"></span>' +
                      '<i class="today-weather">' + val.condition.temp + ' С°</i>' +
                  '</div>' +
                  '<div class="drop-wether">' +
                      '<p class="for-genwether"><span class="title-weather">Погода</span><span class="city-weather">Украина,  Чернигов</span></p>' +
                      '<div class="section-today">' +
                    '<div class="for-weather-icon">' +
                      '<h5 class="section-heading">Сьогодні</h5>' +
                      '<span class="icons-for-c icon-weather-' + val.condition.code + '"></span>' +
                    '</div>' +
                  '<div class="weather-detail">' +
                      '<h4 class="weather-heading">' +
                          '<span class="temp-now">' + val.condition.temp + ' С° </span>' +
                          '<span class="phrase">Температура зараз</span>' +
                      '</h4>' +
                      // '<span class="temperature high-temperature">' + this.forecast_today_HighTemp + ' С° - </span>' +
                      // '<span class="temperature low-temperature">' + this.forecast_today_LowTemp + ' С°</span>' +
//                      '<p class="summary">' + val.condition.text + '</p>' +
                  '</div>' +
                      '</div>' +
                      '<div class="section-this-week">' +
                          '<h5 class="section-heading">Тиждень</h5>' +
                          '<ul class="item-list-temperature">' +
                                self.getForecast(val.forecast, self);
                          '</ul>' +
                      '</div>' +
                  '</div>' +
              '</div>';

    self.outerForWeather.insertAdjacentHTML('afterBegin', html);
};

Weather.prototype.getForecast = function(val, self) {

    var getDay = function(day) {
        var days = {
            Mon: 'Понедiлок',
            Tue: 'Вiвторок',
            Wed: 'Середа',
            Thu: 'Четвер',
            Fri: 'П`ятниця',
            Sat: 'Субота',
            Sun: 'Недiля'
        };

    return days[day];
    };

    var htmlList = '';

    for(var i =1; i < 5; i++) {
        htmlList += '<li class="item-time-temperature">' +
                        '<span class="icons-for-c icon-weather-' + val[i].code + '"></span>' +
                        '<span class="day">' + getDay(val[i].day) + ' ' + '</span>' +
                        '<span class="temperature-days high-temperature">' + val[i].high + ' С° </span>' +
                        '<span class="temperature-days low-temperature">' + val[i].low + ' С° </span>' +
                    '</li>';
    };

    return htmlList;

};

Weather.prototype.weatherDescription = function(val) {
    var description = {
        0: 'Торнадо',
        1: 'Тропічний шторм',
        2: 'Ураган',
        3: 'Сильні грози',
        4: 'Грози',
        5: 'Змішаний дощ зi снігом',
        6: 'Змішаний дощ зi снігом',
        7: 'Змішаний дощ зi снігом',
        8: 'Паморозь',
        9: 'Мряка',
        10: 'Град',
        11: 'Зливи',
        12: 'Зливи',
        13: 'Сніговi пориви',
        14: 'Легкий сніг',
        15: 'Хуртовина',
        16: 'Снiг',
        17: 'Град',
        18: 'Дощ зі снігом',
        19: 'Туманно',
        20: 'Туманно',
        21: 'Туманно',
        22: 'Туманно',
        23: 'Вітрянно',
        24: 'Вітрянно',
        25: 'Прохолодно',
        26: 'Хмарно',
        27: 'Переважно хмарно',
        28: 'Переважно хмарно',
        29: 'Мінлива хмарність',
        30: 'Мінлива хмарність',
        31: 'Ясно',
        32: 'Сонячно',
        33: 'Ясно',
        34: 'Ясно',
        35: 'Змішаний дощ з градом',
        36: 'Спекотно',
        37: 'Грози',
        38: 'Розсіяні грози',
        39: 'Розсіяні грози',
        40: 'Мінлива хмарність',
        41: 'Сильний снігопад',
        42: 'Снігопад',
        43: 'Сильний снігопад',
        44: 'Мінлива хмарність',
        45: 'Зливи',
        46: 'Зливовий сніг',
        47: 'Зливи'
    };

    return description[val];
}; 