<?php /* Template Name: About */
get_header();?>
<div id="container">
<div class="pageheader"><h1><?php the_title();?></h1></div>
<article class="mode-about">
  <?php ilost_breadcrumb();if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="entry">
      <?php $avatar=get_post_meta($post->ID,"avatar",$single=true);echo '<div class="avatar-warp"><span></span>'.get_avatar($avatar,'128','wavatar').'</div>';
      the_content(__('Learn more','iLost'));
      wp_link_pages('before=<nav class="page-links">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');?>
    </div>
    <div class="post-meta"<?php ilost_lgshow();?>>
      <?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?><div class="clear"></div>
    </div>
  </section>
  <?php //comments_template('',true);
  }}?>
</article>
<?php get_sidebar();?>
<div class="clear"></div>
</div>
<?php get_footer();?>