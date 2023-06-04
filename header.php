<?php
/**
 * the header file
 * 
 * @package lego-theme
 * @since 1.0.0
 */

$blog_info = get_bloginfo('name');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
  <div id="profile-navigation" class="sticky-top bg-light bg-lighten-md">

  </div>
  <div id="top-navigation" class="blue sticky-top bg-light bg-lighten-md">
    <div class="container">
      <nav class="navbar navbar-expand-lg" aria-label="Eleventh navbar example">
        <div class="container-fluid">
          <?php
          $custom_logo_id = get_theme_mod('custom_logo');
          if ($custom_logo_id) {
            $image = wp_get_attachment_image_src($custom_logo_id, 'full');
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>"><img class="mw-60 logo-image" src="<?php echo $image[0]; ?>"
                alt="<?php echo esc_html($blog_info) ?>"></a>
            <?php
          } else {
            ?>
            <p class="blog-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($blog_info) ?></a>
            <p>
              <?php
          }
          ?>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false"
              aria-label="<?php esc_attr_e('Toggle navigation', 'legotheme'); ?>">
              <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            wp_nav_menu(
              array(
                'theme_location' => 'primary',
                'depth' => 2,
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse justify-content-md-end mt-4 mt-md-0',
                'container_id' => 'main-navbar',
                'menu_class' => 'navbar-nav gap-3 align-items-md-center',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(),
              )
            );
            ?>
        </div>
      </nav>

    </div>
  </div>