<?php
/**
 * search page template
 *
 * @package lego-theme
 * @since 1.0.0
 */

get_header();
get_template_part('template-parts/banner', 'title');
?>



<div class="content-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 overflow-hidden">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

          <?php

          if (have_posts()) {

            while (have_posts()) {

              the_post();
              get_template_part('template-parts/content', 'excerpt');

            }

          } else {

            get_template_part('template-parts/content', 'none');

          }

          ?>
        </div>
        <?php legotheme_pagination(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer();