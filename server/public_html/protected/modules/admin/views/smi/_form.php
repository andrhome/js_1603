<?php
/* @var $this SmiController */
/* @var $model Smi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smi-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->title; ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/smi/index'), array('class'=>'btn btn-default',)); ?>        </div>
        <div class="clear"></div>
    </div>
    <!---- Flash message ---->
    <?php $this->beginWidget('FlashWidget',array(
        'params'=>array(
            'model' => $model,
            'form' => $form,
        )));
    $this->endWidget(); ?>
    <!---- End Flash message ---->
    <div class="left_row">
        <div class="row">
            <?php echo $form->labelEx($model,'image'); ?>
            <?php echo CHtml::activeFileField($model, 'image'); ?>
            <?php echo $form->error($model,'image'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
    </div>

    <div class="right_row">
        <div class="row">
            <?php echo $form->labelEx($model,'meta_title'); ?>
            <?php echo $form->textField($model,'meta_title',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'meta_description'); ?>
            <?php echo $form->textField($model,'meta_description',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_description'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'meta_keywords'); ?>
            <?php echo $form->textField($model,'meta_keywords',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_keywords'); ?>
        </div>
    </div>

    <div class="text-areas">
        <div class="clear"></div>
        <div class="row">
            <?php echo $form->labelEx($model,'description'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model'=>$model,
                'attribute'=>'description',
            ));
            ?>
            <?php echo $form->error($model,'description'); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->