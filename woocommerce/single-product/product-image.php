<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

# start: modified by Arlind
$shop_single_product_images_layout = get_data( 'shop_single_product_images_layout' );
# end: modified by Arlind

?>
<div class="images">

	<div class="product-images-carousel nivo<?php echo in_array( $shop_single_product_images_layout, array( 'plain', 'plain-sticky' ) ) ? ' plain' : ''; echo $shop_single_product_images_layout == 'plain-sticky' ? ' sticky' : ''; ?>">
	<?php
		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			# start: modified by Arlind
			if( $shop_single_product_images_layout == 'default' ) {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );
			} else {
				$image = get_laborator_show_image_placeholder( get_post_thumbnail_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom do-lazy-load-on-shown" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );
			}
			# end: modified by Arlind
			
			# start: modified by Arlind
			$attachment_ids = $product->get_gallery_attachment_ids();
			
			# Remove Featured Image from the list
			if( ( $key = array_search( get_post_thumbnail_id(), $attachment_ids ) ) !== false )
			{
			    unset( $attachment_ids[ $key ] );
			}
			
			foreach( $attachment_ids as $attachment_id )
			{
				$image_title 	= esc_attr( get_the_title( $attachment_id ) );
				$image_caption 	= get_post( $attachment_id )->post_excerpt;
				$image_link  	= wp_get_attachment_url( $attachment_id );
				$image       	= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );
					
					if( $shop_single_product_images_layout == 'default' ) {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="zoom hidden" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );
					} else {
						$image = get_laborator_show_image_placeholder( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
						
						# start: modified by Arlind
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="zoom ' . ( $shop_single_product_images_layout == 'default' ? 'hidden' : 'do-lazy-load-on-shown') . '" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );
						# end: modified by Arlind	
					}
			}
			# end: modified by Arlind

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>
	</div>
	
	<?php # start: modified by Arlind ?>
	<?php
	
	$shop_single_auto_rotate_image = get_data( 'shop_single_auto_rotate_image' );
	$shop_product_image_columns = apply_filters( 'lab_wc_single_product_image_column_size', 'small' );
	
	if( empty( $shop_single_auto_rotate_image ) || ! is_numeric( $shop_single_auto_rotate_image ) )
	{
		$shop_single_auto_rotate_image = 5;
	}
	
	$shop_single_auto_rotate_image = absint( $shop_single_auto_rotate_image );
	
	if( ! in_array( $shop_single_product_images_layout, array( 'plain', 'plain-sticky' ) ) ):
	?>
	<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			
			// Product Thumbnails
			var $productThumbnails = $( '.images .thumbnails' ),
				$productImagesCarousel = $( '.product-images-carousel' ),
				
				thumbnailsToShow = <?php 
				switch( $shop_product_image_columns ):
				
					case 'large':
						echo 4;
						break;
					
					default:
						echo 3;
				
				endswitch;
				?>,
				totalImages = $productImagesCarousel.find( 'a' ).length;
			
			$productThumbnails.slick({
				infinite: false,
				slidesToShow: thumbnailsToShow,
				slidesToScroll: 1,
				arrows: false
			});
			
			$productThumbnails.find( 'a' ).on( 'click', function( ev ) {
				ev.preventDefault();
				
				var index = $( this ).index();
				
				$productImagesCarousel.slick( 'slickGoTo', index  );
			} );
			
			
			// Product Image
			$productImagesCarousel.find( 'a' ).removeClass( 'hidden' );
			
			$productImagesCarousel.slick({
				infinite: true,
				prevArrow: '<span class="nextprev-arrow ss-prev"><i class="flaticon-arrow427"></i></span>',
				nextArrow: '<span class="nextprev-arrow ss-next"><i class="flaticon-arrow413"></i></span>',
				adaptiveHeight: true,
				fade: true
				
				<?php if( $shop_single_auto_rotate_image > 0 ): ?>,
				autoplay: true,
				autoplaySpeed: <?php echo $shop_single_auto_rotate_image * 1000; ?>
				<?php endif; ?>
			});
			
			$productImagesCarousel.on( 'beforeChange', function( ev, slick, currentSlide, nextSlide ) {
				
				var thumbnailsIndexSet = Math.floor( nextSlide / thumbnailsToShow ) * thumbnailsToShow;

				if( totalImages > thumbnailsIndexSet )
				{
					$productThumbnails.slick( 'slickGoTo', thumbnailsIndexSet );
				}
				
				$productThumbnails.find( 'a' ).removeClass( 'active' ).eq( nextSlide ).addClass( 'active' );
			} );
			
			// Reset the index on Found Variation with Image
			$( 'body' ).on( 'found_variation', '.variations_form', function( ev, variation ) {
				
				if( variation.image_src )
				{
					$productImagesCarousel.slick( 'slickGoTo', 0 );
				}
				
			} );
		} );
	</script>
	<?php endif; ?>
	<?php # end: modified by Arlind ?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
