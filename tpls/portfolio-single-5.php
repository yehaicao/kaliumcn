<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

include locate_template( 'tpls/portfolio-single-item-details.php' );

$sharing_allowed = $portfolio_share_item || $portfolio_likes;

$portfolio_type_full_bg = true;

$show_project_info_text = get_field( 'show_project_info_text' );
$hide_project_description = get_field( 'hide_project_description' );

add_filter( 'kalium_show_footer', '__return_false' );
generate_custom_style( '.sticky-header-spacer', 'display: none !important', '', true );
?>
<ul class="portfolio-full-bg-slider" data-autoswitch="<?php echo intval( get_field( 'auto_play' ) ); ?>">
<?php

	$gallery_items_count = 0;

	foreach ( $gallery_items as $i => $gallery_item ) :

		// Image Type
		if ( $gallery_item['acf_fc_layout'] == 'image' ) :

			$img = $gallery_item['image'];

			$image_class = array( 'image-entry' );

			$gallery_items_count++;
		?>
		<li class="image-entry" data-load="<?php echo esc_url( $img['url'] ); ?>"></li>
		<?php
		endif;
		// End: Image Type

	endforeach;

?>
</ul>

<div class="portfolio-full-bg-loader loading-spinner-1"></div>

<div class="container">

	<div class="page-container no-bottom-margin">
		
    	<div class="single-portfolio-holder portfolio-type-5">

	    	<div class="portfolio-slider-nav">
		    	<?php for ( $i = 1; $i <= $gallery_items_count; $i++ ) : ?>
		    	<a href="#" data-index="<?php echo esc_attr( $i - 1 ); ?>" class="<?php echo when_match( $i == 1, 'current' ); ?>">
			    	<span><?php echo esc_html( $i ); ?></span>
		    	</a>
		    	<?php endfor; ?>
	    	</div>
	    	
	    	<?php include locate_template( 'tpls/portfolio-single-prevnext.php' ); ?>

			<?php if ( ! $hide_project_description ) : ?>
			<div class="portfolio-description-container<?php when_match( get_field( 'item_description_visibility' ) == 'collapsed', 'is-collapsed' ); ?>">
				
				<div class="portfolio-description-showinfo">
					<h3><?php the_title(); ?></h3>
					
					<?php if ( ! empty( $show_project_info_text ) ) : ?>
						<p><?php echo $show_project_info_text; ?></p>
					<?php else: ?>
						<p><?php _e( 'Click here to show project info', 'kalium' ); ?></p>
					<?php endif; ?>

					<a href="#" class="expand-project-info">
						<?php echo laborator_get_svg( 'images/icons/arrow-upright.svg' ); ?>
					</a>
				</div>

				<div class="portfolio-description-fullinfo details">
					<div class="title section-title">
						<h1><?php the_title(); ?></h1>

						<?php if ( $sub_title ) : ?>
						<p><?php echo esc_html( $sub_title ); ?></p>
						<?php endif; ?>
					</div>

					<div class="project-description">
						<div class="post-formatting">
							<?php the_content(); ?>
						</div>
					</div>

					<?php include locate_template( 'tpls/portfolio-launch-project.php' ); ?>

					<?php if($checklists || $sharing_allowed): ?>
					<div class="row">
						<?php if($checklists): ?>
						<div class="<?php echo $sharing_allowed ? 'col-md-6' : 'col-md-12'; ?>">
							<?php include locate_template( 'tpls/portfolio-checklists.php' ); ?>
						</div>
						<?php endif; ?>

						<?php if($sharing_allowed): ?>
						<div class="<?php echo $checklists ? 'col-md-6' : 'col-md-12'; ?> portfolio-sharing-container">
							<?php include locate_template( 'tpls/portfolio-single-like-share.php' ); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>

					<a href="#" class="collapse-project-info">
						<?php echo laborator_get_svg( 'images/icons/arrow-upright.svg' ); ?>
					</a>
				</div>

			</div>
			<?php endif; ?>

	    </div>

	</div>

</div>