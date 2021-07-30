<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version     3.0.2
 */

if (!defined('ABSPATH')) {
    exit;
}

global $post, $product;

if (is_string($product)) {
    $product = wc_get_product();
}
$attachment_ids = $product->get_gallery_image_ids();

if ($attachment_ids && has_post_thumbnail()) {
    $loop    = 0;
    $columns = apply_filters('woocommerce_product_thumbnails_columns', 3);

    $li_class              = "";
    //$current_prod_template = heritage_SWP_get_product_page_template();

    foreach ($attachment_ids as $attachment_id) {

        ?>
        <li class="thumbnails <?php echo esc_attr('columns-' . $columns) . ' ' . esc_attr($li_class); ?> "><?php
        $classes = array();

        if ($loop === 0 || $loop % $columns === 0) {
            $classes[] = 'first';
        }

        if (($loop + 1) % $columns === 0) {
            $classes[] = 'last';
        }

        $image_class = implode(' ', $classes);
        $props       = wc_get_product_attachment_props($attachment_id, $post);

        if (!$props['url']) {
            continue;
        }

        $image_size = 'shop_single';

        $attributes = array(
            'title'                   => $props['title'],
            'alt'                     => $props['alt'],
            'data-src'                => $props['url'],
            'data-large_image'        => $props['url'],
            'data-large_image_width'  => $props['full_src_w'],
            'data-large_image_height' => $props['full_src_h'],
        );

        $additional_container_class = "";

        $html = '<div data-thumb="' . esc_url($props['url']) . '" class="woocommerce-product-gallery__image'.$additional_container_class.'">';
        $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', $image_size), 0, $attributes);
        $html .= sprintf(
            '<a href="%s" class="%s" title="%s" data-fancybox="images">%s</a>',
            esc_url($props['url']),
            esc_attr($image_class),
            esc_attr($props['caption']),
            $image
        );
        $html .= '</div>';
        echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $attachment_id);

        $loop ++;
        ?></li><?php
    }
}
