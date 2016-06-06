<?php
/* @var $this PhotoController */
/* @var $model Photo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'photo-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->name; ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/photo/index'), array('class'=>'btn btn-default',)); ?>
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
            <label><?php echo Yii::t('main', 'Изображение'); ?></label>
            <?php if($model->isNewRecord) {
                $this->widget('CMultiFileUpload', array(
                    'name'=>'images',
                    'accept' => 'jpeg|jpg|gif|png',
                    /*'options'=>array(
                        'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
                        'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
                        'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                        'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                        'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                        'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
                    ),*/
                ));
            } else {
                echo CHtml::image('/uploads/images/thumbs/'.$model->name, '');
            }

            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'category_id'); ?>
            <?php echo $form->dropDownList($model, 'category_id', CHtml::listData(PhotoCategory::model()->findAll(array('order' => 'name_ru ASC')), 'id', 'name_ru'), array('empty'=>'Выберите категорию')) ; ?>
            <?php echo $form->error($model,'category_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'description_ru'); ?>
            <?php echo $form->textField($model, 'description_ru', array('maxlength'=>255)); ?>
            <?php echo $form->error($model,'description_ru'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'description_uk'); ?>
            <?php echo $form->textField($model, 'description_uk', array('maxlength'=>255)); ?>
            <?php echo $form->error($model,'description_uk'); ?>
        </div>
    </div>



<?php $this->endWidget(); ?>

</div><!-- form -->