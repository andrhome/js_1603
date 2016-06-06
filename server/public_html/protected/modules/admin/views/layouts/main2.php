<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <?php //Yii::app()->clientScript->registerPackage('bootstrap');?>
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/all.css" media="screen, projection" />
    <script type="text/javascript" src="asset/js/accordion.jquery.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
<div id="wrapper">

<div id="header">
    <h1><a href="dashboard.html"><?php echo 'kyky'; ?></a></h1>

    <a href="javascript:;" id="reveal-nav">
        <span class="reveal-bar"></span>
        <span class="reveal-bar"></span>
        <span class="reveal-bar"></span>
    </a>
</div> <!-- #header -->

<div id="sidebar">

        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array(
                    'label'=>'<span class="icon-home"></span>Главная',
                    'url'=>array('/admin/default/index'),
                    'itemOptions'=>array('class'=>'nav'),
                ),
                array(
                    'label'=>'<span class="icon-article"></span>Новости',
                    'url'=>array('#'),
                    'itemOptions'=>array('class'=>'nav'),
                    'submenuOptions'=>array('class'=>'subNav'),
                    'items'=>array(
                        array(
                            'label'=>'Редактировать новости',
                            'url'=>array('/admin/news/admin'),
                        ),
                        array(
                            'label'=>'Добавить новость',
                            'url'=>array('/admin/news/create'),
                        ),
                    ),
                ),
                array(
                    'label'=>'Contact',
                    'url'=>array('/site/contact'),
                    'itemOptions'=>array('class'=>'nav')
                ),
                array(
                    'label'=>'<span class="icon-trash-stroke"></span>Товары',
                    'url'=>array('#'),
                    'itemOptions'=>array('class'=>'nav'),
                    'submenuOptions'=>array('class'=>'subNav'),
                    'items'=>array(
                        array(
                            'label'=>'Редактировать товары',
                            'url'=>array('/admin/product/admin'),
                        ),
                        array(
                            'label'=>'Добавить товар',
                            'url'=>array('/admin/product/create'),
                        ),
                    ),
                ),
                array(
                    'label'=>'<span class="icon-list"></span>Категории товаров',
                    'url'=>array('#'),
                    'itemOptions'=>array('class'=>'nav'),
                    'submenuOptions'=>array('class'=>'subNav'),
                    'items'=>array(
                        array(
                            'label'=>'Редактировать категории',
                            'url'=>array('/admin/category/admin'),
                        ),
                        array(
                            'label'=>'Добавить категорию',
                            'url'=>array('/admin/category/create'),
                        ),
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'id'=>'mainNav',
            ),
            'encodeLabel'=>false,
        )); ?>

</div> <!-- #sidebar -->

    <?php echo $content; ?>


<div id="topNav">
    <ul>
        <li><?php echo CHtml::link('Выйти ('.Yii::app()->user->name.')',array('default/logout')); ?></li>
    </ul>
</div> <!-- #topNav -->

</div> <!-- #wrapper -->

<div id="footer">
    Copyright &copy; 2013, Все права защищены.
</div>



</div><!-- page -->

</body>
</html>
