<?php /* Template Name: Talk */
get_header();?>
<div id="container">
<div class="pageheader"><h1><?php the_title();?></h1></div>
<?php if(ilost_getsidefl()=='left')get_sidebar();?>
<article>
  <?php ilost_breadcrumb();$paged=(get_query_var('paged'))?get_query_var('paged'):1;
  query_posts(array('post_type'=>'xutalk','showposts'=>10,'paged'=>$paged));
  $wp_query->is_archive=true;$wp_query->is_home=false;
  if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
     <div class="title">
      <h2><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','iLost'),the_title_attribute('echo=0'));?>" rel="bookmark"><?php the_title();?></a></h2>
      <small><?php the_time('m.d.Y');?>, <?php comments_popup_link(__('No Comments','iLost'),__('1 Comment','iLost'),__('% Comments','iLost'));if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
    </div>
    <div class="entry">
      <?php the_post_thumbnail('medium');
      the_content();?>
    </div>
    <div class="post-meta">
      <div class="clear"></div>
    </div>
  </section>
  <?php }?>
  <nav class="navigation">
    <?php ilost_pagenav();?>
  </nav>
  <?php }wp_reset_query();?>
</article>
<?php if(ilost_getsidefl()=='right')get_sidebar();?>
<div class="clear"></div>
</div>
<?php get_footer();?>