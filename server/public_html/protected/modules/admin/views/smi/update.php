<?php
/* @var $this SmiController */
/* @var $model Smi */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Smis'=>array('index'),
	Yii::t('main', 'Редактирование записи').': '.$model->title,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>