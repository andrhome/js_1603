<?php
class MostPopularWidget extends CWidget
{
    public $week;
    public $month;
    public function init()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'date > :date_start';
        $criteria->order = 'views DESC';
        $criteria->with = 'author';
        $criteria->limit = 5;
        $criteria->select = 'id, date, title';
        $criteria->params = array(':date_start'=>date('Y-m-d H:m:s', time()-60*60*24*7));
        $this->week = Articles::model()->findAll($criteria);
        $criteria->params = array(':date_start'=>date('Y-m-d H:m:s', time()-60*60*24*30));
        $this->month = Articles::model()->findAll($criteria);
    }
    public function run()
    {
        $this->render('popular', array('week'=>$this->week, 'month'=>$this->month));
    }
}