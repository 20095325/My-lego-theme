<?php
/**
 * Profile page template
 *
 * @package lego-theme
 * @since 1.0.0
 */

 if (is_user_logged_in()) {
    wp_redirect('/profile');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = sanitize_text_field($_POST['first_name']);
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    $errors = array();

    if (empty($first_name)) {
        $errors[] = 'First-Name-is-required.';
    }

    if (empty($username)) {
        $errors[] = 'Username-is-required.';
    }

    if (empty($email) || !is_email($email)) {
        $errors[] = 'Valid-email-address-is-required.';
    }

    if (empty($password)) {
        $errors[] = 'Password-is-required.';
    }

    if (empty($errors)) {
        $user_id = wp_create_user($username, $password, $email);
        if (!is_wp_error($user_id)) {
            wp_update_user(array('ID' => $user_id, 'first_name' => $first_name, 'role' => 'subscriber'));
            $success_message = 'Registration-successful.-You-can-now-login.';
            wp_redirect('/login');
            exit;
        } else {
            $errors[] = $user_id->get_error_message();
        }
    }
}

get_header();
get_template_part('template-parts/banner', 'title');

?>

<div class="content-area">
    <div class="container">
        <div class="row">
            <div class="messages">
                <?php if (isset($success_message)): ?>
                    <div class="registration-success-message">
                        <?php echo $success_message; ?>
                    </div>
                <?php elseif (!empty($errors)): ?>
                    <div class="registration-error-message">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li>
                                    <?php echo $error; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <div class="registration">

                <form id="registration-form" class="registration-form" name="registration-form" method="post">
                    <div class="form-group mb-3">
                        <label for="first-name">First Name:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="first_name" id="first-name" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="username">Username:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="username" id="username" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="email" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>