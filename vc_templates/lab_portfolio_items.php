<?php
/**
 *	Portfolio Items
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $portfolio_args;

// Atts
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

// Masonry Attributes
if ( isset( $masonry_atts ) ) {
	$atts = array_merge( $atts, $masonry_atts );
}

// Set default Query Params
kalium_vc_loop_param_set_default_value( $atts['portfolio_query'], 'post_type', 'portfolio' );
kalium_vc_loop_param_set_default_value( $atts['portfolio_query'], 'size', '12' );

// Extract Shortcode Variables
extract( $atts );


// Portfolio Query
$portfolio_query_args = array( 
	'vc_attributes' => $atts 
);

// Masonry Items
if ( isset( $masonry_items ) && is_array( $masonry_items ) ) {
	$portfolio_query_args['vc_attributes'] = array_merge( $portfolio_query_args['vc_attributes'], array(
		'portfolio_type'	  => 'type-2',
		'masonry_items'       => $masonry_items,
		'masonry_items_ids'   => $masonry_items_ids
	) );
}

$portfolio_args = kalium_get_portfolio_query( $portfolio_query_args );
$portfolio_query = $portfolio_args['portfolio_query'];


// More Link
$more_link = vc_build_link( $more_link );


// Portfolio Container Class
$portfolio_container_class = array();
$portfolio_container_class[] = 'portfolio-holder';
$portfolio_container_class[] = 'portfolio-' . $portfolio_args['layout_type'];

// Sort items by clicking on the category (under title)
if ( apply_filters( 'portfolio_container_isotope_category_sort_by_js', true ) ) {
	$portfolio_container_class[] = 'sort-by-js';
}

// Masonry Layout
if ( $portfolio_args['layout_type'] == 'type-1' && $portfolio_args['layouts']['type_1']['dynamic_image_height'] || $portfolio_args['layout_type'] == 'type-2' ) {
	$portfolio_container_class[] = 'is-masonry-layout';
}

// Merged Layout
if ( $portfolio_args['layout_type'] == 'type-2' && $portfolio_args['layouts']['type_2']['grid_spacing'] == 'merged' ) {
	$portfolio_container_class[] = 'merged-item-spacing';
}

// Item Spacing
if ( $portfolio_args['layout_type'] == 'type-2' && $portfolio_args['layouts']['type_2']['grid_spacing'] == 'normal' && is_numeric( $portfolio_args['layouts']['type_2']['default_spacing'] ) ) {
	$spacing_in_px = $portfolio_args['layouts']['type_2']['default_spacing'] / 2 . 'px';
	$portfolio_container_class[] = 'portfolio-loop-custom-item-spacing';
	
	generate_custom_style( '.page-container > .row', "margin: 0 -" . $spacing_in_px );
	generate_custom_style( '.portfolio-holder.portfolio-loop-custom-item-spacing [data-portfolio-item-id]', "padding: {$spacing_in_px};" );
	generate_custom_style( '.portfolio-holder .portfolio-item.masonry-portfolio-item .masonry-box .masonry-thumb', "margin: {$spacing_in_px};" );
}


// Element Class (Visual Composer)
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "lab-portfolio-items portfolio-container-and-title {$css_class} portfolio-loop-layout-" . $portfolio_args['layout_type'];

if ( $portfolio_args['fullwidth'] ) {
	$css_class .= ' full-width-portfolio';
	
	if ( $portfolio_args['fullwidth_title_container'] ) {
		$css_class .= ' has-title-container';
	}
}
?>
<div id="<?php echo $portfolio_args['id']; ?>-container" class="<?php echo trim( esc_attr( $css_class ) . vc_shortcode_custom_css_class( $css, ' ' ) ); ?>">
	
	<?php include locate_template( 'tpls/portfolio-listing-title.php' ); ?>
	
	<div class="row">
		
		<?php do_action( 'kalium_portfolio_items_before', $portfolio_query ); ?>
		
		<div id="<?php echo $portfolio_args['id']; ?>" class="<?php echo implode( ' ', $portfolio_container_class ); ?>">
			<?php kalium_portfolio_loop_items_show( $portfolio_args ); ?>
		</div>
		
		<?php 
		
		do_action( 'kalium_portfolio_items_after' ); 
				
		// Generate Portfolio Instance Object
		kalium_portfolio_generate_portfolio_instance_object( $portfolio_args );
		
		// Pagination
		if ( ! isset( $atts['pagination_type'] ) ) {
			$pagination_type = 'static';
		}
		
		// Endless Pagination
		if ( $pagination_type == 'endless' ) :
			kalium_portfolio_endless_pagination( $portfolio_args );
		endif;
		
		// Static Pagination type
		if ( $pagination_type == 'static' ) :
		?>
			<?php if ( $more_link['url'] && $more_link['title'] ) : ?>
			<div class="more-link <?php echo isset( $show_effect ) && $show_effect ? $show_effect : ''; ?>">
				<div class="show-more">
					<div class="button">
						<a href="<?php echo esc_url( $more_link['url'] ); ?>" target="<?php echo esc_attr( $more_link['target'] ); ?>" class="btn btn-white">
							<?php echo esc_html( $more_link['title'] ); ?>
						</a>
					</div>
				</div>
			</div>
			<?php endif; ?>
		<?php 
		endif; 
		?>
		
	</div>
	
</div>
