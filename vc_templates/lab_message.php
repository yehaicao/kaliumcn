<?php
/**
 *	Message Box
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

# Atts
$defaults = array(
	'type'         => '',
	'message'      => '',
	'close_button' => '',
	'el_class'     => '',
	'css'          => ''
);

if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );


// Message field fix
$message_safe = $message;
	
if ( strpos( $message, '#E-' ) == 0 ) {
	$message = vc_value_from_safe( $message );
}

# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "alert {$css_class}";

switch( $type ) {
	case 'info':
		$css_class .= ' alert-info';
		break;
		
	case 'success':
		$css_class .= ' alert-success';
		break;
		
	case 'warning':
		$css_class .= ' alert-warning';
		break;
		
	case 'error':
		$css_class .= ' alert-danger';
		break;
		
	default:
		$css_class .= ' alert-default';
}
?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class( $css, ' ' ); ?> fade in" role="alert">
	<?php if($close_button): ?>
	<button type="button" class="close" data-dismiss="alert">
		<span aria-hidden="true"></span>
		<span class="sr-only"><?php echo _e( 'Close', 'kalium' ); ?></span>
	</button>
	<?php endif; ?>
	
	<?php echo laborator_esc_script( apply_filters( 'the_content', $message ) ); ?>
</div>
