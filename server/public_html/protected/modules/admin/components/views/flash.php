<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div class="info errorMessage" style="display:none;">
        <?php  echo Yii::app()->user->getFlash('error'); ?>
        <?php echo $form->errorSummary($model); ?>
    </div>
    <?php Yii::app()->clientScript->registerScript(
        'myShowHideEffect',
        '$(".info").fadeIn(2000, function(){$(".info").animate({opacity: 1.0}, 2000).fadeOut("slow");});',
        CClientScript::POS_READY
    ); ?>
<?php elseif (Yii::app()->user->hasFlash('success')): ?>
    <div class="info successMessage" style="display:none;">
        <?php  echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php Yii::app()->clientScript->registerScript(
        'myShowHideEffect',
        '$(".info").fadeIn(2000, function(){$(".info").animate({opacity: 1.0}, 2000).fadeOut("slow");});',
        CClientScript::POS_READY
    ); ?>
	<?php if(Yii::app()->controller->id == 'news'): ?>
		<?php Yii::app()->clientScript->registerScript(
			'redirect',
			'setTimeout(function(){ window.location.href = "http://val.ua/admin"},1000);',
			CClientScript::POS_READY
		); ?>
	<?php endif; ?>
<?php endif; ?>