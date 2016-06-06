<article class="val-column-left">
	<div>
		<h2 class="val-title-uppercase-with-line"><?= Yii::t('main', 'Реклама на сайте'); ?></h2>

		<p class="val-descr-market">По вопросам размещения рекламы на сайте обращайтесь:</p>

		<ul class="val-descr-list-market">
			<li>01010 Киев, ул.Московская 19/1</li>
			<li>Телефон: +380 (44) 931 931</li>
			<li>Электронная почта: news@val.ua</li>
		</ul>

	</div>
	<div class="val-market-point">
		<?= CHtml::image(Yii::app()->baseUrl.'/public/images/market.png'); ?>
		<div id="-full"></div>
		<div id="-pushdown"></div>
        <div id="-premium-250"></div>
        <div id="-premium-600"></div>
        <div id="-cat-fish"></div>
        <div id="-full-screen"></div>
        <div id="-premium-low-250"></div>
        <div id="-content"></div>
        <div id="-video"></div>
	</div>

</article>
<article class="val-column-right">
	<div class="val-column-outer-right-line-news">
	<h3 class="val-title-uppercase-small">
        <span><?=Yii::t('main', 'Цены на рекламу');?></span>
    </h3>
    <div class="val-market-table">
    	<div class="val-market-title">
    		<p class="val-market-first-block">
    			<span>Баннер</span>
    		</p>
    		<p class="val-market-last-block">
    			<span>CPM <br>(стоимость размещения баннера на сутки, без НДС)</span>
    		</p>
    	</div>
    	<div data-attr="-pushdown" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Банер под шапкой, pushdown 1000х250</span>
    		</p>
    		<p class="val-market-last-block">
				<span>250 грн.</span>
    		</p>
    	</div>
    	<div data-attr="-premium-250" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Премиум баннер 300х250</span>
    		</p>
    		<p class="val-market-last-block">
				<span>150 грн.</span>
    		</p>
    	</div>
    	<div data-attr="-premium-600" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Премиум баннер 300х600</span>
    		</p>
    		<p class="val-market-last-block">
				<span>250 грн.</span>
    		</p>
    	</div>
    	<div data-attr="-cat-fish" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Cat fish 1000х150</span>
    		</p>
    		<p class="val-market-last-block">
				<span>250 грн.</span>
    		</p>
    	</div>
    	<div data-attr="-full-screen" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Full screen	full screen</span>
    		</p>
    		<p class="val-market-last-block">
				<span>500 грн.</span>
    		</p>
    	</div>
    	<div  data-attr="-premium-low-250" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Премиум баннер (второй экран) 300х300</span>
    		</p>
    		<p class="val-market-last-block">
				<span>120 грн.</span>
    		</p>
    	</div>
		<div data-attr="-content" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Контент банер 650х650</span>
    		</p>
    		<p class="val-market-last-block">
				<span>130 грн.</span>
    		</p>
    	</div>
    	<div data-attr="-video" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Видео банер 1000х600</span>
    		</p>
    		<p class="val-market-last-block">
				<span>600 грн.</span>
    		</p>
    	</div>
		<div data-attr="-full" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Брендирование сайта статика главная страница</span>
    		</p>
    		<p class="val-market-last-block">
				<span>10 000 грн неделя</span>
    		</p>
    	</div>
    	<div data-attr="-full" class="val-market-block">
    		<p class="val-market-first-block">
    			<span>Брендирование сайта статика сквозной</span>
    		</p>
    		<p class="val-market-last-block">
				<span>20 000 грн неделя</span>
    		</p>
    	</div>
    </div>
    </div>
</article>