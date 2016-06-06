<?php

class AjaxController extends Controller
{
    public function actionPools()
    {
        $pool = Pools::model()->with('answers')->findByPk($_POST['poolId']);
        if(!PoolsIp::model()->count('ip = :ip AND pool_id = :id', array(':ip'=>$_SERVER['REMOTE_ADDR'], ':id'=>$pool->id)))
        {
            if(isset($_POST['value']))
            {
                $pool->hits++;
                $poolsIp = new PoolsIp();
                $poolsIp->answer_id = $_POST['value'];
                $poolsIp->pool_id = $pool->id;
                $poolsIp->ip = $_SERVER['REMOTE_ADDR'];

                $answer = Answers::model()->findByPk($_POST['value']);
                $answer->hits++;

                $answer->save();
                $poolsIp->save();
                $pool->save();

                $refreshedPools = Pools::model()->with('answers')->findByPk($_POST['poolId']);

                $this->renderPartial('pool', array('pool'=>$refreshedPools), false, false);
            }
        }
    }

    public function actionMoreNews()
    {
        $allNews = News::model()->findAll(array('order'=>'date DESC', 'limit'=>$_GET['limit']));
        $limit = $_GET['limit'] + 10;
        $this->renderPartial('moreNews', array('allNews'=>$allNews, 'limit'=>$limit), false, true);
    }

    public function actionNewsNoImage()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $sql="
        (SELECT n.id, n.title_uk, n.title_ru, n.date, type, reclame, n.image, n.views, c.alias AS category_alias, c.title_ru AS category_title_ru, c.title_uk AS category_title_uk FROM news n INNER JOIN category c ON n.category_id = c.id)
            UNION
        (SELECT n.id, n.title_uk, n.title_ru, n.date, type, reclame, n.image, n.views, c.alias AS category_alias, c.title_ru AS category_title_ru, c.title_uk AS category_title_uk FROM video n INNER JOIN category c ON n.category_id = c.id)
            UNION
        (SELECT n.id, n.title_uk, n.title_ru, n.date, type, reclame, n.image, n.views, c.alias AS category_alias, c.title_ru AS category_title_ru, c.title_uk AS category_title_uk FROM photo_category n INNER JOIN category c ON n.category_id = c.id)
            ORDER BY  `date` DESC LIMIT ".$_POST['count'].",5";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $allNews = $command->queryAll();

            $this->renderPartial('noimg', array('allNews'=>$allNews));
        }
    }

    public function actionNewsWithImage()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $sql="
        (SELECT n.id, n.title_uk, n.title_ru, n.date, type, reclame, n.image, n.views, c.alias AS category_alias, c.title_ru AS category_title_ru, c.title_uk AS category_title_uk FROM news n INNER JOIN category c ON n.category_id = c.id)
            UNION
        (SELECT n.id, n.title_uk, n.title_ru, n.date, type, reclame, n.image, n.views, c.alias AS category_alias, c.title_ru AS category_title_ru, c.title_uk AS category_title_uk FROM video n INNER JOIN category c ON n.category_id = c.id)
            UNION
        (SELECT n.id, n.title_uk, n.title_ru, n.date, type, reclame, n.image, n.views, c.alias AS category_alias, c.title_ru AS category_title_ru, c.title_uk AS category_title_uk FROM photo_category n INNER JOIN category c ON n.category_id = c.id)
            ORDER BY  `date` DESC LIMIT ".$_POST['count'].",5";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $allNews = $command->queryAll();

            $this->renderPartial('withimg', array('allNews'=>$allNews));
        }
    }
}