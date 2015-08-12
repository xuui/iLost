<?php get_header();?>
<div id="content">
<article>
  <?php if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
   	<div class="title">
      <h2><?php the_title();?></h2>
    </div>
    <div class="entry">
    	<?php the_content(__('Learn more','iLost'));
    	wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');?>
    </div>
    <div class="post-meta"<?php ilost_lgshow();?>>
			<?php edit_post_link(__('Edit','iLost'),'<span>[',']</span>');?>
    </div>
  </section>
  <?php comments_template('',true);}}?>
</article>
<?php get_sidebar();?>
<div class="clear"></div>
</div>
<?php get_footer();?>