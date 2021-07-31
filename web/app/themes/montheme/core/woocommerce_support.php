<?php


add_theme_support('woocommerce');


/**
 * Unhook the Woocommerce wrappers
 */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_main_content', 'woocommerce_breadcrumb', 20);

// add HERITAGE wrapper
add_action('woocommerce_before_main_content', 'HERITAGE_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'HERITAGE_woocommerce_wrapper_end', 10);

// view mode
add_action('init', 'HERITAGE_set_product_view_mode');
add_action('woocommerce_before_shop_loop', 'HERITAGE_show_grid_mode', 10);

// customization
add_action('woocommerce_before_shop_loop', 'HERITAGE_carpet_customization', 9);

// cart
add_action('woocommerce_cart_actions', 'HERITAGE_add_cart_buttons');

//minicart
add_action('woocommerce_widget_cart_item_quantity', 'HERITAGE_minicart_quantity', 10, 3);


//product image
add_action('woocommerce_after_product_images','HERITAGE_after_product_images');




function HERITAGE_set_product_view_mode() {
    if ( isset( $_REQUEST['mode'] ) ) {
        $grid_mode = intval( $_REQUEST['mode'] );
        if ( ! in_array( $grid_mode, array('grid', 'list') ) ) {
            $grid_mode = 'grid';
        }
        setcookie( 'heritage_products_view_mode', $grid_mode );
    }
}
add_action( 'init', 'HERITAGE_set_product_view_mode' );

if('grid' == HERITAGE_get_products_view_mode()){

    function HERITAGE_product_loop_top_container_open(){
        echo '<div class="at_product_loop_top_container">';
    }
    add_action('woocommerce_before_shop_loop_item', 'HERITAGE_product_loop_top_container_open', 5);

    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );

    function HERITAGE_open_product_list_mask() {
        global $post;
        echo '<div class="at_product_actions_mask lc_js_link" data-href="'. esc_attr(get_permalink($post->ID)) .'" data-atcot="0">';
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'HERITAGE_open_product_list_mask', 11 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'HERITAGE_quickview_button', 20 );

    function HERITAGE_close_product_list_mask() {
        echo "</div>";
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'HERITAGE_close_product_list_mask', 50);


    function HERITAGE_product_loop_top_container_close() {
        echo '</div>';
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'HERITAGE_product_loop_top_container_close', 100 );

    add_filter( 'loop_shop_columns', 'HERITAGE_get_products_per_row' );


    function HERITAGE_products_per_row_buttons( ) {
        $ppr = HERITAGE_get_products_per_row(); ?>
        <div class="at_products_per_row_container">
            <form id="at_products_per_page_form" method="get">
                <input type="hidden" id="at_products_per_row" name="products_per_row" value="<?php echo esc_attr($ppr) ?>">
                <?php echo __('Show Grid:', 'heritage') ?>
                <a href="#" data-per_page="3" class="at_products_per_row_item <?php echo esc_attr($ppr == 3 ? 'active' : ''); ?>">3</a>
                <a href="#" data-per_page="4" class="at_products_per_row_item <?php echo esc_attr($ppr == 4 ? 'active' : ''); ?>">4</a>
                <a href="#" data-per_page="5" class="at_products_per_row_item <?php echo esc_attr($ppr == 5 ? 'active' : ''); ?>">5</a>
                <?php
                // Keep query string vars intact
                foreach ( $_GET as $key => $val ) {
                    if ( 'products_per_row' === $key || 'submit' === $key ) {
                        continue;
                    }
                    if ( is_array( $val ) ) {
                        foreach ( $val as $innerVal ) {
                            echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                        }
                    } else {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                    }
                }
                ?>
            </form>
        </div>
        <?php
    }
    add_action( 'woocommerce_before_shop_loop', 'HERITAGE_products_per_row_buttons', 25 );

    function HERITAGE_set_products_per_row() {
        if ( isset( $_REQUEST['products_per_row'] ) ) {
            $ppr = intval( $_REQUEST['products_per_row'] );
            if ( 3 <= $ppr && $ppr <= 5 ) {
                setcookie( 'heritage_products_per_row', $ppr );
            }
        }
    }
    add_action( 'init', 'HERITAGE_set_products_per_row' );
}else{
    // list mode
    //before woocommerce_template_loop_product_link_open - 10
    add_action('woocommerce_before_shop_loop_item', create_function('', 'echo "<div class=\"at_product_image_container\">";'), 1);
    //remove product link wrapping image
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

    //before woocommerce_template_loop_product_title - 10
    add_action('woocommerce_shop_loop_item_title', create_function('', 'echo "</div>";'), 1);

    add_action('woocommerce_shop_loop_item_title', create_function('', 'echo "<div class=\"at_product_details_container\">";'), 2);


    add_action( 'woocommerce_after_shop_loop_item', 'HERITAGE_quickview_button', 20 );
    add_action( 'woocommerce_after_shop_loop_item', create_function( '', 'echo "</div>";' ), 50 );
}

function HERITAGE_woocommerce_wrapper_start() {

    /*todo: check product page type; if default => boxed*/
    $boxed_class = "lc_swp_boxed";
    if (is_product()) {
        if( /*heritage_SWP_get_product_page_template() != 'default'
                && heritage_SWP_get_product_page_template() != 'type_3'*/ true) { // diférente template (pas encore proposé)
            $boxed_class = "lc_swp_full";
        }
    }
    if (is_shop()) {
        $boxed_class = 'lc_swp_full'; //heritage_SWP_get_shop_width_class();
    }

    echo '<div class="lc_content_full '.esc_attr($boxed_class). ' lc_big_content_padding">';
}

function HERITAGE_woocommerce_wrapper_end() {
    echo '</div>';
}

function HERITAGE_show_grid_mode() {
    $grid_mode = HERITAGE_get_products_view_mode();
    ?>
    <div class="at_product_list_mode_container">
        <form id="at_product_list_mode_form">
            <input type="hidden" id="at_product_view_mode" name="mode" value="<?php esc_attr($grid_mode) ?>">
            <a data-mode="grid" class="at_product_list_mode grid <?php echo ( 'grid' == $grid_mode ) ? 'active' : '' ?>">
                <i class="fa fa-grid-view"></i>
            </a>
            <a data-mode="list" class="at_product_list_mode list <?php echo ( 'list' == $grid_mode ) ? 'active' : '' ?>">
                <i class="fa fa-list-view"></i>
            </a>
            <?php
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'mode' === $key || 'submit' === $key ) {
                    continue;
                }
                if ( is_array( $val ) ) {
                    foreach ( $val as $innerVal ) {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                    }
                } else {
                    echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                }
            }
            ?>
        </form>
    </div>
    <?php
}


/**
 * Cart
 */

function HERITAGE_add_cart_buttons() {
    $emptyCartUrl = add_query_arg( 'empty-cart', 1, wc_get_cart_url() ); ?>
    <a class="button alt at_clear_cart" href="<?php echo esc_url( $emptyCartUrl ) ?>">
        <?php echo esc_html__( 'Clear Shopping Cart', 'heritage' ) ?>
    </a>
    <?php
}

/**
 * VIDER LE PANIER
 *
 */

function HERITAGE_woocommerce_clear_cart_url() {
    global $woocommerce;

    if ( isset( $_GET['empty-cart'] ) ) {
        $woocommerce->cart->empty_cart();
    }
}
add_action( 'init', 'HERITAGE_woocommerce_clear_cart_url' );

/**
 * Minicart
 */

if(!function_exists('HERITAGE_minicart_quantity')){

    function HERITAGE_minicart_quantity($value, $cart_item, $cart_item_key){
        $output = '<dl>' .
            '<dt>' . esc_html__('Qty', 'heritage').  ':</dt>' .
            '<dd>' . sprintf('%s', $cart_item['quantity']).  '</dd>' .
            '</dl>';
        return $output;
    }
}

/** Sharing icons */

function HERITAGE_sharing_icons() {
    ?>
    <div class="at_share_product">
        <?php get_template_part('templates/utils/sharing_icons'); ?>
    </div>
    <div class="clearfix"></div>
    <?php
}
add_action( 'woocommerce_after_add_to_cart_form', 'HERITAGE_sharing_icons', 30 );


function HERITAGE_after_product_images() {
    global $post, $product, $woocommerce;
    ?>
    <div class="heritage_gallery_thumbnails clearfix img-container">
    <?php
    $attachment_ids = $product->get_gallery_image_ids();

    if ( has_post_thumbnail() ) {
        $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
        $image = wp_get_attachment_image( get_post_thumbnail_id(), apply_filters( 'single_product_small_thumbnail_size', 'thumbnail' ), 0 );

        echo apply_filters(
            'woocommerce_single_product_image_thumbnail_html',
            sprintf(
                '<a href="%s" class="%s" id="img-container" title="%s" class="wp-post-thumb-image">%s</a>',
                esc_url( $props['url'] ),
                'heritage_gallery_thumbnail active',
                esc_attr( $props['caption'] ),
                $image
            ),
            $post->ID
        );
    } else {
        $placeholder_src = wc_placeholder_img_src();
        printf( '<a href="%s" class="%s" title="%s" ><img src="%s" alt="%s" class="wp-post-thumb-image"/></a>',
            $placeholder_src,
            'heritage_gallery_thumbnail active',
            esc_html__( 'Awaiting product image', 'heritage' ),
            $placeholder_src,
            esc_html__( 'Awaiting product image', 'heritage' ) );
    }
    if ( $attachment_ids ) {
        foreach ( $attachment_ids as $attachment_id ) {

            $props = wc_get_product_attachment_props( $attachment_id, $post );

            if ( ! $props['url'] ) {
                continue;
            }

            echo apply_filters(
                'woocommerce_single_product_image_thumbnail_html',
                sprintf(
                    '<a href="%s" class="%s" title="%s">%s</a>',
                    esc_url( $props['url'] ),
                    'heritage_gallery_thumbnail',
                    esc_attr( $props['caption'] ),
                    wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'thumbnail' ), 0 )
                ),
                $attachment_id,
                $post->ID,
                ''//esc_attr( $image_class )
            );
        }

    }
    ?></div><?php
}

function HERITAGE_carpet_customization()
{
    /**  @TODO traduction **/
    ?>
    <div>
        <p><?= esc_attr("Pour ceux qui désirent un tapis unique et personnalisé sur le bout des ongles"); ?> <a href="<?= get_permalink(get_page_by_title('Customization')) ?>"> Personnaliser mon tapis </a></p>
    </div>
    <?php
}

function HERITAGE_quickview_button() {
    global $post;
    $quick_view_url = add_query_arg(
        array( 'action' => 'heritage_quick_view', 'product_id' => $post->ID ),
        admin_url( 'admin-ajax.php' )
    );
    echo '<span class="heritage_quickview_button">' .
        '<a data-src="' . esc_attr( $quick_view_url ) . '" ' .
        'title="' .esc_attr__( 'Quick View', 'heritage' ). '" ' .
        'data-caption="' .esc_attr( $post->post_title ). '" ' .
        'href="javascript:void(0)" ' .
        'data-type="ajax">' .
        '<i class="fa fa-eye"></i>' .
        '</a>' .
        '</span>';
}

function HERITAGE_quick_view_remove_additional() {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}
add_action('heritage_quick_view_before', 'HERITAGE_quick_view_remove_additional');

function HERITAGE_quick_view_post_class($classes){
    $classes[] = 'at_quick_view_container';
    $classes[] = 'product';
    return $classes;
}

function HERITAGE_quick_view_body_class($classes){
    $classes[] = 'woocommerce';
    $classes[] = 'at_quick_view';
    return $classes;
}

function HERITAGE_quick_view() {
    add_filter( 'body_class', 'HERITAGE_quick_view_body_class' );
    ?>

    <?php
    try {
        if ( ! HERITAGE_is_woocommerce_active() ) {
            throw new Exception( esc_html__( 'Product not available', 'heritage' ) );
        }
        if(class_exists('WC_Shortcodes')) {
            WC_Shortcodes::init();
        }
        $product_id = absint( $_GET['product_id'] );

        $meta_query = WC()->query->get_meta_query();

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 1,
            'no_found_rows'  => 1,
            'post_status'    => 'publish',
            'meta_query'     => $meta_query,
            'p'              => $product_id
        );

        if ( isset( $atts['id'] ) ) {
            $args['p'] = $atts['id'];
        }

        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, array('id' => $product_id) ) );

        if ( $products->have_posts() ) {
            remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
            add_filter( 'post_class', 'HERITAGE_quick_view_post_class' );
            while( $products->have_posts() ) {
                $products->the_post();
                global $product;

                if ( empty( $product ) || ! $product->is_visible() ) {
                    throw new Exception( 'Product not available', 'heritage' );
                }
                do_action('heritage_quick_view_before');
                get_template_part( 'templates/product-quick-view' );
                do_action( 'heritage_quick_view_after' );
            } // end of the loop.
        } else {
            throw new Exception( esc_html__( 'Product was not found', 'heritage' ) );
        }
    } catch( Exception $e ) {
        echo "<div class='at_error'>{$e->getMessage()}</div>";
    }
    ?>
    <?php exit;
}
add_action( 'wp_ajax_heritage_quick_view', 'HERITAGE_quick_view' );
add_action( 'wp_ajax_nopriv_heritage_quick_view', 'HERITAGE_quick_view' );


remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);
add_action('woocommerce_review_before_comment_text', 'woocommerce_review_display_rating', 10);


if(!function_exists('HERITAGE_create_size_taxonomy')) {

    function HERITAGE_create_size_taxonomy()
    {
        $attributes_tax_slugs = array_keys( wc_get_attribute_taxonomy_labels() );

        if (!in_array( 'size', $attributes_tax_slugs ) ) {
            $args = wc_create_attribute(array(
                'slug'    => 'size',
                'name'   => __( 'Size', 'heritage' ),
                'type'    => 'select',
                'orderby' => 'menu_order',
                'has_archives'  => false,
            ));
        }
        delete_transient('wc_attribute_taxonomies');
    }
}
add_action('init', 'HERITAGE_create_size_taxonomy', 0);