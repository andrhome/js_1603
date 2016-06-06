<?php
/* @var $this SiteController */
/* @var $data PhotoCategory */
/* @var $page Pages */
?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/public/js/_lib/masonry.pkgd.min.js', CClientScript::POS_END);?>
<div class="marketInOneCategoryPagebottom">
<?php $this->widget('application.components.widgets.ReclameWidget', array('id'=>44)); ?>
</div>

<article class="val-column-left">
     <h3 class="val-title-uppercase-with-line">
        <?=Yii::t('main', 'Мультимедіа')?>
     </h3>
    
    <div class="val-outer-line-news">
        <div class="val-gen-news-column -category" id="val-single-multimedia">
           
        </div>
    </div>
</article>
<input type="hidden" id="val-count-and-id" data-count="<?=$count;?>" >




