<?php
/* @var $this PhotoCategoryController */
/* @var $model PhotoCategory */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Photo Categories'=>array('index'),
	Yii::t('main', 'Добавление новой записи'),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>