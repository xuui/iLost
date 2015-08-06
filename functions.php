<?php define("themename","iLost");define("BROWSER_USER_AGENT",$_SERVER["HTTP_USER_AGENT"]);
add_action('after_setup_theme','ilost_init');
function ilost_init(){
	register_sidebar(array('name'=>'ilost-sidebar','description'=>themename.' theme\'s SideBar','before_widget'=>'<li id=\"%1$s\" class=\"widget %2$s\">','after_widget'=>'</li>','before_title'=>'<h3 class=\"widgettitle\">','after_title'=>'</h3>'));
	register_nav_menus(array('primary'=>__('Primary Navigation','iLost')));
	add_action('admin_menu','ilost_excerpt_meta_box');
	add_action('wp_enqueue_scripts','ilost_enqueue_script');
	add_custom_background();
	add_editor_style();
	add_filter('excerpt_length','ilost_excerpt_length');
	add_filter('excerpt_more','ilost_auto_excerpt_more');
	add_filter('get_the_excerpt','ilost_custom_excerpt_more');
	add_filter('wp_page_menu_args','ilost_home_menulink');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	remove_action('wp_head','wp_generator');
	load_theme_textdomain('iLost',TEMPLATEPATH.'/languages');
	if(!isset($content_width))$content_width=600;
}
function ilost_excerpt_meta_box(){add_meta_box('postexcerpt',__('Excerpt','iLost'),'ilost_excerpt_meta_box','page','normal','core');}
function ilost_excerpt_length($length){return 20;}
function ilost_continue_reading_link(){return ' <a href="'.get_permalink().'" class="more-link">'.__('Learn more','iLost').'</a>';}
function ilost_auto_excerpt_more($more){return ' &hellip;'.ilost_continue_reading_link();}
function ilost_custom_excerpt_more($output){if(has_excerpt() && ! is_attachment()){$output.=ilost_continue_reading_link();}return $output;}
function ilost_from_email($email){$wp_from_email=get_option('admin_email');return $wp_from_email;}
function ilost_from_name($email){$wp_from_name=get_option('blogname');return $wp_from_name;}
function ilost_home_menulink($args){$args['show_home']=true;return $args;}
function ilost_enqueue_script(){
	if((strpos(BROWSER_USER_AGENT,'MSIE')!==false)&&(strpos(BROWSER_USER_AGENT,'MSIE 9')===false))wp_enqueue_script('html5',get_template_directory_uri().'/scripts/html5.js');
	wp_enqueue_script('jquery');
	wp_enqueue_script('lazyload',get_template_directory_uri().'/scripts/load.js',array('jquery'),'1.5.0',false);
	wp_enqueue_script('ilostq',get_template_directory_uri().'/scripts/ilostq.js',array('query'),false,true);
	if(is_singular()&&get_option('thread_comments'))wp_enqueue_script('comment-reply',array('query'),false,true);
}
function ilost_rcomments($limit=5){
	$comments=get_comments(array('number'=>100,'status'=>'approve'));
	$wpchres=get_option('blog_charset');$i=1;$ilostoutput='';
	foreach($comments as $comment){
		$ilostoutput.='<li><a href="'.get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID.'" title="On '.get_the_title($comment->comment_post_ID).'">'.stripslashes($comment->comment_author).'</a>: '.mb_substr(strip_tags($comment->comment_content),0,30,$wpchres).'...</li>'."\n";
		if($i==$limit){break;}$i++;
	}echo ent2ncr($ilostoutput);
}
function ilost_lgshow(){if(is_user_logged_in())echo ' style="display:block"';}
function ilost_page_number(){global $paged;if($paged>=2)echo ' - '.sprintf('Page %s',$paged);}
if(!function_exists('ilost_comments')){function ilost_comments($comment,$args,$depth){
	$GLOBALS['comment']=$comment;
	switch($comment->comment_type){
		case '':?>
	<li <?php comment_class();?> id="li-comment-<?php comment_ID();?>">
		<div id="comment-<?php comment_ID();?>" class="list">
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,32);?>
			<small class="comment-meta"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID));?>"><?php printf(__('%1$s at %2$s','iLost'),get_comment_date('Y-m-d'),get_comment_time(' H:i'));?></a><?php edit_comment_link(__('[Edit]','iLost'),'');?></small>
			<?php printf('%s <cite class="says">:&nbsp;</cite>',sprintf('<cite class="fn">%s</cite>',get_comment_author_link()));?>
		</div>
		<?php if($comment->comment_approved=='0'){?>
			<em><?php _e('Your comment is awaiting moderation.','iLost');?></em>
		<?php }?>
		<div class="comment-body"><?php comment_text();comment_reply_link(array_merge($args,array('depth'=>$depth,'max_depth'=>$args['max_depth'])));?></div>
	</div>
	<?php break;
		case 'pingback':
		case 'trackback':?>
	<li class="post pingback">
		<p><?php _e('Pingback:','iLost');?> <?php comment_author_link();?> <?php edit_comment_link(__('[Edit]','iLost'),'');?></p>
	<?php break;
	}
}}
function ilost_pagenav($options=array()){
	global $wp_query;$options=array('pages_text'=>'Page %CURRENT_PAGE% of %TOTAL_PAGES%','current_text'=>'%PAGE_NUMBER%','page_text'=>'%PAGE_NUMBER%','first_text'=>'&laquo; First','last_text'=>'Last &raquo;','prev_text'=>'&laquo;','next_text'=>'&raquo;','dotleft_text'=>'...','dotright_text'=>'...','num_pages'=>5,'always_show'=>false);
	$posts_per_page=intval(get_query_var('posts_per_page'));$paged=absint(get_query_var('paged'));if(!$paged){$paged=1;}$total_pages=absint($wp_query->max_num_pages);if(!$total_pages){$total_pages=1;}if(1==$total_pages && !$options['always_show']){return;}$request=$wp_query->request;$numposts=$wp_query->found_posts;$pages_to_show=absint($options['num_pages']);$pages_to_show_minus_1=$pages_to_show-1;$half_page_start=floor($pages_to_show_minus_1/2);$half_page_end=ceil($pages_to_show_minus_1/2);$start_page=$paged-$half_page_start;if($start_page<=0){$start_page=1;}$end_page=$paged+$half_page_end;if(($end_page-$start_page)!=$pages_to_show_minus_1){$end_page=$start_page+$pages_to_show_minus_1;}	if($end_page>$total_pages){$start_page=$total_pages-$pages_to_show_minus_1;$end_page=$total_pages;}if($start_page<=0){$start_page=1;}$out='';
	if(!empty($options['pages_text'])){$pages_text=str_replace(array("%CURRENT_PAGE%","%TOTAL_PAGES%"),array(number_format_i18n($paged),number_format_i18n($total_pages)),$options['pages_text']);$out.="<span class='pages'>$pages_text</span>";}
	if($start_page>=2 && $pages_to_show<$total_pages){$first_text=str_replace('%TOTAL_PAGES%',number_format_i18n($total_pages),$options['first_text']);$out.=ilost_pgnavnum(1,'first',$first_text,'%TOTAL_PAGES%');
	if(!empty($options['dotleft_text'])){$out.="<span class='extend'>{$options['dotleft_text']}</span>";}}
	if(!empty($options['prev_text'])){$out.=get_previous_posts_link($options['prev_text']);}
	foreach(range($start_page,$end_page) as $i){if($i==$paged && !empty($options['current_text'])){$current_page_text=str_replace('%PAGE_NUMBER%',number_format_i18n($i),$options['current_text']);$out.="<span class='current'>$current_page_text</span>";}else{$out.=ilost_pgnavnum($i,'page',$options['page_text']);}}
	if(!empty($options['next_text'])){$out.=get_next_posts_link($options['next_text'],$total_pages);}$larger_page_end=0;
	if($end_page<$total_pages){if(!empty($options['dotright_text'])){$out.="<span class='extend'>{$options['dotright_text']}</span>";}$out.=ilost_pgnavnum($total_pages,'last',$options['last_text'],'%TOTAL_PAGES%');}
	$out="<div class='ilost-pagenav'>\n$out\n</div>\n";
	echo apply_filters('ilost_pagenav',$out);
}function ilost_pgnavnum($page,$class,$raw_text,$format='%PAGE_NUMBER%'){if(empty($raw_text)){return '';}$text=str_replace($format,number_format_i18n($page),$raw_text);return "<a href='".esc_url(get_pagenum_link($page))."' class='$class'>$text</a>";}?>