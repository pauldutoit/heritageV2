<?php
/**
 *  Minicart
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">

    <?php if ( ! WC()->cart->is_empty() ) : ?>
        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
                <li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <?php if ( ! $_product->is_visible() ) : ?>
                        <div class="minicart-item-product-image">
                            <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                        </div>
                        <span class="minicart-item-product-name"><?php echo esc_html($product_name); ?></span>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $product_permalink ); ?>" class="minicart-item-product-image">
                            <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                        </a>
                        <a href="<?php echo esc_url( $product_permalink ); ?>" class="minicart-item-product-name">
                            <span><?php echo esc_html($product_name); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php
                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                        esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                        esc_html__( 'Remove this item', 'heritage' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                    ), $cart_item_key );
                    ?>

                    <?php echo WC()->cart->get_item_data( $cart_item ); ?>

                    <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity',
                        '<span class="quantity">' . esc_html__( 'Qty', 'heritage' ) . sprintf( ': %s', $cart_item['quantity'] ) . '</span>',
                        $cart_item,
                        $cart_item_key ); ?>
                </li>
                <?php
            }
        }
        ?>

    <?php else : ?>

        <li class="empty"><?php esc_html_e( 'No products in the cart.', 'heritage' ); ?></li>

    <?php endif; ?>

</ul><!-- end product list -->

<?php if ( ! WC()->cart->is_empty() ) : ?>
    <p class="total"><strong><?php esc_html_e( 'Subtotal', 'heritage' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

    <p class="buttons">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
           class="button heritage-swp-add_to_cart wc-forward"><?php esc_html_e( 'View Cart', 'heritage' ); ?></a>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php esc_html_e( 'Checkout', 'heritage' ); ?></a>
    </p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
