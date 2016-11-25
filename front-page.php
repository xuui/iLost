<?php /* Template Name: Home */
get_header();?>
<?php ilost_getiloshow();?>
<div id="proaside">
<?php //$homempid=ilost_getfront();
/*ilost_showCatpoTm();
$shopics=get_post_meta($homempid,"shopimages",$single=false);if($shopics){
  echo '<div class="container"><div class="row">';
  $col_class="col-xl-4 col-xs-4 col-md-4 col-sm-4";
  //$col_class="col-xl-3 col-xs-3 col-md-3 col-sm-3";
  foreach($shopics as $shopic){$shopiclib=explode("###",$shopic);if(@$shopiclib[1]){$shoplink=$shopiclib[1];}else{$shoplink='#';}if($shopiclib[0]){
    echo '<div class="'.$col_class.'"><a href="'.$shoplink.'" style="background-image:url('.$shopiclib[0].')"><span>span</span></a></div>';
  }
}echo '</div></div>';}*/?>
  <div class="container"><div class="row">
    <?php ilost_showProTu(ilost_frontCat());?>
  </div></div>
</div>
<div id="newpost">
  <div class="container">
    <div class="row">
      <?php ilost_queryNewp($limit=4);?>
    </div>
  </div>
</div>
<?php /*
<?php if(!dynamic_sidebar('home-listbar')){
  //the_widget('ilost_querycatsWidget','catid=4&number=6');
  //the_widget('ilost_querycatsWidget','catid=5&number=6');
}?>
<?php if(!dynamic_sidebar('home-sidebar')){
  //the_widget('ilost_randompostWidget','number=6',$ilost_widgerSide);
  //the_widget('WP_Widget_Recent_Posts','number=6',$ilost_widgerSide);
  //if(function_exists('get_most_viewed')){the_widget('ilost_viewsWidget','number=6',$ilost_widgerSide);}
  //the_widget('WP_Widget_Categories','',$ilost_widgerSide);
  //the_widget('WP_Widget_Meta','',$ilost_widgerSide);
}?>
front-page
*/?>
<?php get_footer();?>