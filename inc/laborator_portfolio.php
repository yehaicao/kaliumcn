<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

// Location Rules for Portfolio Item Types
add_filter( 'acf/location/rule_types', 'laborator_acf_location_rules_types' );
add_filter( 'acf/location/match_field_groups', 'laborator_acf_location_rules_match_field_groups', 10, 3 );
add_filter( 'acf/location/rule_values/portfolio_item_type', 'laborator_acf_location_rules_values_item_type' );
add_filter( 'acf/location/rule_match/portfolio_item_type', 'laborator_acf_location_rules_item_type', 10, 3 );

function laborator_acf_location_rules_types( $choices ) {
	$choices['Other']['portfolio_item_type'] = 'Portfolio Item Type';
	return $choices;
}

function laborator_acf_location_rules_match_field_groups( $field_groups = array(), $options = array() ) {
	
	if ( ! defined( 'DOING_AJAX' ) ) {
		return $field_groups;
	}
	
	// Match Portfolio Item Type Group Fields
	if ( isset( $options['item_type'] ) ) {
		$post_id = $options['post_id'];
		
		// Update Current Portfolio Item Type
		$current_item_type = get_field( 'item_type', $post_id );
		update_field( 'item_type', $options['item_type'], $post_id );
		
		// Match New Rules
		$acf_location = new acf_location();
		$field_groups = $acf_location->match_field_groups( array(), $options );
		
		// Revert Back the Current Type
		if ( empty( $current_item_type ) ) {
			delete_field( 'item_type', $post_id );
		} else  {
			update_field( 'item_type', $current_item_type, $post_id );
		}
	}
	
	return $field_groups;
}

function laborator_acf_location_rules_values_item_type( $choices ) {
	$portfolio_item_types = array(
		'type-1' => 'Side Portfolio',
		'type-2' => 'Columned',
		'type-3' => 'Carousel',
		'type-4' => 'Zig Zag',
		'type-5' => 'Fullscreen',
		'type-6' => 'Lightbox',
		'type-7' => 'Visual Composer',
	);

	return $portfolio_item_types;
}

function laborator_acf_location_rules_item_type( $match, $rule, $options ) {
	$rule_item_type = $rule['value'];

	if ( $options['post_id'] ) {
		// Current Post
		$current_post = get_post( $options['post_id'] );
		$item_type = $current_post->item_type;

		if ( $rule['operator'] == "==" ) {
			return $rule_item_type == $item_type;
		}
	}
}


// Portfolio Like Column
add_filter( 'manage_edit-portfolio_columns', 'laborator_portfolio_like_column' );
add_action( 'manage_portfolio_posts_custom_column', 'laborator_portfolio_like_column_content', 10, 2 );

add_action( 'wp_ajax_lab_portfolio_reset_likes', 'lab_portfolio_reset_likes_ajax' );

function laborator_portfolio_like_column( $columns ) {
	$last_column = array_keys( $columns );
	$last_column = end( $last_column );
	
	$last_column_title = end( $columns );
	
	unset( $columns[ $last_column ] );
	
	$columns['likes'] = 'Likes';
	$columns[ $last_column ] = $last_column_title;
	
	return $columns;
}

function laborator_portfolio_like_column_content( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case "likes":
			$likes = get_post_likes();
			echo '<span class="likes-num">' . number_format_i18n( $likes['count'], 0 ) . '</span>';
			echo ' <a href="#" data-id="' . $post_id . '" class="portfolio-likes-reset" title="Reset likes for this item"> - <span>Reset</span></a>';
			break;
	}
}

function lab_portfolio_reset_likes_ajax() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}
	
	if ( isset( $_POST['post_id'] ) && is_numeric( $_POST['post_id'] ) ) {
		$post_id = $_POST['post_id'];
		$post = get_post( $post_id );
		
		if ( $post && $post->post_type == 'portfolio' ) {
			update_post_meta( $post_id, 'post_likes', array() );
			
			die( 'success' );
		}
	}
}

// Portfolio Type Column
add_filter( 'manage_edit-portfolio_columns', 'kalium_portfolio_item_type_column_filter' ) ;
add_action( 'manage_portfolio_posts_custom_column', 'kalium_portfolio_item_type_column_content_action', 10, 2 );
add_action( 'restrict_manage_posts', 'kalium_portfolio_item_type_filter_dropdown' );
add_filter( 'parse_query', 'kalium_portfolio_item_type_filter_query_request' );


function kalium_portfolio_item_type_column_filter( $columns ) {

	$columns['item_type'] = 'Item Type';
	
	if ( isset( $columns['comments'] ) ) {
		unset( $columns['comments'] );
	}
	
	if ( apply_filters( 'kalium_portfolio_remove_author_column', true ) ) {
		unset( $columns['author'] );
	}

	return $columns;
}

function kalium_portfolio_item_type_column_content_action( $column, $post_id ) {
	global $post;
	
	if ( $column == 'item_type' ) {
		
		$item_type = get_field( 'item_type' );
		
		$item_types = array(
			'type-1' => 'Side Portfolio',
			'type-2' => 'Columned',
			'type-3' => 'Carousel',
			'type-4' => 'Zig Zag',
			'type-5' => 'Fullscreen',
			'type-6' => 'Lightbox',
			'type-7' => 'Visual Composer',
		);
		
		if ( isset( $item_types[ $item_type ] ) ) :
		?>
		<a href="<?php echo add_query_arg( array( 'portfolio_item_type' => $item_type ) ); // get_edit_post_link( $post ); ?>" class="portfolio-item-type-column">
			<img src="<?php echo THEMEASSETS . 'images/admin/portfolio-item-' . $item_type . '.png'; ?>" />
			<?php echo $item_types[ $item_type ]; ?>
		</a>
		<?php
		endif;
	}
}

function kalium_portfolio_item_type_filter_dropdown() {
	global $pagenow, $typenow;
	
	if ( $pagenow == 'edit.php' && $typenow == 'portfolio' ) {
		
		$current_item_type = lab_get( 'portfolio_item_type' );
		
		$item_types = array(
			'type-1' => 'Side Portfolio',
			'type-2' => 'Columned',
			'type-3' => 'Carousel',
			'type-4' => 'Zig Zag',
			'type-5' => 'Fullscreen',
			'type-6' => 'Lightbox',
			'type-7' => 'Visual Composer',
		);
		?>
		<select name="portfolio_item_type" class="postform">
			<option value="">All item types</option>
			<?php
			foreach( $item_types as $item_type => $name ) :
				?>
				<option <?php echo selected( $current_item_type, $item_type ); ?> value="<?php echo $item_type; ?>"><?php echo $name; ?></option>
				<?php
			endforeach;
			?>
		</select>
		<?php
	}
}

function kalium_portfolio_item_type_filter_query_request( $query ) {
	global $pagenow, $typenow;
	
	$item_type = lab_get( 'portfolio_item_type' );
	
	if ( $pagenow == 'edit.php' && $typenow == 'portfolio' && ! empty( $item_type ) ) {
		$query->query_vars[ 'meta_key' ] = 'item_type';
		$query->query_vars[ 'meta_value' ] = $item_type;
	}
	
	return $query;
}


// Portfolio Listing Lightbox Entries
global $lb_entry_index;
$lb_entry_index = 0;

function kalium_portfolio_get_lightbox_settings_and_items( $items, $gallery_id = 'portfolio-slider' ) {
	wp_enqueue_script( 'light-gallery' );
	wp_enqueue_style( array( 'light-gallery', 'light-gallery-transitions' ) );
	
	$portfolio_lb_speed = get_data( 'portfolio_lb_speed' );
	$portfolio_lb_hide_bars_delay = get_data( 'portfolio_lb_hide_bars_delay' );
	
	$portfolio_lb_thumbnails_container_height = get_data( 'portfolio_lb_thumbnails_container_height' );
	$portfolio_lb_thumbnails_width = get_data( 'portfolio_lb_thumbnails_width' );
	
	$portfolio_lb_autoplay_pause = get_data( 'portfolio_lb_autoplay_pause' );
	$portfolio_lb_zoom = get_data( 'portfolio_lb_zoom', '1' );
	
	$portfolio_lb_zoom_scale = get_data( 'portfolio_lb_zoom_scale' );
	
	$lg_options = array(
		
		'galleryId'				  => $gallery_id,
		
		// Mode
		'mode'                    => get_data( 'portfolio_lb_mode', 'lg-fade' ),
		
		// Connected Items
		'singleNavMode'		  	  => kalium_lb_get_navigation_mode() == 'single',
		
		// Transitions Params
		'speed'                   => $portfolio_lb_speed ? floatval( $portfolio_lb_speed * 1000 ) : 600,
		'hideBarsDelay'           => $portfolio_lb_hide_bars_delay ? floatval( $portfolio_lb_hide_bars_delay * 1000 ) : 3000,
		
		// General Settings
		'hash'             		  => false,
		'loop'                    => wp_validate_boolean( get_data( 'portfolio_lb_loop', '1' ) ),
		'kaliumHash'              => wp_validate_boolean( get_data( 'portfolio_lb_hash', '1' ) ),
		'download'                => wp_validate_boolean( get_data( 'portfolio_lb_download', '1' ) ),
		'counter'                 => wp_validate_boolean( get_data( 'portfolio_lb_counter', '1' ) ),
		'enableDrag'              => wp_validate_boolean( get_data( 'portfolio_lb_draggable', '1' ) ),
		
		// Pager
		'pager'                   => wp_validate_boolean( get_data( 'portfolio_lb_pager', '0' ) ),
		
		// Full Screen
		'fullScreen'              => wp_validate_boolean( get_data( 'portfolio_lb_fullscreen', '1' ) ),
		
		// Thumbnails
		'thumbnail'               => wp_validate_boolean( get_data( 'portfolio_lb_thumbnails', '1' ) ),
		'animateThumb'            => wp_validate_boolean( get_data( 'portfolio_lb_thumbnails_animated', '1' ) ),
		'pullCaptionUp'           => wp_validate_boolean( get_data( 'portfolio_lb_thumbnails_pullcaptions_up', '1' ) ),
		'showThumbByDefault'      => wp_validate_boolean( get_data( 'portfolio_lb_thumbnails_show', '0' ) ),
		
		'thumbContHeight'         => $portfolio_lb_thumbnails_container_height ? intval( $portfolio_lb_thumbnails_container_height ) : 100,
		'thumbWidth'              => $portfolio_lb_thumbnails_width ? intval( $portfolio_lb_thumbnails_width ) : 100,
		
		'currentPagerPosition'    => 'middle',//TMPget_data( 'portfolio_lb_thumbnails_pager_position', 'middle' ),
		
		// Auto Play
		'autoplay'                => wp_validate_boolean( get_data( 'portfolio_lb_autoplay', '1' ) ),
		'autoplayControls'        => wp_validate_boolean( get_data( 'portfolio_lb_autoplay_controls', '1' ) ),
		'fourceAutoplay'          => wp_validate_boolean( get_data( 'portfolio_lb_autoplay_force_autoplay', '1' ) ),
		'progressBar'             => wp_validate_boolean( get_data( 'portfolio_lb_autoplay_progressbar', '1' ) ),
		
		'pause'                   => $portfolio_lb_autoplay_pause ? floatval( $portfolio_lb_autoplay_pause * 1000 ) : 5000,
		
		// Zoom
		'zoom'                    => wp_validate_boolean( $portfolio_lb_zoom ),
		'scale'                   => $portfolio_lb_zoom_scale ? floatval( $portfolio_lb_zoom_scale ) : 1,
		
		'startClass'			  => 'lg-start-fade ' . get_data( 'portfolio_lb_skin', 'lg-skin-kalium-default' ),
	);
	
	$lg_options = apply_filters( 'kalium_lg_options', $lg_options );
	
	// Transparent Header Bar
	$transparent_bar = ! $lg_options['download'] && ! $lg_options['counter'] && ! $lg_options['fullScreen'] && ! $lg_options['autoplay'] && ! $lg_options['zoom'];

	if ( $transparent_bar ) {
		$lg_options['startClass'] .= ' transparent-header-bar';
	}
	
	// Prepare Lightbox Items for JS
	$items_js = array();
	
	foreach( $items as $wp_post ) {
		$items_js = array_merge( $items_js, kalium_portfolio_item_lightbox_entry( $wp_post ) );
	}
	
	return array(
		'options' => $lg_options,
		'entries' => $items_js
	);
}


function kalium_portfolio_item_lightbox_entry( $wp_post ) {
	
	if ( ! $wp_post instanceof WP_Post ) {
		return array();
	}
	
	$post_id = $wp_post->ID;
	
	$lb_entries 	   = array();
	
	$content_to_show   = get_field( 'content_to_show', $post_id );

	$custom_image      = get_field( 'custom_image', $post_id );
	$gallery           = get_field( 'image_and_video_gallery', $post_id );
	
	$self_hosted_video = get_field( 'self_hosted_video', $post_id );
	$youtube_video_url = get_field( 'youtube_video_url', $post_id );
	$vimeo_video_url   = get_field( 'vimeo_video_url', $post_id );
	
	$video_poster	   = get_field( 'video_poster', $post_id );
	
	switch ( $content_to_show ) {
		case 'other-image':
			$lb_entries[] = kalium_portfolio_lightbox_prepare_item( $wp_post, 'other-image', $custom_image );
			break;
		
		case 'gallery':
			foreach ( $gallery as $i => $item ) {
				$lb_entry = null;
				if (is_array($item)){ //判断是否不为空，为空会报错
				if ( preg_match( "/image\/.*/i", $item['mime_type'] ) ) { // Image Type
					$lb_entry = kalium_portfolio_lightbox_prepare_item( $wp_post, 'gallery-item-image', $item );
				} elseif ( preg_match( "/video\/.*/i", $item['mime_type'] ) ) { // Video Type
					$lb_entry = kalium_portfolio_lightbox_prepare_item( $wp_post, 'gallery-item-video', $item );
				}
			  }
				if ( $lb_entry ) {
					$lb_entry['subIndex'] = $i;
					$lb_entries[] = $lb_entry;
				}
			}
			break;
		
		case 'self-hosted-video':
			if ( preg_match( "/video\/.*/i", $self_hosted_video['mime_type'] ) ) {
				$lb_entries[] = kalium_portfolio_lightbox_prepare_item( $wp_post, 'gallery-item-video', $self_hosted_video, array ( 'poster' => $video_poster ) );
			}
			break;
		
		case 'youtube':
			if ( preg_match( '/youtube\.com/', $youtube_video_url ) ) {
				$lb_entries[] = kalium_portfolio_lightbox_prepare_item( $wp_post, 'youtube-video', $youtube_video_url, array ( 'poster' => $video_poster ) );
			}
			break;
		
		case 'vimeo':
			if ( preg_match( '/vimeo\.com/', $vimeo_video_url ) ) {
				$lb_entries[] = kalium_portfolio_lightbox_prepare_item( $wp_post, 'vimeo-video', $vimeo_video_url, array ( 'poster' => $video_poster )  );
			}
			break;
			
		default:
			$lb_entries[] = kalium_portfolio_lightbox_prepare_item( $wp_post, 'featured-image' );
	}
	
	// Remove Empty Entries
	foreach ( $lb_entries as & $lb_entry ) {
		$lb_entry['hash'] = $lb_entry['subIndex'] == 0 ? $lb_entry['slug'] : "{$lb_entry['slug']}/{$lb_entry['subIndex']}";
	}
	
	return array_filter( $lb_entries );
}

// Prepare Gallery Item
function kalium_portfolio_lightbox_prepare_item( $wp_post, $item_type, $item = null, $args = array() ) {
	global $post, $lb_entry_index;
	
	// Lightbox Object
	$lb_entry = array();
	
	// Get Information
	$post_id           = $wp_post->ID;
	$post_name         = $wp_post->post_name;
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	
	$content_to_show   = get_field( 'content_to_show', $post_id );
	$custom_image      = get_field( 'custom_image', $post_id );
	
	// Caption
	$caption_title = '';
	$caption_text = '';
	
	// Image Sizes
	$image_size_large = apply_filters( 'kalium_lightbox_image_size_large', 'original' );
	$image_size_thumb = apply_filters( 'kalium_lightbox_image_size_thumbnail', 'thumbnail' );
	$image_size_downl = apply_filters( 'kalium_lightbox_image_size_download', 'original' );

	switch ( $item_type ) {
		
		// Show Custom Image
		case 'other-image' :
			$caption_title   = get_the_title( $wp_post );
			$caption_text    = $wp_post->post_content;
		
			$img_large = wp_get_attachment_image_src( $item, $image_size_large );
			$img_thumb = wp_get_attachment_image_src( $item, $image_size_thumb );
			
			$img_downl = wp_get_attachment_image_src( $item, $image_size_downl );
			
			$lb_entry['src']         = $img_large[0];
			$lb_entry['thumb']       = $img_thumb[0];
			$lb_entry['downloadUrl'] = $img_downl[0];	
			break;
		
		// Gallery Image Item
		case 'gallery-item-image' :
			$caption_title   = $item['title'];
			$caption_text    = $item['caption'] ? $item['caption'] : $item['description'];
		
			$img_large = wp_get_attachment_image_src( $item['id'], $image_size_large );
			$img_thumb = wp_get_attachment_image_src( $item['id'], $image_size_thumb );
			
			$img_downl = wp_get_attachment_image_src( $item['id'], $image_size_downl );
			
			$lb_entry['src']         = $img_large[0];
			$lb_entry['thumb']       = $img_thumb[0];
			$lb_entry['downloadUrl'] = $img_downl[0];
			
			break;
		
		// Gallery Video Item
		case 'gallery-item-video' :
			$caption_title   = $item['title'];
			$caption_text    = $item['caption'] ? $item['caption'] : $item['description'];
			
			if ( ! empty( $args['poster'] ) ) {
				$img_large = wp_get_attachment_image_src( $args['poster'], $image_size_large );
				$img_thumb = wp_get_attachment_image_src( $args['poster'], $image_size_thumb );
				
				$lb_entry['poster'] = $img_large[0];
			} else {
				$img_thumb = wp_get_attachment_image_src( $post_thumbnail_id, $image_size_thumb );
			}
			
			$video_id = 'video-' . md5( $item['id'] . $item['url'] );
			
			if ( ! empty( $img_large[0] ) ) {
				$lb_entry['poster']  = $img_large[0];
			}
			
			$lb_entry['thumb']   = $img_thumb[0];
			$lb_entry['html']    = '#' . $video_id;
			
			ob_start();
			?>
			<div id="<?php echo $video_id; ?>" class="hidden">
				<video class="lg-video-object lg-html5" controls preload="none">
					<source src="<?php echo $item['url']; ?>" type="<?php echo $item['mime_type']; ?>">
					<?php _e( 'Your browser does not support HTML5 video.', 'kalium' ); ?>
				</video>
			</div>
			<?php
			$video_footer_append = ob_get_clean();
			laborator_append_content_to_footer( $video_footer_append );
			
			
			/*
			$type = explode( '.', $item['url'] );
			$type = strtolower( end( $type ) );
			
			$shortcode = '[video ' . $type . '="' . esc_attr( $item['url'] ) . '"][/video]';
			
			$lg_class_fn = create_function( '$classes', '$classes .= " lg-video-object lg-html5"; return $classes;' );
			add_filter( 'wp_video_shortcode_class', $lg_class_fn );
			
			?>
			<div id="<?php echo $video_id; ?>" class="hidden">
				<?php echo do_shortcode( $shortcode ); ?>
			</div>
			<?php
			remove_filter( 'wp_video_shortcode_class', $lg_class_fn );
			*/
			break;
		
		
		// YouTube & Vimeo Video
		case 'youtube-video' :
		case 'vimeo-video' :
			$caption_title   = get_the_title( $wp_post );
			$caption_text    = $wp_post->post_content;
			
			
			if ( ! empty( $args['poster'] ) ) {
				$img_large = wp_get_attachment_image_src( $args['poster'], $image_size_large );
				$img_thumb = wp_get_attachment_image_src( $args['poster'], $image_size_thumb );
				
				$lb_entry['poster'] = $img_large[0];
			} else {
				$img_thumb = wp_get_attachment_image_src( $post_thumbnail_id, $image_size_thumb );
			}
			
			$lb_entry['href']    = $item;
			$lb_entry['src']     = $lb_entry['href'];
			$lb_entry['thumb']   = $img_thumb[0];
			break;
			
		
		// Show Featured Image
		case 'featured-image' :
			$caption_title   = get_the_title( $wp_post );
			$caption_text    = $wp_post->post_content;
		
			$img_large = wp_get_attachment_image_src( $post_thumbnail_id, $image_size_large );
			$img_thumb = wp_get_attachment_image_src( $post_thumbnail_id, $image_size_thumb );
			
			$img_downl = wp_get_attachment_image_src( $post_thumbnail_id, $image_size_downl );
			
			$lb_entry['src']         = $img_large[0];
			$lb_entry['thumb']       = $img_thumb[0];
			$lb_entry['downloadUrl'] = $img_downl[0];
			break;
	}
	
	if ( get_data( 'portfolio_lb_captions' ) && ! defined( 'DOING_AJAX' ) ) :
		
		ob_start();
	
		$caption_id = laborator_unique_id();
		$lb_entry['subHtml'] = '#lb-caption-' . $caption_id;
		?>
		<div id="lb-caption-<?php echo $caption_id; ?>" class="hidden">
			<?php if ( isset( $caption_title ) ) : ?>
			<h4><?php echo $caption_title; ?></h4>
			<?php endif; ?>
			
			<?php 
			if ( isset( $caption_text ) ) : 
				echo apply_filters( 'the_content', $caption_text );
			endif; 
			?>
		</div>
		<?php
			
		$caption_html = ob_get_clean();
		
		laborator_append_content_to_footer( $caption_html );
			
	endif;
	
	$lb_entry['portfolioItemId']   = $post_id;
	$lb_entry['slug']              = $post_name;
	$lb_entry['index']             = $lb_entry_index++;
	$lb_entry['subIndex']          = 0;
	
	return $lb_entry;
}


// Custom Image Size
$portfolio_lb_image_size_large = get_data( 'portfolio_lb_image_size_large' );
$portfolio_lb_image_size_thumbnail = get_data( 'portfolio_lb_image_size_thumbnail' );

if ( ! empty( $portfolio_lb_image_size_large ) ) {
	add_filter( 'kalium_lightbox_image_size_large', laborator_immediate_return_fn( $portfolio_lb_image_size_large ), 10  );
}

if ( ! empty( $portfolio_lb_image_size_thumbnail ) ) {
	add_filter( 'kalium_lightbox_image_size_thumbnail', laborator_immediate_return_fn( $portfolio_lb_image_size_thumbnail ), 10  );
}

// Lightbox Gallery Skin
add_filter( 'body_class', create_function( '$classes', '$classes[] = "body-' . str_replace( ' ', '-', get_data( 'portfolio_lb_skin' ) ) . '"; return $classes;' ) );


// Get Lightbox Navigation mode
function kalium_lb_get_navigation_mode() {
	if ( in_array( get_data( 'portfolio_lb_navigation_mode' ), array( '', 'single' ) ) ) {
		return 'single';
	}
	
	return 'linked';
}

// Remove Tags Column for Portfolio post type
if ( ! get_data( 'portfolio_enable_tags' ) ) {
	add_filter( 'portfolioposttype_tag_args', 'portfolioposttype_tag_args_remove_tags_column' );
}

function portfolioposttype_tag_args_remove_tags_column( $args ) {
	$args['show_admin_column'] = false;
	$args['show_ui'] = false;
	
	return $args;
}

// Render Portfolio Loop Item
function kalium_portfolio_loop_items_show( $portfolio_args, $return = false ) {
	global $portfolio_args, $i;

	ob_start();
	
	$i = 0;
	
	while ( $portfolio_args['portfolio_query']->have_posts() ) : $portfolio_args['portfolio_query']->the_post();

		switch ( $portfolio_args['layout_type'] ) {
			case 'type-1':
				include locate_template( 'tpls/portfolio-loop-item-type-1.php' );
				break;

			case 'type-2':
				include locate_template( 'tpls/portfolio-loop-item-type-2.php' );
				break;
		}
		
		$i++;

	endwhile;
	
	$html = ob_get_clean();
	
	wp_reset_postdata();
	
	if ( $return ) {
		return $html;
	} else {
		echo $html;
	}
}

// Get Portfolio Query Arguments
$portfolio_instance_id = 1;

function kalium_get_portfolio_query( $opts = array() ) {
	global $portfolio_instance_id;
	
	
	// Set post ID/path when string or number is given
	if ( is_numeric( $opts ) || is_string( $opts ) ) {
		$opts = array( 'post_id' => $opts );
	}
	
	$layout_type   = get_data( 'portfolio_type' );
	$category_var  = kalium_portfolio_get_category_endpoint_var();
	$vc_mode       = false;
	
	// Get Portfolio Args from Visual Composer Element
	if ( isset( $opts['vc_attributes'] ) ) {
		$vc_mode       = true;
		$vc_attributes = $opts['vc_attributes'];
		
		// Set Layout Type
		if ( isset( $vc_attributes['portfolio_type'] ) ) {
			$layout_type = $vc_attributes['portfolio_type'];
		}
	}
	
	$args = array(
		
		// Main Vars
		'layout_type'                 => $layout_type,
		'reveal_effect'               => get_data( 'portfolio_reveal_effect' ),
		'subtitles'                   => get_data( 'portfolio_loop_subtitles' ),
		'fullwidth'					  => get_data( 'portfolio_full_width' ),
		'fullwidth_title_container'	  => get_data( 'portfolio_full_width_title_filter_container' ),
		
		// Likes
		'likes'                       => get_data( 'portfolio_likes' ),
		'likes_icon'				  => get_data( 'portfolio_likes_icon' ),
		
		// Share
		'share'						  => get_data( 'portfolio_share_item' ),
		'share_layout'				  => get_data( 'portfolio_like_share_layout' ),
		'share_networks'			  => get_data( 'portfolio_share_item_networks' ),
		
		// Run as Visual Composer Mode
		'vc_mode'                     => $vc_mode,
		'vc_attributes'               => array(),
		
		// Is Page Mode
		'is_page'                     => false,
		
		// Portfolio Title Section
		'show_title'                  => get_data( 'portfolio_show_header_title' ),
		'title'                       => get_data( 'portfolio_title' ),
		'description'                 => get_data( 'portfolio_description' ),
		
		// Portfolio Archive URL
		'url'                         => get_data( 'portfolio_archive_url' ) ? get_data( 'portfolio_archive_url' ) : get_post_type_archive_link( 'portfolio' ),
		'archive_url_to_category'	  => get_data( 'portfolio_archive_url_category' ),
		
		// Rewrite
		'rewrite'                     => array(
			'portfolio_prefix'           => get_data( 'portfolio_prefix_url_slug' ),
			'category_prefix'            => get_data( 'portfolio_category_prefix_url_slug' )
		),
		
		// Portfolio Layout Types
		'layouts'                     => array(
			
			// Portfolio Layout Type 1
			'type_1'                     => array(
				'dynamic_image_height'      => get_data( 'portfolio_type_1_dynamic_height' ),
				'animated_eye'              => get_data( 'portfolio_type_1_hover_animatd_eye' ),
				
				// Hover
				'hover_effect'              => get_data( 'portfolio_type_1_hover_effect' ),
				'hover_color'               => get_data( 'portfolio_type_1_hover_color' ),
				'hover_transparency'        => get_data( 'portfolio_type_1_hover_transparency' ),
			),
			
			// Portfolio Layout Type 2
			'type_2'                     => array(
				'dynamic_image_height'      => false,
				'show_likes'                => get_data( 'portfolio_type_2_likes_show' ),
				
				'grid_spacing'              => get_data( 'portfolio_type_2_grid_spacing' ),
				'default_spacing'           => get_data( 'portfolio_type_2_default_spacing' ),
				
				// Hover
				'hover_effect'              => get_data( 'portfolio_type_2_hover_effect' ),
				'hover_color'               => get_data( 'portfolio_type_2_hover_color' ),
				'hover_transparency'        => get_data( 'portfolio_type_2_hover_transparency' ),
				'hover_style'               => get_data( 'portfolio_type_2_hover_style' ),
				'hover_text_position'       => get_data( 'portfolio_type_2_hover_text_position' ),
			)
		),
		
		// Portfolio Single Item Options
		'single'                      => array(
			
			// Single previous-next navigation links
			'prev_next'                  => array(
				// Type and Position
				'type'                      => get_data( 'portfolio_prev_next_type' ),
				'position'                  => get_data( 'portfolio_prev_next_position' ),
				
				// Include Categories
				'include_categories'        => get_data( 'portfolio_prev_next_category' ) ? true : false,
				
				// Show prev/next as titles
				'show_titles'               => get_data( 'portfolio_prev_next_show_titles' ) ? true : false,
			)
		),
		
		// Columns
		'columns'                     => get_data( $layout_type == 'type-1' ? 'portfolio_type_1_columns_count' : 'portfolio_type_2_columns_count' ),
		
		// Posts per Page
		'per_page'                    => get_data( $layout_type == 'type-1' ? 'portfolio_type_1_items_per_page' : 'portfolio_type_2_items_per_page' ),
		'endless_per_page'            => get_data( 'portfolio_endless_pagination_fetch_count' ),
		
		// Pagination
		'pagination'                  => array(
			'page'                       => isset( $opts['paged'] ) ? $opts['paged'] : $GLOBALS['paged'],
			'type'                       => get_data( 'portfolio_pagination_type' ),
			'align'                      => get_data( 'portfolio_pagination_position' ),
			
			// Endless Pagination Options
			'endless'                    => array(
				// Endless Pagination Style
				'style'						=> get_data( 'portfolio_endless_pagination_style' ),
				
				// Labels
				'show_more_text'            => __( 'Show More', 'kalium' ),
				'no_more_items_text'        => __( 'No more portfolio items to show', 'kalium' ),
			)
		),
		
		// Set Current Category
		'category'                    => '',
		
		// Category Filter
		'category_filter'             => get_data( 'portfolio_category_filter' ),
		'category_filter_subs'        => get_data( 'portfolio_filter_enable_subcategories' ),
		'category_filter_pushtate'	  => get_data( 'portfolio_filter_link_type' ) == 'pushState',
		
		// Custom Query
		'custom_query'                => array(),
			
		// Masonry Portfolio
		'masonry_items'               => array(),
		
		// Portfolio Query
		'query'                       => array(
			'post_type'                  => 'portfolio'
		)
	);
	
	// Portfolio Instance ID
	$args['id'] = ( empty( $args['rewrite']['portfolio_prefix'] ) == false ? $args['rewrite']['portfolio_prefix'] : 'portfolio' ) . '-' . $portfolio_instance_id++;
	
	// Per Page (default value)
	if ( empty( $args['per_page'] ) ) {
		$args['per_page'] = absint( get_option( 'posts_per_page' ) );
	}
	
	// Override Visual Composer Attributes
	if ( $vc_mode && isset( $vc_attributes ) ) {
		
		// Set VC Attributes as $args option to pass on AJAX
		$args['vc_attributes'] = $vc_attributes;
		
		// Portfolio Query
		if ( isset( $vc_attributes['portfolio_query'] ) ) {
			$args['query'] = array_merge( $args['query'], kalium_vc_query_builder( $vc_attributes['portfolio_query'] ) );
			
			// Posts per Page
			if ( isset( $args['query']['posts_per_page'] ) ) {
				$args['per_page'] = $args['query']['posts_per_page'];
			}
		}
		
		// Dynamic Image Height
		if ( isset( $vc_attributes['dynamic_image_height'] ) ) {
			$vc_dynamic_image_height = $vc_attributes['dynamic_image_height'] == 'yes';
			$args['layouts'][ $layout_type == 'type-1' ? 'type_1' : 'type_2' ]['dynamic_image_height'] = $vc_dynamic_image_height;
		}
		
		// Columns - Inherit From Theme Options
		if ( isset( $vc_attributes['columns'] ) && $vc_attributes['columns'] != 'inherit' ) {
			$args['columns'] = $vc_attributes['columns'];	
		}
		
		// Item Spacing
		if ( $layout_type == 'type-2' && isset( $vc_attributes['portfolio_spacing'] ) && $vc_attributes['portfolio_spacing'] != 'inherit' ) {
			$args['layouts']['type_2']['grid_spacing'] = $vc_attributes['portfolio_spacing'] == 'yes' ? 'normal' : 'merged';
		}
		
		// Portfolio Title and Description
		if ( isset( $vc_attributes['title'] ) ) {
			$args['title'] = $vc_attributes['title'];
		}
		
		if ( isset( $vc_attributes['description'] ) ) {
			$args['description'] = $vc_attributes['description'];
		}
		
		// Portfolio Filter
		if ( isset( $vc_attributes['category_filter'] ) ) {
			$args['category_filter'] = $vc_attributes['category_filter'] == 'yes';
		}
		
		// Reveal Effect
		if ( isset( $vc_attributes['reveal_effect'] ) && $vc_attributes['reveal_effect'] != 'inherit' ) {
			$args['reveal_effect'] = $vc_attributes['reveal_effect'];
		}
		
		// Masonry Items
		if ( isset( $vc_attributes['masonry_items'] ) ) {
			$args['masonry_items']     = $vc_attributes['masonry_items'];
			$args['masonry_items_ids'] = $vc_attributes['masonry_items_ids'];
		}
		
		// Per Page
		if ( isset( $vc_attributes['per_page'] ) ) {
			$args['per_page'] = $vc_attributes['per_page'];
		}
		
		// Endless Per Page
		if ( isset( $vc_attributes['endless_per_page'] ) ) {
			$args['endless_per_page'] = $vc_attributes['endless_per_page'];
		}
		
		// Endless Auto Reveal
		if ( isset( $vc_attributes['endless_auto_reveal'] ) ) {
			$args['pagination']['type'] = $vc_attributes['endless_auto_reveal'] == 'yes' ? 'endless-reveal' : 'endless';
		}
		
		// Endless Show More Text
		if ( isset( $vc_attributes['endless_show_more_button_text'] ) ) {
			$args['pagination']['endless']['show_more_text'] = $vc_attributes['endless_show_more_button_text'];
		}
		
		// Endless No More Items Text
		if ( isset( $vc_attributes['endless_no_more_items_button_text'] ) ) {
			$args['pagination']['endless']['no_more_items_text'] = $vc_attributes['endless_no_more_items_button_text'];
		}
		
		// Full-width Container
		if ( isset( $vc_attributes['portfolio_full_width'] ) && 'inherit' != $vc_attributes['portfolio_full_width'] ) {
			$args['fullwidth'] = $vc_attributes['portfolio_full_width'] == 'yes';
			
			if ( $args['fullwidth'] && 'inherit' != $vc_attributes['portfolio_full_width_title_container'] ) {
				$args['fullwidth_title_container'] = $vc_attributes['portfolio_full_width_title_container'] == 'yes';
			}
		}
	}
	
	// Portfolio Item Type 3 – Dynamic Height for Layout Type 2
	if ( $args['layout_type'] == 'type-3' ) {
		$args['layout_type'] = 'type-2';
		$args['layouts']['type_2']['dynamic_image_height'] = true;
	}
	
	// Get post ID by slug [opts]
	$post_id = isset( $opts['post_id'] ) ? $opts['post_id'] : null;
	
	if ( is_string( $post_id ) ) {
		$page = get_page_by_path( $post_id );
		
		if ( $page instanceof WP_Post ) {
			$post_id = $page->ID;
		}
	}
	
	// Get Portfolio Options from Post Item [opts]
	if ( ! empty( $post_id ) && ( $portfolio = get_post( $post_id ) ) ) {
		$args['is_page']      	= true;
		$args['post_id']		= $portfolio->ID;
		$args['url']			= get_permalink( $portfolio );
		
		// Title
		$args['show_title'] 	= get_field( 'show_title_description', $post_id );
		$args['title']        	= get_the_title( $portfolio );
		$args['description']  	= $portfolio->post_content;
			
		// Custom Query
		if ( get_field( 'custom_query', $post_id ) ) {
			$args['custom_query'] = array(
				'ids'       => get_field( 'portfolio_items', $post_id ),
				'category'  => get_field( 'select_from_category', $post_id ),
				'tags'      => get_field( 'select_from_tags', $post_id ),
				'orderby'   => get_field( 'order_by', $post_id ),
				'order'     => get_field( 'order', $post_id )
			);
			
			$args['per_page']         = get_field( 'items_per_page', $post_id ); 
			$args['endless_per_page'] = get_field( 'endless_per_page', $post_id ); 
		}
		
		// Masonry Portfolio Style
		if ( get_field( 'masonry_style_portfolio', $post_id ) ) {
			$args['custom_query']        = array();
			$args['layout_type']         = 'type-2';
			$args['masonry_items']       = get_field( 'masonry_items_list', $post_id );
			$args['per_page']            = get_field( 'masonry_items_per_page', $post_id );
			$args['endless_per_page']    = get_field( 'masonry_endless_per_page', $post_id );
			
			if ( ! is_numeric( $args['per_page'] ) ) {
				$args['per_page'] = -1;
			}
			
			if ( is_array( $args['masonry_items'] ) ) {
				list( $args['masonry_items'], $args['masonry_items_ids'] ) = kalium_portfolio_masonry_items_order( $args['masonry_items'] );
			} else {
				$args['masonry_items'] = array();
			}
			
		}
		
		// Columns Count
		$columns_count = get_field( 'columns_count', $post_id );
		
		if ( 'inherit' != $columns_count ) {
			$args['columns'] = $columns_count;
		}
		
		// Full-width Container
		$full_width       = get_field( 'portfolio_full_width', $post_id );
		$title_container  = get_field( 'portfolio_full_width_title_container', $post_id );
		
		if ( 'inherit' != $full_width ) {
			$args['fullwidth'] = $full_width == 'yes';
			
			// Title Container
			if ( $args['fullwidth'] && 'inherit' != $title_container ) {
				$args['fullwidth_title_container'] = $title_container == 'yes';
			}
		}
		
		// Layout Type
		switch ( get_field( 'layout_type', $post_id ) ) {
			case 'type-1':
				$dynamic_image_height   = get_field( 'portfolio_type_1_dynamic_image_height', $post_id );
				$hover_effect           = get_field( 'portfolio_type_1_thumbnail_hover_effect', $post_id );
				$hover_color            = get_field( 'portfolio_type_1_custom_hover_background_color', $post_id );
				
				if ( 'inherit' != $dynamic_image_height ) {
					$args['layouts']['type_1']['dynamic_image_height'] = $dynamic_image_height == 'yes';
				}
				
				if ( 'inherit' != $hover_effect ) {
					$args['layouts']['type_1']['hover_effect'] = $hover_effect;
				}
				
				if ( 'inherit' != $hover_color ) {
					$args['layouts']['type_1']['hover_color'] = $hover_color;
				}
				break;
				
			case 'type-2':
					$dynamic_image_height  = get_field( 'portfolio_type_2_dynamic_image_height', $post_id );
					$default_spacing       = get_field( 'portfolio_type_2_grid_spacing', $post_id ); // referred to `default_spacing` (it was my mistake)
					$hover_effect          = get_field( 'portfolio_type_2_thumbnail_hover_effect', $post_id );
					$hover_style           = get_field( 'portfolio_type_2_thumbnail_hover_style', $post_id );
					$hover_color           = get_field( 'portfolio_type_2_custom_hover_background_color', $post_id );
					$hover_text_position   = get_field( 'portfolio_type_2_thumbnail_hover_text_position', $post_id );

					
					if ( ! empty( $dynamic_image_height ) && $dynamic_image_height != 'inherit' ) {
						$args['layouts']['type_2']['dynamic_image_height'] = $dynamic_image_height == 'yes';
					}
					
					if ( ! empty( $default_spacing ) && 'inherit' != $default_spacing ) {
						$args['layouts']['type_2']['grid_spacing'] = $default_spacing;
					}
		
					if ( ! empty( $hover_effect ) && 'inherit' != $hover_effect ) {
						$args['layouts']['type_2']['hover_effect'] = $hover_effect;
					}
		
					if ( ! empty( $hover_color ) && 'inherit' != $hover_color ) {
						$args['layouts']['type_2']['hover_color'] = $hover_color;
					}
		
					if ( ! empty( $hover_style ) && 'inherit' != $hover_style ) {
						$args['layouts']['type_2']['hover_style'] = $hover_style;
					}
		
					if ( ! empty( $hover_text_position ) && 'inherit' != $hover_text_position ) {
						$args['layouts']['type_2']['hover_text_position'] = $hover_text_position;
					}
				break;
		}
		
		// Reveal Effect
		$reveal_effect = get_field( 'reveal_effect', $post_id );
		
		if ( $reveal_effect != 'inherit' ) {
			$args['layouts']['reveal_effect'] = $reveal_effect;
		}
	}
	
	// Get from base Category slug
	if ( $get_from_category = get_query_var( 'portfolio_category' ) ) {
		$args['category'] = $get_from_category;
	}
		
	// Get from Category [query_vars]
	elseif ( $get_from_category = get_query_var( $category_var ) ) {
		$args['category'] = $get_from_category;
	}
	
	// Get from Category [opts]
	elseif ( isset( $opts['category'] ) ) {
		$args['category'] = $opts['category'];
	}
	
	// Translate Columns Number
	$args['columns'] = kalium_portfolio_columns_translate_to_number( $args['columns'] );
	
	
	/* Portfolio Query Arguments */
	if ( empty( $opts['no_query'] ) ) {
		$query         = $args['query'];
		$tax_query     = array();
		$meta_query    = array();
		
			// Populate Query when Portfolio Archive is active
			if ( isset( $GLOBALS['wp_query']->is_archive ) ) {
				$query = array_merge( $query, $GLOBALS['wp_query']->query );
			}
			
			// Remove Pagename and Page ID attribute
			if ( isset( $query['pagename'] ) ) {
				unset( $query['pagename'] );
			}
		
			if ( isset( $query['page_id'] ) ) {
				unset( $query['page_id'] );
			}
			
			// Custom Query
			if ( ! empty( $args['custom_query'] ) ) {
				
				// Select post IDS
				if ( isset( $args['custom_query']['ids'] ) && ! empty( $args['custom_query']['ids'] ) ) {
					$query['post__in'] = $args['custom_query']['ids'];
				}
				
				// Select Category/Categories
				if ( isset( $args['custom_query']['category'] ) && is_array( $args['custom_query']['category'] ) ) {
					$tax_query = array_merge( $tax_query, array(
						'relation' => 'OR',
						array(
							'taxonomy'         => 'portfolio_category',
							'field'            => 'id',
							'terms'            => $args['custom_query']['category'],
							'include_children' => false
						)
					) );
					
					$query['post__in'] = array(); // Ignore selected IDs in this case
				}
				
				// Select Tag/Tags
				if ( isset( $args['custom_query']['tags'] ) && is_array( $args['custom_query']['tags'] ) ) {
					$tax_query = array_merge( $tax_query, array(
						'relation' => 'OR',
						array(
							'taxonomy'         => 'portfolio_tag',
							'field'            => 'id',
							'terms'            => $args['custom_query']['tags'],
							'include_children' => false
						)
					) );
					
					$query['post__in'] = array(); // Ignore selected IDs in this case
				}
				
				// Order by
				if ( isset( $args['custom_query']['orderby'] ) ) {
					$query['orderby'] = $args['custom_query']['orderby'];
				}
				
				// Order type
				if ( isset( $args['custom_query']['order'] ) ) {
					$query['order'] = $args['custom_query']['order'];
				}
			}
			
			// Masonry Items
			if ( isset( $args['masonry_items_ids'] ) ) {
				$query['post__in']   = $args['masonry_items_ids'];
				$query['orderby']    = 'post__in';
				$query['order']      = 'ASC';
			}
		
			// Pagination
			if ( $args['per_page'] ) {
				$query['posts_per_page'] = $args['per_page'];
			}
			
			if ( is_numeric( $args['pagination']['page'] ) ) {
				$query['paged'] = $args['pagination']['page'];
			}
			
			// Show only items with featured image
			$meta_query[] = array(
				'key'        => '_thumbnail_id',
				'compare'    => 'EXISTS'
			);
				
			// Query Args Extend from Options [opts]
			if ( isset( $opts['query_args'] ) && is_array( $opts['query_args'] ) ) {
				$query = array_merge( $query, $opts['query_args'] );
			}
			
			// Move "portfolio_tag" to tax queries
			if ( isset( $query['portfolio_tag'] ) ) {
				$get_tag = $query['portfolio_tag'];
				
				$tax_query = array_merge( $tax_query, array(
					'relation' => 'AND',
					array(
						'taxonomy'           => 'portfolio_tag',
						'field'              => is_string( $get_tag ) ? 'slug' : 'id',
						'terms'              => is_array( $get_tag ) ? $get_tag : array( $get_tag ),
						'include_children'   => false
					)
				) );
				
				unset( $query['portfolio_tag'] );
			}
			
			// Get from Category
			$get_category = $args['category'];
				
			if ( $get_category ) {
				if ( empty( $tax_query ) ) {
					$query['portfolio_category'] = $get_category;
				} else {
					// Continue adding tax queries on the current tax array
					$tax_query = array_merge( $tax_query, array(
						'relation' => 'AND',
						array(
							'taxonomy'           => 'portfolio_category',
							'field'              => is_string( $get_category ) ? 'slug' : 'id',
							'terms'              => is_array( $get_category ) ? $get_category : array( $get_category ),
							'include_children'   => false
						)
					) );
				}
			}
		
		// Assign Tax query	
		if ( ! empty( $tax_query ) ) {
			$query['tax_query'] = $tax_query;
		}
		
		// Assign Meta Query
		$query['meta_query'] = $meta_query;
		
		// Array diff between Ignore and Include		
		if ( isset( $query['post__in'] ) && isset( $query['post__not_in'] ) ) {
			$query['post__in'] = array_diff( $query['post__in'], $query['post__not_in'] );
		}
		
		// Assign Query
		$args['query'] = apply_filters( 'kalium_portfolio_query', $query );
		
		// Disable Post Types Order
		$orderby_field                     = isset( $query['orderby'] ) ? strtolower( $query['orderby'] ) : '';
		$orderby_fields_disable_order      = array( 'post__in', 'rand', 'date' );
		$orderby_fields_disable_order_true = $orderby_field && in_array( $orderby_field, $orderby_fields_disable_order );
		
		if ( $orderby_fields_disable_order_true ) {
			kalium_portfolio_toggle_post_type_ordering( 'disable' );
		}
		
		// When using post__not_in, alter LIMIT declaration in SQL
		$post__not_in_present = isset( $query['post__not_in'] ) && ! empty( $query['post__not_in'] ) && $query['posts_per_page'] > 0;
		
		if ( $post__not_in_present ) {
			$post_limits_fn = create_function( '$limit, $query', 'return "LIMIT ' . $query['posts_per_page'] . '";' );
			add_filter( 'post_limits', $post_limits_fn, 10, 2 );
		}
		
		// Get Available Terms
		$available_terms_query_args = array_merge( $args['query'], array(
			'portfolio_category' => '',
			'portfolio_tag'      => ''
		) );
		
		$args['available_terms'] = laborator_get_available_terms_for_query( $available_terms_query_args, 'portfolio_category' );
	
		// Execute Query
		$query = new WP_Query( $args['query'] );
	
		// Enable Post Types Order
		if ( $orderby_fields_disable_order_true ) {
			kalium_portfolio_toggle_post_type_ordering( 'enable' );
		}
		
		// Remove posts_limit filter if is set
		if ( $post__not_in_present ) {
			remove_filter( 'post_limits', $post_limits_fn, 10, 2 );
		}
		
		// Get Lightbox Settings for Portfolio Items that have that type
		$portfolio_lightbox_query_args = $args['query'];
		$portfolio_lightbox_query_args['posts_per_page'] = -1;
		$portfolio_lightbox_query_args['meta_query'][] = array(
			'key'        => 'item_type',
			'operator'   => '=',
			'value'      => 'type-6'
		);
		
		$args['lightbox_items'] = null;
		
		if ( $portfolio_lightbox_query = get_posts( $portfolio_lightbox_query_args ) ) {
			$args['lightbox_items'] = kalium_portfolio_get_lightbox_settings_and_items( $portfolio_lightbox_query, $args['id'] );
		}
		
		// Assign $query to $args as portfolio_query
		$args['portfolio_query'] = $query;
		
		// Pagination Info
		$args['pagination']['paged']           = isset( $query->query_vars['paged'] ) ? $query->query_vars['paged'] : 1;
		$args['pagination']['max_num_pages']   = $query->max_num_pages;
		$args['pagination']['found_posts']     = $query->found_posts;
		
		// Apply Custom Syling
		if ( ! defined( 'DOING_AJAX' ) ) {
			
			$portfolio_instance_id_attr = "#{$args['id']}";
			
			// Spacing of Hover Backrounds
			if ( isset( $args['masonry_items_ids'] ) ) {
				$spacing = ( ! empty( $args['layouts']['type_2']['default_spacing'] ) ? $args['layouts']['type_2']['default_spacing'] : 30 ) / 2;
				
				// Remove spacing when merged layout is applied
				if ( $args['layouts']['type_2']['grid_spacing'] == 'merged' ) {
					$spacing = 0;
				}
				
				generate_custom_style( $portfolio_instance_id_attr . '.portfolio-holder .thumb .hover-state.hover-full', "margin: {$spacing}px;" );
				
				// Merged Spacing Items
				generate_custom_style( $portfolio_instance_id_attr . '.portfolio-holder.merged-item-spacing .thumb .hover-state.hover-full', "margin: 0px;" );
				generate_custom_style( $portfolio_instance_id_attr . '.portfolio-holder.merged-item-spacing .thumb .hover-state.hover-distanced', "left: {$spacing}px; right: {$spacing}px; top: {$spacing}px; bottom: {$spacing}px;" );
				
				// Spacing for distanced hover background
				$spacing += 15;
				generate_custom_style( $portfolio_instance_id_attr . '.portfolio-holder .thumb .hover-state.hover-distanced', "left: {$spacing}px; right: {$spacing}px; top: {$spacing}px; bottom: {$spacing}px;" );
			}

			// Hover - Custom CSS
			if ( $args['layouts']['type_1']['hover_color'] ) {
				generate_custom_style( $portfolio_instance_id_attr . '.portfolio-holder .item-box.photo .on-hover', "background-color: {$args['layouts']['type_1']['hover_color']} !important;" );
			}
			
			if ( $args['layouts']['type_2']['hover_color'] ) {
				generate_custom_style( $portfolio_instance_id_attr . '.portfolio-holder .item-box .thumb .hover-state', "background-color: {$args['layouts']['type_2']['hover_color']} !important;" );
			}
			
			// Full-width Container with Default Spacing
			if ( $args['layout_type'] == 'type-2' && $args['layouts']['type_2']['grid_spacing'] == 'normal' && $args['layouts']['type_2']['default_spacing'] ) {
				$spacing = $args['layouts']['type_2']['default_spacing'];
				
				generate_custom_style( "{$portfolio_instance_id_attr}-container.portfolio-container-and-title.full-width-portfolio", "padding-left: 0; padding-right: 0;" );
				generate_custom_style( "{$portfolio_instance_id_attr}-container.portfolio-container-and-title.full-width-portfolio .portfolio-holder", "margin-left: {$spacing}px; margin-right: {$spacing}px;" );
				
				if ( $args['vc_mode'] ) {
					generate_custom_style( "{$portfolio_instance_id_attr}-container.portfolio-container-and-title.full-width-portfolio .portfolio-title-holder", "padding-left: {$spacing}px; padding-right: {$spacing}px;" );
				}
				
				// Row Spacing (Visual Composer)
				$spacing /= 2;
				generate_custom_style( "{$portfolio_instance_id_attr}-container.portfolio-container-and-title > .row", "margin-left: -{$spacing}px; margin-right: -{$spacing}px;" );
			}
		}
	}
	
	return apply_filters( 'kalium_get_portfolio_query', $args );
}

// Prepare item ids for Masonry Portfolio Style
function kalium_portfolio_masonry_items_order( $items ) {
	$items_arr = array();
	$item_ids  = array();
	
	if ( is_array( $items ) && ! empty( $items ) ) {
		foreach ( $items as $items_row ) {
			foreach ( $items_row['items_row'] as $item ) {
				if ( $item['item'] instanceof WP_Post ) {
					$items_arr[ $item['item']->ID ] = $item;
					$item_ids[] = $item['item']->ID;
				}
			}
		}
	}
	
	return array( $items_arr, $item_ids );
}

// Enable or Disable Post Types ordering plugin filters
function kalium_portfolio_toggle_post_type_ordering( $enable = false ) {
	
	if ( function_exists( 'CPTOrderPosts' ) ) {
		if ( $enable === true || $enable == 'enable' ) {		
			// Revert back post ordering filter
			add_filter( 'posts_orderby', 'CPTOrderPosts', 99, 2 );
		} else {
			// Remove post type ordering
			remove_filter( 'posts_orderby', 'CPTOrderPosts', 99, 2 );
		}	
	}
}

// Portfolio Category Endpoint Var
function kalium_portfolio_get_category_endpoint_var() {
	$category_prefix = get_data( 'portfolio_category_prefix_url_slug' );
	$category_var = $category_prefix ? $category_prefix : 'portfolio-category';
	
	return $category_var;
}

// Portfolio Category Endpoint
add_action( 'init', 'kalium_portfolio_category_endpoint_action' );

function kalium_portfolio_category_endpoint_action() {
	add_rewrite_endpoint( kalium_portfolio_get_category_endpoint_var(), EP_ALL );
}

// Portfolio Get Category Permalink
function kalium_portfolio_get_category_link( $term ) {
	global $portfolio_args, $wp_rewrite;
	
	$category_permastruct = $wp_rewrite->get_extra_permastruct( 'portfolio_category' );
	
	if ( $category_permastruct && $term instanceof WP_Term ) {
		if ( $portfolio_args['is_page'] || $portfolio_args['vc_mode'] ) {
			$category_permastruct = str_replace( '%portfolio_category%', $term->slug, $category_permastruct );
			$term_link = rtrim( get_permalink( get_queried_object_id() ), '/' ) . rtrim( $category_permastruct, '/' ) . '/';
			
			return $term_link;
		}
	}
	
	return get_term_link( $term , 'portfolio_category' );
}

// Portfolio Columns Translate to Number (Deprecated Column Values)
function kalium_portfolio_columns_translate_to_number( $cols ) {
	
	if ( is_string( $cols ) ) {
		switch ( $cols ) {
			 // Four items per row
			case 'three':
				$cols = 4;
				break;
			
			// Three items per row
			case 'four':
				$cols = 3;
				break;
				
			// Two items per row
			case 'six':
				$cols = 2;
				break;
		}
	}
	
	return $cols;
}

// Portfolio CSS Column Class Based on Number
function kalium_portfolio_get_columns_class( $cols ) {
	$css_class = 'w3';
	
	switch ( $cols ) {
		// One Column
		case 1:
			$css_class = 'w12';
			break;
			
		// Three Columns
		case 2:
			$css_class = 'w6';
			break;
			
		// Three Columns
		case 3:
			$css_class = 'w4';
			break;
			
		// Four Columns
		case 4:
			$css_class = 'w3';
			break;
			
		// Five Columns
		case 5:
			$css_class = 'w5';
			break;
			
		// Six Columns
		case 6:
			$css_class = 'w2';
			break;
	}
	
	return $css_class;
}

// Portfolio Instance Object (JavaScript Declaration)
function kalium_portfolio_generate_portfolio_instance_object( $portfolio_args ) {	
	
	// Post ID
	$post_id = isset( $portfolio_args['post_id'] ) ? $portfolio_args['post_id'] : 0;
	
	// VC Attributes
	$vc_attributes = $portfolio_args['vc_attributes'];
	
	// Custom number of items to fetch
	$endless_per_page = is_numeric( $portfolio_args['endless_per_page'] ) ? $portfolio_args['endless_per_page'] : 0;
	
	// Lightbox Data
	$lightbox_items = $portfolio_args['lightbox_items'];
	
	// Generate Portfolio Alias
	$portfolio_alias = $portfolio_args['id'];
	
	if ( ! empty( $portfolio_args['title'] ) ) {
		$portfolio_alias = sanitize_title( $portfolio_args['title'] );
	}
	
	// Query
	$query = $portfolio_args['portfolio_query'];
	$base_query = $query->query;
	
	// Endless Per Page
	if ( $endless_per_page != 0 ) {
		$base_query['posts_per_page'] = $endless_per_page;
	}
	
	// Category Counter
	$category_post_count = array();
	
	$category_query = array_merge( $base_query, array(
		'paged'               => 0,
		'posts_per_page'      => -1,
		'portfolio_category'  => '',
		'fields'			  => 'ids'
	) );
	
	// Count All Items (All Categories)
	$all_items_count = count( get_posts( $category_query ) );
	
	// Tax Query Array of Current Query
	$category_tax_query = isset( $category_query['tax_query'] ) ? $category_query['tax_query'] : array();
	
	foreach ( $portfolio_args['available_terms'] as $term ) {
		
		$category_query['tax_query'] = array_merge( $category_tax_query, array(
			'relation' => 'AND',
			array(
				'taxonomy'           => 'portfolio_category',
				'field'              => 'id',
				'terms'              => $term->term_id,
				'include_children'   => false
			)
		) );
		
		$category_post_count[ $term->slug ] = count( get_posts( $category_query ) );
	}
	
	// Portfolio Instance Object used for Pagination
	$portfolio_container_data = array(
		'instanceId'      => $portfolio_args['id'],
		'instanceAlias'	  => $portfolio_alias,
		
		'baseQuery'		  => $base_query,
		'vcAttributes'	  => $vc_attributes,
		
		'postId'		  => $post_id,
		
		'count'           => $all_items_count,
		'countByTerms'    => $category_post_count,
		
		'lightboxData'	  => $lightbox_items,
		
		'filterPushState' => $portfolio_args['category_filter_pushtate']
	);
	?>
	<script type="text/javascript">
	var portfolioContainers = portfolioContainers || [];
	portfolioContainers.push( <?php echo json_encode( $portfolio_container_data ); ?> );
	</script>
	<?php
}

// Portfolio Endless Pagination Button
function kalium_portfolio_endless_pagination( $portfolio_args ) {
	
	// Loader Type (Icon)
	switch ( $portfolio_args['pagination']['endless']['style'] ) {
		case '_2':
			$loader_type = 2;
			break;
			
		default:
		case '_1':
			$loader_type = 1;
	}
	
	
	?>
	<div class="portfolio-endless-pagination endless-pagination endless-pagination-alignment-<?php echo $portfolio_args['pagination']['align']; ?><?php echo when_match( $portfolio_args['pagination']['max_num_pages'] <= 1, 'not-visible' ); ?>">
		<div class="show-more<?php echo " type-{$loader_type}"; echo $portfolio_args['pagination']['type'] == 'endless-reveal' ? ' auto-reveal' : ''; ?>" data-endless="true">
			<div class="button">
				<a href="#" class="btn btn-white">
					<?php echo $portfolio_args['pagination']['endless']['show_more_text']; ?>
					
					<span class="loading">
					<?php
					if ( 2 == $loader_type ) {
							echo '<i class="loading-spinner-1"></i>';
					} else {
							echo '<i class="fa fa-circle-o-notch fa-spin"></i>';
					}
					?>
					</span>
					
					<span class="finished">
						<?php echo $portfolio_args['pagination']['endless']['no_more_items_text']; ?>
					</span>
				</a>
			</div>
		</div>
	</div>
	<?php
}

// Portfolio Endless Pagination with AJAX
add_action( 'wp_ajax_portfolio_items_get_from_ajax', 'portfolio_items_get_from_ajax' );
add_action( 'wp_ajax_nopriv_portfolio_items_get_from_ajax', 'portfolio_items_get_from_ajax' );

function portfolio_items_get_from_ajax() {
	
	global $portfolio_args;
	
	// Response
	$resp = array();
	
	// Get Vars
	$base_query    = post( 'baseQuery' );
	$vc_attributes = post( 'vcAttributes' );
	$post_id	   = post( 'postId' );
	$shown_ids	   = post( 'shownIds' );
	$count		   = post( 'count' );
	$count_terms   = post( 'countByTerms' );
	
	// Show all items, ignore category var
	$no_category   = post( 'noCategory' );
	
	// Get Single Category of Items
	$get_category  = post( 'portfolioCategory' );
	
	// Make Portfolio Query 
	$query = array_merge( $base_query, array(
		'ignore_sticky_posts' => true,
		'post__not_in'        => $shown_ids,
		'paged' 			  => 0
	) );
	
	// Ignore "portfolio_category" query var
	if ( $no_category ) {
		$query['portfolio_category'] = '';
	}
	
	// Portfolio Query Args
	$portfolio_query_args = array(
		'query_args' => $query
	);
	
	// VC Attributes
	if ( is_array( $vc_attributes ) && count( $vc_attributes ) ) {
		$portfolio_query_args['vc_attributes'] = $vc_attributes;
	}
	
	// Inherhit Options from specific "Portfolio Page" template
	if ( is_numeric( $post_id ) && $post_id != 0 ) {
		$portfolio_query_args['post_id'] = $post_id;
	}
	
	// Browse Specific Category
	if ( $get_category ) {
		$portfolio_query_args['category'] = $get_category;
	}
	
	// Execute Query
	$portfolio_args = kalium_get_portfolio_query( $portfolio_query_args );
	
	// Render Portfolio Templates
	$resp['html'] = kalium_portfolio_loop_items_show( $portfolio_args, true );
	
	// Query Meta
	$portfolio_query   = $portfolio_args['portfolio_query'];
	$post_count		   = $portfolio_query->post_count;
	$shown_items       = count( $shown_ids ) + $post_count;
	
	$has_more          = $shown_items < $count;
	
	// When browsing single category, $has_more calculates differently
	if ( $get_category ) {
		$get_category_q = array_merge( $query, array( 
			'fields'         => 'ids', 
			'posts_per_page' => -1 
		) );
		
		$get_category_ids = array_intersect( $shown_ids, get_posts( $get_category_q ) );
		$shown_items      = count( $get_category_ids ) + $post_count;
		$has_more         = $shown_items < $portfolio_query->found_posts;
	}
	
	// Tell if there are more items left
	$resp['hasMore'] = $has_more;
	
	// Parse JSON Parameters Object
	die( json_encode( $resp ) );
}


// Show Subcategories for the current Term
function kalium_portfolio_get_terms_by_parent_id( $parent_term, $args ) {
	
	extract( $args ); // $available_terms, $current_category
	
	$sub_terms = array();
	
	if ( empty( $available_terms ) || ! is_array( $available_terms ) ) {
		return;
	}
	
	foreach ( $available_terms as $term ) {
		if ( $term->parent == $parent_term->term_id ) {
			$sub_terms[] = $term;
		}
	}
	
	if ( ! count( $sub_terms ) ) {
		return;
	}
	
	// Go Back Link (Parent Category)
	$go_back_link = kalium_portfolio_get_category_link( $parent_term );
	
	?>
	<ul class="portfolio-subcategory<?php echo when_match( isset( $parent_term->is_active ), 'is-active' ); ?>" data-sub-category-of="<?php echo esc_attr( $parent_term->slug ); ?>">
		<li class="subcategory-back">
			<a href="<?php echo esc_url( $go_back_link ); ?>" class="subcategory-back-href" data-term="<?php echo esc_attr( $parent_term->slug ); ?>">
				<i class="fa fa-angle-left"></i>
				<span><?php echo sprintf( _x( '%s:', 'current portfolio subcategory', 'kalium' ), $parent_term->name ); ?></span>
			</a>
		</li>
		<?php 
		foreach ( $sub_terms as $term ) :
			$is_active = $current_category && $current_category == $term->slug;
			$term_link = kalium_portfolio_get_category_link( $term );
		?>
		<li class="portfolio-category-item portfolio-category-<?php echo $term->slug; when_match( $is_active, 'active' ); ?>">
			<a href="<?php echo esc_url( $term_link ); ?>" data-term="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a>
		</li>
		<?php
		endforeach; 
		?>
	</ul>
	<?php
}

// Set Active Term Parents Based on Current Active Term
function kalium_portfolio_set_active_term_parents( $current_term, & $available_terms ) {
	foreach ( $available_terms as & $term ) {
		if ( $current_term->parent == $term->term_id ) {
			$term->is_active = true;
			return true;
		}
	}
	return false;
}

// Check if Given Term has Sub Terms
function kalium_portfolio_check_if_term_has_children( $current_term, & $available_terms ) {
	foreach ( $available_terms as & $term ) {
		if ( $current_term->term_id == $term->parent ) {
			$term->is_active = true;
			return true;
		}
	}
	return false;
}