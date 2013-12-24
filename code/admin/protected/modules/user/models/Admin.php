<?php
/**
 * 后台管理用户认证
 * 
 * @author     齐维刚
 * @date       2013-11-21
 * @version    1.0 
 */

class Admin extends CActiveRecord {
	
/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{Admin}}';
	}
	
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $password===$this->password;
	}
	
}