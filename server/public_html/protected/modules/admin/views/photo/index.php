<?php
/* @var $this PhotoController */
/* @var $model Photo */

$this->breadcrumbs=array(
	Yii::t('main','Управление').': '.Yii::t('main', 'фотографиями'),
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление').': '.Yii::t('main', 'фотографиями');?></h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/photo/create'), array('class'=>'btn btn-default')); ?>    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'photo-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
    'id',
    array(
        'header'=>'фото',
        'value'=>'"/uploads/images/thumbs/".$data->name',
        'type' => 'image',
        'filter'=>false,
        'htmlOptions'=>array('class'=>'image'),
    ),
    array(
        'header'=>'Категория',
        'value'=>'$data->categoryName',
    ),
    array(
        'class'=>'CButtonColumn',
    ),
),
)); ?>