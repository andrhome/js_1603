<?php

/**
 * This is the model class for table "photo_category".
 *
 * The followings are the available columns in table 'photo_category':
 * @property integer $id
 * @property string $image
 * @property string $name_ru
 * @property string $name_uk
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Photo[] $photos
 */
class PhotoCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'photo_category';
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PhotoCategory the static model class
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
			array('image, name_ru, name_uk, meta_title_ru, meta_title_uk, meta_description_ru, meta_description_uk', 'length', 'max'=>255),
			array('author', 'length', 'max'=>100),
			array('description, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, name_ru, name_uk, description, meta_title_ru, meta_description_ru, date, author', 'safe', 'on'=>'search'),
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
			'photos' => array(self::HAS_MANY, 'Photo', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main','ID'),
			'image' => Yii::t('main','Image'),
			'name_ru' => Yii::t('main','Name Ru'),
			'name_uk' => Yii::t('main','Name Uk'),
			'description' => Yii::t('main','Description'),
			'date' => Yii::t('main','Date'),
			'date' => Yii::t('main','Автор'),
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

		$criteria->order = 'id DESC';
		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_uk',$this->name_uk,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('meta_title_ru',$this->meta_title_ru,true);
		$criteria->compare('meta_description_ru',$this->meta_description_ru,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('author',$this->author,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeDelete()

    {
        Photo::model()->deleteAll('category_id = '.$this->id);
        return parent::beforeDelete();
    }
}
