<?php /* Template Name: Home */
get_header();?>
<?php //ilost_getiloshow();?>
<?php $homempid=ilost_getfront();
$shopics=get_post_meta($homempid,"shopimages",$single=false);if($shopics){echo '<div id="proaside" class="row clear">';foreach($shopics as $shopic){$shopiclib=explode("###",$shopic);if(@$shopiclib[1]){$shoplink=$shopiclib[1];}else{$shoplink='#';}if($shopiclib[0]){echo '<div class="col-xl-4 col-xs-4 col-md-4 col-sm-4 text-center"><a href="'.$shoplink.'"><img src="'.$shopiclib[0].'" alt=""/></a></div>';}}echo '</div>';}?>
<div id="row" class="row clear">
  <article class="col-xl-9 col-md-9 col-sm-8 col-xs-12 home<?php if(ilost_getsidefl()=='left')echo ' pull-right'?>">
    <?php if(!dynamic_sidebar('home-listbar')){
      the_widget('ilost_querycatsWidget','catid=4&number=6');
      the_widget('ilost_querycatsWidget','catid=5&number=6');
    }?>
  </article>
  <aside class="col-xl-3 col-md-3 col-sm-4 col-xs-12 modhome">
    <ul id="sidehome" class="clearfix">
    <?php if(!dynamic_sidebar('home-sidebar')){
      the_widget('ilost_randompostWidget','number=6',$ilost_widgerSide);
      the_widget('WP_Widget_Recent_Posts','number=6',$ilost_widgerSide);
      if(function_exists('get_most_viewed')){the_widget('ilost_viewsWidget','number=6',$ilost_widgerSide);}
      the_widget('WP_Widget_Categories','',$ilost_widgerSide);
      the_widget('WP_Widget_Meta','',$ilost_widgerSide);
      }?>
    </ul>
  </aside>
  <i class="clearfix"></i>
</div>
<?php get_footer();?>