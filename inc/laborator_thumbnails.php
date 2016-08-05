<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

// Blog Single Thumbnail
$blog_single_height = get_data( 'blog_thumbnail_height' );

if ( ! is_numeric( $blog_single_height ) ) {
	$blog_single_height = 635;
}

add_image_size( 'blog-thumb-1', 468, 328, true );
add_image_size( 'blog-thumb-2', 468, 468, true );
add_image_size( 'blog-thumb-3', 845, 592, true );
add_image_size( 'blog-single-1', 1482, $blog_single_height, $blog_single_height != 0 );


// Portfolio Single Thumbs
$max_portfolio_width = apply_filters( 'kalium_portfolio_image_max_width', 1240 );

add_image_size( 'portfolio-single-img-1', $max_portfolio_width * 1.30 );
add_image_size( 'portfolio-single-img-2', $max_portfolio_width * 0.90 );
add_image_size( 'portfolio-single-img-3', $max_portfolio_width * 0.65 );
add_image_size( 'portfolio-single-img-4', $max_portfolio_width * 0.45 );


// Portfolio Loop Thumbs
$portfolio_thumbnail_size_1 = get_data( 'portfolio_thumbnail_size_1' );
$portfolio_thumbnail_size_2 = get_data( 'portfolio_thumbnail_size_2' );

	// Portfolio with Titles Below Thumbnail
	if ( empty( $portfolio_thumbnail_size_1 ) || preg_match( "/^[0-9]+(x|×)[0-9]+$/", $portfolio_thumbnail_size_1 ) ) {
		$portfolio_thumbnail_size_1 = $portfolio_thumbnail_size_1 ? $portfolio_thumbnail_size_1 : "655x545";
		$portfolio_thumbnail_size_1 = explode( "x", $portfolio_thumbnail_size_1 );
		
		add_image_size( 'portfolio-img-1', $portfolio_thumbnail_size_1[0], $portfolio_thumbnail_size_1[1], true );
	} elseif ( ! empty( $portfolio_thumbnail_size_1 ) ) {
		add_filter( 'kalium_portfolio_loop_thumbnail_1', create_function( '$size', 'return "' . addslashes( $portfolio_thumbnail_size_1 ) . '";' ) );
	}
	
	// Portfolio with Inside Box Titles
	if ( empty( $portfolio_thumbnail_size_2 ) || preg_match( "/^[0-9]+(x|×)[0-9]+$/", $portfolio_thumbnail_size_2 ) ) {
		$portfolio_thumbnail_size_2 = $portfolio_thumbnail_size_2 ? $portfolio_thumbnail_size_2 : "655x545";
		$portfolio_thumbnail_size_2 = explode( "x", $portfolio_thumbnail_size_2 );
		
		add_image_size( 'portfolio-img-2', $portfolio_thumbnail_size_2[0], $portfolio_thumbnail_size_2[1], true );
		add_image_size( 'portfolio-img-3', $portfolio_thumbnail_size_2[0] );
	} elseif ( ! empty( $portfolio_thumbnail_size_2 ) ) {
		add_filter( 'kalium_portfolio_loop_thumbnail_2', create_function( '$size', 'return "' . addslashes( $portfolio_thumbnail_size_2 ) . '";' ) );
	}

// Shop Thumbnails
add_image_size( 'shop-loop-thumb-1', 468, 598, true );