<?php

class MediumController extends Controller
{
	public function actionGetMedium()
	{
                $this->layout=false;
                $objectId = Yii::app()->request->getParam('objectId');
                $areaId = Yii::app()->request->getParam('areaId');
                
                $wMedia = MediaToObject::model()->with('medium')->findAll('object_id = :objectId and area_id = :areaId',array(':objectId' => $objectId, ':areaId' => $areaId));
                //var_dump($wMedia);
		$this->render('getMedium');
	}
        
        public function actionImageUploader(){
            $objectId = Yii::app()->request->getParam('objectId');
            $areaId = Yii::app()->request->getParam('areaId');
            $newFileUrl = null;
            
            //var_dump($_FILES);
            
            if($_FILES != null){
                $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
                if ($_FILES['file']['type'] == 'image/png'
                || $_FILES['file']['type'] == 'image/jpg'
                || $_FILES['file']['type'] == 'image/gif'
                || $_FILES['file']['type'] == 'image/jpeg'
                || $_FILES['file']['type'] == 'image/pjpeg')
                {	
                    move_uploaded_file($_FILES["file"]["tmp_name"],APP_PATH.'/images/uploaded/'.$_FILES["file"]["name"]);

                    $newFileUrl =  Yii::app()->baseUrl.'/images/uploaded/'.$_FILES["file"]["name"];
                }
            }
            $this->renderPartial('imageUploader',array('objectId'=>$objectId,'areaId'=>$areaId, 'newFileUrl' => $newFileUrl),false,true);
        }
            
        public function actionUploadify(){
            $this->layout=false;
            $objectId = Yii::app()->request->getParam('objectId');
            $areaId = Yii::app()->request->getParam('areaId');
            
            $_FILES['Filedata']['type'] = strtolower($_FILES['Filedata']['type']);
            if ($_FILES['Filedata']['type'] == 'image/png'
            || $_FILES['Filedata']['type'] == 'image/jpg'
            || $_FILES['Filedata']['type'] == 'image/gif'
            || $_FILES['Filedata']['type'] == 'image/jpeg'
            || $_FILES['Filedata']['type'] == 'image/pjpeg')
            {	
                move_uploaded_file($_FILES["Filedata"]["tmp_name"],APP_PATH.'/images/uploaded/'.$_FILES["Filedata"]["name"]);

                $newFileUrl =  Yii::app()->baseUrl.'/images/uploaded/'.$_FILES["Filedata"]["name"];
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
            
        }
        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}