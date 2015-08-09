<?php /* Template Name: Home */
get_header();ilost_getiloshow();?>
<?php $homempid=ilost_getfront();
$shopics=get_post_meta($homempid,"shopimages",$single=false);if($shopics){echo '<div id="proaside">';foreach($shopics as $shopic){$shopiclib=explode("###",$shopic);if(@$shopiclib[1]){$shoplink=$shopiclib[1];}else{$shoplink='#';}if($shopiclib[0]){echo '<a href="'.$shoplink.'"><img src="'.$shopiclib[0].'" width="310" height="160" alt=""/></a>';}}echo '</div>';}?>
<div id="content" class="clear">
<article class="home">
	<?php if(!dynamic_sidebar('home-listbar')){
		the_widget('ilost_querycatsWidget','catid=4&number=6');
		the_widget('ilost_querycatsWidget','catid=5&number=6');
	}?>
</article>
<aside>
	<ul id="sidehome" class="clear">
	<?php $ilost_widgerSide=array('before_widget'=>'<li id="%1$s" class="widget %2$s">','after_widget'=>'</li>','before_title'=>'<h3 class="widgettitle">','after_title'=>'</h3>');
	if(!dynamic_sidebar('home-sidebar')){
		the_widget('ilost_randompostWidget','number=6',$ilost_widgerSide);
		the_widget('WP_Widget_Recent_Posts','number=6',$ilost_widgerSide);
		if(function_exists('get_most_viewed')){the_widget('ilost_viewsWidget','number=6',$ilost_widgerSide);}
		the_widget('WP_Widget_Categories','',$ilost_widgerSide);
		the_widget('WP_Widget_Meta','',$ilost_widgerSide);
		}?>
	</ul>
</aside>
<div class="clear"></div>
</div>
<?php get_footer();?>