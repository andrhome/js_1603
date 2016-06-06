<?php
class AllNewsWidget extends CWidget
{
    public $allNews;

    public function init()
    {
        $this->allNews = News::model()->findAll(array('limit'=>15, 'order'=>'date DESC'));

    }
    public function run()
    {
        $this->render('allNews', array('allNews' => $this->allNews));
    }
}