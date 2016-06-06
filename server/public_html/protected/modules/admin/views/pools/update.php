<?php
/* @var $this PoolsController */
/* @var $model Pools */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Pools'=>array('index'),
	Yii::t('main', 'Редактирование записи').': '.$model->name,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'new'=>false)); ?>