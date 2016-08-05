<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $maintenance_mode_title;

add_filter( 'kalium_show_header', '__return_false' );
add_filter( 'kalium_show_footer', '__return_false' );

$maintenance_mode_title         = trim( get_data( 'maintenance_mode_title' ) );
$maintenance_mode_description   = trim( get_data( 'maintenance_mode_description' ) );

add_filter( 'body_class', create_function( '$classes', '$classes[] = "bg-main-color maintenance-mode"; return $classes;' ) );

if ( $maintenance_mode_title ){
	add_filter( 'document_title_parts', 'laborator_maintenance_title', 100 );

	function laborator_maintenance_title( $title, $sep = '&ndash;' ){
		global $maintenance_mode_title;
		return array( $maintenance_mode_title );
	}
}

// Added in v1.8
$maintenance_mode_custom_bg			= get_data( 'maintenance_mode_custom_bg' );
$maintenance_mode_custom_bg_id		= get_data( 'maintenance_mode_custom_bg_id' );
$maintenance_mode_custom_bg_size 	= get_data( 'maintenance_mode_custom_bg_size' );

$maintenance_mode_custom_bg_color	= get_data( 'maintenance_mode_custom_bg_color' );
$maintenance_mode_custom_txt_color	= get_data( 'maintenance_mode_custom_txt_color' );

if ( $maintenance_mode_custom_bg ) {
	$image = wp_get_attachment_image_src( $maintenance_mode_custom_bg_id, 'original' );

	generate_custom_style( '.maintenance-mode .wrapper', 'background: transparent !important;', '', true );
	generate_custom_style( '.maintenance-mode', 'background: ' . ( $maintenance_mode_custom_bg_color ? $maintenance_mode_custom_bg_color : '' ) .  ( is_array( $image ) ? ( ' url(' . $image[0] . ') ' ) : '' ) . ' no-repeat center center scroll !important; background-size: ' . $maintenance_mode_custom_bg_size . ' !important;', '', true );
}

if ( $maintenance_mode_custom_txt_color ) {
	generate_custom_style( '.coming-soon-container p, .coming-soon-container a, .coming-soon-container .message-container', 'color: ' . $maintenance_mode_custom_txt_color . ' !important;', '', true );
	generate_custom_style( '.coming-soon-container a:after', 'background-color: ' . $maintenance_mode_custom_txt_color . ' !important;', '', true );
}
// End of: Added in v1.8

get_header();

?>
<div class="container">
	<div class="page-container">
    	<div class="coming-soon-container">
			<div class="message-container wow fadeIn">
				<i class="icon icon-ecommerce-megaphone"></i>
				<?php echo do_shortcode( wpautop( $maintenance_mode_description ) ); ?>
			</div>
		</div>
	</div>
</div>
<?php

get_footer();