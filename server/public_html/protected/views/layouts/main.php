<!DOCTYPE html>
<html>
<head>
    <title><?= $this->pageTitle; ?></title>
    <?php if(Yii::app()->language == 'uk'): ?>
        <meta http-equiv="Content-Language" content="ua" />
    <?php else: ?>
       <meta http-equiv="Content-Language" content="ru" />
    <?php endif; ?>
    <meta name="Description" content="<?= $this->pageDescription; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=1280, initial-scale=-1">
    <meta name="author" content="Високий Вал">
    <meta name="copyright" content="copyright ©2005-2015 Високий Вал" /> 
    <meta content="<?= $this->pageDescription; ?>" name="description">
    <meta property = "og:title" content = "<?= $this->pageTitle; ?>" />
    <meta property = "og:type" content = "website" />
    <meta property="article:author" content="Високий Вал">
    <meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
    <meta property = "og:description" content = "<?= $this->pageDescription; ?>" />  
    <meta property="og:site_name" content="Val.ua" />
    <?php foreach ($this->metaAttributes as $value) {
        echo $value;
    } ?>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
    <meta name="twitter:title" content="<?= $this->pageTitle; ?>">
    <meta name="twitter:description" content="<?= $this->pageDescription; ?>">
    <meta name="twitter:site" content="Val.ua">
    <meta name="google-site-verification" content="ZKjQqhmkC9GTAIJI6KoY8DGJFhe_uTALVdqMQ2GrwZo" />
    <link rel="Shortcut Icon" type="image/x-icon" href="<?= Yii::app()->baseUrl; ?>/images/favicon.ico">
    <link rel="alternate" href="http://val.ua/feed/rss/" type="application/xml" title="Val.ua Rss">
    <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/public/prodaction/bundle.min.css">
</head>
<body>

    <!-- Flash message -->
    <?php $this->widget('application.components.widgets.FlashWidget'); ?>
    <!-- End Flash message -->
    <div class="val-modal-login-reg-outer">
        <div class="val-cell-modal-outer">
            <div class="val-content-for-login -login-modal">
                <span class="val-close-modals"></span>
                <?php $this->widget('application.components.widgets.AuthWidget'); ?>
            </div>
            <div class="val-content-for-login -reg-modal">
                <span class="val-close-modals"></span>
                <?php $this->widget('application.components.widgets.RegistrationWidget'); ?>
            </div>
             <div class="val-content-for-login -about-modal">
                <span class="val-close-modals"></span>
                <?php $this->widget('application.components.widgets.AboutWidget'); ?>
            </div>
        </div>
    </div>
    <section class="val-all-outer">
        <section class="val-header-outer-block">
            <header class="val-header">
                <div class="val-top-line">
                    <div class="val-outer-left-button">
                        <div class="val-button-menu"><span>Меню</span></div>
                        <div class="val-button-search">
                            <span>Поиск</span>
                            <div class="val-search-modal">
                                <?php
                                $this->beginWidget('CActiveForm', array(
                                    'id'=>'srhiv',
                                    'method'=>'get',
                                    'action'=>array('/site/search'),
                                ));
                                ?>
                                    <?= CHtml::textField('find', '', array('class'=>'val-form-control', 'placeholder'=>Yii::t('main', 'Запит...'))); ?>
                                    <?= CHtml::dropDownList('category',
                                        '',
                                        CHtml::listData( NewsCategory::model()->findAll(),'id', Yii::app()->language == 'ru' ? 'name_ru' : 'name_uk') + array('video'=>Yii::t('main','Відео'), 'photo'=>Yii::t('main','Фото')),
                                        array('class'=>'val-form-control', 'placeholder'=>Yii::t('main', 'Шукати...'), 'empty'=>Yii::t('main', 'Всі категорії'))
                                    ); ?>
                                    <?= CHtml::textField('publishDate', '', array('class'=>'val-form-control', 'placeholder'=>Yii::t('main', 'Формат: '.date('Y-m-d').''))); ?>
                                    <?= CHtml::tag('button',
                                        array('class' => 'button -gen-green'), 'Шукати'
                                        ); ?>
                                <?php $this->endWidget(); ?>
                            </div>
                        </div> 
                        <?php $this->widget('application.components.widgets.LanguageSelector'); ?>
                    </div>
                    <div class="val-outer-social-button">
                        <ul>
                            <li>
                                <a href="#" class="val-twitter"></a>
                            </li>
                            <li>
                                <a href="#" class="val-vk"></a>
                            </li>
                            <li>
                                <a href="#" class="val-g"></a>
                            </li>
                            <li>
                                <a href="#" class="val-youtube"></a>
                            </li>
                            <li>
                                <a href="#" class="val-fb"></a>
                            </li>
                            <li>
                                <a href="#" class="val-rss"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="val-outer-right-button">
                        <?php if(Yii::app()->user->isGuest): ?>
                            <button class="button -gen-green -login" data-attr="-login-modal"><?= Yii::t('main', 'Вхід'); ?></button>
                            <button class="button -gen-blue -registration" data-attr="-reg-modal"><?= Yii::t('main', 'Реєстрація'); ?></button>
                        <?php else: ?>
                            <a href="<?= Yii::app()->createUrl('/blog/cabinet/index'); ?>" class="button -gen-blue"><?= Yii::t('main', 'Особистий кабінет'); ?></a>
                            <a href="<?= Yii::app()->createUrl('/site/logout'); ?>" class="button -gen-green" data-attr="-login-modal"><?= Yii::t('main', 'Вихід'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="val-logo-line">
                    <?= CHtml::link(CHtml::image(Yii::app()->baseUrl.'/public/images/logo.png', 'logo'),array('/site/index')); ?>
                </div>
                <div class="val-widget-line">
                    <ul>
                        <li>
                            <span class="val-data-today"><?= $this->getCurrentDate(); ?></span>
                        </li>
                        <li>
                            <a href="#" class="val-redaction -about" data-attr="-about-modal" >Редакция</a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->createUrl('/site/market'); ?>" class="val-market">Реклама</a>
                        </li>
                        <li>
                            <div class="-with-before -currency-val" href="#">
                                <span class="val-currency-text">Валюта</span>
                            </div>
                        </li>
                        <li>
                            <div class="outer-for-weather"></div>
                        </li>
                    </ul>
                    
                </div>
                <div class="val-menu-line">
                    <ul class="val-menu-list">
                        <? foreach ($this->menu as $key => $menu) : ?>
                            <? 
                                $classie = '';
                                if($this->categoryId == $menu->id) {$classie = '-val-active-menu';}
                            ?>
                            <? if($menu->id == 10) continue; ?>
                            <li><?= CHtml::link(Yii::t('main', $menu->name_uk), array('/site/category', 'id'=>$menu->id), array('class' => $classie)); ?></li>
                       <? endforeach; ?>
                            <!-- <li><?= CHtml::link(Yii::t('main', 'Блоги'), array('/blog/default/index')); ?></li> -->
                            <li><?= CHtml::link(Yii::t('main', 'Мультимедіа'), array('/site/Multimedia')); ?></li>
                    </ul>
                </div>
            </header>   
                
        </section>
        <section class="val-outer-news-block">
            <?= $content; ?>
        </section> 
        <footer class="val-footer">
            <div class="val-inner-footer">
                <ul class="val-footer-list">
                    <li class="val-footer-for-logo-first-container">
                       <div class="val-text-footer">
                            <?=CHtml::image(Yii::app()->baseUrl.'/public/images/logo_footer.png', 'val-logo-footer'); ?>
                             <span class="val-content-text">При будь-якому використанні матеріалів гіперпосилання на <a href="/">Val.ua</a> є обов'язковим. </span>
                             <span class="val-content-text">Передрук в газетах і електронних ЗМІ - виключно за наявності письмової угоди з Редакцією! </span>
                             <span class="val-content-text">E-mail редакції: <a href="mailto:news@val.ua">news@val.ua</a></span>
                             <div class="val-phones">
                                 <span>Тел.Чернігiв: <a href="#">931-931</a> </span>
                                 <span>Тел.Киiв: <a href="#">232-79-79</a> </span>
                                 <span>Тел.Нью-Йорку: <a href="#">+1-917-200-9214</a> </span>
                             </div> 
                        </div>  
                    </li>
                    <li class="val-footer-second-container">
                        <p class="val-link-footer"><?= CHtml::link(Yii::t('main', 'Політика'), array('/site/category', 'alias'=>'politics')); ?></p>
                        <p class="val-link-footer"><?= CHtml::link(Yii::t('main', 'Суспільство'), array('/site/category', 'alias'=>'social')); ?></p>
                        <p class="val-link-footer"><?= CHtml::link(Yii::t('main', 'Всi новини'), array('/site/allNews')); ?></p>
                        <p class="val-link-footer"><?= CHtml::link(Yii::t('main', 'Фоторепортажi'), array('/site/photos')); ?></p>
                        <p class="val-link-footer"><?= CHtml::link(Yii::t('main', 'Вiдеоматерiали'), array('/site/videos')); ?></p>
                        <p class="val-link-footer"><?= CHtml::link(Yii::t('main', 'Блоги'), array('/blog/default/index')); ?></p>
                    </li>
                     <li class="val-footer-third-container">
                       <h5>Вiдповiдальнiсть та зобов`язання</h5>
                       <p>Редакція може не поділяти точку зору авторів і не несе відповідальності за зміст републікованих матеріалів.</p>
                       <p><b>ШАНОВНІ КОМЕНТАТОРИ!</b> Редакція веб-сайту не має намірів обмежувати свободу слова, але залишає за собою право видаляти висловлювання з уживанням нецензурної лексики та образ на адресу авторів матеріалів і їх фігурантів.</p>
                       <p>Високий Вал у соцiальних мережах: </p>
                      <div class="val-soc-in-footer">
                          <div class="val-outer-social-button">
                                <ul>
                                    <li>
                                        <a href="#" class="val-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="val-vk"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="val-g"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="val-youtube"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="val-fb"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="val-rss"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>  
            <div class="val-development">   
                <span class="val-text-development">Разработка сайта</span>
                <a href="http://4side.in.ua">
                    <?=CHtml::image(Yii::app()->baseUrl.'/public/images/4side.png', '4side development')?>
                </a>
            </div>          
        </footer>
    </section>
    <? Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/public/js/_lib/pikaday.js', CClientScript::POS_END);?>
    <? Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/public/prodaction/bundle.min.js', CClientScript::POS_END);?>
    <script>
    window.addEventListener("DOMContentLoaded", function(){
        (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("create","UA-61883338-1","auto");ga("send","pageview");
    })
    </script>
</body>
</html>