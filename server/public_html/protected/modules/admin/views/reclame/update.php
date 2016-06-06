<?php
/* @var $this ReclameController */
/* @var $model Reclame */

$this->breadcrumbs=array(
	'Reclames'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>