<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $post, $thumb_size;

// Gather Post Data
$thumb_size = 'blog-single-1';

$featured_image_placing = get_field( 'featured_image_placing' ); // Static, to be made Dynamic

if ( $featured_image_placing == 'default' ) {
	$featured_image_placing = get_data( 'blog_featured_image_placement' );
}

include locate_template( 'tpls/blog-query.php' );
include locate_template( 'tpls/post-details.php' );

$author_info_details = $blog_author_info || ( $blog_post_date || $blog_category );
?>
<div <?php post_class( 'single-blog-holder' ); ?>>

	<?php
	// Full Size Post Thumbnail/Format Content
	if ( $featured_image_placing == 'full-width' ) {
		include locate_template( 'tpls/post-single-thumbnail.php' );
	}
	?>

    <div class="container">

		<?php
		// Container Size Post Thumbnail/Format Content
		if ( ! in_array( $featured_image_placing, array( 'full-width', 'hide' ) ) ) {
			include locate_template( 'tpls/post-single-thumbnail.php' );
		}
		?>

    	<div class="page-container">
			<div class="row">
    			<div class="<?php
	    			echo $author_info_details && $blog_author_info_placement != 'bottom' ? 'col-md-10 col-sm-9-x' : 'col-xs-12'; 
		    		echo $blog_author_info_placement == 'left' ? ' pull-right-md' : '';
		    	?>">
	    			<div class="row">
		    			<div class="col-xs-12">
			    			<div class="blog-content-holder">
					    		<div class="section-title blog-title">
						    		<h1><?php the_title(); ?></h1>
						    		
						    		<?php if ( $blog_author_info_placement == 'bottom' && ( $blog_post_date || $blog_category ) ) : ?>
						    		<div class="post-date-and-category">
							    		<?php include locate_template( 'tpls/post-category-date.php' ); ?>
						    		</div>
						    		<?php endif; ?>
								</div>

			    				<div class="post-content post-formatting">
				    				<?php echo apply_filters( 'the_content_single', apply_filters( 'the_content', $post_content ) ); ?>
			    				</div>

			    				<?php
				    				wp_link_pages( array(
										'before'              => '<div class="pagination post-pagination">',
										'after'               => '</div>',
										'pagelink'            => '<span class="active">%</span>',
										'next_or_number'      => 'next',
										'previouspagelink'    => '&laquo; ' . __( 'Previous page', 'kalium' ),
										'nextpagelink'        => __( 'Next page', 'kalium' ) . ' &raquo;',
									));
			    				?>

				    			<?php
				    			if ( $blog_tags ) {
				    				the_tags( '<div class="tags-holder">', ' ', '</div>' );
								}
				    			?>
		    				</div>
		    			</div>

						<?php get_template_part( 'tpls/post-single-share' ); ?>

	    			</div>
    			</div>

				<?php if ( $author_info_details && $blog_author_info_placement != 'bottom' ) : ?>
    			<div class="col-md-2 col-sm-3-x col-xs-12 clearfix">
	    			<div class="author-info-placement-<?php echo $blog_author_info_placement; ?>">
		    			<?php include locate_template( 'tpls/post-single-author.php' ); ?>
		    			<?php include locate_template( 'tpls/post-category-date.php' ); ?>
	    			</div>
    			</div>
    			<?php elseif ( $blog_author_info && $blog_author_info_placement == 'bottom' ) : ?>
    			<div class="col-md-12">
	    			<div class="author-info-placement-<?php echo $blog_author_info_placement; ?>">
		    			<?php include locate_template( 'tpls/post-single-author.php' ); ?>
	    			</div>
    			</div>
    			<?php endif; ?>
    		</div>

    		<?php get_template_part( 'tpls/post-single-prevnext' ); ?>
		</div>

    </div>

	<?php 
		// Post Comments
		comments_template(); 
	?>

</div>