<?php
/* @var $this PhotoCategoryController */
/* @var $model PhotoCategory */

$this->breadcrumbs=array(
	Yii::t('main','Управление').' Photo Categories',
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление')?> Категориями фоторепортажей</h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/photoCategory/create'), array('class'=>'btn btn-default')); ?>    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'photo-category-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array(
        'header'=>'фото',
        'value'=>'"/uploads/galery/category/".$data->image',
        'type' => 'image',
        'filter'=>false,
        'htmlOptions'=>array('class'=>'image'),
    	),
		'name_ru',
		'name_uk',
array(
'class'=>'CButtonColumn',
),
),
)); ?>