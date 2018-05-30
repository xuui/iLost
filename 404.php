<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php echo ilost_wp_charset;?>" />
<title><?php _e('Error 404 - Not Found','iLost');echo ' - ';echo ilost_wp_name;?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php ilost_getfavicon();ilost_getstyles();?>
<link rel="pingback" href="<?php echo ilost_wp_pingback_url;?>" />
<?php ilost_is_mobileos();
wp_head();?>
</head>
<body class="error">
<div id="wrapper">
<img src="<?php echo ilost_path.'/images/error404.png';?>" alt="Error 404" border=0 />
<p class="button"><a class="btn btn-default" href="<?php echo ilost_wp_homeurl.'/';?>">Back to Home</a></p>
<footer>
  <p>&copy;2006-2018 <a href="<?php echo ilost_wp_homeurl.'/';?>/"><?php echo ilost_wp_name;?></a></p>
</footer>
</div>
<?php wp_footer();?>
</body>
</html>