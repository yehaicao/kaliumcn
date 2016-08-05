<?php
/**
 *	Clients Logos
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $client_logo_index, $columns_count, $reveal_effect, $hover_style, $img_size;

if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$element_id = 'client-logos-' . mt_rand( 100000, 999999 );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts ) . vc_shortcode_custom_css_class( $css, ' ' );

$css_class = "lab-clients-logos logos-holder {$css_class}";

// Column Spacing
if ( $column_spacing == 'no' ) {
	$css_class .= ' no-spacing-cols';
}

// Image Borders
if ( $image_borders == 'no' ) {
	$css_class .= ' no-image-borders';
}

// Thumb Size
if ( ! $img_size ) {
	$img_size = "thumbnail";
}

// Alternate Height
if ( is_numeric( $height ) && $height > 0 ) {
	$css_class .= ' alt-height';	
	generate_custom_style( "#{$element_id} .c-logo", "height: {$height}px; line-height: {$height}px;" );
}

// Hover BG
if ( $hover_bg ) {
	generate_custom_style( "#{$element_id} .c-logo .hover-state", "background-color: {$hover_bg};" );
}

// Hover Text
if ( $hover_txt ) {
	$hover_txt_selector = "#{$element_id} .c-logo .hover-state ";
	generate_custom_style( "{$hover_txt_selector} p, {$hover_txt_selector} a, {$hover_txt_selector} h3", "color: {$hover_txt};" );
}

// Show Team Members
$client_logo_index = 0;

?>
<div id="<?php echo esc_attr( $element_id ); ?>" class="<?php echo esc_attr( $css_class ); ?>">
	<div class="row">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</div>
</div>