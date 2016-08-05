<?php
/**
 *	Custom Column Params
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


# Custom column params
add_action('vc_after_init', 'lab_vc_custom_column_params');

function lab_vc_custom_column_params() {
	$laborator_vc_dependency_reveal = array(
		'element' => 'reveal_effect',
		'not_empty' => true
	);
	
	$params = array(	
		# Reveal Effect
		'reveal_effect' => array(
			'type'        => 'dropdown',
			'heading'     => 'Reveal Effect',
			'param_name'  => 'reveal_effect',
			'std'         => 'none',
			'weight'	  => 3,
			'value'       => array(
				'None'              => '',
				'Fade In'           => 'fadeIn',
				'Slide and Fade'    => 'fadeInLab',
				'---------------'   => '',
				'bounce'            => 'bounce',
				'flash'             => 'flash',
				'pulse'             => 'pulse',
				'rubberBand'        => 'rubberBand',
				'shake'             => 'shake',
				'swing'             => 'swing',
				'tada'              => 'tada',
				'wobble'            => 'wobble',
				'bounceIn'          => 'bounceIn',
				'bounceInDown'      => 'bounceInDown',
				'bounceInLeft'      => 'bounceInLeft',
				'bounceInRight'     => 'bounceInRight',
				'bounceInUp'        => 'bounceInUp',
				'fadeInDown'        => 'fadeInDown',
				'fadeInDownBig'     => 'fadeInDownBig',
				'fadeInLeft'        => 'fadeInLeft',
				'fadeInLeftBig'     => 'fadeInLeftBig',
				'fadeInRight'       => 'fadeInRight',
				'fadeInRightBig'    => 'fadeInRightBig',
				'fadeInUp'          => 'fadeInUp',
				'fadeInUpBig'       => 'fadeInUpBig',
				'flip'              => 'flip',
				'flipInX'           => 'flipInX',
				'flipInY'           => 'flipInY',
				'lightSpeedIn'      => 'lightSpeedIn',
				'rotateIn'          => 'rotateIn',
				'rotateInDownLeft'  => 'rotateInDownLeft',
				'rotateInDownRight' => 'rotateInDownRight',
				'rotateInUpLeft'    => 'rotateInUpLeft',
				'rotateInUpRight'   => 'rotateInUpRight',
				'hinge'             => 'hinge',
				'rollIn'            => 'rollIn',
				'zoomIn'            => 'zoomIn',
				'zoomInDown'        => 'zoomInDown',
				'zoomInLeft'        => 'zoomInLeft',
				'zoomInRight'       => 'zoomInRight',
				'zoomInUp'          => 'zoomInUp',

			),
			'description' => 'Set reveal effect for this element. To preview the animations <a href="http://daneden.github.io/animate.css/" target="_blank">click here</a>.'
		),
			
		# Reveal Duration
		'reveal_duration' => array(
			'type'        => 'textfield',
			'heading'     => 'Reveal Duration',
			'param_name'  => 'reveal_duration',
			'weight'	  => 2,
			'description' => 'Set number of seconds for the animation duration. (Optional)',
			'dependency'  => $laborator_vc_dependency_reveal,
		),
			
		# Reveal Delay
		'reveal_delay' => array(
			'type'        => 'textfield',
			'heading'     => 'Reveal Delay',
			'param_name'  => 'reveal_delay',
			'weight'	  => 1,
			'description' => 'Set reveal effect delay before showing in seconds, otherwise leave empty.',
			'dependency'  => $laborator_vc_dependency_reveal
		),
	);
	
	
	vc_add_param('vc_column', $params['reveal_effect']);
	vc_add_param('vc_column', $params['reveal_duration']);
	vc_add_param('vc_column', $params['reveal_delay']);
}