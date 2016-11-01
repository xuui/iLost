<?php // Core Class.
// bootstrap navbar.
class ilost_strapnav extends Walker_Nav_Menu{
  public function start_lvl(&$output,$depth=0,$args=array()){
    $indent=str_repeat("\t",$depth);
    $output.="\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
  }
  public function start_el(&$output,$item,$depth=0,$args=array(),$id=0){
    $indent=($depth)? str_repeat("\t",$depth):'';
    if(strcasecmp($item->attr_title,'divider')==0 && $depth===1){
      $output.=$indent.'<li role="presentation" class="divider">';
    }else if(strcasecmp($item->title,'divider')==0 && $depth===1){
      $output.=$indent.'<li role="presentation" class="divider">';
    }else if(strcasecmp($item->attr_title,'dropdown-header')==0 && $depth===1){
      $output.=$indent.'<li role="presentation" class="dropdown-header">'.esc_attr($item->title);
    }else if(strcasecmp($item->attr_title,'disabled')==0){
      $output.=$indent.'<li role="presentation" class="disabled"><a href="#">'.esc_attr($item->title).'</a>';
    }else{
      $class_names=$value='';
      $classes=empty($item->classes)? array():(array)$item->classes;
      $classes[]='menu-item-'.$item->ID;
      $class_names=join(' ',apply_filters('nav_menu_css_class',array_filter($classes),$item,$args));
      if($args->has_children)$class_names.=' dropdown';
      if(in_array('current-menu-item',$classes))$class_names.=' active';
      $class_names=$class_names ? ' class="'.esc_attr($class_names).'"':'';
      $id=apply_filters('nav_menu_item_id','menu-item-'.$item->ID,$item,$args);
      $id=$id ? ' id="'.esc_attr($id).'"':'';
      $output.=$indent.'<li'.$id.$value.$class_names .'>';
      $atts=array();
      $atts['title']=! empty($item->title)?$item->title:'';
      $atts['target']=! empty($item->target)?$item->target:'';
      $atts['rel']=! empty($item->xfn)? $item->xfn:'';
      if($args->has_children && $depth===0){
        $atts['href']='#';
        $atts['data-toggle']='dropdown';
        $atts['class']='dropdown-toggle';
        $atts['aria-haspopup']='true';
      }else{
        $atts['href']=! empty($item->url)? $item->url:'';
      }
      $atts=apply_filters('nav_menu_link_attributes',$atts,$item,$args);
      $attributes='';
      foreach($atts as $attr=> $value){
        if(! empty($value)){
          $value=('href'===$attr)? esc_url($value):esc_attr($value);
          $attributes.=' '.$attr.'="'.$value.'"';
        }
      }
      $item_output=$args->before;
      //if(! empty($item->attr_title)){
      //  $item_output.='<a'.$attributes.'><span class="fa '.esc_attr($item->attr_title).'"></span>';
      //}else{
        $item_output.='<a'.$attributes.'>';
      //}
      $item_output.=$args->link_before.apply_filters('the_title',$item->title,$item->ID).$args->link_after;
      $item_output.=($args->has_children && 0===$depth)? ' <span class="caret"></span></a>':'</a>';
      $item_output.=$args->after;
      $output.=apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);
    }
  }
  public function display_element($element,&$children_elements,$max_depth,$depth,$args,&$output){
    if(!$element)return;
    $id_field=$this->db_fields['id'];
    if(is_object($args[0]))$args[0]->has_children=!empty($children_elements[ $element->$id_field ]);
    parent::display_element($element,$children_elements,$max_depth,$depth,$args,$output);
  }
  public static function fallback($args){
    if(current_user_can('manage_options')){
      extract($args);
      $fb_output=null;
      if($container){
        $fb_output='<'.$container;
        if($container_id){$fb_output.=' id="'.$container_id.'"';}
        if($container_class){$fb_output.=' class="'.$container_class.'"';}
        $fb_output.='>';
      }
      $fb_output.='<ul';
      if($menu_id){$fb_output.=' id="'.$menu_id.'"';}
      if($menu_class){$fb_output.=' class="'.$menu_class.'"';}
      $fb_output.='>';
      $fb_output.='<li><a href="'.admin_url('nav-menus.php').'">Add a menu</a></li>';
      $fb_output.='</ul>';
      if($container)$fb_output.='</'.$container.'>';
      echo $fb_output;
    }
  }
}

/**/
// bootstrap breadcrumb.
function ilost_breadcrumb($prefix='<ol class="breadcrumb">',$suffix='</ol>'){
  $breadcrumb_opt=array();
  $breadcrumb_opt['home']=ilost_wp_name;
  $breadcrumb_opt['blog']="Blog";
  $breadcrumb_opt['prefix']="";
  $breadcrumb_opt['nofollowhome']=false;
  $breadcrumb_opt['singleparent']=0;
  $breadcrumb_opt['singlecatprefix']=true;
  $breadcrumb_opt['archiveprefix']="Archives for";
  $breadcrumb_opt['searchprefix']="Search for";
  global $wp_query,$post;
  function ilost_bold_or_not($input){
    if(is_category()|| is_tag()|| is_date()|| is_author()){return '<li class="active">'.$input.'</li>';}else{return '<li class="active">'.$input.'</li>';}
  }
  function ilost_get_category_parents($id,$link=FALSE,$separator='/',$nicename=FALSE){
    $chain='';$parent=@get_category($id);if(is_wp_error($parent)){return $parent;}if($nicename){$name=$parent->slug;}else{$name=$parent->cat_name;}if($parent->parent &&($parent->parent != $parent->term_id)){$chain.=get_category_parents($parent->parent,true,$separator,$nicename);}$chain.= ilost_bold_or_not($name);return $chain;
  }
  $nofollow=' ';
  if($breadcrumb_opt['nofollowhome']){$nofollow=' rel="nofollow" ';}
  $on_front=get_option('show_on_front');
  if($on_front=="page"){
    $homelink='<li><a'.$nofollow.'href="'.get_permalink(get_option('page_on_front')).'">'.$breadcrumb_opt['home'].'</a></li>';
    $bloglink=$homelink.' <li><a href="'.get_permalink(get_option('page_for_posts')).'">'.$breadcrumb_opt['blog'].'</a></li>';
  }else{
    $homelink='<li><a'.$nofollow.'href="'.ilost_wp_homeurl.'/'.'">'.$breadcrumb_opt['home'].'</a></li>';
    $bloglink=$homelink;
  }
  if(($on_front=="page" && is_front_page())||($on_front=="posts" && is_home())){
    $output=ilost_bold_or_not($breadcrumb_opt['home']);
  }elseif($on_front=="page" && is_home()){
    $output=$homelink.ilost_bold_or_not($breadcrumb_opt['blog']);
  }elseif(!is_page()){
    $output=$bloglink;
    if((is_single()|| is_category()|| is_tag()|| is_date()|| is_author())&& $breadcrumb_opt['singleparent']!=false){
      $output.='<li><a href="'.get_permalink($breadcrumb_opt['singleparent']).'">'.get_the_title($breadcrumb_opt['singleparent']).'</a></li>';
    }
    if(is_single()&& $breadcrumb_opt['singlecatprefix']){
      $cats=get_the_category();$cat=$cats[0];
      if(is_object($cat)){if($cat->parent != 0){
        $output.= get_category_parents($cat->term_id,true,'');
      }else{
        $output.= '<li><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></li>';
      }
    }
  }
  if(is_category()){
    $cat=intval(get_query_var('cat'));
    $output.=ilost_get_category_parents($cat,false,'');
  }elseif(is_tag()){
    $output.=ilost_bold_or_not($breadcrumb_opt['archiveprefix']." ".single_cat_title('',false));
  }elseif(is_date()){
    $output.=ilost_bold_or_not($breadcrumb_opt['archiveprefix']." ".single_month_title(' ',false));
  }elseif(is_author()){
    $user=get_userdatabylogin($wp_query->query_vars['author_name']);
    $output.=ilost_bold_or_not($breadcrumb_opt['archiveprefix']." ".$user->display_name);
  }elseif(is_search()){
    $output.=ilost_bold_or_not($breadcrumb_opt['searchprefix'].' "'.stripslashes(strip_tags(get_search_query())).'"');
  }else if(is_tax()){
    $taxonomy=get_taxonomy(get_query_var('taxonomy'));
    $term=get_query_var('term');
    $output.=$taxonomy->label .':'.ilost_bold_or_not($term );
  }else{
    $output.=ilost_bold_or_not(get_the_title());
  }
  }else{
    $post=$wp_query->get_queried_object();
    if(0==$post->post_parent){
      $output=$homelink.ilost_bold_or_not(get_the_title());
    }else{
      if(isset($post->ancestors)){
        if(is_array($post->ancestors)){
          $ancestors=array_values($post->ancestors);
        }else{
          $ancestors=array($post->ancestors);
        }
      }else{
        $ancestors=array($post->post_parent);
      }
      $ancestors=array_reverse($ancestors);
      $ancestors[]=$post->ID;
      $links=array();
      foreach($ancestors as $ancestor){
        $tmp=array();
        $tmp['title']=strip_tags(get_the_title($ancestor));
        $tmp['url']=get_permalink($ancestor);
        $tmp['cur']=false;
        if($ancestor==$post->ID){
          $tmp['cur']=true;
        }
        $links[]=$tmp;
      }
      $output=$homelink;
      foreach($links as $link){
        if(!$link['cur']){
          $output.='<li><a href="'.$link['url'].'">'.$link['title'].'</a></li>';
        }else{
          $output.=ilost_bold_or_not($link['title']);
        }
      }
    }
  }
  if($breadcrumb_opt['prefix']!=""){
    $output=$breadcrumb_opt['prefix']." ".$output;
  }
  echo $prefix.$output.$suffix;
}
?>