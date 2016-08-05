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
$lab_vc_element_icon    = $lab_vc_element_url . 'blog-posts.png';


vc_map( array(
	'base'             => 'lab_blog_posts',
	'name'             => 'Blog Posts',
	"description"      => "Show blog posts",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			"type" => "loop",
			"heading" => "Blog Query",
			"param_name" => "blog_query",
			'settings' => array(
				'size' => array('hidden' => false, 'value' => 3),
				'order_by' => array('value' => 'date'),
				'post_type' => array('value' => 'post', 'hidden' => false)
			),
			"description" => "Create WordPress loop, to populate only blog posts from your site.",
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Columns',
			'param_name' => 'columns',
			'std' => '3',
			'admin_label' => true,
			'value' => array(
				'1 Column'    => '1',
				'2 Columns'   => '2',
				'3 Columns'   => '3',
				'4 Columns'   => '4',
			),
			'description' => 'Set number of columns to separate blog posts.'
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Layout',
			'param_name' => 'layout',
			'std' => 'top',
			'admin_label' => true,
			'value' => array(
				'Image on Top'   => 'top',
				'Image on Left'   => 'left',
			),
			'description' => 'Set posts layout to show blog posts.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Image Column Width',
			'param_name'     => 'image_column_size',
			'description'    => 'Set column width for the image, unit is percentage.',
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'left', 'right' )
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Image Size',
			'param_name'     => 'image_size',
			'description'    => 'Set image size dimensions to show blog posts featured image. Default is: 400x320.'
		),
		array(
			'type' => 'dropdown',
			'heading' => 'Masonry',
			'param_name' => 'masonry',
			'std' => 'plain',
			'value' => array(
				'Plain'                   => 'plain',
				'Masonry Mode'            => 'masonry',
				'Masonry Fit Rows Mode'   => 'fitRows',
			),
			'description' => 'Set grid render for blog posts.'
		),
		array(
			'type'           => 'checkbox',
			'heading'        => 'Blog Post Toggles',
			'param_name'     => 'blog_posts_options',
			'std'            => '',
			'value'          => array(
				'Show Post Date<br />' => 'date',
				'Animated Eye on Hover<br />' => 'animated-eye-hover',
			),
			'description'    => 'Toggle blog post options.'
		),
		array(
			'type'           => 'vc_link',
			'heading'        => 'More Link',
			'param_name'     => 'more_link',
			'value'          => '',
			'description'	 => 'This will show "More" button in the end of blog items.'
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

class WPBakeryShortCode_Lab_Blog_Posts extends WPBakeryShortCode {}