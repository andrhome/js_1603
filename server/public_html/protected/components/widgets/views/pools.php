<?php
/* @var $model Pools */

if (!empty($model)): ?>
<div class="vote">
    <h3 class="top_h3"><?= Yii::t('main', 'голосування'); ?></h3>
    <?php foreach($model as $pool): ?>
    <h4><?= $pool->name; ?></h4>
    <div class="pools-res">
        <?php if(!PoolsIp::model()->count('ip = :ip AND pool_id = :id', array(':ip'=>$_SERVER['REMOTE_ADDR'], ':id'=>$pool->id))): ?>
            <form method="POST" id="formx" action="javascript:void(null);" onsubmit="call()">
                <?php foreach($pool->answers as $answer): ?>

                    <div class="radio">
                        <label>
                            <?= CHtml::ajaxLink('<input name="" type="radio">'.$answer->name,
                                array('/ajax/pools'),
                                array(
                                    'type' => 'POST',// method
                                    'data'=>array('update'=>TRUE, 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken, 'value'=>$answer->id, 'poolId'=>$pool->id),// DATA
                                    'update' => '.pools-res',
                                    'complete' => 'function(){
                                        $(".line").each(
                                            function()
                                            {
                                                var percentage = $(this).data("wid");
                                                $(this).css({width: percentage}).animate({width: percentage}, "slow");
                                            });
                                    }',

                                    'success'=> 'function(html){
                                        jQuery(".pools-res").html(html);
                                    }
                                    ')
                            ); ?>
                        </label>
                    </div>

                <?php endforeach; ?>
            </form>
        <?php else: ?>
            <div class="result_s">
                <h4><?= Yii::t('main', 'Результати голосування'); ?></h4>
                <?php foreach($pool->answers as $answer): ?>
                    <div class="in_res">
                        <p><?= $answer->name; ?>&nbsp; - &nbsp; <span><?= round($answer->hits*100/$pool->hits, 1).'%'; ?></span></p>
                        <div class="line" data-wid="<?= ($answer->hits*100/$pool->hits).'%'; ?>"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
<?php
Yii::app()->clientScript->registerScript('loading', '
    $( document ).ready(function() {

        $(".line").ajaxComplete(function(){
            //console.log("complete");
        });

        function animateResults()
        {
            $(".line").each(
                function()
                {
                    var percentage = $(this).data("wid");
                    $(this).css({width: percentage}).animate({width: percentage}, "slow");
                });
        }
        animateResults();
    });
', CClientScript::POS_READY);
?>
</div>
<? endif; ?>