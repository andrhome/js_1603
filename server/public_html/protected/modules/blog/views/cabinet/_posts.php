<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21.08.14
 * Time: 16:03
 */
?>
<div class="postOneIn">
    <p> &nbsp; <span class="glyphicon glyphicon-calendar"></span></span> &nbsp; <?= date('d-m-Y H:m', strtotime($data->date)); ?>&nbsp;&nbsp;<span class="glyphicon glyphicon-comment"></span> &nbsp;Комментарии: 12  &nbsp;&nbsp;<span class="glyphicon glyphicon-eye-open"></span> &nbsp;<?= Yii::t('main', 'Ререглядів'); ?>: <?= $data->views; ?></p>
    <h4><?= CHtml::link($data->title, array('/blog/default/post', 'id'=>$data->id)); ?></h4>
    <p Class="editDel">
        <?= CHtml::link('<span class="glyphicon glyphicon-pencil"></span>'.Yii::t('main', 'Редагувати'), array('/blog/cabinet/update', 'id'=>$data->id)); ?>
        &nbsp;
        <span class="glyphicon glyphicon-remove"></span>
        <?= CHtml::ajaxLink(Yii::t('main', 'Видалити'), array('/blog/cabinet/delete', 'id'=>$data->id),
            array(
                //'update'=>'#req_res_loading',
                'beforeSend' => 'function() {
                    $("#maindiv").addClass("loading");
                }',
                'complete'=>'function(data){
                    $.fn.yiiListView.update("userList");
                }',
            ),
            array('confirm' => Yii::t('main', 'Ви дійсно хочете видалити пост?'), 'id'=>'post_id_'.$data->id,
            )); ?>
    </p>

</div>

