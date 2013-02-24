<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
<?php echo CHtml::fileField('file'); ?>
<?php echo CHtml::submitButton(Yii::t('app', 'Upload'),array('id'=>'imageLoader')); ?>
<?php echo CHtml::endForm(); ?>
<script type="text/javascript">
    window.onload = function() {
        parent.iframeLoaded();
    }
</script>