<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

# start: modified by Arlind
$shop_catalog_layout = get_data( 'shop_catalog_layout' );

$shop_pagination_type = get_data( 'shop_pagination_type' );
$shop_endless_pagination_style = get_data( 'shop_endless_pagination_style' );
$shop_pagination_position = get_data( 'shop_pagination_position' );
# end: modified by Arlind
?>
<nav class="woocommerce-pagination pagination-container <?php 
	echo "align-" . esc_attr( $shop_pagination_position ); 
	echo $shop_catalog_layout != 'default' || ( $shop_catalog_layout == 'default' && get_data( 'shop_loop_masonry' ) ) ? ' no-top-margin' : ''; 
?>">
	<?php
		// start: modified by Arlind
		if ( in_array( $shop_pagination_type, array( 'endless', 'endless-reveal' ) ) ) :
			
			global $wp_query;
			
			$current_page = max( 1, intval( get_query_var( 'paged' ) ) );
			$max_num_pages = $wp_query->max_num_pages;
			
			$endless_opts = array(
				'per_page'	   => get_query_var( 'posts_per_page' ),
				'current'      => $current_page + 1,
				'maxpages'     => $max_num_pages,

				'reveal'       => $shop_pagination_type == 'endless-reveal',

				'action'       => 'laborator_get_paged_shop_products',
				'callback'     => 'laboratorGetProducts',

				'type'  	   => $shop_endless_pagination_style,

				'finished'	   => __( 'No more products to show', 'kalium' ),

				'opts'         => array(
					'q' => $wp_query->query
				)
			);

			laborator_show_endless_pagination( $endless_opts );
		
		else :
		// end: modified by Arlind
		
			echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
				'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
				'format'       => '',
				'add_args'     => '',
				'current'      => max( 1, get_query_var( 'paged' ) ),
				'total'        => $wp_query->max_num_pages,
				'prev_text'    => '&larr;',
				'next_text'    => '&rarr;',
				'type'         => 'list',
				'end_size'     => 3,
				'mid_size'     => 3
			) ) );
		
		endif;
	?>
</nav>
