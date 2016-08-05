<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
?>

<?php # start: modified by Arlind ?>
<div class="checkout-info-box">
<?php wc_print_notice( $info_message, 'notice' ); ?>
</div>
<?php # end: modified by Arlind ?>

<form class="checkout_coupon" method="post" style="display:none">
	
	<?php # start: modified by Arlind ?>
	<div class="coupon-holder">
		
		<p class="form-row form-row-first">
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
		</p>
	
		<p class="form-row form-row-last">
			<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
		</p>
	
		<div class="clear"></div>
		
	</div>
	<?php # end: modified by Arlind ?>
</form>
