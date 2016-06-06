<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 31.08.14
 * Time: 15:08
 */ ?>
<?php foreach($model as $news): ?>
    <div class="forNewsFooter">
        <?= CHtml::image(Yii::app()->baseUrl.'/uploads/news/full/'.$news->image); ?>
        <div class="descriptionFooter">
            <h5><?= Yii::app()->controller->getShortDescription((Yii::app()->language == 'ru') ? $news->title_ru : $news->title_uk, 40).'...'; ?></h5>
            <p><?= Yii::app()->controller->getShortDescription((Yii::app()->language == 'ru') ? $news->description_ru : $news->description_uk, 100).'...'; ?></p>
        </div>
    </div>
<?php endforeach; ?>