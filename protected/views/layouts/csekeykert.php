<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/csekeykert.css" />
</head>
<body>
<div id="mainContainer">
    <div id="contentRow">
        <div id="menusor">
            <div id="logo"><a href="http://www.kertepito.eu" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/csekeykert/csekeykert_logo.png" border="0" /></a></div>
            <div id="menu">
            </div>
        </div>
        <div id="cHolder">
            <div id="picMover"></div>
            <div class="content"><?php echo $content; ?></div>
        </div>
        <div id="gHolder"></div>
    </div>
</div>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22915133-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>