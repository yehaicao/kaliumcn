<?php
/**
 *	Kalium WordPress Theme
 *
 *	Prepare blog query and set meta information for blog template
 *
 *	Laborator.co
 *	www.laborator.co
 */

global
	$wp_query,
	$page,
	
	$blog_show_header,
	$blog_title,
	$blog_description,
	
	$blog_author_info_placement,
	$blog_author_info,
	$show_thumbnails,
	$blog_template,
	$blog_post_date,
	$blog_category,
	$blog_tags,
	$blog_post_type_icon,
	$blog_post_formats,
	$blog_post_list_lazy_load,
	$blog_columns,
	$blog_share_story,
	$share_story_networks,
	$thumbnail_hover_effect,
	$sidebar_position,
	
	$blog_proportional_thumbs,
	
	$blog_animated_eye_hover;

$posts_query = & $wp_query;

$blog_template 				= get_data( 'blog_template' );

$blog_show_header           = get_data( 'blog_show_header_title' );
$blog_title                 = get_data( 'blog_title' );
$blog_description           = get_data( 'blog_description' );

$blog_author_info_placement = get_data( 'blog_author_info_placement', 'left' );
$blog_author_info 			= get_data( 'blog_author_info' );
$show_thumbnails            = get_data( 'blog_thumbnails' );
$blog_post_date             = is_single() ? get_data( 'blog_post_date_single', true ) : get_data( 'blog_post_date', true );
$blog_category              = get_data( 'blog_category' );
$blog_tags                  = get_data( 'blog_tags' );
$blog_post_type_icon        = get_data( 'blog_post_type_icon' );
$blog_post_formats          = get_data( 'blog_post_formats' );
$blog_post_list_lazy_load   = get_data( 'blog_post_list_lazy_load' );
$blog_columns               = get_data( 'blog_columns' );
$blog_share_story			= get_data( 'blog_share_story' );
$share_story_networks		= get_data( 'blog_share_story_networks' );
$thumbnail_hover_effect     = get_data( 'blog_thumbnail_hover_effect' );

$blog_proportional_thumbs 	= get_data( 'blog_loop_proportional_thumbnails' );

$blog_animated_eye_hover	= get_data( 'blog_post_hover_animatd_eye' );

// Blog Settings
$sidebar_position = get_data( 'blog_sidebar_position' );

// Enable Blog Post Formats in Single post
if ( is_singular( 'post' ) ) {
	$blog_post_formats = true;
}

// Pagination
$pagination_type		= get_data( 'blog_pagination_type' );
$pagination_position    = get_data( 'blog_pagination_position' );
$sidebar_position		= get_data( 'blog_sidebar_position' );

// Return in case of ajax requests
if ( defined("DOING_AJAX") || is_single() ){
	return;
}

if ( is_page() ){
	$posts_query = new WP_Query( array(
		'post_type' => 'post'
	) );
}

// Taxonomy Titles
if ( $posts_query->is_category || $posts_query->is_tag ) {
	
	if ( $posts_query->is_category ) {
		$cat_term = isset( $posts_query->query['cat'] ) ? $posts_query->query['cat'] : $posts_query->query['category_name'];
		
		if ( is_numeric( $cat_term ) ) {
			$category = get_term_by( 'id', $cat_term, 'category' );
		} else {
			$category = get_term_by( 'slug', $cat_term, 'category' );
		}

		if ( $category ) {
			$blog_show_header = true;
			$blog_title =  __('Category', 'kalium') . '  / <span>' . $category->name . '</span>';
			$blog_description = $category->description;
		}
	}
	else
	if ( $posts_query->is_tag ) {
		$tag = get_term_by( 'slug', $posts_query->query['tag'], 'post_tag' );

		if ( $tag ) {
			$blog_show_header = true;
			$blog_title =  __( 'Tag', 'kalium' ) . ' / <span>' . $tag->name . '</span>';
			$blog_description = $tag->description;
		}
	}
}

$max_num_pages  = $posts_query->max_num_pages;
