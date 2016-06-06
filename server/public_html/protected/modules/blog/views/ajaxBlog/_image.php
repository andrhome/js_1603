<?php
    echo CHtml::image(Yii::app()->baseUrl.'/uploads/temp/'.$image->name, 'new image', array('id'=>'photo1', 'data-name'=>$image->name));
?>