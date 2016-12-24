<aside id="aside" class="col-sm-4 col-md-3 col-xl-3 hidden-xs">
  <?php //$ilost_widgerSide=array('before_widget'=>'<li id="%1$s" class="widget %2$s">','after_widget'=>'</li>','before_title'=>'<h3 class="widgettitle">','after_title'=>'</h3>');
  if(is_single()){if(have_posts()){while(have_posts()){the_post();
	$demos=get_post_meta(get_the_ID(),"demo",$single=true);if($demos){echo "<section class=\"ilost_demo\"><a class=\"btn btn-success btn-lg btn-block\" href=\"".$demos."\">".__('View Demo','iLost')."</a></section>\n";}
	$downloads=get_post_meta(get_the_ID(),"download",$single=true);if($downloads){echo "<section class=\"ilost_downloads\"><a class=\"btn btn-primary btn-lg btn-block\" href=\"".$downloads."\">".__('Download Now','iLost')."</a></section>\n";}
	$paybys=get_post_meta(get_the_ID(),"payby",$single=true);if($paybys){$payinfo=explode("###",$paybys);if($payinfo[0] && $payinfo[1]){$payurl=$payinfo[0];$paynum=' ('.$payinfo[1].')';echo "<section class=\"ilost_paybys\"><a class=\"btn btn-info btn-lg btn-block\" href=\"".$payurl."\">".__('Buy Now','iLost').$paynum."</a></section>\n";}
  }}}}
  ilost_adgsidebartop();?>
  <ul id="siderbar" class="sider clear">
  <?php 
    if(is_single()){ if(ilost_showAuthor())ilost_postAuthor(get_the_ID());?>
          
    <!--li id="recent-posts-2" class="box-widget widget-user">
      <div class="widget-user-header bg-aqua-active">
        <h3 class="widget-user-username">Alexander Pierce</h3>
        <h5 class="widget-user-desc">Founder &amp; CEO</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle" src="//127.0.0.1/0.%20UI-Design.res/AdminLTE.git/dist/img/user1-128x128.jpg" alt="User Avatar">
      </div>
      <div class="box-widget-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">3,200</h5>
              <span class="description-text">SALES</span>
            </div>
          </div>
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">13,000</h5>
              <span class="description-text">FOLLOWERS</span>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">35</h5>
              <span class="description-text">PRODUCTS</span>
            </div>
          </div>
        </div>
      </div>
    </li-->
    <?php }
    if(is_page()){$children=wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');if($children){?>
    <li><h3><?php the_title();?></h3><ul><?php echo $children;?></ul></li>
  <?php }if(!function_exists('dynamic_sidebar')||!dynamic_sidebar('page-sidebar')){
    the_widget('WP_Widget_Categories','',$ilost_widgerSide);
    the_widget('WP_Widget_Recent_Posts','number=6',$ilost_widgerSide);
    the_widget('WP_Widget_Meta','',$ilost_widgerSide);}
  }else{if(!function_exists('dynamic_sidebar')||!dynamic_sidebar('ilost-sidebar')){
    the_widget('WP_Widget_Categories','',$ilost_widgerSide);
    if(is_home()&&function_exists('get_most_viewed')){the_widget('ilost_viewsWidget','number=5',$ilost_widgerSide);}
    the_widget('ilost_RavatarWidget','number=10',$ilost_widgerSide);
    the_widget('ilost_RCommentsWidget','number=6',$ilost_widgerSide);
    the_widget('WP_Widget_Meta','',$ilost_widgerSide);
  }}ilost_adgsidebarbottom();?>
  </ul>
</aside>