<?php get_header();?>
<div class="row">
<article class="col-xl-9 col-md-9 col-sm-12 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
  <?php if(have_posts()){while(have_posts()){the_post();?>
  <section id="post-<?php the_ID();?>" <?php post_class();?>>
    <div class="title">
      <h1><?php the_title();?></h1>
      <small><?php the_time('m.d.Y');?>, <?php the_category(', ');?>, by <?php the_author_posts_link();?><?php if(function_exists('the_views')){?>, <?php the_views();}?>.<?php edit_post_link(__('Edit','iLost'),' [',']&#187;');?></small>
    </div>
    <div class="entry">
      <?php ilost_getshare();the_post_thumbnail(array(960,240));?>
    </div>
    <div class="post-meta"<?php ilost_lgshow();?>>
      <?php edit_post_link(__('Edit','iLost'),'<p class="text-right">[',']</p>');?>&nbsp;<i class="clearfix"></i>
    </div>
    <?php ilost_adgpostend();?>
    <nav>
      <ul class="pager">
        <li class="next"><?php previous_post_link('%link');?></li>
        <li class="previous"><?php next_post_link('%link');?></li>
        <li class="clearfix"></li>
      </ul>
    </nav>
  </section>
  <?php }}?>
</article>
<i class="clearfix"></i>
</div>
<?php get_footer();?>