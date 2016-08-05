<?php
/**
 *	Blog Posts Shortcode
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'divider.png';

vc_map( array(
	'base'             => 'lab_divider',
	'name'             => 'Divider',
	"description"      => "Text or plain divider",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => 'Type',
			'param_name' => 'type',
			'admin_label' => true,
			'std' => 'text',
			'value' => array(
				'Plain'           => 'plain',
				'Text Divider'    => 'text',
			),
			'description' => 'Select the type of divider, plain or text divider.'
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Divider Style',
			'param_name' => 'plain_style',
			'value' => array(
				'Saw Border'  => 'saw',
				'Thin Dash'   => 'thin',
				'Thick Dash'  => 'thick',
			),
			'description' => 'Select style of plain divider.',
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'plain' )
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Width',
			'param_name'     => 'plain_width',
			'description'    => 'Divider width in percentage unit 1-100, leave empty to use 100 percent as value.',
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'plain' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Divider Style',
			'param_name' => 'text_style',
			'value' => array(
				'Thick'           => '2',
				'Dotted'          => '5',
				'Striped'         => '6',
				'Double Border'   => '3',
				'Shadowed'        => '1',
				'Inverese'        => '4',
				'Saw'        		=> '7',
			),
			'description' => 'Select style of text divider.',
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'text' )
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'admin_label'    => true,
			'description'    => 'Divider title to display in the center.',
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'text' )
			),
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Color',
			'param_name'     => 'plain_color',
			'description'    => 'Set custom border color, leave empty to use default.',
			'dependency'     => array(
				'element' => 'plain_style',
				'value' => array( 'thin', 'thick' )
			),
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Color',
			'param_name'     => 'text_color',
			'description'    => 'Set custom border color, leave empty to use default.',
			'dependency'     => array(
				'element' => 'text_style',
				'value' => array( '1', '2', '3', '4' )
			),
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Text Color',
			'param_name'     => 'text_color_font',
			'description'    => 'Set custom text color, leave empty to use default.',
			'dependency'     => array(
				'element' => 'type',
				'value' => array( 'text' )
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

class WPBakeryShortCode_Lab_Divider extends WPBakeryShortCode {}