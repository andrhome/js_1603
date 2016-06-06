<?php
/* @var $this StreemController */
/* @var $model Streem */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'streem-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>


<div class="head">
    <h5>
        <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->name_ru; ?>
    </h5>
    <div class="button_save">
        <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
    </div>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/streem/index'), array('class'=>'btn btn-default',)); ?>
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
<div class="left-row">

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
          <div class="helps"><p>ПРИМЕР: <span>&lt;iframe src="http://embed.bambuser.com/channel/svoboda.fm"&gt;</span></p></div>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_ru'); ?>
		<?php echo $form->textField($model,'name_ru',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name_ru'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_uk'); ?>
		<?php echo $form->textField($model,'name_uk',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name_uk'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->