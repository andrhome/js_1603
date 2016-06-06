<?php
/* @var $allNews News */
?>
<?php 
    $dateNow = (new DateTime())->format('Y-m-d');
?>
<div class="val-bloger-top">
    <div class="val-text-article-text">
        <a href="/blog/default/post/<?=$blogger['article_id']?>/uk.html"><?=$blogger['article_title'];?></a>
    </div>
    <div class="val-bloger-info">
        <img class="val-bloger-avatar" src="/uploads/users/avatars/<?=$blogger['user_avatar'];?>" alt="">
        <div class="val-bloger-info-description">
            <span class="val-content-news-data"><?= ($dateNow == date('Y-m-d', strtotime($blogger['article_date']))) ? date('H:i', strtotime($news->date)) : intval(date('d', strtotime($blogger['article_date']))).' '.Yii::app()->controller->getMonth($blogger['article_date']).' '.date('Y', strtotime($blogger['article_date'])); ?></span>
            <a href="/blog/default/bloger/<?=$blogger['user_id']?>/uk.html" class="val-info-bloger-name"><?=$blogger['user_name'];?></a>
            <p class="val-info-bloger-prof"><?=$blogger['user_profession'];?></p>
        </div>
    </div>
</div>