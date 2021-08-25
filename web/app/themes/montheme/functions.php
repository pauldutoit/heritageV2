<?php

/** Setup */

require_once (get_template_directory() . '/core/theme_setup.php');

/** Theme settings menu */

require_once (get_template_directory() . '/settings/theme_settings.php');
require_once (get_template_directory() . '/settings/settings_getters.php');


/**
 * Theme Customizer
 */

require_once( get_template_directory() . "/customizer/theme_customizer.php" );
/* Setup the Theme Customizer settings and controls*/
add_action( 'customize_register', array( 'HERITAGE_Customize', 'register' ) );
add_action( 'customize_controls_enqueue_scripts', array( 'HERITAGE_Customize', 'register_controls' ) );

/* Output customizer CSS to live site - customizer colors*/
add_action( 'wp_head', array( 'HERITAGE_Customize', 'header_output' ) );

/* Enqueue live preview javascript in Theme Customizer admin screen*/
add_action( 'customize_preview_init', array( 'HERITAGE_Customize', 'live_preview' ) );


/**
 * Load needed  js scripts and css styles
 */

require_once (get_template_directory() . '/core/enqueue_scripts.php');


/** Register theme sidebar **/

require_once( get_template_directory() . "/core/register_theme_sidebars.php" );


/** Woocommerce related functionnality */

require_once (get_template_directory() . '/core/woocommerce_support.php');

/**
 * Utilities
 */

require_once(get_template_directory() . "/core/utils.php");


/**
 *	Comments template function used as callback in wp_list_comments() call in comments.php
 *	Comment form defaults
*/

require_once( get_template_directory() . "/core/comments_template_cbk.php" );


/*
      wp_ajax actions
  */
require_once( get_template_directory() . "/core/ajax_binding.php" );

/**
 * Menu walker
 */

require_once( get_template_directory() . "/core/menu/FrontendWalkerNavMenu.php" );