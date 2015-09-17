<?php get_header();?>
<div id="row" class="row">
<article class="col-xl-9 col-md-9 col-sm-8 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
  <?php if(have_posts()){while(have_posts()){the_post();ilost_breadcrumb();
  $logined=get_post_meta(get_the_ID(),"logined",$single=true);?>
  
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="title">
      <h1><?php the_title();?></h1>
      <small><?php the_time('m.d.Y');?>, <?php the_category(', ');?>, by <?php the_author_posts_link();?><?php if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
    </div>
    <div class="entry">
      <?php ilost_adgpostemb();
      if($logined=="1"){
        if(is_user_logged_in()){the_content();wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');
        }else{printf(__('View this article need to login.','iLost'));}
      }else{
        the_content();wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');
      }
      ilost_getshare();
      $demos=get_post_meta(get_the_ID(),"demo",$single=true);if($demos){echo "<section class=\"ilost_demo\"><a class=\"btn btn-success btn-lg\" href=\"".$demos."\">".__('View Demo','iLost')."</a></section>\n";}
      $downloads=get_post_meta(get_the_ID(),"download",$single=true);if($downloads){echo "<section class=\"ilost_downloads\"><a class=\"btn btn-primary btn-lg\" href=\"".$downloads."\">".__('Download Now','iLost')."</a></section>\n";}
      $paybys=get_post_meta(get_the_ID(),"payby",$single=true);if($paybys){$payinfo=explode("###",$paybys);if($payinfo[0] && $payinfo[1]){$payurl=$payinfo[0];$paynum=' ('.$payinfo[1].')';echo "<section class=\"ilost_paybys\"><a class=\"btn btn-info btn-lg\" href=\"".$payurl."\">".__('Buy Now','iLost').$paynum."</a></section>\n";}}
      ?>
    </div>
    <?php if(ilost_showAuthor())ilost_postAuthor();
	if(ilost_relatedpost())ilost_relatedposts(get_the_ID(),$limit=ilost_repostNum());?>
    <div class="post-meta">
    <?php edit_post_link(__('Edit','iLost'),'<span class="alignright"> [',']</span>');
      the_tags(__('Tags: ','iLost'),' | ','');?>&nbsp;<i class="clearfix"></i>
    </div>
    <?php ilost_adgpostend();?>
    <nav>
      <ul class="pager">
        <li class="next"><?php previous_post_link('%link');?></li>
        <li class="previous"><?php next_post_link('%link');?></li>
        <li class="clearfix"></li>
      </ul>
    </nav>
  </section>
  <?php comments_template('',true);}}?>
</article>
<?php get_sidebar();?>
<i class="clearfix"></i>
</div>
<?php get_footer();?>