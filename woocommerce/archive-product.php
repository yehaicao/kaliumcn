<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php # start: modified by Arlind ?>
		
		<?php
		$show_shop_header = apply_filters( 'woocommerce_show_page_title', true ) || apply_filters( 'lab_wc_show_product_sorting', true );
		?>
		
		<?php if($show_shop_header): ?>
		<div class="woocommerce-header">
			
			
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<div class="title-holder">
				
				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

				<?php do_action( 'woocommerce_archive_description' ); ?>
				
				<?php woocommerce_result_count(); ?>
				
			</div>
			<?php endif; ?>
			
			<?php if( apply_filters( 'lab_wc_show_product_sorting', true ) ): ?>
			<div class="woocommerce-ordering-container<?php echo apply_filters( 'woocommerce_show_page_title', true ) == false ? ' wco-left-align' : ''; ?>">
				
				<?php woocommerce_catalog_ordering(); ?>
				
			</div>
			<?php endif; ?>
			
		</div>
		<?php endif; ?>
		
		<?php woocommerce_product_subcategories( array( 'before' => '<div class="shop-categories row">', 'after' => '</div>' ) ); ?>
		
		<?php # end: modified by Arlind ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>
				
				<?php
				# start: modified by Arlind
				global $woocommerce_loop;
				$woocommerce_loop['loop'] = 0;
				# end: modified by Arlind 
				?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php #elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
		<?php elseif ( ! defined( 'SHOP_HAS_CATEGORIES' ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
