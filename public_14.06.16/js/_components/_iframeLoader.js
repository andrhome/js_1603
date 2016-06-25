function CreateIframe(elem) {

	if(!elem) return;

	var dataFrame = elem.getAttribute('data-src'),
		arr = dataFrame.split(','),
		readyIframe = '';

	// Цыклом заполняем src у iframe и записываем готовые iframes в виде строки в readyIframe
	for(var i = 0; i < arr.length; i++) {
		readyIframe += this.template(arr[i]);
	}

	elem.insertAdjacentHTML('afterBegin', readyIframe); // Вставляем готовые iframes в блок див source
};

// Метод для создания iframes
CreateIframe.prototype.template = function(src) {
	var block = '<div class="val-iframe-streams">' +
					'<span class="val-ico-online">' +
						'<i></i>' +
					'</span>' + 
					'<iframe src="'+ src + '"></iframe>' +
				'</div>';
	return block;
};