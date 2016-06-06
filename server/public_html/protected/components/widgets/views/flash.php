<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div class="val-alert" style="display: none">
        <a href="#" class="val-flash-close" data-dismiss="alert">&times;</a>
        <p><?=Yii::app()->user->getFlash('error'); ?></p>
    </div>
<?php elseif (Yii::app()->user->hasFlash('success')): ?>
    <div class="val-alert" style="display: none">
        <a href="#" class="val-flash-close" data-dismiss="alert">&times;</a>
        <p><?=Yii::app()->user->getFlash('success'); ?></p>
    </div>
<?php endif; ?>
<?php
Yii::app()->clientScript->registerScript(
    'myShowHideEffect',
    '
        var flash = document.querySelector(".val-alert");
        if(flash){
            flash.style.display = "block";
            document.querySelector(".val-flash-close").addEventListener("click", function(){
                this.parentNode.style.display = "none";
            })
        } 
        
    ',
    CClientScript::POS_READY
); ?>