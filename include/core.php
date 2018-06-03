<?php // Core Functions.
function ilost_init(){
  register_sidebar(array('name'=>__('iLost SideBar','iLost'),'id'=>'sidebar-1','description'=>themename.__('\'s SideBar.','iLost'),'class'=>'ilost-sidebar','before_widget'=>'<li id="%1$s" class="widget %2$s">','after_widget'=>'</li>','before_title'=>'<h3 class="widgettitle">','after_title'=>'</h3>'));
  register_sidebar(array('name'=>__('Page SideBar','iLost'),'id'=>'sidebar-2','description'=>themename.__('\'s page sidebar.','iLost'),'before_widget'=>'<li id="%1$s" class="widget %2$s">','after_widget'=>'</li>','before_title'=>'<h3 class="widgettitle">','after_title'=>'</h3>'));
  register_sidebar(array('name'=>__('Footer SideBar','iLost'),'id'=>'sidebar-3','description'=>themename.__(' theme\' footer sidebar, This can only be placed on 5 widget.','iLost'),'before_widget'=>'<li id="%1$s" class="col-sm-4 col-md-3 col-xl-3 widget %2$s">','after_widget'=>'</li>','before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'));
  register_nav_menus(array('primary'=>__('Primary Navigation','iLost')));
  load_theme_textdomain('iLost',TEMPLATEPATH.'/languages');
  add_theme_support('automatic-feed-links');
  add_theme_support('custom-background',array('wp-head-callback'=>'ilost_custom_background_cb'));
  add_theme_support('post-formats',array('aside','chat','gallery','link','image','quote','status','video'));
  add_theme_support('post-thumbnails');
  remove_action('wp_head','wp_generator');
  remove_action('admin_init','_wp_check_for_scheduled_split_terms');
  add_editor_style();
  add_action('init','iloft_post_type');
  add_filter('emoji_svg_url','__return_false');
  add_action('widgets_init','ilost_Widget');
  add_action('admin_menu',array('ilostOption','addOptions'));
  add_action('wp_enqueue_scripts','ilost_enqueue_script');
  add_action('admin_menu','ilost_excerpt_meta_box');
  add_action('wp_footer','ilost_footerscript');
  add_action('wp_before_admin_bar_render','ilost_themeopt_bar_render');
  add_filter('comments_popup_link_attributes','ilost_comments_nofollow_link');
  add_filter('excerpt_length','ilost_excerpt_length');
  add_filter('excerpt_more','ilost_auto_excerpt_more');
  add_filter('get_the_excerpt','ilost_custom_excerpt_more');
  add_filter('get_avatar','ilost_fix_gravatar');
  add_filter('get_search_form','ilost_search_form');
  add_filter('user_contactmethods','ilost_contactmethods');
  add_filter('image_send_to_editor','ilost_remove_width_attribute');
  add_filter('post_thumbnail_html','ilost_remove_width_attribute');
  add_filter('smilies_src','ilost_smilies_src',1,10);
  add_filter('wp_mail_from_name','ilost_from_name');
  add_filter('wp_page_menu_args','ilost_home_menulink');
  //if(!is_admin()){add_action("wp_loaded",'wp_loaded_minify_html');}
  if(!isset($content_width))$content_width=700;
}

function wp_loaded_minify_html(){ob_start('ilost_minify_html');}
function ilost_minify_html($html){$search=array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');$replace=array('>','<','\\1');$html=preg_replace($search, $replace, $html);return $html;}
function ilost_excerpt_meta_box(){add_meta_box('postexcerpt',__('Excerpt','iLost'),'ilost_excerpt_meta_box','page','normal','core');}
function ilost_from_name($email){$wp_from_name=get_option('blogname');return $wp_from_name;}
function ilost_home_menulink($args){$args['show_home']=true;return $args;}
function ilost_remove_width_attribute($html){$html=preg_replace('/(width|height)="\d*"\s/',"",$html);return $html;}
function ilost_smilies_src($img_src,$img,$siteurl){return ilost_path.'/images/smilies/'.$img;}
function ilost_excerpt_length($length){return 256;}
function ilost_auto_excerpt_more($more){return ' &hellip;'.ilost_continue_reading_link();}
function ilost_continue_reading_link(){return ' <a href="'.get_permalink().'" class="more-link">'.__('Learn more','iLost').'</a>';}
function ilost_custom_excerpt_more($output){if(has_excerpt()&& !is_attachment()){$output.=ilost_continue_reading_link();}return $output;}
function ilost_comments_nofollow_link(){return ' rel="nofollow" ';}
function ilost_custom_background_cb(){$background=get_background_image();$color=get_background_color();if(!$background && !$color)return;$style=$color?"background-color:#$color;":'';if($background){$image="background-image:url('$background');";$repeat=get_theme_mod('background_repeat','repeat');if(!in_array($repeat,array('no-repeat','repeat-x','repeat-y','repeat'))){$repeat='repeat';}$repeat="background-repeat:$repeat;";$position=get_theme_mod('background_position_x','left');if(!in_array($position,array('center','right','left'))){$position='left';}$position="background-position:top $position;";$attachment= get_theme_mod('background_attachment','scroll');if(!in_array($attachment,array('fixed','scroll'))){$attachment='scroll';}$attachment="background-attachment:$attachment;";$style.=$image.$repeat.$position.$attachment;}?>
<style type="text/css">body{<?php echo trim($style);?>background-size:cover;}</style><?php }
function iloft_post_type(){
  $Show_Image_labels=array('name'=>__('Show images','iLost'),'singular_name'=>__('Show image','iLost'),'add_new'=>__('Add Images','iLost'),'add_new_item'=>__('Add New Images','iLost'),'edit_item'=>__('Edit Image','iLost'),'new_item'=>__('Add Show image','iLost'),'view_item'=>__('View Image','iLost'),'search_items'=>__('Search Show images','iLost'),'not_found'=>__('No images found','iLost'),'not_found_in_trash'=>__('No images found in Trash','iLost'),'parent_item_colon'=>'');
  $Show_Image_Aargs=array('labels'=>$Show_Image_labels,'public'=>true,'publicly_queryable'=>true,'show_ui'=>true,'query_var'=>true,'rewrite'=>true,'capability_type'=>'post','hierarchical'=>false,'menu_position'=>2,'menu_icon'=>'dashicons-images-alt','supports'=>array('title','custom-fields','thumbnail'));
  register_post_type('ilostshow',$Show_Image_Aargs);
}
function ilost_Widget(){
  register_widget('ilost_catlistsWidget');
  register_widget('ilost_footlistsWidget');
  register_widget('ilost_randompostWidget');
  register_widget('ilost_RavatarWidget');
  register_widget('ilost_RCommentsWidget');
  if(function_exists('the_views')){register_widget('ilost_viewsWidget');}
}
function ilost_contactmethods($user_contactmethods){
  $user_contactmethods['jobs']=__('Jobs','iLost');
  return $user_contactmethods;
}
function ilost_search_form($form){
  $form='<form role="search" method="get" id="searchform" class="searchform" action="'.home_url('/').'">
  <div class="input-group">
    <input type="text" name="s" id="s" class="form-control" placeholder="'.esc_attr__('Search...').'" value="'.get_search_query().'">
    <span class="input-group-btn"><button type="submit" id="searchsubmit" class="btn btn-primary">'.esc_attr__('Search').'</button></span>
  </div></form>';
  return $form;
}
/*
function ilost_is_ie(){return strpos(BROWSER_USER_AGENT,'MSIE');}
function ilost_is_ie6(){return strpos(BROWSER_USER_AGENT,'MSIE 6');}
function ilost_is_ie7(){return strpos(BROWSER_USER_AGENT,'MSIE 7');}
function ilost_is_ie8(){return strpos(BROWSER_USER_AGENT,'MSIE 8');}
function ilost_is_ie9(){return strpos(BROWSER_USER_AGENT,'MSIE 9');}
function ilost_is_ie10(){return strpos(BROWSER_USER_AGENT,'MSIE 10');}
function ilost_is_macintosh(){return strpos(BROWSER_USER_AGENT,'Mac OS X 10_8_2');}
function ilost_is_safari(){return strpos(BROWSER_USER_AGENT,'6.0.2 Safari');}
*/
/*
function ilost_is_iphone(){return strpos(BROWSER_USER_AGENT,'iPhone');}
function ilost_is_ipad(){return strpos(BROWSER_USER_AGENT,'iPad');}
function ilost_is_wphone(){return strpos(BROWSER_USER_AGENT,'Windows Phone');}
function ilost_is_android(){return strpos(BROWSER_USER_AGENT,'Android');}
function ilost_is_mobileos(){
  if((ilost_is_iphone())or(ilost_is_wphone())or(ilost_is_ipad())or(ilost_is_android())){echo "<script type=\"application/x-javascript\">addEventListener('load',function(){setTimeout(scrollTo,0,0,1);},false);</script>\n";}
}
*/
function ilost_getstyles(){
  echo "<link rel=\"stylesheet\" href=\"".ilost_path."/styles/bootstrap.min.css\" />\n";
  echo "<link rel=\"stylesheet\" href=\"//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css\" />\n";
  echo "<link rel=\"stylesheet\" href=\"//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css\" />\n";
  echo "<link rel=\"stylesheet\" href=\"".get_stylesheet_uri()."\" />\n";
}
function ilost_enqueue_script(){
  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap',ilost_path.'/scripts/bootstrap.min.js',array(),'3.3.7',true);
  wp_enqueue_script('scripts',ilost_path.'/scripts/scripts.js',array(),'2.0',true);
  if(is_singular()&&get_option('thread_comments'))wp_enqueue_script('comment-reply',array(),false,true);
  if(ilost_baidu_zzpush()){
    wp_enqueue_script('baidu_zz_push','http://push.zhanzhang.baidu.com/push.js',array(),false,true);
  }
}


function ilost_footerscript(){
  $growlBox=ilost_getOption('growlBox');
  if($growlBox)echo "<script src=\"".ilost_path."/scripts/jgrowl.js\"></script>\n";
  if(is_single()&&ilost_ctrlentry()){
    echo "<script type=\"text/javascript\">ilosts.quickComments();(function(jQuery){ilostQ=jQuery.noConflict();ilostQ(document).ready(function(){ilostQ('#commentform .form-submit #submit').after('<label class=\"cereply\">".__('Use Ctrl+Enter to reply comments','iLost')."</label>');});})(jQuery);
</script>\n";
  }
}
function ilost_get_catlist($cat='',$limit=5){
  echo '<h3>'.get_cat_name($cat).'</h3><ul>';
  $postloop=new WP_Query(array('cat'=>$cat,'posts_per_page'=>$limit));
  while($postloop->have_posts()){$postloop->the_post();?>
  <li><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></li>
   <?php }wp_reset_postdata();
  echo '</ul>';
}
function ilost_get_footerlist($cat='',$limit=5){
  echo '<h4>'.get_cat_name($cat).'</h4><ul>';
  $postloop=new WP_Query(array('cat'=>$cat,'posts_per_page'=>$limit));
  while($postloop->have_posts()){$postloop->the_post();?>
  <li><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></li>
   <?php }wp_reset_postdata();
  echo '</ul>';
}
function ilost_rcomments($limit=5){
  $comments=get_comments(array('number'=>100,'status'=>'approve'));
  $wpchres=get_option('blog_charset');$exclude_emails=get_bloginfo('admin_email');$i=1;$ilostoutput='';
  foreach($comments as $comment){
    $ilostoutput.='<li class="media"><div class="media-left">'.get_avatar($comment,64).'</div><div class="media-body"><a class="media-heading" href="'.get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID.'" title="On '.get_the_title($comment->comment_post_ID).'">'.stripslashes($comment->comment_author).'</a>:<p>'.ilost_substr(strip_tags($comment->comment_content),43,$wpchres).'</p></div></li>'."\n";
    if($i==$limit){break;}$i++;
  }echo ent2ncr($ilostoutput);
}
function ilost_ravatar($limit=5){
  $comments=get_comments(array('number'=>100,'status'=>'approve','type'=>'comment'));
  $wpchres=get_option('blog_charset');
  $exclude_emails=array(get_bloginfo('admin_email'));$ilostoutput='';$i=1;$loadmail=array('');
  foreach($comments as $comment){
    if(in_array($comment->comment_author_email,$exclude_emails))continue;
    if(in_array($comment->comment_author_email,$loadmail))continue;
    $ilostoutput.='<a href="'.get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID.'" title="'.stripslashes($comment->comment_author).'">'.get_avatar($comment,64).'</a>'."\n";
    $loadmail[]=$comment->comment_author_email;
    if($i==$limit){break;}$i++;
  }$ilostoutput.='<span class="clearer"></span>';$loadmail=array('');echo ent2ncr($ilostoutput);
}
function ilost_randompost($limit=5){
  query_posts(array('orderby'=>'rand','showposts'=>$limit,'post__not_in'=>get_option("sticky_posts")));
  if(have_posts()){while(have_posts()){the_post();?>
    <li><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></li>
  <?php }}wp_reset_query();
}
function ilost_showProTu($id=0,$limit=3,$excerpt=false){
  //$postloop=new WP_Query(array('cat'=>$id,'posts_per_page'=>$limit,'ignore_sticky_posts'=>1));  
  $postloop=new WP_Query(array('tag_id'=>$id,'posts_per_page'=>$limit,'ignore_sticky_posts'=>1));  
  //$col_class="col-xs-4 col-sm-4 col-md-4 col-xl-4";
  $col_class="col-xs-6 col-sm-4 col-md-4 col-xl-4";
  //$col_class="col-xs-3 col-sm-3 col-md-3 col-xl-3";
  $loopi=1;
  while($postloop->have_posts()){
    $postloop->the_post();
    $img_src=wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
    if($loopi>=3){$col_class="col-xs-12 col-sm-4 col-md-4 col-xl-4";}
    echo '<div class="'.$col_class.'"><a href="'.get_the_permalink().'" title="'.get_the_title().'" style="background-image:url('.$img_src[0].')"><span>'.get_the_title().'</span></a></div>';
    $loopi++;
  }wp_reset_postdata();
}
function ilost_queryNewp($limit=4){
  $postloop=new WP_Query(array('cat'=>'-'.ilost_frontCat(),'ignore_sticky_posts'=>1,'posts_per_page'=>$limit));
  while($postloop->have_posts()){$postloop->the_post();?>
    <div class="col-sm-6 col-md-3 col-xl-3">
     <h2><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','iLost'),the_title_attribute('echo=0'));?>" rel="bookmark"><?php the_title();?></a></h2>
     <?php echo '<p>'.ilost_substr(get_the_excerpt(),42).'...</p>';?>
     <?php //echo '<p>'.wp_trim_words(get_the_excerpt(),64).'</p>';?>
     <small><?php the_time('m.d.Y');?></small>
    </div>
  <?php }wp_reset_postdata();
}
function ilost_lgshow(){if(is_user_logged_in())echo ' style="display:block"';}
function ilost_relatedposts($postID,$limit=5,$type=''){
  $tags=wp_get_post_tags($postID);
  if($tags){
    $first_tag=$tags[0]->term_id;$args=array('tag__in'=>array($first_tag),'post__not_in'=>array($postID),'showposts'=>$limit,'ignore_sticky_posts'=>1);
    $my_query=new WP_Query($args);
    if($my_query->have_posts()){
      echo "<div class=\"related\">\n<h3>".__('Related Post:','iLost')."</h3>\n<ul>\n";
      while($my_query->have_posts()){$my_query->the_post();?>
      <li<?php if(ilost_repostShow()=='thumbnail'){echo ' class="thumbnail"';}?>><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute();?>">
      <?php if(ilost_repostShow()=='thumbnail'){echo the_post_thumbnail('thumbnail');}the_title();?> <?php comments_number(' ','(1)','(%)');?></a></li>
      <?php
      };echo "</ul>\n</div>\n";
    }wp_reset_postdata();
  }
}
function ilost_pagenav($options=array()){
  global $wp_query;$options=array('pages_text'=>'Page %CURRENT_PAGE% of %TOTAL_PAGES%','current_text'=>'%PAGE_NUMBER%','page_text'=>'%PAGE_NUMBER%','prev_text'=>'&laquo;','next_text'=>'&raquo;','num_pages'=>5,'always_show'=>false);
  $posts_per_page=intval(get_query_var('posts_per_page'));
  $paged=absint(get_query_var('paged'));
  if(!$paged){$paged=1;}$total_pages=absint($wp_query->max_num_pages);if(!$total_pages){$total_pages=1;}if(1==$total_pages && !$options['always_show']){return;}$request=$wp_query->request;$numposts=$wp_query->found_posts;$pages_to_show=absint($options['num_pages']);$pages_to_show_minus_1=$pages_to_show-1;$half_page_start=floor($pages_to_show_minus_1/2);$half_page_end=ceil($pages_to_show_minus_1/2);$start_page=$paged-$half_page_start;if($start_page<=0){$start_page=1;}$end_page=$paged+$half_page_end;if(($end_page-$start_page)!=$pages_to_show_minus_1){$end_page=$start_page+$pages_to_show_minus_1;}if($end_page>$total_pages){$start_page=$total_pages-$pages_to_show_minus_1;$end_page=$total_pages;}if($start_page<=0){$start_page=1;}$out='';
  //if(!empty($options['pages_text'])){$pages_text=str_replace(array("%CURRENT_PAGE%","%TOTAL_PAGES%"),array(number_format_i18n($paged),number_format_i18n($total_pages)),$options['pages_text']);$out.='<li class="disabled"><span>'.$pages_text.'</span></li>';}
  if(!empty($options['prev_text'])){$out.='<li>'.get_previous_posts_link($options['prev_text']).'</li>';}
  foreach(range($start_page,$end_page) as $i){if($i==$paged && !empty($options['current_text'])){$current_page_text=str_replace('%PAGE_NUMBER%',number_format_i18n($i),$options['current_text']);$out.='<li class="active"><span>'.$current_page_text."</span></li>";}else{$out.=ilost_pgnavnum($i,'page',$options['page_text']);}}
  if(!empty($options['next_text'])){$out.='<li>'.get_next_posts_link($options['next_text'],$total_pages).'</li>';}$larger_page_end=0;
  $out='<ul class="pagination pagination-sm">'."\n".$out."\n</ul>\n";
  echo apply_filters('ilost_pagenav',$out);
}
function ilost_pgnavnum($page,$class,$raw_text,$format='%PAGE_NUMBER%'){if(empty($raw_text)){return '';}$text=str_replace($format,number_format_i18n($page),$raw_text);return "<li><a href='".esc_url(get_pagenum_link($page))."' class='$class'>$text</a></li>";}
function ilost_fix_gravatar($avatar){$avatar=str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"), "secure.gravatar.com",$avatar);$avatar=str_replace("http://","https://",$avatar);return $avatar;}
function ilost_substr($string,$sublen,$code='UTF-8'){$start=0;if($code=='UTF-8'){$pa="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";preg_match_all($pa,$string,$t_string);if(count($t_string[0])-$start > $sublen)return join('',array_slice($t_string[0],$start,$sublen));return join('',array_slice($t_string[0],$start,$sublen));}else{$start=$start*2;$sublen=$sublen*2;$strlen=strlen($string);$tmpstr='';for($i=0;$i<$strlen;$i++){if($i>=$start && $i<($start+$sublen)){if(ord(substr($string,$i,1))>129){$tmpstr.=substr($string,$i,2);}else{$tmpstr.=substr($string,$i,1);}}if(ord(substr($string,$i,1))>129){$i++;}}return $tmpstr;}}
?>
