<?php

if (!function_exists('legotheme_setup')) {

    // theme setup

    function legotheme_setup()
    {

        load_theme_textdomain('legotheme', get_template_directory() . '/languages');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption'
            )
        );
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('responsive-embeds');
        add_theme_support(
            'custom-logo',
            array(
                'height' => 100,
                'width' => 400,
                'flex-height' => true,
                'flex-width' => true,
                'header-text' => array('site-title', 'site-description'),
            )
        );

        register_nav_menus(
            array(
                'primary' => esc_html__('Primary Menu', 'legotheme')
            )
        );

        $login_exists = get_page_by_path('login', OBJECT, 'page');
        if (!$login_exists) {

            // Create loginpage
            $loginpage = array(
                'post_type' => 'page',
                'post_title' => 'Login',
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1
            );

            $loginpage_id = wp_insert_post($loginpage);

        }
        $register_exists = get_page_by_path('register', OBJECT, 'page');
        if (!$register_exists) {
            // Create registerpage
            $registerpage = array(
                'post_type' => 'page',
                'post_title' => 'Register',
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1
            );

            $registerpage_id = wp_insert_post($registerpage);
        }
        $profile_exists = get_page_by_path('profile', OBJECT, 'page');
        if (!$profile_exists) {
            // Create profile
            $profilepage = array(
                'post_type' => 'page',
                'post_title' => 'Profile',
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1
            );

            $profilepage_id = wp_insert_post($profilepage);
        }

    }

    require_once get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php';

    add_action('after_setup_theme', 'legotheme_setup');
}

// enqueue scripts and styles

function lego_scripts_styles()
{

    // enqueue css files
    wp_enqueue_style('google-font-body', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap', array(), '1.0.0', false);
    wp_enqueue_style('google-font-heading', 'https://fonts.googleapis.com/css2?family=Sarpanch:wght@400;500;600;700;800;900&display=swap', array(), '1.0.0', false);
    wp_enqueue_style('bootstrap', get_theme_file_uri('css/bootstrap.min.css'), array(), '5.3.0', false);
    wp_enqueue_style('flaticon', get_theme_file_uri('fonts/flaticon.css'), array(), '1.0.0', false);

    // main css file
    wp_enqueue_style('lego-theme', get_theme_file_uri('style.css'), array('bootstrap'), '1.0.0', false);

    // enqueue js files
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/faadf16e48.js', array(), '6.4.0', true);
    wp_enqueue_script('bootstrap', get_theme_file_uri('js/bootstrap.bundle.js'), array(), '5.3.0', true);
    wp_enqueue_script('legoscript', get_theme_file_uri('js/script.js'), array('jquery'), '1.0.0', true);

}

add_action('wp_enqueue_scripts', 'lego_scripts_styles');

// custom read more text

function legotheme_excerpt_readmore($more)
{
    return '...<b>Read More -></b>';
}

add_filter('excerpt_more', 'legotheme_excerpt_readmore');

// pagination

function legotheme_pagination()
{
    global $wp_query;
    $links = paginate_links(
        array(
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'type' => 'list',
            'prev_text' => '<-',
            'next_text' => '->'
        )
    );
    $links = '<nav class="legotheme-pagination">' . $links;
    $links .= '</nav>';
    echo wp_kses_post($links);
}

// shorten default excerpt length

add_filter('excerpt_length', function ($length) {
    return 20;
});

// Remove junk from head

//remove_action( 'wp_head', '_wp_render_title_tag', 1 );
//remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'locale_stylesheet');
remove_action('publish_future_post', 'check_and_publish_future_post', 10);
remove_action('wp_head', 'wp_robots', 1);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_head', 'wp_print_styles', 2);
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'wp_custom_css_cb', 101);
remove_action('wp_head', 'wp_site_icon', 99);
//remove_action( 'wp_footer', 'wp_print_footer_scripts', 20 );
remove_action('template_redirect', 'wp_shortlink_header', 11);
//remove_action( 'wp_print_footer_scripts', '_wp_footer_scripts' );
remove_action('init', '_register_core_block_patterns_and_categories');
remove_action('init', 'check_theme_switched', 99);
remove_action('init', array('WP_Block_Supports', 'init'), 22);
remove_action('switch_theme', array('WP_Theme_JSON_Resolver', 'clean_cached_data'));
remove_action('start_previewing_theme', array('WP_Theme_JSON_Resolver', 'clean_cached_data'));
remove_action('after_switch_theme', '_wp_menus_changed');
remove_action('after_switch_theme', '_wp_sidebars_changed');
remove_action('wp_print_styles', 'print_emoji_styles');

// Fix for bootstrap 5 dropdown menu items

add_filter('nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3);
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute($atts, $item, $args)
{
    if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
        if (array_key_exists('data-toggle', $atts)) {
            unset($atts['data-toggle']);
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}

// // register a new widget

function legotheme_register_widgets()
{

    register_sidebar(
        array(
            'name' => __('First Footer Widget', 'legotheme'),
            'id' => 'legotheme-first-footer-widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        )
    );

    register_sidebar(
        array(
            'name' => __('Second Footer Widget', 'legotheme'),
            'id' => 'legotheme-second-footer-widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name' => __('Third Footer Widget', 'legotheme'),
            'id' => 'legotheme-third-footer-widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name' => __('Fourth Footer Widget', 'legotheme'),
            'id' => 'legotheme-fourth-footer-widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'
        )
    );

}
add_action('widgets_init', 'legotheme_register_widgets');


// Register new post type for Sets
function lego_sets_custom_post_type()
{
    register_post_type(
        'lego_sets',
        array(
            'labels' => array(
                'name' => __('Sets', 'textdomain'),
                'singular_name' => __('Set', 'textdomain'),
            ),
            'public' => true,
            'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
            'taxonomies' => array('theme'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'sets'),
            // my custom slug
        )
    );
}

add_action('init', 'lego_sets_custom_post_type');

add_action('add_meta_boxes_lego_sets', 'meta_box_for_lego_sets');

function meta_box_for_lego_sets($post)
{
    add_meta_box('my_meta_box_custom_id', __('Additional info', 'textdomain'), 'custom_fileds_for_lego_sets', 'lego_sets', 'normal', 'low');
}

function custom_fileds_for_lego_sets($post)
{
    wp_nonce_field(basename(__FILE__), 'my_custom_meta_box_nonce'); //used later for security
    echo '<p><label for="set_number">' . __('Set number:', 'textdomain') . '</label>
        <input type="text" name="set_number" value="' . get_post_meta($post->ID, 'set_number', true) . '"/></p>';
    echo '<p><label for="set_year">' . __('Set year:', 'textdomain') . '</label> <input type="text" name="set_year" value="' . get_post_meta($post->ID, 'set_year', true) . '"/></p>';
}

add_action('save_post_lego_sets', 'lego_sets_save_meta_boxes_data', 10, 2);

function lego_sets_save_meta_boxes_data($post_id)
{ // check for nonce to top xss
    if (!isset($_POST['my_custom_meta_box_nonce']) || !wp_verify_nonce($_POST['my_custom_meta_box_nonce'], basename(__FILE__))) {
        return;
    } // check for correct user capabilities - stop internal xss from customers
    if (!current_user_can('edit_post', $post_id)) {
        return;
    } // update fields
    if (isset($_REQUEST['set_number'])) {
        update_post_meta($post_id, 'set_number', sanitize_text_field($_POST['set_number']));
    }
    if (isset($_REQUEST['set_year'])) {
        update_post_meta($post_id, 'set_year', sanitize_text_field($_POST['set_year']));
    }
}

function wpdocs_create_theme_tax_rewrite()
{
    $labels = array(
        'name' => _x('Themes', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Theme', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Themes', 'textdomain'),
        'all_items' => __('All Themes', 'textdomain'),
        'parent_item' => __('Parent Themes', 'textdomain'),
        'parent_item_colon' => __('Parent Theme:', 'textdomain'),
        'edit_item' => __('Edit Theme', 'textdomain'),
        'update_item' => __('Update Theme', 'textdomain'),
        'add_new_item' => __('Add New Theme', 'textdomain'),
        'new_item_name' => __('New Theme Name', 'textdomain'),
        'menu_name' => __('Theme', 'textdomain'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'sets/theme')
    );

    register_taxonomy('theme', array('lego_sets'), $args);
}

add_action('init', 'wpdocs_create_theme_tax_rewrite', 0);

// remove archive prefix on titles

function theme_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}

add_filter('get_the_archive_title', 'theme_archive_title');

add_filter('wp_nav_menu_items', 'add_login_links', 10, 2);
function add_login_links($items, $args)
{
    /**
     * If menu primary menu is set & user is logged in.
     */
    if (is_user_logged_in() && $args->theme_location == 'primary') {
        $current_user = wp_get_current_user();
        $items .= '<li><span class="nav-sep">|</span></li>';
        $items .= '<li><a href="' . esc_url(home_url('/')) . 'login" class="d-flex align-items-center"> 
        <div class="ratio ratio-1x1 overflow-hidden nav-profile-img">
          ' . get_avatar(get_current_user_id(), 30) . '
        </div>
        <span class="mx-3">' . $current_user->display_name . '</span>
        </a></li>';
    }
    /**
     * Else display login menu item.
     */elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
        $items .= '<li><span class="nav-sep">|</span></li>';
        $items .= '<li><a href="' . esc_url(home_url('/')) . 'login">Log In</a></li>';
        $items .= '<li><a href="' . esc_url(home_url('/')) . 'register">Register</a></li>';
    }
    return $items;
}