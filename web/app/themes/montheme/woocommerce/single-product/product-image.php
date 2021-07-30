<?php

/**
 * Single product image
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!is_product()) {
    return '';
}

global $post, $product;

$placeholder            = has_post_thumbnail() ? 'with-images' : 'without-images';
$columns                = apply_filters('woocommerce_product_thumbnails_columns', 4);
//$current_prod_template  = heritage_SWP_get_product_page_template();
$images_container_class = apply_filters('woocommerce_single_product_image_gallery_classes', array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . $placeholder,
    'woocommerce-product-gallery--columns-' . absint($columns),
    'images',
));
$li_class = "";
$custom_bg_color = '';
?>
<div class="<?php echo esc_attr(join(' ', array_map('sanitize_html_class', $images_container_class))); ?>"
     data-color="<?php echo esc_attr($custom_bg_color) ?>"
     data-columns="<?php echo esc_attr($columns); ?>">
	    <div class="image_gallery woocommerce-product-gallery__wrapper">
	        <ul>
	            <li class="<?php echo esc_attr($li_class); ?>">
	                <?php
                    if (has_post_thumbnail()) {
                        if (is_string($product)) {
                            $product = wc_get_product();
                        }

                        $attachment_count  = count($product->get_gallery_image_ids());
                        $props             = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
                        $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                        $thumbnail_post    = get_post($post_thumbnail_id);
                        $image_title       = $thumbnail_post->post_content;
                        $full_size_image   = wp_get_attachment_image_src($post_thumbnail_id, 'full');

                        $image_size = "shop_single";

                        $attributes = array(
                            'title'                   => $image_title,
                            'alt'                     => $props['alt'],
                            'data-src'                => $full_size_image[0],
                            'data-large_image'        => $full_size_image[0],
                            'data-large_image_width'  => $full_size_image[1],
                            'data-large_image_height' => $full_size_image[2],
                        );


                        $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', $image_size), $attributes);

                        $additional_container_class = "";

                        $html = sprintf(
                            '<div data-thumb="%s" class="woocommerce-product-gallery__image'.$additional_container_class.'"><a href="%s" class="woocommerce-main-image" title="%s" data-fancybox="images">%s</a></div>',
                            esc_url($props['url']),
                            esc_url($props['url']),
                            esc_attr($props['caption']),
                            $image
                        );
                    } else {
                        $html = '<div class="woocommerce-product-gallery__image--placeholder">';
                        $placeholder_src= wc_placeholder_img_src();
                        $html .= sprintf('<a href="%s" class="woocommerce-main-image" title="%s" data-fancybox="images">' .
                            '<img src="%s" alt="%s" class="wp-post-image"/></a>',
                            $placeholder_src,
                            esc_html__('Awaiting product image', 'heritage'),
                            $placeholder_src,
                            esc_html__('Awaiting product image', 'heritage')
                        );
                        $html .= '</div>';
                    }
                    echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($post->ID));
                    ?>
	            </li>
                <?php do_action('woocommerce_product_thumbnails'); ?>
	        </ul>
	    </div>

    <?php
    /**
     * @hooked HERITAGE_after_product_images - 10
     */
    do_action('woocommerce_after_product_images');
    ?>
	</div>

