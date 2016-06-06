<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="all_gen">
        <?= $content; ?>
    </div>
    <div class="sidebar_right">
        <div class="soc">
            <div class="fb">
                <?= CHtml::image(Yii::app()->baseUrl.'/images/social_facebook.png', 'facebook'); ?>
                <h3>12,589</h3>
                <p><?= Yii::t('main', 'друзі'); ?></p>
            </div>
            <div class="twitt">
                <?= CHtml::image(Yii::app()->baseUrl.'/images/social_twitter.png', 'twitter'); ?>
                <h3>25,457</h3>
                <p><?= Yii::t('main', 'читачі'); ?></p>
            </div>
            <div class="rss">
                <?= CHtml::image(Yii::app()->baseUrl.'/images/social_feeds.png', 'rss'); ?>
                <h3>56,896</h3>
                <p><?= Yii::t('main', 'підписники'); ?></p>
            </div>
        </div>
        <div class="top_news_blogs">
            <h3 class="top_h3">
                <?= Yii::t('main', 'Популярні пости'); ?>
            </h3>
            <?php $this->widget('application.modules.blog.components.widgets.MostPopularWidget'); ?>
        </div>
        <div class="top_news">
            <h3 class="top_h3">
                <?= Yii::t('main', 'Топ Блогери'); ?>
            </h3>
            <?php $this->widget('application.components.widgets.TopBlogersWidget'); ?>
            <?= CHtml::link(Yii::t('main', 'Перейти до Vip-блогів'), array('/blog/default/index'), array('class'=>'btn btn-danger in_blogs_button_gen')); ?>
        </div>
    </div>
<?php $this->endContent(); ?>