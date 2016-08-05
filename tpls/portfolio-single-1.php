<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

include locate_template( 'tpls/portfolio-single-item-details.php' );

wp_enqueue_script( 'nivo-lightbox' );
wp_enqueue_style( 'nivo-lightbox-default' );

// 1/3 column width
$column_widths = array(
	'description-width'    => 'col-md-4',
	'gallery-width'        => 'col-md-7'
);

// 1/2 column width
if ( $description_width == '1-2' ) {
	$column_widths['description-width']    = 'col-md-5';
	$column_widths['gallery-width']        = 'col-md-6';
}

// 1/4 column width
if ( $description_width == '1-4' ) {
	$column_widths['description-width']    = 'col-md-3';
	$column_widths['gallery-width']        = 'col-md-8';
}

?>
<div class="container">

	<div class="page-container<?php 
		echo $gallery_type == 'fullbg' ? ' no-bottom-margin' : '';
	?>">

		<div class="single-portfolio-holder portfolio-type-1 alt-one clearfix<?php
			echo $gallery_type == 'fullbg' ? ' gallery-type-fullbg' : '';
			echo $gallery_type == 'fullbg' && ! $gallery_stick_to_top ? ' gallery-no-top-stick' : '';
			echo $sticky_description ? ' is-sticky' : '';
			echo $description_alignment == 'left' ? ' description-set-left' : '';
		?>">

			<div class="details <?php
				echo esc_attr( $column_widths['description-width'] );
				echo $description_alignment == 'right' ? ' col-md-offset-1 pull-right-md' : '';
			?>">
				<div class="row">
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

					<?php include locate_template( 'tpls/portfolio-checklists.php' ); ?>

					<?php include locate_template( 'tpls/portfolio-launch-project.php' ); ?>

					<?php include locate_template( 'tpls/portfolio-single-like-share.php' ); ?>

				</div>
			</div>

			<div class="<?php echo esc_attr( $column_widths['gallery-width'] ); echo $description_alignment == 'left' ? ' col-md-offset-1' : ''; ?> gallery-column-env">

				<?php include locate_template( 'tpls/portfolio-gallery.php' ); ?>

			</div>

			<?php include locate_template( 'tpls/portfolio-single-prevnext.php' ); ?>
		</div>
	</div>

</div>