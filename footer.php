<footer>
  <div class="container">
    <ul class="row">
    <?php if(!dynamic_sidebar('footer-sidebar')){$ilost_widgerFooter=array('before_widget'=>'<li class="widget col-xl-3 col-xs-3 col-md-3 col-sm-3">','after_widget'=>'</li>');
      the_widget('ilost_footlistsWidget','catid=1&number=5',$ilost_widgerFooter);
      the_widget('ilost_footlistsWidget','catid=1&number=5',$ilost_widgerFooter);
      the_widget('ilost_footlistsWidget','catid=3&number=5',$ilost_widgerFooter);
      the_widget('ilost_footlistsWidget','catid=4&number=5',$ilost_widgerFooter);
      the_widget('ilost_footlistsWidget','catid=5&number=5',$ilost_widgerFooter);
      the_widget('ilost_footlistsWidget','catid=6&number=5',$ilost_widgerFooter);
    }?>
    </ul>
    <div class="copyrt">
      <p class="line"><span class="alignright"><?php printf('<a href="'.ilost_wp_homeurl.'/'.'">HOME</a>'.__(' &brvbar; '));?><a href="<?php echo ilost_wp_rss2_url;?>"><?php echo esc_attr('RSS Feed');?></a></span><?php printf('<a href="'.esc_attr('http://creativecommons.org/licenses/by-nc-sa/3.0').'">Creative Commons BY-NC-SA</a>'.__(' &brvbar; ').'This is a premium theme'.__(' &brvbar; ').'Designed by <a href="'.esc_attr('http://xuui.net/').'">Xu.hel</a> in ChengDu.');?></p>
      <p><span class="alignright"><?php wp_register('','');?></span><?php printf('Copyright &copy; 2006-2016 <a href="%1$s/" title="%2$s" rel="home">%2$s</a> &brvbar; Powered by <a href="http://wordpress.org/">WordPress</a>.',ilost_wp_homeurl,ilost_wp_name);?></p>
    </div>

  </div>
<?php /*
  <div class="container">
    
    <div class="row">
      <div class="col-xl-122">
      </div>
    </div>
  </div>
  <div id="gotop"><a href="javascript:;" onClick="ilosts.goTop();return false;" title="<?php _e('Back Top','iLost');?>"><?php _e('Back Top','iLost');?></a></div>
  <?php if(!is_front_page()){?>
  <aside class="row hidden-xs hidden-sm">
    <h3><?php _e(ilost_wp_name.' Archives','iLost');?> &raquo;</h3>
    <ul>
      <?php if(!dynamic_sidebar('footer-sidebar')){$ilost_widgerFooter=array('before_widget'=>'<li>','after_widget'=>'</li>');
      }?>
    </ul>
    <i class="clearfix"></i>
  </aside>
  <?php }?>
</div>
*/?>
</footer>
<?php wp_footer();?>
<!--<?php echo get_num_queries();?> queries. <?php timer_stop(1);?> seconds. -->
</body>
</html>