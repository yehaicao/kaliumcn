<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

?>
<div class="gallery gallery-type-description<?php 
	when_match( $image_spacing == 'nospacing', 'no-spacing'); 
	when_match($full_width_gallery, 'full-width-container'); 
?>">
	<?php
	foreach ( $gallery_items as $i => $gallery_item ) :

		$main_thumbnail_size = 1;

		// General Vars
		$description             = $gallery_item['description'];
		$description_width       = $gallery_item['description_width'];
		$description_alignment   = $gallery_item['description_alignment'];

		$main_thumbnail_size = 'portfolio-single-img-';
		$thumb_size = 2;


			// Column Classes
			$row_classes		 = array( 'row' );
			$description_class   = array( 'col-sm-5' );
			$image_class         = array( 'col-sm-7', 'zz-type-' . $gallery_item['acf_fc_layout'] );

			switch ( $description_width ) {
				case "4-12":
					$description_class = array( 'col-sm-4' );
					$image_class       = array( 'col-sm-8' );
					$thumb_size        = 1;
					break;

				case "6-12":
					$description_class = array( 'col-sm-6' );
					$image_class       = array( 'col-sm-6' );
					break;
			}

			$image_class[] = 'nivo';
			$image_class[] = 'media-type-' . $gallery_item['acf_fc_layout'];

			switch ( $images_reveal_effect ) {
				case 'slidenfade':
					$row_classes[] = 'wow fadeInLab';
					break;

				case 'fade':
					$row_classes[] = 'wow fadeIn';
					break;

				default:
					$item_classes[] = 'wow';
			}

			// Description Alignment
			if ( $description_alignment == 'right' ) {
				$description_class[] = 'pull-right-md';
			}

		$main_thumbnail_size .= $thumb_size;
		$main_thumbnail_size = apply_filters( 'kalium_single_portfolio_gallery_image', $main_thumbnail_size );

		// Row-Start
		?>
		<div class="<?php echo implode( ' ', $row_classes ); ?>">
		<?php

		// Image Type
		if ( $gallery_item['acf_fc_layout'] == 'image' ) :

			$img          = $gallery_item['image'];
			$caption      = nl2br( make_clickable( $img['caption'] ) );
			$alt_text 	  = $img['alt'];
			$href		  = $img['url'];

			if ( ! $img['id'] ) {
				continue;
			}

			$is_video = $alt_text && preg_match( "/(youtube\.com|vimeo\.com)/i", $alt_text );

			?>
			<div class="<?php echo implode( ' ', $description_class ); ?>">

				<div class="gallery-item-description hidden<?php 
					when_match( $i == 0, 'first-entry'); 
					echo " description-{$description_alignment}"; 
				?>">
					<div class="post-formatting">
						<?php echo $description; // Escaped by ACF plugin ?>
					</div>
				</div>
				<div class="lgrad"></div>

			</div>
			<div class="<?php echo implode( ' ', $image_class ); ?>">
				
				<div class="photo">
					<a href="<?php echo $is_video ? esc_url( $alt_text ) : esc_url( $href ); ?>"  data-lightbox-gallery="post-gallery">
						<?php laborator_show_image_placeholder( $img['id'], $main_thumbnail_size, 'do-lazy-load-on-shown' ); ?>
					</a>

					<?php if ( $caption ) : ?>
					<div class="caption">
						<?php echo laborator_esc_script( $caption ); ?>
					</div>
					<?php endif; ?>
				</div>

			</div>
			<?php

		endif;
		// End: Image Type


		// Image Slider
		if ( $gallery_item['acf_fc_layout'] == 'images_slider' ) :

			$gallery_images = $gallery_item['images'];
			$auto_switch    = $gallery_item['auto_switch'];

			if ( ! is_array( $gallery_images ) || ! $gallery_images ) {
				continue;
			}

			wp_enqueue_script( 'slick' );
			wp_enqueue_style( 'slick' );

			?>
			<div class="<?php echo implode( ' ', $description_class ); ?>">

				<div class="gallery-item-description hidden<?php 
					when_match( $i == 0, 'first-entry' );
					echo " description-{$description_alignment}"; 
				?>">
					<div class="post-formatting">
						<?php echo $description; // Escaped by ACF plugin ?>
					</div>
				</div>
				<div class="lgrad"></div>

			</div>
			<div class="<?php echo implode( ' ', $image_class ); ?>">
				<div class="portfolio-images-slider do-lazy-load" data-autoswitch="<?php echo esc_attr( $auto_switch ); ?>">
					<?php
					foreach ( $gallery_images as $j => $image ) :

						$caption = $image['caption'];
						$img_class = when_match( $j > 0, 'hidden', '', false );
					?>
					<div class="image-slide nivo">
						<a href="<?php echo esc_url( $image['url'] ); ?>" title="<?php echo esc_attr( apply_filters( 'kalium_portfolio_lightbox_image_caption', $caption ) ); ?>" data-lightbox-gallery="post-gallery-<?php echo esc_attr( $i ); ?>">
							<?php laborator_show_image_placeholder( $image['id'], $main_thumbnail_size, $img_class, true, '' ); ?>
						</a>
					</div>
					<?php
					endforeach;
					?>
				</div>
			</div>
			<?php

		endif;
		// End: Image Slider


		// Comparison Images
		if ( $gallery_item['acf_fc_layout'] == 'comparison_images' ) :

			$image_1            = $gallery_item['image_1'];
			$image_2            = $gallery_item['image_2'];

			$image_1_label		= $image_1['title'];
			$image_2_label		= $image_2['title'];

			$image_1_attachment = wp_get_attachment_image_src( $image_1['id'], $main_thumbnail_size );
			$image_1_id         = laborator_generate_as_element( array( $image_1_attachment[1], $image_1_attachment[2] ) );


			?>
			<div class="<?php echo implode(' ', $description_class); ?>">

				<div class="gallery-item-description hidden<?php 
					when_match( $i == 0, 'first-entry' ); 
					echo " description-{$description_alignment}"; 
				?>">
					<div class="post-formatting">
						<?php echo $description; // Escaped by ACF plugin ?>
					</div>
				</div>
				<div class="lgrad"></div>

			</div>
			<div class="<?php echo implode( ' ', $image_class ); ?>">

				<figure class="comparison-image-slider <?php echo esc_attr( $image_1_id ); ?>">

					<img data-src="<?php echo esc_url( $image_1_attachment[0] ); ?>" class="do-lazy-load-on-shown hidden" />

					<?php if ( $image_1_label ) : ?>
					<span class="cd-image-label" data-type="original"><?php echo esc_html( $image_1_label ); ?></span>
					<?php endif;?>

					<div class="cd-resize-img">
						<?php echo wp_get_attachment_image( $image_2['id'], $main_thumbnail_size ); ?>
						
						<?php if ( $image_2_label ) : ?>
						<span class="cd-image-label" data-type="modified"><?php echo esc_html( $image_2_label ); ?></span>
						<?php endif;?>
					</div>

					<span class="cd-handle"></span>
				</figure>

			</div>
			<?php

		endif;
		// End: Comparison Images


		// YouTube Video
		if ( $gallery_item['acf_fc_layout'] == 'youtube_video' ) :

			$video_url          = $gallery_item['video_url'];
			$video_resolution   = $gallery_item['video_resolution'];
			$video_poster       = $gallery_item['video_poster'];
				
			// Added in v1.8
			$youtube_default	= $gallery_item['default_youtube_player'];
			$auto_play			= $gallery_item['auto_play'];
			$video_loop			= $gallery_item['loop'];

			// Check Type
			parse_str( parse_url( $video_url, PHP_URL_QUERY ), $video_url_args );

			if ( ! is_array( $video_url_args ) || ! isset( $video_url_args['v'] ) ) {
				continue;
			}

			// Video Resolution
			$video_unique_id = laborator_unique_id();
			
			if ( ! preg_match( "/^[0-9]+:[0-9]+$/", $video_resolution ) ) {
				$video_resolution = "16:9";
			}
			
			if ( $video_resolution ) {						
				$video_resolution = explode( 'x', str_replace( ':', 'x', $video_resolution ) );
				$video_resolution_padding = $video_resolution[1] / $video_resolution[0] * 100;
				
				generate_custom_style( "#{$video_unique_id} .video-aspect-ratio", "padding-top: {$video_resolution_padding}% !important" );
			}
			
			// Video Poster
			$fn_poster = '';
			
			if ( $video_poster && $video_poster['url'] ) {
				
				$fn_poster  = '$atts["poster"] = "' . addslashes( $video_poster['url'] ) . '";';
				$fn_poster .= 'return $atts;';
				
				$fn_poster = create_function( '$atts', $fn_poster );
				
				add_filter( 'kalium_video_shortcode_container_atts', $fn_poster );
			}
			
			// Auto Play Video
			$fn_autoplay = '';
			
			if ( $auto_play ) {
				$fn_autoplay  = '$atts["autoplay"] = "autoplay";';
				$fn_autoplay .= 'return $atts;';
				
				$fn_autoplay = create_function( '$atts', $fn_autoplay );
				
				add_filter( 'kalium_video_shortcode_container_atts', $fn_autoplay );
			}
			
			// Loop Video
			$fn_loop = '';
			
			if ( $video_loop ) {
				$fn_loop  = '$atts["loop"] = "loop";';
				$fn_loop .= 'return $atts;';
				
				$fn_loop = create_function( '$atts', $fn_loop );
				
				add_filter( 'kalium_video_shortcode_container_atts', $fn_loop );
			}

			?>
			<div class="<?php echo implode( ' ', $description_class ); ?>">

				<div class="gallery-item-description hidden<?php when_match($i == 0, 'first-entry'); echo " description-{$description_alignment}"; ?>">
					<div class="post-formatting">
						<?php echo $description; // escaped by ACF plugin ?>
					</div>
				</div>
				<div class="lgrad"></div>

			</div>
			<div id="<?php echo $video_unique_id; ?>" class="<?php echo implode( ' ', $image_class ); ?>">
				<div class="portfolio-video-holder">
					<?php
					if ( $youtube_default ) {
						echo '<div class="video-aspect-ratio"></div>';
						echo '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . $video_url_args['v'] . '?' . ( isset( $video_url_args['list'] ) ? "list={$video_url_args['list']}&" : '' ) . 'rel=0&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe>';
					} else {
						global $wp_embed;
						echo $wp_embed->autoembed( $video_url );
					}
					?>
				</div>
			</div>
			<?php
					
			if ( ! empty( $fn_poster ) ) {
				remove_filter( 'kalium_video_shortcode_container_atts', $fn_poster );
			}
				
			if ( ! empty( $fn_autoplay ) ) {
				remove_filter( 'kalium_video_shortcode_container_atts', $fn_autoplay );
			}
				
			if ( ! empty( $fn_loop ) ) {
				remove_filter( 'kalium_video_shortcode_container_atts', $fn_loop );
			}

		endif;
		// End: YouTube Video


		// Vimeo Video
		if ( $gallery_item['acf_fc_layout'] == 'vimeo_video' ) :

			$video_url          = $gallery_item['video_url'];
			$video_resolution   = $gallery_item['video_resolution'];

			// Check Type
			$video_path = explode( "/", trim( parse_url( $video_url, PHP_URL_PATH ), '/' ) );
			$video_id = $video_path[0];

			if ( ! is_numeric( $video_id ) ) {
				continue;
			}

			// Video Resolution
			$video_unique_id = laborator_unique_id();
			
			if ( ! preg_match( "/^[0-9]+:[0-9]+$/", $video_resolution ) ) {
				$video_resolution = "16:9";
			}
			
			if ( $video_resolution ) {						
				$video_resolution = explode( 'x', str_replace( ':', 'x', $video_resolution ) );
				$video_resolution_padding = $video_resolution[1] / $video_resolution[0] * 100;
				
				generate_custom_style( "#{$video_unique_id} .video-aspect-ratio", "padding-top: {$video_resolution_padding}% !important" );
			}

			?>
			<div class="<?php echo implode( ' ', $description_class ); ?>">

				<div class="gallery-item-description hidden<?php when_match( $i == 0, 'first-entry' ); echo " description-{$description_alignment}"; ?>">
					<div class="post-formatting">
						<?php echo $description; // escaped by ACF plugin ?>
					</div>
				</div>
				<div class="lgrad"></div>

			</div>
			<div class="<?php echo implode( ' ', $image_class ); ?>">
				<div id="<?php echo $video_unique_id; ?>" class="portfolio-video-holder">
					<?php
					// Embed Vimeo Video 
					global $wp_embed;
					echo $wp_embed->autoembed( $video_url ); 
					?>
				</div>
			</div>
			<?php

		endif;
		// End: Vimeo Video


		// Self-Hosted Video
		if ( $gallery_item['acf_fc_layout'] == 'selfhosted_video' ) :

			$video_file             = $gallery_item['video_file'];
			$video_resolution       = $gallery_item['video_resolution'];
			$video_poster           = $gallery_item['video_poster'];
			$video_file_pathinfo    = pathinfo( $video_file['url'] );
				
			// Added in v1.8
			$auto_play			= $gallery_item['auto_play'];
			$video_loop			= $gallery_item['loop'];

			// Check Type
			$show_video = true;
			
			if ( ! isset( $video_file_pathinfo['extension'] ) || ! in_array( strtolower( $video_file_pathinfo['extension'] ), array( 'mp4', 'webm', 'ogv' ) ) ) {
				$show_video = false;
			}

			// Prepare Video
			$videojs_atts = 'src="' . $video_file['url'] . '"';

			if ( $video_poster && $video_poster['url'] ) {
				$videojs_atts .= ' poster="' . $video_poster['url'] . '"';
			}
			
			// Video Resolution
			if ( ! preg_match( "/^[0-9]+:[0-9]+$/", $video_resolution ) ) {
				$video_resolution = "16:9";
			}
			
			$video_unique_id = laborator_unique_id();
			
			if ( $video_resolution ) {						
				$video_resolution = explode( 'x', str_replace( ':', 'x', $video_resolution ) );
				$video_resolution_padding = $video_resolution[1] / $video_resolution[0] * 100;
				
				generate_custom_style( "#{$video_unique_id} .video-aspect-ratio", "padding-top: {$video_resolution_padding}% !important" );
			}
			
			// Auto Play Video
			$fn_autoplay = '';
			
			if ( $auto_play ) {
				$fn_autoplay  = '$atts["autoplay"] = "autoplay";';
				$fn_autoplay .= 'return $atts;';
				
				$fn_autoplay = create_function( '$atts', $fn_autoplay );
				
				add_filter( 'kalium_video_shortcode_container_atts', $fn_autoplay );
			}
			
			// Loop Video
			$fn_loop = '';
			
			if ( $video_loop ) {
				$fn_loop  = '$atts["loop"] = "loop";';
				$fn_loop .= 'return $atts;';
				
				$fn_loop = create_function( '$atts', $fn_loop );
				
				add_filter( 'kalium_video_shortcode_container_atts', $fn_loop );
			}
			
			// Generate Video Shortcode
			$video_shortcode = do_shortcode( '[video ' . $videojs_atts . ']' );
			
			if ( $show_video ) :
			?>
			<div class="<?php echo implode( ' ', $description_class ); ?>">

				<div class="gallery-item-description hidden<?php when_match( $i == 0, 'first-entry' ); echo " description-{$description_alignment}"; ?>">
					<div class="post-formatting">
						<?php echo $description; // escaped by ACF plugin ?>
					</div>
				</div>
				<div class="lgrad"></div>

			</div>
			<div class="<?php echo implode( ' ', $image_class ); ?>">
				<div class="portfolio-video-holder">
					<?php echo $video_shortcode; // output generated by [video] shortcode ?>
				</div>
			</div>
			<?php
			endif;
					
			if ( ! empty( $fn_autoplay ) ) {
				remove_filter( 'kalium_video_shortcode_container_atts', $fn_autoplay );
			}
				
			if ( ! empty( $fn_loop ) ) {
				remove_filter( 'kalium_video_shortcode_container_atts', $fn_loop );
			}

		endif;
		// End: Self-Hosted Video
		
		
		// HTML
		if ( $gallery_item['acf_fc_layout'] == 'html' ) :

			?>
			<div class="<?php echo implode( ' ', $description_class ); ?>">

				<div class="gallery-item-description hidden<?php 
					when_match( $i == 0, 'first-entry'); 
					echo " description-{$description_alignment}"; 
				?>">
					<div class="post-formatting">
						<?php echo $description; // Escaped by ACF plugin ?>
					</div>
				</div>
				<div class="lgrad"></div>

			</div>
			<div class="<?php echo implode( ' ', $image_class ); ?>">
				
				<div class="post-formatting">
					<?php echo apply_filters( 'the_content', $gallery_item['content'] ); ?>
				</div>
			</div>
			<?php
				
		endif;
		// End: HTML

		?>
		</div>
		<?php

	endforeach;
	?>
</div>