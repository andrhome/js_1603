<?php
//val
class NewsController extends AdminController
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		if(isset($_POST['News']) && isset($_POST['News']['title_uk']) && isset($_POST['News']['description_uk']))
        {
            $key = 'trnsl.1.1.20150529T174532Z.6cced0695ba61eeb.26310c886efe685d21289e67fdf0a7ebda5cc1b1';
            $lang = 'uk-ru';
            $format = 'html';
            $textTitle = $_POST['News']['title_uk'];
            $textDescr = $_POST['News']['description_uk'];

            $resultTitle = json_decode(file_get_contents("https://translate.yandex.net/api/v1.5/tr.json/translate?key=".$key."&text=".$textTitle."&lang=".$lang."&format=".$format));


			$vowels = array('<pre>', '</pre>', '<div>', '</div>');
			$textReplace = preg_replace('/\r\n/', '', $textDescr);
			$textReplace = preg_replace('/&#39;/', '`', $textReplace);
			$textReplace = preg_replace('/&raquo;/', '"', $textReplace);
			$textReplace = preg_replace('/&laquo;/', '"', $textReplace);
			$textReplace = preg_replace('/\&[\w\d\.\#]+;/', ' ', $textReplace);	
			$textReplace = preg_replace('/[H]/', '<span>H<span>', $textReplace);
			$textReplace = preg_replace('/style=".*?"/', '', $textReplace);
			$textReplace = preg_replace('/[\#\&\;]/', '', $textReplace);
			$textReplace = str_replace($vowels, '', $textReplace);

            // $textReplace = preg_replace("/\r\n/", "", $textDescr);
            // $newText1 = str_replace('&nbsp;',' ',  $textReplace);
            // $newText2 = str_replace('&laquo;',' ',  $newText1);
            // $newText3 = str_replace('&ndash;',' ',  $newText2);
            // $newText4 = str_replace('&rsquo;',' ',  $newText3);
            // $newText5 = str_replace('&raquo;',' ',  $newText4);
            // $newText6 = str_replace('&quot;',' ',  $newText5);
            // $newText7 = str_replace('<pre>','<p>',  $newText6);
            // $newText8 = str_replace('</pre>','</p>',  $newText7);
            // $newText9 = str_replace('<div>','<p>',  $newText8);
            // $newText10 = str_replace('</div>','</p>',  $newText9);
            // $newText11 = str_replace('<strong>','',  $newText10);
            // $newText12 = str_replace('</strong>','',  $newText11);
            // $newText13 = str_replace('&#39;','',  $newText12);
            // $newText14 = str_replace('&','',  $newText13);
            // $newText15 = str_replace('#','',  $newText14);

            preg_match_all("/<p.*?>.+?<\/p>/i", $textReplace, $matches);
            $array = array();
            foreach($matches[0] as $item){
                if(preg_match("/<p.*?>+<img.*><\/p>/i", $item)){
                    $array[] = $item;
                }
                else if(preg_match("/<p.*?>+<iframe.*><\/p>/i", $item)){
                    $array[] = $item;
                }
                else{
                    $resultDescr = json_decode(file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$key.'&text='.$item.'&lang='.$lang.'&format='.$format));
                    $array[] = $resultDescr;
                }
            };


            $arrayNew = array();
            for ($s=0; $s < count($array); $s++) {

                if(isset($array[$s]->text[0])){
                    $arrayNew[] = $array[$s]->text[0];
                }
                else{
                    $arrayNew[] = $array[$s];
                }

            }

            $newresultsTitle = array();
            $space = implode(" ", $arrayNew);
            $newresultsTitle[] = $resultTitle;

            $middleStringTitle = $newresultsTitle[0]->text[0];
        }

		$model=new News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
            $model->description_ru = $space;
            $model->title_ru = $middleStringTitle;
            if(empty($_POST['News']['date'])) {
            	$model->date = new CDbExpression('NOW()');
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
		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];

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
        $model=new News('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['News']))
            $model->attributes=$_GET['News'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
