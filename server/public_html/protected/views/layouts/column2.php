<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <?= $content; ?>
	<article class="val-column-right">
    <div class="val-column-outer-right-line-news">
         <h3 class="val-title-uppercase-small">
            <span><?=Yii::t('main', 'Не пропустіть');?></span>
            <?= CHtml::link(Yii::t('main', 'Всi новини'), array('/site/allNews')) ?>
        </h3>
        <div class="val-line-news-with-img">
            <?php $this->widget('application.components.widgets.AllNewsWidget'); ?>
        </div>
    </div>
    <div class="val-blogers-column">
        <h2 class="val-title-uppercase">Блоги и Блогеры</h2>
        <?php $this->widget('application.components.widgets.BloggerLayout'); ?>
    </div>
    <div id="val-only-else-pages">
        <?php $this->widget('application.components.widgets.AccordeonWidget'); ?>
    </div>
</article>
<?php $this->endContent(); ?>