<?php
/**
 *	Tabs Custom
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Tabs Extra Params
add_action('vc_after_init', 'lab_vc_custom_tabs');

function lab_vc_custom_tabs() {
	$tabs_style = array(
		'type'           => 'dropdown',
		'heading'        => 'Tabs Style',
		'param_name'     => 'tabs_style',
		'std'            => 'default',
		'weight'		 => 1,
		'value'          => array(
			'Default' => 'default',
			'Minimal' => 'minimal',
		),
		'description' => 'Select tabs style.'
	);
	
	vc_add_param( 'vc_tabs', $tabs_style );
}


// Tabs style css class
add_filter( 'vc_shortcodes_css_class', 'lab_vc_shortcodes_css_class', 10, 3 );

function lab_vc_shortcodes_css_class( $css, $vc_element = '', $atts = array() ) {
	if ( $vc_element == 'vc_tabs' ) {
		if ( isset( $atts['tabs_style'] ) ) {
			$css .= ' tabs-style-' . $atts['tabs_style'];
		}
	}
	
	return $css;
}