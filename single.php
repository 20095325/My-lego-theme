<?php
get_header();
get_template_part('template-parts/banner', 'title');
?>
<div class="content-area">
  <section class="position-relative pb-5 pt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 blog-img">
          <?php $image_url = get_the_post_thumbnail_url(); ?>
          <?php if (!$image_url): ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.png" class="img-fluid"
              alt="<?php echo the_title(); ?>">
          <?php else: ?>
            <img src="<?php echo $image_url; ?>" class="img-fluid" alt="<?php echo the_title(); ?>">
          <?php endif; ?>
        </div>

        <div class="col-12 col-md-6">
          <?php the_content(); ?>
        </div>
      </div>
  </section>
</div>
<?php get_footer();