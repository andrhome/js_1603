<?php
/* @var $this SmiController */
/* @var $model Smi */

$this->breadcrumbs=array(
	Yii::t('main','Управление').' СМИ о нас',
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление')?>СМИ о нас</h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/smi/create'), array('class'=>'btn btn-default')); ?>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'smi-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'title',
		'meta_title',
		'meta_description',
		'meta_keywords',
array(
'class'=>'CButtonColumn',
),
),
)); ?>