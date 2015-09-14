<?php get_header();?>
<div class="row">
<article class="col-xl-9 col-md-9 col-sm-8 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
  <?php if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="title">
      <h2><?php the_title();?></h2>
      <small><?php the_time('m.d.Y');?>, <?php the_category(', ');?>, by <?php the_author_posts_link();?><?php if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
    </div>
    <div class="entry">
      <?php the_content();?>
    </div>
    <div class="post-meta">
      <?php edit_post_link(__('Edit','iLost'),'<span class="alignright"> [',']</span>');
      the_tags(__('Tags: ','iLost'),' | ','');?>&nbsp;<i class="clearfix"></i>
    </div>
    <nav class="post-nav">
      <span class="previous"><?php previous_post_link('%link');?></span>
      <span class="next"><?php next_post_link('%link');?></span>
      <div class="clear"></div>
    </nav>
  </section>
  <?php }}?>
</article>
<?php get_sidebar();?>
<i class="clearfix"></i>
</div>
<?php get_footer();?>