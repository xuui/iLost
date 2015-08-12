<?php get_header();?>
<script type="text/javascript">
(function(jQuery){ilostQ=jQuery.noConflict();ilostQ(document).ready(function(){ilostQ('#menu-item-1997').removeClass('current_page_parent');ilostQ('#menu-item-2028').addClass('current_page_parent');});})(jQuery);
</script>
<div id="container">
<article>
  <?php if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="title">
      <h1><?php the_title();?></h1>
      <small><?php the_time('m.d.Y');if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
    </div>
    <?php ilost_getshare();?>
    <div class="entry">
      <?php the_post_thumbnail('medium');
      the_content();?>
    </div>
    <div class="post-meta">
      <div class="clear"></div>
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