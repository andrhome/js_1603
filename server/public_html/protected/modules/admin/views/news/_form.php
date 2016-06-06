<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
$newImageName = uniqid();

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/jquery.Jcrop.js',
    CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl.'/css/jquery.Jcrop.css');

?>
<div class="form form-width-image">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
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
        <div id="images">
            <?php if(!$model->isNewRecord): ?>
                <?= CHtml::image(Yii::app()->baseUrl.'/uploads/news/full/'.$model->image); ?>
                <?= CHtml::image(Yii::app()->baseUrl.'/uploads/news/thumb/'.$model->image); ?>
                <?= $form->hiddenField($model, 'image'); ?>
            <?php endif; ?>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                <?php echo $model->isNewRecord ? Yii::t('main', 'Добавить фото') : Yii::t('main', 'Загрузить новое фото'); ?>
            </button>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'date'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'date_start',
                'model' => $model,
                'attribute' => 'date',
                'language' => 'ru',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                    'onSelect'=>'js:function(i,j){

                       function JSClock() {
                          var time = new Date();
                          var hour = time.getHours();
                          var minute = time.getMinutes();
                          var second = time.getSeconds();
                          var temp="";
                          temp +=(hour<10)? "0"+hour : hour;
                          temp += (minute < 10) ? ":0"+minute : ":"+minute ;
                          temp += (second < 10) ? ":0"+second : ":"+second ;
                          return temp;
                        }

                        $v=$(this).val();
                        $(this).val($v+" "+JSClock());

                 }'
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;'
                ),
            ));?>
            <?php echo $form->error($model,'date'); ?>
        </div>

		<div class="row">
            <?php echo $form->labelEx($model,'title_uk'); ?>
            <div class="input-group">
                <?php echo $form->textField($model,'title_uk',array('maxlength'=>120)); ?>
                <span id="title_uk_count" class="input-group-addon btn btn-primary"></span>
            </div>
            <?php echo $form->error($model,'title_uk'); ?>
        </div>
        
        <?php if(!$model->isNewRecord): ?>
            <div class="row">
                <?php echo $form->labelEx($model,'title_ru'); ?>
                <div class="input-group">
                    <?php echo $form->textField($model,'title_ru',array('maxlength'=>120)); ?>
                    <span id="title_ru_count" class="input-group-addon btn btn-primary"></span>
                </div>
                <?php echo $form->error($model,'title_ru'); ?>
            </div>
        <?php endif; ?>
        

        <div class="row">
            <?php echo $form->labelEx($model,'marker'); ?>
            <?php echo $form->dropDownList($model,'marker',array(0=>Yii::t('main', 'Ні'), 1=>Yii::t('main', 'Жирним'), 2=>Yii::t('main', 'Жирним Капсом'))); ?>
            <?php echo $form->error($model,'marker'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'author'); ?>
            <?php echo $form->textField($model,'author',array('maxlength'=>255)); ?>
            <?php echo $form->error($model,'author'); ?>
        </div>
    </div>


    <div class="right_row">

        <div class="row">
            <?php echo $form->labelEx($model,'main'); ?>
            <?php echo $form->dropDownList($model,'main',array(0=>Yii::t('main', 'Ні'), 1=>Yii::t('main', 'Так'))); ?>
            <?php echo $form->error($model,'main'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'category_id'); ?>
            <?php echo $form->dropDownList($model, 'category_id', CHtml::listData(NewsCategory::model()->findAll(array('order' => 'name_uk ASC')), 'id', 'name_uk'), array('empty'=>'Вiбiр категорii')) ; ?>
            <?php echo $form->error($model,'category_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'region'); ?>
            <?php echo $form->dropDownList($model,'region',
                array(
                    'Прилуки'=>Yii::t('main', 'Прилуки'),
                    'Нежин'=>Yii::t('main', 'Нежин'),
                    'Новгород-Северский'=>Yii::t('main', 'Новгород-Северский')
                ),
                array('empty'=>'додайте регіон, якщо такий є'));
            ?>
            <?php echo $form->error($model,'region'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'on_index'); ?>
            <?php echo $form->dropDownList($model,'on_index',array(0=>Yii::t('main', 'Ні'), 1=>Yii::t('main', 'Так'))); ?>
            <?php echo $form->error($model,'on_index'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'rss'); ?>
            <?php echo $form->dropDownList($model,'rss',array(0=>Yii::t('main', 'Ні'), 1=>Yii::t('main', 'Так'))); ?>
            <?php echo $form->error($model,'rss'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'tags'); ?>
            <?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'tags'); ?>
        </div>

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

    <div class="clear"></div>

    <div class="text-areas">
        <div class="row">
            <?php echo $form->labelEx($model,'description_uk'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model'=>$model,
                'attribute'=>'description_uk',
                'config'=>array(
                    'filebrowserUploadUrl' => $this->createUrl('/admin/upload/index/'),//Конфиг вставлять сюда
                ),
            ));
            ?>
            <?php echo $form->error($model,'description_uk'); ?>
        </div>
        <?php if(!$model->isNewRecord): ?>
            <div class="row">
                <?php echo $form->labelEx($model,'description_ru'); ?>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                    'model'=>$model,
                    'attribute'=>'description_ru',
                    'config'=>array(
                        'filebrowserUploadUrl' => $this->createUrl('/admin/upload/index/'),//Конфиг вставлять сюда
                    ),
                ));
                ?>
                <?php echo $form->error($model,'description_ru'); ?>
            </div>
        <?php endif; ?>
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
            url: "'.Yii::app()->createUrl("/admin/upload/upload").'",
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
            url: "'.Yii::app()->createUrl("/admin/upload/crop").'",
            data: data,
            contentType: false,
            processData: false,
            success: function(html) {
                $("#images").html(html);
            }
        }).done(function(){

        });
    });

    $(document).ready(function() {
        if($("#News_title_ru").length > 0){
            changeCount($("#News_title_ru"), $("#title_ru_count"));
            changeCount($("#News_title_uk"), $("#title_uk_count"));
        }
        else{
        changeCount($("#News_title_uk"), $("#title_uk_count"));
        }
    });


    $("#News_title_ru").keyup(function(){
        changeCount($("#News_title_ru"), $("#title_ru_count"));
    });
    $("#News_title_uk").keyup(function(){
        changeCount($("#News_title_uk"), $("#title_uk_count"));
    });

    function changeCount(selector, container)
    {
        if(selector && container){
        container.html(120 - selector.val().length);
        }
    }
',CClientScript::POS_END); ?>