<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=yes,shrink-to-fit=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<title>
<?php if(is_single()){
  single_post_title();ilost_page_number();
}elseif(is_front_page()){
  echo ilost_wp_name;ilost_page_number();
}elseif(is_page()||is_home()){
  wp_title('- '.ilost_wp_name,true,'right');ilost_page_number();
}elseif(is_search()){
  printf(__('Search results for %s','iLost'),esc_html($s));ilost_page_number();
}elseif(is_404()){
  echo __('Not Found','iLost');
}else{
  echo wp_title('',false,'right').' - '.ilost_wp_name.ilost_page_number(false);
}?>
</title>
<?php if(is_single()){
  $keywords=ilost_searchKey().', ';
  $tags=wp_get_post_tags($post->ID);
  foreach($tags as $tag){$keywords==$post->post_title.', '.$keywords.$tag->name.', ';}
  if($post->post_excerpt){
    $description=$post->post_title.' '.$post->post_excerpt;
  }else{
    $description=$post->post_title.' '.ilost_substr(strip_tags($post->post_content),0,120);
  }
  $description=str_replace("\n",' ',$description);
}elseif(is_page()){
  $keywords=ilost_wp_name.', '.ilost_searchKey().wp_title(',',false);
  $keywords=str_replace(' ,',',',$keywords);
  if(!is_front_page()){
    if($post->post_excerpt){
      $description=$post->post_excerpt;
    }else{
      $description=ilost_substr(strip_tags($post->post_content),0,220);
    }
    $description=str_replace("\n",' ',$description);
  }else{
    if(ilost_seDescription()){
      $description=ilost_seDescription();
    }else{$description=ilost_wp_description;}
  }
}elseif(is_category()||is_tag()){
  $keywords=ilost_wp_name.', '.ilost_searchKey().wp_title(',',false);
  $keywords=str_replace(' ,',',',$keywords);
  if(ilost_seDescription()){
    $description=ilost_seDescription();
  }else{
    $description=ilost_wp_description;
  }
}else{
  $keywords=ilost_wp_name.', '.ilost_searchKey();
  if(ilost_seDescription()){
    $description=ilost_seDescription();
  }else{$description=ilost_wp_description;}
}?>
<meta name="keywords" content="<?php echo $keywords;?>">
<meta name="description" content="<?php echo $description?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="theme author" href="Xu.hel,xw@xuui.net">
<?php ilost_getfavicon();ilost_getstyles();?>
<link rel="pingback" href="<?php echo ilost_wp_pingback_url;?>">
<?php ilost_customRssurl();?>
<?php wp_head();?>
</head>
<body <?php body_class();?>>
<header class="navbar navbar-default<?php if(is_front_page()){echo ' navbar-fixed-top';}?>" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ilost-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ilost-collapse">&equiv;</button-->
      <?php ilost_getlogoimg();?>
    </div>
    <?php /*
    <form role="search" method="get" class="navbar-form navbar-right navbar-search search-form" action="<?php echo home_url('/');?>">
      <div class="form-group">
      <!--label>
      <span class="screen-reader-text"><?php echo _x('Search for:','label');?></span-->
      <input type="search" class="form-control search-field" placeholder="<?php echo esc_attr_x('Search …','placeholder');?>" value="<?php echo get_search_query();?>" name="s" title="<?php echo esc_attr_x('Search for:','label');?>" />
      </label>
      <!--input type="submit" class="search-submit"
    value="<?php echo esc_attr_x('Search','submit button');?>" /-->
      </div>
    </form>
    */?>
    <div class="navbar-collapse collapse" id="ilost-collapse">
      <?php wp_nav_menu(array('theme_location'=>'primary','container'=>'ul','container_id'=>'navs','menu_class'=>'nav navbar-nav navbar-right','walker'=>new ilost_strapnav()));?>
    </div>
  </div>
</header>
<?php //if(is_front_page()){ilost_getiloshow();}?>
