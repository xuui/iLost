<?php /* Template Name: Links */
get_header();?>
<div id="container">
<div class="pageheader"><h1><?php the_title();?></h1></div>
<?php if(ilost_getsidefl()=='left')get_sidebar();?>
<article>
  <?php ilost_breadcrumb();if(have_posts()){while(have_posts()){the_post();//ilost_breadcrumb();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <ul id="linkpage"><?php wp_list_bookmarks();?></ul>
    <div class="post-meta"<?php ilost_lgshow();?>>
      <?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?><div class="clear"></div>
    </div>
  </section>
  <?php }}?>
</article>
<?php if(ilost_getsidefl()=='right')get_sidebar();?>
<div class="clear"></div>
</div>
<?php get_footer();?>