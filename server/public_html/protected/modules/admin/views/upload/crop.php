<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 10.09.14
 * Time: 0:26
 */
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/fc-cropresizer.js',
    CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl.'/css/fc-cropresizer.css');
?>

<?php Yii::app()->clientScript->registerScript('crop',
    '
      cropresizer.getObject("crop").init({
            cropWidth : 200,
            cropHeight : 154,
            onUpdate : function() {}
        });


    ', CClientScript::POS_END
); ?>

<?= CHtml::image(Yii::app()->baseUrl.'/images/news-image.jpg', 'image', array('id'=>'crop')); ?>