<?php

/**
 * This is the model class for table "news_category".
 *
 * The followings are the available columns in table 'news_category':
 * @property integer $id
 * @property string $alias
 * @property string $name_ru
 * @property string $name_uk
 * @property integer $parent_id
 * @property string $description_ru
 * @property string $description_uk
 * @property string $meta_title_ru
 * @property string $meta_title_uk
 * @property string $meta_description_ru
 * @property string $meta_description_uk
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_uk
 *
 * The followings are the available model relations:
 * @property News[] $news
 */
class NewsCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news_category';
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewsCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_ru, name_uk', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('alias', 'length', 'max'=>150),
			array('name_ru, name_uk, meta_title_ru, meta_title_uk, meta_description_ru, meta_description_uk, meta_keywords_ru, meta_keywords_uk', 'length', 'max'=>250),
			array('description_ru, description_uk', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alias, name_ru, name_uk, parent_id, description_ru, description_uk, meta_title_ru, meta_title_uk, meta_description_ru, meta_description_uk, meta_keywords_ru, meta_keywords_uk', 'safe', 'on'=>'search'),
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
			'news' => array(self::HAS_MANY, 'News', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main','ID'),
			'alias' => Yii::t('main','Alias'),
			'name_ru' => Yii::t('main','Name Ru'),
			'name_uk' => Yii::t('main','Name Uk'),
			'parent_id' => Yii::t('main','Parent'),
			'description_ru' => Yii::t('main','Description Ru'),
			'description_uk' => Yii::t('main','Description Uk'),
			'meta_title_ru' => Yii::t('main','Meta Title Ru'),
			'meta_title_uk' => Yii::t('main','Meta Title Uk'),
			'meta_description_ru' => Yii::t('main','Meta Description Ru'),
			'meta_description_uk' => Yii::t('main','Meta Description Uk'),
			'meta_keywords_ru' => Yii::t('main','Meta Keywords Ru'),
			'meta_keywords_uk' => Yii::t('main','Meta Keywords Uk'),
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

		$criteria->order = 'id DESC';
		$criteria->compare('id',$this->id);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_uk',$this->name_uk,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('description_ru',$this->description_ru,true);
		$criteria->compare('description_uk',$this->description_uk,true);
		$criteria->compare('meta_title_ru',$this->meta_title_ru,true);
		$criteria->compare('meta_title_uk',$this->meta_title_uk,true);
		$criteria->compare('meta_description_ru',$this->meta_description_ru,true);
		$criteria->compare('meta_description_uk',$this->meta_description_uk,true);
		$criteria->compare('meta_keywords_ru',$this->meta_keywords_ru,true);
		$criteria->compare('meta_keywords_uk',$this->meta_keywords_uk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
}
