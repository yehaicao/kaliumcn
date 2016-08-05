<?php
/**
 *	Laborator Social Networks
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'social-networks.png';

vc_map( array(
	'base'             => 'lab_vc_social_networks',
	'name'             => 'Social Networks',
	"description"      => "Social network links",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'       => 'dropdown',
			'heading'    => 'Display Type',
			'param_name' => 'display_type',
			'std'		 => 'no',
			'value'      => array(
				'Rounded Icons'  => 'rounded-icons',
				'Text Only'      => 'text-only',
				'Icon + Text'    => 'icon-text',
			),
			'description' => 'Set spacing for logo columns.'
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

class WPBakeryShortCode_Lab_VC_Social_Networks extends WPBakeryShortCode {
	
	public function content( $atts, $content = null ) {
		// Atts
		$defaults = array(
			'display_type'   => '',
			'el_class'       => '',
			'css'            => ''
		);
		
		$atts = vc_shortcode_attribute_parse( $defaults, $atts );
		
		extract( $atts );

		// Element Class
		$class = $this->getExtraClass( $el_class );
		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );		
		$css_class = "lab-vc-social-networks {$css_class} display-type-{$display_type}";

		ob_start();
		
		?>
		<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class( $css, ' ' ); ?>">
		<?php echo do_shortcode( '[lab_social_networks' . ( $display_type == 'rounded-icons' ? ' rounded' : '' ) . ']' ); ?>
		</div>
		<?php
		
		$output = ob_get_clean();
		
		return $output;
	}
}
