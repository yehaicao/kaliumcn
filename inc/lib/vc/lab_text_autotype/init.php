<?php
/**
 *	Animated Text - AutoType
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'typing.png';

$default_text = '<h2>Hi there! *This is Kalium Theme;Developed by Laborator;Do you like it?*</h2>';

vc_map( array(
	'base'             => 'lab_text_autotype',
	'name'             => 'Auto Type',
	"description"      => "Animated text typing",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => 'Content',
			'param_name' => 'typed_text',
			'value'		 => $default_text,
			'description'=> '
			Enter the content to display with typing text. You can apply HTML markup too.
			<br />
			<small>Text within <u>*</u> will be animated, example: <strong>*Sample text*</strong>.
			<br />
			Text separator is ; (semicolon), example: <strong>*First sentence; second sentence*</strong>
			<br />
			Pausing inside texts: <u>^1000</u> in milliseconds unit, example: <strong>*Hey, ^800 how are you?;Well, ^2000 I am Fine!*</strong>
			</small>'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Show more options',
			'param_name'     => 'typed_show_options',
			'std'            => 'no',
			'value'          => array(
				'Yes' => 'yes',
				'No' => 'no',
			),
			'description'    => 'Configure animation options.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Character for cursor',
			'value'			 => '|',
			'description'    => 'Leave empty to remove the blinking cursor.',
			'param_name'     => 'typed_options_cursorchar',
			'dependency' => array(
				'element'   => 'typed_show_options',
				'value'     => array('yes')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Iteration loop',
			'value'			 => '',
			'description'    => 'Leave empty for single loop only. Set -1 for infinite loop.',
			'param_name'     => 'typed_options_loopcount',
			'dependency' => array(
				'element'   => 'typed_show_options',
				'value'     => array('yes')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Type speed',
			'value'			 => '10',
			'description'    => 'Type of speed when entering the text. (Unit is milliseconds)',
			'param_name'     => 'typed_options_typespeed',
			'dependency' => array(
				'element'   => 'typed_show_options',
				'value'     => array('yes')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Back speed',
			'value'			 => '20',
			'description'    => 'Back speed when deleting the text. (Unit is milliseconds)',
			'param_name'     => 'typed_options_backspeed',
			'dependency' => array(
				'element'   => 'typed_show_options',
				'value'     => array('yes')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Start delay',
			'value'			 => '0',
			'description'    => 'Set delay before starting text typing. (Unit is milliseconds)',
			'param_name'     => 'typed_options_startdelay',
			'dependency' => array(
				'element'   => 'typed_show_options',
				'value'     => array('yes')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Back delay',
			'value'			 => '500',
			'description'    => 'Set back delay after text is typed. (Unit is milliseconds)',
			'param_name'     => 'typed_options_backdelay',
			'dependency' => array(
				'element'   => 'typed_show_options',
				'value'     => array('yes')
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

class WPBakeryShortCode_Lab_Text_Autotype extends WPBakeryShortCode {}


function lab_text_autotype_process_entry( $typed_syntax = '', $typed_options = array() ) {
	$typed_element = $typed_script = '';
	
	if ( in_array( '*', array( substr( $typed_syntax, 0, 1 ), substr( $typed_syntax, -1, 1 ) ) ) ) {
		// Typed.js Defaults
		$defaults = array(
			'cursorChar'     => '|',
			'contentType'    => 'html',
			
			'loop'           => false,
			'loopCount'      => false,
			
			'typeSpeed'      => 40,
			'backSpeed'      => 0,
			
			'startDelay'     => 0,
			'backDelay'      => 500,
		);
		
		$defaults = array_merge( $defaults, $typed_options );
		
		// Text Split and Map
		$element_id = 'el_' . uniqid();
		
		$typed_syntax = substr( $typed_syntax, 1, -1 );
		
		// Escape <script inject
		$typed_syntax = laborator_esc_script( $typed_syntax );
		
		$animate_entries = explode( ';', $typed_syntax );
		$animate_entries = array_map( 'trim', $animate_entries );
		
		$defaults = array_merge( $defaults, array( 'strings' => $animate_entries ) );
		
		// Text
		ob_start();
		?>
		<div class="lab-autotype-text-entry" id="<?php echo esc_attr( $element_id ); ?>"></div>
		<?php
		
		$typed_element = ob_get_clean();
			
		
		// Script
		ob_start();
		$json_data = json_encode( $defaults );
		
		if ( version_compare( phpversion(), '5.3.3', '>=' ) ) {
			$json_data = json_encode( $defaults, JSON_NUMERIC_CHECK );
		}
		
		?>
		jQuery("#<?php echo esc_attr( $element_id ); ?>").typed(<?php echo $json_data; ?>);
		<?php
			
		$typed_script = ob_get_clean();
			
	}
	
	return array(
		'el'      => $typed_element, 
		'script'  => $typed_script
	);
}