<?php
/* @var $this PhotoController */
/* @var $model Photo */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').': '.Yii::t('main', 'фотографиями')=>array('index'),
	Yii::t('main', 'Редактирование записи').': '.$model->name,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>