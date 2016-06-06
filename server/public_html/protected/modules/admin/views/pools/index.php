<?php
/* @var $this PoolsController */
/* @var $model Pools */

$this->breadcrumbs=array(
	Yii::t('main','Управление').' Pools',
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление')?> Pools</h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/pools/create'), array('class'=>'btn btn-default')); ?>    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'pools-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'active',
		'name',
		'hits',
array(
'class'=>'CButtonColumn',
),
),
)); ?>