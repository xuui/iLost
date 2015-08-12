<?php function We_do_not_love_it(){wp_deregister_style('open-sans');wp_register_style('open-sans',false);wp_enqueue_style('open-sans','');}add_action('init','We_do_not_love_it');
define("themename","iLost");define("BROWSER_USER_AGENT",$_SERVER["HTTP_USER_AGENT"]);define("ilost_path",get_template_directory_uri());define("ilost_wp_name",get_bloginfo('name'));define("ilost_wp_homeurl",home_url());define("ilost_wp_description",get_bloginfo('description'));define("ilost_wp_rss2_url",get_bloginfo('rss2_url'));define("ilost_wp_pingback_url",get_bloginfo('pingback_url'));add_action('after_setup_theme','ilost_init');require_once(dirname( __FILE__ ).'/include/widgets.php');require_once(dirname( __FILE__ ).'/include/options.php');require_once(dirname( __FILE__ ).'/include/core.php');get_template_part('include/fanfou');

function ilost_getiloshow(){
  $showlistloop=new WP_Query(array('post_type'=>'ilostshow','posts_per_page'=>ilost_ilshowNum()));if($showlistloop->have_posts()){?>
<div id="rotation" class="flexslider"><script type="text/javascript" defer src="<?php echo ilost_path.'/scripts/rotation.js';?>"></script>
  <ul class="slides">
    <?php while($showlistloop->have_posts()){$showlistloop->the_post();$urlLink=get_post_meta(get_the_ID(),"urlink",$single=true);if(!$urlLink){$urlLink='javascript:;';}?>
    <li><a href="<?php echo $urlLink;?>" target="_blank"><?php the_post_thumbnail('full');?><span class="flex-caption"><?php the_title()?></span></a></li>
    <?php }?>
  </ul>
</div><?php }wp_reset_postdata();}

function ilost_getshare(){?><div id="postshare"><div id="share"><?php if(ilost_googleaddbut()){echo '<div class="sns" style="float:right;"><g:plusone size="medium" count="on" href="'.get_permalink().'\"></g:plusone></div>';}?><span class="share"><?php _e('Share this post:','iLost');?></span><a href="http://facebook.com/share.php?u=<?php the_permalink();?>&t=<?php the_title();?>" target="_blank" rel="nofollow" id="facebook-share" title="<?php _e('Facebook','iLost');?>"><?php _e('Facebook','iLost');?></a><a href="http://twitter.com/share?url=<?php the_permalink();?>&text=<?php the_title();?>" target="_blank" rel="nofollow" id="twitter-share" title="<?php _e('Twitter','iLost');?>"><?php _e('Twitter','iLost');?></a><a href="http://delicious.com/post?url=<?php the_permalink();?>&title=<?php the_title();?>" target="_blank" rel="nofollow" id="delicious-share" title="<?php _e('Delicious','iLost');?>"><?php _e('Delicious','iLost');?></a><a href="javascript:var%20d=document,w=window,f='http://fanfou.com/share',l=d.location,e=encodeURIComponent,p='?u='+e(l.href)+'&t='+e(d.title)+'&d='+e(w.getSelection?w.getSelection().toString():d.getSelection?d.getSelection():d.selection.createRange().text)+'&s=bm';a=function(){if(!w.open(f+'r'+p,'sharer','toolbar=0,status=0,resizable=0,width=600,height=400'))l.href=f+'.new'+p};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else{a()}void(0)" target="_blank" rel="nofollow" id="fanfou-share" title="<?php _e('Fanfou','iLost');?>"><?php _e('Fanfou','iLost');?></a><a href="http://v.t.qq.com/share/share.php?title=<?php the_title();?>&url=<?php the_permalink();?>&site=<?php echo ilost_wp_homeurl.'/';?>" target="_blank" rel="nofollow" id="tencent-share" title="<?php _e('QQ Weibo','iLost');?>"><?php _e('QQ Weibo','iLost');?></a><a href="http://v.t.sina.com.cn/share/share.php?url=<?php the_permalink();?>&title=<?php the_title();?>" target="_blank" rel="nofollow" id="sina-share" title="<?php _e('Sina Weibo','iLost');?>"><?php _e('Sina Weibo','iLost');?></a><a href="http://t.163.com/article/user/checkLogin.do?link=<?php the_permalink();?>source='<?php echo ilost_wp_name;?>'&info=<?php the_title();?> <?php the_permalink();?>" target="_blank" rel="nofollow" id="netease-share" title="<?php _e('163 Weibo','iLost');?>"><?php _e('163 Weibo','iLost');?></a><a href="http://www.kaixin001.com/repaste/share.php?rurl=<?php the_permalink();?>&rcontent=<?php the_permalink();?>&rtitle=<?php the_title();?>;" target="_blank" rel="nofollow" id="kaixin001-share" title="<?php _e('kaixin001','iLost');?>"><?php _e('kaixin001','iLost');?></a><a href="http://share.renren.com/share/buttonshare?link=<?php the_permalink();?>&title=<?php the_title();?>" target="_blank" rel="nofollow" id="renren-share" title="<?php _e('Renren','iLost');?>"><?php _e('Renren','iLost');?></a><a href="http://www.douban.com/recommend/?url=<?php the_permalink();?>&title=<?php the_title();?>" target="_blank" rel="nofollow" id="douban-share" title="<?php _e('Douban','iLost');?>"><?php _e('Douban','iLost');?></a></div></div><?php }function ilost_page_number(){global $paged;if($paged>=2)echo ' - '.sprintf('Page %s',$paged);}

if(!function_exists('ilost_comments')){function ilost_comments($comment,$args,$depth){
  $GLOBALS['comment']=$comment;
  switch($comment->comment_type){
    case '':?><li <?php comment_class('media');?> id="li-comment-<?php comment_ID();?>">
    <div class="media-left comment-author"><?php echo get_avatar($comment,96);?></div>
    <div class="comment-body media-body">
      <h4 class="media-heading"><?php printf(__('%1$s <small>said:</small>','iLost'),sprintf('<cite class="fn">%s</cite>',get_comment_author_link()));echo '<span class="pull-right">';printf('<small class="comment-meta"><a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a></small>',esc_url(get_comment_link( $comment->comment_ID)),get_comment_time('c'),sprintf(__('%1$s %2$s','iLost'),get_comment_date('Y-m-d'),get_comment_time(' H:i')));comment_reply_link(array_merge($args,array('depth'=>$depth,'max_depth'=>$args['max_depth'])));echo '</span>';?></h4>
      <?php if($comment->comment_approved=='0'){echo '<em>'.__('Your comment is awaiting moderation.','iLost').'</em>';}?>
      <?php edit_comment_link(__('[Edit]','iLost'),'<p class="pull-right">','</p>');comment_text();?>
    </div>
    <?php break;
    case 'pingback':case 'trackback':?>
<li class="pingback media">
    <div class="media-body"><?php _e('Pingback:','iLost');comment_author_link();edit_comment_link(__('[Edit]','iLost'),'');?></div>
    <?php break;
  }
}}


//login_Viewer.
add_action('post_submitbox_misc_actions','login_Viewer');
add_action('save_post','save_login_View_meta');
function login_Viewer(){
    $loginED=get_post_meta($_GET["post"],"logined",$single=true);?>
    <div class="misc-pub-section misc-pub-section-last">
		<label for="loginview"><?php _e('登录才能浏览:');?></label>
        <input type="checkbox" id="loginview" name="loginview" value="<?php echo $loginED;?>"<?php if($loginED!='0')echo ' checked="checked"';?>><br />
		<label for="viewsLevel"><?php _e('浏览这个篇文章的用户等级为:');?></label>
        <input type="text" id="viewsLevel" name="viewsLevel" size="2" maxlength="2" value=""><br />
		<label><?php _e('用户等级0~10 留空为所有人都可以看。');?></label>
	</div>
<?php
}
function get_curLevel($level){return 'level_'.$level;}
if(current_user_can('level_10')){   
//加入符合管理员后需要添加的内容   
}
function save_login_View_meta($post_id){
    if (isset($_REQUEST['loginview'])){
        update_post_meta($post_id,'logined',sanitize_text_field("1"));
    }else{
        update_post_meta($post_id,'logined',sanitize_text_field("0"));
    }
    if (isset($_REQUEST['viewsLevel'])){
        update_post_meta($post_id,'viewsLevel',sanitize_text_field($_REQUEST['viewsLevel']));
    }else{
        delete_post_meta($post_id,'viewsLevel','');
    }
}
?>