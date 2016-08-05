<?php
/**
 *	Laborator Button
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'button.png';

$colors_arr = array(
	'Primary'    => 'btn-primary',
	'Secondary'  => 'btn-secondary',
	'Black'      => 'btn-black',
	'Blue'       => 'btn-blue',
	'Red'        => 'btn-red',
	'Green'      => 'btn-green',
	'Yellow'     => 'btn-yellow',
	'White'      => 'btn-white',
);

vc_map( array(
	'base'             => 'lab_button',
	'name'             => 'Button',
	"description"      => "Insert button link",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Button Title',
			'param_name'     => 'title',
			'admin_label'    => true,
			'value'          => ''
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'Button Link',
			'param_name'     => 'link',
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Button Type',
			'param_name'     => 'type',
			'std'            => 'default',
			'admin_label'    => true,
			'value'          => array(
				'Standard'                          => 'standard',
				'Outlined'                          => 'outlined',
				'Outlined with Hover Background'    => 'outlined-bg',
				'Flip Hover'                        => 'fliphover',
			),
			'description' => 'Set spacing for logo columns.'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Button Size',
			'param_name'     => 'size',
			'std'            => 'btn-normal',
			'value'          => array(
				'Mini'      => 'btn-mini',
				'Small'     => 'btn-small',
				'Normal'    => 'btn-normal',
				'Large'     => 'btn-large',
			),
			'description' => 'Set spacing for logo columns.'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Background Color',
			'param_name'     => 'button_bg',
			'value'          => array_merge( $colors_arr, array( 'Custom color' => 'custom' ) ),
			'std'            => 'btn-primary',
			'description'    => 'Select button background (and/or border) color.'
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Custom Background Color',
			'param_name'     => 'button_bg_custom',
			'description'    => 'Custom background color for button.',
			'dependency'     => array(
				'element'   => 'button_bg',
				'value'     => array( 'custom' )
			),
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Custom Text Color',
			'param_name'     => 'button_txt_custom',
			'description'    => 'Custom text color for button.',
			'dependency'     => array(
				'element'   => 'button_bg',
				'value'     => array( 'custom' )
			),
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Custom Text Color',
			'param_name'     => 'button_txt_hover_custom',
			'description'    => 'Custom text hover color for button (where applied).',
			'dependency'     => array(
				'element'   => 'button_bg',
				'value'     => array( 'custom' )
			),
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

class WPBakeryShortCode_Lab_Button extends WPBakeryShortCode {}