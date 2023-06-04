<?php
get_header();
get_template_part('template-parts/banner', 'title');
?>

<div class="content-area">
  <section class="position-relative">
    <div class="container">
      <div class="row row-cols-2 row-cols-lg-3">
        <!--Theme-->
        <div class="col-4 col-lg-2">
          Theme
          <div class="input-group mb-3">
            <select class="form-select" id="inputGroupSelect02">
              <option>Star Wars</option>
              <option>Harry Potter</option>
              <option>Marvel</option>
              <option>Warner Bros</option>
            </select>

          </div>
        </div>
        <!--End Theme-->

        <!--Year-->
        <div class="col-4 col-lg-1">
          Year
          <div class="input-group mb-3">
            <select class="form-select" id="inputGroupSelect02">
              <option selected>Year</option>
              <?php
              $latestYear = (int) date('Y');
              $lastYear = $latestYear - 15;
              for ($i = $latestYear; $i >= $lastYear; $i--) {
                echo '<option value=' . $i . '>' . $i . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <!--End Year-->

        <!--Sort by-->
        <div class="col-4 col-lg-2">
          Sort by
          <div class="input-group mb-3">
            <select class="form-select" id="inputGroupSelect02">
              <option>Most recent</option>
              <option>Oldest</option>
              <option>Accending</option>
              <option>Decending</option>
            </select>
          </div>
        </div>
        <!--End Sort by-->

        <!--Search -->
        <div class="col-4 col-lg-2">
          <div class="input-group mb-3">
            Search
            <input type="text" class="" style="padding:5px;" placeholder="Enter a set name..."
              aria-label="Enter a set name..." aria-describedby="button-addon2">
            <!--<button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>-->
          </div>
        </div>
        <!--End Search -->

      </div>
    </div>
  </section>

  <section class="position-relative">
    <div class="container">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <!--Sets list-->
        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
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
            <!--End Sets list-->
            <?php
          endwhile;
        else:
          ?>
          <!--if no posts available or empty-->
          <div class="col-12 col-md-4" style="padding:1%;">
            <div class="alert alert-secondary" role="alert">
              No sets available.
            </div>
          </div>
          <!--End if no posts available or empty-->
          <?php
        endif;
        ?>
      </div>
    </div>
  </section>
  <?php
  legotheme_pagination();
  ?>
</div>
<?php
get_footer();