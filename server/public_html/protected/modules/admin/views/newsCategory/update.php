<?php
/* @var $this NewsCategoryController */
/* @var $model NewsCategory */

$this->breadcrumbs=array(
    Yii::t('main','Управление').': '.Yii::t('main', 'Категориями новостей')=>array('index'),
	Yii::t('main', 'Редактирование записи').': '.$model->name_ru,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>