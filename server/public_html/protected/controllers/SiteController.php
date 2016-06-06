<?php

class SiteController extends Controller
{

    public $rightReclameId = null;
    public $menu = null;
    public $categoryId = null;
	/**
	 * Declares class-based actions.
	 */


	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


    public function getMenu() {
       return NewsCategory::model()->findAll();
    }

    public function init() {

        $url = explode("/", Yii::app()->request->requestUri);
        $categoryId = null;

        if(in_array('category', $url)){
            $categoryId = $_GET['id'] ? $_GET['id'] : null;
        }

        $this->menu = $this->getMenu();    
        $this->categoryId = $categoryId;    

        return $this->menu;

    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{      

        $mostViewed = News::model()->findAll(array(
            'select'=>'id, date, image, title_ru, title_uk, description_ru, description_uk, views',
            'limit'=>'10',
            'order'=>'date DESC'
        ));

        $mostViewedSlider = array_slice($mostViewed, 0, 5);
        $mostViewedLine = array_slice($mostViewed, 5, 5);
        
        // $allNews = News::model()->findAll(array('limit'=>15, 'order'=>'date DESC', 'condition'=>'date < :now','params'=>array(':now'=>date('Y-m-d H:i:s', time())))); ---- this is time in future don`t show

        $allNews = News::model()->findAll(array(
            'select'=>'id, date, image, title_ru, title_uk, views',
            'limit'=>'15',
            'order'=>'date DESC'
        ));

        $allNewsPhoto = array_slice($allNews, 0, 5);
        $allNewsLine = array_slice($allNews, 5, 15);
        
        $lastVideos = Video::model()->findAll(array('order'=>'date DESC', 'limit'=>4));
        $lastPhoto = PhotoCategory::model()->findAll(array('order'=>'date DESC', 'limit'=>4, 'select'=>'name_ru, name_uk, id, image'));
        $multimedia = [];

        for ($i = 0, $j = 0; $i < 8;) { 
            
            if($i%2){
                array_push($multimedia, $lastVideos[$j]);
                $j++;
            } else {
                array_push($multimedia, $lastPhoto[$j]);
                
            }
            $i++;
        }

		$this->rightReclameId = 21;
        $this->render('index', array(
            'mostViewedSlider'=>$mostViewedSlider,
            'mostViewedLine'=>$mostViewedLine,
            'allNewsPhoto'=>$allNewsPhoto,
            'allNewsLine'=>$allNewsLine,
            'multimedia'=>$multimedia
        ));
	}

    public function actionGetCategory()
    {

        $id = intval(trim(strip_tags($_GET['id'])));
        $arrayOfCategory = Array();
        $category = NewsCategory::model()->findAll(array('condition'=>'id = '.$id.'', 'limit'=>1));

        if(is_int($id) == true && $id < 10){
            $provider = News::model()->with(array('category'=>array('condition'=>'category.id = '.$id.'', 'select'=>false)))->findAll(array('limit'=>3, 'order'=>'date DESC', /*'condition'=>'date < :now','params'=>array(':now'=>date('Y-m-d H:i:s', time()))*/));

            foreach ($provider as $key => $value) {
                $arrayTemplate = [];
                foreach ($value as $keys => $values) {
                    $arrayTemplate[$keys] = strip_tags($values);
                }
                $arrayOfCategory[$key] = $arrayTemplate;
            }

            $arrayOfCategory['news'] = CJSON::encode($arrayOfCategory);
            $arrayOfCategory['category'] = CJSON::encode($category);
            $arrayOfCategory['language'] = Yii::app()->language;
            echo json_encode($arrayOfCategory);
        }
        
    }

    public function actionApp(){

        header('Access-Control-Allow-Origin: *');
        header("Content-Type: text/html;charset=UTF-8");
        $appNews = News::model()->findAll(array('limit'=>20, 'order'=>'date DESC', 'condition'=>'date < :now','params'=>array(':now'=>date('Y-m-d H:i:s', time()))));

        $news = Array();

        foreach ($appNews as $key => $value) {
            $news[$key]['id'] = $value->id;
            $news[$key]['image'] = $value->image;
            $news[$key]['title'] = $value->title_uk;
            $news[$key]['desc'] = substr($value->description_ru, 0, 40);
            $news[$key]['date'] = $value->date;
            $news[$key]['views'] = $value->views;
        }

        echo json_encode($news);

    }

    public function actionSearch()
    {
        $this->layout = '//layouts/column2';

        if(isset($_GET['find']) && !empty($_GET['find']))
        {
            $params = array();
            $params_new = array();
            $keyword = trim(strip_tags($_GET['find']));
            $criteria = new CDbCriteria();
            $criteria->distinct = true;

            if(Yii::app()->language == 'ru')
                $criteria->condition = 'title_ru LIKE :keyword';
            else
                $criteria->condition = 'title_uk LIKE :keyword';

            if(!empty($_GET['publishDate'])) {
                $criteria->addCondition('date >= :date_start AND date <= :date_end', 'AND');
                $params = array(':date_start'=>date('Y-m-d ', strtotime($_GET['publishDate'])).' 00.00.00', ':date_end'=>date('Y-m-d ', strtotime($_GET['publishDate'])).' 23.59.59');
            }
            if(!empty($_GET['category'])) {
                $criteria->addCondition('category_id = :category', 'AND');
                $params_new = array(':category' => $_GET['category']);
            }
            $criteria->order = 'date DESC';
            $criteria->params = array_merge(array_merge(array(':keyword'=>'%'.$keyword.'%'), $params), $params_new);

            $news = new CActiveDataProvider('News',
                array(
                    'criteria'=>$criteria,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>30
                    ),
                )
            );

            $criteriaVideo = new CDbCriteria();
            $criteriaVideo->distinct = true;
            $paramsVideo = array();
            if(Yii::app()->language == 'ru')
                $criteriaVideo->condition = 'title_ru LIKE :keyword';
            else
                $criteriaVideo->condition = 'title_uk LIKE :keyword';

            if(!empty($_GET['publishDate'])) {
                $criteriaVideo->addCondition('date >= :date_start AND date <= :date_end');
                $paramsVideo = array(':date_start'=>date('Y-m-d ', strtotime($_GET['publishDate'])).' 00.00.00', ':date_end'=>date('Y-m-d ', strtotime($_GET['publishDate'])).' 23.59.59');
            }
            $criteriaVideo->order = 'date DESC';
            $criteriaVideo->params = array_merge(array(':keyword'=>'%'.$keyword.'%'), $paramsVideo);

            $video = new CActiveDataProvider('Video',
                array(
                    'criteria'=>$criteriaVideo,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>3
                    ),
                )
            );

            $criteriaPhoto = new CDbCriteria();
            $criteriaPhoto->distinct = true;
            $paramsPhoto = array();
            if(Yii::app()->language == 'ru')
                $criteriaPhoto->condition = 'name_ru LIKE :keyword';
            else
                $criteriaPhoto->condition = 'name_uk LIKE :keyword';
            $criteriaPhoto->order = 'date DESC';
            if(!empty($_GET['publishDate'])) {
                $criteriaPhoto->addCondition('date >= :date_start AND date <= :date_end');
                $paramsPhoto = array(':date_start'=>date('Y-m-d ', strtotime($_GET['publishDate'])).' 00.00.00', ':date_end'=>date('Y-m-d ', strtotime($_GET['publishDate'])).' 23.59.59');
            }
            $criteriaPhoto->params = array_merge(array(':keyword'=>'%'.$keyword.'%'), $paramsPhoto);

            $photo = new CActiveDataProvider('PhotoCategory',
                array(
                    'criteria'=>$criteriaPhoto,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>3
                    ),
                ));
            if(!empty($_GET['category']) && $_GET['category'] !== 'video') {
                $video = null;
            }
            elseif(!empty($_GET['category']) && $_GET['category'] !== 'photo') {
                $photo = null;
            }
            $this->render('search', array('searchNews'=>$news, 'searchPhotos'=>$photo, 'searchVideos'=>$video));
        }
        elseif(!empty($_GET['publishDate']))
        {
            $criteria = new CDbCriteria();
            $criteria->distinct = true;
            $criteria->condition = 'date >= :date_start AND date <= :date_end';
            $criteria->params = array(
                ':date_start'=>
                    date('Y-m-d 00.00.00', strtotime($_GET['publishDate'])),
                ':date_end'=>
                    date('Y-m-d 23.59.59', strtotime($_GET['publishDate'])));
            $criteria->order = 'date DESC';

            $video_cri = new CDbCriteria();
            $video_cri->distinct = true;
            $video_cri->condition = 'date >= :date_start AND date <= :date_end';
            $video_cri->params = array(
                ':date_start'=>
                    date('Y-m-d 00.00.00', strtotime($_GET['publishDate'])),
                ':date_end'=>
                    date('Y-m-d 23.59.59', strtotime($_GET['publishDate'])));
            $video_cri->order = 'date DESC';

            $photo_cri = new CDbCriteria();
            $photo_cri->distinct = true;
            $photo_cri->condition = 'date >= :date_start AND date <= :date_end';
            $photo_cri->params = array(
                ':date_start'=>
                    date('Y-m-d 00.00.00', strtotime($_GET['publishDate'])),
                ':date_end'=>
                    date('Y-m-d 23.59.59', strtotime($_GET['publishDate'])));
            $photo_cri->condition = 'id = null';
            $photo_cri->order = 'date DESC';

            if(!empty($_GET['category'])) {
                if($_GET['category'] === 'video') {
                    $photo_cri->condition = 'id = null';
                    $criteria->condition = 'id = null';
                }
                elseif($_GET['category'] === 'photo') {
                    $video_cri->condition = 'id = null';
                    $criteria->condition = 'id = null';
                }
                else {
                    $video_cri->condition = 'id = null';
                    $photo_cri->condition = 'id = null';
                    $criteria->addCondition('category_id = :category', 'AND');
                    $params_new = array(':category' => $_GET['category']);
                    $criteria->params = array_merge($criteria->params, $params_new);
                }
            }

            $news = new CActiveDataProvider('News',
                array(
                    'criteria'=>$criteria,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>3
                    ),
                )
            );
            $photo = new CActiveDataProvider('PhotoCategory',
                array(
                    'criteria'=>$photo_cri,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>3
                    ),
                )
            );
            $video = new CActiveDataProvider('Video',
                array(
                    'criteria'=>$video_cri,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>3
                    ),
                )
            );
            $this->render('search', array('searchNews'=>$news, 'searchPhotos'=>$photo, 'searchVideos'=>$video));
        }
        elseif(!empty($_GET['category'])) {
            $video_cri = new CDbCriteria();
            $video_cri->distinct = true;
            $video_cri->order = 'date DESC';
            $video_cri->condition = 'id = null';

            $news_cri = new CDbCriteria();
            $news_cri->distinct = true;
            $news_cri->order = 'date DESC';
            $news_cri->condition = 'category_id = :category';
            $news_cri->params = array(':category' => $_GET['category']);

            $photo_cri = new CDbCriteria();
            $photo_cri->distinct = true;
            $photo_cri->order = 'date DESC';
            $photo_cri->condition = 'id = null';

            $video = new CActiveDataProvider('Video',
                array(
                    'criteria'=>$video_cri,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>24
                    ),
                )
            );
            $photo = new CActiveDataProvider('PhotoCategory',
                array(
                    'criteria'=>$photo_cri,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>24
                    ),
                )
            );
            $news = new CActiveDataProvider('News',
                array(
                    'criteria'=>$news_cri,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>24
                    ),
                )
            );
            if($_GET['category'] === 'video') {
                $video_cri->condition = null;
            }
            elseif($_GET['category'] === 'photo') {
                $photo_cri->condition = null;
            }
            $this->render('search', array('searchNews'=>$news, 'searchPhotos'=>$photo, 'searchVideos'=>$video));
        }
        else
        {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function actionAllNews()
    {   

        $this->layout = '//layouts/column2';
        $this->render('allNews', array(
            'count'=>0,
            'id'=>null
        ));

    }

    public function actionVideo($id)
    {
        $model = Video::model()->findByPk($id);
        $relatedVideos = Video::model()->findAll(array('order'=>'date DESC', 'limit'=>33));
        $this->rightReclameId = 22;
        $this->layout = '//layouts/column2';
        $this->render('videoOne', array('model'=>$model, 'relatedVideos'=>$relatedVideos));
    }

    public function actionPhotos($id = null)
    {

            $criteria = new CDbCriteria();
            $criteria->condition = 'category_id = :category_id';
            $criteria->params = array(':category_id'=>$id);
            $category = PhotoCategory::model()->findByPk($id);
            $photos = Photo::model()->findAll($criteria);
            $relatedPhotos = PhotoCategory::model()->findAll(array('order'=>'date DESC', 'limit'=>33));

            $this->layout = '//layouts/column2';
            $this->rightReclameId = 23;
            $this->render('single_album', array('photos'=>$photos, 'relatedPhotos'=>$relatedPhotos, 'category'=>$category));
       
    }

    public function actionMultimedia()
    {

        $this->layout = '//layouts/column2';
        $this->rightReclameId = 46;
        $this->render('multimedia', array(
            'count'=>0,
            'id'=>null
        ));

    }


    public function actionMarket()
    {

        $this->render('market');

    }

    public function actionGetMultimedia()
    {
        $sql="(SELECT `date`, `id`, `image`, `type`, `name_ru`, `name_uk` FROM photo_category) UNION (SELECT `date`, `id`, `video`, `type`, `title_ru`, `title_uk` FROM video) ORDER BY `date` DESC LIMIT ".$_GET['offset'].", 30";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $multimedia = $command->queryAll();
            
        $arrayOfCategory['multimedia'] = CJSON::encode($multimedia);
        $arrayOfCategory['language'] = Yii::app()->language;
        $arrayOfCategory['offset'] = $_GET['offset'] + 30;


        echo json_encode($arrayOfCategory);
    }

    /**
     * @param $id
     */
    public function actionCategory($id)
    {   

        $mostViewed = News::model()->with(array('category'=>array('condition'=>'category.id = :id', 'select'=>false, 'params'=>array(':id'=>$id))))->findAll(array('order'=>'date DESC', 'limit'=>5));

        $this->layout = '//layouts/column2';
        $category = NewsCategory::model()->findByAttributes(array('id'=>$id));
        $this->rightReclameId = 'rightColumnCategory'.ucfirst($category->id);
        $this->render('category', array(
            'mostViewed'=>$mostViewed,
            'category'=>$category,
            'count'=>5,
            'id'=>$id
        ));
    }

    public function actionGetCategoryByIdXhrOrNotId() {

        if($_GET['id'] != 'null'){
            $mostViewed = News::model()->with(array('category'=>array('condition'=>'category.id = :id', 'select'=>false, 'params'=>array(':id'=>$_GET['id']))))->findAll(array('order'=>'date DESC', 'offset'=>$_GET['offset'], 'limit'=>16));
        } else {
            $mostViewed = News::model()->findAll(array('order'=>'date DESC', 'offset'=>$_GET['offset'], 'limit'=>16));
        }
        
        $arrayOfCategory['news'] = CJSON::encode($mostViewed);
        $arrayOfCategory['language'] = Yii::app()->language;
        $arrayOfCategory['offset'] = $_GET['offset'] + 16;

        echo json_encode($arrayOfCategory);
    }

    /**
     * @param $id
     */
    public function actionNews($id = 1)
    {

        $this->layout = '//layouts/column2';

        if(isset($_GET['date']))
        {
            $criteria = new CDbCriteria();
            $criteria->distinct = true;
            $criteria->condition='date >= :date_start AND date <= :date_end';
            $criteria->params = array(':date_start'=>$_GET['date'].' 00.00.00', ':date_end'=>$_GET['date'].' 23.59.59');
            $criteria->order = 'date DESC';
            $news = new CActiveDataProvider('News',
                array(
                    'criteria'=>$criteria,
                    'sort'=>false,
                    'pagination'=>array(
                        'pageSize'=>30
                    ),
                ));
            $this->render('calendarSearch', array('searchNews'=>$news));
        }
        else
        {
			$data = News::model()->findByPk($id);
			if(!$data)
				$data = NewsOld::model()->findByPk($id);
            $this->rightReclameId = 24;
            $relatedNews = News::model()->findAll(array('condition'=>'category_id = :cat_id AND id NOT IN (:id)', 'params'=>array(':cat_id'=>$data->category_id, ':id'=>$data->id), 'limit'=>24, 'order'=>'date Desc'));
            $this->render('news', array('data'=>$data, 'relatedNews'=>$relatedNews));
        }
    }

    public function actionRegions($region)
    {
        $dataProvider = new CActiveDataProvider('News',
            array(
                'criteria'=>array(
                    'condition'=>'region = :region',
                    'params'=>array(':region'=>$region),
                    'order'=>'date DESC',
                ),
                'sort'=>false,
                'pagination'=>array(
                    'pageSize'=>12
                ),
            ));

        $mostViewed = News::model()->findAll(array('condition'=>'region = :region', 'params'=> array(':region'=>$region),'order'=>'date DESC', 'limit'=>9));

        $this->render('category', array(
            'dataProvider'=>$dataProvider,
            'category'=>$region,
            'mostViewed'=>$mostViewed,
        ));
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    public function actionRegistration()
    {
        $model = new User('register');
        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            $model->verification = uniqid();
            $model->avatar = 'default-user-icon-profile.png';
            $link = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl('/site/verify', array('verification'=>$model->verification));
            var_dump($link);
            if($model->sendMail($model, Yii::t('main', 'Підтвердження реєстрації'), $link) && $model->save())
            {
                $message = Yii::t('main', 'Дякуємо за реєстрацію, на вашу електронну адресу відправлено лист з подальшими інструкціями');
                echo json_encode($message);
            }
            else {
                $message = CHtml::errorSummary($model);
                echo json_encode($message);
            }
        }
    }

    public function actionVerify()
    {
        $user = User::model()->find('verification = :verification', array(':verification'=>$_GET['verification']));
        if(isset($user))
        {
            $user->active = 1;
            $user->verification = uniqid();
            $user->password = md5($user->password);
            if($user->save())
                Yii::app()->user->setFlash('success', Yii::t('main', 'Дякуємо за підтвердження реєстрації, ви можете зайти на сайт, використовуючи вказані вами данні при реєстрації'));
            else
                Yii::app()->user->setFlash('error', CHtml::errorSummary($user));
        }
        else
        {
            Yii::app()->user->setFlash('success',Yii::t('main', 'Нажаль посилання, за яким ви перейшли вже не актуальне'));
        }
        $this->redirect('/site/index');
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        if(isset($_POST['LoginForm'])){
            
            $model->attributes=$_POST['LoginForm'];

                if($model->validate() && $model->login()) {
                    $location = [];
                    Yii::app()->user->role == 'admin' ? $location['href'] = '/admin/' :  $location['href'] = Yii::app()->user->returnUrl;
                    echo json_encode($location);
                } else {
                    $message = "Користувач або пароль не знайденний";
                    echo json_encode($message);
                }
            

        } else {
            $message = "Заповніть коректно всі поля";
            echo json_encode($message);
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionResize()
    {
        $path = Yii::getPathOfAlias('webroot.uploads.resize').DIRECTORY_SEPARATOR;
        $img =  $path.'540429ce7e3a6_full.jpg';

        $resource = array();
        list($resource['width'], $resource['height'], $resource['type']) = getimagesize($img);

        $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений

        $newImageSizes = array('width'=>300, 'height'=>273);


        $resource_img = imagecreatefromjpeg($path.'540429ce7e3a6_full.jpg');

        $newImage = imagecreatetruecolor($newImageSizes['width'], $newImageSizes['height']);


        $dst_x = 0;
        $dst_y = 0;

        $src_y = 0;
        $src_x = 300;

        imagecopyresampled ($newImage, $resource_img, $dst_x , $dst_y , $src_x , $src_y , $newImageSizes['width'], $newImageSizes['height'], $newImageSizes['width'], $newImageSizes['height']);

        imagejpeg($newImage,$path.'newName.jpg',100);

        echo 'saved';
    }

    public function actionYahooWeather($code, $units, $lang) {

        header('Content-Type: text/html; charset=utf-8');

        $wind_chill;
        $wind_direction;
        $wind_speed;
        // Атмосферные показатели
        $humidity;
        $visibility;
        $pressure;
        // Время восхода и заката переводим в формат unix time
        $sunrise;
        $sunset;
        // Текущая температура воздуха и погода
        $temp;
        $condition_text;
        $condition_code;
        // Прогноз погоды на 5 дней
        $forecast;

        $text = Array(
        '0' => 'Торнадо', 
        '1' => 'Тропічний шторм',
        '2' => 'Ураган',
        '3' => 'Сильні грози',
        '4' => 'Грози',
        '5' => 'Змішаний дощ зi снігом',
        '6' => 'Змішаний дощ зi снігом',
        '7' => 'Змішаний дощ зi снігом',
        '8' => 'Паморозь',
        '9' => 'Мряка',
        '10' => 'Град',
        '11' => 'Зливи',
        '12' => 'Зливи',
        '13' => 'Сніговi пориви',
        '14' => 'Легкий сніг',
        '15' => 'Хуртовина',
        '16' => 'Снiг',
        '17' => 'Град',
        '18' => 'Дощ зі снігом',
        '19' => 'Туманно',
        '20' => 'Туманно',
        '21' => 'Туманно',
        '22' => 'Туманно',
        '23' => 'Вітрянно',
        '24' => 'Вітрянно',
        '25' => 'Прохолодно',
        '26' => 'Хмарно',
        '27' => 'Переважно хмарно',
        '28' => 'Переважно хмарно',
        '29' => 'Мінлива хмарність',
        '30' => 'Мінлива хмарність',
        '31' => 'Ясно',
        '32' => 'Сонячно',
        '33' => 'Ясно',
        '34' => 'Ясно',
        '35' => 'Змішаний дощ з градом',
        '36' => 'Спекотно',
        '37' => 'Грози',
        '38' => 'Розсіяні грози',
        '39' => 'Розсіяні грози',
        '40' => 'Мінлива хмарність',
        '41' => 'Сильний снігопад',
        '42' => 'Снігопад',
        '43' => 'Сильний снігопад',
        '44' => 'Мінлива хмарність',
        '45' => 'Зливи',
        '46' => 'Зливовий сніг',
        '47' => 'Зливи'
        );

        $days = Array(
            'Mon' => 'Понедiлок',
            'Tue' => 'Вiвторок',
            'Wed' => 'Середа',
            'Thu' => 'Четвер',
            'Fri' => 'П`ятниця',
            'Sat' => 'Субота',
            'Sun' => 'Недiля'
            );

        $units = ($units == 'c')?'c':'f';
        
        $url = 'http://xml.weather.yahoo.com/forecastrss?p='.
            $code.'&u='.$units.'&l';
        
        $xml_contents = file_get_contents($url);
        if($xml_contents === false) 
            throw new Exception('Error loading '.$url);
        
        $xml = new SimpleXMLElement($xml_contents);
        
        // Ветер
        $tmp = $xml->xpath('/rss/channel/yweather:wind');
        if($tmp === false) throw new Exception("Error parsing XML.");
        $tmp = $tmp[0];
        
        $wind_chill = (int)$tmp['chill'];
        $wind_direction = (int)$tmp['direction'];
        $wind_speed = (int)$tmp['speed'];
        
        // Атмосферные показатели
        $tmp = $xml->xpath('/rss/channel/yweather:atmosphere');
        if($tmp === false) throw new Exception("Error parsing XML.");
        $tmp = $tmp[0];
        
        $humidity = (int)$tmp['humidity'];
        $visibility = (int)$tmp['visibility'];
        $pressure = (int)$tmp['pressure'];
        
        // Время восхода и заката переводим в формат unix time
        $tmp = $xml->xpath('/rss/channel/yweather:astronomy');
        if($tmp === false) throw new Exception("Error parsing XML.");
        $tmp = $tmp[0];
        
        $sunrise = strtotime($tmp['sunrise']);
        $sunset = strtotime($tmp['sunset']);
        
        // Текущая температура воздуха и погода
        $tmp = $xml->xpath('/rss/channel/item/yweather:condition');
        if($tmp === false) throw new Exception("Error parsing XML.");
        $tmp = $tmp[0];
        
        $temp = (int)$tmp['temp'];
        $condition_text = strtolower((string)$tmp['text']);
        $condition_code = (int)$tmp['code'];
        
        // Прогноз погоды на 5 дней
        $forecast = array();
        $tmp = $xml->xpath('/rss/channel/item/yweather:forecast');
        if($tmp === false) throw new Exception("Error parsing XML.");
        
        foreach($tmp as $day) {
            $forecast[] = array(
                'date' => $days[(string)$day['day']],
                'low' => (int)$day['low'],
                'high' => (int)$day['high'],
                'text' => $text[(int)$day['code']],
                'code' => (int)$day['code']
            );
        }
        return array("forecast" => $forecast, "now" => $temp);
    }

    public function actiontryWeather(){
        try {
            $weather = $this->actionYahooWeather("UPXX0007", 'c', 'ru');
            echo json_encode($weather);
        } catch(Exception $e) {
            echo "Caught exception: ".$e->getMessage();
            exit();
        }
    }

    public function actiontryCurrency(){
        $a = file_get_contents("http://bank-ua.com/export/exchange_rate_cash.json");
        echo $a;
    }


}