<?php

define("LC_SWP_PRINT_SETTINGS", false);

function HERITAGE_setup_admin_menus()
{
    add_theme_page(
        'Heritage Theme Settings', /* page title*/
        'Heritage Settings',  /* menu title */
        'administrator',    /*capability*/
        'heritage_menu_page',  /*menu_slug*/
        'HERITAGE_option_page_settings'  /*function */
    );
}
add_action("admin_menu", "HERITAGE_setup_admin_menus");


function HERITAGE_option_page_settings()
{
    ?>

    <div class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2>Heritage Theme Settings</h2>

        <?php settings_errors(); ?>

        <?php
            if(isset($_GET['tab'])){
                $active_tab = $_GET['tab'];
            } else {
                $active_tab = 'general_options';
            }
        ?>

        <h2 class="nav-tab-wrapper">
            <?php
                $general_options_class = $active_tab == 'general_options' ? 'nav-tab-active' : '';
                $social_options_class = $active_tab == 'social_options' ? 'nav-tab-active' : '';
                $footer_options_class = $active_tab == 'footer_options' ? 'nav-tab-active' : '';
                $contact_options_class = $active_tab == 'contact_options' ? 'nav-tab-active' : '';
                $shop_options_class = $active_tab == 'shop_options' ? 'nav-tab-active' : '';
            ?>
            <a href="?page=heritage_menu_page&tab=general_options" class="nav-tab <?php echo esc_attr($general_options_class); ?>"><?php esc_html_e('General Options', 'heritage'); ?></a>
            <a href="?page=heritage_menu_page&tab=social_options" class="nav-tab <?php echo esc_attr($social_options_class); ?>"><?php esc_html_e('Social Options', 'heritage'); ?></a>
            <a href="?page=heritage_menu_page&tab=footer_options" class="nav-tab <?php echo esc_attr($footer_options_class); ?>"><?php esc_html_e('Footer Options', 'heritage'); ?></a>
            <a href="?page=heritage_menu_page&tab=contact_options" class="nav-tab <?php echo esc_attr($contact_options_class); ?>"><?php esc_html_e('Contact Data', 'heritage'); ?></a>
            <a href="?page=heritage_menu_page&tab=shop_options" class="nav-tab <?php echo esc_attr($shop_options_class); ?>"><?php esc_html_e('Shop', 'heritage'); ?></a>
        </h2>

        <form method="post" action="options.php">

            <?php
                if($active_tab == 'general_options'){
                    settings_fields('heritage_theme_general_options');
                    do_settings_sections('heritage_theme_general_options');
                } elseif ($active_tab == 'social_options') {
                    settings_fields( 'heritage_theme_social_options');
                    do_settings_sections( 'heritage_theme_social_options');
                } elseif ($active_tab == 'footer_options') {
                    settings_fields( 'heritage_theme_footer_options');
                    do_settings_sections( 'heritage_theme_footer_options');
                } elseif ($active_tab == 'contact_options') {
                    settings_fields( 'heritage_theme_contact_options');
                    do_settings_sections( 'heritage_theme_contact_options');
                } elseif ($active_tab == 'shop_options') {
                    settings_fields( 'heritage_theme_shop_options');
                    do_settings_sections( 'heritage_theme_shop_options');
                }
                submit_button();
            ?>
        </form>
    </div>

<?php
}

/**
 *  Initialize theme options
 */
add_action('admin_init', 'HERITAGE_initialize_theme_options');
function HERITAGE_initialize_theme_options()
{
    $lc_swp_available_theme_options = array (
      array(
          'option_name'         => 'heritage_theme_general_options',
          'section_id'          => 'heritage_general_settings_section',
          'title'               => esc_html__('General Options', 'heritage'),
          'callback'            => 'HERITAGE_general_options_callback',
          'sanitize_callback'	=> 'HERITAGE_sanitize_general_options'
      ), array (
            'option_name'		=> 'heritage_theme_social_options',
            'section_id'		=> 'heritage_social_settings_section',
            'title'				=> esc_html__('Social Options', 'heritage'),
            'callback'			=> 'HERITAGE_social_options_callback',
            'sanitize_callback'	=> 'HERITAGE_sanitize_social_options'
        ),
        array (
            'option_name'		=> 'heritage_theme_footer_options',
            'section_id'		=> 'heritage_footer_settings_section',
            'title'				=> esc_html__('Footer Options', 'heritage'),
            'callback'			=> 'HERITAGE_footer_options_callback',
            'sanitize_callback'	=> 'HERITAGE_sanitize_footer_options'
        ),
        array (
            'option_name'		=> 'heritage_theme_contact_options',
            'section_id'		=> 'heritage_contact_settings_section',
            'title'				=> esc_html__('Contact Options', 'heritage'),
            'callback'			=> 'HERITAGE_contact_options_callback',
            'sanitize_callback'	=> 'HERITAGE_sanitize_contact_options'
        ),
        array (
            'option_name'		=> 'heritage_theme_shop_options',
            'section_id'		=> 'heritage_shop_settings_section',
            'title'				=> esc_html__('Shop Options', 'heritage'),
            'callback'			=> 'HERITAGE_shop_options_callback',
            'sanitize_callback'	=> 'HERITAGE_sanitize_shop_options'
        )
    );

    foreach($lc_swp_available_theme_options as $theme_option) {

        if (false == get_option($theme_option['option_name'])) {
            add_option($theme_option['option_name']);
        }

        add_settings_section(
            $theme_option['section_id'],       // identify section to register options
            $theme_option['title'],            // displayed title
            $theme_option['callback'],         // callback used to render the description
            $theme_option['option_name']       // page on which add section of option
        );
    }

    HERITAGE_add_settings_fields();

    foreach ($lc_swp_available_theme_options as $theme_option){
        register_setting(
            $theme_option['option_name'],
            $theme_option['option_name'],
            $theme_option['sanitize_callback']
        );
    }

}

/*
	Callbacks that render the description for each tab
*/
function HERITAGE_general_options_callback() {
    ?>
    <p>
        <?php echo esc_html__('Setup custom logo.', 'heritage'); ?>
    </p>
    <?php
    /*print theme settings*/
    if (LC_SWP_PRINT_SETTINGS) {
        $general = get_option('heritage_theme_general_options');

        ?>
        <pre>heritage_theme_general_options:
			<?php echo (json_encode($general)); ?>
		</pre>
        <?php
    }
}

function HERITAGE_social_options_callback() {
    ?>
    <p>
        <?php echo esc_html__('Provide the URL to the social profiles you would like to display.', 'heritage'); ?>
    </p>
    <?php
}

function HERITAGE_footer_options_callback() {
    ?>
    <p>
        <?php echo esc_html__('Setup footer text for the copyright area, footer text URL and analytics code. Also setup the footer widget area.', 'heritage'); ?>
    </p>
    <?php
}

function HERITAGE_contact_options_callback() {
    ?>
    <p>
        <?php echo esc_html__('Please insert your contact information.', 'heritage'); ?>
    </p>
    <?php
}

function HERITAGE_shop_options_callback() {
    ?>
    <p>
        <?php echo esc_html__('Change WooCommerce shop related settings.', 'heritage'); ?>
    </p>
    <?php
}

/*
	Sanitize Functions
*/
function  HERITAGE_sanitize_general_options($input) {
    $output = array();

    foreach($input as $key => $val) {
        if(isset($input[$key])) {
            if (($key == 'lc_custom_favicon') ||
                ($key == 'lc_custom_logo')) {
                $output[$key] = esc_url_raw(trim( $input[$key] ) );
            } else {
                $output[$key] =  esc_html(trim($input[$key])) ;
            }
        }
    }

    return apply_filters('HERITAGE_sanitize_general_options', $output, $input);
}

function HERITAGE_sanitize_shop_options($input) {
    $output = array();

    foreach($input as $key => $val) {
        if(isset($input[$key])) {
            $output[$key] =  esc_html(trim($input[$key])) ;
        }
    }

    return apply_filters('HERITAGE_sanitize_shop_options', $output, $input);
}


/* SOCIAL OPTIONS */

function HERITAGE_sanitize_social_options($input) {
    $output = array();

    foreach($input as $key => $val) {
        if(isset($input[$key])) {
            $output[$key] =  esc_url_raw(trim($input[$key])) ;
        }
    }

    return apply_filters('HERITAGE_sanitize_social_options', $output, $input);
}

/*
	CALLBACKS FOR SETTINGS FIELDS
*/
function HERITAGE_logo_select_cbk() {
    $logo_url = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_custom_logo');

    ?>
    <input id="lc_swp_logo_upload_value" type="text" name="heritage_theme_general_options[lc_custom_logo]" size="150" value="<?php echo esc_url($logo_url); ?>"/>
    <input id="lc_swp_upload_logo_button" type="button" class="button" value="<?php echo esc_html__('Upload Logo', 'heritage'); ?>" />
    <input id="lc_swp_remove_logo_button" type="button" class="button" value="<?php echo esc_html__('Remove Logo', 'heritage'); ?>" />
    <p class="description">
        <?php echo esc_html__('Upload a custom logo image.', 'heritage'); ?>
    </p>

    <div id="lc_logo_image_preview">
        <img class="lc_swp_setting_preview_logo" src="<?php echo esc_url($logo_url); ?>">
    </div>

    <?php
}

function HERITAGE_add_settings_fields()
{
    $general_settings = array(
        array(
            'id'        => 'lc_custom_logo',
            'label'     => esc_html__('Upload logo image', 'heritage'),
            'callback'  => 'HERITAGE_logo_select_cbk'
        ),
        array (
            'id'		=> 'lc_custom_innner_bg_image',
            'label'		=> esc_html__('Upload custom background image', 'heritage'),
            'callback'	=> 'HERITAGE_inner_bg_image_select_cbk'
        ),
        array (
            'id'		=> 'lc_menu_style',
            'label'		=> esc_html__('Choose menu style', 'heritage'),
            'callback'	=> 'HERITAGE_menu_style_cbk'
        ),
        array (
            'id'		=> 'lc_enable_sticky_menu',
            'label'		=> esc_html__('Enable sticky menu', 'heritage'),
            'callback'	=> 'HERITAGE_enable_sticky_menu_cbk'
        ),
        array (
            'id'		=> 'lc_login_popup_enable',
            'label'		=> esc_html__('Login Popup', 'heritage'),
            'callback'	=> 'HERITAGE_lc_login_popup_enable'
        ),
        array (
            'id'		=> 'lc_back_to_top',
            'label'		=> esc_html__('Enable back to top button', 'heritage'),
            'callback'	=> 'HERITAGE_back_to_top_cbk'
        )
    );

    foreach ($general_settings as $general_setting){
        add_settings_field(
            $general_setting['id'],
            $general_setting['label'],
            $general_setting['callback'],
            'heritage_theme_general_options',
            'heritage_general_settings_section'
        );
    }

    $social_settings = array(
        array (
            'id'		=> 'lc_fb_url',
            'label'		=> esc_html__('Facebook URL', 'heritage'),
            'callback'	=> 'HERITAGE_fb_url_cbk'
        ),
        array (
            'id'		=> 'lc_twitter_url',
            'label'		=> esc_html__('Twitter URL', 'heritage'),
            'callback'	=> 'HERITAGE_twitter_url_cbk'
        ),
        array (
            'id'		=> 'lc_gplus_url',
            'label'		=> esc_html__('Google+ URL', 'heritage'),
            'callback'	=> 'HERITAGE_gplus_url_cbk'
        ),
        array (
            'id'		=> 'lc_youtube_url',
            'label'		=> esc_html__('YouTube URL', 'heritage'),
            'callback'	=> 'HERITAGE_youtube_url_cbk'
        ),
        array (
            'id'		=> 'lc_pinterest_url',
            'label'		=> esc_html__('Pinterest URL', 'heritage'),
            'callback'	=> 'HERITAGE_pinterest_url_cbk'
        )
    );

    foreach($social_settings as $social_setting) {
        add_settings_field(
            $social_setting['id'],         		// ID used to identify the field throughout the theme
            $social_setting['label'],              // The label to the left of the option interface element
            $social_setting['callback'], 			// The name of the function responsible for rendering the option interface
            'heritage_theme_social_options',   		// The page on which this option will be displayed
            'heritage_social_settings_section'    	// The name of the section to which this field belongs
        );
    }

    $contact_settings = array(
        array(
            'id'		=> 'lc_contact_address',
            'label'		=> esc_html__('Contact address', 'heritage'),
            'callback'	=> 'HERITAGE_lc_contact_address_cbk'
        ),
        array(
            'id'		=> 'lc_contact_phone',
            'label'		=> esc_html__('Contact phones', 'heritage'),
            'callback'	=> 'HERITAGE_lc_contact_phone_cbk'
        ),
        array(
            'id'		=> 'lc_contact_fax',
            'label'		=> esc_html__('Contact Fax Number', 'heritage'),
            'callback'	=> 'HERITAGE_lc_contact_fax_cbk'
        ),
        array(
            'id'		=> 'lc_contact_email',
            'label'		=> esc_html__('Contact E-mail', 'heritage'),
            'callback'	=> 'HERITAGE_lc_contact_email_cbk'
        )
    );


    $footer_settings = array(
        array(
            'id'		=> 'lc_copyright_text',
            'label'		=> esc_html__('Copyright text', 'heritage'),
            'callback'	=> 'HERITAGE_copyright_text_cbk'
        ),
        array(
            'id'		=> 'lc_copyright_url',
            'label'		=> esc_html__('Copyrigth URL', 'heritage'),
            'callback'	=> 'HERITAGE_copyright_url_cbk'
        ),
        array(
            'id'		=> 'lc_copyright_text_bg_color',
            'label'		=> esc_html__('Copyrigth Text Background Color', 'heritage'),
            'callback'	=> 'HERITAGE_copyright_bgc_cbk'
        ),
        array(
            'id'		=> 'lc_footer_widgets_background_color',
            'label'		=> esc_html__('Footer widgets color overlay', 'heritage'),
            'callback'	=> 'HERITAGE_footer_widget_bgcolor_cbk'
        ),
        array(
            'id'		=> 'lc_copyright_put_social',
            'label'		=> esc_html__('Place social icons on footer', 'heritage'),
            'callback'	=> 'HERITAGE_copyright_put_social_cbk'
        )
    );

    foreach($footer_settings as $footer_setting) {
        add_settings_field(
            $footer_setting['id'],
            $footer_setting['label'],
            $footer_setting['callback'],
            'heritage_theme_footer_options',
            'heritage_footer_settings_section'
        );
    }

    $contact_settings = array(
        array(
            'id'      => 'lc_contact_address',
            'label'       => esc_html__('Contact address', 'heritage'),
            'callback' => 'HERITAGE_lc_contact_address_cbk'
        ),
        array(
            'id'      => 'lc_contact_phone',
            'label'       => esc_html__('Contact phones', 'heritage'),
            'callback' => 'HERITAGE_lc_contact_phone_cbk'
        ),
        array(
            'id'      => 'lc_contact_fax',
            'label'       => esc_html__('Contact Fax Number', 'heritage'),
            'callback' => 'HERITAGE_lc_contact_fax_cbk'
        ),
        array(
            'id'      => 'lc_contact_email',
            'label'       => esc_html__('Contact E-mail', 'heritage'),
            'callback' => 'HERITAGE_lc_contact_email_cbk'
        )
    );


    foreach($contact_settings as $contact_setting) {
        add_settings_field(
            $contact_setting['id'],         		// ID used to identify the field throughout the theme
            $contact_setting['label'],              // The label to the left of the option interface element
            $contact_setting['callback'], 			// The name of the function responsible for rendering the option interface
            'heritage_theme_contact_options',   		// The page on which this option will be displayed
            'heritage_contact_settings_section'    	// The name of the section to which this field belongs
        );
    }

    $heritage_shop_settings = array(
        array (
            'id'		=> 'lc_products_view_mode',
            'label'		=> esc_html__('Products View Mode', 'heritage'),
            'callback'	=> 'HERITAGE_lc_products_view_mode'
        ),
        array (
            'id'		=> 'lc_products_per_row',
            'label'		=> esc_html__('Products Per Row', 'heritage'),
            'callback'	=> 'HERITAGE_lc_products_per_row'
        )
    );

    foreach($heritage_shop_settings as $heritage_shop_setting) {
        //var_dump($heritage_shop_setting);die;
        add_settings_field(
            $heritage_shop_setting['id'],         		// ID used to identify the field throughout the theme
            $heritage_shop_setting['label'],              // The label to the left of the option interface element
            $heritage_shop_setting['callback'], 			// The name of the function responsible for rendering the option interface
            'heritage_theme_shop_options',   		// The page on which this option will be displayed
            'heritage_shop_settings_section'    	// The name of the section to which this field belongs
        );
    }

}

function HERITAGE_inner_bg_image_select_cbk() {
    $inner_bg_img_url = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_custom_innner_bg_image');
    ?>

    <input id="lc_swp_innner_bg_image_upload_value" type="text" name="heritage_theme_general_options[lc_custom_innner_bg_image]" size="150" value="<?php echo esc_url($inner_bg_img_url); ?>"/>
    <input id="lc_swp_upload_innner_bg_image_button" type="button" class="button" value="<?php echo esc_html__('Upload Image', 'heritage'); ?>" />
    <input id="lc_swp_remove_innner_bg_image_button" type="button" class="button" value="<?php echo esc_html__('Remove Image', 'heritage'); ?>" />
    <p class="description">
        <?php echo esc_html__('Upload a custom background image for inner pages.', 'heritage'); ?>
    </p>

    <div id="lc_innner_bg_image_preview">
        <img class="lc_swp_setting_preview_favicon" src="<?php echo esc_url($inner_bg_img_url); ?>">
    </div>
    <?php
}

function HERITAGE_menu_style_cbk() {
    $menu_style = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_menu_style');
    if (empty($menu_style)) {
        $menu_style = 'creative_menu';
    }

    $menu_options = array(
        esc_html__('Creative Menu', 'heritage')			=> 'creative_menu',
        esc_html__('Classic Menu', 'heritage')			=> 'classic_menu',
        esc_html__('Centered Menu', 'heritage')			=> 'centered_menu',
        esc_html__('Classic Doubled Menu', 'heritage')	=> 'classic_double_menu'
    );
    ?>

    <select id="lc_menu_style" name="heritage_theme_general_options[lc_menu_style]">
        <?php HERITAGE_render_select_options($menu_options, $menu_style); ?>
    </select>
    <?php
}

function HERITAGE_enable_sticky_menu_cbk() {
    $sticky_menu = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_enable_sticky_menu');

    if (empty($sticky_menu)) {
        $sticky_menu = 'enabled';
    }

    $sticky_options = array(
        esc_html__('Enabled', 'heritage')	=> 'enabled',
        esc_html__('Disabled', 'heritage')	=> 'disabled'
    );
    ?>
    <select id="lc_enable_sticky_menu" name="heritage_theme_general_options[lc_enable_sticky_menu]">
        <?php HERITAGE_render_select_options($sticky_options, $sticky_menu); ?>
    </select>
    <p class="description">
        <?php echo esc_html__('Enable or disable sticky menu bar. If enabled, menu will stay on top whyle the user moves the scrollbar.', 'heritage'); ?>
    </p>
    <?php
}

function HERITAGE_lc_login_popup_enable() {
    $enable_login_popup = HERITAGE_get_theme_option( 'heritage_theme_general_options', 'lc_login_popup_enable' );
    if ( empty( $enable_login_popup ) ) {
        $enable_login_popup = 'yes';
    }
    $options = array(
        esc_html__( 'Enabled', 'heritage' ) => 'yes',
        esc_html__( 'Disabled', 'heritage' )  => 'no',
    );
    ?>
    <select id="lc_login_popup_enable" name="heritage_theme_general_options[lc_login_popup_enable]">
        <?php HERITAGE_render_select_options( $options, $enable_login_popup ); ?>
    </select>
    <p class="description">
        <?php echo esc_html__( 'Enable or disable login popup on frontend', 'heritage' ); ?>
    </p>
    <?php
}

function HERITAGE_back_to_top_cbk() {
    $back_to_top = HERITAGE_get_theme_option('heritage_theme_general_options', 'lc_back_to_top');

    if (empty($back_to_top)) {
        $back_to_top = 'disabled';
    }

    $sticky_options = array(
        esc_html__('Enabled', 'heritage')	=> 'enabled',
        esc_html__('Disabled', 'heritage')	=> 'disabled'
    );
    ?>
    <select id="lc_back_to_top" name="heritage_theme_general_options[lc_back_to_top]">
        <?php HERITAGE_render_select_options($sticky_options, $back_to_top); ?>
    </select>
    <p class="description">
        <?php echo esc_html__('Enable or disable back to top button.', 'heritage'); ?>
    </p>
    <?php
}


/*
	SOCIAL OPTIONS
*/
function HERITAGE_fb_url_cbk() {
    $fb_url = HERITAGE_get_theme_option('heritage_theme_social_options', 'lc_fb_url');

    ?>
    <input id="lc_fb_url" type="text" name="heritage_theme_social_options[lc_fb_url]" size="150" value="<?php echo esc_url($fb_url); ?>"/>
    <?php
}

function HERITAGE_twitter_url_cbk() {
    $twitter_url = HERITAGE_get_theme_option('heritage_theme_social_options', 'lc_twitter_url');

    ?>
    <input id="lc_twitter_url" type="text" name="heritage_theme_social_options[lc_twitter_url]" size="150" value="<?php echo esc_url($twitter_url); ?>"/>
    <?php
}

function HERITAGE_gplus_url_cbk() {
    $gplus_url = HERITAGE_get_theme_option('heritage_theme_social_options', 'lc_gplus_url');

    ?>
    <input id="lc_gplus_url" type="text" name="heritage_theme_social_options[lc_gplus_url]" size="150" value="<?php echo esc_url($gplus_url); ?>"/>
    <?php
}

function HERITAGE_youtube_url_cbk() {
    $youtube_url = HERITAGE_get_theme_option('heritage_theme_social_options', 'lc_youtube_url');

    ?>
    <input id="lc_youtube_url" type="text" name="heritage_theme_social_options[lc_youtube_url]" size="150" value="<?php echo esc_url($youtube_url); ?>"/>
    <?php
}

function HERITAGE_pinterest_url_cbk() {
    $pinterest_url = HERITAGE_get_theme_option('heritage_theme_social_options', 'lc_pinterest_url');

    ?>
    <input id="lc_pinterest_url" type="text" name="heritage_theme_social_options[lc_pinterest_url]" size="150" value="<?php echo esc_url($pinterest_url); ?>"/>
    <?php
}

/*
    Footer Options
 */

function HERITAGE_copyright_text_cbk() {
    $copyright_text = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_copyright_text');
    ?>
    <textarea  cols="147" rows="10" id="lc_copyright_text" name="heritage_theme_footer_options[lc_copyright_text]" ><?php echo esc_html($copyright_text); ?></textarea>;
    <?php
}

function HERITAGE_copyright_url_cbk() {
    $copyright_url = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_copyright_url');
    ?>
    <input type="text" size="147" id="lc_copyright_url" name="heritage_theme_footer_options[lc_copyright_url]" value="<?php echo esc_url_raw($copyright_url)?>"/>
    <?php
}

function HERITAGE_copyright_put_social_cbk() {
    $put_social_footer = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_copyright_put_social');
    if (empty($put_social_footer)) {
        $put_social_footer = 'enabled';
    }

    $put_social_footer_vals = array(
        esc_html__('Enabled', 'heritage')  => 'enabled',
        esc_html__('Disabled', 'heritage') => 'disabled'
    );
    ?>
    <select id="lc_copyright_put_social" name="heritage_theme_footer_options[lc_copyright_put_social]">
        <?php HERITAGE_render_select_options($put_social_footer_vals, $put_social_footer); ?>
    </select>

    <p class="description">
        <?php echo esc_html__('Place social profiles icons on copyright area.', 'heritage'); ?>
        <?php echo esc_html__('Please make sure that copyright text is filled in the above field.', 'heritage'); ?>
    </p>
    <?php
}

function HERITAGE_footer_widget_bgcolor_cbk() {
    $footer_background_color = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_footer_widgets_background_color');
    $default_bg_color = 'rgba(255, 255, 255, 0)';

    if ('' == $footer_background_color) {
        $footer_background_color = $default_bg_color;
    }
    ?>

    <input type="text" id="lc_footer_widgets_background_color" class="alpha-color-picker-settings" name="heritage_theme_footer_options[lc_footer_widgets_background_color]" value="<?php echo esc_attr($footer_background_color); ?>" data-default-color="rgba(255, 255, 255, 0)" data-show-opacity="true" />

    <p class="description">
        <?php echo esc_html__('Color overlay for the footer widgets area. Can be used as background color or as color over the background image.', 'heritage'); ?>
    </p>
    <?php
}

function HERITAGE_copyright_bgc_cbk() {
    $copy_bgc = HERITAGE_get_theme_option('heritage_theme_footer_options', 'lc_copyright_text_bg_color');
    $default_copy_bgc = 'rgba(255, 255, 255, 0)';

    if ('' == $copy_bgc) {
        $copy_bgc = $default_copy_bgc;
    }
    ?>

    <input type="text" id="lc_copyright_text_bg_color" class="alpha-color-picker-settings" name="heritage_theme_footer_options[lc_copyright_text_bg_color]" value="<?php echo esc_html($copy_bgc); ?>" data-default-color="rgba(255, 255, 255, 0)" data-show-opacity="true" />

    <p class="description">
        <?php echo esc_html__('Background color for the copyright text area.', 'heritage'); ?>
    </p>
    <?php
}

/*
	Contact Options
*/
function HERITAGE_lc_contact_address_cbk() {
    $contact_address = HERITAGE_get_theme_option('heritage_theme_contact_options', 'lc_contact_address');
    ?>
    <input type="text" size="200" id="lc_contact_address" name="heritage_theme_contact_options[lc_contact_address]" value="<?php echo esc_attr($contact_address); ?>" />
    <?php
}

function HERITAGE_lc_contact_phone_cbk() {
    $contact_phone = HERITAGE_get_theme_option('heritage_theme_contact_options', 'lc_contact_phone');
    ?>
    <input type="text" size="50" id="lc_contact_phone" name="heritage_theme_contact_options[lc_contact_phone]" value="<?php echo esc_attr($contact_phone); ?>" />
    <?php
}

function HERITAGE_lc_contact_fax_cbk() {
    $contact_fax = HERITAGE_get_theme_option('heritage_theme_contact_options', 'lc_contact_fax');
    ?>
    <input type="text" size="50" id="lc_contact_fax" name="heritage_theme_contact_options[lc_contact_fax]" value="<?php echo esc_attr($contact_fax); ?>" />
    <?php
}

function HERITAGE_lc_contact_email_cbk() {
    $contact_email = sanitize_email(HERITAGE_get_theme_option('heritage_theme_contact_options', 'lc_contact_email'));
    ?>
    <input type="text" size="50" id="lc_contact_email" name="heritage_theme_contact_options[lc_contact_email]" value="<?php echo esc_attr($contact_email); ?>" />
    <p class="description">
        <?php
        echo esc_html__("This is the email address shown on contact page.", "heritage");
        ?> <br> <?php
        echo esc_html__("To set the recipient email for the contact form, please go to Settings - Heritage Core Settings.", "heritage");
        ?>
    </p>
    <?php
}

/**
 * SHOP OPTIONS
 */

function HERITAGE_lc_products_view_mode() {
    $products_view_mode = HERITAGE_get_theme_option( 'heritage_theme_shop_options', 'lc_products_view_mode' );

    if ( empty( $products_view_mode ) ) {
        $products_view_mode = 'grid';
    }

    $view_modes = array(
        esc_html__( 'Grid', 'heritage' ) => 'grid',
        esc_html__( 'List', 'heritage' )  => 'list',
    );

    ?>
    <select id="lc_products_view_mode" name="heritage_theme_shop_options[lc_products_view_mode]">
        <?php HERITAGE_render_select_options( $view_modes, $products_view_mode ); ?>
    </select>

    <p class="description">
        <?php echo esc_html__( 'Select product list view mode', 'heritage' ); ?>
    </p>
    <?php
}


function HERITAGE_lc_products_per_row() {
    $products_per_row = HERITAGE_get_theme_option( 'heritage_theme_shop_options', 'lc_products_per_row' );

    if ( !intval( $products_per_row ) ) {
        $products_per_row = 4;
    }

    $columns = array(
        esc_html__( '3 Columns', 'heritage' ) => '3',
        esc_html__( '4 Columns', 'heritage' )  => '4',
        esc_html__( '5 Columns', 'heritage' )  => '5'
    );

    ?>
    <select id="lc_products_per_row" name="heritage_theme_shop_options[lc_products_per_row]">
        <?php HERITAGE_render_select_options( $columns, $products_per_row ); ?>
    </select>

    <p class="description">
        <?php echo esc_html__( 'Select number of products per row in products lists (grid mode)', 'heritage' ); ?>
    </p>
    <?php
}


/*
	UTILS FOR THEME SETTINGS
*/

function HERITAGE_get_theme_option($option_group, $option_name)
{
    $options = get_option($option_group);

    if (isset($options[$option_name])) {
        return $options[$option_name];
    }

    return '';
}

function HERITAGE_render_select_options($options, $selected) {
    if (empty($selected)) {
        return;
    }

    foreach($options as $key => $value) { ?>
        <option <?php selected( $selected, esc_attr( $value ) ) ?> value="<?php echo esc_attr( $value ); ?>">
            <?php echo esc_attr( $key ); ?>
        </option>
    <?php }
}


