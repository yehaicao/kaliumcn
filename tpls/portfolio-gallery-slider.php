<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );

$images_reveal_effect       = get_field( 'images_reveal_effect' );
$carousel_start_position    = get_field( 'carousel_start_position' );
$infinite_loop_slides       = get_field( 'infinite_loop_slides' );
$auto_play                  = get_field( 'auto_play' );

if ( ! is_numeric( $auto_play ) ) {
	$auto_play = 0;
}

$gallery_container = array();
$gallery_container[] = 'gallery-slider';
$gallery_container[] = 'do-lazy-load';

switch ( $images_reveal_effect ) {
	case 'slidenfade':
		$gallery_container[] = 'wow fadeInLab';
		break;

	case 'fade':
		$gallery_container[] = 'wow fadeIn';
		break;
}

if ( $image_spacing == 'nospacing' ) {
	$gallery_container[] = 'no-spacing';
}

$gallery_container[] = 'gallery';

// Dynamic width and height for carousel images
$max_image_height = get_field( 'maximum_image_height' );
$is_max_height = is_numeric( $max_image_height ) && $max_image_height >= -1 && $max_image_height != 0;

if ( $is_max_height ) {
	$gallery_container[] = 'variable-width';
}

if ( $carousel_start_position != 'left' ) {
	$gallery_container[] = 'carousel-center-mode';
}
?>
<div class="full-width-container">
	<div class="<?php echo implode( ' ', $gallery_container ); ?>" data-infinite="<?php echo $infinite_loop_slides ? 1 : 0; ?>" data-autoplay="<?php echo esc_attr( $auto_play * 1000 ); ?>">
	<?php
	foreach ( $gallery_items as $i => $gallery_item ) :

		$main_thumbnail_size = apply_filters( 'kalium_single_portfolio_gallery_image', 'portfolio-single-img-1' );

		// Image Type
		if ( $gallery_item['acf_fc_layout'] == 'image' ) :

			$img             = $gallery_item['image'];
			$caption         = nl2br( make_clickable( $img['caption'] ) );

			$link_url        = $gallery_item['link_url'];
			$link_target     = $gallery_item['link_target'];
			
			$image_size      = wp_get_attachment_image_src(  $img['id'], $main_thumbnail_size );
			$image_width     = $image_size[1];
			$image_height    = $image_size[2];
			
			?>
			<div class="gallery-item photo gallery-item-<?php echo $i; ?>">
				<?php
				
				if ( $is_max_height ) {
					$r = ( $max_image_height == -1 ? $image_height : $max_image_height ) / $image_height;
					$width_based_on_height = $image_width * $r;
					
					if ( $image_spacing != 'nospacing' ) {
						$d = 30 / $image_width;
						$width_based_on_height += $d * $image_width;
					}
					
					generate_custom_style( ".gallery-item-{$i}", "max-width: {$width_based_on_height}px;" );
					
				}
				?>
				<?php if ( $link_url ) : ?>
				<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo $link_target ? '_blank' : '_self'; ?>">
				<?php endif; ?>

					<?php laborator_show_image_placeholder( $img['id'], $main_thumbnail_size, when_match( $i > 0, 'hidden', '', false ), false, '' ); ?>

				<?php if ( $link_url ) : ?>
				</a>
				<?php endif; ?>

				<?php if ( $caption ) : ?>
				<div class="caption">
					<?php echo laborator_esc_script( $caption ); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php

		endif;
		// End: Image Type

	endforeach;
	?>
	</div>
</div>