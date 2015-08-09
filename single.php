<?php get_header();?>
<div id="content">
<article>
  <?php if(have_posts()){while(have_posts()){the_post();ilost_breadcrumb();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="title">
      <h1><?php the_title();?></h1>
      <small><?php the_time('m.d.Y');?>, <?php the_category(', ');?>, by <?php the_author_posts_link();?><?php if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
    </div>
    <?php ilost_getshare();?>
    <div class="entry">
    	<?php ilost_adgpostemb();
    	$logined=get_post_meta(get_the_ID(),"logined",$single=true);if($logined){if(is_user_logged_in()){
			the_content();wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');
			}else{printf(__('View this article need to login.','iLost'));}}else{
			the_content();
			wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');}
			$demos=get_post_meta(get_the_ID(),"demo",$single=true);if($demos){echo "<section class=\"ilost_demo\"><a href=\"".$demos."\">".__('View Demo','iLost')."</a></section>\n";}
			$downloads=get_post_meta(get_the_ID(),"download",$single=true);if($downloads){echo "<section class=\"ilost_downloads\"><a href=\"".$downloads."\">".__('Download Now','iLost')."</a></section>\n";}
			$paybys=get_post_meta(get_the_ID(),"payby",$single=true);if($paybys){$payinfo=explode("###",$paybys);if($payinfo[0] && $payinfo[1]){$payurl=$payinfo[0];$paynum=' ('.$payinfo[1].')';echo "<section class=\"ilost_paybys\"><a href=\"".$payurl."\">".__('Buy Now','iLost').$paynum."</a></section>\n";}}?>
    </div>
    <?php ilost_relatedposts(get_the_ID(),$limit=ilost_repostNum());?>
    <div class="post-meta">
			<?php edit_post_link(__('Edit','iLost'),'<span class="alignright"> [',']</span>');?>
			<?php the_tags(__('Tags: ','iLost'),' | ','');?><div class="clear"></div>
    </div>
    <?php ilost_adgpostend();?>
    <nav class="post-nav">
    	<span class="previous"><?php previous_post_link('%link');?></span>
    	<span class="next"><?php next_post_link('%link');?></span>
    	<div class="clear"></div>
  	</nav>
  </section>
  <?php comments_template('',true);}}?>
</article>
<?php get_sidebar();?>
<div class="clear"></div>
</div>
<?php get_footer();?>