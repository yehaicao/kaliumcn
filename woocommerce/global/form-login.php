<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login message-form" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<?php # start: modified by Arlind ?>
	<div class="form-row form-row-first form-group absolute">
		<div class="placeholder"><label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label></div>
		<input type="text" class="input-text" name="username" id="username" />
	</div>
	<div class="form-row form-row-last form-group absolute">
		<div class="placeholder"><label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
		<input class="input-text" type="password" name="password" id="password" />
	</div>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="form-row form-group remember-me-row">
		<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="replaced-checkboxes" />
		
		<label for="rememberme" class="inline">
			<?php _e( 'Remember me', 'woocommerce' ); ?>
		</label>
	</div>
	
	<div class="clear"></div>
	
	<p class="form-row pull-left">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<input type="submit" class="button btn btn-primary" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
	</p>
	<p class="lost_password pull-right">
		<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>
	<?php # end: modified by Arlind ?>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
