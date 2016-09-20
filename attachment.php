<?php get_header();?>
<div id="container">
<article>
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
      the_tags(__('Tags: ','iLost'),' | ','');?><div class="clear"></div>
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
<div class="clear"></div>
</div>
<?php get_footer();?>