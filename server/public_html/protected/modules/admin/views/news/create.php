<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
    Yii::t('main','Управление').': '.Yii::t('main', 'Новостями')=>array('index'),
	Yii::t('main', 'Добавление новой записи'),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>