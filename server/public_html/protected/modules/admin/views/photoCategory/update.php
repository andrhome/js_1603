<?php
/* @var $this PhotoCategoryController */
/* @var $model PhotoCategory */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Photo Categories'=>array('index'),
	Yii::t('main', 'Редактирование записи').': '.$model->id,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>