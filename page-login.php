<?php
/**
 * login page template
 *
 * @package lego-theme
 * @since 1.0.0
 */

if (is_user_logged_in()) {
    wp_redirect('/profile');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_data = array(
        'user_login' => sanitize_user($_POST['user_login']),
        'user_password' => $_POST['user_password'],
        'remember' => isset($_POST['rememberme']) ? true : false,
    );

    $user_verify = wp_signon($login_data, false);

    if (is_wp_error($user_verify)) {
        $error_message = $user_verify->get_error_message();
    } else {
        wp_redirect(home_url());
        exit;
    }
}

get_header();
get_template_part('template-parts/banner', 'title');

?>

<div class="content-area">
    <div class="container">
        <div class="row">
            <div class="message">
                <?php if (isset($error_message)): ?>
                    <div class="login-error alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form id="login-form" method="post" class="needs-validation" novalidate>
                    <div class=" form-group mb-3">
                        <label for="user_login" class="form-label">
                            <?php _e('Username'); ?>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="user_login" class="form-control" required>
                        </div>
                        <div class="invalid-feedback">
                            <?php _e('Please enter your username.'); ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="user_password" class="form-label">
                            <?php _e('Password'); ?>
                        </label>
                        <div class="col-sm-4">
                            <input type="password" name="user_password" class="form-control" required>
                        </div>
                        <div class="invalid-feedback">
                            <?php _e('Please enter your password.'); ?>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="rememberme" id="rememberme" class="form-check-input">
                        <label class="form-check-label" for="rememberme">
                            <?php _e('Remember me'); ?>
                        </label>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="<?php _e('Log in'); ?>" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>