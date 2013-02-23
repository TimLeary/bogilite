<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $article_id
 * @property string $simplefied_url
 * @property string $article_short
 * @property string $article_text
 * @property string $article_title
 * @property string $article_description
 *
 * The followings are the available model relations:
 * @property KeywordsToArticle[] $keywordsToArticles
 */
class Article extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('simplefied_url', 'required'),
			array('simplefied_url, article_title, article_description', 'length', 'max'=>255),
			array('article_short, article_text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_id, simplefied_url, article_short, article_text, article_title, article_description', 'safe', 'on'=>'search'),
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
			'keywordsToArticles' => array(self::HAS_MANY, 'KeywordsToArticle', 'article_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'article_id' => 'Article',
			'simplefied_url' => 'Simplefied Url',
			'article_short' => 'Article Short',
			'article_text' => 'Article Text',
			'article_title' => 'Article Title',
			'article_description' => 'Article Description',
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

		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('simplefied_url',$this->simplefied_url,true);
		$criteria->compare('article_short',$this->article_short,true);
		$criteria->compare('article_text',$this->article_text,true);
		$criteria->compare('article_title',$this->article_title,true);
		$criteria->compare('article_description',$this->article_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}