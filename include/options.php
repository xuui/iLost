<?php //Themes Options Page.

class ilostOption{
  public static function getOptions(){
    $options=get_option('ilostOptions');
    if(!is_array($options)){
      $options['usrlogoimg']=false;
      $options['logoimgurl']='';
      $options['usrfavicon']=false;
      $options['faviconurl']='';
      $options['sidefloat']='right';
      $options['customRssurl']='';
      $options['searchKey']='';
      $options['ctrlentry']=false;
      $options['ilshowNum']='4';
      $options['showAuthor']=true;
      $options['relatedpost']=true;
      $options['repostNum']='5';
      $options['repostShow']='post';
      $options['growlBox']=false;
      $options['jgrowltext']='';
      $options['jquerysrc']='wp_jquery';
      $options['custom_jquery']='';
      $options['googleanalytics']='';
      $options['sidebartopcode']='';
      $options['sidebarbottomcode']='';
      $options['postembcode']='';
      $options['postendcode']='';
      update_option('ilostOptions',$options);
    }return $options;
  }
  public static function resOptions(){delete_option('ilostOptions');}
  public static function addOptions(){
    if(isset($_POST['save_submit'])){
      $options=ilostOption::getOptions();
      if(isset($_GET['tab'])){$tab=$_GET['tab'];}else{$tab='general';}
      switch($tab){
        case 'general':
          if(@$_POST['usrlogoimg']){$options['usrlogoimg']=(bool)true;}else{$options['usrlogoimg']=(bool)false;}
          $options['logoimgurl']=stripslashes($_POST['logoimgurl']);
          if(@$_POST['usrfavicon']){$options['usrfavicon']=(bool)true;}else{$options['usrfavicon']=(bool)false;}
          $options['faviconurl']=stripslashes($_POST['faviconurl']);
          $options['sidefloat']=stripslashes($_POST['sidefloat']);
          $options['customRssurl']=stripslashes($_POST['customRssurl']);
          $options['searchKey']=stripslashes($_POST['searchKey']);
          if(@$_POST['ctrlentry']){$options['ctrlentry']=(bool)true;}else{$options['ctrlentry']=(bool)false;}
          if(!$_POST['ilshowNum']){$options['ilshowNum']=stripslashes(4);
          }elseif($_POST['ilshowNum']<1){$options['ilshowNum']=stripslashes(1);
          }else{$options['ilshowNum']=stripslashes($_POST['ilshowNum']);}
          if(@$_POST['relatedpost']){$options['relatedpost']=(bool)true;}else{$options['relatedpost']=(bool)false;}
          if(!$_POST['repostNum']){$options['repostNum']=stripslashes(5);
          }elseif($_POST['repostNum']<1){$options['repostNum']=stripslashes(1);
          }else{$options['repostNum']=stripslashes($_POST['repostNum']);}
          $options['repostShow']=stripslashes($_POST['repostShow']);
          if(@$_POST['showAuthor']){$options['showAuthor']=(bool)true;}else{$options['showAuthor']=(bool)false;}
          if(@$_POST['growlBox']){$options['growlBox']=(bool)true;}else{$options['growlBox']=(bool)false;}
          $options['jgrowltext']=stripslashes($_POST['jgrowltext']);
        break;case 'script':
          $options['jquerysrc']=stripslashes($_POST['jquerysrc']);
          $options['custom_jquery']=stripslashes($_POST['custom_jquery']);
          $options['googleanalytics']=stripslashes($_POST['googleanalytics']);
          $options['sidebartopcode']=stripslashes($_POST['sidebartopcode']);
          $options['sidebarbottomcode']=stripslashes($_POST['sidebarbottomcode']);
          $options['postembcode']=stripslashes($_POST['postembcode']);
          $options['postendcode']=stripslashes($_POST['postendcode']);
        break;
      }
      update_option('ilostOptions',$options);
      echo "<div id='message' class='updated fade'><p><strong>".__('Settings saved.')."</strong></p></div>";
    }else{ilostOption::getOptions();}
    if(isset($_REQUEST['restore-defaults'])){ilostOption::resOptions();echo "<div id='message' class='updated fade'><p><strong>".__('Settings have been restored to default.','iLost')."</strong></p></div>";}
    add_theme_page(themename.__(' Options','iLost'),themename.__(' Options','iLost'),'edit_theme_options','ilost_options',array('ilostOption','OptionsPage'));
  }
  public static function option_tabs($current='general'){
    $tabs=array('general'=>themename.__(' Options','iLost'),'script'=>__('Script Code','iLost'));
    $links=array();
    echo '<h2 class="nav-tab-wrapper">';
    foreach($tabs as $tab=>$name){
      $class=($tab==$current)?' nav-tab-active':'';
      echo "<a class='nav-tab".$class."' href='?page=ilost_options&tab=$tab'>$name</a>\n";
    }
    echo '</h2>';
  }
  public static function OptionsPage(){$options=ilostOption::getOptions();?>
<style type="text/css">
#options_form{margin:0 10px;}
.themeinfo{margin:14px 10px;}
fieldset{border:1px solid #d0dfe9;border-radius:5px;margin:5px 0 10px;padding:15px 10px 5px;}
fieldset legend{padding:0 5px;font-size:1.2em;font-weight:bold;}
fieldset .line{border-bottom:1px solid #e5e5e5;padding-bottom:15px;}
#icon-themes{background-position:-492px -5px;}
p.description,span.description{vertical-align:middle;}
.nav-tab{border-radius:5px 5px 0 0;}
#ilosttabpage .pagehide{display:none;}
#ilosttabpage p{clear:both;margin:0 6px;padding:8px 0;}
#ilosttabpage label{padding:0 0 0 5px;vertical-align:middle;}
#ilosttabpage label.th{display:inline-block;padding:0;width:200px;_zoom:1;}
#ilosttabpage input{vertical-align:middle;}
#ilosttabpage textarea{vertical-align:top;}
#ilosttabpage .radio{margin-left:15px;}
#restore-defaults{margin-left:10px;}
.supoption{display:inline-block;margin:5px 0 5px 200px;line-height:1.8;}
.retuvalue{margin-left:1em;}
</style>
<div class="wrap">
  <div id="icon-themes" class="icon32"></div>
<?php if(isset($_GET['tab'])){ilostOption::option_tabs($_GET['tab']);}else{ilostOption::option_tabs('general');}
  if(isset($_GET['tab'])){$tab=$_GET['tab'];}else{$tab='general';}?>
  <p class="themeinfo"><?php _e('Thank you for purchasing this theme, designed by the Xu.hel.','iLost');?></p>
  <div id="ilosttabpage">
    <form name="options_form" id="options_form" class="neo_fold" action="<?php admin_url('themes.php?page=ilost_options');?>" method="post" enctype="multipart/form-data">
<?php switch($tab){case 'general':?>
      <fieldset>
        <legend><?php _e('General Options','iLost');?></legend>
        <p><label class="th" for="usrlogoimg"><?php _e('Custom Logo picture','iLost');?></label><input name="usrlogoimg" id="usrlogoimg" type="checkbox" <?php if($options['usrlogoimg']){echo 'checked="checked"';}?>><br>
          <span class="supoption">
            <input name="logoimgurl" id="logoimgurl" type="text" size="40" value="<?php echo($options['logoimgurl']);?>" placeholder="http://www.com/logo.png">
            <span class="description"><?php _e('Please enter the URL address of the Logo picture.','iLost');?></span>
          </span>
        </p>
        <p><label class="th" for="usrlogoimg"><?php _e('Custom Favicon','iLost');?></label><input name="usrfavicon" id="usrfavicon" type="checkbox" <?php if($options['usrfavicon']){echo 'checked="checked"';}?>><br>
          <span class="supoption">
            <input name="faviconurl" id="faviconurl" type="text" size="40" value="<?php echo($options['faviconurl']);?>" placeholder="http://www.com/favicon.ico">
            <span class="description"><?php _e('Please enter the URL address of the Favicon icon.','iLost');?></span>
          </span>
        </p>
        <p><label class="th" for="sidefloat"><?php _e('Sidebar float:','iLost');?></label>
          <input type="radio" name="sidefloat" id="sidefloatleft"<?php if($options['sidefloat']=='left'){echo 'checked="checked"';}?> value="left" /><label for="sidefloatleft"><?php _e('Left','iLost');?></label>
          <input type="radio" name="sidefloat" class="radio" id="sidefloatright"<?php if($options['sidefloat']=='right'){echo 'checked="checked"';}?> value="right" /><label for="sidefloatright"><?php _e('Right','iLost');?></label>
        </p> 
        <p><label class="th" for="customRssurl"><?php _e('Custom RSS Subscription','iLost');?></label><input name="customRssurl" id="customRssurl" class="regular-text" type="text" size="40" value="<?php echo($options['customRssurl']);?>" placeholder="http://">
          <span class="description"><?php _e('Is empty, use the default automatic WordPress address. ','iLost');?></span>
        </p>
        <p><label class="th" for="searchKey"><?php _e('Search engine keywords','iLost');?></label><input name="searchKey" id="searchKey" class="regular-text" type="text" size="40" value="<?php echo($options['searchKey']);?>" placeholder="Key1, Key2, Key3...">
          <span class="description"><?php _e('Keywords using a comma (",") between them. Is empty, the automatic acquisition.','iLost');?></span>
        </p>
        <p><label class="th"  for="ctrlentry"><?php _e('Use Ctrl+Enter to reply comments','iLost');?></label><input name="ctrlentry" id="ctrlentry" type="checkbox" <?php if($options['ctrlentry']){echo 'checked="checked"';}?>>
        </p>
        <p><label class="th" for="ilshowNum"><?php _e('Focus image shows quantity','iLost');?></label><input name="ilshowNum" id="ilshowNum" type="text" size="2" value="<?php echo($options['ilshowNum']);?>" placeholder="4">
          <span class="description"><?php _e('The default show 4 images','iLost');?></span>
        </p>
        <p><label class="th" for="relatedpost"><?php _e('Related articles','iLost');?></label><input name="relatedpost" id="relatedpost" type="checkbox" <?php if($options['relatedpost']){echo 'checked="checked"';}?>><label><?php _e('Enabled','iLost')?></label><br>
          <span class="supoption">
		  	<label class="tip"><?php _e('Type:','iLost');?></label><input type="radio" name="repostShow"  id="post" <?php if($options['repostShow']=='post'){echo 'checked="checked"';}?> value="post" /><label for="post"><?php _e('Post lists','iLost');?></label><input type="radio" name="repostShow" class="radio" id="thumbnail" <?php if($options['repostShow']=='thumbnail'){echo 'checked="checked"';}?> value="thumbnail" /><label for="thumbnail"><?php _e('thumbnail','iLost');?></label><br>
          	<label class="tip"><?php _e('Number:','iLost');?></label><input name="repostNum" id="repostNum" type="text" size="2" value="<?php echo($options['repostNum']);?>" placeholder="5">
            <span class="description"><?php _e('The default display 5 articles ','iLost');?></span>
          </span>
        </p>
        <p><label class="th"><?php _e('Article footer display author information','iLost');?></label><input name="showAuthor" id="growlBox" type="checkbox" <?php if($options['showAuthor']){echo 'checked="checked"';}?>><label for="showAuthor"><?php _e('Enabled','iLost')?></label>
        </p>
        <p><label class="th"><?php _e('GrowlBox pop-up tips','iLost');?></label><input name="growlBox" id="growlBox" type="checkbox" <?php if($options['growlBox']){echo 'checked="checked"';}?>><label for="growlBox"><?php _e('Enabled','iLost')?></label><br>
          <span class="supoption">
            <input name="jgrowltext" id="jgrowltext" class="large-text" type="text" size="30" value="<?php echo($options['jgrowltext']);?>" placeholder="<?php _e('Text...##Title#Pop-up bubble title','iLost');?>"><br>
            <span class="description"><?php _e('Set GrowlBox tip box\'s contents. Use the # # Title# "separate content and title, can do not have a title. Is empty is not GrowlBox tip box popup.','iLost');?></span>
          </span>
        </p>
        <p><label class="th"><?php _e('.','iLost');?></label></p>
      </fieldset>
  <?php break;case 'script':?>
      <fieldset>
        <legend><?php _e('jQuery Library','iLost');?></legend>
        <p><label class="th"><?php _e('Source URL','iLost');?></label><label class="th"><input type="radio" name="jquerysrc" value="wp_jquery"<?php if($options['jquerysrc']=="wp_jquery")echo 'checked="checked"';?>/> <?php _e('WordPress Default','iLost');?></label><br>
          <span class="supoption">
          <label class="th"><input type="radio" name="jquerysrc" value="jqgzip_jquery"<?php if($options['jquerysrc']=="jqgzip_jquery")echo 'checked="checked"';?>/> <?php _e('jQurey.com','iLost');?></label><br>
          <label class="th" for="jquerysrc" style="width:auto;"><input type="radio" name="jquerysrc" value="custom_jquery"<?php if($options['jquerysrc']=="custom_jquery")echo 'checked="checked"';?>/> <?php _e('Custom URL: ','iLost');?><input name="custom_jquery" id="jgrowltext" class="large-text" style="display:inline-block;width:auto;" type="text" size="30" value="" placeholder="<?php _e('http:///','iLost');?>"></label>
          </span>
        </p>
      </fieldset>
      <fieldset>
        <legend><?php _e('Google Analytics statistics','iLost');?></legend>
        <p><label class="th" for="googleanalytics"><?php _e('Google Analytics statistics code','iLost');?></label>
          <textarea name="googleanalytics" id="googleanalytics" class="large-text" cols="50" rows="3" placeholder="<script>Google Analytics Code<script/>"><?php echo($options['googleanalytics']);?></textarea>
        </p>
      </fieldset>
      <fieldset>
        <legend><?php _e('AD Codes','iLost');?></legend>
        <p><label class="th" for="sidebartopcode"><?php _e('Side bar at the top advertising','iLost');?></label>
          <textarea name="sidebartopcode" id="sidebartopcode" class="large-text" cols="50" rows="3" placeholder="<script><script/>"><?php echo($options['sidebartopcode']);?></textarea>
        </p>
        <p><label class="th" for="sidebarbottomcode"><?php _e('Side bar at the bottom of the advertising','iLost');?></label>
          <textarea name="sidebarbottomcode" id="sidebarbottomcode" class="large-text" cols="50" rows="3" placeholder="<script><script/>"><?php echo($options['sidebarbottomcode']);?></textarea>
        </p>
        <p><label class="th" for="postembcode"><?php _e('The article embedded advertising','iLost');?></label>
          <textarea name="postembcode" id="postembcode" class="large-text" cols="50" rows="3" placeholder="<script><script/>"><?php echo($options['postembcode']);?></textarea>
        </p>
        <p><label class="th" for="postendcode"><?php _e('The article tail advertising','iLost');?></label>
          <textarea name="postendcode" id="postendcode" class="large-text" cols="50" rows="3" placeholder="<script><script/>"><?php echo($options['postendcode']);?></textarea>
        </p>
      </fieldset>
  <?php break;}?>
       <p class="submit"><input type="submit" name="save_submit" class="button-primary" value="<?php _e('Save Changes','iLost');?>" /><input name="restore-defaults" id="restore-defaults" onClick="return confirmDefaults();" value="<?php _e('Restore to defaults','iLost');?>" class="button-secondary" type="submit"></p>
    </form>
  </div>
</div>
  <?php }
}
/*
function ilost_themeopt_bar_render(){
  global $wp_admin_bar;
  $wp_admin_bar->add_menu(array('parent'=>false,'id'=>'iLostOptmul','title'=>themename.__(' Options','iLost'),'href'=>false));
  $wp_admin_bar->add_menu(array('parent'=>'iLostOptmul','id'=>'iLostOptmul_general','title'=>__('General Options','iLost'),'href'=>admin_url('themes.php?page=ilost_options'),'meta'=>false));
  $wp_admin_bar->add_menu(array('parent'=>'iLostOptmul','id'=>'iLostOptmul_script','title'=>__('Script Code','iLost'),'href'=>admin_url('themes.php?page=ilost_options&tab=script'),'meta'=>false));
  $wp_admin_bar->add_menu(array('parent'=>'iLostOptmul','id'=>'iLostOptmul_menus','title'=>__('Menus','iLost'),'href'=>admin_url('nav-menus.php'),'meta'=>array('class'=>'ilostAline')));
  $wp_admin_bar->add_menu(array('parent'=>'iLostOptmul','id'=>'iLostOptmul_background','title'=>__('Custom Background','iLost'),'href'=>admin_url('themes.php?page=custom-background'),'meta'=>false));
  $wp_admin_bar->add_menu(array('parent'=>'iLostOptmul','id'=>'iLostOptmul_editor','title'=>__('Edit Themes','iLost'),'href'=>admin_url('theme-editor.php'),'meta'=>false));
}
function ilost_themeopt_bar_css(){echo '<style type="text/css">#wpadminbar .ilostAline{border-top:1px solid #ccc;}</style>';}
add_action('admin_head','ilost_themeopt_bar_css');
*/
function ilost_getOption($option){
  $options=get_option('ilostOptions');
  if(($option=='logoimgurl')or($option=='faviconurl')or($option=='sidefloat')or($option=='customRssurl')or($option=='searchKey')or($option=='ilshowNum')or($option=='repostNum')or($option=='repostShow')or($option=='jgrowltext')or($option=='fan_token')or($option=='fan_token_secret')or($option=='jquerysrc')or($option=='custom_jquery')){
    return ent2ncr($options[$option]);
  }elseif(($option=='googleanalytics')or($option=='sidebartopcode')or($option=='sidebarbottomcode')or($option=='postembcode')or($option=='postendcode')){
    return stripslashes($options[$option]);
  }else{
    return esc_attr($options[$option]);
  }
}
function ilost_getlogoimg(){
  $usrlogoimg=ilost_getOption('usrlogoimg');$logoimgurl=ilost_getoption('logoimgurl');
  if($usrlogoimg){
    if(is_front_page()||is_home()){echo '<h1 class="nav-brand">';}?>
    <a class="navbar-brand" href="<?php echo ilost_wp_homeurl.'/';?>">
      <img class="logo" alt="<?php echo ilost_wp_name;?>" src="<?php if($logoimgurl){echo $logoimgurl;}echo ilost_path.'/images/logo.png';?>">
    </a>
    <?php if(is_front_page()||is_home()){echo '</h1>';}?>
    <span class="hidden navbar-text"><?php echo ilost_wp_description;?></span>
  <?php }else{
    if(is_front_page()||is_home()){echo '<h1 class="nav-brand">';}?>
    <a class="navbar-brand" href="<?php echo ilost_wp_homeurl.'/';?>"><?php echo ilost_wp_name;?></a>
    <?php if(is_front_page()||is_home()){echo '</h1>';}?>
    <p class="hidden navbar-text"><?php echo ilost_wp_description;?></p>
  <?php }
}
function ilost_getfavicon(){
  $usrfavicon=ilost_getOption('usrfavicon');$faviconurl=ilost_getoption('faviconurl');
  if($usrfavicon){if($faviconurl){echo '<link rel="Shortcut Icon" href="'.$faviconurl.'" type="image/x-icon" />'."\n";
  }else{echo '<link rel="Shortcut Icon" href="/favicon.ico" type="image/x-icon" />'."\n";}
  }
}
/*
function ilost_sidefloat(){
  $sidefloat=@ilost_getOption('sidefloat');
  if($sidefloat=='right'){$rightcss='<style type="text/css">#container{background-position:102.7% 0;}#container article{float:left}</style>';
  if((ilost_is_iphone())or(ilost_is_wphone())or(ilost_is_android())){$rightcss='<style type="text/css">#container{background-position:102.7% 0}</style>';}
  echo $rightcss;}
}
*/
function ilost_getsidefl(){
  $sideflt=@ilost_getOption('sidefloat');
  return $sideflt;
}
function ilost_customRssurl($echo=true){
  $customRssurl=ilost_getOption('customRssurl');
  if($echo){if($customRssurl){remove_theme_support('automatic-feed-links');echo '<link rel="alternate" type="application/rss+xml" title="'.esc_attr(ilost_wp_name).' &raquo; RSS Feed" href="'.$customRssurl.'" />'."\n";}
  }else{return $customRssurl;}
}
function ilost_searchKey(){
  $searchKey=ilost_getOption('searchKey');
  if($searchKey){return $searchKey;}
}

function ilost_search_form($form){
  $form='<form role="search" method="get" id="searchform" class="searchform" action="'.home_url('/').'">
  <div class="input-group">
    <input type="text" name="s" id="s" class="form-control" placeholder="'.esc_attr__('Search blog...').'" value="'.get_search_query().'">
    <span class="input-group-btn"><button type="submit" id="searchsubmit" class="btn btn-default">'.esc_attr__('Search').'</button></span>
  </div></form>';
  return $form;
}
function ilost_ctrlentry(){
  $ctrlentry=ilost_getOption('ctrlentry');
  return $ctrlentry;
}
function ilost_getfront(){
  $frontid=esc_attr(get_option('page_on_front'));
  return $frontid;
}
function ilost_getposts(){
  $postsid=esc_attr(get_option('page_for_posts'));
  return $postsid;
}
function ilost_ilshowNum(){
  $ilshowNum=ilost_getOption('ilshowNum');
  if(!$ilshowNum){$ilshowNum=4;}
  return $ilshowNum;
}
function ilost_relatedpost(){
  $relatedpost=ilost_getOption('relatedpost');
  return $relatedpost;
}
function ilost_repostNum(){
  $repostNum=ilost_getOption('repostNum');
  if(!$repostNum){$repostNum=5;}
  return $repostNum;
}
function ilost_repostShow(){
  $repostShow=ilost_getOption('repostShow');
  if(!$repostShow){$repostShow='post';}
  return $repostShow;
}
function ilost_showAuthor(){
  $showAuthor=ilost_getOption('showAuthor');
  return $showAuthor;
}
/*
function ilost_jgrowlbox(){
  $growlBox=ilost_getOption('growlBox');$jgrowltext=ilost_getOption('jgrowltext');
  if($growlBox && $jgrowltext){
  $jgrowlinfo=explode('##Title#',$jgrowltext);
  if(@$jgrowlinfo[1]){$jgrtitle=$jgrowlinfo[1];}else{$jgrtitle=esc_attr(ilost_wp_name);}
  echo "<script src=\"".ilost_path."/scripts/jgrowl.js\"></script><link rel=\"stylesheet\" href=\"".ilost_path."/scripts/jgrowl.css\" /><script type=\"text/javascript\">".'(function($){$=jQuery.noConflict();$(window).load(function(){$.jGrowl("'.$jgrowlinfo[0].'",{header:"'.$jgrtitle.'"});});})(jQuery);'."</script>\n";
  }
}
if(ilost_getOption('growlBox')&&ilost_getOption('jgrowltext'))add_action('wp_footer','ilost_jgrowlbox');
*/
function ilost_getjQuery(){
  $jquerysrc=ilost_getOption('jquerysrc');
  return $jquerysrc;
}
function ilost_getjQueryurl(){
  $custom_jquery=ilost_getOption('custom_jquery');
  return $custom_jquery;
}
/*
function ilost_googleanalytics(){
  $googleanalytics=ilost_getOption('googleanalytics');
  echo $googleanalytics;
}
if(ilost_getOption('googleanalytics'))add_action('wp_footer','ilost_googleanalytics');
*/
function ilost_adgsidebartop(){
  $sidebartopcode=ilost_getOption('sidebartopcode');
  if($sidebartopcode)echo $sidebartopcode;
}
function ilost_adgsidebarbottom(){
  $sidebarbottomcode=ilost_getOption('sidebarbottomcode');
  if($sidebarbottomcode)echo $sidebarbottomcode;
}
function ilost_adgpostemb(){
  $postembcode=ilost_getOption('postembcode');
  if($postembcode)echo $postembcode;
}
function ilost_adgpostend(){
  $postendcode=ilost_getOption('postendcode');
  if($postendcode)echo $postendcode;
}
?>