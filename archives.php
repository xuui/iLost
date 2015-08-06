<?php /* Template Name: Archives */
get_header();?>
<div id="content">
<article>
  <?php if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
   	<div class="title">
      <h2><?php the_title();?></h2>
    </div>
    <div id="archives" class="entry">
      <ul class="arslink"><?php wp_get_archives('type=monthly&show_post_count=true');?><li class="clearer"></li></ul>
			<h3 class="line"><?php _e('Recent Articles','iLost');?></h3>
      <ul class="ulpost"><?php wp_get_archives('type=postbypost&limit=40');?><li class="clearer"></li></ul>
    </div>
    <div class="post-meta"<?php ilost_lgshow();?>>
			<?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?><div class="clear"></div>
    </div>
  </section>
  <?php }}?>
</article>
<?php get_sidebar();?>
<div class="clear"></div>
</div>
<?php get_footer();?>