<?php
/**
 *	Blog Posts
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

list( $query_args, $blog_query ) = vc_build_loop_query( $blog_query );

$unique_id = 'blogposts-' . mt_rand(1000, 10000);

if ( function_exists( 'uniqid' ) ) {
	$unique_id .= uniqid();
}

$is_masonry     = false;
$columns_class  = '';
$columns_count  = intval( $columns );

$more_link = vc_build_link($more_link);

$blog_posts_options = explode( ',', $blog_posts_options );

switch( $masonry ) {
	
	case 'masonry':
	case 'packery':
	case 'fitRows':
		$is_masonry = true;
		break;
}

switch( $columns ) {
	
	case '1':
		$columns_class = 'col-sm-12';
		break;
	
	case '2':
		$columns_class = 'col-sm-6';
		break;
	
	case '4':
		$columns_class = 'col-md-3 col-sm-6';
		break;
	
	default:
		$columns_class = 'col-md-4 col-sm-6';
		$columns_count = 3;
}

# Custom Class
$css_classes = array(
	$this->getExtraClass( $el_class ),
	'row',
	'lab-blog-posts',
	'posts-layout-' . $layout,
	vc_shortcode_custom_css_class( $css ),
);

if ( $is_masonry ) {
	$css_classes[] = 'display-loading';
}

if ( in_array( 'animated-eye-hover', $blog_posts_options ) ) {
	$css_classes[] = 'animated-eye-hover';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$image_size = empty( $image_size ) ? '400x250' : $image_size;

if ( $layout == 'left' ) {
	add_filter( 'excerpt_length', 'laborator_supershort_excerpt_length', 150 );
	
	$image_column_size = intval( $image_column_size );
	
	if ( $image_column_size ) {
		generate_custom_style( "#{$unique_id} .blog-post-image", "width: {$image_column_size}%" );
	}
}
?>
<div id="<?php echo $unique_id; ?>" class="<?php echo $css_class; ?>" <?php if ( $is_masonry ) : ?> data-masonry-mode="<?php echo $masonry; ?>"<?php endif; ?>>
	
	<?php 
	if ( $blog_query->have_posts() ) : 
		
		$i = 0;
		
		while( $blog_query->have_posts() ) : $blog_query->the_post();
			
			echo '<div class="blog-post-column ' . $columns_class . '">';
			
			?>
			<div <?php post_class( 'blog-post-entry' ); ?>>
			<?php
			
				$post_thumb_id = get_post_thumbnail_id();
				
				if ( $post_thumb_id ) {
					$image = wpb_getImageBySize( array( 'attach_id' => $post_thumb_id, 'thumb_size' => $image_size, 'class' => 'img-responsive' ) );
					
					if ( isset( $image['thumbnail'] ) ) {
						
						preg_match( "/src=\"([^\"]*)\"/", $image['thumbnail'], $src_attribute );
						preg_match( "/width=\"([^\"]*)\"/", $image['thumbnail'], $width_attribute );
						preg_match( "/height=\"([^\"]*)\"/", $image['thumbnail'], $height_attribute );
						
						?>
						<div class="blog-post-image do-lazy-load">
							<a href="<?php the_permalink(); ?>">
								<?php echo laborator_show_image_placeholder( $src_attribute[1], array( $width_attribute[1], $height_attribute[1] ), 'do-lazy-load' ); ?>
								
								<span class="hover-display">
									<i class="icon-basic-link"></i>
								</span>
							</a>
						</div>
						<?php
					}
				}
				
				?>
				<div class="blog-post-content-container">
					
					<?php if ( in_array( 'date', $blog_posts_options ) ) : ?>
					<div class="blog-post-date">
						<?php the_time( get_option( 'date_format' ) ); ?>
					</div>
					<?php endif; ?>
					
					<h3 class="blog-post-title">
						<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					
					<div class="blog-post-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<?php
			
			?>
			</div>
			<?php
			
			echo '</div>';
			
			if ( $is_masonry == false && ( $i + 1 ) % $columns_count == 0 ) {
				echo '<div class="clear"></div>';
			}
			
			$i++;
		
		endwhile;
		
		wp_reset_postdata();
		
	endif; 
	?>
	
</div>
	
	
<?php if ( $more_link['url'] && $more_link['title'] ) : ?>
<div class="more-link <?php echo isset( $show_effect ) && $show_effect ? $show_effect : ''; ?>">
	<div class="show-more">
		<div class="button">
			<a href="<?php echo esc_url( $more_link['url'] ); ?>" target="<?php echo esc_attr( $more_link['target'] ); ?>" class="btn btn-white">
				<?php echo esc_html( $more_link['title'] ); ?>
			</a>
		</div>
	</div>
</div>
<?php endif; ?>

			
<?php
if ( $is_masonry ) {
	?>
	<div class="blog-posts-loading-message">
		<?php _e( 'Loading blog posts...', 'kalium' ); ?>
	</div>
	<?php
}

if ( $layout == 'left' ) {
	remove_filter( 'excerpt_length', 'laborator_supershort_excerpt_length', 150 );
}