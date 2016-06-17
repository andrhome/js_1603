function Slider(slider) {
	if(!slider) return;

	var self = this;

	self.slider = document.querySelector('.val-list-slider');
	self.liSlides = self.slider.querySelectorAll('li');
	self.pagination = document.querySelector('.val-display-controls');
	self.count = self.liSlides.length;
	self.liWidth = parseInt(window.getComputedStyle(self.slider.firstElementChild).getPropertyValue('width'));
	var paginationsStr = '';

	for (var i = 0; i < self.liSlides.length; i++) {
		paginationsStr += '<span></span>'
	};

	this.cssGenerator('width', self.count * self.liWidth, self.slider);

	self.pagination.insertAdjacentHTML('afterBegin', paginationsStr);	

	this.setAttributes();
	
	self.pagin = self.pagination.children;
	self.pagin[0].classList.add('active');	
	self.paginActive = self.pagination.querySelector('.active');
	self.paginActiveAttr = self.paginActive.getAttribute('data-controls');
	self.moveSlide = function() {
		var target = event.target,
			dataControls = target.getAttribute('data-controls');
		self.paginActive.classList.remove('active');
		target.classList.add('active');
		self.paginActive = self.pagination.querySelector('.active');

		var propX = 0;

		if(dataControls > self.paginActiveAttr) {
			propX = -self.liWidth * dataControls;
		} 
		else if (dataControls < self.paginActiveAttr) {
			propX = self.liWidth * dataControls;
		}		
		self.slider.style.transform = 'translateX(' + propX + 'px)';
        console.log(self.slider.style.transform);
	};

	self.pagination.addEventListener('click', self.moveSlide);
}

Slider.prototype.cssGenerator = function(prop, val, el) {
	el.style.cssText = prop + ':' + (val) + 'px';
};

Slider.prototype.setAttributes = function() {
	var spans = this.pagination.querySelectorAll('span');
	for (var i = 0; i < spans.length; i++) {
		spans[i].setAttribute('data-controls', i);
	};
};