<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21.08.14
 * Time: 16:03
 */
?>
<div class="all_posts_page">
    <div class="right_all_posts_page">
        <p><span><span class="fa fa-calendar"></span> &nbsp; <?= date('d-m-Y H:m', strtotime($data->date)); ?> | </span> <?= CHtml::encode($data->author->name); ?></p>
        <h4><?= CHtml::link($data->title, array('/blog/default/post', 'id'=>$data->id)); ?></h4>
        <?=preg_replace('/<iframe width="(.*?)"/i', '<iframe width="100%"',strip_tags($data->description, '<a><p><iframe><br><b><span><img>'));?>
        <p class="-date-italic"><?= Yii::t('main', 'Перегляди'); ?>: <?= CHtml::encode($data->views); ?></p>
        <?= CHtml::link(Yii::t('main', 'Читати далі'), array('/blog/default/post', 'id'=>$data->id), array('class'=>'btn btn-danger')); ?>
    </div>
</div>

