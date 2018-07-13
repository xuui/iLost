<?php define("themename","iLost");
define("BROWSER_USER_AGENT",$_SERVER["HTTP_USER_AGENT"]);
define("ilost_path",get_template_directory_uri());
define("ilost_wp_name",get_bloginfo('name'));
define("ilost_wp_homeurl",home_url());
define("ilost_wp_description",get_bloginfo('description'));
define("ilost_wp_rss2_url",get_bloginfo('rss2_url'));
define("ilost_wp_pingback_url",get_bloginfo('pingback_url'));
add_action('after_setup_theme','ilost_init');
require_once(dirname( __FILE__ ).'/include/widgets.php');
require_once(dirname( __FILE__ ).'/include/options.php');
require_once(dirname( __FILE__ ).'/include/coreclass.php');
require_once(dirname( __FILE__ ).'/include/core.php');

function ilost_page_number($echo=true){global $paged;if($paged>=2){if($echo){echo '| '.sprintf(__('Page %s','iLost'),$paged);}else{return '| '.sprintf(__('Page %s','iLost'),$paged);}}}

/*
function We_do_not_love_it(){wp_deregister_style('open-sans');wp_register_style('open-sans',false);wp_enqueue_style('open-sans','');}
add_action('init','We_do_not_love_it');

$ilost_widgerSide=array('before_widget'=>'<li id="%1$s" class="widget %2$s">','after_widget'=>'</li>','before_title'=>'<h3 class="widgettitle">','after_title'=>'</h3>');
*/

/*
function ilost_getThumbnail_url(ID){
  $img_src=wp_get_attachment_image_src(get_post_thumbnail_id(ID),'full');
  return $img_src[0];
}
*/
function ilost_getiloshow(){
  $showlistloop=new WP_Query(array('post_type'=>'ilostshow','posts_per_page'=>ilost_ilshowNum()));if($showlistloop->have_posts()){?>
<div id="rotation" class="flexslider">
  <ul class="slides">
    <?php while($showlistloop->have_posts()){$showlistloop->the_post();
      $urlLink=get_post_meta(get_the_ID(),"urlink",$single=true);if(!$urlLink){$urlLink='javascript:;';}
      $align=get_post_meta(get_the_ID(),"align",$single=true);
      $img_src=wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');?>
    <li>
      <!--a href="<?php echo $urlLink;?>"-->
      <img src="<?php echo ilost_path.'/images/slidemark.png';?>" style="background-image:url(<?php echo $img_src[0];?>);" alt="<?php the_title()?>">
      <!--/a-->
      <div class="flex-caption container-"<?php if($align!='left'){echo ' style="text-align:'.$align.'"';}?>>
        <b class="heading"><?php the_title()?></b>
        <!--b class="heading"><?php //echo(get_post_meta(get_the_ID(),"heading",true))?></b-->
        <i class="intro"><?php echo(get_post_meta(get_the_ID(),"intro",true))?></i>
        <a class="btn link" href="<?php echo $urlLink;?>" target="_blank"><?php echo(__('Learn more','iLost'))?> &gt;</a>
      </div>
    </li>
    <?php }?>
  </ul><script type="text/javascript" defer src="<?php echo ilost_path.'/scripts/rotation.js';?>"></script>
</div>
<?php }wp_reset_postdata();
}
if(!function_exists('ilost_comments')){function ilost_comments($comment,$args,$depth){
  $GLOBALS['comment']=$comment;
  switch($comment->comment_type){
    case '':?><li <?php comment_class('media');?> id="li-comment-<?php comment_ID();?>">
    <div class="media-left comment-author"><?php echo get_avatar($comment,96);?></div>
    <div class="comment-body media-body">
      <h4 class="media-heading"><?php printf(__('%1$s <small><time pubdate datetime="%2$s">%3$s</time></small>','iLost'),sprintf('%s',get_comment_author_link()),get_comment_time('c'),sprintf(__('%1$s %2$s','iLost'),get_comment_date('Y-m-d'),get_comment_time(' H:i')));echo '<span class="pull-right">';comment_reply_link(array_merge($args,array('depth'=>$depth,'max_depth'=>$args['max_depth'])));echo '</span>';?></h4>
      <?php if($comment->comment_approved=='0'){echo '<em>'.__('Your comment is awaiting moderation.','iLost').'</em>';}?>
      <?php echo '<small class="pull-right">';
      edit_comment_link(__('[Edit]','iLost'),'','');
      echo '</small>';comment_text();?>
    </div>
    <?php break;
    case 'pingback':case 'trackback':?>
<li class="pingback media">
    <div class="media-body"><?php comment_author_link();edit_comment_link(__('[Edit]','iLost'),'');?></div>
    <?php break;
  }
}}

/*
// 远程图片本地化
add_filter('content_save_pre', 'auto_save_image');
function auto_save_image($content){
$text = stripslashes($content);
preg_match_all("/<img[^>]+src=(\"|\'){0,}(http:\/\/(.+?))(\"|\'|\s)/is", $text, $img);
$img = array_unique($img[2]);
if(empty($img)) {
return $content;
}

$upload_dir = wp_upload_dir(date('Y/m'));
require_once (ABSPATH . "wp-includes/class-snoopy.php");
$snoopy_Auto_Save_Image = new Snoopy;
// 过滤下载域名
$basehost = $_SERVER["HTTP_HOST"]."|.qq.com|img.baidu.com|.qiniudn.com|.taobaocdn.com|.alicdn.com|.gtimg.com";
// 以文章的标题作为图片的标题
if (!empty($_REQUEST['post_title'])) {
$post_title = wp_specialchars(stripslashes($_REQUEST['post_title']));
}

foreach ($img as $key => $imgurl){
set_time_limit(60); //每张图片允许下载最长时间,秒
if(preg_match("/$basehost/i", $imgurl)) {
continue;
}

// 是否本地图片
if(!preg_match("/^http:\/\//i", $imgurl)) {
continue;
}

// 判断后缀
$fileext = substr(strrchr($imgurl, '.'), 1);
$fileext = strtolower($fileext);
$savefiletype = array('jpg', 'gif', 'png', 'bmp');
if (!in_array($fileext, $savefiletype)){
$fileext = "jpg";
}

if($snoopy_Auto_Save_Image->fetch($imgurl)){
$get_file = $snoopy_Auto_Save_Image->results;
}else{
continue;
}

$filename = substr(md5($imgurl), 0, 8);
$filetarget = $upload_dir['path'] . "/" . $filename . "." . $fileext;

if(!@$fp = fopen($filetarget, 'wb')) {
continue;
} else {
flock($fp, 2);
fwrite($fp, $get_file);
fclose($fp);
}

$post_ID = (int)$_POST['temp_ID2'];
$wp_filetype = wp_check_filetype($filename . "." . $fileext, false);
$url = $upload_dir['url'] . "/" . $filename . "." . $fileext;

$attachment = array('post_type' => 'attachment',
'post_mime_type' => $wp_filetype['type'],
'guid' => $url,
'post_parent' => $post_ID,
'post_title' => $post_title,
'post_content' => "",
);
$id = wp_insert_attachment($attachment, $filetarget);
$text = str_replace($imgurl, $url, $text);

}
$content = addslashes($text);
remove_filter('content_save_pre', 'auto_save_image');
return $content;
}
*/
?>