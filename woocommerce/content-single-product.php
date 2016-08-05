<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// start: modified by Arlind
$image_columns = apply_filters( 'lab_wc_single_product_image_column_size', 'small' );
$image_columns_class = $product_summary_columns = '';

switch( $image_columns ) {
	case 'xlarge':
		$product_summary_columns = 'col-md-4 col-sm-4';
		$image_columns_class = 'col-md-8 col-sm-8';
		break;
		
	case 'large':
		$product_summary_columns = 'col-md-6 col-sm-6';
		$image_columns_class = 'col-md-6 col-sm-6';
		break;
		
	case 'medium':
		$product_summary_columns = 'col-md-7 col-sm-6';
		$image_columns_class = 'col-md-5 col-sm-6';
		break;
		
	case 'small':
		$product_summary_columns = 'col-md-8 col-sm-6';
		$image_columns_class = 'col-md-4 col-sm-6';
		break;
}

if ( get_data( 'shop_single_image_alignment' ) == 'right' ) {
	$image_columns_class .= ' pull-right-md imgs-container-right';
}
// end: modified by Arlind

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class( 'single-product' ); ?>>
	<div class="row">
	
		<?php // start: modified by Arlind ?>
		<div class="<?php echo esc_attr( $image_columns_class ); ?>">
		<?php
			/**
			 * woocommerce_before_single_product_summary hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
		</div>
	
		<div class="<?php echo esc_attr( $product_summary_columns ); ?>">
			<div class="summary entry-summary item-info">
		
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
		
			</div><!-- .summary -->
		</div>
		<?php // end: modified by Arlind ?>
	
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	
		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	
	</div><!-- #product-<?php the_ID(); ?> -->
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
