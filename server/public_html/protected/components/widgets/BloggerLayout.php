<?php
class BloggerLayout extends CWidget
{
    public $blogger;

    public function init()
    {
        $blogger = Yii::app()->db->createCommand()
            ->select('u.id AS user_id, u.name AS user_name, u.profession AS user_profession, u.avatar AS user_avatar, a.id AS article_id, a.date AS article_date, a.title AS article_title')
            ->from('articles a')
            ->join('user u', 'a.author_id=u.id')
            ->limit(1)
            ->order('date DESC')
            ->queryRow();
            
        $this->blogger = $blogger;
    }
    public function run()
    {
        $this->render('bloggerLayout', array('blogger' => $this->blogger));
    }
}