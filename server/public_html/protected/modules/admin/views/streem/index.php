<?php
/* @var $this StreemController */
/* @var $model Streem */

$this->breadcrumbs=array(
    Yii::t('main','Управление').': '.Yii::t('main', 'Стримом'),
);
?>

<div class="head">
    <h5>
        <?php echo Yii::t('main', 'Управление').': '.Yii::t('main', 'Стримом')?>
    </h5>
    <div class="button_save">

    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'streem-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'url',
        'name_ru',
        'name_uk',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}'
        ),
    ),
)); ?>
