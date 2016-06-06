<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Videos'=>array('index'),
	Yii::t('main', 'Добавление новой записи'),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>