<?php //Themes Widgets.
class ilost_catlistsWidget extends WP_Widget{
  function __construct(){
    parent::__construct('ilost_catlistsWidget',__('iLost Category list','iLost'),
    array('description'=>__('Show classified articles','iLost')));
  }
  public function widget($args,$instance){
    //if (!empty($instance['title'])){
    //  echo $args['before_title'].apply_filters('widget_title',$instance['title']).$args['after_title'];
    //}
    //echo '<pre>';print_r($instance);echo'</pre>';
    echo $args['before_widget'];
    if(!$catid=(int)$instance['catid']){$catid=1;}
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    ilost_get_catlist($catid,$number);
    echo $args['after_widget'];
  }
  public function form($instance){
    /*
    $title =!empty($instance['title'])? $instance['title']:'';
    ?>
    <p>
    <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>">
    </p>
    */
    $catid=!empty($instance['catid'])? $instance['catid']:'0';
    $number=!empty($instance['number'])? $instance['number']:'';?>
    <p><label for="<?php echo $this->get_field_id('catid');?>"><?php _e('Categories');?> :</label>
    <?php wp_dropdown_categories(array('name'=>$this->get_field_name('catid'),'id'=>$this->get_field_id('catid'),'class'=>'widefat','selected'=>$catid,'show_count'=>1));?></p>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Show post counts');?> :</label> 
    <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" placeholder="5" value="<?php echo esc_attr($number);?>"></p>
    <?php 
  }
  public function update($new_instance,$old_instance){
    //$instance=array();
    //$instance['title']=(!empty($new_instance['title']))? strip_tags($new_instance['title']):'';
    $instance=array();
    $instance['catid']=(!empty($new_instance['catid']))? strip_tags($new_instance['catid']):0;
    $instance['number']=(!empty($new_instance['number']))? strip_tags($new_instance['number']):'';
    return $instance;
  }
}
class ilost_footlistsWidget extends WP_Widget{
  function __construct(){
    parent::__construct('ilost_catlistsWidget',__('iLost Category list','iLost'),
    array('description'=>__('Show classified articles','iLost')));
  }
  public function widget($args,$instance){
    echo $args['before_widget'];
    if(!$catid=(int)$instance['catid']){$catid=1;}
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    ilost_get_footerlist($catid,$number);
    echo $args['after_widget'];
  }
  public function form($instance){
    $catid=!empty($instance['catid'])? $instance['catid']:'0';
    $number=!empty($instance['number'])? $instance['number']:'';?>
    <p><label for="<?php echo $this->get_field_id('catid');?>"><?php _e('Categories');?> :</label>
    <?php wp_dropdown_categories(array('name'=>$this->get_field_name('catid'),'id'=>$this->get_field_id('catid'),'class'=>'widefat','selected'=>$catid,'show_count'=>1));?></p>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Show post counts');?> :</label> 
    <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" placeholder="5" value="<?php echo esc_attr($number);?>"></p>
    <?php 
  }
  public function update($new_instance,$old_instance){
    $instance=array();
    $instance['catid']=(!empty($new_instance['catid']))? strip_tags($new_instance['catid']):0;
    $instance['number']=(!empty($new_instance['number']))? strip_tags($new_instance['number']):'';
    return $instance;
  }
}
class ilost_randompostWidget extends WP_Widget{
  function __construct(){
    parent::__construct('ilost_randompostWidget',__('iLost Random Posts','iLost'),array('description'=>__('Display random sequence articles','iLost')));
  }
  public function widget($args,$instance){
    echo $args['before_widget'];
    if(!empty($instance['title'])){
      echo $args['before_title'].apply_filters('widget_title',$instance['title']).$args['after_title'];
    }else{
      echo $args['before_title'].apply_filters('widget_title',__('Random Articles','iLost')).$args['after_title'];
    }
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo '<ul class="random">'."\n";
    ilost_randompost($limit=$number);
    echo '</ul>'."\n";
    echo $args['after_widget'];
  }
  public function form($instance){
    $title=!empty($instance['title'])? $instance['title']:'';
    $number=!empty($instance['number'])? $instance['number']:'';?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" placeholder="<?php _e('Random Articles','iLost');?>" value="<?php echo esc_attr($title);?>"></p>
    <p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Show post counts');?> :</label> 
    <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" placeholder="5" value="<?php echo esc_attr($number);?>"></p>
    <?php 
  }
  public function update($new_instance,$old_instance){
    $instance=array();
    $instance['title']=(!empty($new_instance['title']))? strip_tags($new_instance['title']):'';
    $instance['number']=(!empty($new_instance['number']))? strip_tags($new_instance['number']):'';
    return $instance;
  }
}
class ilost_RCommentsWidget extends WP_Widget{
  function __construct(){
    parent::__construct('ilost_RCommentsWidget',__('iLost Recent Comments','iLost'),array('description'=>__('The most recent comments','iLost')));
  }
  public function widget($args,$instance){
    echo $args['before_widget'];
    if(!empty($instance['title'])){
      echo $args['before_title'].apply_filters('widget_title',$instance['title']).$args['after_title'];
    }else{
      echo $args['before_title'].apply_filters('widget_title',__('Recent Comments','iLost')).$args['after_title'];
    }
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo '<ul class="comment">'."\n";
    ilost_rcomments($limit=$number);
    echo '</ul>'."\n";
    echo $args['after_widget'];
  }
  public function form($instance){
    $title=!empty($instance['title'])? $instance['title']:'';
    $number=!empty($instance['number'])? $instance['number']:'';?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" placeholder="<?php _e('Recent Comments','iLost');?>" value="<?php echo esc_attr($title);?>"></p>
    <p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Show post counts');?> :</label> 
    <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" placeholder="5" value="<?php echo esc_attr($number);?>"></p>
    <?php 
  }
  public function update($new_instance,$old_instance){
    $instance=array();
    $instance['title']=(!empty($new_instance['title']))? strip_tags($new_instance['title']):'';
    $instance['number']=(!empty($new_instance['number']))? strip_tags($new_instance['number']):'';
    return $instance;
  }
}
class ilost_RavatarWidget extends WP_Widget{
  function __construct(){
    parent::__construct('ilost_RavatarWidget',__('iLost Recent Avatar','iLost'),array('description'=>__('The most recent avatars','iLost')));
  }
  public function widget($args,$instance){
    echo $args['before_widget'];
    if(!empty($instance['title'])){
      echo $args['before_title'].apply_filters('widget_title',$instance['title']).$args['after_title'];
    }else{
      echo $args['before_title'].apply_filters('widget_title',__('Recent Avatar','iLost')).$args['after_title'];
    }
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo '<div class="reavatar">'."\n";
    ilost_ravatar($limit=$number);
    echo '</div>'."\n";
    echo $args['after_widget'];
  }
  public function form($instance){
    $title=!empty($instance['title'])? $instance['title']:'';
    $number=!empty($instance['number'])? $instance['number']:'';?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" placeholder="<?php _e('Recent Avatar','iLost');?>" value="<?php echo esc_attr($title);?>"></p>
    <p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Show post counts');?> :</label> 
    <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" placeholder="5" value="<?php echo esc_attr($number);?>"></p>
    <?php 
  }
  public function update($new_instance,$old_instance){
    $instance=array();
    $instance['title']=(!empty($new_instance['title']))? strip_tags($new_instance['title']):'';
    $instance['number']=(!empty($new_instance['number']))? strip_tags($new_instance['number']):'';
    return $instance;
  }
}
class ilost_viewsWidget extends WP_Widget{
  function __construct(){
    parent::__construct('ilost_viewsWidget',__('iLost Most Popular Articles','iLost'),array('description'=>__('Most Popular Articles','iLost')));
  }
  public function widget($args,$instance){
    echo $args['before_widget'];
    if(!empty($instance['title'])){
      echo $args['before_title'].apply_filters('widget_title',$instance['title']).$args['after_title'];
    }else{
      echo $args['before_title'].apply_filters('widget_title',__('Most Popular Articles','iLost')).$args['after_title'];
    }
    if(!$number=(int)$instance['number']){$number=5;}elseif($number<1){$number=1;}
    echo '<ul class="random">'."\n";
    get_most_viewed('post',$number,0,true,true);
    echo '</ul>'."\n";
    echo $args['after_widget'];
  }
  public function form($instance){
    $title=!empty($instance['title'])? $instance['title']:'';
    $number=!empty($instance['number'])? $instance['number']:'';?>
    <p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" placeholder="<?php _e('Most Popular Articles','iLost');?>" value="<?php echo esc_attr($title);?>"></p>
    <p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Show post counts');?> :</label> 
    <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" placeholder="5" value="<?php echo esc_attr($number);?>"></p>
    <?php 
  }
  public function update($new_instance,$old_instance){
    $instance=array();
    $instance['title']=(!empty($new_instance['title']))? strip_tags($new_instance['title']):'';
    $instance['number']=(!empty($new_instance['number']))? strip_tags($new_instance['number']):'';
    return $instance;
  }
}
?>