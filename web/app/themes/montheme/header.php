<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php get_template_part('views/favicon'); ?>

    <?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>
<div id="lc_swp_wrapper">
    <?php
    get_template_part( 'templates/login-popup' );
    /*main menu*/
    if (!is_page_template("template-visual-composer-no-menu.php")) {
        $menu_style = HERITAGE_get_menu_style();
        get_template_part('templates/menu/'.$menu_style);
    }

    /*heading area*/
    if (!is_page_template("template-visual-composer.php") &&
        !is_page_template("template-visual-composer-no-menu.php")) {
        get_template_part('templates/heading_area');
    }
    /**
     * @hooked woocommerce_show_product_images 20
     */
    do_action('heritage_swp_before_content');

    $color_scheme = 'black_on_white'; //heritage_SWP_get_default_color_scheme();
    ?>
    <div id="lc_swp_content" data-minheight="200" class="<?php echo esc_attr($color_scheme); ?>">

