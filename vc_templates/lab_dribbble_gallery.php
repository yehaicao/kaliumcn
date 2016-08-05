<?php
/**
 *	Dribbble Gallery
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

# Atts
$defaults = array(
	'username'     => '',
	'access_token' => '',
	'count'        => '',
	'columns'      => '',
	'more_link'    => '',
	'el_class'     => '',
	'css'          => ''
);

#$atts = vc_shortcode_attribute_parse($defaults, $atts);
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$dribbble_gallery_id = uniqid("el_");

$more_link = vc_build_link($more_link);


# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "lab-dribbble-gallery portfolio-holder {$css_class}";

?>
<div class="<?php echo esc_attr($css_class) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<div id="<?php echo esc_attr($dribbble_gallery_id); ?>" class="dribbble-container is-loading dribbble-<?php echo esc_attr($columns); ?>-columns" data-dribbble-user="<?php echo esc_attr($username); ?>" data-dribbble-access-token="<?php echo esc_attr( $access_token ); ?>" data-dribbble-count="<?php echo esc_attr($count); ?>">
		<i class="fa fa-circle-o-notch fa-spin"></i>
	</div>
	
	<?php if($more_link['url'] && $more_link['title']): ?>
	<div class="more-link <?php echo isset($show_effect) && $show_effect ? $show_effect : ''; ?>">
		<div class="show-more">
			<div class="button">
				<a href="<?php echo esc_url($more_link['url']); ?>" target="<?php echo esc_attr($more_link['target']); ?>" class="btn btn-white">
					<?php echo esc_html($more_link['title']); ?>
				</a>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>