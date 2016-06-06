<?php

class DefaultController extends Controller
{
    public $rightReclameId = 48;
	public function actionIndex()
	{
        $this->layout = '//layouts/column2';
        $lastPosts = Articles::model()->with('author')->findAll(array(
            'limit'=>18,
            'order'=>'`t`.`id` DESC',
        ));
        $allPosts = new CActiveDataProvider('Articles',
            array(
                'criteria'=>array(
                    'with'=>array('author'),
                    'order'=>'date DESC',
                ),
                'sort'=>false,
                'pagination'=>array(
                    'pageSize'=>5
                ),
            )
        );
        $allBlogers = User::model()->findAll(array('condition'=>'role = :role', 'params'=>array(':role'=>'bloger')));
        $popularBlogers = User::model()->findAllBySql("SELECT DISTINCT *, (SELECT COUNT(*) FROM articles WHERE author_id = `user`.`id`) AS count,(SELECT date FROM articles WHERE articles.author_id = user.id ORDER BY date LIMIT 1) AS dertw FROM user WHERE (user.role = 'bloger') ORDER BY dertw DESC LIMIT 9");
		$this->render('index',array('lastPosts'=>$lastPosts, 'allPosts'=>$allPosts, 'allBlogers'=>$allBlogers, 'popularBlogers'=>$popularBlogers));
	}

    public function actionPost($id)
    {
        $this->layout = '//layouts/column2';
        $model = Articles::model()->findByPk($id);
        $model->views++;
        $model->save();
        $user = User::model()->findByPk($model->author_id);
        $popularBlogers = User::model()->findAllBySql("SELECT DISTINCT *, (SELECT COUNT(*) FROM articles WHERE author_id = `user`.`id`) AS count,(SELECT date FROM articles WHERE articles.author_id = user.id ORDER BY date LIMIT 1) AS dertw FROM user WHERE (user.role = 'bloger') ORDER BY dertw DESC LIMIT 9");
        $lastPosts = Articles::model()->with('author')->findAll(array(
            'limit'=>18,
            'order'=>'date DESC',
        ));
        $this->render('post', array('model'=>$model, 'user'=>$user, 'popularBlogers'=>$popularBlogers, 'lastPosts'=>$lastPosts));
    }

    public function actionBloger($id)
    {
        $this->layout = '//layouts/column2';
        $user = User::model()->findByPk($id);
        $lastPosts = Articles::model()->findAll(array('order'=>'date Desc', 'limit'=>18));
        $popularBlogers = User::model()->findAllBySql("SELECT DISTINCT *, (SELECT COUNT(*) FROM articles WHERE author_id = `user`.`id`) AS count,(SELECT date FROM articles WHERE articles.author_id = user.id ORDER BY date LIMIT 1) AS dertw FROM user WHERE (user.role = 'bloger') ORDER BY dertw DESC LIMIT 9");
        $allPosts = new CActiveDataProvider('Articles',
            array(
                'criteria'=>array(
                    'with'=>array('author'),
                    'order'=>'date DESC',
                    'condition'=>'author_id = :id',
                    'params'=>array(':id'=>$id),
                ),
                'sort'=>false,
                'pagination'=>array(
                    'pageSize'=>7
                ),
            )
        );
        $this->render('bloger',array('allPosts'=>$allPosts, 'user'=>$user, 'lastPosts'=>$lastPosts, 'popularBlogers'=>$popularBlogers));
    }

    public function actionDelBloger($id)
    {
        if(Yii::app()->user->role == 'admin') {
            $user = User::model()->findByPk($id);
            Articles::model()->deleteAll('author_id = :id', array(':id'=>$user->id));
            User::model()->deleteByPk($id);
            $this->redirect('/site/index');
        }
    }
}