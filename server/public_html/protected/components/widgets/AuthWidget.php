<?php

class AuthWidget extends CWidget
{
    public $model;
    public $remember;

    public function init()
    {
        $this->model = new LoginForm();
        $this->remember = new Remember();
    }
    public function run()
    {
        $this->render('auth', array('model'=>$this->model, 'remember'=>$this->remember));
    }
}