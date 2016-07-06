function Category(categContainer) {
    if(!categContainer) return;
    
	var self = this;
    this.id = 1;
    this.status = true;
    this.fullWidthCategory = categContainer;

    window.addEventListener('scroll', this.ajaxRequest.bind(this));
};

Category.prototype.ajaxRequest = function() {
    var self = this,
        scrolled = window.pageYOffset,
        documentHieght = document.documentElement.offsetHeight,
        delta = documentHieght - scrolled; 
    console.log(delta);
        

    if(this.status == true && delta < 1500 && this.id < 9) {
        var categXhr = new XMLHttpRequest();

        this.status = false;
        categXhr.open('GET', '/site/GetCategory?id='+ this.id, true);

        categXhr.onreadystatechange = function() {
            if(categXhr.status == 200 && categXhr.readyState == 4) {
                var fullXhrObj = JSON.parse(categXhr.responseText),
                    categorys = JSON.parse(fullXhrObj.category),
                    newsObj = JSON.parse(fullXhrObj.news);

                self.categBlockTemplate(newsObj, fullXhrObj.language, categorys); 

                self.status = true;
                self.id++; 
            };
        };

        categXhr.send();
    };
};

// Category.prototype.startingAjax = function() {
    
// };
// Category.prototype.checkOffset = function () { 
// var scrolled = window.pageYOffset, 
// total = document.documentElement.offsetHeight, 
// delta = total - scrolled; 

// if( delta < 1500 && this.id < 9 && this.status == true) { 
// this.id += 1; 
// if ( this.id == 7) return; 
// this.getAjax(); 
// } 
// };
Category.prototype.categBlockTemplate = function(obj, lang, category) {
    var self = this,
        articles = '';
    for(var i = 1; i < 3; i++) {
        articles += '<a href="/site/news/' + obj[i].id + '"class="val-news-item-category val-category-image">' +
                        '<div class="val-line-vews-data">' +
                            '<span class="val-content-news-data">' + obj[i].date +'</span>' +
                            '<span class="val-news-view">' + obj[i].views + '</span>' +
                        '</div>' +
                        '<h2 class="val-title-news-category">' + obj[i]['title_' + lang] + '</h2>' +
                        '<p class="val-description-news-category">' + self.slicingText(obj[i]['description_' + lang]) + '</p>' +
                    '</a>';
    };
   
    var categoryBlock = '<div class="val-category-block">' + 
						'<h2 class="val-title-uppercase-with-line">'+ category[0]['name_' + lang] + '</h2>' + 
							'<div class="val-news-list-category">' + 
                                '<a href="/site/news/' + obj[0].id + '"class="val-news-item-category val-category-image">' +
                                    '<div class="val-item-outer-category-image">' +
                                        '<img src="' + '/uploads/news/thumb/' + obj[0].image + '"' + 'alt="' + obj[0]['title_' + lang] +'">' +
                                    '</div>' +
                                    '<div class="val-line-vews-data">' +
                                        '<span class="val-content-news-data">' + obj[0].date + '</span>' +
                                        '<span class="val-news-view">' + obj[0].views + '</span>' +
                                    '</div>' +
                                    '<h2 class="val-title-news-category">' + obj[0]['title_' + lang] + '</h2>' +
                                '</a>' +
                                articles + 
                            '</div>' +
						'</div>';

	this.fullWidthCategory.insertAdjacentHTML('beforeEnd', categoryBlock);
};

Category.prototype.slicingText = function(text) {
    var str = text;
    if (str.length > 250) {
        return str.slice(0, 250) + '...';
    };
    return str;
};