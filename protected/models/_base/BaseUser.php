<?php

/**
 * This is the model base class for the table "tbl_users".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "User".
 *
 * Columns in table "tbl_users" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $createtime
 * @property string $lastvisit
 * @property integer $superuser
 * @property string $status
 *
 */
abstract class BaseUser extends CActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'users';
	}

	public function rules() {
		return array(
			array('password, email, createtime, lastvisit', 'required'),
			array('superuser', 'numerical', 'integerOnly'=>true),
			array('password, email', 'length', 'max'=>128),
			array('status', 'length', 'max'=>6),
			array('superuser, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, password, email, createtime, lastvisit, superuser, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'password' => Yii::t('app', 'Password'),
			'email' => Yii::t('app', 'Email'),
			'createtime' => Yii::t('app', 'Createtime'),
			'lastvisit' => Yii::t('app', 'Lastvisit'),
			'superuser' => Yii::t('app', 'Superuser'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('createtime', $this->createtime, true);
		$criteria->compare('lastvisit', $this->lastvisit, true);
		$criteria->compare('superuser', $this->superuser);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}