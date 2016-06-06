<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	Yii::t('main','Управление').': '.Yii::t('main', 'Новостями'),
);
?>

<div class="head">
    <h5>
        <?php echo Yii::t('main', 'Управление').': '.Yii::t('main', 'Новостями')?>
    </h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить запись'),array('/admin/news/create'), array('class'=>'btn btn-default')); ?>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'news-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'title_ru',
		'views',
        'region',
        array(
            'name'=>'modify',
            'value'=>'isset($data->modify) ? "Последний отредактировал \r\n".$data->modify->username." \r\n".date("d-m-Y H:i:s", strtotime($data->modify_date)) : "Никто не редактировал"',
            'type'=>'raw',
        ),
		/*
		'date',
		'category_id',
		'meta_title',
		'meta_description',
		'meta_keywords',
		*/
array(
'class'=>'CButtonColumn',
),
),
)); ?>