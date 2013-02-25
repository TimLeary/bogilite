<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        public $email;
        public $password;
        private $_id;
        private $_superUser;
        
        public function __construct($email,$password)
	{
		$this->email=$email;
		$this->password=$password;
	}
        
        public function authenticate() {
            //parent::authenticate();
            $email = $this->email;
            $wUser = User::model()->find('email = :email',array(':email' => $email));
            if($wUser === null){
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            } elseif (!$wUser->validatePassword($this->password)) {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            } else {
                $this->_id = $wUser->id;
                $this->_superUser = $wUser->superuser;
                $this->errorCode=self::ERROR_NONE;
            }
            
            return $this->errorCode==self::ERROR_NONE;
        }
 
        public function getId(){
            return $this->_id;
        }
        
        public function isSuperuser(){
            return $this->_superUser;
        }
        /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
        /*
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}*/
}