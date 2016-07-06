function PopUp() {
	var valRightButton = document.querySelector('.val-outer-right-button'),
		valRedaction = document.querySelector('.val-redaction'),
		closeModals = document.querySelectorAll('.val-close-modals'),
		rememberPassBtn = document.querySelectorAll('.-val-remember-pass');
	this.valModalOuter = document.querySelector('.val-modal-login-reg-outer');

	valRightButton.addEventListener('click', this.showModal.bind(this));
	valRedaction.addEventListener('click', this.showModal.bind(this));
	for (var i = 0; i < closeModals.length; i++) {
		closeModals[i].addEventListener('click', this.hideModals.bind(this));
	};
	// this.valModalOuter.addEventListener('click', this.hideModals.bind(this));
	for (var i = 0; i < rememberPassBtn.length; i++) {
		rememberPassBtn[i].addEventListener('click', this.changingLoginForm.bind(this));
	};
};

PopUp.prototype.showModal = function() {
	var target = event.target,
		attr = target.getAttribute('data-attr'),
		modal = document.querySelector('.' + attr),
		rememberPassForm = document.getElementById('remember'),
		loginForm = document.getElementById('login');

	modal.style.cssText = 'display: block; opacity: 1';
	this.valModalOuter.style.cssText = 'display: block; opacity: 1';
};

PopUp.prototype.hideModals = function() {
	var target = event.target;
	if(target.classList.contains('val-close-modals')) {		
		target.parentElement.style.cssText = 'opacity: 0; display: none;';
	};
	this.valModalOuter.style.cssText = 'opacity: 0; display: none;';
}; 

PopUp.prototype.changingLoginForm = function() {	
	var rememberPassForm = document.getElementById('remember'),
		loginForm = document.getElementById('login');

	if(getComputedStyle(rememberPassForm).display == 'none') {
		loginForm.style.cssText = 'display: none;';
		rememberPassForm.style.cssText = 'display: block;';
	} else{
		rememberPassForm.style.cssText = 'display: none;';
		loginForm.style.cssText = 'display: block;';
	};
};