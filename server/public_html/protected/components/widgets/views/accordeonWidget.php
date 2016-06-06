<?php
/* @var $allNews News */
?>
<div class="val-accordeons-block">
        <ul class="val-list-accard">
        <li class="val-list-item-accrd">
                <div class="val-outer-block-item-accard">
                    <span class="val-title-item-accard -gren-line-accrad -calendar-image">
                        <b>Календарь</b>
                    </span>
                    <div class="val-outer-hide-accrad -kalendar">
                       <input type="text" id="datepicker">
                    </div>
                </div>
            </li>
            <li class="val-list-item-accrd">
                <div class="val-outer-block-item-accard">
                    <span class="val-title-item-accard">
                        <img src="<?=Yii::app()->baseUrl.'/public/images/sinoptic.jpg';?>" alt="">
                    </span>
                    <div class="val-outer-hide-accrad -sinoptic">
                        <div class="val-innre-hide-accard"> 
                            <div id="SinoptikInformer" style="width:300px; margin-bottom: 10px;" class="SinoptikInformer type5c1"><div class="siHeader"><div class="siLh"><div class="siMh"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/" target="_blank">Погода</a><a onmousedown="siClickCount();" class="siLogo" href="https://ua.sinoptik.ua/" target="_blank"> </a> <span id="siHeader"></span></div></div></div><div class="siBody"><div class="siCity"><div class="siCityName"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-київ" target="_blank">Погода у <span>Києві</span></a></div><div id="siCont0" class="siBodyContent"><div class="siLeft"><div class="siTerm"></div><div class="siT" id="siT0"></div><div id="weatherIco0"></div></div><div class="siInf"><p>вологість: <span id="vl0"></span></p><p>тиск: <span id="dav0"></span></p><p>вітер: <span id="wind0"></span></p></div></div></div><div class="siCity"><div class="siCityName"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-чернігів" target="_blank">Погода у <span>Чернігові</span></a></div><div id="siCont1" class="siBodyContent"><div class="siLeft"><div class="siTerm"></div><div class="siT" id="siT1"></div><div id="weatherIco1"></div></div><div class="siInf"><p>вологість: <span id="vl1"></span></p><p>тиск: <span id="dav1"></span></p><p>вітер: <span id="wind1"></span></p></div></div></div><div class="siCity"><div class="siCityName"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-ніжин" target="_blank">Погода у <span>Ніжині</span></a></div><div id="siCont2" class="siBodyContent"><div class="siLeft"><div class="siTerm"></div><div class="siT" id="siT2"></div><div id="weatherIco2"></div></div><div class="siInf"><p>вологість: <span id="vl2"></span></p><p>тиск: <span id="dav2"></span></p><p>вітер: <span id="wind2"></span></p></div></div></div><div class="siCity"><div class="siCityName"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-новгород-сіверський" target="_blank">Погода у <span>Новгородi-Сіверському</span></a></div><div id="siCont3" class="siBodyContent"><div class="siLeft"><div class="siTerm"></div><div class="siT" id="siT3"></div><div id="weatherIco3"></div></div><div class="siInf"><p>вологість: <span id="vl3"></span></p><p>тиск: <span id="dav3"></span></p><p>вітер: <span id="wind3"></span></p></div></div></div><div class="siCity"><div class="siCityName"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-прилуки" target="_blank">Погода у <span>Прилуках</span></a></div><div id="siCont4" class="siBodyContent"><div class="siLeft"><div class="siTerm"></div><div class="siT" id="siT4"></div><div id="weatherIco4"></div></div><div class="siInf"><p>вологість: <span id="vl4"></span></p><p>тиск: <span id="dav4"></span></p><p>вітер: <span id="wind4"></span></p></div></div></div><div class="siLinks"></div></div><div class="siFooter"><div class="siLf"><div class="siMf"></div></div></div></div><script async="true" type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=4&amp;wind=2&amp;cities=303010783,303028915,303016980,303017594,303021959&amp;lang=ua"></script>
                        </div>
                    </div>
                </div>
            </li>
            <li class="val-list-item-accrd">
                <div class="val-outer-block-item-accard">
                    <span class="val-title-item-accard">
                        <img src="<?=Yii::app()->baseUrl.'/public/images/twitter.jpg';?>" alt="">
                    </span>
                    <div class="val-outer-hide-accrad -else">
                        <div class="val-innre-hide-accard">
                            <div class="twitter">
                                <a data-chrome="noscrollbar" class="twitter-timeline" href="https://twitter.com/svoboda_fm" data-widget-id="534429435424804864">Tweets by @svoboda_fm</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.setAttribute('async', 'true');js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>