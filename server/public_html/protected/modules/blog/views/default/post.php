<div class="forBlogH3">
    <h3>блоги</h3> <span class="fa fa-user"></span>
    <?= CHtml::link($user->name, array('/blog/default/bloger', 'id'=>$user->id)); ?> 
</div>
<div class="delBlogersAdminPost"><a href="">Редактировать <span class="fa fa-pencil"></span></a> <a href="">Удалить <span class="fa fa-trash"></span></a></div>
<div class="oneNewsBlock">
    <h3 class="title">
        <?= CHtml::encode($model->title); ?>
    </h3>
    <div class="dateTimeSocial">
        <div class="dateTime">
            <p><?= date('d.m.Y | H:m', strtotime($model->date)); ?></p>
        </div>
        <div class="Social">
           <div class="share42init" data-url="" data-title="" data-image=""></div>
        </div>

    </div>
    <div class="textOneNews">
        <?=preg_replace('/<iframe width="(.*?)"/i', '<iframe width="100%"',strip_tags($model->description, '<a><p><iframe><br><b><span><img>'));?>
    </div>

    <div class="dateTimeSocial">
        <div class="dateTime">
            <p>Автор: <?= CHtml::link($user->name, array('/blog/default/bloger', 'id'=>$user->id)); ?></p>
        </div>
       <div class="Social">
           <div class="share42init" data-url="" data-title="" data-image=""></div>
        </div>
    </div>
</div>

<div class="forBlogH3">
    <h3><?= Yii::t('main', 'Останні пости'); ?></h3> <span class="fa fa-user"></span> <a>в блогах</a>
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

<div class="blogSlider">
    <div class="forBlogH3">
        <h3><?= Yii::t('main', 'ТОП блогери'); ?></h3> <span class="fa fa-user"></span> <a>блоги</a>
    </div>
     <div class="val-outer-blog-slider">
        <span class="val-blog-controls val-next" data-arrow="next"></span>
        <span class="val-blog-controls val-prev" data-arrow="prev"></span>
        <div class="val-inner-blog-slider">
        <span class="val-slide-preloads"></span>
            <ul class="val-list-blog-slider">
            <?php foreach($popularBlogers as $bloger): ?>
                <li>
                    <a href="#">
                        <img src="<?=Yii::app()->baseUrl.'/uploads/users/avatars/'.$bloger->avatar;?>" alt="">
                        <div class="val-outer-text-description">
                            <div class="-cell">
                                <h3><?=$bloger->name;?></h3>
                                
                                <?php $articles = Articles::model()->findAll(array('condition'=>'author_id = :id', 'params'=>array(':id'=>$bloger->id), 'limit'=>1, 'order'=>'date DESC')); ?>
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


<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/share42.js',CClientScript::POS_END, array('defer'=>true)); ?>