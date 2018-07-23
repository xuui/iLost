<?php if(post_password_required()){return;}?>
<section id="comments" class="clearfix">
	<div class="inarp">
	<?php if(have_comments()){?>
		<h3 class="comments-title"><?php $comments_number=get_comments_number();if('1'===$comments_number){printf(_x('One Replies','comments title','iLost'));}else{printf(_nx('%1$s Replies','%1$s Replies',$comments_number,'comments title','iLost'),number_format_i18n($comments_number));}?></h3>
		<ol class="comment-list">
			<?php wp_list_comments(array('callback'=>'ilost_comments','avatar_size'=>96,'style'=>'ol','short_ping'=>true,'reply_text'=>__('Reply','iLost')));?>
		</ol>
		<?php the_comments_pagination(array('prev_text'=>'<span class="screen-reader-text">'.__('Previous','iLost').'</span>','next_text'=>'<span class="screen-reader-text">'.__('Next','iLost').'</span>',));
  }
	if(!comments_open() && get_comments_number() && post_type_supports(get_post_type(),'comments')){?>
		<p class="no-comments"><?php _e('Comments are closed.','iLost');?></p>
	<?php }
	$ilost_comment_fields=array(
		'author'=>'<div class="form-group form-group-sm comment-form-author col-md-4"><label class="control-label" for="author">'.__('Name').($req ? '<span class="required">*</span>':'').'</label> '.'<input type="text" class="form-control" id="author" name="author" placeholder="your name" value="'.esc_attr($commenter['comment_author']).'" size="30" /></div>',//'.$aria_req.'
		'email'=>'<div class="form-group form-group-sm comment-form-email col-md-4"><label class="control-label" for="email">'.__('Email').($req ? '<span class="required">*</span>':'').'</label>'.'<input type="text" class="form-control" id="email" name="email" placeholder="your@mail.com" value="'.esc_attr($commenter['comment_author_email']).'" /></div>',//'.$aria_req.' 
		'url'=>'<div class="form-group form-group-sm comment-form-url col-md-4"><label class="control-label" for="url">'.__('Website').'</label>'.'<input type="text" class="form-control" id="url" name="url" placeholder="http://" value="'.esc_attr($commenter['comment_author_url']).'" size="30" /></div>',
	);
	$ilost_comment_form=array(
		'class_form'=>'comment-form row',
		'class_submit'=>'btn btn-primary',
		'comment_field'=>'<div class="form-group form-group-sm comment-form-comment col-xs-12"><label class="control-label" for="comment">'._x('Comment','noun').'</label><textarea class="form-control" id="comment" name="comment" placeholder="o ... .. ." rows="6" aria-required="true">'.'</textarea></div>',
		'comment_notes_after'=>'<p class="form-group smiley"></p>',//.$smilies.
		'fields'=>apply_filters('comment_form_default_fields',$ilost_comment_fields),
	);
	comment_form($ilost_comment_form);
	//comment_form();
	ilost_ctrlentry();?>
	</div>
</section>
