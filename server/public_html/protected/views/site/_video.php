<?php
$this->pageTitle = Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk;
$this->pageDescription = Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk;
$data->views ++;
$data->save();
?>
<?php 
    $dateNow = (new DateTime())->format('Y-m-d');
?>
<article class="val-column-left">
    <div class="val-single-news-conainer-with-read-else">
		<div>
		    <img src="http://img.youtube.com/vi/<?= $data->video; ?>/mqdefault.jpg" alt="">
		    <div class="descriptionVideo oneVideoStyle">
		        <p class="-date-italic"><span class="fa fa-calendar"></span> <?= date('d.m.Y', strtotime($data->date)); ?></p>
		        <?= CHtml::link(Yii::app()->language == 'ru' ? $data->title_ru : $data->title_uk ,array('/site/video', 'id'=>$data->id), array('class'=>'textDescriptionVideo')); ?>
		    </div>
		    <a href="<?= Yii::app()->createUrl('/site/video', array('id'=>$data->id)); ?>" class="seenVideo">
		        <span class="fa fa-play-circle-o"></span>
		    </a>
		</div>
	</div>
<article/>