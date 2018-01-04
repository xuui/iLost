<?php // Core Class.
// bootstrap navbar.
//class ilost_strapnav extends Walker_Nav_Menu{}
if(!class_exists('ilost_strapnav')){
class ilost_strapnav extends Walker_Nav_Menu{
  public function start_lvl(&$output,$depth=0,$args=array()){
    $indent=str_repeat("\t",$depth);
    $output.="\n$indent<ul role=\"menu\" class=\"dropdown-menu\">\n";
  }
  public function start_el(&$output,$item,$depth=0,$args=array(),$id=0){
    $indent=($depth)? str_repeat("\t",$depth): '';
    if(0===strcasecmp($item->attr_title,'divider')&& 1===$depth){
      $output.=$indent.'<li role="presentation" class="divider">';
    }elseif(0===strcasecmp($item->title,'divider')&& 1===$depth){
      $output.=$indent.'<li role="presentation" class="divider">';
    }elseif(0===strcasecmp($item->attr_title,'dropdown-header')&& 1===$depth){
      $output.=$indent.'<li role="presentation" class="dropdown-header">'.esc_attr($item->title);
    }elseif(0===strcasecmp($item->attr_title,'disabled')){
      $output.=$indent.'<li role="presentation" class="disabled"><a href="#">'.esc_attr($item->title).'</a>';
    }else{
      $value='';
      $class_names=$value;
      $classes=empty($item->classes)? array():(array)$item->classes;
      $classes[]='menu-item-'.$item->ID;
      $class_names=join(' ',apply_filters('nav_menu_css_class',array_filter($classes),$item,$args));
      if($args->has_children){
        $class_names.=' dropdown';
      }
      if(in_array('current-menu-item',$classes,true)){
        $class_names.=' active';
      }
      $class_names=$class_names ? ' class="'.esc_attr($class_names).'"' : '';
      $id=apply_filters('nav_menu_item_id','menu-item-'.$item->ID,$item,$args);
      $id=$id ? ' id="'.esc_attr($id).'"' : '';
      $output.=$indent.'<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"'.$id.$value.$class_names.'>';
      $atts=array();

      if(empty($item->attr_title)){
        $atts['title']=!empty($item->title)? strip_tags($item->title): '';
      }else{
        $atts['title']=$item->attr_title;
      }

      $atts['target']=!empty($item->target)? $item->target : '';
      $atts['rel']=!empty($item->xfn)? $item->xfn    : '';
      if($args->has_children && 0===$depth){
        $atts['href']='#';
        $atts['data-toggle']='dropdown';
        $atts['class']='dropdown-toggle';
        $atts['aria-haspopup']='true';
      }else{
        $atts['href']=!empty($item->url)? $item->url : '';
      }
      $atts=apply_filters('nav_menu_link_attributes',$atts,$item,$args);
      $attributes='';
      foreach($atts as $attr=> $value){
        if(!empty($value)){
          $value=('href'===$attr)? esc_url($value): esc_attr($value);
          $attributes.=' '.$attr.'="'.$value.'"';
        }
      }
      $item_output=$args->before;
      if(!empty($item->attr_title)){
        $pos=strpos(esc_attr($item->attr_title),'glyphicon');
        if(false !==$pos){
          $item_output.='<a'.$attributes.'><span class="glyphicon '.esc_attr($item->attr_title).'" aria-hidden="true"></span>&nbsp;';
        }else{
          $item_output.='<a'.$attributes.'><i class="fa '.esc_attr($item->attr_title).'" aria-hidden="true"></i>&nbsp;';
        }
      }else{
        $item_output.='<a'.$attributes.'>';
      }
      $item_output.=$args->link_before.apply_filters('the_title',$item->title,$item->ID).$args->link_after;
      $item_output.=($args->has_children && 0===$depth)? ' <span class="caret"></span></a>' : '</a>';
      $item_output.=$args->after;
      $output.=apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);
    }// End if().
  }
  public function display_element($element,&$children_elements,$max_depth,$depth,$args,&$output){
    if(!$element){
      return;}
    $id_field=$this->db_fields['id'];
    // Display this element.
    if(is_object($args[0])){
      $args[0]->has_children=!empty($children_elements[$element->$id_field]);}
    parent::display_element($element,$children_elements,$max_depth,$depth,$args,$output);
  }
  public static function fallback($args){
    if(current_user_can('edit_theme_options')){
      $container=$args['container'];
      $container_id=$args['container_id'];
      $container_class=$args['container_class'];
      $menu_class=$args['menu_class'];
      $menu_id=$args['menu_id'];

      if($container){
        echo '<'.esc_attr($container);
        if($container_id){
          echo ' id="'.esc_attr($container_id).'"';
        }
        if($container_class){
          echo ' class="'.sanitize_html_class($container_class).'"';}
        echo '>';
      }
      echo '<ul';
      if($menu_id){
        echo ' id="'.esc_attr($menu_id).'"';}
      if($menu_class){
        echo ' class="'.esc_attr($menu_class).'"';}
      echo '>';
      echo '<li><a href="'.esc_url(admin_url('nav-menus.php')).'" title="">'.esc_attr('Add a menu','').'</a></li>';
      echo '</ul>';
      if($container){
        echo '</'.esc_attr($container).'>';}
    }
  }
}
}// End if().



/**/
// bootstrap breadcrumb.
/*
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
    $chain='';$parent=@get_category($id);if(is_wp_error($parent)){return $parent;}if($nicename){$name=$parent->slug;}else{$name=$parent->cat_name;}if($parent->parent &&($parent->parent !=$parent->term_id)){$chain.=get_category_parents($parent->parent,true,$separator,$nicename);}$chain.=ilost_bold_or_not($name);return $chain;
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
      if(is_object($cat)){if($cat->parent !=0){
        $output.=get_category_parents($cat->term_id,true,'');
      }else{
        $output.='<li><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></li>';
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
    $output.=$taxonomy->label.':'.ilost_bold_or_not($term);
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
*/
function cmp_breadcrumbs(){
  $delimiter='»'; // 分隔符
  $before='<span class="current">'; // 在当前链接前插入
  $after='</span>'; // 在当前链接后插入
  if(!is_home() && !is_front_page() || is_paged()){
    echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs">'.__('You are here:','cmp');
    global $post;
    $homeLink=home_url();
    echo ' <a itemprop="breadcrumb" href="'.$homeLink.'">'.__('Home','cmp').'</a> '.$delimiter.' ';
    if(is_category()){ // 分类 存档
      global $wp_query;
      $cat_obj=$wp_query->get_queried_object();
      $thisCat=$cat_obj->term_id;
      $thisCat=get_category($thisCat);
      $parentCat=get_category($thisCat->parent);
      if($thisCat->parent !=0){
        $cat_code=get_category_parents($parentCat,TRUE,' '.$delimiter.' ');
        echo $cat_code=str_replace('<a','<a itemprop="breadcrumb"',$cat_code);
      }
      echo $before.''.single_cat_title('',false).''.$after;
    }elseif(is_day()){ // 天 存档
      echo '<a itemprop="breadcrumb" href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.' ';
      echo '<a itemprop="breadcrumb"  href="'.get_month_link(get_the_time('Y'),get_the_time('m')).'">'.get_the_time('F').'</a> '.$delimiter.' ';
      echo $before.get_the_time('d').$after;
    }elseif(is_month()){ // 月 存档
      echo '<a itemprop="breadcrumb" href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.' ';
      echo $before.get_the_time('F').$after;
    }elseif(is_year()){ // 年 存档
      echo $before.get_the_time('Y').$after;
    }elseif(is_single() && !is_attachment()){ // 文章
      if(get_post_type() !='post'){ // 自定义文章类型
        $post_type=get_post_type_object(get_post_type());
        $slug=$post_type->rewrite;
        echo '<a itemprop="breadcrumb" href="'.$homeLink.'/'.$slug['slug'].'/">'.$post_type->labels->singular_name.'</a> '.$delimiter.' ';
        echo $before.get_the_title().$after;
      }else{ // 文章 post
        $cat=get_the_category(); $cat=$cat[0];
        $cat_code=get_category_parents($cat,TRUE,' '.$delimiter.' ');
        echo $cat_code=str_replace('<a','<a itemprop="breadcrumb"',$cat_code);
        echo $before.get_the_title().$after;
      }
    }elseif(!is_single() && !is_page() && get_post_type() !='post'){
      $post_type=get_post_type_object(get_post_type());
      echo $before.$post_type->labels->singular_name.$after;
    }elseif(is_attachment()){ // 附件
      $parent=get_post($post->post_parent);
      $cat=get_the_category($parent->ID); $cat=$cat[0];
      echo '<a itemprop="breadcrumb" href="'.get_permalink($parent).'">'.$parent->post_title.'</a> '.$delimiter.' ';
      echo $before.get_the_title().$after;
    }elseif(is_page() && !$post->post_parent){ // 页面
      echo $before.get_the_title().$after;
    }elseif(is_page() && $post->post_parent){ // 父级页面
      $parent_id=$post->post_parent;
      $breadcrumbs=array();
      while($parent_id){
        $page=get_page($parent_id);
        $breadcrumbs[]='<a itemprop="breadcrumb" href="'.get_permalink($page->ID).'">'.get_the_title($page->ID).'</a>';
        $parent_id=$page->post_parent;
      }
      $breadcrumbs=array_reverse($breadcrumbs);
      foreach($breadcrumbs as $crumb) echo $crumb.' '.$delimiter.' ';
      echo $before.get_the_title().$after;
    }elseif(is_search()){ // 搜索结果
      echo $before ;
      printf(__('Search Results for: %s','cmp'),get_search_query());
      echo  $after;
    }elseif(is_tag()){ //标签 存档
      echo $before ;
      printf(__('Tag Archives: %s','cmp'),single_tag_title('',false));
      echo  $after;
    }elseif(is_author()){ // 作者存档
      global $author;
      $userdata=get_userdata($author);
      echo $before ;
      printf(__('Author Archives: %s','cmp'),$userdata->display_name);
      echo  $after;
    }elseif(is_404()){ // 404 页面
      echo $before;
      _e('Not Found','cmp');
      echo  $after;
    }
    if(get_query_var('paged')){ // 分页
      if(is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
        echo sprintf(__('(Page %s)','cmp'),get_query_var('paged'));
    }
    echo '</div>';
  }
}

function ilost_breadcrumb(){
  global $post;
  foreach((get_the_category())as $category){
    $catName=$category->cat_name;
    $catUrl=$category->slug;
  }
  $bccStart='<li><a href="'.ilost_wp_homeurl.'"><i class="fa fa-home"></i> '.ilost_wp_name.'</a></li>';
  echo '<ol class="breadcrumb">'.$bccStart;
  if(is_page()&& $post->post_parent){
    $home=get_page(get_option('page_on_front'));
    for($i=count($post->ancestors)-1;$i>=0;$i--){
      if(($home->ID)!=($post->ancestors[$i])){
        echo '<li><a href="'.get_permalink($post->ancestors[$i]).'">'.get_the_title($post->ancestors[$i])."</a></li>";
      }
    }
    echo '<li class="active">'.get_the_title().'</li>';
  }elseif(is_page()){
    echo '<li class="active">'.get_the_title().'</li>';
  }elseif(is_single()){
    echo '<li><a href="'.$catUrl.'">'.$catName.'</a></li>';
    echo '<li class="active">'.get_the_title().'</li>';
  }elseif(is_category()){
    echo '<li><a href="">'.__('Category').'</a></li>';
    echo '<li class="active">'.wp_title('',false,'right').'</li>';
  }else{
    echo '<li class="active">'.wp_title('',false,'right').'</li>';
  }
  echo '</ol>';
}
?>