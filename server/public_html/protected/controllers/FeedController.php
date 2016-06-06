<?php
class FeedController extends Controller
{
    public function actionRss()
    {
        $this->layout = '';
        header('Content-Type: text/xml; charset=utf-8', true);
        $newsFeed = News::model()->findAll(array('order'=>'date DESC', 'limit'=>'50', 'condition'=>'rss = 1'));
        $this->renderPartial('rss', array('newsFeed'=>$newsFeed));
    }
}