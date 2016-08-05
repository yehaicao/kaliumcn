<?php
/**
 * Lost password form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<div class="bordered-block">
	
	<form method="post" class="lost_reset_password login message-form">
		
		
		<?php if( 'lost_password' == $args['form'] ) : ?>
			<h2><?php _e( 'Lost Password', 'woocommerce' ); ?></h2>
	
			<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>
			<br />
	
			<?php # start: modified by Arlind ?>
			<div class="form-row form-row-first form-group absolute">
					<div class="placeholder"><label for="user_login"><?php _e( 'Username or email', 'woocommerce' ); ?></label> </div>
					<input class="input-text" type="text" name="user_login" id="user_login" />
			</div>
			<?php # end: modified by Arlind ?>
	
		<?php else : ?>
			<?php # start: modified by Arlind ?>
			<h2><?php _e( 'New Password Form', 'kalium' ); ?></h2>
			<?php # end: modified by Arlind ?>
			
			<p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') ); ?></p>
			<br />
	
			<?php # start: modified by Arlind ?>
			<div class="form-row form-row-first form-group absolute">
				<div class="placeholder"><label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
				<input type="password" class="input-text" name="password_1" id="password_1" />
			</div>
			<div class="form-row form-row-last form-group absolute">
				<div class="placeholder"><label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
				<input type="password" class="input-text" name="password_2" id="password_2" />
			</div>
			<?php # end: modified by Arlind ?>
	
			<input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
			<input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />
	
		<?php endif; ?>
	
		<div class="clear"></div>
	
		<p class="form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<?php # start: modified by Arlind ?>
			<input type="submit" class="button btn btn-primary" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' ); ?>" />
			<?php # end: modified by Arlind ?>
		</p>
	
		<?php wp_nonce_field( $args['form'] ); ?>
	
	</form>

</div>

<?php # start: modified by Arlind ?>
<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" class="my-account-go-back"><?php _e( '&laquo; Go back', 'kalium' ); ?></a>
<?php # end: modified by Arlind ?>