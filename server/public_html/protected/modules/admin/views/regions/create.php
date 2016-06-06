<?php
/* @var $this RegionsController */
/* @var $model Regions */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Regions'=>array('index'),
	Yii::t('main', 'Добавление новой записи'),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>