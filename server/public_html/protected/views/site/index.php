<?php
/* @var $this SiteController */
/* @var $mostViewed News */
/* @var $provider News */
?>
<?php 
    $dateNow = (new DateTime())->format('Y-m-d');
?>
<article class="val-column-left">
    <div class="val-slider-general-news">
        <ul class="val-list-slider">
        <?php foreach($mostViewedSlider as $news): ?> 
            <li class="val-list-slider-item">
                <a href="<?= Yii::app()->createUrl('/site/news', array('id'=>$news->id)); ?>">
                    <div class="val-left-in-slide">
                        <img src="<?=Yii::app()->baseUrl.'/uploads/news/thumb/'.$news->image?>" alt="">
                    </div>
                    <div class="val-right-in-slide">
                        <span class="val-content-news-data"><?= ($dateNow == date('Y-m-d', strtotime($news->date))) ? date('H:i', strtotime($news->date)) : intval(date('d', strtotime($news->date))).' '.Yii::app()->controller->getMonth($news->date).' '.date('Y', strtotime($news->date)); ?></span>
                        <h3 class="val-content-news-title"><?=CHtml::encode(Yii::app()->language == 'ru' ? $news->title_ru : $news->title_uk);?></h3>
                        <p class="val-content-news-description"><?=$this->getShortDescription(Yii::app()->language == 'ru' ? $news->description_ru : $news->description_uk, 150).'...'?></p>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="val-display-controls"></div>
    </div>
    <div class="val-outer-line-news">
        <div class="val-gen-news-column">
        <?php foreach($mostViewedLine as $news): ?> 
            <a href="<?= Yii::app()->createUrl('/site/news', array('id'=>$news->id)); ?>" class="val-block-gen-news">
                <div class="val-image-block-gen-news">
                   <img src="<?=Yii::app()->baseUrl.'/uploads/news/thumb/'.$news->image?>" alt="">
                </div>
                <div class="val-description-block-gen-news">
                     <span class="val-news-view"><?=$news->views;?></span>
                     <span class="val-content-news-data"><?= ($dateNow == date('Y-m-d', strtotime($news->date))) ? date('H:i', strtotime($news->date)) : intval(date('d', strtotime($news->date))).' '.Yii::app()->controller->getMonth($news->date).' '.date('Y', strtotime($news->date)); ?></span>
                    <h3 class="val-content-news-title-small"><?=CHtml::encode(Yii::app()->language == 'ru' ? $news->title_ru : $news->title_uk);?></h3>
                </div>
            </a>
        <?php endforeach; ?>
        </div>
        <div class="val-line-news-without-image">
            <?php foreach($allNewsLine as $key=>$news): ?>
                <div class="val-block-item-line-news">
                    <span class="val-date-line-news"><?= ($dateNow == date('Y-m-d', strtotime($news->date))) ? date('H:i', strtotime($news->date)) : intval(date('d', strtotime($news->date))).' '.Yii::app()->controller->getMonth($news->date).' '.date('Y', strtotime($news->date)); ?></span>
                    <?php if($news->marker == News::BOLD): ?>
                        <b><?= CHtml::link(Yii::app()->language == 'ru' ? $news->title_ru : $news->title_uk, array('/site/news', 'id'=>$news->id)); ?></b>
                    <?php elseif($news->marker == News::CAPS_BOLD): ?>
                        <b><?= CHtml::link(Yii::app()->language == 'ru' ? $news->title_ru : $news->title_uk, array('/site/news', 'id'=>$news->id), array('style'=>'text-transform: uppercase')); ?></b>
                    <?php else: ?>
                        <?= CHtml::link(Yii::app()->language == 'ru' ? $news->title_ru : $news->title_uk, array('/site/news', 'id'=>$news->id)); ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="val-more-news">
        <a href="/"><span>Больше новостей</span></a>
    </div>
    <div class="val-steam-block">
        <h2 class="val-title-uppercase">
            Прямые включения
        </h2>
        <div class="val-iframe-streams" data-src="<?= Streem::model()->findByPk(1)->url; ?>, <?= Streem::model()->findByPk(2)->url; ?>">
            
        </div>
    </div>
    <div class="val-multimedia-block">
        <h2 class="val-title-uppercase">
            <span>Мультимедиа</span>
            <a href="#">Все видеорепортажи</a>
            <a href="#">Все фоторепортажи</a>
        </h2>
        <div class="val-conteiner-multimedia">
            <?php foreach($multimedia as $videos): ?> 
                <div class="val-conteiner-multimedia-items">
                    <? if(isset($videos->video)) : ?>
                        <a href="<?= Yii::app()->createUrl('/site/video', array('id'=>$videos->id)); ?>">
                            <span class="val-ico-multimedia-video"></span>
                            <img src="http://img.youtube.com/vi/<?= $videos->video; ?>/mqdefault.jpg" alt="image01" />
                        </a>
                    <? else: ?>
                        <a href="<?= Yii::app()->createUrl('/site/photos', array('id'=>$videos->id)); ?>">
                            <span class="val-ico-multimedia-photo"></span>
                            <?= CHtml::image(Yii::app()->baseUrl.'/uploads/galery/category/'.$videos->image, (Yii::app()->language == 'ru') ? $videos->name_ru : $videos->name_uk); ?>
                        </a>
                    <? endif; ?>
                </div>
             <?php endforeach; ?>
        </div>
    </div>
</article>
<article class="val-column-right">
    <div class="val-column-outer-right-line-news">
         <h3 class="val-title-uppercase-small">
            <span>Не пропустите</span>
            <?= CHtml::link(Yii::t('main', 'Всi новини'), array('/site/allNews')) ?>
        </h3>
        <div class="val-line-news-with-img">
        <?php foreach($allNewsPhoto as $key=>$news): ?>
           <a href="<?= Yii::app()->createUrl('/site/news', array('id'=>$news->id)); ?>" class="val-block-gen-news -val-with-image-line-news">
                <div class="val-image-block-gen-news">
                   <img src="<?=Yii::app()->baseUrl.'/uploads/news/thumb/'.$news->image?>" alt="">
                </div>
                <div class="val-description-block-gen-news -val-no-padding">
                    <span class="val-date-line-news"><?= ($dateNow == date('Y-m-d', strtotime($news->date))) ? date('H:i', strtotime($news->date)) : intval(date('d', strtotime($news->date))).' '.Yii::app()->controller->getMonth($news->date).' '.date('Y', strtotime($news->date)); ?></span>
                    <p class="val-description-line-news-with-img"><?=Yii::app()->language == 'ru' ? $news->title_ru : $news->title_uk;?></p>
                </div>
            </a>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="val-blogers-column">
        <h2 class="val-title-uppercase">Блоги и Блогеры</h2>
        <?php $this->widget('application.components.widgets.BloggerLayout'); ?>
    </div>
    <?php $this->widget('application.components.widgets.AccordeonWidget'); ?>
</article>
<article class="val-full-width-category"></article>