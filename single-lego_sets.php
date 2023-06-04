<?php
get_header();
get_template_part('template-parts/banner', 'title');
?>
<div class="content-area">
  <section class="position-relative pb-5 pt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <?php $image_url = get_the_post_thumbnail_url(); ?>
          <?php if (!$image_url): ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.png" class="img-fluid"
              alt="<?php echo the_title(); ?>">
          <?php else: ?>
            <img src="<?php echo $image_url; ?>" class="img-fluid" alt="<?php echo the_title(); ?>">
          <?php endif; ?>
        </div>

        <div class="col-12 col-md-6">
          <?php $post_id = get_the_ID(); ?>
          <p class="">Set Number:
            <?php echo get_post_meta($post_id, 'set_number', true); ?>
          </p>
          <p class="">Release Year:
            <?php echo get_post_meta($post_id, 'set_year', true); ?>
          </p>
          <hr />
          <div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/add-to-collection-icon.svg" data-toggle="tooltip" data-placement="bottom" title="Add set to your collection" width="32" height="32" class="img-fluid d-inline-block m-2"
              alt="<?php echo the_title(); ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/add-to-wishlist-icon.svg" data-toggle="tooltip" data-placement="bottom" title="Add set to a wishlist" width="32" height="32" class="img-fluid d-inline-block m-2"
              alt="<?php echo the_title(); ?>">
          </div>
        </div>
      </div>
  </section>
  <section class="position-relative pb-5 pt-5">
    <div class="container">
      <div class="row">
        <h2 class="pb-5">Latest Sets</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          <?php
          $terms = get_the_terms($post_id, 'theme');
          if (!empty($terms)) {
            // get the first term
            $term = array_shift($terms);
          }
          $args = array(
            'post__not_in' => array($post_id),
            'numberposts' => 3,
            'post_status' => 'publish',
            'post_type' => 'lego_sets',
            'tax_query' => array(
              array(
                'taxonomy' => 'theme',
                'field' => 'slug',
                'terms' => $term->slug,
              ),
            ),
          );
          $related_query = new WP_Query($args);
          if ($related_query->have_posts()):
            while ($related_query->have_posts()):
              $related_query->the_post();
              $post_id = get_the_ID();
              ?>
              <article id="post-<?php $post_id; ?>" <?php post_class('col'); ?>>
                <div class="card">
                  <img src="<?php echo get_the_post_thumbnail_url($post_id, 'large'); ?>" class="p-4"
                    alt="<?php echo get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', TRUE); ?>">
                  <div class="card-body">
                    <h3 class=""><a href="<?php the_permalink($post_id); ?>"><?php the_title(); ?></a></h3>
                    <p class="excerpt">
                      <?php echo get_post_meta($post_id, 'set_number', true); ?> |
                      <?php echo implode(",", wp_get_post_terms($post_id, 'theme', array('fields' => 'names'))); ?>
                    </p>
                    <a href="<?php the_permalink($post_id); ?>" class="btn btn-primary"><?php esc_html_e('View set ->', 'legotheme'); ?></a>
                  </div>
                </div>
              </article>
              <?php
            endwhile;
          else:
            ?>
            <div class="col-12 col-md-4" style="padding:1%;">
              <div class="alert alert-secondary" role="alert">
                No sets available.
              </div>
            </div>
            <?php
          endif; ?>
          <!--End Related Sets-->

        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer();