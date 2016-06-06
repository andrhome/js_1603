<?php

class CabinetController extends Controller
{
    public function init()
    {
        $this->layout = '//layouts/column2';
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('view', 'create', 'update', 'delete', 'index', 'logout','admin', 'upload', 'ajaxUpload', 'editProfile', 'editPassword', 'crop'),
                'roles' => array('bloger', 'admin'),// для авторизованных
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $allPosts = new CActiveDataProvider('Articles',
            array(
                'criteria'=>array(
                    'with'=>array('author'),
                    'order'=>'date DESC',
                    'condition'=>'author_id = :id',
                    'params'=>array(':id'=>$user->id),
                ),
                'sort'=>false,
                'pagination'=>array(
                    'pageSize'=>5
                ),
            )
        );
        $newArticle = new Articles();
        $lastPosts = Articles::model()->findAll(array('order'=>'date Desc', 'limit'=>18));
        $popularBlogers = User::model()->findAllBySql("SELECT DISTINCT *, (SELECT COUNT(*) FROM articles WHERE author_id = `user`.id) AS count FROM `user` WHERE (role = 'bloger') ORDER BY count DESC LIMIT 9");
        if(isset($_POST['User']))
        {

            $user->attributes = $_POST['User'];
            //var_dump($user->attributes); exit;
            $user->password_2 = $user->password;
            $user->description = $_POST['User']['description'];
            if($user->save())
                $this->redirect('/blog/cabinet/index');
        }
        $this->render('index', array(
            'user'=>$user,
            'allPosts'=>$allPosts,
            'lastPosts'=>$lastPosts,
            'popularBlogers'=>$popularBlogers,
            'model'=>$newArticle,
        ));
    }

    public function actionUpdate($id)
    {
        $model = Articles::model()->findByPk($id);
        if(isset($_POST['Articles']))
        {
            $model->attributes = $_POST['Articles'];
            if($model->save())
            {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Успішно відредаговано!'));
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $this->render('update', array('model' => $model));
    }

    public function actionCreate()
    {
        $model = new Articles();
        if(isset($_POST['Articles']))
        {
            $model->attributes = $_POST['Articles'];
            $model->author_id = Yii::app()->user->id;
            if($model->validate())
            {
                $model->save();
                Yii::app()->user->setFlash('success', Yii::t('main', 'Успішно додано!'));
                $this->redirect('index');
            }
        }
        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        $model = Articles::model()->findByPk($id);
        if($model->delete())
            Yii::app()->end();

        // if AJAX request (triggered by deletion via index grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionEditProfile()
    {
        if(isset($_POST['User'])) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $user->attributes = $_POST['User'];
            //@todo Убрать костыль, когда будет нормальная верстка
            if($user->save()) {
                echo Yii::t('main', 'Успішно збережено. Обновыіть сторінку!');
            } else {
                echo Yii::t('main', 'Помилка збереження!');
            }
        }
    }

    public function actionEditPassword()
    {
        if(isset($_POST['oldPass'])) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            if(md5($_POST['oldPass']) === $user->password && $_POST['newPass'] === $_POST['newPass2']) {
                $user->password = md5($_POST['newPass']);
                if($user->save()) {
                    echo Yii::t('main', 'Успішно збережено.');
                } else {
                    echo Yii::t('main', 'Помилка збереження!');
                }
            }
            else {
                echo Yii::t('main', 'Помилка збереження! Не правильний старий пароль, або новий пароль не повторився в точності!');
            }

        }
    }

    public function actionCrop()
    {
        $name = $_POST['nameFull'];
        $fullImagePath = Yii::getPathOfAlias('webroot.uploads.users.tmp').DIRECTORY_SEPARATOR.$name;
        $quality = 100;

        $fullImg = getimagesize($fullImagePath);
        switch(strtolower($fullImg['mime']))
        {
            case 'image/png':
                $source_image = imagecreatefrompng($fullImagePath);
                $type = 'png';
                $quality = 0;
                break;
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($fullImagePath);
                $type = 'jpeg';
                break;
            case 'image/gif':
                $source_image = imagecreatefromgif($fullImagePath);
                $type = 'gif';
                break;
            default: die('image type not supported');
        }
        $function = 'image'.$type;

        $resizeImage = imagecreatetruecolor(324, 230); //$_POST['h'], $_POST['h']

        $src_x = $_POST['x'];
        $src_y = $_POST['y'];
        $dst_y = 0;
        $dst_x = 0;
        $dst_w = $_POST['w'];
        $dst_h = $_POST['h'];

        imagecopyresampled($resizeImage,$source_image, 0, 0, $src_x, $src_y,
            324, 230, $dst_w, $dst_h);

        $function($resizeImage, Yii::getPathOfAlias('webroot.uploads.users.avatars').DIRECTORY_SEPARATOR.$name, $quality);
        $user = User::model()->findByPk(Yii::app()->user->id);
        $user->avatar = $name;
        
		if($user->save(false)) {
			echo '<span class="glyphicon glyphicon-search"></span>';
			echo CHtml::image(Yii::app()->baseUrl.'/uploads/users/avatars/'.$name);
		} else {
			var_dump($user->errors); exit;
		}
       
        Yii::app()->end();


    }

    public function actionUpload()
    {
        $name = Yii::app()->user->id;
        $image = CUploadedFile::getInstanceByName('avatar');

        switch(strtolower($image->type))
        {
            case 'image/png':
                $type = '.png';
                break;
            case 'image/jpeg':
                $type = '.jpeg';
                break;
            case 'image/gif':
                $type = '.gif';
                break;
            default: die('image type not supported');
        }
        $image->saveAs(Yii::getPathOfAlias('webroot.uploads.users.tmp').DIRECTORY_SEPARATOR.$name.$type);
        list($resource['width'], $resource['height']) = getimagesize(Yii::getPathOfAlias('webroot.uploads.users.tmp').DIRECTORY_SEPARATOR.$name.$type);

        echo CHtml::image(Yii::app()->baseUrl.'/uploads/users/tmp/'.$name.$type, '', array('id'=>'crop'));
        echo CHtml::hiddenField('nameFull', $name.$type);
        Yii::app()->end();
    }
}