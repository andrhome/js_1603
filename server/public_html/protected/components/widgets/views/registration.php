<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 04.11.14
 * Time: 23:32
 */ ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'htmlOptions' =>array('class'=>'val-html-modal-form'),
    'id'=>'registration',
    'action'=>'/site/registration',
    'enableClientValidation'=>true,
    'enableAjaxValidation' => true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<?= CHtml::tag('h3', array('class' => 'val-title-uppercase-small'), '<span>Реєстрація</span>') ?>

<?php echo $form->emailField($model,'username', array('placeholder'=>strip_tags($form->labelEx($model,'username')), 'class'=>'form-control', 'required'=>'required')); ?>

<?php echo $form->passwordField($model,'password', array('placeholder'=>strip_tags($form->labelEx($model,'password')), 'class'=>'form-control', 'required'=>'required')); ?>

<?= CHtml::tag('button', array('class' => 'button -gen-green -no-margin-left-only-right'), 'Зареєструватися'); ?>
<?php $this->endWidget(); ?>