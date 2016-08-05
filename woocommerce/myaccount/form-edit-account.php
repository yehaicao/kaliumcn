<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.1
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<?php # start: modified by Arlind ?>
<div class="section-title">
	<h1><?php _e( 'My Account', 'kalium' ); ?></h1>
	<p><?php _e( 'Edit your account details or change your password', 'kalium' ); ?></p>
</div>

<div class="bordered-block edit-account-block">
	<form class="edit-account login message-form" action="" method="post">
	
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
		
		<h2><?php _e( 'Personal Details', 'kalium' ); ?></h2>
	
		<div class="form-row form-row-first form-group absolute">
			<div class="placeholder"><label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label></div>
			<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</div>
		<div class="form-row form-row-first form-group absolute">
			<div class="placeholder"><label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label></div>
			<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</div>
		<div class="clear"></div>
	
		<div class="form-row form-row-first form-group absolute">
			<div class="placeholder"><label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label></div>
			<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</div>
		
		
		<h2 class="change-account-password-head">
			<?php _e( 'Password Change', 'kalium' ); ?>
			<small><?php _e( '(leave blank to leave unchanged)', 'kalium' ); ?></small>
		</h2>
	
		<fieldset>
			<legend><?php _e( 'Password Change', 'woocommerce' ); ?></legend>
	
			<div class="form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label></div>
				<input type="password" class="input-text" name="password_current" id="password_current" />
			</div>
			<div class="form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label></div>
				<input type="password" class="input-text" name="password_1" id="password_1" />
			</div>
			<div class="form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label></div>
				<input type="password" class="input-text" name="password_2" id="password_2" />
			</div>
		</fieldset>
		<div class="clear"></div>
	
		<?php do_action( 'woocommerce_edit_account_form' ); ?>
	
		<p>
			<?php wp_nonce_field( 'save_account_details' ); ?>
			<input type="submit" class="button btn btn-primary shop-btn" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
			<input type="hidden" name="action" value="save_account_details" />
		</p>
	
		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	
	</form>
</div>

<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" class="my-account-go-back"><?php _e( '&laquo; Go back', 'kalium' ); ?></a>
<?php # end: modified by Arlind ?>