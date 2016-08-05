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
$portfolio_image_size   = 'portfolio-img-2';
$hover_effect           = $portfolio_args['layouts']['type_2']['hover_effect'];
$hover_transparency     = $portfolio_args['layouts']['type_2']['hover_transparency'];

// Item Classes
if ( 'normal' == $portfolio_args['layouts']['type_2']['grid_spacing'] ) {
	$item_class[] = 'with-padding';
}

// Custom value for Transparency
if ( in_array( $custom_hover_color_transparency, array( 'opacity', 'no-opacity' ) ) ) {
	$hover_transparency = $custom_hover_color_transparency;
}


// Hover effect style
$custom_hover_effect_style = '';

if ( ! in_array( $hover_effect_style, array( 'inherit', '' ) ) ) {
	$custom_hover_effect_style = $hover_effect_style;
}


// Custom Background
if ( $custom_hover_background_color ) {
	generate_custom_style( ".post-{$portfolio_item_id} .item-box .thumb .hover-state", "background-color: {$custom_hover_background_color} !important;" );
}

// Get column width for Masonry Portfolio Mode
$box_size = '';

if ( isset( $portfolio_args['masonry_items'][ $portfolio_item_id ] ) ) {
	$box_size = $portfolio_args['masonry_items'][ $portfolio_item_id ]['box_size'];
}

// Custom Box Size (Masonry Portfolio Mode)
if ( $box_size ) {
	$grid_spacing = 30;
	
	// Apply custom spacing
	if ( $portfolio_args['layouts']['type_2']['default_spacing'] ) {
		$grid_spacing = $portfolio_args['layouts']['type_2']['default_spacing'];
	}
	
	// Merged Images
	if ( $portfolio_args['layouts']['type_2']['grid_spacing'] == 'merged' ) {
		$grid_spacing = 0;
	}
	
	// Columns Size for Masonry Grid
	$cw = apply_filters( 'kalium_portfolio_masonry_col_width', 120 );
	$ch = apply_filters( 'kalium_portfolio_masonry_col_height', 120 );
	
	// Split Box Size
	$bs        = explode( 'x', $box_size );
	$bs_width  = $bs[0];
	$bs_height = $bs[1];
	
	$portfolio_image_size = $masonry_asel_size = array( 
		floor( $cw * $bs_width ),
		floor( $ch * $bs_height )
	);
	
	$portfolio_image_size[0] -= $grid_spacing;

	// Size by CSS Class
	$item_class[] = 'masonry-portfolio-item';
	$item_class[] = 'w' . $bs_width;
	
	// Mobile Image
	$mobile_image_size = apply_filters( 'kalium_portfolio_masonry_mobile_image', array( 768, 500 ) );
	$mobile_image = get_laborator_show_image_placeholder( $post_thumbnail_id, $mobile_image_size, 'do-lazy-load-on-shown' );
	
	// Support for Masonry with proportional thumbs
	if ( apply_filters( 'kalium_portfolio_masonry_proportional_thumbs', false ) ) {
		$portfolio_image_size = array( $portfolio_image_size[0], 0 );
	}
}
// Default Column Size
else {

	$item_class[] = kalium_portfolio_get_columns_class( $portfolio_args['columns'] );

	// Dynamic Image Height
	if ( $portfolio_args['layouts']['type_2']['dynamic_image_height'] && ! preg_match( "/^[a-z_-]+$/i", $portfolio_image_size ) ) {
		$portfolio_image_size = 'portfolio-img-3';
	}
}


// Hover State Class
$hover_state_class = array();

$hover_state_class[] = 'hover-state';
$hover_state_class[] = 'padding';
$hover_state_class[] = 'hover-eff-fade-slide';

$hover_state_class[] = 'position-' . $portfolio_args['layouts']['type_2']['hover_text_position'];
$hover_state_class[] = 'hover-' . ( $custom_hover_effect_style ? $custom_hover_effect_style : $hover_effect );
$hover_state_class[] = 'hover-style-' . $portfolio_args['layouts']['type_2']['hover_style'];
$hover_state_class[] = 'opacity-' . ( $hover_transparency == 'opacity' ? 'yes' : 'no' );

// Custom Hover Layer Options
if ( in_array( $hover_layer_options, array( 'always-hover', 'hover-reverse' ) ) ) {
	$hover_state_class[] = 'hover-is-visible';

	if ( $hover_layer_options == 'hover-reverse' ) {
		$hover_state_class[] = 'hover-reverse';
	}
}
else if ( 'none' == $hover_layer_options ) {
	$hover_effect = 'none';
}

// Disable linking
if ( 'external' == $item_linking && '#' == $item_launch_link_href ) {
	$portfolio_item_href = '#';
	$item_class[] = 'not-clickable';
}

// No Hover
if ( 'none' == $hover_effect ) {
	$item_class[] = 'hover-disabled';
}

// Item Thumbnail
$image = get_laborator_show_image_placeholder( $post_thumbnail_id, apply_filters( 'kalium_portfolio_loop_thumbnail_size', $portfolio_image_size, 'type-2' ), 'do-lazy-load-on-shown' );

// WOW effect attributes
$wow_attributes = '';

if ( $reveal_delay ) {
	$wow_attributes .= ' data-wow-delay="' . esc_attr( $reveal_delay ) . '"';
}

// Like Icon Class
$like_icon_default = 'fa-heart-o';
$like_icon_liked = 'fa-heart';

switch( $portfolio_args['likes_icon'] ) {
	// Star Icon
	case 'star':
		$like_icon_default = 'fa-star-o';
		$like_icon_liked = 'fa-star';
		break;
		
	// Thumb Up Icon
	case 'thumb':
		$like_icon_default = 'fa-thumbs-o-up';
		$like_icon_liked = 'fa-thumbs-up';
		break;
}
?>
<div <?php post_class( $item_class ); ?> data-portfolio-item-id="<?php echo $portfolio_item_id; ?>"<?php if ( $portfolio_terms_slugs ) : ?> data-terms="<?php echo implode( ' ', $portfolio_terms_slugs ); ?>"<?php endif; ?>>

	<?php do_action( 'kalium_portfolio_item_before', $portfolio_item_type ); ?>
	
	<?php 
	// When using Masonry Portfolio Mode
	if ( $box_size ) : 
		$masonry_box_size_asel        = laborator_generate_as_element( $masonry_asel_size ); 
		$masonry_mobile_box_size_el   = laborator_generate_as_element( $mobile_image_size ); 
	?>
	<div class="<?php echo esc_attr( "masonry-box {$masonry_box_size_asel} {$show_effect}" ); ?>"<?php echo $wow_attributes; ?>>
		<a href="<?php echo esc_url( $portfolio_item_href ); ?>" class="item-link masonry-thumb">
			<?php echo $image; ?>
		</a>
	</div>
	
	<div class="masonry-box masonry-mobile-box <?php echo $masonry_mobile_box_size_el; ?>">
		<a href="<?php echo esc_url( $portfolio_item_href ); ?>" class="item-link masonry-thumb">
			<?php echo $mobile_image; ?>
		</a>
	</div>
	<?php 
	endif; 
	// End: When using Portfolio Masonry Mode
	?>

	<div class="item-box-container">
		<div class="<?php echo esc_attr( "item-box {$show_effect}" ); ?>"<?php echo $wow_attributes; ?>>
	    	<div class="thumb">
		    	<?php if ( $hover_effect != 'none' ) : ?>
	    		<div class="<?php echo implode( ' ', $hover_state_class ); ?>">
	
		    		<?php if ( $portfolio_args['likes'] && $portfolio_args['layouts']['type_2']['show_likes'] ) : $likes = get_post_likes(); ?>
		    		<div class="likes">
			    		<a href="#" class="like-btn like-icon-<?php echo esc_attr( $portfolio_args['likes_icon'] ); ?>" data-id="<?php echo get_the_id(); ?>">
							<i class="icon fa <?php echo $likes['liked'] ? $like_icon_liked : $like_icon_default; ?>"></i>
							<span class="counter like-count">
								<?php echo esc_html( $likes['count'] ); ?>
							</span>
						</a>
			    	</div>
		    		<?php endif; ?>
	
		    		<div class="info">
			    		<h3>
				    		<a href="<?php echo esc_url( $portfolio_item_href ); ?>" class="item-link"<?php echo when_match( $portfolio_item_new_window, 'target="_blank"' ); ?>>
					    		<?php echo esc_html( $portfolio_item_title ); ?>
					    	</a>
				    	</h3>
			    		<?php include locate_template( 'tpls/portfolio-loop-item-categories.php' ); ?>
			    	</div>
			    </div>
			    <?php endif; ?>
	
				<?php if ( ! $box_size ) : ?>
				<a href="<?php echo esc_url( $portfolio_item_href ); ?>" class="item-link"<?php echo when_match( $portfolio_item_new_window, 'target="_blank"' ); ?>>
					<?php echo $image; ?>
				</a>
				<?php else: ?>				
	    		<div class="thumb-placeholder <?php echo $masonry_box_size_asel; ?>"></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<?php do_action( 'kalium_portfolio_item_after' ); ?>

</div>
