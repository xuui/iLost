<?php /* Template Name: Home */
get_header();?>
<?php ilost_getiloshow();?>
<div id="proaside">
  <div class="container"><div class="row">
    <?php ilost_showProTu(ilost_frontCat());?>
  </div></div>
</div>
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