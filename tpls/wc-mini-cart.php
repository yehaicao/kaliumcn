<?php
/**
 *	Kalium WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

$is_empty = WC()->cart->cart_contents_count == 0;

if( get_data( 'shop_cart_icon_menu_ajax' ) && defined( 'DOING_AJAX' ) == false ) {
	
	?>
	<div class="empty-loading-cart-contents">
		<?php _e( 'Loading cart contents...', 'kalium' ); ?>
	</div>
	<?php
		
	return;
}

?>	
<div class="cart-items">
	
	<?php if( $is_empty ): ?>
	<div class="empty-loading-cart-contents">
		<?php echo sprintf( __( 'Your cart is empty! <a href="%s">Go shopping &raquo;</a>', 'kalium' ), get_permalink( woocommerce_get_page_id( 'shop' ) ) ); ?>
	</div>
	<?php endif; ?>

	<?php
	
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		
		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			
			$price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );;
			
			?>
			<div class="cart-item">
				<div class="product-image">
				<?php
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( ! $_product->is_visible() )
						echo $thumbnail;
					else
						printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
				?>
				</div>
				<div class="product-details">
					
					<?php
						
						if ( ! $_product->is_visible() )
							echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
						else
							echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<h3><a href="%s">%s</a></h3>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );
					?>
					
					<span class="mc-quantity">
						<?php echo sprintf( __( 'Quantity: %s &times; <strong>%s</strong>', 'kalium' ) , $cart_item['quantity'], $price ); ?>
					</span>
				</div>
				<div class="product-subtotal">
					<?php
						echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
					?>
				</div>
			</div>
			<?php
		}
	
	}
	?>
	
</div>

<div class="cart-action-buttons">
	
	<?php if( ! $is_empty): ?>
	<div class="mc-buttons-container">
		<div class="go-to-cart">
			<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="btn btn-block"><?php _e( 'View Cart', 'kalium' ); ?></a>
		</div>
		
		<div class="go-to-checkout">
			<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="btn btn-block btn-primary"><?php _e( 'Checkout', 'kalium' ); ?></a>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="cart-subtotal">
		<?php _e( 'Subtotal', 'kalium' ); ?>: <strong><?php wc_cart_totals_subtotal_html(); ?></strong>
	</div>
	
</div>