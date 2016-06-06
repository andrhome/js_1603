<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $role
 * @property string $username
 * @property string $name
 * @property string $password
 * @property string $reg_date
 * @property string $birth_date
 * @property integer $sex
 * @property integer $region
 * @property integer $city
 * @property string $email2
 * @property string $avatar
 * @property string $verification
 * @property integer $active
 * @property integer $telephone
 * @property integer $description
 * @property integer $profession
 *
 * The followings are the available model relations:
 * @property Articles[] $articles
 * @property Blogers $blogers
 */
class User extends CActiveRecord
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER= 'manager';
    const ROLE_BLOGER= 'bloger';
    const ROLE_BANNED = 'banned';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
            array('username', 'unique', 'allowEmpty'=>false, 'attributeName'=>'username', 'className'=>'User'),
			array('sex, region, city, active', 'numerical', 'integerOnly'=>true),
			array('role, telephone', 'length', 'max'=>50),
			array('password', 'length', 'min'=>6),
            array('description', 'safe'),
			array('username, location', 'length', 'max'=>150),
			array('name, password, profession, avatar, verification', 'length', 'max'=>255),
			array('username', 'email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role, location, telephone, description, username, name, password, reg_date, birth_date, sex, region, city, email2, avatar, verification, active', 'safe', 'on'=>'search'),
		);
	}

    public function activeCaptcha() {

        $code = Yii::app()->controller->createAction('captcha')->getVerifyCode();

        if ($code != $this->verifyCode)
            $this->addError('verifyCode', 'Неправильный код проверки.');

        if (!(isset($_POST['ajax']) && $_POST['ajax']==='registration-form'))
            Yii::app()->controller->createAction('captcha')->getVerifyCode(true);

    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'articles' => array(self::HAS_MANY, 'Articles', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main', 'ID'),
			'role' => Yii::t('main', 'Role'),
			'username' => Yii::t('main', 'email'),
			'name' => Yii::t('main', 'ФИО'),
			'telephone' => Yii::t('main', 'Номер телефона'),
			'password' => Yii::t('main', 'Пароль'),
			'password_2' => Yii::t('main', 'Повторите пароль'),
			'reg_date' => Yii::t('main', 'Reg Date'),
			'birth_date' => Yii::t('main', 'День рождения'),
			'sex' => Yii::t('main', 'Стать'),
			'region' => Yii::t('main', 'Region'),
			'city' => Yii::t('main', 'City'),
			'email2' => Yii::t('main', 'Email2'),
			'avatar' => Yii::t('main', 'Avatar'),
			'verification' => Yii::t('main', 'Verification'),
			'active' => Yii::t('main', 'Active'),
			'verifyCode' => Yii::t('main', 'Код проверки'),
			'description' => Yii::t('main', 'О себе'),
			'profession' => Yii::t('main', 'Професия'),
		);
	}

    public function getStringSex()
    {
        return $this->sex == 1 ? Yii::t('main', 'Чоловіча') : Yii::t('main', 'Жіноча');
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('reg_date',$this->reg_date,true);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('region',$this->region);
		$criteria->compare('city',$this->city);
		$criteria->compare('email2',$this->email2,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('verification',$this->verification,true);
		$criteria->compare('telephone',$this->telephone);
		$criteria->compare('active',$this->active);
		$criteria->compare('description',$this->description);
		$criteria->compare('profession',$this->profession);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function sendMail($user, $subject, $link)
    {
        // несколько получателей
        $to  = $user->username;
        // текст письма
        $message = '
            <table class="wrapp" style="width:600px; background: url(http://val.ua/mail/back.jpg); border-collapse:collapse; font-family: Arial;">
				<tr>
					<td style="background: #fff; border:1px solid #e3e3e3; padding: 10px 50px 10px 50px; text-align: center">
						<img src="http://garmata.tv/mail/mail.png" style="width: 350px;" alt="">
					</td>
				</tr>
				<tr style="text-align: center" > 
					<td  colspan="2" style="padding: 10px 50px 50px 50px;">
						<h2 style="font-size: 23px; font-weight: normal; text-aligin: center;">Ви зареєструвалися на порталі Val.ua</h2>
						<p style="color: #6c6c6c; font-size: 12px; text-align: center; margin: 0;">Не забувайте ваш пароль і email він служить для входу на сайт <a style="color: #6288A5; text-decoration: underline; font-size: 12px" href="http://val.ua">val.ua</a></p>
						<hr style="margin: 35px 0; background: #e3e3e3; height: 1px; border: none" noshade="">
						<table width="100%">
							<tr>
								<td style="background-image: url(http://val.ua/mail/backFigure.png); background-color: #6288A5; padding: 30px 65px; color: #fff; font-size: 23px; letter-spacing: 1px;">Реєстраційні дані:</td>
							</tr>
							<tr>
								<td style="background: #fff; padding: 25px 5px 25px 5px; font-size: 25px; border: 1px solid #e3e3e3; border-top: none; text-align: center">
									<p style="font-size: 12px; color: #6c6c6c; margin: 0" >Пошта:</p>
									<h3 style="font-size: 20px; font-weight: normal; margin: 10px 0 30px 0">'.$user->username.'</h3>
									<p style="font-size: 12px; color: #6c6c6c; margin: 0" >Пароль:</p>
									<h3 style="font-size: 20px;  font-weight: normal; margin: 10px 0 0 0">'.$user->password.'</h3>	
								</td>
							</tr>
						</table>
						<h4 style=" font-size: 13px; text-align: center;  margin: 35px 0 20px 0; letter-spacing: 1px; line-height: 23px">Перейдіть по посиланню для підтвердження реєстрації <br><a style="color: #6288A5; text-decoration: underline; font-size: 13px" href="'.$link.'">'.$link.'</a> </h4>
						<a href="http://val.ua" style="display: inline-block; padding: 12px 17px 10px 17px;   background: #6288A5; color: #fff; text-transform: uppercase; border-radius: 2px; font-size:12px; text-decoration: none;">Перейти на сайт</a>
					</td>	
				</tr>
			</table>
        ';

        // Для отправки HTML-письма должен быть установлен заголовок Content-type
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
        // Дополнительные заголовки
        $headers .= 'To: '.$user->name.' <'.$user->username.'>'. "\r\n";
        $headers .= 'From: Val.ua <news@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        return mail($to, $subject, $message, $headers);
    }

    public function getUserSex()
    {
        if($this->sex == 1)
        {
            return Yii::t('main', 'Мужской');
        }
        else
            return Yii::t('main', 'Женский');
    }
}
