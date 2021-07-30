<?php

/**
 * Load needed js scripts and css styles
 */

if(!function_exists('HERITAGE_load_scripts_and_styles')){
    function HERITAGE_load_scripts_and_styles(){

        /** COLOR SCHEME */

        wp_register_style('color_scheme_css', get_template_directory_uri(). '/core/css/black_on_white.css');
        wp_enqueue_style('color_scheme_css');

        wp_register_script('select2_js', get_template_directory_uri().'/assets/select2/select2.full.min.js', array('jquery'), '', true);
        wp_enqueue_script( 'select2_js');

        wp_register_script('fancybox_js', get_template_directory_uri().'/assets/fancybox/fancybox.min.js', array('jquery'), '', true);
        wp_enqueue_script( 'fancybox_js');

        wp_register_script('js_image_zoom', get_template_directory_uri().'/assets/js-image-zoom-master/package/js-image-zoom.js', array('jquery'), '', true);
        wp_enqueue_script( 'js_image_zoom');


        wp_register_script('heritage', get_template_directory_uri().'/core/js/heritage.js',
            array(
                'jquery',
                'masonry',
                'debouncedresize',
                'justified-gallery',
                'unslider',
                'fancybox_js',
                'select2_js',
                'password-strength-meter',
                'js_image_zoom'
            ), '', true);
        wp_enqueue_script( 'heritage');



        /* localize script */



        /*lightbox*/
        wp_register_script('lightbox', get_template_directory_uri().'/assets/lightbox2/js/lightbox.js', array('jquery'), '', true);
        wp_enqueue_script( 'lightbox');

        wp_register_style('lightbox', get_template_directory_uri(). '/assets/lightbox2/css/lightbox.css');
        wp_enqueue_style('lightbox');

        wp_register_style('select2_css', get_template_directory_uri(). '/assets/select2/select2.min.css');
        wp_enqueue_style('select2_css');
        wp_register_style('fancybox_css', get_template_directory_uri(). '/assets/fancybox/fancybox.min.css');
        wp_enqueue_style('fancybox_css');

        /*masonry*/
        wp_enqueue_script('masonry');
        wp_enqueue_script('imagesloaded');

        /*font awesome*/
        wp_register_style('font_awesome', get_template_directory_uri(). '/assets/fa/css/fa.css');
        wp_enqueue_style('font_awesome');

        /*linear icons free*/
        wp_register_style('linearicons', get_template_directory_uri(). '/assets/linearicons/linear-style.css');
        wp_enqueue_style('linearicons');

        /*debounce resize*/
        wp_register_script('debouncedresize', get_template_directory_uri().'/core/js/jquery.debouncedresize.js', array('jquery'), '', true);
        wp_enqueue_script( 'debouncedresize');

        /*justified gallery*/
        wp_register_script('justified-gallery', get_template_directory_uri().'/assets/justifiedGallery/js/jquery.justifiedGallery.min.js', array('jquery'), '', true);
        wp_enqueue_script( 'justified-gallery');

        wp_register_style('justified-gallery', get_template_directory_uri(). '/assets/justifiedGallery/css/justifiedGallery.min.css');
        wp_enqueue_style('justified-gallery');

        /*unslider*/
        wp_register_script('unslider', get_template_directory_uri().'/assets/unslider/unslider-min.js', array('jquery'), '', true);
        wp_enqueue_script( 'unslider');

        wp_register_style('unslider', get_template_directory_uri(). '/assets/unslider/unslider.css');
        wp_enqueue_style('unslider');

    }
}

add_action('wp_enqueue_scripts', 'HERITAGE_load_scripts_and_styles');

if(!function_exists('HERITAGE_load_admin_scripts_and_styles')){
    function HERITAGE_load_admin_scripts_and_styles(){
        wp_enqueue_media();

        /* theme settings*/
        wp_register_script('theme_settings',  get_template_directory_uri().'/settings/js/theme_settings.js', array('jquery', 'alpha_color_picker'), '', true);
        wp_enqueue_script('theme_settings');

        wp_register_style('theme_settings', get_template_directory_uri(). '/settings/css/theme_settings.css', array('alpha_color_picker'));
        wp_enqueue_style('theme_settings');

        /*alpha color picker*/
        wp_register_script('alpha_color_picker',  get_template_directory_uri().'/core/js/alpha-color-picker.js', array('jquery', 'wp-color-picker'), '', true);
        wp_enqueue_script('alpha_color_picker');

        wp_register_style('alpha_color_picker', get_template_directory_uri(). '/core/css/alpha-color-picker.css', array('wp-color-picker'));
        wp_enqueue_style('alpha_color_picker');
    }
}

add_action('admin_enqueue_scripts', 'HERITAGE_load_admin_scripts_and_styles');

?>