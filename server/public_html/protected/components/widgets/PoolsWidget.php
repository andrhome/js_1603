<?php

class PoolsWidget extends CWidget
{
    public $model;
    public function init()
    {
        $this->model = Pools::model()->findAll('active = :active', array(':active'=>1));
    }
    public function run()
    {
        $this->render('pools', array('model'=>$this->model));
    }
}