<?php
/**
 *	Scroll Box
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


# Atts
$defaults = array(
	'contnent'         => '',
	'scroll_height'    => '',
	'el_class'         => '',
	'css'              => ''
);

#$atts = vc_shortcode_attribute_parse($defaults, $atts);
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );


$element_id = 'scrollbox-' . mt_rand(100000, 999999);

# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "lab-scroll-box {$css_class}";

?>
<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr($css_class) . vc_shortcode_custom_css_class($css, ' '); ?>" data-height="<?php echo intval($scroll_height); ?>">
	<div class="lab-scroll-box-content"><?php echo laborator_esc_script(apply_filters('the_content', $content)); ?></div>
</div>
<style>
	#<?php echo esc_attr($element_id); ?> .lab-scroll-box-content {
		max-height: <?php echo intval($scroll_height); ?>px;
	}
</style>