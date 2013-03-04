<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $this->title; ?></title>   
    <meta name="keywords" content="<?php echo $this->keywords; ?>" /> 
    <meta name="description" content="<?php echo $this->metaDesc; ?>" /> 
    <meta name="ROBOTS" content="INDEX, FOLLOW" />
    
    <meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jScrollPane/style/jquery.jscrollpane.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/csekeykert.css" />
</head>
<body>
<table width="100%" style="height:100%" cellpadding="0" cellspacing="0" >
<tr>
	<td width="49%">&nbsp;</td>
    <td width="920" valign="middle">
<div id="mainContainer">
    <div id="contentRow">
        <div id="menusor">
            <div id="logo"><a href="http://www.kertepito.eu" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/csekeykert/csekeykert_logo.png" border="0" /></a></div>
            <div id="menu">
                <ul>
                    <?php foreach($this->articleList as $menuItem): ?>
                        <li><a id="article-<?php echo $menuItem['article_id']; ?>" href="<?php echo Yii::app()->createUrl('site/index',array('page' => $menuItem['simplefied_url'])); ?>"><?php echo $menuItem['article_title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div id="cHolder">
            <div id="picMover">
            </div>
            <div class="content scroll-pane"><?php echo $content; ?></div>
        </div>
        <div id="slideshow">
            <?php foreach ($this->media as $medium): ?>
                <img src="<?php echo Yii::app()->request->baseUrl.$medium['url']; ?>" />
            <?php endforeach; ?>
        </div>
    </div>
</div>
    </td>
    <td width="49%">&nbsp;</td>
</tr>
</table>
<script type="text/javascript">
<?php if(count($this->media)>1): ?>
function slideSwitch() {
    var $active = $('#slideshow IMG.active');

    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

    var $next =  $active.next().length ? $active.next()
        : $('#slideshow IMG:first');

    $active.addClass('last-active');
        
    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}

$(function() {
    setInterval( "slideSwitch()", 5000 );
});
<?php endif; ?>
$('.content').jScrollPane();

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