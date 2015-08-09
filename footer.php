<footer>
  <div id="gotop"><a href="javascript:;" onClick="ilosts.goTop();return false;" title="<?php _e('Back Top','iLost');?>"><?php _e('Back Top','iLost');?></a></div>
  <?php if(!is_front_page()){?>
  <aside>
    <h3><?php _e(ilost_wp_name.' Archives','iLost');?></h3>
    <ul>
      <?php if(!dynamic_sidebar('footer-sidebar')){$ilost_widgerFooter=array('before_widget'=>'<li>','after_widget'=>'</li>');
        the_widget('ilost_catlistsWidget','catid=1&number=5',$ilost_widgerFooter);
        the_widget('ilost_catlistsWidget','catid=3&number=5',$ilost_widgerFooter);
        the_widget('ilost_catlistsWidget','catid=4&number=5',$ilost_widgerFooter);
        the_widget('ilost_catlistsWidget','catid=5&number=5',$ilost_widgerFooter);
        the_widget('ilost_catlistsWidget','catid=6&number=5',$ilost_widgerFooter);
      }?>
    </ul>
    <div class="clearer"></div>
  </aside>
  <?php }?>
  <div>
    <p class="line"><span class="alignright"><?php printf('<a href="'.ilost_wp_homeurl.'/'.'">HOME</a>'.__(' &brvbar; '));?><a href="<?php echo ilost_wp_rss2_url;?>"><?php echo esc_attr('RSS Feed');?></a></span><?php printf('<a href="'.esc_attr('http://creativecommons.org/licenses/by-nc-sa/3.0').'">Creative Commons BY-NC-SA</a>'.__(' &brvbar; ').'This is a premium theme'.__(' &brvbar; ').'Designed by <a href="'.esc_attr('http://xuui.net/').'">Xu.hel</a> in ChengDu.');//This is a private theme?></p>
    <p><span class="alignright"><?php wp_register('',' &brvbar; ');printf('<a class="mtlogo" href="http://www.mediatemple.net/go/order/?refdom=xuui.net" title="Hosted by (mt) Media Temple">Hosted by (mt) Media Temple</a>');?></span><?php printf('Copyright &copy; 2006-2011 <a href="%1$s/" title="%2$s" rel="home">%2$s</a> &brvbar; Powered by <a href="http://wordpress.org/">WordPress</a>.',ilost_wp_homeurl,ilost_wp_name);?>
    </p>
  </div>
</footer>
<?php wp_footer();?>
</body>
</html>