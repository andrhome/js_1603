<?php
?>
<div class="postOneIn">
    <p class="-date-italic"> &nbsp;&nbsp; <span class="fa fa-calendar"></span>&nbsp;&nbsp;<b><?= date('d-m-Y H:m', strtotime($data->date)); ?></b>&nbsp;&nbsp;
        <span class="fa fa-eye"></span> &nbsp;<?= Yii::t('main', 'Переглядів'); ?>: <?= CHtml::encode($data->views); ?></p>
    <h4>
        <?= CHtml::link($data->title, array('/blog/default/post', 'id'=>$data->id)); ?>
    </h4>
    <?php if(Yii::app()->user->role == 'admin'): ?>
        <div class="delBlogersAdmin">
            <?= CHtml::link(Yii::t('main', 'Редагувати').'<span class="fa fa-pencil"></span>', array('/blog/cabinet/update', 'id'=>$data->id)); ?>
            <?= CHtml::ajaxLink(Yii::t('main', 'Видалити').'<span class="fa fa-trash"></span>', array('/blog/cabinet/delete', 'id'=>$data->id),
                array(
                    'beforeSend' => 'function() {
                        $("#maindiv").addClass("loading");
                    }',
                    'complete'=>'function(data){
                        $.fn.yiiListView.update("userList");
                    }',
                ),
                array(
                    'confirm' => Yii::t('main', 'Ви дійсно хочете видалити пост?'),
                    'id'=>'post_id_'.$data->id,
                )
            );
            ?>
        </div>
    <?php endif; ?>
</div>