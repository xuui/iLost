<div id="comments">
<?php if(post_password_required()){?><div class="alert alert-warning" role="alert"><?php _e('This post is password protected. Enter the password to view any comments.','iLost');?></div>
</div>
<?php return;}
if(have_comments()){?>
  <h3 id="comments-title"><?php printf(_n(__('One Response','iLost'),__('%1$s Responses','iLost'),get_comments_number()),number_format_i18n(get_comments_number()));?></h3>
  <ol class="comment-list media-list"><?php wp_list_comments(array('callback'=>'ilost_comments'));?></ol>
<?php if(get_comment_pages_count()>1 && get_option('page_comments')){?>
  <div class="post-link"><?php paginate_comments_links();?></div>
<?php }}else{
if(!comments_open()){?>
  <div class="alert alert-warning" role="alert"><?php _e('Comments are closed.','iLost');?></div>
<?php }}
require_once(TEMPLATEPATH.'/include/smiley.php');
$ilost_comment_fields=array(
  'author'=>'<div class="form-group form-group-sm comment-form-author col-xs-4"><label class="control-label" for="author">'.__('Name').($req ? '<span class="required">*</span>':'').'</label> '.'<input type="text" class="form-control" id="author" name="author" placeholder="your name" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.' /></div>',
  'email'=>'<div class="form-group form-group-sm comment-form-email col-xs-4"><label class="control-label" for="email">'.__('Email').($req ? '<span class="required">*</span>':'').'</label>'.'<input type="text" class="form-control" id="email" name="email" placeholder="your@mail.com" value="'.esc_attr($commenter['comment_author_email']).'" '.$aria_req.' /></div>',
  'url'=>'<div class="form-group form-group-sm comment-form-url col-xs-4"><label class="control-label" for="url">'.__('Website').'</label>'.'<input type="text" class="form-control" id="url" name="url" placeholder="http:///" value="'.esc_attr($commenter['comment_author_url']).'" size="30" /></div>',
);
$ilost_comment_form=array(
  'class_submit'=>'btn btn-primary',
  'comment_field'=>'<div class="form-group form-group-sm comment-form-comment col-xs-12"><label class="control-label" for="comment">'._x('Comment','noun').'</label><textarea class="form-control" id="comment" name="comment" placeholder="o ... .. ." rows="6" aria-required="true">'.'</textarea></div>',
  //'comment_notes_after'=>'<p class="smiley">'.$smilies.'</p>'.'<p class="help-block form-allowed-tags">'.sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s'),'<code>'.allowed_tags().'</code>').'</p>',
  'comment_notes_after'=>'<p class="form-group smiley">'.$smilies.'</p>',
  'fields'=>apply_filters('comment_form_default_fields',$ilost_comment_fields),
  /*
  'id_form'           => 'commentform',
  'title_reply'       => __( 'Leave a Reply' ),
  'title_reply_to'    => __( 'Leave a Reply to %s' ),
  'cancel_reply_link' => __( 'Cancel Reply' ),
  'label_submit'      => __( 'Post Comment' ),
  'format'            => 'xhtml',
  'id_submit'         => 'submit',
  'name_submit'       => 'submit',
  'must_log_in'=>'<p class="must-log-in">'.sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'),wp_login_url(apply_filters('the_permalink',get_permalink()))).'</p>',
  'logged_in_as'=>'<p class="logged-in-as">'.sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'),admin_url('profile.php'),$user_identity,wp_logout_url(apply_filters('the_permalink',get_permalink()))).'</p>',
  'comment_notes_before'=>'<p class="comment-notes">'.__('Your email address will not be published.').($req ? $required_text:'').'</p>',
  */
);
comment_form($ilost_comment_form);
ilost_ctrlentry();?>
</div>