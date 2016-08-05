<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $portfolio_args;

// Get Portfolio Options
$portfolio_args = kalium_get_portfolio_query( array( 'no_query' => true ) );

// Global Data
$portfolio_share_item           = get_data( 'portfolio_share_item' );
$portfolio_share_item_networks  = get_data( 'portfolio_share_item_networks' );
$portfolio_likes                = get_data( 'portfolio_likes' );
$portfolio_prev_next            = get_data( 'portfolio_prev_next' );

// Thumbnail
$has_thumbnail                  = has_post_thumbnail();
$post_id						= get_the_id();
$post_thumbnail_id              = get_post_thumbnail_id();

// Portfolio Details
$sub_title                      = get_field( 'sub_title' );

$checklists                     = get_field( 'checklists' );

$launch_link_title              = get_field( 'launch_link_title' );
$launch_link_href               = get_field( 'launch_link_href' );
$new_window                     = get_field( 'new_window' );

$gallery_items                  = get_field( 'gallery' );
$gallery_type                   = get_field( 'gallery_type' );
$gallery_stick_to_top           = get_field( 'gallery_stick_to_top' );

$images_reveal_effect           = get_field( 'images_reveal_effect' );
$image_spacing                  = get_field( 'image_spacing' );

$description_alignment          = get_field( 'item_description_alignment' );
$description_width              = get_field( 'item_description_width' );
$sticky_description             = get_field( 'sticky_description' );

// Portfolio Type 2 Information
$layout_type                    = get_field( 'layout_type' );
$share_and_like_position        = get_field( 'share_and_like_position' );
$full_width_gallery             = get_field( 'full_width_gallery' );
$show_featured_image            = get_field( 'show_featured_image' );
$fullwidth_featured_image       = get_field( 'fullwidth_featured_image' );
$title_position                 = get_field( 'title_position' );


if ( ! is_array( $gallery_items ) ) {
	$gallery_items = array();
}

if ( ! is_array( $checklists ) ) {
	$checklists = array();
}