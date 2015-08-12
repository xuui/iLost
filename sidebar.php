<aside>
  <ul id="side" class="clear">
  <?php if(!dynamic_sidebar('ilost-sidebar')){
		wp_list_categories('show_count=0&title_li=<h3>'.__('Categories','iLost').'</h3>');
		if(is_home()&&function_exists('get_most_viewed')){?>
    <li>
      <h3><?php _e('Most Popular Articles','iLost');?></h3>
      <ul><?php get_most_viewed('post',5,0,true,true);?></ul>
    </li>
    <?php }?>
    <li>
      <h3><?php _e('Recent Comments','iLost');?></h3>
      <ul class="comment"><?php ilost_rcomments($limit=6);?></ul>
    </li>
    <li>
      <h3><?php _e('Meta','iLost');?></h3>
      <ul>
        <?php wp_register();?>
        <li><?php wp_loginout();?></li>
        <li><a href="<?php esc_attr('http://validator.w3.org/check/referer');?>" title="This page validates as HTML 5">Valid <abbr title="eXtensible HyperText Markup Language">HTML5</abbr></a></li>
        <?php wp_meta();?>
      </ul>
    </li>
  <?php }?>
  </ul>
</aside>