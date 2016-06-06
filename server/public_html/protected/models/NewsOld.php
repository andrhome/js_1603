<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $image
 * @property string $date
 * @property string $modify_date
 * @property string $title_ru
 * @property string $title_uk
 * @property string $description_ru
 * @property string $description_uk
 * @property integer $views
 * @property integer $category_id
 * @property string $tags
 * @property integer $galery_id
 * @property string $author
 * @property string $author_id
 * @property string $modify_by_id
 * @property integer $main
 * @property integer $on_index
 * @property integer $region
 * @property integer $marker
 *
 * The followings are the available model relations:
 * @property NewsCategory $category
 */
class NewsOld extends CActiveRecord
{
    const NONE = 0;
    const RED = 1;
    const BOLD = 2;
    const RED_BOLD = 3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news_old';
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeValidate()
    {
        if($this->isNewRecord)
        {
            //$this->date = new CDbExpression('NOW()');
            $this->author_id = Yii::app()->user->id;
        }
        else
        {
            $this->modify_date = new CDbExpression('NOW()');
            $this->modify_by_id = Yii::app()->user->id;
        }

        return parent::beforeValidate();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ru, date, title_uk, description_ru, description_uk', 'required'),
			array('views, author_id, modify_by_id, marker, category_id, galery_id, main, on_index', 'numerical', 'integerOnly'=>true),
			array('image, title_ru, title_uk, tags, meta_title_ru, meta_title_uk, meta_description_ru, meta_description_uk', 'length', 'max'=>255),
			array('author', 'length', 'max'=>150),
			array('region', 'length', 'max'=>150),
			array('date, modify_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, marker, image, region, on_index, date, title_ru, title_uk, description_ru, description_uk, views, category_id, tags, galery_id, author, main', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category' => array(self::BELONGS_TO, 'NewsCategory', 'category_id'),
            'owner' => array(self::BELONGS_TO, 'User', 'author_id'),
            'modify' => array(self::BELONGS_TO, 'User', 'modify_by_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main','ID'),
			'image' => Yii::t('main','Фото'),
			'date' => Yii::t('main','Дата'),
			'title_ru' => Yii::t('main','Заголовок Ru'),
			'title_uk' => Yii::t('main','Заголовок Uk'),
			'description_ru' => Yii::t('main','Текст новини Ru'),
			'description_uk' => Yii::t('main','Текст новини Uk'),
			'views' => Yii::t('main','Перезляди'),
			'category_id' => Yii::t('main','Категорія'),
			'tags' => Yii::t('main','Теги(перечисліть через кому)'),
			'galery_id' => Yii::t('main','Galery'),
			'author' => Yii::t('main','Автор новини'),
			'main' => Yii::t('main','Сюжет дня'),
			'on_index' => Yii::t('main','показувати в новинах'),
			'region' => Yii::t('main','Регіон'),
			'marker' => Yii::t('main','Виділити новину'),
			'meta_title_ru' => Yii::t('main','meta title ru'),
			'meta_title_uk' => Yii::t('main','meta title uk'),
			'meta_description_ru' => Yii::t('main','meta description ru'),
			'meta_description_uk' => Yii::t('main','meta description uk'),
		);
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
        $criteria->order = 'date DESC';

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_uk',$this->title_uk,true);
		$criteria->compare('description_ru',$this->description_ru,true);
		$criteria->compare('description_uk',$this->description_uk,true);
		$criteria->compare('views',$this->views);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('galery_id',$this->galery_id);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('main',$this->main);
		$criteria->compare('region',$this->region);
		$criteria->compare('on_index',$this->on_index);
		$criteria->compare('marker',$this->marker);
        if(Yii::app()->user->role == 'manager') {
            $criteria->with = array('owner');
            $criteria->addCondition('owner.role = "manager"');
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
}
