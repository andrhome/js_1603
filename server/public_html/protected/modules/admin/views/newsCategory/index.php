<?php
/* @var $this NewsCategoryController */
/* @var $model NewsCategory */

$this->breadcrumbs=array(
	Yii::t('main','Управление').': '.Yii::t('main', 'Категориями новостей'),
);

?>

<div class="head">
    <h5><?php echo Yii::t('main', 'Управление').': '.Yii::t('main', 'Категориями новостей'); ?></h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/newsCategory/create'), array('class'=>'btn btn-default')); ?>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'news-category-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name_ru',
		'parent_id',
		'description_ru',
		'meta_title_ru',
		'meta_description_ru',
		/*
		'meta_keywords',
		*/
array(
'class'=>'CButtonColumn',
),
),
)); ?>