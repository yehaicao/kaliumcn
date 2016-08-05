<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

include locate_template( 'tpls/portfolio-single-item-details.php' );

$has_services_section   = $launch_link_href || count( $checklists );
$is_centered            = $layout_type == 'centered';

wp_enqueue_script( 'nivo-lightbox' );
wp_enqueue_style( 'nivo-lightbox-default' );


# Title Markup (Save as buffered output)
ob_start();

?>
<div class="title section-title<?php echo $is_centered ? ' text-on-center' : ''; ?>">
	<h1><?php the_title(); ?></h1>
	<?php if ( $sub_title ) : ?>
	<p><?php echo esc_html( $sub_title ); ?></p>
	<?php endif; ?>

	<?php if ( $is_centered ) : ?>
	<div class="dash small"></div>
	<?php endif; ?>
</div>
<?php
	
$item_title = ob_get_clean();

?>
<div class="container">

	<div class="page-container">
    	<div class="single-portfolio-holder portfolio-type-2<?php when_match( $is_centered, 'portfolio-centered-layout alt-six', 'alt-four' ); ?>">

			<?php 
			if ( $title_position == 'before' ) {
				echo $item_title; 
			}
			?>

			<?php
			if ( $show_featured_image && $has_thumbnail && $post_thumbnail_id ) :

				$featured_image = get_post( $post_thumbnail_id );
				$caption        = $featured_image->post_excerpt;

				$fi_href		= $featured_image->guid;
				$fi_alt			= $featured_image->_wp_attachment_image_alt;

				$is_video 		= $fi_alt && preg_match( '/(youtube\.com|vimeo\.com)/i', $fi_alt );

				$fi_classes     = array( 'portfolio-featured-image do-lazy-load-on-shown' );
				
				if ( $fullwidth_featured_image ) {
					$fi_classes[] = 'full-width-container';
				}

				switch ( $images_reveal_effect ) {
					case 'slidenfade':
						$fi_classes[] = 'wow fadeInLab';
						break;

					case 'fade':
						$fi_classes[] = 'wow fadeIn';
						break;
				}
			?>
	    	<div class="<?php echo implode( ' ', $fi_classes ); ?>">

				<a href="<?php echo $is_video ? esc_url( $fi_alt ) : esc_url( $fi_href ); ?>" class="nivo">
					<?php laborator_show_image_placeholder( $post_thumbnail_id, apply_filters( 'kalium_single_portfolio_gallery_image', 'portfolio-single-img-1' ) ); ?>
				</a>

				<?php if($caption): ?>
				<div class="caption">
    				<?php echo nl2br( laborator_esc_script( $caption ) ); ?>
    			</div>
				<?php endif; ?>
			</div>
			<?php
			endif;
			?>

			<?php 
			if ( $title_position != 'before' ) {
				echo $item_title; 
			}
			?>

    		<div class="details row">
    			<div class="<?php echo $has_services_section && $is_centered == false ? 'col-sm-8' : 'col-sm-12'; ?>">
	    			<div class="project-description">
	    				<div class="post-formatting">
							<?php the_content(); ?>
						</div>
	    			</div>
    			</div>

				<?php if ( $has_services_section && $is_centered == false ) : ?>
    			<div class="col-sm-3 col-sm-offset-1">
	    			<div class="services">
		    			<?php include locate_template( 'tpls/portfolio-checklists.php' ); ?>

		    			<?php include locate_template( 'tpls/portfolio-launch-project.php' ); ?>
	    			</div>
    			</div>
    			<?php endif; ?>

				<?php 
				if ( $share_and_like_position == 'before' ) {
					?>
					<div class="col-sm-12">
					<?php include locate_template('tpls/portfolio-single-like-share.php'); ?>
					</div>
					<?php
				}
				?>

				<?php if ( $has_services_section && $is_centered == true ) : ?>
	    		<div class="col-sm-12 inline-checklists">

	    			<?php include locate_template( 'tpls/portfolio-checklists.php' ); ?>

					<?php include locate_template( 'tpls/portfolio-launch-project.php' ); ?>

				</div>
				<?php endif; ?>
    		</div>

			<div class="col-sm-12">
				<?php include locate_template( 'tpls/portfolio-gallery.php' ); ?>
			</div>

			<?php 
			if ( $share_and_like_position == 'after' ) {
				?>
				<div class="row">
					<div class="col-sm-12">
					<?php include locate_template( 'tpls/portfolio-single-like-share.php' ); ?>
					</div>
				</div>
				<?php
			}
			?>

			<?php include locate_template( 'tpls/portfolio-single-prevnext.php' ); ?>
    	</div>
	</div>

</div>