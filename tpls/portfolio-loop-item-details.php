<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


global $i, $portfolio_args;

// Item Class
$item_class = array( 'portfolio-item' );

// Item Details
$portfolio_item_id          = get_the_ID();
$portfolio_item_title       = get_the_title();
$portfolio_item_href        = get_permalink();

$portfolio_item_type        = get_field( 'item_type' );
$portfolio_item_subtitle	= get_field( 'sub_title' );

$portfolio_item_new_window  = false;

$portfolio_item_terms       = get_the_terms( $portfolio_item_id, 'portfolio_category' );
$portfolio_terms_slugs      = array();

// Featured Image Id
$post_thumbnail_id          = get_post_thumbnail_id();

	// Custom Vars
	$custom_hover_background_color     = get_field( 'custom_hover_background_color' );
	$custom_hover_color_transparency   = get_field( 'hover_color_transparency' );

	$hover_effect_style                = get_field( 'hover_effect_style' );
	$hover_layer_options               = get_field( 'hover_layer_options' );


// Portfolio Item Type Class
$item_class[] = 'portfolio-item-' . $portfolio_item_type;


// Create Term Slugs
if ( is_array( $portfolio_item_terms ) ) {
	foreach ( $portfolio_item_terms as $term ) {
		$portfolio_terms_slugs[] = $term->slug;
	}
}


// Item Effect
$reveal_effect  = $portfolio_args['reveal_effect'];
$show_effect    = '';
$reveal_delay   = 0.00;
$delay_wait     = 0.15;

if ( preg_match( '/-one/i', $reveal_effect ) ) {
	$reveal_delay = $i % ( $portfolio_args['columns'] * 2 ) * $delay_wait; //$reveal_delay = $i * $delay_wait;
}

switch ( $reveal_effect ) {
	case 'fade':
	case 'fade-one':
		$show_effect = 'fadeIn';
		break;

	case 'slidenfade':
	case 'slidenfade-one':
		$show_effect = 'fadeInLab';
		break;

	case 'zoom':
	case 'zoom-one':
		$show_effect = 'zoomIn';
		break;
}

if ( $show_effect ) {
	$show_effect = "wow {$show_effect}";
}


// Custom Link
$item_linking           = get_field( 'item_linking' );
$item_launch_link_href  = get_field( 'launch_link_href' );
$item_new_window        = get_field( 'new_window' );

if ( 'external' == $item_linking && ! empty( $item_launch_link_href ) && '#' != $item_launch_link_href ) {
	$portfolio_item_href = $item_launch_link_href;
	$portfolio_item_new_window = $item_new_window;
}