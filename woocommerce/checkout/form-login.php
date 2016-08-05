<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>';
?>
<?php # start: modified by Arlind ?>
<div class="checkout-info-box">
<?php wc_print_notice( $info_message, 'notice' ); ?>
</div>
<?php # end: modified by Arlind ?>

<div id="checkout-login-form-container" class="soft-hidden">
	<div class="login-form-env">
		<div class="bordered-block">
			<h2><?php _e( 'Login', 'kalium' ); ?></h2>
		<?php
			woocommerce_login_form(
				array(
					'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
					'redirect' => wc_get_page_permalink( 'checkout' ),
					'hidden'   => false
				)
			);
		?>
		</div>
	</div>
</div>