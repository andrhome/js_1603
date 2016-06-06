<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	//public $layout='/layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */

    public $pageTitle = 'Високий Вал';
    public $pageDescription = 'Новини Чернiгова. Високий Вал';
    public $pageKeywords = '';
    public $metaAttributes = array();
	public $menu=array();
	
	public $sape;
	public $linkfeed;
	public $trustlink;
	public $client_lnk;
	public $client_ads;
	public $client_ads_lnk;
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function __construct($id,$module=null){
        parent::__construct($id,$module);
        // If there is a post-request, redirect the application to the provided url of the selected language
        if(isset($_POST['language'])) {
            $lang = $_POST['language'];
            $MultilangReturnUrl = $_POST[$lang];
            $this->redirect($MultilangReturnUrl);
        }
        // Set the application language if provided by GET, session or cookie
        if(isset($_GET['language'])) {
            Yii::app()->language = $_GET['language'];
            Yii::app()->user->setState('language', $_GET['language']);
            $cookie = new CHttpCookie('language', $_GET['language']);
            $cookie->expire = time() + (60*60*24*365); // (1 year)
            Yii::app()->request->cookies['language'] = $cookie;
        }
        else if (Yii::app()->user->hasState('language'))
            Yii::app()->language = Yii::app()->user->getState('language');
        else if(isset(Yii::app()->request->cookies['language']))
            Yii::app()->language = Yii::app()->request->cookies['language']->value;
			
			
			///////////////////////////////////////////////////////////////////////////////////
				//==============================Разместить в конфиге
				/*if (!defined('_SAPE_USER')){
					   define('_SAPE_USER', '5d816ff9d37a6dd663d876c9f2bb2109');
				}
				require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php');
				$this->sape = new SAPE_client();

				//linkfeed   - uplike
				if (!defined('LINKFEED_USER')){
				define('LINKFEED_USER', 'ca91f2ccf924eeea69b3e589a3ff896eb7fdc687');
				}
				require_once($_SERVER['DOCUMENT_ROOT'].'/'.LINKFEED_USER.'/linkfeed.php');
				global $linkfeed;
				$this->linkfeed = new LinkfeedClient();

				//uplike
				  define('TRUSTLINK_USER', '49079d0623801fcc2085e7c8f390fd8956e7b905');
				  require_once($_SERVER['DOCUMENT_ROOT'].'/'.TRUSTLINK_USER.'/trustlink.php');
				  $o['charset'] = 'cp1251'; // кодировка сайта
				  $this->trustlink = new TrustlinkClient($o);
				  unset($o);

				// Mainlinks
				include_once($_SERVER['DOCUMENT_ROOT'].'/_mlinks/mainlink.php'); 
				$o = array('USERNAME' => 'E448BCF36769869DA4529D69AFF09921');
				$this->client_lnk = new MLClient($o);
				$ao = array( 
					'CODE_TYPE' => 'a',
					'USERNAME' => 'F36A822157AD71CCDB99AD23D68DB90C',
				);
				$this->client_ads = new MLClient($ao); 
				// END Mainlinks

				// MainLinkAds code 
				include_once($_SERVER['DOCUMENT_ROOT'].'/_mlinksads/mlads.php'); 
				$o = array('USERNAME' => '17E8535A983B3C6880207FEAC983E5DB','charset' => 'utf','test' => false,'test_num' => 1); 
				$this->client_ads_lnk = new MLAClient($o); */
				// END MainLinkAds code 
			///////////////////////////////////////////////////////////////////////////////////
			
    }
    public function createMultilanguageReturnUrl($lang='ru'){
        if (count($_GET)>0){
            $arr = $_GET;
            $arr['language']= $lang;
        }
        else
            $arr = array('language'=>$lang);
        return $this->createUrl('', $arr);
    }

    /**
     * @param $string
     * @param $count
     * @return string
     */
    public function getShortDescription($string ,$count)
    {
        if(strlen($string) < 50)
            return $string;
        $string = strip_tags($string);
        $string = mb_substr($string, 0, $count,'UTF-8'); // обрезаем и работаем со всеми кодировками и указываем исходную кодировку
        $position = mb_strrpos($string, ' ', 'UTF-8'); // определение позиции последнего пробела. Именно по нему и разделяем слова
        $string = mb_substr($string, 0, $position, 'UTF-8'); // Обрезаем переменную по позиции
        return $string;
    }

    public function getCurrentDate()
    {
        switch(date('w', time()))
        {
            case 0:
                $dayName = Yii::t('main', 'Неділя');
                break;
            case 1:
                $dayName = Yii::t('main', 'Понеділок');
                break;
            case 2:
                $dayName = Yii::t('main', 'Вівторок');
                break;
            case 3:
                $dayName = Yii::t('main', 'Середа');
                break;
            case 4:
                $dayName = Yii::t('main', 'Четвер');
                break;
            case 5:
                $dayName = Yii::t('main', 'Пя\'тниця');
                break;
            case 6:
                $dayName = Yii::t('main', 'Субота');
                break;
        }

        if(Yii::app()->language == 'ru')
        {
            $month_names=array("январь","февраль","март","апрель","май","июнь",
                "июль","август","сентябрь","октябрь","ноябрь","декабрь");
        }
        else
        {
            $month_names=array("Січень","Лютий","Березень","Квітень","Травень","Червень",
                "Липень","Серпень","Вересень","Жовтень","Листопад","Грудень");
        }

        $monthName = $month_names[date('n')-1];

        return $dayName.', '.$monthName.' '.date('d, Y');
    }

    public function getMonth($date)
    {
        if(Yii::app()->language == 'ru')
        {
            $month_names=array("января","февраля","марта","апреля","майя","июня",
                "июля","августа","сентября","октября","ноября","декабря");
        }
        else
        {
            $month_names=array("Січня","Лютого","Березня","Квітня","Травня","Червня",
                "Липня","Серпня","Вересня","Жовтня","Листопада","Грудня");
        }

        return $month_names[date('n', strtotime($date))-1];
    }


}