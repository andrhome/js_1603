<?php

class PhotoCategoryController extends AdminController
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PhotoCategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PhotoCategory']))
		{
			$model->attributes=$_POST['PhotoCategory'];
            $model->date = date('Y-m-d h:i:s', time());
			if($model->save())
            {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Данные успешно сохранены!'));
                sleep(2);
                $this->redirect(array('index'));
            }
            else
            {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Ошибка!'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PhotoCategory']))
		{
			$model->attributes=$_POST['PhotoCategory'];
            $model->date = date('Y-m-d h:i:s', time());
            if($model->save())
            {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Данные успешно сохранены!'));
            }
            else
            {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Ошибка!'));
            }
            $this->refresh();
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via index grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $model=new PhotoCategory('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['PhotoCategory']))
            $model->attributes=$_GET['PhotoCategory'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PhotoCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PhotoCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PhotoCategory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photo-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionCrop()
    {
        $name = $_POST['nameFull'];
        $fullImagePath = Yii::getPathOfAlias('webroot.uploads.galery.album').DIRECTORY_SEPARATOR.$name;
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

        $function($resizeImage, Yii::getPathOfAlias('webroot.uploads.galery.category').DIRECTORY_SEPARATOR.$name, $quality);
        $model = new PhotoCategory();
        echo CHtml::image(Yii::app()->baseUrl.'/uploads/galery/category/'.$name);
        echo CHtml::activeHiddenField($model, 'image', array('value'=>$name));


    }

    public function actionUpload()
    {
        $name = $_POST['name'];
        $model = new PhotoCategory();
        $image = CUploadedFile::getInstance($model, 'image');

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
        $image->saveAs(Yii::getPathOfAlias('webroot.uploads.galery.album').DIRECTORY_SEPARATOR.$name.$type);
        list($resource['width'], $resource['height']) = getimagesize(Yii::getPathOfAlias('webroot.uploads.galery.album').DIRECTORY_SEPARATOR.$name.$type);

        echo CHtml::image(Yii::app()->baseUrl.'/uploads/galery/album/'.$name.$type, '', array('id'=>'crop'));
        echo CHtml::hiddenField('nameFull', $name.$type);
        Yii::app()->end();
    }
}
