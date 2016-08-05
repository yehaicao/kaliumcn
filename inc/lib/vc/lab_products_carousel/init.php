<?php
/**
 *	Products Carousel Shortcode for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */

// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'carousel.png';

// Shortcode Options
vc_map( array(
	"name"		=> "Products Carousel",
	"description" => 'Display shop products with Touch Carousel.',
	"base"		=> "lab_products_carousel",
	"class"		=> "vc_lab_products_carousel",
	'icon'      => $lab_vc_element_icon,
	"controls"	=> "full",
	"category"  => 'Laborator',
	"params"	=> array(

		array(
			"type" => "loop",
			"heading" => "Products Query",
			"param_name" => "products_query",
			'settings' => array(
				'size' => array('hidden' => false, 'value' => 12),
				'order_by' => array('value' => 'date'),
				'post_type' => array('value' => 'product', 'hidden' => false)
			),
			"description" => "Create WordPress loop, to populate products from your site."
		),

		array(
			"type" => "dropdown",
			"heading" => "Filter Products by Type",
			"param_name" => "product_types_to_show",
			"value" => array(
				"Show all types of products from the above query"  => '',
				"Show only featured products from the above query."  => 'only_featured',
				"Show only products on sale from the above query."  => 'only_on_sale',
			),
			"description" => "Based on layout columns you use, select number of columns to wrap the product.",
		),

		array(
			"type" => "dropdown",
			"heading" => "Columns count",
			"param_name" => "columns",
			"std" => 4,
			"value" => array(
				"6 Columns"  => 6,
				"5 Columns"  => 5,
				"4 Columns"  => 4,
				"3 Columns"  => 3,
				"2 Columns"  => 2,
				"1 Column"   => 1,
			),
			"description" => "Based on layout columns you use, select number of columns to wrap the product."
		),

		array(
			"type" => "textfield",
			"heading" => "Auto Rotate",
			"param_name" => "auto_rotate",
			"value" => "5",
			"description" => "You can set automatic rotation of carousel, unit is seconds. Enter 0 to disable."
		),

		array(
			"type" => "textfield",
			"heading" => "Extra class name",
			"param_name" => "el_class",
			"value" => "",
			"description" => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		),

		array(
			"type" => "css_editor",
			"heading" => 'Css',
			"param_name" => "css",
			"group" => 'Design options'
		)
	)
) );

class WPBakeryShortCode_lab_products_carousel extends  WPBakeryShortCode {
	
	public function content( $atts, $content = null ) {
		if ( ! is_shop_supported() ) {
			return '';
		}
		
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		
		kalium_vc_loop_param_set_default_value( $atts['products_query'], 'post_type', 'product' );
		
		extract( shortcode_atts( array(
			'products_query'         => '',
			'product_types_to_show'  => '',
			'columns'                => '',
			'auto_rotate'            => '',
			'el_class'               => '',
			'css'                    => '',
		), $atts ) );
		

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'lab-vc-products-carousel woocommerce shop wpb_content_element products-hidden ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		if ( $columns == 1 ) {
			$css_class .= ' single-column';
		}

		list( $args, $products ) = vc_build_loop_query( $products_query );

		// Show Featured Products Only
		if ( $product_types_to_show == 'only_featured' ) {
			$args['meta_key'] = '_featured';
			$args['meta_value'] = 'yes';

			$products = new WP_Query( $args );
		}
		else
		// Show Products on Sale Only
		if ( $product_types_to_show == 'only_on_sale' ) {
			$args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key'           => '_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				),
				array(
					'key'           => '_min_variation_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				)
			);

			$products = new WP_Query( $args );
		}

		$rand_id = "el_" . time() . mt_rand( 10000,99999 );
		$columns = absint( $columns );


		wp_enqueue_script( 'slick' );
		wp_enqueue_style( 'slick' );

		ob_start();
		
		add_filter( 'get_data_shop_loop_masonry', '__return_false', 100 );

		?>
		<div class="<?php echo $css_class; ?>" id="<?php echo $rand_id; ?>">

			<div class="shop-loading-products">
				<?php _e( 'Loading products...', 'kalium' ); ?>
			</div>

			<?php
			
			add_filter( 'lab_wc_product_grid_columns', '__return_false' );
			
			if ( $products->have_posts() ) : ?>
	
				<?php woocommerce_product_loop_start(); ?>
	
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
	
						<?php wc_get_template_part( 'content', 'product' ); ?>
	
					<?php endwhile; // end of the loop. ?>
	
				<?php woocommerce_product_loop_end(); ?>
	
			<?php endif;
				
			remove_filter( 'lab_wc_product_grid_columns', '__return_false' );
	
			wp_reset_postdata();
			?>
			
		</div>
		
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				
				var $productsCarouselContainer = $( '#<?php echo $rand_id; ?>' ),
					$productsCarousel = $productsCarouselContainer.find( '.products' );
				
				$productsCarouselContainer.removeClass( 'products-hidden' );

				$productsCarousel.slick( {
					infinite: false,
					slidesToShow: <?php echo $columns; ?>,
					slidesToScroll: 1,					
					prevArrow: '<span class="nextprev-arrow ss-prev"><i class="flaticon-arrow427"></i></span>',
					nextArrow: '<span class="nextprev-arrow ss-next"><i class="flaticon-arrow413"></i></span>',
					adaptiveHeight: true,				
					<?php if( $auto_rotate > 0 ): ?>
					autoplay: true,
					autoplaySpeed: <?php echo $auto_rotate * 1000; ?>,
					<?php endif; ?>
					responsive: [
						{
							breakpoint: 1119,
							settings: {
								slidesToShow: <?php echo min( $columns, 3 ); ?>
							}
						},
						{
							breakpoint: 768,
							settings: {
								slidesToShow: 2
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: 1
							}
						}
					]
				} );
			} );
		</script>
		<?php
		
		remove_filter( 'get_data_shop_loop_masonry', '__return_false', 100 );

		$output = ob_get_contents();
		
		ob_end_clean();

		return $output;
	}
}