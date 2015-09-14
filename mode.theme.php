<?php /* Template Name: Themes */
get_header();?>
<div class="row">
<div class="page-header"><h1><?php the_title();?></h1></div>
<style type="text/css">
article#thThumbs{padding:10px 24px;width:650px;}
#thThumbs section{clear:both;margin:20px 20px 10px;}
#thThumbs section img{float:right;margin-top:-40px;width:300px;height:225px;}
/*
#thThumbs section{float:left;margin:8px;padding:5px;box-shadow:0 1px 5px rgba(0,0,0,0.13);}
#thThumbs section a,#thThumbs section a span{display:block;}
#thThumbs section a{color:#888;text-decoration:none;}
#thThumbs section a:hover{color:#08c;text-decoration:none;}
#thThumbs section a img{border:1px solid #ddd;padding:3px;width:300px;height:225px;}
#thThumbs section a span{text-align:center;}
*/
</style>
<article class="col-xl-9 col-md-9 col-sm-8 col-xs-12<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>" id="thThumbs">
<?php //query_posts('meta_key=thumb');while(have_posts()):the_post();
//echo '<p>';the_title();echo '</p>';
//endwhile;wp_reset_query();
function the_excerpt_max_charlength($charlength){
  $excerpt=strip_tags(get_the_excerpt());
  if(strlen($excerpt)>$charlength){
    //$subex=substr($excerpt,0,$charlength-5);
    //$subex=substr($excerpt,0,$charlength);
    $subex=ilost_substr($excerpt,0,$charlength,'UTF-8');
    echo $subex;
  }else{echo $excerpt;}
}
$themeThumbs=new WP_Query();
$themeThumbs->query(array('meta_key'=>'thumb','showposts'=>'100'));
while($themeThumbs->have_posts()){$themeThumbs->the_post();?>
<section>
  <div class="title"><h2><?php the_title();?></h2></div>
  <div class="entry">
    <img src="<?php echo get_post_meta(get_the_ID(),"thumb",$single=true);?>" class="alignright" alt="<?php the_title();?>"/>
    <?php the_excerpt_max_charlength(200);//the_excerpt();?>
  </div>
  <div class="post-meta clear">
    <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','iLost'),the_title_attribute('echo=0'));?>" rel="bookmark"><?php printf(__('DownLoad Now!','iLost'));?></a>
  </div>
</section>
<?php }
/*echo '<script type="text/javascript" src="'.ilost_path.'/scripts/rotation.js"></script>';*/?>
</article>
<?php get_sidebar();?>
<i class="clearfix"></i>
</div>
<?php get_footer();?>