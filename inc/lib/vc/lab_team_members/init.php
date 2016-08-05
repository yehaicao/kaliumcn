<?php
/**
 *	Team Members Shortcode
 *
 *	Laborator.co
 *	www.laborator.co
 */

// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'members.png';

// Team members (parent of Team member and team member placeholder)
vc_map( array(
	'base'                     => 'lab_team_members',
	'name'                     => 'Team Members',
	'description'      		   => 'List your members',
	'category'                 => 'Laborator',
	'content_element'          => true,
	'show_settings_on_create'  => true,
	'icon'                     => $lab_vc_element_icon,
	'as_parent'                => array('only' => 'lab_team_members_member,lab_team_members_placeholder'),
	'params'                   => array(
		array(
			'type'           => 'dropdown',
			'heading'        => 'Members per Row',
			'param_name'     => 'columns_count',
			'std'            => '3',
			'value'          => array(
				'1 Member per Row'  => '1',
				'2 Members per Row' => '2',
				'3 Members per Row' => '3',
				'4 Members per Row' => '4',
			),
			'description' => 'Set number of columns for team members.'
		),
		$laborator_vc_general_params['reveal_effect_x'],
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
			'type'           => 'textfield',
			'heading'        => 'Image size',
			'param_name'     => 'img_size',
			'description'    => 'Enter image size. Example: Enter image size in pixels: 200x100 (Width x Height). Leave empty to use "460x460" size.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Extra class name',
			'param_name'     => 'el_class',
			'description'    => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		)
	),
	'js_view' => 'VcColumnView'
) );


// Team Member (child of Team Members)
vc_map( array(
	'base'             => 'lab_team_members_member',
	'name'             => 'Team Member',
	'description'      => 'Member details',
	'category'         => 'Laborator',
	'content_element'  => true,
	'icon'			   => $lab_vc_element_icon,
	'as_child'         => array('only' => 'lab_team_members'),
	'params'           => array(
		array(
			'type'           => 'attach_image',
			'heading'        => 'Image',
			'param_name'     => 'image',
			'value'          => '',
			'description'    => 'Add team member image here.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Name',
			'param_name'     => 'name',
			'admin_label'	 => true,
			'description'    => 'Name of the member.',
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Sub Title',
			'param_name'     => 'sub_title',
			'description'    => 'Position or title of the member.',
		),
		array(
			'type'           => 'textarea_safe',
			'heading'        => 'Description',
			'param_name'     => 'description',
			'description'    => 'Include a small description for this member, this text area supports HTML too.',
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'Link',
			'param_name'     => 'link',
			'description'    => 'Make the name and thumbnail clickable (Optional).',
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Extra class name',
			'param_name'     => 'el_class',
			'description'    => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		)
	)
) );


// Team Member Placeholder (child of Team Members)
vc_map( array(
	'base'             => 'lab_team_members_placeholder',
	'name'             => 'Placeholder',
	'description'      => 'Anonymous member',
	'category'         => 'Laborator',
	'content_element'  => true,
	'icon'			   => $lab_vc_element_icon,
	'as_child'         => array('only' => 'lab_team_members'),
	'params'           => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Image Title',
			'param_name'     => 'image_title',
			'value'			 => 'your-image.jpg',
			'description'    => 'Add some text that will be paced after the image (Optional).',
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'admin_label'	 => true,
			'value'			 => 'You Here',
			'description'    => 'Insert a sample title.',
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Sub Title',
			'param_name'     => 'sub_title',
			'value'			 => 'Join us now!',
			'description'    => 'Insert a sample sub title (Optional).',
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'Sub Title Link',
			'param_name'     => 'link',
			'description'    => 'Make the name and thumbnail clickable (Optional).',
			'dependency' => array(
				'element' => 'sub_title',
				'not_empty' => true
			)
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Extra class name',
			'param_name'     => 'el_class',
			'description'    => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		)
	)
) );

class WPBakeryShortCode_Lab_Team_Members extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Lab_Team_Members_Member extends WPBakeryShortCode {}
class WPBakeryShortCode_Lab_Team_Members_Placeholder extends WPBakeryShortCode {}