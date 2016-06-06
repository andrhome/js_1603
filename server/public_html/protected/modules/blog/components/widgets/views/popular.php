<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 22.08.14
 * Time: 1:25
 */
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#top_mounth" data-toggle="tab">Топ месяца</a></li>
    <li><a href="#top_week" data-toggle="tab">Топ недели</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="top_mounth">
        <?php foreach($month as $post): ?>
            <div class="one_top_news">
                <h4><?= $post->author->name; ?></h4>
                <p><?= CHtml::link($post->title, array('/blog/default/post', 'id'=>$post->id)); ?></p>
                <p class="date-side"> <span class="glyphicon glyphicon-calendar"></span> &nbsp; <?= $post->date; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="tab-pane" id="top_week">
        <?php foreach($week as $post): ?>
            <div class="one_top_news">
                <h4><?= $post->author->name; ?></h4>
                <p><?= CHtml::link($post->title, array('/blog/default/post', 'id'=>$post->id)); ?></p>
                <p class="date-side"> <span class="glyphicon glyphicon-calendar"></span> &nbsp; <?= $post->date; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>