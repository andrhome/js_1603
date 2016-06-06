<div class="val-language-container">
    <? if( Yii::app()->language == 'uk' ) : ?>
    <?= CHtml::link('Укр',$this->getOwner()->createMultilanguageReturnUrl('uk'),array('class'=>'val-uk-lang -active-lang')); ?>
    <?= CHtml::link('Рус',$this->getOwner()->createMultilanguageReturnUrl('ru'),array('class'=>'val-ru-lang')); ?>
    <? else : ?>
    <?= CHtml::link('Укр',$this->getOwner()->createMultilanguageReturnUrl('uk'),array('class'=>'val-uk-lang')); ?>
    <?= CHtml::link('Рус',$this->getOwner()->createMultilanguageReturnUrl('ru'),array('class'=>'val-ru-lang -active-lang')); ?>
    <? endif; ?>
</div>