<?php
$this->pageTitle = Yii::app()->language == 'ru' ? $category->meta_title_ru : $category->meta_title_uk;
$this->pageDescription = Yii::app()->language == 'ru' ? $category->meta_description_ru : $category->meta_description_uk;
?>

<?php 
    $dateNow = (new DateTime())->format('Y-m-d');
?>
<article class="val-column-left">
	<div class="val-slider-general-news">
	        <ul class="val-list-slider">
	        <?php foreach($mostViewed as $news): ?> 
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
    	<div class="val-gen-news-column -category" id="val-single-category">
    	
		</div>
	</div>
</article>
<input type="hidden" id="val-count-and-id" data-id="<?=$id;?>" data-count="<?=$count;?>" >