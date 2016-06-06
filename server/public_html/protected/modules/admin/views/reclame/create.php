<?php
/* @var $this ReclameController */
/* @var $model Reclame */

$this->breadcrumbs=array(
	'Reclames'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reclame', 'url'=>array('index')),
	array('label'=>'Manage Reclame', 'url'=>array('admin')),
);
?>

<h1>Create Reclame</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>