<?php
/* @var $this PoolsController */
/* @var $model Pools */
/* @var $answers Answers */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').' Pools'=>array('index'),
	Yii::t('main', 'Добавление новой записи'),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model, 'answers'=>$answers, 'new'=>true)); ?>