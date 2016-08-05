<?php
/**
 *	Kalium WordPress Theme
 *
 *	Prepare and set the post information variables, ready to use with post formats
 *
 *	Laborator.co
 *	www.laborator.co
 */

global
	$post,
	$post_id,
	$blog_template,
	$blog_post_formats,
	$post_title,
	$post_excerpt,
	$post_content,
	$thumb_size,
	$show_thumbnails,
	$blog_post_date,
	$blog_category,
	$blog_tags,
	$blog_post_type_icon,
	$blog_post_list_lazy_load,
	$thumbnail_hover_effect,
	$format_content,
	$more;

$post_id			= get_the_ID();
$post_title         = get_the_title();
$post_excerpt       = get_the_excerpt();
$post_content       = get_the_content();

$has_thumbnail      = has_post_thumbnail();
$post_thumbnail_id	= get_post_thumbnail_id();
$post_format        = get_post_format();

$slider_images		= get_field( 'post_slider_images' );

$post_icon          = 'icon-basic-sheet-txt';
$hover_state        = 'icon-basic-eye';

$permalink			= get_permalink();


# Post Thumbnail
if ( ! isset($thumb_size) || empty($thumb_size)) {
	$thumb_size = 'blog-thumb-1';
}

$thumb_size = apply_filters( 'kalium_blog_post_thumb_size', $thumb_size );


# Featured Image Size (on single)
if ( is_single() ) {
	$post_image_size = get_field( 'post_image_size' );
	
	if ( in_array( $post_image_size, array( 'inherit', '' ) ) ) {
		$post_image_size = get_data( 'blog_featured_image_size_type' );
	}
	
	if ( $post_image_size == 'full' ) {
		$thumb_size = 'full';
	}
}

# Post Formats Icons
if ( $blog_post_type_icon ) {
	
	switch( $post_format ) {
		case 'quote':
			$post_icon = 'fa fa-quote-left';
			break;
	
		case 'video':
			$post_icon = 'icon-basic-video';
			break;
	
		case 'audio':
			$post_icon = 'icon-music-note-multiple';
			break;
	
		case 'link':
			$post_icon = 'icon-basic-link';
			break;
	
		case 'image':
			$post_icon = 'icon-basic-photo';
			break;
	
		case 'gallery':
			$post_icon = 'icon-basic-picture-multiple';
			break;
	}
}

# Parse Post Formats Content
if ( $blog_post_formats ) {
	switch( $post_format ) {
		case 'quote':
			if ( $blog_post_formats ) {
				$hover_state = '';
			}
	
			$format_content = $post_quote = kalium_extract_post_content( 'quote', true );
			break;
	
		case 'video':
			if ( $blog_post_formats ) {
				$hover_state = '';
			}
	
			$meta = array();
			
			if ( $post_thumbnail_id ) {
				$poster_size = is_single() ? 'original' : 'medium';
				$thumb = wp_get_attachment_image_src( $post_thumbnail_id, $poster_size );
				
				$meta['poster'] = $thumb[0];
				$meta['uploadedPoster'] = $post_thumbnail_id;
			}
			
			$meta['autoPlay'] = get_field( 'auto_play_video' );
			
			$format_content = $post_video = kalium_extract_post_content( 'video', true, $meta );
			break;
	
		case 'audio':
			if ( $blog_post_formats || $blog_template == 'blog-rounded' ) {
				$hover_state = '';
			}
	
			$meta = array();
	
			if ( $post_thumbnail_id ) {
				$thumb = wp_get_attachment_image_src( $post_thumbnail_id, $thumb_size );
				
				$meta['poster'] = $thumb[0];
				$meta['uploadedPoster'] = $post_thumbnail_id;
			}
			
			$meta['autoPlay'] = get_field( 'auto_play_audio' );
	
			$format_content = $post_audio = kalium_extract_post_content( 'audio', true, $meta );
			break;
	
		case 'link':
			$format_content = $post_link = kalium_extract_post_content( 'link', true );
			$hover_state = 'icon-basic-link';
			break;
	
		case 'image':
			$format_content = $post_image = kalium_extract_post_content( 'image', true );
	
			# Replace the image in case there is no thumbnail
			if ( ! $post_thumbnail_id ) {
				if ( $post_image['content'] ) {
					$thumbnail_url = $post_image['content'];
				}
			}
			break;
	
		case 'gallery':
		
			if ( count( $slider_images ) ) {
				$hover_state = '';
			}
			break;
	}
}

if ( isset( $format_content ) ) {
	$format_content['type'] = $post_format;
}

# Disable hover effect
if ( ! $thumbnail_hover_effect ) {
	$hover_state = '';
}

# Disable Post Type Icon
if ( ! $blog_post_type_icon ) {
	$post_icon = '';
}