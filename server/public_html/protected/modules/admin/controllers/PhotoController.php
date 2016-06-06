<?php

class PhotoController extends AdminController
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Photo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Photo']))
		{
            $model->attributes = $_POST['Photo'];
            if(isset($_FILES['images']['name'][0]) && $_FILES['images']['name'][0] !== '')
                $model->name = 'new';
            if($model->validate())
            {
                $images = CUploadedFile::getInstancesByName('images');
                foreach($images as $image)
                {
                    $imageModel = new Photo;
                    $name = uniqid().$image->name;
                    $image->saveAs(Yii::getPathOfAlias('webroot.uploads.images').DIRECTORY_SEPARATOR.$name);
                    
                    copy(Yii::getPathOfAlias('webroot.uploads.images').DIRECTORY_SEPARATOR.$name,
                        Yii::getPathOfAlias('webroot.uploads.images').DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$name);

                    $thumb = Yii::app()->image->load(Yii::getPathOfAlias('webroot.uploads.images').DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$name);
                    $thumb->resize(300, 300);
                    $thumb->save();

                    $imageModel->name = $name;
                    $imageModel->category_id = $_POST['Photo']['category_id'];
                    $imageModel->save();
                }
                Yii::app()->user->setFlash('success', Yii::t('main', 'Данные успешно сохранены!'));
                $this->refresh();
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

		if(isset($_POST['Photo']))
		{
			$model->attributes=$_POST['Photo'];
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
        $model=new Photo('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Photo']))
            $model->attributes=$_GET['Photo'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Photo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Photo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Photo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
