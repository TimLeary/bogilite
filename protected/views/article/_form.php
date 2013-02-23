<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

$this->widget('ImperaviRedactorWidget', array(
    // the textarea selector
    'selector' => '.redactor',
    // some options, see http://imperavi.com/redactor/docs/
    'options' => array(
        'imageUpload' => Yii::app()->createUrl('article/ImageUpload')
    ),
));

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
)); 
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'article_title'); ?>
		<?php echo $form->textField($model,'article_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'article_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'simplefied_url'); ?>
		<?php echo $form->textField($model,'simplefied_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'simplefied_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_short'); ?>
		<?php echo $form->textArea($model,'article_short',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'article_short'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_text'); ?>
		<?php echo $form->textArea($model,'article_text',array('rows'=>10, 'cols'=>50, 'class' => 'redactor')); ?>
		<?php echo $form->error($model,'article_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_description'); ?>
		<?php echo $form->textField($model,'article_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'article_description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->