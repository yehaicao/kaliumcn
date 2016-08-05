<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<?php # start: modified by Arlind ?>
<?php

$shop_sale_ribbon_show      = get_data( 'shop_sale_ribbon_show' );
$shop_oos_ribbon_show       = get_data( 'shop_oos_ribbon_show' );
$shop_featured_ribbon_show  = get_data( 'shop_featured_ribbon_show' );

?>
<?php if ( $shop_oos_ribbon_show && $product->is_in_stock() == false && ! ( $product->is_type( 'variable' ) && $product->get_total_stock() > 0 ) ) : ?>

	<div class="onsale oos"><?php _e( 'Out of stock', 'kalium' ); ?></div>
	
	<?php return; ?>

<?php endif; ?>

<?php if ( $shop_featured_ribbon_show && $product->is_featured() ) : ?>

	<div class="onsale featured"><?php _e( 'Featured', 'kalium' ); ?></div>
	
	<?php return; ?>
	
<?php endif; ?>
<?php # end: modified by Arlind ?>

<?php if ( $shop_sale_ribbon_show && $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>

<?php endif; ?>
