<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Videos'=>array('index'),
	Yii::t('main', 'Редактирование записи').': '.$model->title_uk,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>