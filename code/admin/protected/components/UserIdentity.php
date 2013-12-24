<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */

class UserIdentity extends CUserIdentity
{
	private $role_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		Yii::import('application.modules.user.models.Admin');
		
		$user=Admin::model()->find('LOWER(account)=:name',array(':name'=>strtolower($this->username)));
		if($user===null)
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if(!$user->validatePassword($this->password))
		{
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			$this->username=$user->account;
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}
}

?>