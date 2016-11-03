<section id="comments" class="clearfix">
<?php if(post_password_required()){?><div class="alert alert-warning" role="alert"><?php _e('This post is password protected. Enter the password to view any comments.','iLost');?></div>
</section>
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
//require_once(TEMPLATEPATH.'/include/smiley.php');
$ilost_comment_fields=array(
  'author'=>'<div class="form-group form-group-sm comment-form-author col-sm-4"><label class="control-label" for="author">'.__('Name').($req ? '<span class="required">*</span>':'').'</label> '.'<input type="text" class="form-control" id="author" name="author" placeholder="your name" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.' /></div>',
  'email'=>'<div class="form-group form-group-sm comment-form-email col-sm-4"><label class="control-label" for="email">'.__('Email').($req ? '<span class="required">*</span>':'').'</label>'.'<input type="text" class="form-control" id="email" name="email" placeholder="your@mail.com" value="'.esc_attr($commenter['comment_author_email']).'" '.$aria_req.' /></div>',
  'url'=>'<div class="form-group form-group-sm comment-form-url col-sm-4"><label class="control-label" for="url">'.__('Website').'</label>'.'<input type="text" class="form-control" id="url" name="url" placeholder="http:///" value="'.esc_attr($commenter['comment_author_url']).'" size="30" /></div>',
);
$ilost_comment_form=array(
  'class_submit'=>'btn btn-primary',
  'comment_field'=>'<div class="form-group form-group-sm comment-form-comment col-xs-12"><label class="control-label" for="comment">'._x('Comment','noun').'</label><textarea class="form-control" id="comment" name="comment" placeholder="o ... .. ." rows="6" aria-required="true">'.'</textarea></div>',
  'comment_notes_after'=>'<p class="form-group smiley">'.$smilies.'</p>',
  'fields'=>apply_filters('comment_form_default_fields',$ilost_comment_fields),
);
comment_form($ilost_comment_form);
ilost_ctrlentry();?>
</section>