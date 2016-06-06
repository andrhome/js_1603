<?php
/* @var $this CabinetController */
/* @var $model Articles */
?>


        <div class="privat_add">
            <div class="forBlogH3">
                <h3><?= Yii::t('main', 'Особистий кабінет'); ?></h3> <span class="glyphicon glyphicon-play"></span> <?= Yii::t('main', 'Редагування поста'); ?>
            </div>
            <?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>