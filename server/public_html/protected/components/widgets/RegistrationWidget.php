<?php
class RegistrationWidget extends CWidget
{
    private $model;
    public function init(){}
    public function run()
    {
        $model = new User('register');
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo CActiveForm::validate($model);
            $model->setScenario('ajax');
            Yii::app()->end();
        }
        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            $model->verification = uniqid();
            $model->avatar = 'default-user-icon-profile.png';
            $link = 'http://' . $_SERVER['HTTP_HOST'].$this->getController()->createUrl('/site/verify', array('verification'=>$model->verification));
            if($model->save())
            {
                $model->setMail($model, Yii::t('main', 'Підтвердження регістрації'), $link);
                Yii::app()->user->setFlash('success',Yii::t('main', 'Дякуємо за регістрацію, на вашу електронну адресу відправлено лист з подальшими інструкціями'));
                $this->redirect('/site/index');
            }
            else {
                Yii::app()->user->setFlash('error', 'hello');
            }
        }
        $this->render('registration', array('model'=>$model));
    }
}