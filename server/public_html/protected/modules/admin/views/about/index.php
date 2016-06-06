<?php
/* @var $this AboutController */
/* @var $model About */

$this->breadcrumbs=array(
	Yii::t('main','Управление').': '.Yii::t('main', 'Об авторе'),
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление').': '.Yii::t('main', 'Об авторе'); ?></h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/about/create'), array('class'=>'btn btn-default')); ?>    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'about-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'title_ru',
		'meta_title_ru',
        /*
		'meta_description',
		'meta_keyords',
		*/
array(
'class'=>'CButtonColumn',
),
),
)); ?>