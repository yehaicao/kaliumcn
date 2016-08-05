<?php
/**
 *	Dribbble Gallery
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'dribbble.png';


vc_map( array(
	'base'             => 'lab_dribbble_gallery',
	'name'             => 'Dribbble Gallery',
	"description"      => "Profile shots",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Dribbble Username',
			'param_name'     => 'username',
			'admin_label'    => true,
			'description'    => 'Enter Dribbble account username to fetch shots.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Dribbble Access Token',
			'param_name'     => 'access_token',
			'description'    => 'Dribbble API requires this information in order to work properly. To create an application <a href="http://developer.dribbble.com/" target="_blank">click here</a>.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Shots Count',
			'param_name'     => 'count',
			'value'     	 => '9',
			'description'    => 'Number of shots to retrieve. (Max: 12)'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Columns',
			'admin_label'    => true,
			'param_name'     => 'columns',
			'std'            => 'three',
			'value'          => array(
				'3 Items per Row'    => 'three',
				'4 Items per Row'    => 'four',
			),
			'description' => 'Number of columns to show dribbble shots.'
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'More Link',
			'param_name'     => 'more_link',
			'value'          => '',
			'description'	 => 'This will show "More" button in the end of portfolio items.'
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
	)
) );

class WPBakeryShortCode_Lab_Dribbble_Gallery extends WPBakeryShortCode {}