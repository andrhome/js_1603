<?php
/* @var $this SmiController */
/* @var $model Smi */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Smis'=>array('index'),
	Yii::t('main', 'Добавление новой записи'),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>