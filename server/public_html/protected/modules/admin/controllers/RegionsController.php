<?php

class RegionsController extends AdminController
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Regions;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Regions']))
		{
            if(isset($_POST['Regions']))
            {
                $model->attributes=$_POST['Regions'];
                $image = CUploadedFile::getInstance($model,'image');
                $model->image = $image->name;
                if(isset($model->image))
                {
                    $image->saveAs(Yii::getPathOfAlias('webroot.images.icons').DIRECTORY_SEPARATOR.$model->image);
                }
            }

			if($model->save())
            {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Данные успешно сохранены!'));
                $this->redirect(array('update','id'=>$model->id));
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
        $model_image = $model->image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Regions']))
		{
			$model->attributes=$_POST['Regions'];
            $model->image = $model_image;
            $image = CUploadedFile::getInstance($model,'image');
            if(isset($image))
            {
                $image->saveAs(Yii::getPathOfAlias('webroot.images.icons').DIRECTORY_SEPARATOR.$image->name);
                $model->image = $image->name;
            }
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
        $model=new Regions('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Regions']))
            $model->attributes=$_GET['Regions'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Regions the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Regions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Regions $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='regions-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
