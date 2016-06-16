function CategorySingle(){
    var self = this;
    this.counter = 0;
    this.sourceId = document.getElementById('val-count-and-id'),
    this.count = this.sourceId.getAttribute('data-count');
    this.flag = 0;
    this.step = this.count;
    
    
    this.status = true;
    this.handlerLoad();
    this.handlerScrollSingle();
};

CategorySingle.prototype.ajax = function(){    
    var self = this;
    var id = self.sourceId.getAttribute('data-id');
        
    // var scrollCurrent = window.pageYOffset + document.documentElement.clientHeight,
    //     offsetNewsBlock = window.pageYOffset + document.querySelector('.val-full-width-category').getBoundingClientRect().top;
    if(self.status == true){
        var xhr = new XMLHttpRequest();
        // self.status = false;
        xhr.open('GET', '/site/GetCategoryByIdXhrOrNotId?id=' + id + '&offset=' + self.count, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var xhrObject = JSON.parse(xhr.responseText),
                    news = JSON.parse(xhrObject.news);
                // console.log(self.counter);
                // if(self.counter > self.count){
                	// self.loadNewsSingle(news, news.length, xhrObject.language);
                // } else {
                	// console.log(news);
                	self.flag++;
                	self.to = self.flag * self.step;
    				self.from = self.to - self.step;
                	self.loadNewsSingle(news, self.count, xhrObject.language);
                // };                
                
            };
        };
        xhr.send();
    };
};

CategorySingle.prototype.handlerLoad = function(){
    window.addEventListener('load', this.ajax.bind(this));
};

CategorySingle.prototype.handlerScrollSingle = function(){
    window.addEventListener('scroll', this.ajax.bind(this));
};

CategorySingle.prototype.loadNewsSingle = function(news, count, lang){
    var self = this;
    var newsSingle = '';
    // console.log(parseInt(this.counter) + parseInt(count));
    for(var i = this.from; i < this.to; i++){
        newsSingle += '<a href="/site/news/' + news[i].id + '" class="val-block-gen-news">' +
                            '<div class="val-image-block-gen-news">' +
                                '<img src="/uploads/news/thumb/' + news[i].image + '">' +
                            '</div>' +
                            '<div class="val-description-block-gen-news">' +
                                '<span class="val-news-view">' + news[i].views + '</span>' +
                                '<span class="val-content-news-data">' + this.compareDate(news[i].date, lang) + '</span>' +
                                '<h3 class="val-content-news-title-small">' + news[i]['title_' + lang] + '</h3>' +
                            '</div>' +
                        '</a>';
        this.counter++;
        console.log(this.from + ' from');
        console.log(this.to + ' to');
        // console.log(typeof this.counter);
    };
        // console.log(news);
    var newsSingleBlock = document.getElementById('val-single-category');
    newsSingleBlock.insertAdjacentHTML('beforeEnd', newsSingle);

    // console.log(this.compareDate(news[i].date));
    self.status = true;
    self.from += count;
    self.flag++;
    // self.id++;
};

CategorySingle.prototype.today = function(){
    var date = new Date(),
        current = new Date(date.getFullYear(), date.getMonth(), date.getDate()).valueOf();
    return current;
};

CategorySingle.prototype.getMounth = function(mounth, lang){            
    var mounthObject = {
        ru: {
            0: 'Января',
            1: 'Февраля',
            2: 'Марта',
            3: 'Апреля',
            4: 'Мая',
            5: 'Июня',
            6: 'Июля',
            7: 'Августа',
            8: 'Сентября',
            9: 'Октября',
            10: 'Ноября',
            11: 'Декабря'
        },
        uk: {
            0: "Січня",
            1: "Лютого",
            2: "Березня",
            3: "Квітня",
            4: "Травня",
            5: "Червня",
            6: "Липня",
            7: "Серпня",
            8: "Вересня",
            9: "Жовтня",
            10: "Листопада",
            11: "Грудня"
        }
    };            
    return mounthObject[lang][mounth];
};

CategorySingle.prototype.compareDate = function(date, lang){
	var self = this;
    var onlyDate = date.split(' ')[0],
        onlyTime = date.split(' ')[1],
        curDate = new Date(onlyDate),
        currentDate = new Date(curDate.getFullYear(), curDate.getMonth(), curDate.getDate()).valueOf(),
        now = self.today();
    if(now > currentDate){
        return curDate.getDate() + ' ' + self.getMounth(curDate.getMonth(), lang) + ' ' + curDate.getFullYear();
    } else {
        return onlyTime;
    }
};

window.addEventListener('DOMContentLoaded', function(){
    var newCategorySingle = new CategorySingle();
});