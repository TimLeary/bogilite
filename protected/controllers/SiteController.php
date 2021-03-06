<?php

class SiteController extends Controller
{
        // for menu
        public $articleList;
        public $media;
        public $keywords;
        public $title;
        public $metaDesc;

        /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{    
            // renders the view file 'protected/views/site/index.php'
            // using the default layout 'protected/views/layouts/main.php'
            $siteName = Yii::app()->request->getParam('page');
            $pageId = Yii::app()->request->getParam('id');
            
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jScrollPane/script/jquery.mousewheel.js',CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jScrollPane/script/jquery.jscrollpane.min.js',CClientScript::POS_HEAD);
            $this->layout='csekeykert';
            if(($siteName == null)AND($pageId == null)){
                $siteName = bogiliteConfig::DEFAULT_PAGE;
            }
            
            $wPage = new Article();
            
            if($pageId != null){
                $wPageData = $wPage->getArticleByPageId($pageId);
            } else {
                $wPageData = $wPage->getArticleBySUrl($siteName);
            }
            
            $this->articleList = $wPage->getArticleList();
            
            $wMedia = new Medium();
            $wMediaData = $wMedia->getMedium(bogiliteConfig::ARTICLE_AREA_ID, $wPageData['article_id']);
            $this->media = $wMediaData;
            $this->title = $wPageData['article_title'];
            $this->metaDesc = $wPageData['article_description'];
            $this->keywords = $wPageData['keywords'];
            
            $this->render('index',array('article' => $wPageData['article_text'],'title' => $wPageData['article_title']));
	}
        
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}