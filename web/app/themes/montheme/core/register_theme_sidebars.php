<?php

function HERITAGE_widgets_init()
{
    if (function_exists('register_sidebar')) {

        /*footer sidebars*/
        register_sidebar(
            array(
                'name' => esc_html__('Footer Sidebar 1', 'heritage'),
                'id' => 'footer-sidebar-1',
                'description' => esc_html__('Appears in the footer area', 'heritage'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="footer-widget-title">',
                'after_title' => '</h3>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Footer Sidebar 2', 'heritage'),
                'id' => 'footer-sidebar-2',
                'description' => esc_html__('Appears in the footer area', 'heritage'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="footer-widget-title">',
                'after_title' => '</h3>',
            ));

        register_sidebar(
            array(
                'name' => esc_html__('Footer Sidebar 3', 'heritage'),
                'id' => 'footer-sidebar-3',
                'description' => esc_html__('Appears in the footer area', 'heritage'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="footer-widget-title">',
                'after_title' => '</h3>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Footer Sidebar 4', 'heritage'),
                'id' => 'footer-sidebar-4',
                'description' => esc_html__('Appears in the footer area', 'heritage'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="footer-widget-title">',
                'after_title' => '</h3>',
            )
        );
    }
}
add_action('widgets_init','HERITAGE_widgets_init');

?>