<?php
/* @var $this ReclameController */
/* @var $model Reclame */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reclame-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->position; ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/news/index'), array('class'=>'btn btn-default',)); ?>
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
            <?php echo $form->labelEx($model,'position'); ?>
            <?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>150)); ?>
            <?php echo $form->error($model,'position'); ?>
        </div>
    </div>
    <div class="clear"></div>

    <div class="text-areas">

        <div class="row">
            <?php echo $form->labelEx($model,'description'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model'=>$model,
                'attribute'=>'description',
                'config'=>array(
                    'filebrowserUploadUrl' => $this->createUrl('/admin/upload/index/'),//Конфиг вставлять сюда
                ),
            ));
            ?>
            <?php echo $form->error($model,'description'); ?>
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->