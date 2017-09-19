<?php /* Template Name: Archives */
get_header();?>
<div class="subhead">
  <div id="" class="container">
    <div class="page-header"><h1><?php the_title();?></h1></div>
  </div>
</div>
<div class="pagewarp">
  <div class="container">
    <div id="row" class="row">
      <article class="col-xl-9 col-md-9 col-sm-8 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
        <?php //
        if(have_posts()){while(have_posts()){the_post();?>
        <section id="post-<?php the_ID();?>" <?php post_class();?>>
          <div id="archives" class="entry">
            <h2><?php the_title();?></h2>
            <ul class="arslink"><?php wp_get_archives('type=monthly&show_post_count=true');?><li class="clearer"></li></ul>
            <h3 class="line"><?php _e('Recent Articles','iLost');?></h3>
            <ul class="ulpost"><?php wp_get_archives('type=postbypost&limit=40');?><li class="clearer"></li></ul>
            <?php //the_content(__('Learn more','iLost'));
            //wp_link_pages('before=<nav class="post-link">&after=</nav>&next_or_number=number&pagelink=<span>%</span>');?>
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

  

