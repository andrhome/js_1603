<?php
/* @var $this StreemController */
/* @var $model Streem */

$this->breadcrumbs=array(
	'Streems'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>