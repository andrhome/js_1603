<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('main','Управление').': '.Yii::t('main', 'пользователями'),
);
?>
<div class="head">
    <h5>
        <?php echo Yii::t('main', 'Управление').': '.Yii::t('main', 'пользователями')?>
    </h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> ' .Yii::t('main', 'Добавить пользователя'),array('/admin/user/create'), array('class'=>'btn btn-default')); ?>
    </div>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'role',
        'username',
        'name',
        'reg_date',
        /*
        'birth_date',
        'sex',
        'region',
        'city',
        'email2',
        'avatar',
        'verification',
        'active',
        'description',
        'telephone',
        'profession',
        'location',
        */
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
