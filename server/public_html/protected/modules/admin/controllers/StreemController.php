<?php

class StreemController extends AdminController
{

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Streem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Streem']))
		{
			$model->attributes=$_POST['Streem'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
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

		if(isset($_POST['Streem']))
		{
			$model->attributes=$_POST['Streem'];
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new Streem('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Streem']))
            $model->attributes=$_GET['Streem'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Streem the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Streem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Streem $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='streem-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
