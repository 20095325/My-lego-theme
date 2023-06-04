<?php
/**
 * title banner and search bar
 * 
 * @package lego-theme
 * @since 1.0.0
 */

$blog_info = get_bloginfo('name');
$description = get_bloginfo('description', 'display');

?>

<section class="title-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-sm-12 offset-sm-0 overflow-hidden text-center">
                <?php
                if (!is_front_page() && is_page()) {

                    the_title('<h1 class="page-title">', '</h1>');

                } elseif (is_single()) {
                    ?>
                    
                    <?php
                    the_title('<h1 class="page-title">', '</h1>');

                } elseif (is_front_page()) {

                    ?>

                    <h1>
                        <?php echo esc_html($blog_info) ?>
                    </h1>

                    <?php get_search_form(); ?>
                    <div class="mt-5 d-flex justify-content-center gap-5">
                        <a href="<?php echo esc_url(home_url('/')) ?>register" role="button" class="btn btn-primary btn-sm">Sign Up</a>
                        <a href="<?php echo esc_url(home_url('/')) ?>sets" role="button" class="btn btn-light btn-sm">Browse Sets</a>
                    </div>

                    <?php
                } elseif (!is_front_page() && is_home()) {

                    $legotheme_blog_title = get_the_title(get_option('page_for_posts', true));

                    ?>

                    <h1 class="page-title">
                        <?php echo esc_html($legotheme_blog_title); ?>
                    </h1>

                    <?php
                } elseif (is_home()) {

                    ?>

                    <h1>
                        <?php echo esc_html($blog_info) ?>
                    </h1>

                    <?php get_search_form(); ?>
                    <div class="mt-5 d-flex justify-content-center gap-5">
                        <a role="button" class="btn btn-primary btn-sm">Sign Up</a>
                        <a role="button" class="btn btn-light btn-sm">Browse Sets</a>
                    </div>

                    <?php
                } elseif (is_archive()) {

                    the_archive_title('<h1 class="page-title">', '</h1>');

                } elseif (is_404()) {
                    ?>

                    <p class="tag-line sub-title">404</p>
                    <h1>
                        <?php esc_html_e("Couldn't Be Found", "legotheme"); ?>
                    </h1>

                    <?php
                } elseif (is_search()) {

                    $search_title = sprintf('%s %s', __('Search results for: ', 'legotheme'), get_search_query());
                    ?>

                    <h1 class="page-title">
                        <?php echo esc_html($search_title); ?>
                    </h1>

                    <?php
                }

                ?>
            </div>
        </div>
    </div>
</section>