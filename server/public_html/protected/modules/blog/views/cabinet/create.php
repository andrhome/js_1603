<?php
/* @var $this CabinetController */
/* @var $model Articles */
?>

<div class="all_gen">
    <div class="privat_add">
        <h3>
            <?= CHtml::link('&larr;'.Yii::t('main', 'До особистого кабінету').'<span class="glyphicon glyphicon-pencil"></span>', array('/blog/cabinet/index')); ?>&#183;&#183;&#183;
            <?= Yii::t('main', 'Додавання поста'); ?>
        </h3>
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>