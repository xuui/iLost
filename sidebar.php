<aside id="aside" class="col-sm-4 col-md-3 col-xl-3 hidden-xs">
  
  <ul id="siderbar" class="sider clear">
  <?php 
  if(is_page()){
    if(!function_exists('dynamic_sidebar')||!dynamic_sidebar('page-sidebar')){
      the_widget('WP_Widget_Recent_Posts','number=6');
      the_widget('WP_Widget_Categories','');
      the_widget('WP_Widget_Meta','');
    }
  }else{
    if(!function_exists('dynamic_sidebar')||!dynamic_sidebar('ilost-sidebar')){
      if(is_home()&&function_exists('get_most_viewed')){the_widget('ilost_viewsWidget','number=5');}
      the_widget('ilost_RavatarWidget','number=10');
      the_widget('ilost_RCommentsWidget','number=6');
      the_widget('WP_Widget_Categories','');
      the_widget('WP_Widget_Meta','');
    }
  }
  /*
  //$ilost_widgerSide=array('before_widget'=>'<li id="%1$s" class="widget %2$s">','after_widget'=>'</li>','before_title'=>'<h3 class="widgettitle">','after_title'=>'</h3>');
  $ilost_widgerSide='';
  if(is_single()){if(have_posts()){while(have_posts()){the_post();
	$demos=get_post_meta(get_the_ID(),"demo",$single=true);if($demos){echo "<section class=\"ilost_demo\"><a class=\"btn btn-success btn-lg btn-block\" href=\"".$demos."\">".__('View Demo','iLost')."</a></section>\n";}
	$downloads=get_post_meta(get_the_ID(),"download",$single=true);if($downloads){echo "<section class=\"ilost_downloads\"><a class=\"btn btn-primary btn-lg btn-block\" href=\"".$downloads."\">".__('Download Now','iLost')."</a></section>\n";}
	$paybys=get_post_meta(get_the_ID(),"payby",$single=true);if($paybys){$payinfo=explode("###",$paybys);if($payinfo[0] && $payinfo[1]){$payurl=$payinfo[0];$paynum=' ('.$payinfo[1].')';echo "<section class=\"ilost_paybys\"><a class=\"btn btn-info btn-lg btn-block\" href=\"".$payurl."\">".__('Buy Now','iLost').$paynum."</a></section>\n";}
  }}}}
  ilost_adgsidebartop();?>
  <?php 
    if(is_single()){if(ilost_showAuthor())ilost_postAuthor(get_the_ID());}
    if(is_page()){$children=wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');if($children){?>
    <li><h3><?php the_title();?></h3><ul><?php echo $children;?></ul></li>
  <?php }
  }else{
    }ilost_adgsidebarbottom();
  */?>
  </ul>
</aside>