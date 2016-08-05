<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $header_logo_class, $force_use_uploaded_logo, $force_custom_logo_image, $force_custom_logo_max_width;

$logo_text                      = get_data( 'logo_text' );
$use_uploaded_logo              = get_data( 'use_uploaded_logo' );
$custom_logo_image              = get_data( 'custom_logo_image' );
$custom_logo_max_width          = get_data( 'custom_logo_max_width' );
$custom_logo_mobile_max_width   = get_data( 'custom_logo_mobile_max_width' );

if ( ! $header_logo_class ) {
	$header_logo_class = 'header-logo';
}

if ( $force_use_uploaded_logo ) {
	$use_uploaded_logo     = $force_use_uploaded_logo;
	$custom_logo_image     = $force_custom_logo_image;
	$custom_logo_max_width = $force_custom_logo_max_width;
}

if ( $use_uploaded_logo ) {
	$logo_image = wp_get_attachment_image_src( $custom_logo_image, 'original' );

	if ( is_array( $logo_image ) ) {
		$logo_image_url = $logo_image[0];
		
		if ( ! $custom_logo_max_width ) {
			$custom_logo_max_width = $logo_image[1];
		}
	} else {
		$custom_logo_image = false;
	}

	// Custom Logo Width
	if ( $custom_logo_image && $custom_logo_max_width ) {
		generate_custom_style( '.logo-image', "width: {$custom_logo_max_width}px" );
	}

	// Custom Logo Mobile Width
	if ( $custom_logo_image && $custom_logo_mobile_max_width ) {
		generate_custom_style( '.logo-image', "width: {$custom_logo_mobile_max_width}px", 'screen and (max-width: 768px)' );
	}
}
?>
<a href="<?php echo apply_filters( 'kalium_logo_url', home_url() ); ?>" class="<?php 
	echo esc_attr( $header_logo_class );
	when_match( $use_uploaded_logo, 'logo-image', 'logo-text' );
?>">
<?php if ( $use_uploaded_logo && isset( $logo_image_url ) ) : ?>
	<img src="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $logo_image_url ) ); ?>" width="<?php echo $logo_image[1]; ?>" height="<?php echo $logo_image[2]; ?>" class="main-logo" alt="<?php echo sanitize_title( get_bloginfo( 'name' ) ); ?>" />
<?php
else:
	echo esc_html( $logo_text );
endif; ?>
</a>