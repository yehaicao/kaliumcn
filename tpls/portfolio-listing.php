<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $portfolio_args, $pagename;

// Make the portfolio query
$portfolio_query_args = array();

if ( $pagename ) {
	$portfolio_query_args['post_id'] = $pagename;
} else if ( is_front_page() ) {
	$portfolio_query_args['post_id'] = get_option( 'page_on_front' );
}

// Get Query and Args
$portfolio_args 	= kalium_get_portfolio_query( $portfolio_query_args );
$portfolio_query    = $portfolio_args['portfolio_query'];
$pagination         = $portfolio_args['pagination'];


// Portfolio Container Class
$portfolio_container_class = array();
$portfolio_container_class[] = 'portfolio-holder';
$portfolio_container_class[] = 'portfolio-' . $portfolio_args['layout_type'];

// Masonry Layout
if ( $portfolio_args['layout_type'] == 'type-1' && $portfolio_args['layouts']['type_1']['dynamic_image_height'] || $portfolio_args['layout_type'] == 'type-2' ) {
	$portfolio_container_class[] = 'is-masonry-layout';
}

// Merged Layout
if ( $portfolio_args['layout_type'] == 'type-2' && $portfolio_args['layouts']['type_2']['grid_spacing'] == 'merged' ) {
	$portfolio_container_class[] = 'merged-item-spacing';
}

// Sort items by clicking on the category (under title)
if ( apply_filters( 'portfolio_container_isotope_category_sort_by_js', true ) ) {
	$portfolio_container_class[] = 'sort-by-js';
}

// Item Spacing
if ( $portfolio_args['layout_type'] == 'type-2' && $portfolio_args['layouts']['type_2']['grid_spacing'] == 'normal' && is_numeric( $portfolio_args['layouts']['type_2']['default_spacing'] ) ) {
	$spacing_in_px = $portfolio_args['layouts']['type_2']['default_spacing'] / 2 . 'px';
	$portfolio_container_class[] = 'portfolio-loop-custom-item-spacing';
	
	generate_custom_style( '.page-container > .row', "margin: 0 -" . $spacing_in_px );
	generate_custom_style( '.portfolio-holder.portfolio-loop-custom-item-spacing [data-portfolio-item-id]', "padding: {$spacing_in_px};" );
	generate_custom_style( '.portfolio-holder .portfolio-item.masonry-portfolio-item .masonry-box .masonry-thumb', "margin: {$spacing_in_px};" );
}

?>
<div id="<?php echo $portfolio_args['id']; ?>-container" class="<?php 
	echo 'container portfolio-container-and-title portfolio-loop-layout-' . $portfolio_args['layout_type'];
	when_match( $portfolio_args['fullwidth'], 'full-width-portfolio' );
	when_match( $portfolio_args['fullwidth'] && $portfolio_args['fullwidth_title_container'], 'has-title-container' );
?>">

	<?php include locate_template( 'tpls/portfolio-listing-title.php' ); ?>

	<div class="page-container">
		<div class="row">
			
			<?php do_action( 'kalium_portfolio_items_before', $portfolio_query ); ?>
			
			<div id="<?php echo $portfolio_args['id']; ?>" class="<?php echo implode( ' ', $portfolio_container_class ); ?>">
				<?php kalium_portfolio_loop_items_show( $portfolio_args ); ?>
			</div>
			
			<?php do_action( 'kalium_portfolio_items_after' ); ?>

			<?php
			// Generate Portfolio Instance Object
			kalium_portfolio_generate_portfolio_instance_object( $portfolio_args );
				
			// Portfolio Pagination
			switch ( $pagination['type'] ) {
				// Portfolio Pagination
				case 'endless':
				case 'endless-reveal':
					kalium_portfolio_endless_pagination( $portfolio_args );
					break;

				// Standard Pagination
				default:
					$prev_icon = '<i class="flaticon-arrow427"></i>';
					$prev_text = __( 'Previous', 'kalium' );
					
					$next_icon = '<i class="flaticon-arrow413"></i>';
					$next_text = __( 'Next', 'kalium' );
					
					
					?>
					<div class="pagination-container align-<?php echo $pagination['align']; ?>">
					<?php 
						echo paginate_links( apply_filters( 'kalium_portfolio_pagination_args', array(
							'mid_size'    => 2,
							'end_size'    => 2,
							'total'		  => $pagination['max_num_pages'],
							'prev_text'   => "{$prev_icon} {$prev_text}",
							'next_text'   => "{$next_text} {$next_icon}",
						) ) ); 
					?>
					</div>
					<?php
			}
			?>
		</div>
	</div>

</div>