<?php /* Template Name: Guest Book */
get_header();?>
<div id="row" class="row">
<div class="page-header"><h1><?php the_title();?></h1></div>
<article class="col-xl-9 col-md-9 col-sm-8 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
  <?php ilost_breadcrumb();if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="entry">
      <?php the_content(__('Learn more','iLost'));
      wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');?>
    </div>
    <div class="post-meta"<?php ilost_lgshow();?>>
      <?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?>&nbsp;<i class="clearfix"></i>
    </div>
  </section>
  <?php comments_template('',true);
  }}?>
</article>
<?php get_sidebar();?>
<i class="clearfix"></i>
</div>
<?php get_footer();?>