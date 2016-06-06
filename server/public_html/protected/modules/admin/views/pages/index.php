<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	Yii::t('main','Управление').' Pages',
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление').': '.Yii::t('main', 'Страницами'); ?></h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/pages/create'), array('class'=>'btn btn-default')); ?>    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'pages-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'title_ru',
		'date',
		'description_ru',
		'meta_title_ru',
		/*
		'meta_description',
		'meta_keywords',
		*/
array(
'class'=>'CButtonColumn',
),
),
)); ?>