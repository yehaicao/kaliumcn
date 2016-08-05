<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

# start: modified by Arlind
$show_add_to_cart = get_data( 'shop_add_to_cart_listing' );

$shop_catalog_layout = get_data( 'shop_catalog_layout' );
$shop_product_category = get_data( 'shop_product_category_listing' );
?>
<div class="product-loop-add-to-cart-container">
	
	<?php if( $shop_product_category && $shop_catalog_layout == 'default' ) : ?>
	<div class="product-category<?php if( $show_add_to_cart ): ?> category-hoverable<?php endif; ?>">
		<?php echo $product->get_categories(); ?>
	</div>
	<?php endif; ?>
	
	<?php if( $show_add_to_cart ) : ?>
	<div class="add-to-cart-link">
	<?php
	# end: modified by Arlind

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" data-added_to_cart_text="' . __( 'Added to cart', 'kalium' ) . '" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? preg_replace( '/(^button|\sbutton)/', ' add_to_cart_button', $class ) : 'add_to_cart_button' ),
		esc_html( $product->add_to_cart_text() )
	),
$product );
	
	# start: modified by Arlind
	?>
	</div>
	<?php endif; ?>
	
</div>
<?php
# end: modified by Arlind
