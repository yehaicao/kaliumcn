<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $force_show_heading_title, $force_heading_title, $force_heading_description;

include_once locate_template( 'tpls/blog-query.php' );

$is_masonry = $blog_template == 'blog-masonry';

// Custom Excerpt length for items
if ( $sidebar_position != 'hide' ) {
	add_filter( 'excerpt_length', 'laborator_short_excerpt_length' );
}

// Masonry init Isotope
if ( $is_masonry ) {
	
	switch ( $blog_columns ) {
		case '_3':
			add_filter('excerpt_length', 'laborator_short_excerpt_length');
			break;

		case '_4':
			add_filter('excerpt_length', 'laborator_supershort_excerpt_length');
			break;
	}
}

// Blog Heading Title
if ( $blog_show_header ) {
	$force_show_heading_title  = true;
	$force_heading_title       = $blog_title;
	$force_heading_description = $blog_description;
}

// Proportional Image Height
if ( $blog_proportional_thumbs ) {
	add_filter( 'kalium_blog_thumbnail_size', 'kalium_blog_thumbnail_size_proportional' );
}

get_header();

?>
<div class="container">

	<div class="blog-holder<?php echo $is_masonry ? ' is-masonry-mode' : ''; ?>">
		<div class="row">
			<div class="col-md-<?php
				echo $sidebar_position == 'hide' ? 12 : 9;
				echo ' clearfix';
				when_match( $sidebar_position == 'left', 'pull-right-md' );	
				when_match( $sidebar_position != 'hide', 'sidebar-present' );
				?>">

				<?php

				// Loading Indicator
				if ( $is_masonry ) {
					echo '<div class="masonry-still-loading">
						<strong>' . __( 'Loading posts...', 'kalium' ) . '</strong>
					</div>';
				}

				?>
				<div<?php echo $is_masonry ? ' id="isotope-container"' : ''; ?> class="blog-posts-holder portfolio-holder">
				<?php

				while ( $posts_query->have_posts() ): $posts_query->the_post();

					if ( $is_masonry ) {
						get_template_part( 'tpls/post-format-2' );
					} else {
						get_template_part( 'tpls/post-format-1' );
					}

				endwhile;

				?>
				</div>
				<?php

				if ( $max_num_pages > 1 ) :

					switch ( $pagination_type ) {
						case 'endless':
						case 'endless-reveal':

							if ( $blog_post_formats ) {
					    		wp_enqueue_script( array( 'slick', 'video-js', 'video-js-youtube' ) );
					    		wp_enqueue_style( array( 'slick', 'video-js' ) );
				    		}

							$endless_opts = array(
								'current'      => 2,
								'maxpages'     => $max_num_pages,

								'reveal'       => $pagination_type == 'endless-reveal',

								'action'       => 'laborator_get_paged_blog_posts',
								'callback'     => 'laboratorGetBlogPosts',

								'type'  	   => get_data( 'blog_endless_pagination_style' ),

								'opts'         => array(
									'useFormat'   => $is_masonry ? 2 : 1,
									'q'           => $posts_query->query
								)
							);

							laborator_show_endless_pagination( $endless_opts );
							break;

						default:
							
							// Standard Pagination
							$prev_icon = '<i class="flaticon-arrow427"></i>';
							$prev_text = __( 'Previous', 'kalium' );
							
							$next_icon = '<i class="flaticon-arrow413"></i>';
							$next_text = __( 'Next', 'kalium' );
							?>
							<div class="pagination-container align-<?php echo $pagination_position; ?>">
							<?php 
								echo paginate_links( apply_filters( 'kalium_blog_pagination_args', array(
									'mid_size'    => 2,
									'end_size'    => 2,
									'total'		  => $max_num_pages,
									'prev_text'   => "{$prev_icon} {$prev_text}",
									'next_text'   => "{$next_text} {$next_icon}",
								) ) ); 
							?>
							</div>
							<?php
					}

				endif;
				?>

			</div>

			<?php if ( in_array( $sidebar_position, array( 'left', 'right' ) ) ) : ?>
			<div class="col-md-3 col-sm-12">
				<div class="blog-sidebar">

					<?php dynamic_sidebar( 'blog_sidebar' ); ?>

				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>


</div>
<?php

get_footer();