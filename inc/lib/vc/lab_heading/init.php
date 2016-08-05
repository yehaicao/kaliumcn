<?php
/**
 *	Heading Title
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'heading.png';


vc_map( array(
	'base'             => 'lab_heading',
	'name'             => 'Heading',
	"description"      => "Title and description",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'admin_label'    => true,
			'value'          => 'Heading title'
		),
		array(
			'type'       => 'textarea',
			'heading'    => 'Content',
			'param_name' => 'content',
			'value'      => 'Enter your description about the heading title here.'
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

class WPBakeryShortCode_Lab_Heading extends WPBakeryShortCode {}