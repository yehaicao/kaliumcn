<?php
/**
 *	Laborator Button
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $lab_button_ids;

if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

if ( ! isset( $lab_button_ids ) || ! $lab_button_ids ) {
	$lab_button_ids = 0;
}

$lab_button_ids++;
$btn_index = "btn-index-{$lab_button_ids}";

// Link 
$link = vc_build_link($link);

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "laborator-btn btn {$btn_index} btn-type-{$type} {$css_class}";

if ( $type == 'outlined-bg' || $type == 'fliphover' ) {
	$css_class .= ' btn-type-outlined';
}

if ( $button_bg != 'custom' ) {
	$css_class .= " {$button_bg}";
}

$css_class .= " {$size}";

// Custom Button Color
if ( $button_bg == 'custom') {
	switch ( $type ) {	
		case 'outlined' :
		case 'outlined-bg' :
		
			if ( $button_bg_custom ) {
				generate_custom_style( ".{$btn_index}", "border-color: {$button_bg_custom} !important;" );
				
				if ( $type == 'outlined-bg' ) {
					generate_custom_style( ".{$btn_index}:hover", "background: {$button_bg_custom} !important;" );
				}
			}
		
			if ( $button_txt_custom ) {
				generate_custom_style( ".{$btn_index}", "color: {$button_txt_custom} !important;" );
			}
			
			if ( $button_txt_hover_custom ) {
				generate_custom_style( ".{$btn_index}:hover", "color: {$button_txt_hover_custom} !important;" );
				generate_custom_style( ".{$btn_index}:hover", "border-color: {$button_txt_hover_custom} !important;" ); // May not be appropriate
			}
			break;
			
		case "fliphover":
			if ( $button_bg_custom ) {
				generate_custom_style( ".{$btn_index}", "border-color: {$button_bg_custom} !important;" );
				generate_custom_style( ".{$btn_index}:hover:before", "background-color: {$button_bg_custom} !important;" );
			}
			
			if ( $button_txt_custom ) {
				generate_custom_style( ".{$btn_index}", "color: {$button_txt_custom} !important;" );
			}
			
			if ( $button_txt_hover_custom ) {
				generate_custom_style( ".{$btn_index}:hover", "color: {$button_txt_hover_custom} !important;" );
			}
			break;
		
		default:
		
			if ( $button_bg_custom ) {
				generate_custom_style( ".{$btn_index}", "background: {$button_bg_custom} !important;" );
			}
			
			if ( $button_txt_custom ) {
				generate_custom_style( ".{$btn_index}", "color: {$button_txt_custom} !important;" );
			}
			
			if ( $button_txt_hover_custom ) {
				generate_custom_style( ".{$btn_index}:hover", "color: {$button_txt_hover_custom} !important;" );
			}
	}
}

?>
<a href="<?php echo esc_url( $link['url'] ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>"><?php echo esc_html( $title ); ?></a>
