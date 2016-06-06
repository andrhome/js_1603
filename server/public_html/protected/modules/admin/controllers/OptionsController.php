<?php

class OptionsController extends AdminController
{
    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model= Options::model()->findByPk(1);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Options']))
        {
            $model->attributes=$_POST['Options'];
            if($model->save())
            {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Данные успешно сохранены!'));
                $this->refresh();
            }
            else
            {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Ошибка!'));
            }
            $this->refresh();
        }
        $this->render('index',array(
            'model'=>$model,
        ));
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
