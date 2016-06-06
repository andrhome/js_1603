<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/main.css">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-60551612-1', 'auto');
      ga('send', 'pageview');
    </script>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner top-nav">
        <div class="container-fluid">
            <ul class="nav pull-right">
                <li><?php echo CHtml::link('<i class="icon-off icon-white"></i>Выйти ('.Yii::app()->user->name.')',array('default/logout')); ?></li>
            </ul>
        </div>
    </div>
</div>
<div id="sidebar">
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array(
                'label'=>'<i class="icon-home"></i>'.Yii::t('main', 'Главная'),
                'url'=>array('/admin/default/index'),
            ),
            array(
                'label'=>'<i class="icon-file"></i>'.Yii::t('main', 'Новости'),
                'url'=>array('/admin/news/index'),
            ),
            array(
                'label'=>'<i class="icon-picture"></i>'.Yii::t('main', 'Галерея'),
                'url'=>array('#'),
                'items'=>array(
                    array(
                        'label'=>'<i class="icon-camera"></i>'.Yii::t('main', 'Фото'),
                        'url'=>array('/admin/photo/index'),
                    ),
                    array(
                        'label'=>'<i class="icon-film"></i>'.Yii::t('main', 'Видео'),
                        'url'=>array('/admin/video/index'),
                    ),
                ),
            ),
            array(
                'label'=>'<i class="icon-list"></i>'.Yii::t('main', 'Категории'),
                'url'=>array('#'),
                'items'=>array(
                    array(
                        'label'=>'<i class="icon-list"></i>'.Yii::t('main', 'Категории новостей'),
                        'url'=>array('/admin/newsCategory/index'),
                    ),
                    array(
                        'label'=>'<i class="icon-list"></i>'.Yii::t('main', 'Категории фото'),
                        'url'=>array('/admin/photoCategory/index'),
                    ),
                ),
            ),
            array(
                'label'=>'<i class="icon-wrench"></i>'.Yii::t('main', 'Голосование'),
                'url'=>array('/admin/pools/index'),
            ),
            array(
                'label'=>'<i class="icon-film"></i>'.Yii::t('main', 'Стрим'),
                'url'=>array('/admin/streem/index'),
            ),
            array(
                'label'=>'<i class="icon-user"></i>'.Yii::t('main', 'Пользователи'),
                'url'=>array('/admin/user/index'),
                'visible'=>Yii::app()->user->role == 'admin',
            ),
            array(
                'label'=>'<i class="icon-star"></i>'.Yii::t('main', 'Реклама'),
                'url'=>array('/admin/reclame/index'),
                'visible'=>Yii::app()->user->role == 'admin',
            ),
            array(
                'label'=>'<i class="icon-star"></i>'.Yii::t('main', 'Коментарi'),
                'url'=>array('/admin/comments/index'),
                'visible'=>Yii::app()->user->role == 'admin',
            ),
        ),
        'htmlOptions'=>array(
            'class'=>'side-nav accordion_mnu collapsible',
            'id'=>'menu',
        ),
        'encodeLabel'=>false,
    )); ?>
</div>
<div id="main-content">
    <div class="container-fluid">
        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'homeLink'=>CHtml::link(Yii::t('main', 'Главная'),array('/admin/default/index')),
			    'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
        <?php endif?>
        <div class="row-fluid">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<!-- javascript================================================= -->
<?php Yii::app()->clientScript->registerScript('after-crop',
    '
        function init_menu() {
        jQuery(".collapsible ul").hide();
        jQuery(".collapsible li a").click(
            function() {
                var checkElement=$(this).next();
                if((checkElement.is("ul")) && (checkElement.is(":visible"))) { return false; }
                if((checkElement.is("ul")) && (!checkElement.is(":visible"))) {
                    $("#menu ul:visible").slideUp("normal");
                    checkElement.slideDown("normal");
                    return false;
                }
            }
        );
    }
    $(document).ready(function() {init_menu();});
    ', CClientScript::POS_READY
); ?>
<?php Yii::app()->clientScript->registerScript('init_menu','
    function init_menu() {
        jQuery(".collapsible ul").hide();
        jQuery(".collapsible li a").click(
            function() {
                var checkElement=$(this).next();
                if((checkElement.is("ul")) && (checkElement.is(":visible"))) { return false; }
                if((checkElement.is("ul")) && (!checkElement.is(":visible"))) {
                    $("#menu ul:visible").slideUp("normal");
                    checkElement.slideDown("normal");
                    return false;
                }
            }
        );
    }
    $(document).ready(function() {init_menu();});
',CClientScript::POS_END); ?>

<?php Yii::app()->clientScript->registerScript('caterorySelect','
$(document).ready(function(){
	$("#caterorySelect").change(function(){
		var idOne = $(this).find(":selected").data("item");
		var idTwo = $(this).find(":selected").data("target");
		var dataVal = $(this).val();
		$("#cat > div:not(.outerSelect):first").removeAttr("class").fadeOut("slow", function(){
			$(this).addClass(dataVal).fadeIn("slow");
			$(this).children("a").attr("href", "/admin/reclame/update/"+idOne+"/uk.html");
		})
		$("#cat > div:not(.outerSelect):last").removeAttr("class").fadeOut("slow", function(){
			$(this).addClass(dataVal).fadeIn("slow");
			$(this).children("a").attr("href", "/admin/reclame/update/"+idTwo+"/uk.html");
		})			
	});
});
',CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/bootstrap.js',CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/masonry.pkgd.min.js',CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/main.js',CClientScript::POS_END); ?>
</body>
</html>