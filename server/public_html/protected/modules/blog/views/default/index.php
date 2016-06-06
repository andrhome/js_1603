<?php
/* @var $this DefaultController */
/* @var $lastPosts Articles */
/* @var $allPosts Articles */

?>

<div class="blogSlider">
    <div class="forBlogH3">
        <h3><?= Yii::t('main', 'Блогери'); ?></h3> <span class="fa fa-user"></span> <a><?= Yii::t('main', 'блоги'); ?></a>
    </div>
     <div class="val-outer-blog-slider">
        <span class="val-blog-controls val-next" data-arrow="next"></span>
        <span class="val-blog-controls val-prev" data-arrow="prev"></span>
        <div class="val-inner-blog-slider">
        <span class="val-slide-preloads"></span>
            <ul class="val-list-blog-slider">
            <?php foreach($popularBlogers as $bloger): ?>
                <li>
                 <?php $articles = Articles::model()->findAll(array('condition'=>'author_id = :id', 'params'=>array(':id'=>$bloger->id), 'limit'=>1, 'order'=>'date DESC')); ?>
                     <a href="http://val.ua/blog/default/post/<?=$articles[0]['id']?>/uk.html" target="_blank">
                        <img src="<?=Yii::app()->baseUrl.'/uploads/users/avatars/'.$bloger->avatar;?>" alt="">
                        <div class="val-outer-text-description">
                            <div class="-cell">
                                <h3><?=$bloger->name;?></h3>
                                
                                <?php foreach($articles as $article): ?>
                                    <span><?=$article->date;?></span>
                                    <p><?=$article->title;?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </a>
                </li>
            <? endforeach;?>    
            </ul>
        </div>
    </div>
</div>

<div class="marketInOneCategoryPagebottom">
<noindex>
<?php $this->widget('application.components.widgets.ReclameWidget', array('id'=>47)); ?>
</noindex>
</div>

<div class="bloggers">
    <?php foreach($allBlogers as $bloger): ?>
        <? if(isset($bloger->name) && !empty($bloger->name)): ?>
        <div class="oneBloggers">
            <?= CHtml::image(Yii::app()->baseUrl.'/uploads/users/avatars/'.$bloger->avatar, $bloger->name); ?>
            <?= CHtml::link($bloger->name, array('/blog/default/bloger', 'id'=>$bloger->id)); ?>
        </div>
        <? endif; ?>
    <?php endforeach; ?>
</div>

<div class="forBlogH3">
    <h3><?= Yii::t('main', 'Останні пости'); ?></h3> <span class="fa fa-user"></span> <a><?= Yii::t('main', 'в блогах'); ?></a>
</div>

<div class="collsPost">
    <?php foreach($lastPosts as $i => $post): ?>
        <?php if($i == 0 || $i == 6 || $i == 12) echo '<div>'; ?>
        <a href="<?= $this->createUrl('/blog/default/post', array('id'=>$post->id)); ?>">
            <span class="-date-italic">
                <span class="fa fa-calendar"></span>
                <?= date('d.m.Y', strtotime($post->date)); ?>
            </span>
            <br />
            <p><?= CHtml::encode($post->title); ?></p>
        </a>
        <?php if($i == 5 || $i == 11 || $i == 17) echo '</div>'; ?>
    <?php endforeach; ?>
</div>