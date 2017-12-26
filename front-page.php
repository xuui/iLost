<?php /* Template Name: Home */
get_header();?>
<section id="showSection">
  <?php ilost_getiloshow();?>
  <div class="container postpart"><div class="row">
    <?php ilost_showProTu(ilost_frontCat());?>
  </div></div>
</section>
<div id="newpost">
  <div class="container">
    <div class="row">
      <?php ilost_queryNewp($limit=4);?>
    </div>
  </div>
</div>
<?php /*
front-page
*/?>
<?php get_footer();?>