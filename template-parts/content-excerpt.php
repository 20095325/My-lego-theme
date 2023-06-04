<?php
/**
 * standard excerpt template
 *
 * @package lego-theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col'); ?>>
  <div class="card">
  <?php 
  $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
  if($img_url) { ?>
    <img src="<?php  echo $img_url; ?>" class="p-4" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE); ?>">
    <?php } ?>
    <div class="card-body">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="meta">
      <span><?php echo get_the_date( 'M d, Y' ); ?></span>
      </div>
      <p class="excerpt">
        <?php force_balance_tags( the_excerpt() ); ?>
      </p>
      <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e( 'See full post ->', 'legotheme' ); ?></a>
    </div>
  </div>
</article>
