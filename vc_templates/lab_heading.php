<?php
/**
 *	Heading Box
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

# Atts
$defaults = array(
	'title'            => '',
	'contnent'         => '',
	'el_class'         => '',
	'css'              => ''
);

#$atts = vc_shortcode_attribute_parse($defaults, $atts);
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );


# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "section-title {$css_class}";

?>
<div class="<?php echo esc_attr($css_class) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<h2><?php echo esc_html($title); ?></h2>
	<?php echo laborator_esc_script(wpautop($content)); ?>
</div>