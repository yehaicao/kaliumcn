<?php
/**
 *	Featured Tab
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'services.png';

// Service Box (parent of icon box content and vc icon)
vc_map( array(
	"base"                     => "lab_service_box",
	"name"                     => "Service Box",
	"description"    		   => "Description with icon",
	"category"                 => 'Laborator',
	"content_element"          => true,
	"show_settings_on_create"  => false,
	"icon"                     => $lab_vc_element_icon,
	"as_parent"                => array('only' => 'vc_icon,lab_service_box_content'),
	"params"                   => array(
		array(
			"type"           => "textfield",
			"heading"        => "Extra class name",
			"param_name"     => "el_class",
			"description"    => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		),
		array(
            'type' => 'css_editor',
            'heading' => 'Css',
            'param_name' => 'css',
            'group' => 'Design options',
        ),
	),
	"js_view" => 'VcColumnView'
) );


# Box Content (child of Service Box)
vc_map( array(
	"base"             => "lab_service_box_content",
	"name"             => "Service Content",
	"description"      => "Describe your service",
	"category"         => 'Laborator',
	"content_element"  => true,
	"icon"			   => $lab_vc_element_icon,
	"as_child"         => array('only' => 'lab_service_box'),
	"params"           => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'admin_label'	 => true,
			'description'    => 'Title of the widget.',
		),
		array(
			'type'           => 'textarea',
			'heading'        => 'Description',
			'param_name'     => 'description',
			'description'    => 'Description about the service or the item you provide.',
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Text Alignment',
			'param_name'     => 'text_alignment',
			'std'            => 'left',
			'value'          => array(
				'Left'      => 'left',
				'Center'    => 'center',
				'Right'     => 'right',
			),
			'description' => 'Set number of columns for team members.'
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'Link',
			'param_name'     => 'link',
			'description'    => 'Make the title clickable (Optional).',
		),
		array(
			"type"           => "textfield",
			"heading"        => "Extra class name",
			"param_name"     => "el_class",
			"description"    => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		),
		array(
            'type' => 'css_editor',
            'heading' => 'Css',
            'param_name' => 'css',
            'group' => 'Design options',
        ),
	)
) );


class WPBakeryShortCode_Lab_Service_Box extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Lab_Service_Box_Content extends WPBakeryShortCode {}