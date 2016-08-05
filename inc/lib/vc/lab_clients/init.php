<?php
/**
 *	Client Logos Shortcode
 *
 *	Laborator.co
 *	www.laborator.co
 */

// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'clients.png';

// Clients (parent of client entry)
vc_map( array(
	"base"                     => "lab_clients",
	"name"                     => "Clients",
	"description"      		   => "Partners/clients logos",
	"category"                 => 'Laborator',
	"content_element"          => true,
	"show_settings_on_create"  => true,
	"icon"                     => $lab_vc_element_icon,
	"as_parent"                => array('only' => 'lab_clients_entry'),
	"params"                   => array(
		array(
			'type'           => 'dropdown',
			'heading'        => 'Clients per Row',
			'param_name'     => 'columns_count',
			'std'            => '4',
			'value'          => array(
				'2 Logos per Row'    => '2',
				'3 Logos per Row'    => '3',
				'4 Logos per Row'    => '4',
				'6 Logos per Row'    => '6',
				'12 Logos per Row'   => '12',
			),
			'description' => 'Set number of columns for clients/partners logos.'
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Spacing',
			'param_name' => 'column_spacing',
			'std'		 => 'no',
			'value'      => array(
				'No spacing'             => 'no',
				'Apply default spacing'  => 'yes',
			),
			'description' => 'Set spacing for logo columns.'
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Image Borders',
			'param_name' => 'image_borders',
			'std'		 => 'yes',
			'value'      => array(
				'No'     => 'no',
				'Yes'    => 'yes',
			),
			'description' => 'Set spacing for logo columns.'
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Hover Style',
			'param_name' => 'hover_style',
			'std'		 => 'full',
			'value'      => array(
				'None'                       => 'none',
				'Full background hover'      => 'full',
				'Distanced background hover' => 'distanced',
			),
			'description' => 'Select hover effect style to apply for team members entries.'
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Custom Hover Color',
			'param_name'     => 'hover_bg',
			'description'    => 'You can set custom hover color.',
			'dependency'     => array(
				'element'=> 'hover_style',
				'value' => array('full' ,'distanced')
			),
		),
		array(
			'type'           => 'colorpicker',
			'heading'        => 'Custom Hover Text Color',
			'param_name'     => 'hover_txt',
			'description'    => 'You can set custom hover text color.',
			'dependency'     => array(
				'element'=> 'hover_style',
				'value' => array('full' ,'distanced')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Image size',
			'param_name'     => 'img_size',
			'description'    => 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Minimum Height',
			'param_name'     => 'height',
			'description'    => 'You can alternatively enter height of the logo entries. If empty it will use the highest height of logos.'
		),
		$laborator_vc_general_params['reveal_effect_x'],
		array(
			"type"           => "textfield",
			"heading"        => "Extra class name",
			"param_name"     => "el_class",
			"description"    => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => 'Design options'
		),
	),
	"js_view" => 'VcColumnView'
) );


// Team Member (child of Team Members)
vc_map( array(
	"base"             => "lab_clients_entry",
	"name"             => "Client Logo",
	"description"      => "Member details",
	"category"         => 'Laborator',
	"content_element"  => true,
	"icon"			   => $lab_vc_element_icon,
	"as_child"         => array('only' => 'lab_team_members'),
	"params"           => array(
		array(
			'type'           => 'attach_image',
			'heading'        => 'Image',
			'param_name'     => 'image',
			'value'          => '',
			'description'    => 'Add logo image here.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'admin_label'	 => true,
			'description'    => 'Title of the client/partner (shown on hover).',
		),
		array(
			'type'           => 'textarea',
			'heading'        => 'Description',
			'param_name'     => 'description',
			'description'    => 'Small description about the client/partner, this text area supports HTML too (shown on hover).',
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'Link',
			'param_name'     => 'link',
			'description'    => 'Add custom for this logo (Optional).',
		),
		array(
			"type"           => "textfield",
			"heading"        => "Extra class name",
			"param_name"     => "el_class",
			"description"    => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",
		)
	)
) );


class WPBakeryShortCode_Lab_Clients extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Lab_Clients_Entry extends WPBakeryShortCode {}