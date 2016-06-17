window.addEventListener('DOMContentLoaded', function()  {
	new Slider( document.querySelector('.val-list-slider') );
    new Weather();
    new Currency();
    new CreateIframe(document.querySelector('.val-iframe-streams'));
    new PopUp(); 
    new Category();
});