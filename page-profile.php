<?php
/**
 * Profile page template
 *
 * @package lego-theme
 * @since 1.0.0
 */

if (!is_user_logged_in()) {
    wp_redirect('/login');
    exit;
}

get_header();
get_template_part('template-parts/banner', 'profile');
$current_user = wp_get_current_user();
?>


<div class="content-area ztm-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="ratio ratio-1x1 bg-success overflow-hidden border border-primary border-2 profile-img">
                    <?php echo get_avatar(get_current_user_id(), 150); ?>
                </div>
            </div>

            <div class="col-md-9">
                <div class="user-profile-content">


                    <h1 class="dark">
                        <?php echo $current_user->display_name; ?>
                    </h1>
                    <p class="user-profile-email">
                        <?php echo $current_user->user_email; ?>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>