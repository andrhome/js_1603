<?php
/* @var $this RegionsController */
/* @var $model Regions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'regions-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->title_ru; ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/regions/index'), array('class'=>'btn btn-default',)); ?>
        </div>
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
            <?php echo $form->labelEx($model,'title_ru'); ?>
            <?php echo $form->textField($model,'title_ru',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title_ru'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'title_uk'); ?>
            <?php echo $form->textField($model,'title_uk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title_uk'); ?>
        </div>

        <div class="row">
            <div class="row">
                <?php echo $form->labelEx($model,'image'); ?>
                <?php echo $form->fileField($model,'image'); ?>
                <?php echo $form->error($model,'image'); ?>
            </div>
        </div>
    </div>

    <div class="right_row">
        <div class="row">
            <?php echo $form->labelEx($model,'site'); ?>
            <?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'site'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'people_count'); ?>
            <?php echo $form->textField($model,'people_count'); ?>
            <?php echo $form->error($model,'people_count'); ?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="text-areas">
        <div class="row">
            <?php echo $form->labelEx($model,'socials'); ?>
            <?php echo $form->textArea($model,'socials',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'socials'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'description_ru'); ?>
            <?php echo $form->textArea($model,'description_ru',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'description_ru'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'description_uk'); ?>
            <?php echo $form->textArea($model,'description_uk',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'description_uk'); ?>
        </div>
    </div>



<?php $this->endWidget(); ?>

</div><!-- form -->