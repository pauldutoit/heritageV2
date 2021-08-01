<?php

if(!function_exists('HERITAGE_setup')) {

    function HERITAGE_setup()
    {
        $domain = 'heritage';

        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menu');
        add_theme_support('automatic-feed-links');

        add_image_size('post-thumbnail', 250, 250, true);

        register_nav_menus(
            array(
                'main-menu' => esc_html__('Main menu', 'heritage'),
            )
        );

        // custom background support

        global $wp_version;

        if(version_compare($wp_version, '3.4', '>=')){
            $default = array(
                'default_color' => 'fffff',
                'default_image' => '',
                'wp-head-callback' => 'HERITAGE_custom_background_cb',
                'admin-head_callback' => '',
                'admin-preview-callback' => ''
            );

            add_theme_support('custom-background', $default);
        }
    }
}

add_action('after_setup_theme', 'HERITAGE_setup');

function HERITAGE_custom_background_cb()
{
    $background = get_background_image();
    $color = get_background_color();

    if (!$background && !$color) {
        return;
    }

    $style = $color ? "background-color: #$color;" : '';

    if ($background) {
        $image = "background-image: url('$background');";

        $position = get_theme_mod('background_position_x', 'left');

        if (!in_array($position, array('center', 'right', 'left')))
            $position = 'left';

        $position = " background-position: top $position;";

        $attachment = get_theme_mod('background_attachment', 'scroll');

        if (!in_array($attachment, array('fixed', 'scroll')))
            $attachment = 'scroll';

        $attachment = " background-attachment: $attachment;";

        $style .= $image . $position . $attachment;
    }
    ?>
    <style type="text/css">
        body, .woocommerce .woocommerce-ordering select option {
        <?php echo trim($style); ?>
        }
    </style>
    <?php
}


/**
 * Load the main stylesheet - style.css
 */

if(!function_exists('HERITAGE_load_main_stylesheet')){
    function HERITAGE_load_main_stylesheet()
    {
        wp_enqueue_style('style', get_stylesheet_uri());
    }
}
add_action('wp_enqueue_scripts', 'HERITAGE_load_main_stylesheet');


/**
 * Load needed Fonts
 * Exemple heritage Lato
 */

if(!function_exists('HERITAGE_load_fonts')){
    function HERITAGE_load_fonts()
    {
        $protocol = is_ssl() ? 'https' : 'http';
        wp_enqueue_style('heritage-lato', $protocol."://fonts.googleapis.com/css?family=Lato:300,400,700,900&amp;subset=latin-ext");
    }
}
add_action('wp_enqueue_scripts', 'HERITAGE_load_fonts');

/*
	Control Excerpt Length
*/
if (!function_exists('HERITAGE_excerpt_length')) {
    function HERITAGE_excerpt_length($length)
    {
        return 40;
    }
}
add_filter( 'excerpt_length', 'HERITAGE_excerpt_length', 999);


function HERITAGE_menu_class($classes)
{
    $classes[] = 'menu-item-swp';
    return $classes;
}
add_filter('nav_menu_css_class', 'HERITAGE_menu_class');



if (!isset($content_width)) {
    $content_width = 900;
}
if(!function_exists('HERITAGE_create_customization_page')) {

    function HERITAGE_create_customization_page()
    {
        $check_page_exist = get_page_by_title('Customization', 'OBJECT', 'page');
        if(empty($check_page_exist)) {
            $page_id = wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status' => 'close',
                    'post_author' => 1,
                    'post_title' => ucwords('customization'),
                    'post_name' => strtolower(str_replace(' ', '-', trim('Customization'))),
                    'post_status' => 'publish',
                    'post_content' => '',
                    'post_type' => 'page',
                    'post_parent' => NULL
                )
            );
        }
    }
}
add_action('init', 'HERITAGE_create_customization_page');

if(!function_exists('HERITAGE_create_contact_page')) {

    function HERITAGE_create_contact_page()
    {
        $check_page_exist = get_page_by_title('Contact', 'OBJECT', 'page');
        if (empty($check_page_exist)) {
            $page_id = wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status' => 'close',
                    'post_author' => 1,
                    'post_title' => ucwords('contact'),
                    'post_name' => strtolower(str_replace(' ', '-', trim('Contact'))),
                    'post_status' => 'publish',
                    'post_content' => '',
                    'post_type' => 'page',
                    'post_parent' => NULL
                )
            );
            add_post_meta($page_id, '_wp_page_template', 'template-contact.php');
        }
    }
}
add_action('init', 'HERITAGE_create_contact_page');

if(!function_exists('HERITAGE_create_cgv_page')) {

    function HERITAGE_create_cgv_page()
    {
        $check_page_exist = get_page_by_title('CGV', 'OBJECT', 'page');
        if (empty($check_page_exist)) {
            $page_id = wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status' => 'close',
                    'post_author' => 1,
                    'post_title' => ucwords('cgv'),
                    'post_name' => strtolower(str_replace(' ', '-', trim('CGV'))),
                    'post_status' => 'publish',
                    'post_content' => 'Conditions générales de ventes',
                    'post_type' => 'page',
                    'post_parent' => NULL
                )
            );
        }
    }
}
add_action('init', 'HERITAGE_create_cgv_page');


if(!function_exists('HERITAGE_create_homepage')) {

    function HERITAGE_create_homepage()
    {
        $check_page_exist = get_page_by_title('Homepage', 'OBJECT', 'page');
        if (empty($check_page_exist)) {
            $page_id = wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status' => 'close',
                    'post_author' => 1,
                    'post_title' => ucwords('homepage'),
                    'post_name' => strtolower(str_replace(' ', '-', trim('Homepage'))),
                    'post_status' => 'publish',
                    'post_content' => 'Homepage',
                    'post_type' => 'page',
                    'post_parent' => NULL
                )
            );
        }
    }
}
add_action('init', 'HERITAGE_create_homepage');

if(!function_exists('HERITAGE_create_articles_page')) {

    function HERITAGE_create_articles_page()
    {
        $check_page_exist = get_page_by_title('Articles', 'OBJECT', 'page');
        if (empty($check_page_exist)) {
            $page_id = wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status' => 'close',
                    'post_author' => 1,
                    'post_title' => ucwords('articles'),
                    'post_name' => strtolower(str_replace(' ', '-', trim('Articles'))),
                    'post_status' => 'publish',
                    'post_content' => 'Articles',
                    'post_type' => 'page',
                    'post_parent' => NULL
                )
            );
        }
    }
}
add_action('init', 'HERITAGE_create_articles_page');


?>
