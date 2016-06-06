<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	Yii::t('main', 'Управление').': '.Yii::t('main', 'настройками блога')=>array('index'),
	Yii::t('main', 'Редактирование настроек блога'),
);
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'options-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="head">
        <h5>
            <?php echo Yii::t('main', 'Редактирование настроек блога'); ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/pages/index'), array('class'=>'btn btn-default',)); ?>        </div>
        <div class="clear"></div>
    </div>
    <!---- Flash message ---->
    <?php $this->beginWidget('FlashWidget',array(
        'params'=>array(
            'model' => $model,
            'form' => $form,
        )));
    $this->endWidget(); ?>    <!---- End Flash message ---->

    <div class="left_row">
        <div class="row">
            <?php echo $form->labelEx($model,'site_name'); ?>
            <?php echo $form->textField($model,'site_name',array('size'=>60,'maxlength'=>150)); ?>
            <?php echo $form->error($model,'site_name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'top_news_count'); ?>
            <?php echo $form->textField($model,'top_news_count'); ?>
            <?php echo $form->error($model,'top_news_count'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'short_description_symbols'); ?>
            <?php echo $form->textField($model,'short_description_symbols'); ?>
            <?php echo $form->error($model,'short_description_symbols'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->