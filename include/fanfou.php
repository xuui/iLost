<?php  // Fanfou API.
define("fan_akey",'61d1ff8288dbde741d1b680d3b59a37a');define("fan_skey",'ae0975dbe89b6afae7681d2f9b924eeb');define("fan_callback",admin_url('themes.php?page=ilost_options&tab=fanfou'));require_once('oauth.php');require_once('client.php');if(!isset($_SESSION)){session_start();}function ilost_get_fanauthorize(){$o=new OAuth(fan_akey,fan_skey);$keys=$o->getRequestToken();$aurl=$o->getAuthorizeURL($keys['oauth_token'],false,fan_callback);$_SESSION['temp']=$keys;return $aurl;}function ilost_posto_fanfou($pid){if($_POST['action']!="autosave" and $_POST['post_status']!="draft" and $_POST['post_status']!="save"){$postitle=get_the_title($pid);$posturl=get_permalink($pid);if($_POST['original_post_status']=='publish'){$postitle=__('[Update] ','iLost').$postitle;}else{$postitle=__('[New] ','iLost').$postitle;}$t_url="http://tinyurl.com/api-create.php?url=".$posturl;$url_contents=file_get_contents($t_url);$temp_length=(strlen($postitle))+(strlen($url_contents));if($temp_length>127){$remaining_chars=124 - strlen($url_contents);$postitle=substr($postitle,0,$remaining_chars);$postitle=$postitle."...";}$postmessage=$postitle." - ".$url_contents;$ff_user=new FFClient(fan_akey,fan_skey,ilost_getOption('fan_token'),ilost_getOption('fan_token_secret'));$ff_user->update($postmessage);}}?>