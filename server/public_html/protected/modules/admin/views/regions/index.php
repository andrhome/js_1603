<?php
/* @var $this RegionsController */
/* @var $model Regions */

$this->breadcrumbs=array(
	Yii::t('main','Управление').' Regions',
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление')?> Regions</h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/regions/create'), array('class'=>'btn btn-default')); ?>    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'regions-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'title_ru',
		'title_uk',
		'image',
		'description_ru',
		'description_uk',
		/*
		'site',
		'socials',
		'people_count',
		*/
array(
'class'=>'CButtonColumn',
),
),
)); ?>