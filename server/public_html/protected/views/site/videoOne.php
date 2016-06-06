<?php
/* @var $model Video */
$this->pageTitle = Yii::app()->language == 'ru' ? $model->meta_title_ru : $model->meta_title_uk;
$this->pageDescription = Yii::app()->language == 'ru' ? $model->meta_description_ru : $model->meta_description_uk;
?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/public/js/_lib/masonry.pkgd.min.js', CClientScript::POS_END);?>
<?php 
    $dateNow = (new DateTime())->format('Y-m-d');
?>
<article class="val-column-left">
    <div class="val-single-news-conainer-with-read-else">
        <div class='val-container-one-news'>
            <h2 class="val-title-uppercase-with-line val-title-uppercase-small"><?= CHtml::encode(Yii::app()->language == 'ru' ? $model->title_ru : $model->title_uk); ?></h2>

            <div class="marketInOneVideoPageTop">
                <?php $this->widget('application.components.widgets.ReclameWidget', array('id'=>15)); ?>
            </div>

            <div class="val-description-block-gen-news">
                <span class="val-content-news-data"><?= ($dateNow == date('Y-m-d', strtotime($model->date))) ? date('H:i', strtotime($model->date)) : intval(date('d', strtotime($model->date))).' '.Yii::app()->controller->getMonth($model->date).' '.date('Y', strtotime($model->date)); ?></span>
            </div>
            
            <iframe allowfullscreen frameborder="0" width="100%" height="400px" src="http://www.youtube.com/embed/<?= $model->video; ?>" ></iframe>

            <div class="marketInOneVideoPagebottom">
                <?php $this->widget('application.components.widgets.ReclameWidget', array('id'=>16)); ?>
            </div>
            
            <script type="text/javascript">(function(w,doc) {
            if (!w.__utlWdgt ) {
                w.__utlWdgt = true;
                var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
                var h=d[g]('body')[0];
                h.appendChild(s);
            }})(window,document);
            </script>
            <div data-background-alpha="0.0" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="true" data-share-counter-type="separate" data-share-style="1" data-mode="share" data-like-text-enable="false" data-hover-effect="scale" data-mobile-view="true" data-icon-color="#ffffff" data-orientation="horizontal" data-text-color="#000000" data-share-shape="round-rectangle" data-sn-ids="fb.vk.tw.ok.gp." data-share-size="30" data-background-color="#ffffff" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.vb." data-pid="1507613" data-counter-background-alpha="1.0" data-following-enable="false" data-exclude-show-more="true" data-selection-enable="true" class="uptolike-buttons" ></div>
    </div>
    <h2 class="val-title-uppercase-with-line">
        <span> <?= Yii::t('main', 'Переглядайте також'); ?> </span>
        <?= CHtml::link(Yii::t('main', 'Мультимедіа'), array('/site/multimedia')); ?>
    </h2>
    <div class="-for-mansory-container">
        <?php foreach($relatedVideos as $key => $video): ?>
            <a href="<?= Yii::app()->createUrl('/site/video', array('id'=>$video->id)); ?>" class="val-block-multimedia -val-ico-video -only-video">
                <span class="-val-multimedia-description"><?=Yii::app()->language == 'ru' ? $video->title_ru : $video->title_uk;?></span>
                <div class="val-image-block-multimedia">
                    <img src="http://img.youtube.com/vi/<?=$video->video;?>/mqdefault.jpg">
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</article>
