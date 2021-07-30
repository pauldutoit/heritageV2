<?php
/**
 * Created by PhpStorm.
 * User: th
 * Date: 8 Iun 2017
 * Time: 16:36
 */


function ARTEMIS_SWP_login() {
    $nonce_value = isset( $_POST['_wpnonce'] ) ? $_POST['_wpnonce'] : '';
    $nonce_value = isset( $_POST['artemis-swp-login-nonce'] ) ? $_POST['artemis-swp-login-nonce'] : $nonce_value;

    if ( ! empty( $_POST['login'] ) ) {
        if ( wp_verify_nonce( $nonce_value, 'artemis_swp-login' ) ) {

            try {
                $creds    = array();
                $username = trim( $_POST['username'] );

                $validation_error = new WP_Error();
                $validation_error = apply_filters( 'artemis_swp_process_login_errors', $validation_error, $_POST['username'], $_POST['password'] );

                if ( $validation_error->get_error_code() ) {
                    throw new Exception( '<strong>' . esc_html__( 'Error', 'artemis-swp' ) . ':</strong> ' . $validation_error->get_error_message() );
                }

                if ( empty( $username ) ) {
                    throw new Exception( '<strong>' . esc_html__( 'Error', 'artemis-swp' ) . ':</strong> ' . esc_html__( 'Username is required.', 'artemis-swp' ) );
                }

                if ( empty( $_POST['password'] ) ) {
                    throw new Exception( '<strong>' . esc_html__( 'Error', 'artemis-swp' ) . ':</strong> ' . esc_html__( 'Password is required.', 'artemis-swp' ) );
                }

                if ( is_email( $username ) && apply_filters( 'artemis_swp_get_username_from_email', true ) ) {
                    $user = get_user_by( 'email', $username );

                    if ( isset( $user->user_login ) ) {
                        $creds['user_login'] = $user->user_login;
                    } else {
                        throw new Exception( '<strong>' . esc_html__( 'Error', 'artemis-swp' ) . ':</strong> ' . esc_html__( 'No user could be found with this email address.', 'artemis-swp' ) );
                    }

                } else {
                    $creds['user_login'] = $username;
                }

                $creds['user_password'] = $_POST['password'];
                $creds['remember']      = isset( $_POST['rememberme'] );
                $secure_cookie          = is_ssl() ? true : false;
                $user                   = wp_signon( apply_filters( 'artemis_swp_login_credentials', $creds ), $secure_cookie );

                if ( is_wp_error( $user ) ) {
                    $message = $user->get_error_message();
                    $message = str_replace( '<strong>' . esc_html( $creds['user_login'] ) . '</strong>', '<strong>' . esc_html( $username ) . '</strong>', $message );
                    throw new Exception( $message );
                } else {

                    if ( ! empty( $_POST['redirect'] ) ) {
                        $redirect = $_POST['redirect'];
                    } elseif ( wp_get_referer() ) {
                        $redirect = wp_get_referer();
                    } else {
                        $redirect = wc_get_page_permalink( 'myaccount' );
                    }
                    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
                        echo json_encode( array( 'success' => true ) );
                    } else {
                        wp_redirect( apply_filters( 'artemis_swp_login_redirect', $redirect, $user ) );
                    }
                }
            } catch ( Exception $e ) {
                if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
                    echo json_encode( array( 'success' => false, 'message' => $e->getMessage() ) );
                } else {
                    wc_add_notice( apply_filters( 'login_errors', $e->getMessage() ), 'error' );
                }
            }
            exit;
        } else {
            if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Bad Request', 'artemis-swp' ) ) );
                exit;
            }
        }
    }
}

add_action( 'wp_loaded', 'ARTEMIS_SWP_login' );
add_action( 'wp_ajax_artemis_swp_ajax_login', 'ARTEMIS_SWP_login' );
add_action( 'wp_ajax_nopriv_artemis_swp_ajax_login', 'ARTEMIS_SWP_login' );


function ARTEMIS_SWP_ajax_search() {
    $search_term = sanitize_text_field( $_POST['search_term'] );
    $args        = array(
        'post_type'   => array( 'post', 'product' ),
        'post_status' => 'publish',
        's'           => $search_term,
        'orderby'     => array(
            'post_type'  => 'DESC',
            'post_title' => 'ASC'
        )
    );
    $query       = new WP_Query( $args );
    ob_start();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $thumb     = get_the_post_thumbnail( get_the_ID(), array( 25, 25 ) );
            $content   = '';
            $title     = get_the_title();
            $permalink = get_the_permalink();

            $result_class = "artemis_swp_search_post";
            if (
                ARTEMIS_SWP_is_woocommerce_active()
                && 'product' == get_post_type()
            ) {
                $wc_product = wc_get_product( get_the_ID() );
                if ( $wc_product ) {
                    $thumb   = $wc_product->get_image( array( 25, 25 ) );
                    $content = $wc_product->get_price_html();
                    $title   = $wc_product->get_title();

                    $result_class .= " search_result_product";
                }
            } else {
                $result_class .= " search_result_post";
            }
            ?>
            <a href="<?php echo esc_attr( $permalink ) ?>"
               title="<?php echo esc_attr( $title ) ?>"
               class="<?php echo esc_attr( $result_class ); ?>">
                <div class="artemis_swp_post_image">
                    <?php
                    echo wp_kses_post( $thumb );
                    ?>
                </div>
                <div class="artemis_swp_post_title">
                    <span class="search_result_post_title">
                            <?php echo wp_kses_post( $title ); ?>
                    </span>
                    <?php echo wp_kses_post( $content ); ?>
                </div>
            </a>
            <?php
        }
    } else {
        ?><p><?php echo esc_html__( 'Sorry, no pages matched your criteria.', 'artemis-swp' ); ?></p><?php
    }
    $posts = ob_get_clean();
    echo json_encode( array(
        'posts' => $posts
    ) );
    die();
}

add_action( 'wp_ajax_artemis_swp_ajax_search', 'ARTEMIS_SWP_ajax_search' );
add_action( 'wp_ajax_nopriv_artemis_swp_ajax_search', 'ARTEMIS_SWP_ajax_search' );
