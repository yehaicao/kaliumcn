<?php
/**
 *	Google Map
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'map.png';

vc_map( array(
	'base'                     => 'lab_google_map',
	'name'                     => 'Map',
	"description"              => "Insert Google Map",
	'category'                 => 'Laborator',
	"content_element"          => true,
	"show_settings_on_create"  => true,
	'icon'                     => $lab_vc_element_icon,
	"as_parent"                => array('only' => 'lab_google_map_location'),
	'params' => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Map Height',
			'param_name'     => 'height',
			'value'			 => '400',
			'description'    => 'Set map container height.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Map Zoom',
			'param_name'     => 'zoom',
			'value'			 => '14',
			'description'    => 'Set map zoom level. Leave 0 to automatically fit to bounds.'
		),
		array(
			'type'           => 'checkbox',
			'heading'        => 'Map Toggles',
			'param_name'     => 'map_options',
			'std'            => 'map-style,scroll-zoom,drop-pins',
			'value'          => array(
				'Full width<br />' => 'fullwidth',
				'Pan by<br />' => 'pan-by',
				'Map Style<br />' => 'map-style',
				'Scroll Zoom<br />' => 'scroll-zoom',
				'Dropping Pins Animation' => 'drop-pins',
			),
			'description'    => 'Toggle map options.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Pan-by Params',
			'param_name'     => 'map_panby',
			'description'    => 'Enter panBy params: x:number, y:number. Example: <strong>50,25</strong> or <strong>50</strong> to move just X-axis',
			'dependency' => array(
				'element'   => 'map_options',
				'value'     => array('pan-by')
			),
		),
		array(
			'type'           => 'checkbox',
			'heading'        => 'Map Controls',
			'param_name'     => 'map_controls',
			'std'            => 'panControl,zoomControl,mapTypeControl,scaleControl',
			'value'          => array(
				'Pan Control<br />'             => 'panControl',
				'Zoom Control<br />'            => 'zoomControl',
				'Map Type Control<br />'        => 'mapTypeControl',
				'Scale Control<br />'           => 'scaleControl',
				'Street View Control<br />'     => 'streetViewControl',
				'Overview Map Control<br />'    => 'overviewMapControl',
				'Plus Minus Zoom<br />'    		=> 'plusMinusZoom',
			),
			'description'    => 'Toggle map options.'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Map Type',
			'param_name'     => 'map_type',
			'std'            => 'roadmap',
			'value'          => array(
				'Roadmap'   => 'roadmap',
				'Satellite' => 'satellite',
				'Hybrid'    => 'hybrid',
			),
			'description' => 'Choose map style.'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Map Tilt',
			'param_name'     => 'map_tilt',
			'std'            => '0',
			'value'          => array(
				'Normal'   => '0',
				'Tilt 45°' => '45',
			),
			'description' => 'This map type supports 45&deg; map tilt.',
			'dependency' => array(
				'element'   => 'map_type',
				'value'     => array('satellite', 'hybrid')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Map Heading',
			'param_name'     => 'map_heading',
			'description'    => 'Set the degree of rotation (0-360) for map tilt.',
			'dependency' => array(
				'element'   => 'map_tilt',
				'value'     => array('45')
			),
		),
		array(
			'type' => 'textarea_raw_html',
			#'holder' => 'div',
			'heading' => 'Map Style',
			'param_name' => 'map_style',
			'value' => '',
			'description' => 'Paste the style code here. Browse map styles in <a href="https://snazzymaps.com/" target="_blank">SnazzyMaps</a>'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Extra class name',
			'param_name'     => 'el_class',
			'description'    => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => 'Design options'
		)
	),
	"js_view" => 'VcColumnView'
) );

// Map Location (child of Google Map)
vc_map( array(
	"base"             => "lab_google_map_location",
	"name"             => "Map Location",
	"description"      => "Add map marker",
	"category"         => 'Laborator',
	"content_element"  => true,
	"icon"			   => $lab_vc_element_icon,
	"as_child"         => array('only' => 'lab_google_map'),
	"params"           => array(
		array(
			'type'           => 'attach_image',
			'heading'        => 'Marker Image',
			'param_name'     => 'marker_image',
			'value'          => '',
			'description'    => 'Add your Custom marker image or use default one.'
		),
		array(
			'type'           => 'checkbox',
			'heading'        => 'Retina Marker',
			'param_name'     => 'retina_marker',
			'std'            => '',
			'value'          => array(
				'Yes' => 'yes',
			),
			'description'    => 'Enabling this option will reduce the size of marker for 50%, example if marker is 32x32 it will be 16x16.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Latitude',
			'admin_label' 	 => true,
			'param_name'     => 'latitude',
			'value'			 => '',
			'description'    => 'Enter latitude coordinate. To select map coordinates <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">click here</a>.',
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Longitude',
			'admin_label' 	 => true,
			'param_name'     => 'longitude',
			'value'			 => '',
			'description'    => 'Enter longitude coordinate.',
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Marker Title',
			'admin_label' 	 => true,
			'param_name'     => 'marker_title',
			'value'			 => '',
		),
		array(
			'type'           => 'textarea_safe',
			'heading'        => 'Marker Description',
			'param_name'     => 'marker_description',
			'value'			 => '',
		)
	)
) );

class WPBakeryShortCode_Lab_Google_Map extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Lab_Google_Map_Location extends WPBakeryShortCode {}

add_action( 'wp_enqueue_scripts', 'lab_vc_google_map_enqueue' );

function lab_vc_google_map_enqueue() {
	$lab_vc_element_path   = dirname( __FILE__ ) . '/';
	$lab_vc_element_url    = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );

	wp_register_script( 'lab-vc-google-maps', THEMEURL . 'inc/lib/vc/lab_google_map/maps.js' );
}