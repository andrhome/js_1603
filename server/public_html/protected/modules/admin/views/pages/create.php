<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').': '.Yii::t('main', 'Страницами')=>array('index'),
	Yii::t('main', 'Добавление новой записи'),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>