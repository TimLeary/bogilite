<?php

class WebUser extends CWebUser {
    private $_model;
    
    public function isGuest() {
        if(Yii::app()->user->id != null)
            return 0;
        else 
            return 1;
    }

    public function isAdmin() {
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user===null)
            return 0;
        else
            return (int)$user->superuser;
    }
    
    public function getEmail() {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user != null){
            return $user->email;
        }
    }
    
    protected function loadUser($id=null){
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=User::model()->findByPk($id);
        }
        return $this->_model;
    }
}
?>
