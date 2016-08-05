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
$lab_vc_element_icon    = $lab_vc_element_url . 'like-social-sharing.png';

if ( is_admin() && ( $post_id = lab_get( 'post' ) ) ) {
	$wp_post = get_post( $post_id );
	
	if ( $wp_post instanceof WP_Post && $wp_post->post_type != 'portfolio' ) { 
		return;
	}
}

vc_map( array(
	'base'             => 'lab_portfolio_share_like',
	'name'             => 'Like + Share',
	"description"      => "Portfolio item social sharing links",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'           => 'dropdown',
			'heading'        => 'Layout',
			'param_name'     => 'layout',
			'std'            => 'default',
			'value'          => array(
				'Plain text'    => 'default',
				'Rounded icons' => 'rounded',
			),
			'admin_label' => true,
			'description' => 'Select layout of social sharing links.'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Alignment',
			'param_name'     => 'alignment',
			'std'            => 'center',
			'value'          => array(
				'Left'      => 'left',
				'Center'    => 'center',
				'Right'     => 'right',
			),
			'admin_label' => true,
			'description' => 'Set alignment of social media links inside the column.'
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

class WPBakeryShortCode_Lab_Portfolio_Share_Like extends WPBakeryShortCode {}