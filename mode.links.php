<?php /* Template Name: Links */
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
        <?php if(have_posts()){while(have_posts()){the_post();?>
        <section id="post-<?php the_ID();?>" <?php post_class();?>>
          <ul id="linkpage"><?php wp_list_bookmarks();?></ul>
        </section>
        <?php }}?>
      </article>
      <?php get_sidebar();?>
      <i class="clearfix"></i>
    </div>
  </div>
</div>
<?php get_footer();?>