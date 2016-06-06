<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions' =>array('class'=>'sing val-html-modal-form'),
    'id'=>'login',
    'action'=>'/site/login',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<?= CHtml::tag('h3', array('class' => 'val-title-uppercase-small'), '<span>Вход</span>') ?>
<?php echo $form->emailField($model,'username', array('placeholder'=>'Введите Email...', 'class'=>'form-control', 'required'=>'required')); ?>
<?php echo $form->passwordField($model,'password', array('placeholder'=>'Введите пароль...', 'class'=>'form-control', 'required'=>'required')); ?>
<?= CHtml::tag('button', array('class' => 'button -gen-green -no-margin-left-only-right'), 'Войти') ?>
<a href="#" class="-val-remember-pass">Напомнить пароль</a>


<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions' =>array('class'=>'remember val-html-modal-form'),
    'id'=>'remember',
    'action'=>'/site/remember',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
<?= CHtml::tag('h3', array('class' => 'val-title-uppercase-small'), '<span>Нагадати пароль</span>') ?>
<?php echo $form->textField($remember,'email', array('placeholder'=>'Введите Email...', 'class'=>'form-control', 'required'=>'required')); ?>
<?= CHtml::tag('button', array('class' => 'button -gen-green -no-margin-left-only-right'), 'Нагадати') ?>
<a href="#" class="-val-remember-pass">Назад</a>

<?php $this->endWidget(); ?>
