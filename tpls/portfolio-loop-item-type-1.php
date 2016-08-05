<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

// Get Portfolio Item Details
include locate_template( 'tpls/portfolio-loop-item-details.php' );

// Main Vars
$portfolio_image_size   = 'portfolio-img-1';
$hover_effect           = $portfolio_args['layouts']['type_1']['hover_effect'];
$hover_transparency     = $portfolio_args['layouts']['type_1']['hover_transparency'];

// Hover effect style
$custom_hover_effect_style = '';

if ( $hover_effect_style != 'inherit' ) {
	$hover_effect = $hover_effect_style;
}

// Custom value for Transparency
if ( in_array( $custom_hover_color_transparency, array( 'opacity', 'no-opacity' ) ) ) {
	$hover_transparency = $custom_hover_color_transparency;
}

// Custom Background color for this item
if ( $custom_hover_background_color ) {
	generate_custom_style( ".portfolio-holder .post-{$portfolio_item_id} .item-box .on-hover", "background-color: {$custom_hover_background_color} !important;" );
}

// Disable Order
if ( 'none' == $hover_layer_options ) {
	$hover_effect = 'none';
}

// Padding
$item_class[] = 'with-padding';

// Item Class
$item_class[] = kalium_portfolio_get_columns_class( $portfolio_args['columns'] );

// Hover State Class
$hover_state_class = array();

$hover_state_class[] = 'on-hover';
$hover_state_class[] = 'opacity-' . ( $hover_transparency == 'opacity' ? 'yes' : 'no' );

if ( $hover_effect == 'distanced' ) {
	$hover_state_class[] = 'distanced';
}


// Dynamic Image Height
if ( $portfolio_args['layouts']['type_1']['dynamic_image_height'] ) {
	$portfolio_image_size = 'portfolio-img-3';
	$item_class[] = 'dynamic-height-image';
}

// Show Animated Eye on Hover
if ( $portfolio_args['layouts']['type_1']['animated_eye'] ) {
	$item_class[] = 'animated-eye-icon';
}

// Item Thumbnail
$image = get_laborator_show_image_placeholder( $post_thumbnail_id, apply_filters( 'kalium_portfolio_loop_thumbnail_size', $portfolio_image_size, 'type-1' ) );
?>
<div <?php post_class( $item_class ); ?> data-portfolio-item-id="<?php echo $portfolio_item_id; ?>"<?php if ( $portfolio_terms_slugs ) : ?> data-terms="<?php echo implode( ' ', $portfolio_terms_slugs ); ?>"<?php endif; ?>>
	
	<?php do_action( 'kalium_portfolio_item_before', $portfolio_item_type ); ?>
	
	<div class="item-box <?php echo esc_attr( $show_effect ); ?>"<?php if ( $reveal_delay ) : ?> data-wow-delay="<?php echo esc_attr( $reveal_delay ); ?>s"<?php endif; ?>>
		<div class="photo do-lazy-load-on-shown">
			<a href="<?php echo esc_url( $portfolio_item_href ); ?>" class="item-link"<?php echo when_match( $portfolio_item_new_window, 'target="_blank"' ); ?>>
				<?php echo $image; ?>

				<?php if ( 'none' !== $hover_effect ) : ?>
				<span class="<?php echo implode( ' ', $hover_state_class ); ?>">
					<i class="icon icon-basic-eye"></i>
				</span>
				<?php endif; ?>
			</a>
		</div>

		<div class="info">
			<h3>
				<a href="<?php echo esc_url( $portfolio_item_href ); ?>" class="item-link"<?php echo when_match( $portfolio_item_new_window, 'target="_blank"' ); ?>>
					<?php echo esc_html( $portfolio_item_title ); ?>
				</a>
			</h3>

			<?php include locate_template( 'tpls/portfolio-loop-item-categories.php' ); ?>
		</div>
	</div>
	
	<?php do_action( 'kalium_portfolio_item_after' ); ?>
	
</div>