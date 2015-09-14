<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<?php ilost_get_iexuaCompatible();?>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<title><?php if(is_single()){single_post_title();echo ' - ';echo ilost_wp_name;}elseif(is_home()||is_front_page()){echo ilost_wp_name;ilost_page_number();}elseif(is_page()){single_post_title(''); echo ' - ';echo ilost_wp_name;}elseif(is_search()){printf( __('Search results for "%s"','iLost'),esc_html($s));ilost_page_number();echo ' - '; echo ilost_wp_name;}elseif(is_404()){_e('Error 404 - Not Found','iLost');echo ' - ';echo ilost_wp_name;}else{wp_title('');echo ' - ';echo ilost_wp_name;ilost_page_number();}?></title>
<?php if(is_front_page()){?>
<meta name="description" content="<?php echo ilost_wp_description;?>" />
<meta name="keywords" content="<?php echo ilost_wp_name;echo ', '.ilost_searchKey();?>" />
<?php }elseif(is_tag()){?>
<meta name="description" content="<?php single_tag_title();?> related content posted by <?php echo ilost_wp_name;?>,enjoy reading <?php single_tag_title();?><?php $paged=get_query_var('paged');if($paged>1)printf('page %s',$paged);?>" />
<meta name="keywords" content="<?php single_tag_title();echo ilost_searchKey();?>" />
<?php }elseif(is_category()){?>
<meta name="description" content="<?php wp_title('');?> related content <?php $paged=get_query_var('paged');if($paged>1)printf('page %s',$paged);?> posted by <?php echo ilost_wp_name;?>,enjoy reading <?php wp_title('');?> related content." />
<meta name="keywords" content="<?php wp_title('');?>" />
<?php }elseif(is_single()){$description=strip_tags($post->post_excerpt);$keywords="";$tags=wp_get_post_tags($post->ID);foreach($tags as $tag){$keywords=$keywords.$tag->name.", ";}?>
<meta name="description" content="<?php echo $description?>" />
<meta name="keywords" content="<?php echo $keywords.ilost_searchKey();?>" />
<?php }ilost_is_mobileos();?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="theme author" href="Xu.hel,xw@xuui.net" />
<?php ilost_getfavicon();ilost_getstyles();?>
<link rel="pingback" href="<?php echo ilost_wp_pingback_url;?>" />
<?php ilost_customRssurl();?>
<!--[if lt IE 9]>
<script src="<?php echo(ilost_path.'/scripts/html5shiv.min.js');?>"></script>
<script src="<?php echo(ilost_path.'/scripts/respond.min.js');?>"></script>
<![endif]-->
<?php wp_head();?>
</head>
<body <?php body_class();?>>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#ilost-collapse">&equiv;</button>
      <?php ilost_getlogoimg();?>
    </div>
    <div class="collapse navbar-collapse" id="ilost-collapse">
      <?php wp_nav_menu(array('theme_location'=>'primary','container'=>'ul','container_id'=>'navs','menu_class'=>'nav navbar-nav navbar-right'));?>
    </div>
  </div>
</nav>
  <?php //if(!is_front_page()){echo '<div id="container" class="container">';}elseif(is_home()){echo '<div id="container" class="container">';}?>
<?php if(is_front_page()){ilost_getiloshow();}?>
<div id="container" class="container">
