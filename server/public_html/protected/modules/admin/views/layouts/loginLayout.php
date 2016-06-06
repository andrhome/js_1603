<!DOCTYPE HTML>
<html lang="ru">
<head>

    <title>Canvas Admin - Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php Yii::app()->clientScript->registerPackage('bootstrap');?>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/bootstrap.css">
</head>

<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <div class="branding">
                <div class="logo">
                    <a href="/"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="login-container">
    <div class="well-login">
        <?php echo $content; ?>
    </div>
</div>
</body>
</html>