<?php
$header_width = esc_attr(HERITAGE_get_header_footer_width());
/*create class: lc_swp_full/lc_swp_boxed*/
$header_width = 'lc_swp_'.$header_width;

/*sticky menu*/
$header_class = '';
if (HERITAGE_is_sticky_menu()) {
    $header_class = 'lc_sticky_menu';
}

/*custom menu styling*/
$page_logo = $menu_bar_bg = $menu_txt_col = $above_menu_bg = $above_menu_txt_col = "";
$has_custom_menu_styling = HERITAGE_get_page_custom_menu_style($page_logo, $menu_bar_bg, $menu_txt_col, $above_menu_bg, $above_menu_txt_col);

if ($has_custom_menu_styling) {
    $header_class .= ' cust_page_menu_style';
}
?>

<header id="at_page_header" class="<?php echo esc_attr($header_class); ?>" data-menubg="<?php echo esc_attr($menu_bar_bg); ?>" data-menucol="<?php echo esc_attr($menu_txt_col); ?>">
    <div class="header_inner centered_menu lc_wide_menu <?php echo esc_attr($header_width); ?>">

        <div class="centered_left social_profiles_center_menu">
            <?php get_template_part('views/templates/social_profiles'); ?>
        </div>

        <div id="logo" class="centered_menu">
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
                'container_class'	=> 'centered_menu classic_menu',
                'walker'			=> $customWalker
            )
        );
        ?>

        <div class="classic_header_icons centered_menu">
            <div class="classic_header_icon centered_menu lc_search trigger_global_search vibrant_hover transition4">
                <span class="lnr lnr-magnifier"></span>
            </div>

            <?php
            if (HERITAGE_is_woocommerce_active()) {
                ?>

                <div class="classic_header_icon centered_menu shop_icon heritage-minicart-icon">
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
    <?php
    /*mobile menu*/
    get_template_part('templates/menu/mobile_menu');
    ?>
</header>
