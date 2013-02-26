<?php

class MediumController extends Controller
{
        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('getMedium'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('imageUploader','imageSorter','changeSort','update','admin','delete','imageUpload'),
				'expression' => 'Yii::app()->user->isAdmin()==1'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	public function actionGetMedium()
	{
            $this->layout=false;
            $objectId = Yii::app()->request->getParam('objectId');
            $areaId = Yii::app()->request->getParam('areaId');
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

                    $newFileUrl =  /* Yii::app()->baseUrl.*/'/images/uploaded/'.$_FILES["file"]["name"];
                    
                    $wObjNum = count(MediaToObject::model()->findAll('object_id = :objectId and area_id = :area_id',array(':objectId'=>$objectId, ':area_id'=>$areaId)));
                    
                    $wImage = new Medium();
                    $wImage->setAttributes(array(
                        'mime_type' => $_FILES['file']['type'],
                        'url' => $newFileUrl
                    ));
                    $wImage->save();
                    $imageId = $wImage->getPrimaryKey();
                    
                    $wImageToObject = new MediaToObject();
                    $wImageToObject->setAttributes(array(
                        'medium_id' => $imageId, 
                        'area_id' => $areaId,
                        'object_id' => $objectId,
                        'priority' => $wObjNum + 1
                    ));
                    $wImageToObject->save();
                }
            }
            $this->renderPartial('imageUploader',array('objectId'=>$objectId,'areaId'=>$areaId, 'newFileUrl' => $newFileUrl),false,true);
        }
            
        public function actionImageSorter(){
            $objectId = Yii::app()->request->getParam('objectId');
            $areaId = Yii::app()->request->getParam('areaId');
            
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

            $this->renderPartial('imageSorter',array('objectId'=>$objectId,'areaId'=>$areaId,'wImages' => $wImages),false,true);
        }
        
        public function actionChangeSort(){
            $objectId = Yii::app()->request->getParam('objectId');
            $areaId = Yii::app()->request->getParam('areaId');
            $newOrderStr = Yii::app()->request->getParam('newOrderStr');
            
            $wMedias = MediaToObject::model()->findAll('object_id = :objectId and area_id = :areaId',array(':objectId' => $objectId, ':areaId' => $areaId));
            $newOrderObj = CJSON::decode($newOrderStr,TRUE);
            foreach ($wMedias as $wMedia) {
                $natPosition = array_search($wMedia->medium_id,$newOrderObj['newOrder']);
                $position = $natPosition + 1;
                $wMedia->setAttribute('priority',$position);
                $wMedia->save();
            }
        }
}