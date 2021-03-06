<?php class FFClient{ 
function __construct($akey,$skey,$accecss_token,$accecss_token_secret){$this->oauth=new OAuth($akey,$skey,$accecss_token,$accecss_token_secret);}
function public_timeline($count=20){return $this->oauth->get('http://api.fanfou.com/statuses/public_timeline.json?count='.$count);}
function friends_timeline($page=1,$count=20){return $this->request_with_pager('http://api.fanfou.com/statuses/friends_timeline.json',$page,$count);}
function user_timeline($page=1,$count=20){return $this->request_with_pager('http://api.fanfou.com/statuses/user_timeline.json',$page,$count);}
function show($stauts_id){return $this->oauth->get('http://api.fanfou.com/statuses/show/'.$stauts_id.'.json');}
function replies($page =1,$count=20){return $this->request_with_pager('http://api.fanfou.com/statuses/replies.json',$page,$count);}function mentions($page=1,$count=20){return $this->request_with_pager('http://api.fanfou.com/statuses/mentions.json',$page,$count);}
function update($text){$param=array();$param['status']=$text;return $this->oauth->post('http://api.fanfou.com/statuses/update.json',$param);}
function upload($text,$pic_path){$param=array();$param['status']=$text;$param['pic']='@'.$pic_path;return $this->oauth->post('http://api.fanfou.com/photos/upload.json',$param,true);}
function repost($text,$repost_status_id){$param=array();$param['status']=$text;$param['repost_status_id']= $repost_status_id;return $this->oauth->post('http://api.fanfou.com/statuses/update.json',$param);}
function destroy($sid){return $this->oauth->post('http://api.fanfou.com/statuses/destroy/' . $sid . '.json');}
function show_user($uid=false){$p=array();if($uid){$p['id']=$uid;}return $this->oauth->get('http://api.fanfou.com/users/show.json',$p);}
function friends($page=1,$id){$p=array('id'=>$id,'page'=>$page);return $this->oauth-> get('http://api.fanfou.com/users/friends.json',$p);}
function followers($page,$id){$p=array('id'=>$id,'page'=>$page);return $this->request_with_uid('http://api.fanfou.com/users/followers.json',$p);}
function follow($uid){return $this->oauth->post('http://api.fanfou.com/friendships/create/'.$uid.'.json');}
function unfollow($uid){return $this->oauth->post('http://api.fanfou.com/friendships/destroy/'.$uid.'.json');}
function is_followed($uid_a,$uid_b){$param=array('user_a'=>$uid_a,'user_b'=>$uid_b);return $this->oauth->get('http://api.fanfou.com/friendships/exists.json',$param);}
function list_dm($page=1,$count=20){return $this->request_with_pager('http://api.fanfou.com/direct_messages.json',$page,$count);}
function list_dm_sent($page=1,$count=20){return $this->request_with_pager('http://api.fanfou.com/direct_messages/sent.json',$page,$count);}
function send_dm($uid,$text){$param=array();$param['text']=$text;$param['user']=$uid;return $this->oauth->post('http://api.fanfou.com/direct_messages/new.json',$param);}
function delete_dm($did){return $this->oauth->post('http://api.fanfou.com/direct_messages/destroy/' . $did.'.json');}
function get_favorites($page=1,$count=20){$param=array();if($page)$param['page']=$page;if($count)$param['count']=$count;return $this->oauth->get('http://api.fanfou.com/favorites.json',$param);}
function add_to_favorites($sid){$param=array();$param['id']=$sid;return $this->oauth->post('http://api.fanfou.com/favorites/create/'.$sid.'.json');}
function remove_from_favorites($sid){return $this->oauth->post('http://api.fanfou.com/favorites/destroy/'.$sid.'.json');}
function verify_credentials(){return $this->oauth->get('http://api.fanfou.com/account/verify_credentials.json');}
protected function request_with_pager($url,$page=false,$count=false){$param=array();if($page)$param['page']=$page;if($count)$param['count']=$count;return $this->oauth->get($url,$param);}
protected function request_with_uid($url,$uid_or_name,$page=false,$count=false,$cursor=false,$post=false){$param=array();if($page)$param['page']=$page;if($count)$param['count']=$count;if($cursor){$param['cursor']=$cursor;}if($post){$method='post';}else{$method='get';}if(is_numeric($uid_or_name)){$param['user_id']=$uid_or_name;return $this->oauth->$method($url,$param);}elseif($uid_or_name!==null){$param['screen_name']=$uid_or_name;return $this->oauth->$method($url,$param);}else{return $this->oauth->$method($url,$param);}}}
?>