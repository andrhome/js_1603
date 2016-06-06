<?php

/**
 * This is the model class for table "pools_ip".
 *
 * The followings are the available columns in table 'pools_ip':
 * @property integer $id
 * @property string $ip
 * @property integer $answer_id
 * @property integer $pool_id
 *
 * The followings are the available model relations:
 * @property Answers $answer
 * @property Pools $pool
 */
class PoolsIp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pools_ip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, answer_id, pool_id', 'required'),
			array('answer_id, pool_id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ip, answer_id, pool_id', 'safe', 'on'=>'search'),
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
			'answer' => array(self::BELONGS_TO, 'Answers', 'answer_id'),
			'pool' => array(self::BELONGS_TO, 'Pools', 'pool_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main', 'ID'),
			'ip' => Yii::t('main', 'Ip'),
			'answer_id' => Yii::t('main', 'Answer'),
			'pool_id' => Yii::t('main', 'Pool'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('answer_id',$this->answer_id);
		$criteria->compare('pool_id',$this->pool_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PoolsIp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
