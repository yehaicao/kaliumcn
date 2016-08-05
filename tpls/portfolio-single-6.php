<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

include locate_template( 'tpls/portfolio-single-item-details.php' );

// Lightbox Initialize Options
do_action( 'kalium_portfolio_items_before' );
do_action( 'kalium_portfolio_item_before', 'type-6' ); 
?>
<div class="container">

	<div class="page-container">

		<div class="single-portfolio-holder portfolio-type-6 clearfix">
			
			<div class="title section-title">
				<h1><?php the_title(); ?></h1>

				<?php if ( $sub_title ) : ?>
				<p><?php echo esc_html( $sub_title ); ?></p>
				<?php endif; ?>
			</div>
			
			<?php if ( $post_thumbnail_id ) : ?>
			<a href="#open" data-portfolio-item-id="<?php echo the_ID(); ?>" class="lightbox-featured-image do-lazy-load-on-shown">
				<?php laborator_show_image_placeholder( $post_thumbnail_id, apply_filters( 'kalium_single_portfolio_gallery_image', 'portfolio-single-img-1' ) ); ?>
				<em>
					<?php _e( 'Open in Lightbox', 'kalium' ); ?>
					<i></i>
				</em>
			</a>
			<?php endif; ?>
			
			<?php include locate_template( 'tpls/portfolio-single-prevnext.php' ); ?>
		</div>
	</div>

</div>