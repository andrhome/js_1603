<?php
/* @var $this StreemController */
/* @var $model Streem */

$this->breadcrumbs=array(
	'Streems'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Streem', 'url'=>array('index')),
	array('label'=>'Manage Streem', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>