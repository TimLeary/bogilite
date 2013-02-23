<?php

/**
 * This is the model class for table "keywords_to_article".
 *
 * The followings are the available columns in table 'keywords_to_article':
 * @property integer $keywords_to_article_id
 * @property integer $article_id
 * @property integer $keywords_id
 * @property integer $priority
 *
 * The followings are the available model relations:
 * @property Article $article
 * @property Keywords $keywords
 */
class KeywordsToArticle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return KeywordsToArticle the static model class
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
		return 'keywords_to_article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, keywords_id', 'required'),
			array('article_id, keywords_id, priority', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('keywords_to_article_id, article_id, keywords_id, priority', 'safe', 'on'=>'search'),
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
			'article' => array(self::BELONGS_TO, 'Article', 'article_id'),
			'keywords' => array(self::BELONGS_TO, 'Keywords', 'keywords_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'keywords_to_article_id' => 'Keywords To Article',
			'article_id' => 'Article',
			'keywords_id' => 'Keywords',
			'priority' => 'Priority',
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

		$criteria->compare('keywords_to_article_id',$this->keywords_to_article_id);
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('keywords_id',$this->keywords_id);
		$criteria->compare('priority',$this->priority);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}