<?php


function HERITAGE_get_user_logo_img() {
    return HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_custom_logo');
}

//function HERITAGE_get_default_color_scheme(){
//
//    $color_scheme = HERITAGE_get_theme_option('heritage_theme_general_options', '');
//    if(!empty($color_scheme)){
//        return $color_scheme;
//    }
//    return 'black_on_white';
//}

function HERITAGE_get_menu_style(){
    $menu_style = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_menu_style');

    if(empty($menu_style)){
        $menu_style = 'creative_menu';
    }

    return $menu_style;
}

function HERITAGE_is_sticky_menu() {
    $sticky_menu = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_enable_sticky_menu');

    if (empty($sticky_menu) || ("enabled" == $sticky_menu)) {
        return true;
    }

    return false;
}

function HERITAGE_get_header_footer_width() {
    $header_width = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_header_footer_width');

    /*cannot return empty value*/
    if (empty($header_width)) {
        $header_width = 'full';
    }

    return $header_width;
}

function HERITAGE_is_back_to_top_enabled() {
    $back_to_top = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_back_to_top');

    if (empty($back_to_top) || ("disabled" == $back_to_top)) {
        return false;
    }
    return true;
}

function HERITAGE_is_login_popup_enabled() {
    $enabled = HERITAGE_get_theme_option( 'heritage_theme_general_options', 'lc_login_popup_enable' );
    if ( empty( $enabled ) ) {
        $enabled = true;
    }
    return $enabled == 'yes';
}

function HERITAGE_get_products_view_mode(){
    $view_modes = array('list', 'grid');
    if(isset($_REQUEST['mode'])){
        $view_mode = sanitize_text_field($_REQUEST['mode']);
        if(in_array($view_mode, $view_modes)){
            return $view_mode;
        }
    }

    $view_mode = isset($_COOKIE['heritage_products_view_mode']) ? sanitize_text_field($_COOKIE['heritage_products_view_mode']) : '';
    if(in_array($view_mode, $view_modes)){
        return $view_mode;
    }

    $view_mode = HERITAGE_get_theme_option( 'heritage_theme_shop_options', 'lc_products_view_mode' );

    if ( !in_array( $view_mode, $view_modes ) ) {
        return 'grid';
    }

    return $view_mode;
}

function HERITAGE_get_products_per_row(){
    if ( isset( $_REQUEST['products_per_row'] ) ) {
        $ppr = intval( $_REQUEST['products_per_row'] );
        if ( 3 <= $ppr && $ppr <= 5 ) {
            return  $ppr;
        }
    }

    $ppr_in_cookie = isset( $_COOKIE['heritage_products_per_row'] ) ? intval( $_COOKIE['heritage_products_per_row'] ) : 0;
    if ( 3 <= $ppr_in_cookie && $ppr_in_cookie <= 5 ) {
        return $ppr_in_cookie;
    }

    $products_per_row = HERITAGE_get_theme_option( 'heritage_theme_shop_options', 'lc_products_per_row' );

    if ( !intval( $products_per_row ) ) {
        $products_per_row = 4;
    }

    return $products_per_row;
}

function HERITAGE_get_default_color_scheme() {
    $color_scheme = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_default_color_scheme');
    if (!empty($color_scheme)) {
        return $color_scheme;
    }
    return  'black_on_white';
}


function HERITAGE_get_footer_color_scheme() {
    $footer_color_scheme = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_footer_widgets_color_scheme');

    if (!empty($footer_color_scheme)) {
        return $footer_color_scheme;
    }

    return 'black_on_white';
}

function HERITAGE_get_footer_bg_color() {
    $footer_background_color = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_footer_widgets_background_color');

    if (!empty($footer_background_color)) {
        return $footer_background_color;
    }

    return 'rgba(255, 255, 255, 0)';
}

function HERITAGE_get_copyrigth_text() {
    return esc_html(HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_copyright_text'));
}

function HERITAGE_get_copyrigth_url() {
    return esc_url_raw(HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_copyright_url'));
}

function HERITAGE_have_social_on_copyright() {
    $put_social_footer = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_copyright_put_social');
    if (empty($put_social_footer)) {
        return true;
    }

    return "enabled" == $put_social_footer ? true : false;
}

function HERITAGE_get_available_social_profiles() {
    $user_profiles = array();

    $available_profiles = array(
        'facebook'		=> 'lc_fb_url',
        'twitter'		=>'lc_twitter_url',
        'google-plus'	=>'lc_gplus_url',
        'youtube'		=>'lc_youtube_url',
        'pinterest'		=>'lc_pinterest_url',
    );

    foreach ($available_profiles as $key =>	$profile) {
        $profile_url = HERITAGE_get_theme_option('heritage_theme_social_options', $profile);

        if (!empty($profile_url)) {
            $single_profile = array();
            $single_profile['url'] 	= $profile_url;
            $single_profile['icon'] 	= $key;

            $user_profiles[] = $single_profile;
        }
    }

    return $user_profiles;
}

function HERITAGE_get_menu_message() {
    return HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_menu_message');
}

/**
 *  CONTACT Functions
 */

function HERITAGE_get_contact_address()
{
    return esc_html(HERITAGE_get_theme_option('heritage_theme_contact_options', 'lc_contact_address'));
}

function HERITAGE_get_contact_email()
{
    return sanitize_email(HERITAGE_get_theme_option('HERITAGE_theme_contact_options', 'lc_contact_email'));
}

function HERITAGE_get_contact_phone()
{
    return esc_html(HERITAGE_get_theme_option('heritage_theme_contact_options', 'lc_contact_phone'));
}

function HERITAGE_get_contact_fax()
{
    return esc_html(HERITAGE_get_theme_option('heritage_theme_contact_options', 'lc_contact_fax'));
}

function  HERITAGE_get_titles_alignment_class() {
    $title_align = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_title_alignment');

    if (empty($title_align)) {
        return 'text_center';
    }

    return "center" == $title_align ? "text_center"	: "text_left";
}
