<?php

    $view_mode = HERITAGE_get_products_view_mode();
    $classes = 'mode-' . $view_mode;
    if('grid' == $view_mode){
        $products_per_row = HERITAGE_get_products_per_row();
        if(is_shop() || is_product_category()){
            $classes .= ' at_custom_prod_cols at_columns-' . $products_per_row;

        }
    }
    ?>
<ul class="products <?php echo esc_attr( $classes ) ?>">
