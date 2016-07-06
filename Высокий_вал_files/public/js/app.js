window.addEventListener('DOMContentLoaded', function()  {
	new Slider( document.querySelector('.val-list-slider') );
    new Weather(document.querySelector('.outer-for-weather'));
    new Currency();
    new CreateIframe(document.querySelector('.val-iframe-streams'));
    new PopUp(); 
    new Category(document.querySelector('.val-full-width-category'));
});