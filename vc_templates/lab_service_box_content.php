<?php
/**
 *	Box Content for Icon Box
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

# Atts
$defaults = array(
	'title'            => '',
	'description'      => '',
	'text_alignment'   => '',
	'link'             => '',
	'el_class'         => '',
	'css'              => ''
);

#$atts = vc_shortcode_attribute_parse($defaults, $atts);
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$link = vc_build_link($link);

# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "icon-box-content text-alignment-{$text_alignment} " . $css_class;

?>
<div class="<?php echo esc_attr($css_class) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<h3>
		<?php if($link['url']): ?>
			<a href="<?php echo esc_url($link['url']); ?>" title="<?php echo esc_attr($link['title']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($title); ?></a>
		<?php else: ?>
			<?php echo esc_html($title); ?>
		<?php endif; ?>
	</h3>
	
	<div class="box-content-p">
		<?php echo laborator_esc_script(wpautop($description)); ?>
	</div>
</div>
<?php
