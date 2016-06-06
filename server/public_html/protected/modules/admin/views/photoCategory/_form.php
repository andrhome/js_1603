<?php
/* @var $this PhotoCategoryController */
/* @var $model PhotoCategory */
/* @var $form CActiveForm */
$newImageName = uniqid();
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/jquery.Jcrop.js',
    CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl.'/css/jquery.Jcrop.css');

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'photo-category-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <div class="head">
        <h5>
            <?php echo $model->isNewRecord ? Yii::t('main', 'Добавление записи') : Yii::t('main', 'Редактирование записи').' '.$model->name_ru; ?>
        </h5>
        <div class="button_save">
            <?php echo CHtml::submitButton(Yii::t('main', 'Сохранить'), array('class'=>'btn btn-primary')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> ' .Yii::t('main', 'Вернуться'),array('/admin/photoCategory/index'), array('class'=>'btn btn-default',)); ?>
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
        <div id="images">
            <?php if(!$model->isNewRecord): ?>
                <?= CHtml::image(Yii::app()->baseUrl.'/uploads/galery/category/'.$model->image); ?>
                <?= $form->hiddenField($model, 'image'); ?>
            <?php endif; ?>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                <?php echo $model->isNewRecord ? Yii::t('main', 'Добавить фото') : Yii::t('main', 'Загррузить новое фото'); ?>
            </button>
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

        <div class="row">
            <?php echo $form->labelEx($model,'author'); ?>
            <?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'author'); ?>
        </div>
    </div>
    <div class="right_row">
        <div class="row">
            <?php echo $form->labelEx($model,'meta_title_uk'); ?>
            <?php echo $form->textField($model,'meta_title_uk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_title_uk'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'meta_description_uk'); ?>
            <?php echo $form->textField($model,'meta_description_uk',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_description_uk'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'meta_title_ru'); ?>
            <?php echo $form->textField($model,'meta_title_ru',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_title_ru'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'meta_description_ru'); ?>
            <?php echo $form->textField($model,'meta_description_ru',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'meta_description_ru'); ?>
        </div>
    </div>

    <div class="text-areas">
        <div class="row">
            <?php echo $form->labelEx($model,'description'); ?>
            <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'description'); ?>
        </div>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Загрузка и обрезка фото</h4>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'image-form',
                    'method'=>'POST',
                    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                )); ?>

                <?php echo $form->labelEx($model,'image'); ?>
                <?php echo $form->fileField($model,'image'); ?>
                <?php echo $form->error($model,'image'); ?>

                <?= CHtml::hiddenField('name', $newImageName); ?>
                <?= CHtml::submitButton('Загрузить', array('class'=>'btn btn-default')); ?>
                <?php $this->endWidget(); ?>

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'image-crop',
                    'method'=>'POST',
                    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                )); ?>

                <div id="done"></div>
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />

                <?= CHtml::submitButton('Обрезать', array('class'=>'btn btn-default')); ?>
                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>
<?php Yii::app()->clientScript->registerScript('crops','
    $("#image-form").submit(function(event){
        event.preventDefault();
        var data = new FormData($("#image-form")[0]);
        $.ajax({
            type: "POST",
            url: "'.Yii::app()->createUrl("/admin/photoCategory/upload").'",
            data: data,
            contentType: false,
            processData: false,
            success: function(html) {
                $("#image-form").hide();
                $("#image-crop").show();
                $("#done").append(html);
                $("#crop").load(function(){
                    $(this).Jcrop({
                        aspectRatio: 4/2.8,
                        boxWidth: 530,
                        boxHeight: 600,
                        onSelect: updateCoords
                    });
                });
            }
        }).done(function(){

        });
    });

    $( document ).ready(function() {
        $("#image-crop").hide();
    });

    function updateCoords(c)
    {
        $("#x").val(c.x);
        $("#y").val(c.y);
        $("#w").val(c.w);
        $("#h").val(c.h);
    };

    function checkCoords()
    {
        if (parseInt($("#w").val())) return true;
        alert("Please select a crop region then press submit.");
        return false;
    };

    $("#image-crop").submit(function(event){
        event.preventDefault();
        var data = new FormData($("#image-crop")[0]);
        $.ajax({
            type: "POST",
            url: "'.Yii::app()->createUrl("/admin/photoCategory/crop").'",
            data: data,
            contentType: false,
            processData: false,
            success: function(html) {
                $("#images").html(html);
            }
        }).done(function(){

        });
    });
',CClientScript::POS_END); ?>