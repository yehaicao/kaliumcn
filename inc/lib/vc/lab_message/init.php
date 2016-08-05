<?php
/**
 *	Message Box
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'info.png';

vc_map( array(
	'base'             => 'lab_message',
	'name'             => 'Alert Box',
	"description"      => "Theme styled alerts",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'           => 'dropdown',
			'heading'        => 'Message Type',
			'param_name'     => 'type',
			'std'            => 'default',
			'admin_label'    => true,
			'value'          => array(
				'Default'   => 'default',
				'Info'      => 'info',
				'Success'   => 'success',
				'Warning'   => 'warning',
				'Error'     => 'error',
			),
			'description' => 'Select the type of the alert message.'
		),
		array(
			'type'           => 'textarea_safe',
			'heading'        => 'Message',
			'param_name'     => 'message',
			'description'    => 'Enter your message to display in the dialogue, you can include HTML tags too.'
		),
		array(
			'type' => 'checkbox',
			'heading' => 'Close Button',
			'param_name' => 'close_button',
			'value' => array(
				'Allow user to dismiss the alert (X - icon)' => 'yes',
			)
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

class WPBakeryShortCode_Lab_Message extends WPBakeryShortCode {}