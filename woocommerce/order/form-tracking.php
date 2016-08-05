<?php
/**
 * Order tracking form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

?>
<?php # start: modified by Arlind ?>
<style>
	.wp-page-title {
		display: none;
	}
</style>
<?php # end: modified by Arlind ?>
<div class="bordered-block">
	
	<h2><?php the_title(); ?></h2>
	
	<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order login message-form">
	
		<p><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>
	
		<div class="form-row form-row-first form-group absolute"><div class="placeholder"><label for="orderid"><?php _e( 'Order ID', 'woocommerce' ); ?></label></div> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" /></div>
		<div class="form-row form-row-last form-group absolute"><div class="placeholder"><label for="order_email"><?php _e( 'Billing Email', 'woocommerce' ); ?></label></div> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', 'woocommerce' ); ?>" /></div>
		<div class="clear"></div>
	
		<br>
		
		<p class="form-row no-bottom-margin"><input type="submit" class="button btn btn-primary" name="track" value="<?php _e( 'Track', 'woocommerce' ); ?>" /></p>
		<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>
	
	</form>

</div>