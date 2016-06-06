<?php
/* @var $this AboutController */
/* @var $model About */

$this->breadcrumbs=array(
    Yii::t('main', 'Управление').': '.Yii::t('main', 'Об авторе')=>array('index'),
	Yii::t('main', 'Редактирование записи').': '.$model->title_ru,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>