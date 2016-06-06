<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->username; ?>
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
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150)); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'role'); ?>
        <?php echo $form->dropDownList($model,'role',array(
            User::ROLE_ADMIN => 'Админ',
            User::ROLE_BLOGER => 'Блогер',
            User::ROLE_MANAGER => 'Менеджер',
        )); ?>
        <?php echo $form->error($model,'role'); ?>

        <div class="row">
            <label for="new_password">Новый пароль</label>
            <?= CHtml::textField('new_password'); ?>
        </div>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'sex'); ?>
        <?php echo $form->dropDownList($model,'sex', array(1=>'Мужской', 2=>'Женский')); ?>
        <?php echo $form->error($model,'sex'); ?>
    </div>
</div>

<div class="right_row">
    <div class="row">
        <?php echo $form->labelEx($model,'birth_date'); ?>
        <?php echo $form->textField($model,'birth_date'); ?>
        <?php echo $form->error($model,'birth_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'avatar'); ?>
        <?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'avatar'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'telephone'); ?>
        <?php echo $form->textField($model,'telephone',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'telephone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'profession'); ?>
        <?php echo $form->textField($model,'profession',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'profession'); ?>
    </div>
</div>

<?php $this->endWidget(); ?>