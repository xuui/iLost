<?php /* Template Name: About */
get_header();?>
<div class="subhead">
  <div id="" class="container">
    <div class="page-header"><h1><?php the_title();?></h1></div>
  </div>
</div>
<div class="pagewarp">
  <div class="container">
    <div id="row" class="row">
      <article class="col-xl-9 col-md-9 col-sm-8 col-xs-12 mode-about<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
        <?php if(have_posts()){while(have_posts()){the_post();?>
        <section id="post-<?php the_ID();?>" <?php post_class();?>>
          <div class="entry">
            <?php $avatar=get_post_meta($post->ID,"avatar",$single=true);echo '<div class="avatar-warp"><span></span>'.get_avatar($avatar,'128','wavatar').'</div>';
            the_content();
            wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');?>
          </div>
          <div class="post-meta"<?php ilost_lgshow();?>>
            <?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?>&nbsp;<i class="clearfix"></i>
          </div>
        </section>
        <?php }}?>
      </article>
      <?php get_sidebar();?>
      <i class="clearfix"></i>
    </div>
  </div>
</div>
<?php get_footer();?>