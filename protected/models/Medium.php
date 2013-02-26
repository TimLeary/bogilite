<?php

/**
 * This is the model class for table "medium".
 *
 * The followings are the available columns in table 'medium':
 * @property integer $medium_id
 * @property string $mime_type
 * @property string $url
 * @property integer $language_id
 * @property string $name
 * @property string $subtitle
 *
 * The followings are the available model relations:
 * @property MediaToObject[] $mediaToObjects
 */
class Medium extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Medium the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'medium';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mime_type', 'required'),
			array('language_id', 'numerical', 'integerOnly'=>true),
			array('mime_type, subtitle', 'length', 'max'=>45),
			array('url, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('medium_id, mime_type, url, language_id, name, subtitle', 'safe', 'on'=>'search'),
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
			'mediaToObjects' => array(self::HAS_MANY, 'MediaToObject', 'medium_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'medium_id' => 'Medium',
			'mime_type' => 'Mime Type',
			'url' => 'Url',
			'language_id' => 'Language',
			'name' => 'Name',
			'subtitle' => 'Subtitle',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('medium_id',$this->medium_id);
		$criteria->compare('mime_type',$this->mime_type,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('subtitle',$this->subtitle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getMedium($areaId,$objectId)
	{
            $criteria = new CDbCriteria;
            $criteria->with = 'medium'; 
            $criteria->condition = 'object_id = :objectId and area_id = :areaId';
            $criteria->params = array(
                ':objectId' => $objectId,
                ':areaId' => $areaId
            );
            $criteria->together = true;
            $criteria->order = 'priority';
            $wImages = MediaToObject::model()->findAll($criteria);
            $wMediaData = array();
            if($wImages != null){
                foreach ($wImages as $wImage){
                    $wMediaData[] = $wImage->medium->getAttributes();
                }
            }
            return $wMediaData;
	}
}