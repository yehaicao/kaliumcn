<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php # start: modified by Arlind ?>
<?php
$registration_allowed = get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes';
?>
<div class="section-title">
	<h1><?php
		if( $registration_allowed ) {
			_e( 'Login or Register', 'kalium' );
		} else {
			_e( 'Login', 'woocommerce' );
		}
	?></h1>
	<p><?php _e( 'Manage your account and see your orders', 'kalium' ); ?></p>
</div>
<?php # end: modified by Arlind ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="col2-set row" id="customer_login">

	<div class="col-1<?php echo $registration_allowed ? ' col-md-6' : ''; ?>">

<?php endif; ?>

		<form method="post" class="login message-form">

			<?php do_action( 'woocommerce_login_form_start' ); ?>
				
			<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

			<?php # start: modified by Arlind ?>
			<div class="form-group absolute">
				<div class="placeholder"><label for="username"><?php _e( 'Username', 'kalium' ); ?> <span class="required">*</span></label></div>
				<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</div>
			<div class="form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
				<input class="input-text" type="password" name="password" id="password" />
			</div>
			<?php # end: modified by Arlind ?>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<?php # start: modified by Arlind ?>
			<div class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="replaced-checkboxes" />
				
				<label for="rememberme" class="remember-me-row">
					<?php _e( 'Remember me', 'woocommerce' ); ?>
				</label>
				
				<div class="clear"></div>
				
				<p class="lost_password pull-right">
					<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>
				
				<input type="submit" class="button btn btn-primary" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
			</div>
			<?php # end: modified by Arlind ?>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="col-2 col-md-6">

		<form method="post" class="register message-form">

			<?php do_action( 'woocommerce_register_form_start' ); ?>
				
			<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

			<?php # start: modified by Arlind ?>
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<div class="form-row form-row-wide form-group absolute">
					<div class="placeholder"><label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label></div>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</div>

			<?php endif; ?>

			<div class="form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label></div>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</div>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<div class="form-row form-row-wide form-group absolute">
					<div class="placeholder"><label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
					<input type="password" class="input-text" name="password" id="reg_password" />
				</div>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-register' ); ?>
				<input type="submit" class="button btn btn-primary" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
			</p>
			<?php # end: modified by Arlind ?>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
