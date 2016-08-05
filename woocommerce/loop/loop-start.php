<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

/* Note: This file has been altered by Laborator */
 
global $product_categories;

$shop_loop_masonry = get_data( 'shop_loop_masonry' );
?>

<?php if ( $shop_loop_masonry ) : ?>
<div class="shop-loading-products">
	<?php _e( 'Loading products...', 'kalium' ); ?>
</div>
<?php endif; ?>

<div class="products shop-categories row <?php echo $shop_loop_masonry ? ' products-masonry hidden' : ''; ?>"<?php if ( $shop_loop_masonry ) : ?> data-layout-mode="<?php echo get_data( 'shop_loop_masonry_layout_mode' ); ?>"<?php endif; ?>>