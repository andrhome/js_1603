
<article class="val-column-left">
    <?php if(empty($searchNews->data) && empty($searchPhotos->data) && empty($searchVideos->data)): ?>

        <div class="forBlogH3">
            <h3><?= Yii::t('main', 'Результати пошуку'); ?></h3> <span class="fa fa-search-minus"></span>
        </div>
        <div class="new-class">
            <?= Yii::t('main', 'Нічого не знайдено'); ?>
        </div>

    <?php endif; ?>

    <?php if(!empty($searchNews->data)): ?>
    
    <h3 class="val-title-uppercase-with-line">
        <span> <?=Yii::t('main', 'Результати пошуку');?> </span>
        <?= CHtml::link(Yii::t('main', 'Новини'), array('/site/allNews')); ?>
     </h3>

    <div class="val-outer-line-news">
        <div class="val-gen-news-column -category">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$searchNews,
                'ajaxUpdate'=>true,
                'itemView'=>'_category',
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
                'sortableAttributes'=>array(
                    'rating',
                    'create_time',
                ),
                'itemsCssClass'=>'category',
            ));
            ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($searchPhotos->data)): ?>
         <h3 class="val-title-uppercase-with-line">
            <span> <?=Yii::t('main', 'Результати пошуку');?> </span>
            <?= CHtml::link(Yii::t('main', 'Фоторепортажі'), array('/site/photos')); ?>
         </h3>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$searchPhotos,
            'itemView'=>'_albums',
            'template'=>'{items}{pager}',
            'pager'=>array(
                'lastPageLabel'=>'>>',
                'nextPageLabel'=>'>',
                'prevPageLabel'=>'<',
                'firstPageLabel'=>'<<',
                'class'=>'CLinkPager',
                'header'=>false,
                'cssFile'=>false,
                'htmlOptions'=>array('class'=>'pager'),
            ),
            'sortableAttributes'=>array(
                'rating',
                'create_time',
            ),
            'pagerCssClass'=>'pager',
            'itemsCssClass'=>'photoBlock',
        ));
        ?>
    <?php endif; ?>
    <?php if(!empty($searchVideos->data)): ?>
     <h3 class="val-title-uppercase-with-line">
        <span> <?=Yii::t('main', 'Результати пошуку');?> </span>
        <?= CHtml::link(Yii::t('main', 'Відеосюжети'), array('/site/videos')); ?>
     </h3>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$searchVideos,
            'ajaxUpdate'=>true,
            'itemView'=>'_video',
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
            'sortableAttributes'=>array(
                'rating',
                'create_time',
            ),
            'itemsCssClass'=>'videoBlockGalery',
        ));
        ?>
    <?php endif; ?>
</article>