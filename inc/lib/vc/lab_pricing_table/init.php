<?php
/**
 *	Pricing Table
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'pricing-table.png';


vc_map( array(
	'base'             => 'lab_pricing_table',
	'name'             => 'Pricing Table',
	"description"      => "Insert a pricing content table",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Plan Price',
			'param_name'     => 'plan_price',
			'description'    => 'Enter plan price, shown in bigger font. Example: <strong>58$</strong>',
		),
		array(
			'type'           => 'textarea',
			'heading'        => 'Plan Description',
			'param_name'     => 'plan_description',
			'description'    => 'Enter plan description that explains the price, Example: <strong>One client – one end product</strong>.<br>HTML markup is allowed.',
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'description'    => 'Main title for this pricing table entry. If you don\'t want to show it, simply leave it empty. (Optional)'
		),
		array(
			'type'           => 'textarea',
			'heading'        => 'Plan Features',
			'param_name'     => 'plan_features',
			'description'    => 'Enter plan features splitted in rows by new lines.<br>HTML markup is allowed.',
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'Action Link',
			'param_name'     => 'purchase_link',
			'value'          => '',
			'description'	 => 'Usually used as purchase link.'
		),
		
		array(
			'type'           => 'textfield',
			'heading'        => 'Extra class name',
			'param_name'     => 'el_class',
			'description'    => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
		),
		
		array(
			'type'           => 'colorpicker',
			'heading'	 	 => '<h3 style="font-weight:normal;">Pricing Table Colors</h3> Header background color',
			'param_name'     => 'header_background_color',
		),
		array(
			'type'           => 'colorpicker',
			'heading'	 	 => 'Header text color',
			'param_name'     => 'header_text_color',
		),
		
		array(
			'type'           => 'colorpicker',
			'heading'	 	 => 'Title background color',
			'param_name'     => 'title_background_color',
		),
		array(
			'type'           => 'colorpicker',
			'heading'	 	 => 'Title text color',
			'param_name'     => 'title_text_color',
		),
		
		array(
			'type'           => 'colorpicker',
			'heading'	 	 => 'Action link background color',
			'param_name'     => 'purchase_background_color',
		),
		array(
			'type'           => 'colorpicker',
			'heading'	 	 => 'Action link text color',
			'param_name'     => 'purchase_text_color',
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => 'Design options'
		)
	)
) );

class WPBakeryShortCode_Lab_Pricing_Table extends WPBakeryShortCode {}