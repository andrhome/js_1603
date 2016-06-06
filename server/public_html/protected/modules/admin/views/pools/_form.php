<?php
/* @var $this PoolsController */
/* @var $model Pools */
/* @var $answers Answers */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pools-form',
	'enableAjaxValidation'=>false,
)); ?>

    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->name; ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/pages/index'), array('class'=>'btn btn-default',)); ?>
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
            <?php echo $form->labelEx($model,'active'); ?>
            <?php echo $form->dropDownList($model,'active', array(1=>Yii::t('main', 'Активний'), 0=>Yii::t('main', 'Не активний'))); ?>
            <?php echo $form->error($model,'active'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
    </div>

    <?php if($new): ?>

    <div class="right_row">
        <div class="row">
            <div id="answer">
                <label for="addAnswer"><?= Yii::t('main', 'Варіант відповіді'); ?></label>
                <input type="text" name="Answers_name[]" required>
            </div>
            <div class="answers-other">

            </div>
            <a href="#" class="btn btn-info" id="addAnswer"><?= Yii::t('main', 'Додати варіант'); ?></a>
        </div>
    </div>

    <?php endif; ?>

<?php $this->endWidget(); ?>
    <!-- form -->
</div>
<script>
    jQuery('#addAnswer').click(function()
    {
        var inputAnswer = jQuery('#answer').children().clone();
        jQuery('.answers-other').append(inputAnswer.attr('value', ''));
    })
</script>