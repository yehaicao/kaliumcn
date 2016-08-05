<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


// GET/POST/COOKIE getter
function lab_get( $var ) {
	return isset( $_GET[ $var ] ) ? $_GET[ $var ] : ( isset( $_REQUEST[ $var ] ) ? $_REQUEST[ $var ] : '' );
}

function post( $var ) {
	return isset( $_POST[$var] ) ? $_POST[ $var ] : ( isset( $_REQUEST[ $var ] ) ? $_REQUEST[ $var ] : null );
}

function cookie( $var ) {
	return isset( $_COOKIE[ $var ] ) ? $_COOKIE[ $var ] : null;
}

// Print attribute values based on boolean value
function when_match( $bool, $str = '', $otherwise_str = '', $echo = true ) {
	$str = trim( $bool ? $str : $otherwise_str );
	
	if ( $str ) {
		$str = ' ' . $str;
		
		if ( $echo ) {
			echo $str;
			return '';
		}
	}
	
	return $str;
}

// Get SMOF data
$theme_options_data = get_theme_mods();

function get_data( $var = null, $default = '' ) {
	global $theme_options_data;
	
	if ( $var == null ) {
		return apply_filters( 'get_theme_options', $theme_options_data );
	}

	if ( isset( $theme_options_data[ $var ] ) ) {
		$value = $theme_options_data[ $var ];
		
		// Treat numeric values as "number"
		if ( is_numeric( $value ) ) {
			if ( is_int( $value ) ) {
				$value = intval( $value );
	   	} elseif ( is_float( $value ) ) {
				$value = floatval( $value );
			} elseif ( is_double( $value ) ) {
				$value = doubleval( $value );
			}							  
		}
	   
		return apply_filters( "get_data_{$var}", $value );
	}

	return apply_filters( "get_data_{$var}", $default );
}

// Compress Text Function
function compress_text( $buffer ) {
	/* remove comments */
	$buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
	/* remove tabs, spaces, newlines, etc. */
	$buffer = str_replace( array( "\r\n", "\r", "\n", "\t", '	', '	', '	' ), '', $buffer );
	return $buffer;
}

// Share Network Story
function share_story_network_link( $network, $id, $class = '', $icon = false ) {
	global $post;
	
	$title     = urlencode( get_the_title() );
	$excerpt   = urlencode( get_the_excerpt() );
	$permalink = urlencode( get_permalink() );
	$url       = urlencode( get_permalink() );
	

	$networks = array(
		'fb'          => array(
			'url'        => 'https://www.facebook.com/sharer.php?m2w&s=100&p[url]=' . $permalink . '&p[title]=' . $title,
			'tooltip'    => __( 'Facebook', 'kalium' ),
			'icon'       => 'facebook'
		),

		'tw'          => array(
			'url'        => 'https://twitter.com/share?text=' . $title,
			'tooltip'    => __( 'Twitter', 'kalium' ),
			'icon'       => 'twitter'
		),

		'gp'          => array(
			'url'        => 'https://plus.google.com/share?url=' . $permalink,
			'tooltip'    => __( 'Google+', 'kalium' ),
			'icon'       => 'google-plus'
		),

		'tlr'         => array(
			'url'        => 'http://www.tumblr.com/share/link?url=' . $permalink . '&name=' . $title . '&description=' . $excerpt,
			'tooltip'    => __( 'Tumblr', 'kalium' ),
			'icon'       => 'tumblr'
		),

		'lin'         => array(
			'url'        => 'https://linkedin.com/shareArticle?mini=true&amp;url=' . $permalink . '&amp;title=' . $title,
			'tooltip'    => __( 'LinkedIn', 'kalium' ),
			'icon'       => 'linkedin'
		),

		'pi'          => array(
			'url'        => 'https://pinterest.com/pin/create/button/?url=' . $permalink . '&amp;description=' . $title . '&' . ( $id ? ( 'media=' . wp_get_attachment_url( get_post_thumbnail_id( $id ) ) ) : '' ),
			'tooltip'    => __( 'Pinterest', 'kalium' ),
			'icon'       => 'pinterest'
		),

		'vk'          => array(
			'url'        => 'https://vkontakte.ru/share.php?url=' . $permalink . '&title=' . $title . '&description=' . $excerpt,
			'tooltip'    => __( 'VKontakte', 'kalium' ),
			'icon'       => 'vk'
		),

		'em'          => array(
			'url'        => 'mailto:?subject=' . $title . '&body=' . esc_attr( sprintf( __( 'Check out what I just spotted: %s', 'kalium' ), $permalink ) ),
			'tooltip'    => __( 'Email', 'kalium' ),
			'icon'       => 'envelope-o'
		),

		'pr'          => array(
			'url'        => 'javascript:window.print();',
			'tooltip'    => __( 'Print', 'kalium' ),
			'icon'       => 'print'
		),
	);

	$network_entry = $networks[ $network ];
	$new_window = $network ? false : true;
	?>
	<a class="<?php echo esc_attr( trim( "{$network_entry['icon']} {$class}" ) ); ?>" href="<?php echo $network_entry['url']; ?>"<?php if ( $new_window ) : ?> target="_blank"<?php endif; ?>>
		<?php if ( $icon ) : ?>
			<i class="icon fa fa-<?php echo esc_attr( $network_entry['icon'] ); ?>"></i>
		<?php else : ?>
			<?php echo esc_html( $network_entry['tooltip'] ); ?>
		<?php endif; ?>
	</a>
	<?php
		
}

// In case when GET_FIELD function doesn't exists
if ( ! function_exists( 'get_field' ) && is_array( get_option( 'active_plugins' ) ) && ! in_array( 'advanced-custom-fields/acf.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && ! is_admin() ) {
	function get_field( $field_id, $post_id = null ) {
		global $post;

		if ( is_numeric( $post_id ) ) {
			$post = get_post( $post_id );
		}

		return $post->{$field_id};
	}
}

// Load Laborator Font from Theme Options
function laborator_load_font() {
	$use_custom_font   = get_data( 'use_custom_font' );
	$use_tykekit_font  = get_data( 'use_tykekit_font' );
	
	if ( $use_tykekit_font ) {
		add_action( 'wp_print_scripts', 'laborator_typekit_embed_code' );
	}
	
	if ( ! $use_custom_font ) {
		// Load default font
		wp_enqueue_style( 'default-font', '//fonts.googleapis.com/css?family=Karla:400,700,400italic,700italic', null, null );
		return;
	}
	
	$primary_font_provider     = '';
	$primary_font_path         = '';
	$primary_font_subset	   = get_data( 'font_primary_subset' );
	$primary_font_subset_arr   = array( 'latin' );
	

	$secondary_font_provider   = '';
	$secondary_font_path       = '';
	$secondary_font_subset	   = get_data( 'font_heading_subset' );
	$secondary_font_subset_arr = array( 'latin' );
	
	// Create Character set Array
	if ( is_array( $primary_font_subset ) ) {
		foreach ( $primary_font_subset as $subset => $include ) {
			if ( $include ) {
				$primary_font_subset_arr[] = $subset;
			}
		}
	}
	
	if ( is_array( $secondary_font_subset ) ) {
		foreach ( $secondary_font_subset as $subset => $include ) {
			if ( $include ) {
				$secondary_font_subset_arr[] = $subset;
			}
		}
	}

	$font_variants             = apply_filters( 'kalium_google_font_variants', '300,400,500,700' );
	$primary_font_charsets     = apply_filters( 'kalium_google_font_primary_subset', implode( ',', $primary_font_subset_arr ) );
	$secondary_font_charsets   = apply_filters( 'kalium_google_font_secondary_subset', implode( ',', $secondary_font_subset_arr ) );

		// Google Font
		$font_primary = get_data( 'font_primary' );
		$font_heading = get_data( 'font_heading' );

		if ( $font_primary && $font_primary != 'none' ) {
			$primary_font_provider = '//fonts.googleapis.com/css?family=';
			$primary_font_path = urlencode( $font_primary ) . ':' . $font_variants . '&subset=' . $primary_font_charsets;
		}

		if ( $font_heading && $font_heading != 'none' ) {
			$secondary_font_provider = '//fonts.googleapis.com/css?family=';
			$secondary_font_path = urlencode( $font_heading ) . ':' . $font_variants . '&subset=' . $secondary_font_charsets;
		}
		

		// Custom Font
		$custom_primary_font_url  = get_data( 'custom_primary_font_url' );
		$custom_heading_font_url  = get_data( 'custom_heading_font_url' );

		if ( $custom_primary_font_url ) {
			$primary_font_provider = '';
			$primary_font_path = $custom_primary_font_url;
		}

		if ( $custom_heading_font_url ) {
			$secondary_font_provider = '';
			$secondary_font_path = $custom_heading_font_url;
		}
		

	// Font Resource URI
	$primary_font_resource_uri	 = $primary_font_provider . $primary_font_path;
	$secondary_font_resource_uri = $secondary_font_provider . $secondary_font_path;
	

	// Load Fonts
	$duplicate_fonts = $primary_font_resource_uri == $secondary_font_resource_uri;
	
	if ( $primary_font_path ) {
		wp_enqueue_style( 'primary-font', $primary_font_resource_uri, null, null );
	}

	if ( $secondary_font_path && $duplicate_fonts == false ) {
		wp_enqueue_style( 'secondary-font', $secondary_font_resource_uri, null, null );
	}

	// Show Custom CSS
	if ( $primary_font_path || $secondary_font_path ) {
		add_action( 'wp_print_scripts', 'laborator_show_custom_font' );
	}
}

function laborator_show_custom_font() {
	?><style><?php echo get_option( 'kalium_font_custom_css' ); ?></style><?php
}

function laborator_typekit_embed_code() {
	echo get_data( 'typekit_embed_code' );
}

// Get Excerpt
function laborator_get_excerpt( $text ) {
	$excerpt_length  = apply_filters( 'excerpt_length', 55 );
	$excerpt_more	 = apply_filters( 'excerpt_more', ' [&hellip;]' );
	$text			 = apply_filters( 'the_excerpt', apply_filters( 'get_the_excerpt', wp_trim_words( $text, $excerpt_length, $excerpt_more ) ) );

	return $text;
}

// Post Formats | Extract Content
function kalium_extract_post_content( $type, $replace_original = false, $meta = array() ) {
	global $post, $post_title, $post_excerpt, $post_content, $blog_post_formats;

	$content = array(
		'content' => '',
		'data'    => array()
	);

	if ( ! $post ) {
		return $content;
	}
	
	switch ( $type ) {
		
		case 'quote':

			if ( preg_match( "/^\s*<blockquote.*?>(.*?)<\/blockquote>/s", $post_content, $matches ) ) {
				$blockquote = laborator_esc_script( wpautop( $matches[1] ) );

				// Replace Original Content
				if ( $replace_original ) {
					$post_excerpt = laborator_get_excerpt( str_replace( $matches[0], '', $post_content ) );
					$post_content = str_replace( $matches[0], '', $post_content );
				}

				if ( preg_match( "/(<br.*?>\s*)?<cite>(.*?)<\/cite>/s", $blockquote, $blockquote_matches ) ) {
					$cite = $blockquote_matches[2];
					$blockquote = str_replace( $blockquote_matches[0], '', $blockquote );

					// Add attributes
					$content['data']['cite'] = $cite;
				}

				// Set content
				$content['content'] = $blockquote;
			} else {
				$post_content_lines = explode( PHP_EOL, $post_content );
				$blockquote = reset( $post_content_lines );

				$content['content'] = $blockquote;

				// Replace Original Content
				if ( $replace_original ) {
					$post_content = str_replace( $blockquote, '', $post_content );
					$post_excerpt = laborator_get_excerpt( $post_content );
				}
			}

			break;

		case 'image':
					
			$image_url           = '';
			$post_content_lines  = explode( PHP_EOL, trim( $post_content ) );
			$first_line          = reset( $post_content_lines );
			
			// Match the image
			if ( preg_match( "/<img(.*?)>/", $first_line, $matches ) && preg_match( "/src=(\"|')([^'\"]+)(\"|')/i", $matches[1], $matches2 ) ) {
				$image_url = $matches2[2];
			} elseif ( preg_match( '/https?:\/\/[^\s\"\']+/', $first_line, $matches ) ) {
				$image_url = $matches[0];
			}
			
			// Populate Image URL on data array
			if ( $image_url ) {
				$content['content'] = $image_url;
				
				// Replace the content line with Image Link (or tag)
				if ( $replace_original ) {
					$post_content = preg_replace( '/' . preg_quote( $first_line, '/' ) . '/', '', $post_content, 1 );
					$post_excerpt = laborator_get_excerpt( $post_content );
				}
			}

			break;

		case 'link':

			$has_url = laborator_get_url_in_content( get_the_content() );
			$has_url = $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );

			$content['content'] = $has_url;
				
			// Replace the content line with Image Link (or tag)
			if ( $replace_original && $has_url ) {
				$post_content = preg_replace( '/' . preg_quote( $has_url, '/' ) . '/', '', $post_content, 1 );
				$post_excerpt = laborator_get_excerpt( $post_content );
			}
			break;

		case 'video':
			
			global $wp_embed;
				
			// Video Poster
			if ( isset( $meta['poster'] ) ) {
				$fn_code  = 'if ( get_the_ID() != ' . $post->ID . ' ) return $atts;';
				$fn_code .= '$atts["poster"] = "' . addslashes( $meta['poster'] ) . '";';
				$fn_code .= 'return $atts;';
				
				$fn_poster = create_function( '$atts', $fn_code );
				
				add_filter( 'kalium_video_shortcode_container_atts', $fn_poster );
			}
			
			// Auto Play
			if ( is_single() && isset( $meta['autoPlay'] ) ) {
				$fn_code  = 'if ( get_the_ID() != ' . $post->ID . ' ) return $atts;';
				$fn_code .= '$atts["autoplay"] = ' . ( $meta['autoPlay'] ? '1' : '0' ). ';';
				$fn_code .= 'return $atts;';
				
				$fn_autoplay = create_function( '$atts', $fn_code );
				add_filter( 'kalium_video_shortcode_container_atts', $fn_autoplay );
			}
			
			// Self Hosted Video
			if ( preg_match( "/\[video.*?\[\/video\]/s", $post->post_content, $matches ) ) {
				$video_shortcode = $matches[0];
				
				// Populate data
				$content['data']['type'] = 'native';
				$content['content'] = do_shortcode( $video_shortcode );
				
				// Remove shortcode from "the_content"
				if ( $replace_original ) {
					$post_content = str_replace( $video_shortcode, '', $post_content );
					$post_excerpt = laborator_get_excerpt( $post_content );
				}
				
			}  elseif ( $wp_embed ) {
				global $wp_embed;
				
				$post_content_lines = explode( PHP_EOL, $post->post_content );
				$first_line = strip_tags( trim( reset( $post_content_lines ) ) );
				
				// Parse Video from YouTube or Vimeo
				if ( preg_match( "/(https?:\/\/(www\.)?youtube.com[^\s\[]+)/s", $first_line, $matches ) || preg_match( "/(https?:\/\/(www\.)?vimeo.com[^\s\[]+)/s", $first_line, $matches ) ) {
					
					$content['data']['type'] = strpos( 'vimeo', $first_line ) >= 0 ? 'vimeo' : 'youtube';
					$content['content'] = $wp_embed->autoembed( $matches[0] );
					
					// Remove shortcode from "the_content"
					if ( $replace_original ) {
						$post_content = str_replace( $first_line, '', $post_content );
						$post_excerpt = laborator_get_excerpt( $post_content );
					}
				}
			}
			
			// Remove assigned filters
			if ( ! empty( $fn_poster ) ) {
				remove_filter( 'kalium_video_shortcode_container_atts', $fn_poster );
			}
			
			if ( ! empty( $fn_autoplay ) ) {
				remove_filter( 'kalium_video_shortcode_container_atts', $fn_autoplay );
			}

			break;

		case 'audio':

			if ( preg_match( "/\[audio.*?(https?[^\s]+?)*.?\](\[\/audio\])?/s", $post->post_content, $matches ) ) {
				$audio_shortcode = $matches[0];
				
				// Audio Poster
				if ( isset( $meta['poster'] ) ) {
					$fn_code  = 'if ( get_the_ID() != ' . $post->ID . ' ) return $atts;';
					$fn_code .= '$atts["poster"] = "' . addslashes( $meta['poster'] ) . '";';
					$fn_code .= 'return $atts;';
					
					$fn_poster = create_function( '$atts', $fn_code );
					
					add_filter( 'kalium_audio_shortcode_container_atts', $fn_poster );
				}
			
				// Auto Play
				if ( is_single() && isset( $meta['autoPlay'] ) ) {
					$fn_code  = 'if ( get_the_ID() != ' . $post->ID . ' ) return $atts;';
					$fn_code .= '$atts["autoplay"] = ' . ( $meta['autoPlay'] ? '1' : '0' ). ';';
					$fn_code .= 'return $atts;';
					
					$fn_autoplay = create_function( '$atts', $fn_code );
					add_filter( 'kalium_audio_shortcode_container_atts', $fn_autoplay );
				}

				// Parse audio shortcode
				$content['content'] = do_shortcode( $audio_shortcode );

				// Remove shortcode from "the_content"
				if ( $replace_original ) {
					$post_content = str_replace( $audio_shortcode, '', $post_content );
					$post_excerpt = laborator_get_excerpt( $post_content );
				}
			
				// Remove assigned filters
				if ( ! empty( $fn_autoplay ) ) {
					remove_filter( 'kalium_video_shortcode_container_atts', $fn_autoplay );
				}
			}

			break;
	}

	return $content;
}

// Endless Pagination
function laborator_show_endless_pagination( $args = array() ) {
	$defaults = array(
		'per_page'    => get_option( 'posts_per_page' ),

		'opts'        => array(),
		'action'      => '',
		'callback'    => '',

		'class'       => 'text-' . get_data( 'blog_pagination_position' ),
		'reveal'      => false,

		'current'     => 1,
		'maxpages'    => 1,

		'more'        => __( 'Show More', 'kalium' ),
		'finished'    => __( 'No more posts to show', 'kalium' ),

		'type'        => 1,
		
		'visible'	  => true
	);

	if ( is_array( $args ) ) {
		$args = array_merge( $defaults, $args );
	}

	extract( $args );

	$type = str_replace( '_', '', $type );
	
	// Visibility
	if ( ! $visible ) {
		$class .= ' not-visible';
	}
	?>
	<div class="endless-pagination<?php echo " {$class}"; ?>">
		<div class="show-more<?php echo " type-{$type}"; echo esc_attr( $reveal ) ? ' auto-reveal' : ''; ?>" data-cb="<?php echo esc_attr( $callback ); ?>" data-action="<?php echo esc_attr( $action ); ?>" data-current="<?php echo esc_attr( $current ); ?>" data-max="<?php echo esc_attr( $maxpages ); ?>" data-pp="<?php echo esc_attr( $per_page ); ?>" data-opts="<?php echo esc_attr( json_encode( $opts ) ); ?>">
			<div class="button">
				<a href="#" class="btn btn-white">
					<?php echo esc_html( $more ); ?>

					<span class="loading">
					<?php
					switch ( $type ) :
						case 2:
							echo '<i class="loading-spinner-1"></i>';
							break;

						default:
							echo '<i class="fa fa-circle-o-notch fa-spin"></i>';
					endswitch;
					?>
					</span>

					<span class="finished">
						<?php echo esc_html( $finished ); ?>
					</span>
				</a>
			</div>
		</div>
	</div>
	<?php
}

// Aspect Ratio Element Generator
$as_element_id = 1;

function laborator_generate_as_element( $size ) {
	global $as_element_id;
	
	if ( isset( $size['width'] ) ) {
		$size[0] = $size['width'];
	}
	
	if ( isset( $size['height'] ) ) {
		$size[1] = $size['height'];
	}

	if ( $size[0] == 0 ) {
		return null;
	}

	$element_id = "arel-" . $as_element_id;
	$padding_top = 'padding-top: ' . number_format( $size[1] / $size[0] * 100, 8 ) . '% !important;';
	
	$as_element_id++;

	if ( defined( 'DOING_AJAX' ) ) {
		$element_id .= '-' . time();
	}

	generate_custom_style( ".{$element_id}", $padding_top );

	return $element_id;
}

// Load Image with Aspect Ratio Container
function laborator_show_image_placeholder( $attachment_id, $size = 'original', $class = '', $lazy_load = true, $img_class = null, $img_atts = array() ) {
	
	if ( is_string( $size ) && preg_match( '/^[0-9]+(x[0-9]+)?$/', $size ) ) {
		$size = explode( 'x', $size );
	}
	
	if ( is_null( $lazy_load ) ) {
		$lazy_load = true;
	}

	if ( is_array( $size ) ) {
		if ( count( $size ) == 2 ) {
			$size['bfi_thumb']   = true;
			$size['crop']        = true;
			$size['quality']     = apply_filters( 'kalium_bfi_thumb_quality', 90 );
			
			// Calculate Width or Height
			if ( array_product( $size ) == 0 ) {
				$img_dims = wp_get_attachment_image_src( $attachment_id, 'original' );
				
				if ( ! empty( $img_dims ) && is_array( $img_dims ) ) {
					
					// Resize by width
					if ( ! $size[1] ) {
						$r = $size[0] / $img_dims[1];
						$size[1] = $r * $img_dims[2];
					}
					
					// Resize by height
					if ( ! $size[0] ) {
						$r = $size[1] / $img_dims[2];
						$size[0] = $r * $img_dims[1];
					}
				}
			}
		}
	}

	if ( is_numeric( $attachment_id ) ) {
		$image        = wp_get_attachment_image_src( $attachment_id, $size );
		$alt          = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
		$extension    = pathinfo( $image[0], PATHINFO_EXTENSION );
		
		// When JetPack Photon Module is active, get image size from the URL
		if ( ! empty( $image[0] ) && ( empty( $image[1] ) || empty( $image[2] ) ) && preg_match( "/[a-z0-9-]+\.wp\.com\//", $image[0] ) ) {
			
			$url_args = wp_parse_args( preg_replace( '/.*?\?/', '', $image[0] ) );
			
			if ( ! empty( $url_args ) && is_array( $url_args ) && isset( $url_args['resize'] ) && preg_match( '/^[0-9]+,[0-9]+$/', $url_args['resize'] ) ) {
				$resize = explode( ',', $url_args['resize'] );
				$image[1] = $resize[0];
				$image[2] = $resize[1];
			} else {			
				$image_dimensions = @getimagesize( $image[0] );
				
				if ( is_array( $image_dimensions ) && count( $image_dimensions ) >= 2 ) {
					$image[1] = $image_dimensions[0];
					$image[2] = $image_dimensions[1];
				}
			}
		}
		
		// SVG Support
		if ( 'svg' == $extension && function_exists( 'simplexml_load_file' ) ) {
			$svgfile = simplexml_load_file( $image[0] );
			
			if ( isset( $svgfile->rect ) ) {
				$width = reset( $svgfile->rect['width'] );
				$height = reset( $svgfile->rect['height'] );
				
				$image = array( $image[0], $width, $height );
			}
		}
		
		// Show gifs in original size
		if ( 'gif' == $extension ) {
			$image = wp_get_attachment_image_src( $attachment_id, 'original' );
		}
	} else {
		$image = array( $attachment_id, $size[0], $size[1] );
	}
	
	$image = apply_filters( 'laborator_show_image_placeholder_image_arr', $image );
	
	if ( empty( $image ) ) {
		return '{noImageSpecified}';
	}

	$thumb_size	= array( $image[1], $image[2] );
	$element_id	= laborator_generate_as_element( $thumb_size );

	$placeholder_class = array();
	$placeholder_class[] = 'image-placeholder';
	$placeholder_class[] = $element_id;

	if ( $class ) {
		$placeholder_class[] = trim( $class );
	}
	
	if ( ! $lazy_load ) {
		$img_class = str_replace( 'visibility-hidden', 'img-loaded', $img_class );
	}
	
	// Image Attributes
	$img_atts = array_merge( array(
		'width'   => $thumb_size[0],
		'height'  => $thumb_size[1],
		'class'   => $img_class,
		'alt'     => $alt
	), $img_atts );
	
	if ( apply_filters( 'kalium_image_placeholder_lazyload', $lazy_load ) ) {
		$img_atts['data-src'] = $image[0];
		$img_atts['class'] .= ' visibility-hidden';
	} else {
		$img_atts['src'] = $image[0];
	}
	
	?>
	<span class="<?php echo implode( ' ', apply_filters( 'kalium_image_placeholder_class', $placeholder_class ) ); ?>">
		<img<?php 
			foreach ( $img_atts as $att_name => $att_val ) {
				echo ' ' . $att_name . '="' . esc_attr( $att_val ) . '"';
			}
		?>>
	</span>
	<?php
}

function get_laborator_show_image_placeholder( $attachment_id, $size = 'original', $class = '', $lazy_load = true, $img_class = null ) {
	// Store via output buffer
	ob_start();
	laborator_show_image_placeholder( $attachment_id, $size, $class, $lazy_load, $img_class );
	return ob_get_clean();
}

// Custom Style Generator
$bottom_styles = array();

function generate_custom_style( $selector, $props = '', $media = '', $footer = false ) {
	global $bottom_styles;

	$css = '';
		
		// Selector Start
		$css .= $selector . ' {' . PHP_EOL;

			// Selector Properties
		$css .= str_replace( ';', ';' . PHP_EOL, $props );

		$css .= PHP_EOL . '}';
		// Selector End
		
		// Media Wrap
		if ( trim( $media ) ) {
			$css = "@media {$media} { {$css} }";
		}


	if ( ! $footer || defined( 'DOING_AJAX' ) ) {
		echo "<style>{$css}</style>";
		return;
	}

	$bottom_styles[] = $css;
}

// Bottom Styles
function kalium_parse_bottom_styles() {
	global $bottom_styles;

	if ( ! count( $bottom_styles ) ) {
		return;
	}
	
	echo "<style>\n" . compress_text( implode( PHP_EOL . PHP_EOL, $bottom_styles ) ) . "\n</style>"; 	
}

// User IP
function get_the_user_ip() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}

// Get SVG
function laborator_get_svg( $svg_path, $id = null, $size = array( 24, 24 ), $is_asset = true ) {
	if ( $is_asset ) {
		$svg_path = get_template_directory() . '/assets/' .  $svg_path;
	}

	if ( ! $id ) {
		$id = sanitize_title( basename( $svg_path ) );
	}

	if ( is_numeric( $size ) ) {
		$size = array( $size, $size );
	}

	ob_start();

	echo file_get_contents( $svg_path );

	$svg = ob_get_clean();

	$svg = preg_replace(
		array(
			'/^.*<svg/s',
			'/id=".*?"/i',
			'/width=".*?"/',
			'/height=".*?"/'
		),
		array(
			'<svg', 'id="' . $id . '"',
			'width="' . $size[0] . 'px"',
			'height="' . $size[0] . 'px"'
		),
		$svg
	);

	return $svg;
}

// Get Main Menu
function kalium_get_main_menu( $menu_location = 'main-menu' ) {
	if ( $menu_location == '' || $menu_location == '-' ) {
		return '';
	}
	
	$args = array(
		'container'       => '',
		'theme_location'  => $menu_location,
		'echo'            => false
	);
	
	if ( is_numeric( $menu_location ) ) {
		$args['menu'] = $menu_location;
		unset( $args['theme_location'] );
	}
	
	return apply_filters( 'kalium_get_main_menu', wp_nav_menu( $args ), $args );
}

// Less Generator
function kalium_generate_less_style( $files = array(), $vars = array() ) {
	try {
		@ini_set( 'memory_limit', '256M' );
		
		if ( ! class_exists( 'Less_Parser' ) ) {
			include_once THEMEDIR . 'inc/lib/lessphp/Less.php';
		}
		
		$skin_generator = file_get_contents( THEMEDIR . 'assets/less/skin-generator.less' );
		
		// Compile Less
		$less_options = array(
			'compress' => true
		);
		
		$css = '';
				
		$less = new Less_Parser( $less_options );
		
		foreach ( $files as $file => $type ) {
			if ( $type == 'parse' ) {
				$css_contents = file_get_contents( $file );
				
				// Replace Vars
				foreach ( $vars as $var => $value ) {
					if ( trim( $value ) ) {
						$css_contents = preg_replace( "/(@{$var}):\s*.*?;/", '$1: ' . $value . ';', $css_contents );
					}
				}
				
				$less->parse( $css_contents );
			} else {
				$less->parseFile( $file );
			}
		}
		
		$css = $less->getCss();
	} catch( Exception $e ) {
	}
	
	return $css;
}

// Hex to Rgb with Alpha
function laborator_hex2rgba( $color, $opacity = false ) {
	$default = 'rgb(0,0,0)';
 
	if ( empty( $color ) ) {
		return $default;
	}
 
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	$rgb =  array_map( 'hexdec', $hex );

	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ",", $rgb ) . ')';
	}

	return $output;
}

// Escape script tag
function laborator_esc_script( $str = '' ) {
	$str = str_ireplace( array( '<script', '</script>' ), array( '&lt;script', '&lt;/script&gt;' ), $str );
	return $str;
}

// Escape script plus strip tags
function laborator_strip_script( $str = '', $tags = '' ) {
	$str = strip_tags( $str, $tags );
	return laborator_esc_script( $str );
}

// Shop Supported
function is_shop_supported() {
	return is_array( get_option( 'active_plugins' ) ) && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}

// Is ACF Pro Activated
function is_acf_pro_activated() {
	return is_array( get_option( 'active_plugins' ) ) && in_array( 'advanced-custom-fields-pro/acf.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}

// Show Menu Bar (Hambuger Icon)
function kalium_menu_icon_or_label() {
	$menu_hamburger_custom_label = get_data( 'menu_hamburger_custom_label' );
	
	if ( $menu_hamburger_custom_label ) {
		
		$label_show_text  = get_data( 'menu_hamburger_custom_label_text' );
		$label_close_text = get_data( 'menu_hamburger_custom_label_close_text' );
		$icon_position    = get_data( 'menu_hamburger_custom_icon_position', 'left' );
		
		?>
		<span class="show-menu-text icon-<?php echo esc_attr( $icon_position ); ?>"><?php echo $label_show_text; ?></span>
		<span class="hide-menu-text"><?php echo $label_close_text; ?></span>
		
		<span class="ham"></span>
		<?php
		
	} else {	
		?>
		<span class="ham"></span>
		<?php
	}
}

// Generate Unique ID
function laborator_unique_id( $prepend = 'el-' ) {
	$uniqueid = $prepend . ( function_exists( 'uniqid' ) ? uniqid() : '' ) . time() . mt_rand( 10000, 99999 );
	return $uniqueid;
}

// Get Available Terms for current WP_Query object
function laborator_get_available_terms_for_query( $args, $taxonomy = 'category' ) {
	
	// Remove pagination argument
	if ( isset( $args['paged'] ) ) {
		unset( $args['paged'] );
	}
	
	$post_ids = get_posts( array_merge( $args, array(
		'fields'          => 'ids',
		'posts_per_page'  => -1
	) ) );
	
	$term_ids  = array(); // Terms IDs Array
	
	$object_terms = wp_get_object_terms( $post_ids, $taxonomy );
	
	if ( ! empty( $object_terms ) ) {
		foreach ( $object_terms as $term ) {
			$term_ids[] = $term->term_id;
		}
	}
	
	// Order Terms
	if ( is_array( $object_terms ) && isset( $object_terms[0] ) && $object_terms[0] instanceof WP_Term && isset( $object_terms[0]->term_order ) ) {
		uasort( $object_terms, 'kalium_sort_terms_taxonomy_order_fn' );
	}
	
	// Fix Missing Parent Categories
	foreach ( $object_terms as & $term ) {
		if ( ! in_array( $term->parent, $term_ids ) ) {
			$term->parent = 0;
		}
	}
	
	return $object_terms;
}

function kalium_sort_terms_taxonomy_order_fn( $a, $b ) {
	return $a->term_order > $b->term_order ? 1 : -1;
}

// Append content to the footer
$lab_footer_html = array();

add_action( 'wp_footer', 'laborator_append_content_to_footer_parse_content' );

function laborator_append_content_to_footer( $str ) {
	global $lab_footer_html;
	
	if ( defined( 'DOING_AJAX' ) ) {
		echo $str;
	} else {
		$lab_footer_html[] = $str;
	}
}

function laborator_append_content_to_footer_parse_content() {
	global $lab_footer_html;
	echo implode( PHP_EOL, $lab_footer_html );
}

// File Based Custom Skin
function kalium_use_filebased_custom_skin() {
	$custom_skin_path = '/assets/css/custom-skin.css';
	
	if ( is_child_theme() ) {
		$custom_skin_path = '/custom-skin.css';
	}
	
	$custom_skin_path_full = get_stylesheet_directory() . $custom_skin_path;
	
	// Create skin file in case it does not exists
	if ( file_exists( $custom_skin_path_full ) === false ) {
		touch( $custom_skin_path_full );
	}
	
	if ( is_writable( $custom_skin_path_full ) === true ) {
		
		if ( ! trim( file_get_contents( $custom_skin_path_full ) ) ) {
			return kalium_generate_custom_skin_file();
		}
		
		return true;
	}
	
	return false;
}

// Generate Custom Skin File
function kalium_generate_custom_skin_file() {
	$custom_skin_path = get_stylesheet_directory() . '/assets/css/custom-skin.css';
	
	if ( is_child_theme() ) {
		$custom_skin_path = get_stylesheet_directory() . '/custom-skin.css';
	}
	
	if ( is_writable( $custom_skin_path ) ) {
		$kalium_skin_custom_css = get_option( 'kalium_skin_custom_css' );
		
		$fp = fopen( $custom_skin_path , 'w' );
		fwrite( $fp, $kalium_skin_custom_css );
		fclose( $fp );
		
		return true;
	}
	
	return false;
}

// Get URL in content
function laborator_get_url_in_content( $str ) {
	$url = '';
	$url_regex = '/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9+&@#\/%=~_|$])/im';
	
	if ( preg_match( $url_regex, $str, $matched_urls ) ) {
		return $matched_urls[0];
	}
	
	return $url;
}

// Default Value Set for Visual Composer Loop Parameter Type
function kalium_vc_loop_param_set_default_value( & $query, $field, $value = '' ) {
	
	if ( ! preg_match( '/(\|?)' . preg_quote( $field ) . ':/', $query ) ) {
		$query .= "|{$field}:{$value}";
	}
	
	return ltrim( '|', $query );
}

// Get Post Likes
function get_post_likes( $post_id = null ) {
	global $post;

	$user_ip   = get_the_user_ip();
	$the_post  = $post_id ? get_post( $post_id ) : $post;
	$likes     = $the_post->post_likes;

	if ( ! is_array( $likes ))
		$likes = array();

	$output    = array(
		'liked' => in_array($user_ip, $likes),
		'count' => count( $likes )
	);

	return $output;
}

// Immediate Return Function
function laborator_immediate_return_fn( $return ) {
	$return_fn = 'return "' . addslashes( $return ) . '";';
	
	if ( is_numeric( $return ) ) {
		$return_fn = "return {$return};";
	}
	return create_function( '', $return_fn );
}