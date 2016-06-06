<?php
/* @var $this AboutController */
/* @var $model About */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'about-form',
	'enableAjaxValidation'=>false,
)); ?>

    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->title_ru; ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/about/index'), array('class'=>'btn btn-default',)); ?>
        </div>
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
            <?php echo $form->labelEx($model,'title_ru'); ?>
            <?php echo $form->textField($model,'title_ru',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title_ru'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'title_uk'); ?>
            <?php echo $form->textField($model,'title_uk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title_uk'); ?>
        </div>

    </div>

    <div class="right_row">
        <div class="row">
            <?php echo $form->labelEx($model,'meta_title_ru'); ?>
            <?php echo $form->textField($model,'meta_title_ru',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_title_ru'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'meta_title_uk'); ?>
            <?php echo $form->textField($model,'meta_title_uk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_title_uk'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'meta_description_ru'); ?>
            <?php echo $form->textField($model,'meta_description_ru',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_description_ru'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'meta_description_uk'); ?>
            <?php echo $form->textField($model,'meta_description_uk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_description_uk'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'meta_keywords_ru'); ?>
            <?php echo $form->textField($model,'meta_keywords_ru',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_keywords_ru'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'meta_keywords_uk'); ?>
            <?php echo $form->textField($model,'meta_keywords_uk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_keywords_uk'); ?>
        </div>
    </div>

    <div class="clear"></div>

    <div class="text-areas">
        <div class="row">
            <?php echo $form->labelEx($model,'description_ru'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model'=>$model,
                'attribute'=>'description_ru',
            ));
            ?>
            <?php echo $form->error($model,'description_ru'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'description_uk'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model'=>$model,
                'attribute'=>'description_uk',
            ));
            ?>
            <?php echo $form->error($model,'description_uk'); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->