<?php /* Template Name: Links */
get_header();?>
<div class="row">
<div class="page-header"><h1><?php the_title();?></h1></div>
<?php if(ilost_getsidefl()=='left')get_sidebar();?>
<article class="col-xl-9 col-md-9 col-sm-8 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
  <?php ilost_breadcrumb();if(have_posts()){while(have_posts()){the_post();//ilost_breadcrumb();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <ul id="linkpage"><?php wp_list_bookmarks();?></ul>
    <div class="post-meta"<?php ilost_lgshow();?>>
      <?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?>&nbsp;<i class="clear"></i>
    </div>
  </section>
  <?php }}?>
</article>
<?php if(ilost_getsidefl()=='right')get_sidebar();?>
<i class="clear"></i>
</div>
<?php get_footer();?>