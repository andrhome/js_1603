<?php
/* @var $this CabinetController */
/* @var $model News */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/fc-cropresizer.js',
    CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl. '/css/fc-cropresizer.css');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'article-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title', array('class'=>'form-control', 'placeholder'=>'Введите название поста')); ?>
    <?php echo $form->error($model,'title'); ?>

    <?php echo $form->labelEx($model,'description'); ?>
    <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
        'model'=>$model,
        'attribute'=>'description',
        'config'=>array(
            'filebrowserUploadUrl' => $this->createUrl('/blog/upload/index'),//Конфиг вставлять сюда
        ),
    ));
    ?>
    <?php echo $form->error($model,'description'); ?>
    <p class="absoluteAdd"><?= Yii::t('main', 'Зберегти'); ?> &nbsp; <?php echo CHtml::tag('button',
            array('class' => 'btn btn-info absoluteAddButton'),
            '<span class="glyphicon glyphicon-plus"></span>'); ?></p>
<?php $this->endWidget(); ?>