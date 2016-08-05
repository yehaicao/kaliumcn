<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

/* Note: This file has been altered by Laborator */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<?php // Modified by Arlind (added class "product-img") ?>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>" class="product-img">
		<?php echo $product->get_image(); ?>
	</a>
	
	<?php # start: modified by Arlind ?>
	<div class="product-details">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" class="product-title"><?php echo $product->get_title(); ?></a>
		
		<div class="product-meta">
			<?php echo $product->get_price_html(); ?>
			<?php if ( ! empty( $show_rating ) ) : $rating = $product->get_average_rating(); ?>
				<span class="product-rating">
					<em>–</em>
					<?php echo number_format($rating, 1); ?>
					<i class="icon icon-basic-star"></i>
				</span>
			<?php endif; ?>
		</div>
	</div>
	<?php # end: modified by Arlind ?>
</li>
