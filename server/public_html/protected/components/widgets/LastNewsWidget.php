<?php

class LastNewsWidget extends CWidget
{
    public $model;
    public function init()
    {
        $this->model = News::model()->findAll(array('limit'=>1, 'order'=>'date DESC'));
    }
    public function run()
    {
        $this->render('lastNews', array('model'=>$this->model));
    }
}