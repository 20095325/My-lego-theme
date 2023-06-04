<?php
/**
 * 404 not found error template
 *
 * @package lego-theme
 * @since 1.0.0
 */

get_header();

?>

<div class="content-area content-404">
    <div class="container">
        <div class="row row-404">

            <div class="image-404">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/404.jpg" alt="404"
                    class="img-fluid">
            </div>

            <h3 class="text-center">
                <?php esc_html_e('Sorry, can\'t find it!', 'legotheme'); ?>
            </h3>

            <div class="button-box text-center">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary"><?php esc_html_e('Back to Homepage', 'legotheme'); ?></a>
            </div>

        </div>
    </div>
</div>

<?php
get_footer();