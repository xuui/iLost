<?php get_header();?>
<div class="breadwarp">
  <div class="container">
      <?php breadcrumb_simple();//ilost_breadcrumb();?>
  </div>
</div>
<div class="contwarp contindex">
  <div class="container">
    <div class="row">
    <article class="col-xs-12 col-sm-8 col-md-9 col-xl-9 <?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
      <?php if(have_posts()){ilost_breadcrumb();?>
      <?php while(have_posts()){the_post();?>
        <section id="post-<?php the_ID();?>" <?php post_class();?>>
        <?php if(has_post_thumbnail()){
        $img_src=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        echo '<div class="thumg" style="background-image:url('.$img_src[0].')"></div>';
        }?>
        <div class="inarp">
          <div class="title">
            <h2><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','iLost'),the_title_attribute('echo=0'));?>" rel="bookmark"><?php the_title();?></a></h2>
            <small><?php the_time('m.d.Y');?>, <?php comments_popup_link(__('0','iLost'),__('1','iLost'),__('%','iLost'),'post-comments',__('-','iLost'));?>, <?php the_category(', ');?>, by <?php the_author_posts_link();?><?php if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
          </div>
          <div class="entry">
            <?php //the_post_thumbnail('thumbnail');
            the_excerpt();?>
          </div>
          <div class="post-meta">
            <?php edit_post_link(__('Edit','iLost'),'<span class="alignright">[',']</span>');?><?php the_tags(__('Tags: ','iLost'),' | ','');?>&nbsp;<i class="clearfix"></i>
          </div>
        </div>
        </section>
        <?php }?>
        <nav class="navigation">
          <?php ilost_pagenav();?>
        </nav>
        <?php }?>
    </article>
    <?php get_sidebar();?>
    <i class="clearfix"></i>
    </div>
  </div>
</div>
<?php get_footer();?>