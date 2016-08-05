<?php
/**
 *	Share + Like links
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $portfolio_args;

// Atts
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Portfolio Item Id
$post_id = get_the_id();

// Like + Share Layout
$share_layout = $portfolio_args['share_layout'];
$portfolio_args['share_layout'] = $layout;


// Element Class (Visual Composer)
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

?>
<div class="<?php echo esc_attr( "portfolio-like-share-vc alignment-{$alignment} {$css_class}" . vc_shortcode_custom_css_class( $css, ' ' ) ); ?>">
	<?php include locate_template( 'tpls/portfolio-single-like-share.php' ); ?>
</div>