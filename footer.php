<hr/>
<footer>
	<div>
		<p class="line"><span class="alignright"><?php printf('<a href="'.home_url('/').'" title="'.esc_attr(get_bloginfo('name', 'display')).'">'.__('HOME','iLost').'</a>'.__(' &brvbar; ','iLost'));?><a href="<?php bloginfo('rss2_url');?>'"><?php echo esc_attr(__('RSS Feed','iLost'));?></a></span>
    <?php printf(themename.' theme '.__(' &brvbar; ','iLost').'Designed by <a href="'.esc_attr('http://xuui.net/').'">Xu.hel</a> in ChengDu.');?>
    </p>
		<p><?php printf('<span class="alignright">Powered by <a href="http://wordpress.org/">WordPress</a></span>');?>
		<?php printf(__('Copyright &copy;2011 ','iLost'));?><a href="<?php echo home_url('/');?>" title="<?php echo esc_attr(get_bloginfo('name','display'));?>" rel="home"><?php bloginfo('name');?></a></p>
	</div>
	<!--<?php echo get_num_queries();?> queries. <?php timer_stop(1);?> seconds. --> 
</footer>
<?php wp_footer();?>
</body>
</html>