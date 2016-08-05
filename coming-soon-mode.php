<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $header_logo_class, $force_use_uploaded_logo, $force_custom_logo_image, $force_custom_logo_max_width, $coming_soon_mode_title;

add_filter( 'kalium_show_header', '__return_false' );
add_filter( 'kalium_show_footer', '__return_false' );

$header_logo_class                  = 'logo';
$force_use_uploaded_logo            = get_data( 'coming_soon_mode_use_uploaded_logo' );
$force_custom_logo_image            = get_data( 'coming_soon_mode_custom_logo_image' );
$force_custom_logo_max_width        = get_data( 'coming_soon_mode_custom_logo_max_width' );

$coming_soon_mode_countdown			= get_data( 'coming_soon_mode_countdown' );

$coming_soon_mode_title             = get_data( 'coming_soon_mode_title' );
$coming_soon_mode_description       = trim( get_data( 'coming_soon_mode_description' ) );

$coming_soon_mode_social_networks   = get_data( 'coming_soon_mode_social_networks' );

// Added in v1.8
$coming_soon_mode_custom_bg			= get_data( 'coming_soon_mode_custom_bg' );
$coming_soon_mode_custom_bg_id		= get_data( 'coming_soon_mode_custom_bg_id' );
$coming_soon_mode_custom_bg_size 	= get_data( 'coming_soon_mode_custom_bg_size' );

$coming_soon_mode_custom_bg_color	= get_data( 'coming_soon_mode_custom_bg_color' );
$coming_soon_mode_custom_txt_color	= get_data( 'coming_soon_mode_custom_txt_color' );

if ( $coming_soon_mode_custom_bg ) {
	$image = wp_get_attachment_image_src( $coming_soon_mode_custom_bg_id, 'original' );

	generate_custom_style( '.coming-soon-mode .wrapper', 'background: transparent !important;', '', true );
	generate_custom_style( '.coming-soon-mode', 'background: ' . ( $coming_soon_mode_custom_bg_color ? $coming_soon_mode_custom_bg_color : '' ) . ( is_array( $image ) ? ( ' url(' . $image[0] . ') ' ) : '' ) . ' no-repeat center center fixed !important; background-size: ' . $coming_soon_mode_custom_bg_size . ' !important;', '', true );
}

if ( $coming_soon_mode_custom_txt_color ) {
	generate_custom_style( '.coming-soon-container .message-container, .coming-soon-container .message-container .logo.logo-text, .coming-soon-container .countdown-holder, .coming-soon-container p, .message-container a', 'color: ' . $coming_soon_mode_custom_txt_color . ' !important;', '', true );
	generate_custom_style( '.message-container a:after', 'background-color: ' . $coming_soon_mode_custom_txt_color . ' !important;', '', true );
	
	generate_custom_style( '.coming-soon-container .social-networks-env a', 'background-color: ' . $coming_soon_mode_custom_txt_color . ' !important;', '', true );
}

if ( $coming_soon_mode_custom_bg_color ) {
	generate_custom_style( '.coming-soon-container .social-networks-env a i', 'color: ' . $coming_soon_mode_custom_bg_color . ' !important;', '', true );
}
// End of: Added in v1.8

add_filter( 'body_class', create_function( '$classes', '$classes[] = "bg-main-color coming-soon-mode"; return $classes;' ) );

if ( $coming_soon_mode_title ) {
	add_filter( 'document_title_parts', 'laborator_coming_soon_title', 100 );

	function laborator_coming_soon_title( $title, $sep = '&ndash;' ) {
		global $coming_soon_mode_title;
		return array( $coming_soon_mode_title );
	}
}

get_header();

?>
<div class="container">

	<div class="page-container">
    	<div class="coming-soon-container">
			<div class="message-container wow fadeIn">
				<?php get_template_part( 'tpls/logo' ); ?>
				<?php echo do_shortcode( wpautop( $coming_soon_mode_description ) ); ?>
			</div>

			<?php if ( $coming_soon_mode_countdown ) : ?>
			<div class="countdown-holder">
				<div class="col-sm-12">
					<ul class="countdown">
						<div class="row">
							<div data-wow-duration="1.0s" data-wow-delay="0.1" class="col-sm-offset-2 col-sm-2 col-xs-3 wow fadeIn">
				        		<span class="days">&nbsp;</span>
								<p class="timeRefDays" data-text="<?php _e( 'Days', 'kalium' ); ?>" data-text-singular="<?php _e( 'Day', 'kalium' ); ?>">&nbsp;</p>
							</div>
							<div data-wow-duration="1.5s" data-wow-delay="0.2" class="col-sm-2 col-xs-3 wow fadeIn">
								<span class="hours">&nbsp;</span>
								<p class="timeRefHours" data-text="<?php _e( 'Hours', 'kalium' ); ?>" data-text-singular="<?php _e( 'Hour', 'kalium' ); ?>">&nbsp;</p>
							</div>
							<div data-wow-duration="2.0s" data-wow-delay="0.35" class="col-sm-2 col-xs-3 wow fadeIn">
								<span class="minutes">&nbsp;</span>
								<p class="timeRefMinutes" data-text="<?php _e( 'Minutes', 'kalium' ); ?>" data-text-singular="<?php _e( 'Minute', 'kalium' ); ?>">&nbsp;</p>
							</div>
							<div data-wow-duration="2.5s" data-wow-delay="0.6" class="col-sm-2 col-xs-3 wow fadeIn">
								<span class="seconds">&nbsp;</span>
								<p class="timeRefSeconds" data-text="<?php _e( 'Seconds', 'kalium' ); ?>" data-text-singular="<?php _e( 'Second', 'kalium' ); ?>">&nbsp;</p>
							</div>
						</div>
					</ul>
				</div>
			</div>
			<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				$( ".countdown" ).countdown( {
					date: "<?php echo strtolower( date( 'd F Y H:i:s', strtotime( get_data( 'coming_soon_mode_date' ) ) ) ); ?>",
					format: "on"
				} );
			});
			</script>
			<?php endif; ?>

			<?php if ( $coming_soon_mode_social_networks ) : ?>
			<div class="social-networks-env wow fadeIn" data-wow-delay="0.2">
				<?php echo do_shortcode( '[lab_social_networks rounded]' ); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

</div>
<?php

get_footer();