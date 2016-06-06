<?php
$this->pageTitle = Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk;
$this->pageDescription = Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk;
$this->metaAttributes[] = '<meta property="og:image" content="http://val.ua'.Yii::app()->baseUrl.'/uploads/news/full/'.$data->image.'" />';
$data->views ++;
$data->save();
?>
<?php 
    $dateNow = (new DateTime())->format('Y-m-d');
?>
<article class="val-column-left">
    <div class="val-single-news-conainer-with-read-else">
        <div class='val-container-one-news'>
            <h2 class="val-title-uppercase-with-line val-title-uppercase-small"><?= CHtml::encode(Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk); ?></h2>
            <?= CHtml::image(Yii::app()->baseUrl.'/uploads/news/full/'.$data->image, Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk, array('class'=>'genImages')); ?>
            <div class="val-description-block-gen-news">
                <span class="val-news-view"><?=$data->views;?></span>
                <span class="val-content-news-data"><?= ($dateNow == date('Y-m-d', strtotime($data->date))) ? date('H:i', strtotime($data->date)) : intval(date('d', strtotime($data->date))).' '.Yii::app()->controller->getMonth($data->date).' '.date('Y', strtotime($data->date)); ?></span>
            </div>
            <div class="val-text-from-content-manager-wright">
                <?= Yii::app()->language == 'ru' ? $data->description_ru : $data->description_uk; ?>
            </div>
            <div class="dateTimeSocial">
                <div class="Social">
                   <div class="share42init" data-url="http://val.ua<?=Yii::app()->request->requestUri;?>" data-title="<?= CHtml::encode(Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk); ?>" data-image="http://val.ua/uploads/news/full/<?=$data->image;?> " data-description="<?=$this->getShortDescription(Yii::app()->language == 'ru' ? $data->description_ru : $data->description_uk, 100)?>..."></div>
                </div>
            </div>
            <div class="marketInOneNewsPagebottom">
                  <?php $this->widget('application.components.widgets.ReclameWidget', array('id'=>20)); ?>
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
            <span> <?= Yii::t('main', 'Читайте також'); ?> </span>
            <?= CHtml::link(Yii::app()->language == 'ru' ? $data->category->name_ru : $data->category->name_uk, array('/site/category', 'id'=>$data->category->id)); ?>
        </h2>
        <div class="val-outer-line-news">
            <div class="val-gen-news-column -category">
             <?php foreach($relatedNews as $news): ?>
                <a href="<?= Yii::app()->createUrl('/site/news', array('id'=>$news->id)); ?>" class="val-block-gen-news">
                    <div class="val-image-block-gen-news">
                       <?=CHtml::image(Yii::app()->baseUrl.'/uploads/news/thumb/'.$news->image); ?>
                    </div>
                    <div class="val-description-block-gen-news">
                         <span class="val-news-view"><?=$news->views;?></span>
                         <span class="val-content-news-data"><?= ($dateNow == date('Y-m-d', strtotime($news->date))) ? date('H:i', strtotime($news->date)) : intval(date('d', strtotime($news->date))).' '.Yii::app()->controller->getMonth($news->date).' '.date('Y', strtotime($news->date)); ?></span>
                        <h3 class="val-content-news-title-small"><?=Yii::app()->language == 'ru' ? $news->title_ru : $news->title_uk;?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</article>
    