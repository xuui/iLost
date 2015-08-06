<?php get_header();?>
<div id="content">
<article>
  <section>
   	<div class="title">
      <h2><?php _e('Not Found','iLost');?></h2>
    </div>
    <div class="entry">
    	<p><?php _e('Apologies, but the page you requested could not be found. Perhaps searching will help.','iLost');?></p>
			<?php get_search_form();?>
    </div>
  </section>
</article>
<?php get_sidebar();?>
<div class="clear"></div>
</div>
<?php get_footer();?>