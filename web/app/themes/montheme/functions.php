<?php

/** Setup */

require_once (get_template_directory() . '/core/theme_setup.php');

/** Theme settings menu */

require_once (get_template_directory() . '/settings/theme_settings.php');
require_once (get_template_directory() . '/settings/settings_getters.php');

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
 * Menu walker
 */

require_once( get_template_directory() . "/core/menu/FrontendWalkerNavMenu.php" );



