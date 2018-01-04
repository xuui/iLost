<?php get_header();?>
<div class="breadwarp">
  <div class="container">
      <?php
      //if(is_home()){echo 'is_home';} 
      //echo rand(1,10);
      ilost_breadcrumb();?>
  </div>
</div>
<?php /*$blogpageID=ilost_getposts();if($blogpageID){?>
<div class="subhead">
  <div class="container">
    <div class="page-header"><h1><?php echo get_the_title($blogpageID);?></h1></div>
  </div>
</div>
<?php }*/?>
<div class="contwarp contindex">
  <div class="container">
    <div class="row">
    <article class="col-xs-12 col-sm-8 col-md-9 col-xl-9 <?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
      <?php if(have_posts()){while(have_posts()){the_post();?>
      <section id="post-<?php the_ID();?>" <?php post_class();?>>
        <?php if(has_post_thumbnail()){
        $img_src=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');?>
        <div class="thumg" style="background-image:url(<?php echo $img_src[0]?>)">
          <h2><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s','iLost'),the_title_attribute('echo=0'));?>" rel="bookmark"><?php the_title();?></a></h2>
        </div>
        <?php }?>
        <div class="inarp">
          <div class="title">
            <?php if(!has_post_thumbnail()){?>
            <h2><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s','iLost'),the_title_attribute('echo=0'));?>" rel="bookmark"><?php the_title();?></a></h2>
            <?php }?>
            <small>
              <span class="post-data pull-right">
                <i class="fa fa-calendar-o"></i> <?php the_time('Y-m-d');?>
              </span>
              <span class="post-author">
                <?php echo get_avatar(get_the_author_meta('user_email'),48);
                the_author_posts_link();?>
              </span>
              <span class="post-data">
                <i class="fa fa-comment-o"></i>
                <?php comments_popup_link(__('0','iLost'),__('1','iLost'),__('%','iLost'),'post-comments',__('-','iLost'));?>
              </span>
              <!--span class="post-data">
                <i class="fa fa-eye"></i> 1<?php if(function_exists('the_views')){?><?php the_views();}?>
              </span-->
              <?php /*
              <i class="fa fa-folder-o"></i> <?php the_category(', ');?>
               <?php edit_post_link(__('Edit','iLost'),'<i class="fa fa-pencil-square-o"></i> [',']&#187;');?>
              */?>
            </small>
          </div>
          <div class="entry">
            <?php the_excerpt();
            //the_content(__('Learn more','iLost'));?>
          </div>
        </div>
        <?php $posTag=get_the_tag_list('<span class="tag"><i class="ion-ios-pricetag-outline"></i>','</span> <span class="tag"><i class="ion-ios-pricetag-outline"></i>','</span>');
        if($posTag){echo '<div class="post-meta">'.$posTag.'</div>';}?>
      </section>
      <?php }?>
      <nav>
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
  </div>
</div>
<?php get_footer();?>