<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php echo ilost_wp_charset;?>" />
<?php ilost_get_iexuaCompatible();?>
<title><?php if(is_single()){single_post_title();echo ' - ';echo ilost_wp_name;}elseif(is_home()||is_front_page()){echo ilost_wp_name;ilost_page_number();}elseif(is_page()){single_post_title(''); echo ' - ';echo ilost_wp_name;}elseif(is_search()){printf( __('Search results for "%s"','iLost'),esc_html($s));ilost_page_number();echo ' - '; echo ilost_wp_name;}elseif(is_404()){_e('Error 404 - Not Found','iLost');echo ' - ';echo ilost_wp_name;}else{wp_title('');echo ' - ';echo ilost_wp_name;ilost_page_number();}?></title>
<?php if(strpos(BROWSER_USER_AGENT,'MSIE 9.0')){?>
<meta name="application-name" content="<?php echo ilost_wp_name;?>" />
<meta name="msapplication-tooltip" content="<?php echo ilost_wp_name;?>" />
<meta name="msapplication-window" content="width=1024;height=700" />
<meta name="msapplication-task" content="name=<?php echo ilost_wp_name;?>;action-uri=<?php echo ilost_wp_homeurl;?>;icon-uri=<?php echo ilost_wp_homeurl.'/favicon.ico';?>" />
<meta name="msapplication-navbutton-color" content="#0099ff" />
<meta name="msapplication-starturl" content="./" />
<?php if(is_user_logged_in()){?>
<script type="text/javascript">
window.external.msSiteModeCreateJumplist("WordPress");
window.external.msSiteModeAddJumpListItem("新文章","<?php echo ilost_wp_homeurl.'/wp-admin/post-new.php';?>",	"<?php echo ilost_wp_homeurl.'/favicon.ico';?>", "tab");
window.external.msSiteModeAddJumpListItem("评论",	"<?php echo ilost_wp_homeurl.'/wp-admin/edit-comments.php';?>","<?php echo ilost_wp_homeurl.'/favicon.ico';?>", "tab");
window.external.msSiteModeAddJumpListItem("外观","<?php echo ilost_wp_homeurl.'/wp-admin/themes.php';?>",	"<?php echo ilost_wp_homeurl.'/favicon.ico';?>", "tab");
window.external.msSiteModeAddJumpListItem("管理后台","<?php echo ilost_wp_homeurl.'/wp-admin';?>",	"<?php echo ilost_wp_homeurl.'/favicon.ico';?>", "tab");
window.external.msSiteModeShowJumpList(); 
</script>
<?php }}?>
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
<link rel="theme author" href="Xu.hel,xu@xuui.net" />
<?php ilost_getfavicon();ilost_getstyles();?>
<link rel="pingback" href="<?php echo ilost_wp_pingback_url;?>" />
<?php ilost_customRssurl();wp_head();?>
</head>
<body <?php body_class();?>>
<?php if(is_single()&&is_page()){?>
<iframe class="manifest" src="<?php echo ilost_path.'/manifest.html';?>"></iframe>
<?php }?>
<!--div id="wrapper"-->
<header>
  <?php ilost_getSearchform();?>
  <div class="caption"><?php ilost_getlogoimg();?></div>
  <?php wp_nav_menu(array('theme_location'=>'primary','container'=>'nav','container_id'=>'navs'));?>
</header>
<?php if(!is_single()&&!is_page()&&!is_search()){ilost_getiloshow();}?>