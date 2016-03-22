<?php get_header();?>
<div id="row" class="row">
<article class="col-xl-9 col-md-9 col-sm-8 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
  <?php if(have_posts()){ilost_breadcrumb();?>
  <?php while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="title">
      <h2><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','iLost'),the_title_attribute('echo=0'));?>" rel="bookmark"><?php the_title();?></a></h2>
      <small><?php the_time('m.d.Y');?>, <?php comments_popup_link(__('No Comments','iLost'),__('1 Comment','iLost'),__('% Comments','iLost'));?>, <?php the_category(', ');?>, by <?php the_author_posts_link();?><?php if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
    </div>
    <div class="entry">
      <?php the_post_thumbnail('thumbnail');
      the_excerpt();?>
    </div>
    <div class="post-meta">
      <?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?><?php the_tags(__('Tags: ','iLost'),' | ','');?>&nbsp;<i class="clearfix"></i>
    </div>
  </section>
  <?php }?>
  <nav class="navigation">
    <?php ilost_pagenav();?>
  </nav>
  <?php }else{?>
  <section>
     <div class="title"><h2><?php _e('Not Found','iLost');?></h2></div>
    <div class="entry">
      <p><?php _e('Sorry, but you are looking for something that isn\'t here.','iLost');?></p>
      <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.','iLost');?></p>
      <?php get_search_form();?>
    </div>
  </section>
  <?php }?>
</article>
<?php get_sidebar();?>
<i class="clearfix"></i>
</div>
<?php get_footer();?>