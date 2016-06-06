<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs=array(
	Yii::t('main','Управление').' Videos',
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление')?> Videos</h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/video/create'), array('class'=>'btn btn-default')); ?>    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'video-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'title_uk',
		'video',
array(
'class'=>'CButtonColumn',
),
),
)); ?>