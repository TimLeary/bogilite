<?php var_dump($newFileUrl); ?>

<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
<?php echo CHtml::fileField('file'); ?>
<?php echo CHtml::ajaxSubmitButton(Yii::t('app', 'Upload'), Yii::app()->createUrl('medium/imageUploader', array('objectId'=>$objectId,'areaId' => $areaId)),array('replace' => '.images'),array('name'=>'imageLoader')); ?>
<?php echo CHtml::endForm(); ?>
<!--<form method="post" action="" enctype="multipart/form-data">
    <input type="file" id="uploadableFile" name="file" />
    
</form>-->