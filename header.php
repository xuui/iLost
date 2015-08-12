<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>" />
<title><?php if(is_single()){single_post_title();echo ' - ';bloginfo('name');}elseif(is_home()||is_front_page()){bloginfo('name');ilost_page_number();}elseif(is_page()){single_post_title(''); echo ' - ';bloginfo('name');}elseif(is_search()){printf( __('Search results for "%s"','iLost'),esc_html($s));ilost_page_number();echo ' - '; bloginfo('name');}elseif(is_404()){_e('Error 404 - Not Found','iLost');echo ' - ';bloginfo('name');}else{wp_title('');echo ' - ';bloginfo('name');ilost_page_number();}?></title>
<?php if(is_front_page()){?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="<?php bloginfo('name'); ?>" />
<?php }elseif(is_tag()){?>
<meta name="description" content="<?php single_tag_title();?> related content posted by <?php bloginfo('name');?>,enjoy reading <?php single_tag_title();?><?php $paged=get_query_var('paged');if($paged>1)printf('page %s',$paged);?>" />
<meta name="keywords" content="<?php single_tag_title();?>" />
<?php }elseif(is_category()){?>
<meta name="description" content="<?php wp_title('');?> related content <?php $paged=get_query_var('paged');if($paged>1)printf('page %s',$paged);?> posted by <?php bloginfo('name');?>,enjoy reading <?php wp_title('');?> related content." />
<meta name="keywords" content="<?php wp_title('');?>" />
<?php }elseif(is_single()){$description=strip_tags($post->post_excerpt);$keywords="";$tags=wp_get_post_tags($post->ID);foreach($tags as $tag){$keywords=$keywords.$tag->name.", ";}?>
<meta name="description" content="<?php echo $description?>" />
<meta name="keywords" content="<?php echo $keywords;?>" />
<?php }?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url');?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
<?php wp_head();?>
</head>
<body <?php body_class();?>>
<header>
	<?php get_search_form();?>
	<div class="hgroup">
	<h1><a href="<?php echo home_url('/');?>"><?php bloginfo('name');?></a></h1>
	<span class="hidden"><?php bloginfo('description');?></span>
	<a class="feedrss" href="<?php bloginfo('rss2_url');?>">Feed Rss</a>
  </div>
	<?php wp_nav_menu(array('theme_location'=>'primary','container'=>'nav','container_id'=>'navs'));?>
</header>
<hr/>