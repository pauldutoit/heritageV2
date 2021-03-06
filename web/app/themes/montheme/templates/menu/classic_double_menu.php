<?php
$header_width = esc_attr(HERITAGE_get_header_footer_width());
/*create class: lc_swp_full/lc_swp_boxed*/
$header_width = 'lc_swp_'.$header_width;

/*sticky menu*/
$header_class = '';
if (HERITAGE_is_sticky_menu()) {
    $header_class = 'lc_sticky_menu';
}

$pre_header_class = 'pre_header clearfix classic_double_menu';

/*custom menu styling*/
$page_logo = $menu_bar_bg = $menu_txt_col = $above_menu_bg = $above_menu_txt_col = "";
$has_custom_menu_styling = HERITAGE_get_page_custom_menu_style($page_logo, $menu_bar_bg, $menu_txt_col, $above_menu_bg, $above_menu_txt_col);

if ($has_custom_menu_styling) {
    $header_class .= ' cust_page_menu_style';
    $pre_header_class .= ' cust_pre_header_style';
}
?>

<div class="<?php echo esc_attr($pre_header_class); ?> <?php echo esc_attr($header_width); ?>" data-prebg="<?php echo esc_attr($above_menu_bg); ?>" data-precol="<?php echo esc_attr($above_menu_txt_col); ?>">
    <div class="at_menu_message float_left">
        <?php echo esc_html(HERITAGE_get_menu_message()); ?>
    </div>

    <div class="classic_header_icons">
        <div class="classic_header_icon lc_search trigger_global_search vibrant_hover transition4">
            <span class="lnr lnr-magnifier"></span>
        </div>

        <?php
        if (HERITAGE_is_woocommerce_active()) {
            ?>

            <div class="classic_header_icon heritage-minicart-icon">
                <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html__('View your shopping cart', 'heritage'); ?>">
                    <i class="fa fa-heritage-cart" aria-hidden="true"></i>
                    <span class="cart-contents-count lc_swp_vibrant_bgc">
						<?php echo WC()->cart->get_cart_contents_count(); ?>
					</span>
                </a>

                <div class="heritage-minicart">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>

            <?php

        }
        ?>
    </div>
</div>

<header id="at_page_header" class="header_classic_double_menu <?php echo esc_attr($header_class); ?>" data-menubg="<?php echo esc_attr($menu_bar_bg); ?>" data-menucol="<?php echo esc_attr($menu_txt_col); ?>">
    <div class="header_inner lc_wide_menu <?php echo esc_attr($header_width); ?>">
        <div id="logo" class="relative_position">
            <?php
            $logo_img = HERITAGE_get_user_logo_img();
            if (!empty($logo_img)) {
                ?>

                <a href="<?php echo esc_url(home_url('/')); ?>" class="global_logo">
                    <img src="<?php echo esc_url($logo_img); ?>" alt="<?php bloginfo('name'); ?>">
                </a>

                <?php
            } else {
                ?>

                <a href="<?php echo esc_url(home_url('/')); ?>" class="global_logo">
                    <?php bloginfo('name'); ?>
                </a>

                <?php
            }

            /*custom page related logo*/
            if (!empty($page_logo)) {
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="cust_page_logo">
                    <img src="<?php echo esc_url($page_logo); ?>" alt="<?php bloginfo('name'); ?>">
                </a>
                <?php
            }
            ?>
        </div>



        <?php
        $customWalker = new FrontendWalkerNavMenu();

        /*render main menu*/
        wp_nav_menu(
            array(
                'theme_location'	=> 'main-menu',
                'container'			=> 'nav',
                'container_class'	=> 'classic_menu add_margin_left classic_double_menu',
                'walker'			=> $customWalker
            )
        );
        ?>

        <div class="at_login_wish">
            <?php if ( HERITAGE_is_woocommerce_active() ) { ?>
                <div class="at_login account_option">
                    <?php if ( is_user_logged_in() ) { ?>
                        <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"
                           title="<?php esc_html_e( 'My Account', 'heritage' ); ?>"><?php esc_html_e( 'My Account', 'heritage' ); ?></a>
                    <?php } else { ?>
                        <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"
                           class="<?php echo esc_attr( HERITAGE_is_login_popup_enabled() ? 'at_to_login_popup' : '' ) ?>"
                           title="<?php esc_html_e( 'Login / Register', 'heritage' ); ?>"><?php esc_html_e( 'Login / Register', 'heritage' ); ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
    /*mobile menu*/
    get_template_part('templates/menu/mobile_menu');
    ?>
</header>
