<?php
?>

<div class="forBlogH3">
    <h3><?= Yii::t('main', 'Блоги'); ?></h3> <span class="fa fa-user"></span> <a href="#"><?= Yii::t('main', 'Профіль'); ?></a>
</div>

<div class="profileAllSeen noAuth">
    <div class="forAvatarEdit">
    <?= CHtml::image('/uploads/users/avatars/'.$user->avatar, $user->name); ?>
    </div>
    <div class="textProfile">
        <h3><?= CHtml::link($user->name, array('/blog/default/bloger', 'id'=>$user->id)); ?></h3>
        <p>Украина, Киев</p>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?= Yii::t('main', 'Про мене'); ?> <span class="caret"></span></button>
            <div class="dropdown-menu" role="menu">
                <div>
                    <p class="rText"><?= Yii::t('main', 'Стать'); ?>:</p>
                    <p class="lText"><?= $user->userSex; ?></p>
                </div>
                <div>
                    <p class="rText"><?= Yii::t('main', 'Професія'); ?>:</p>
                    <p class="lText"><?= $user->profession; ?></p>
                </div>
                <div class="lastAbout">
                    <p class="rText"><?= Yii::t('main', 'Про себе'); ?>:</p>
                    <p class="lText"><?= $user->description; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="ratingBlock">
        <div class="rating">
            <input type="hidden" name="val" value="2.75"/>
            <input type="hidden" name="vote-id" value="voteID"/>
        </div>
    </div>
    <?php if(Yii::app()->user->role == 'admin'): ?>
        <div class="delBlogersAdmin">
            <?= CHtml::link(Yii::t('main', 'Видалити блогера').'<span class="fa fa-user"></span>', array('/blog/default/delBloger', 'id'=>$user->id), array('confirm' => Yii::t('main', 'Точно видалити блогера?'))); ?>
        </div>
    <?php endif; ?>
</div>

<div class="forBlogH3">
    <h3>Блоги</h3> <span class="fa fa-user"></span> <a href="#"><?= Yii::t('main', 'всі пости автора'); ?></a>
</div>
<div class="blogerOnePost">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$allPosts,
        'ajaxUpdate'=>true,
        'itemView'=>'_bloger_post',
        'template'=>'{items}{pager}',
        'cssFile'=>false,
        'pager'=>array(
            'maxButtonCount' => 5,
            'lastPageLabel'=>'>>',
            'nextPageLabel'=>'>',
            'prevPageLabel'=>'<',
            'firstPageLabel'=>'<<',
            'class'=>'CLinkPager',
            'header'=>false,
            'htmlOptions'=>array('class'=>'sfd'),
        ),
        'pagerCssClass'=>'pager',
        'htmlOptions'=>array(
            'id'=>'userList',
        )
    ));
    ?>
</div>
<div class="forBlogH3">
    <h3><?= Yii::t('main', 'Читайте також'); ?></h3> <span class="fa fa-user"></span> <a><?= Yii::t('main', 'Популярні пости'); ?></a>
</div>



<div class="marginBottom">
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