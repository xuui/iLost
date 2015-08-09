<div id="comments">
<?php if(post_password_required()){?><p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.','iLost');?></p>
</div>
<?php return;}
if(have_comments()){?>
  <h3 id="comments-title"><?php printf(_n(__('One Response to %2$s','iLost'),__('%1$s Responses to %2$s','iLost'),get_comments_number()),number_format_i18n(get_comments_number()),'<em>'.get_the_title().'</em>' );?></h3>
  <ol class="comment-list"><?php wp_list_comments(array('callback'=>'ilost_comments'));?></ol>
<?php if(get_comment_pages_count()>1 && get_option('page_comments')){?>
  <div class="post-link"><?php paginate_comments_links();?></div>
<?php }}else{
if(!comments_open()){?>
  <p class="nocomments"><?php _e('Comments are closed.','iLost');?></p>
<?php }}
require_once(TEMPLATEPATH.'/include/smiley.php');
comment_form('comment_notes_after=<p class="smiley">'.$smilies.'</p>');
ilost_ctrlentry();?>
</div>