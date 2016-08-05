<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $portfolio_args;

$portfolio_category_filter              = $portfolio_args['category_filter'];
$portfolio_filter_enable_subcategories  = $portfolio_args['category_filter_subs'];

$show_title_description                 = $portfolio_args['show_title'];
$portfolio_title                        = $portfolio_args['title'];
$portfolio_description                  = $portfolio_args['description'];

if ( ! $show_title_description && ! ( $portfolio_category_filter && $portfolio_args['available_terms'] ) ) {
	return;
}

if ( preg_match( "/\[vc_row.*?\]/", $portfolio_description ) && ! defined( 'HEADING_TITLE_DISPLAYED' ) ) {
	?>
	<div class="portfolio-title-vc-content">
		<?php echo do_shortcode( $portfolio_description ); ?>
	</div>
	<?php
		
	$portfolio_description = '';
}
?>
<div class="portfolio-title-holder">
	<?php if ( $show_title_description ) : ?>
	<div class="pt-column">
		<div class="section-title no-bottom-margin">
			<?php if ( $portfolio_title ) : $headline_tag = $portfolio_args['vc_mode'] ? 'h2' : 'h1'; ?>
			<<?php echo $headline_tag; ?>><?php echo esc_html( $portfolio_title ); ?></<?php echo $headline_tag; ?>>
			<?php endif; ?>
			<?php echo laborator_esc_script( wpautop( $portfolio_description ) ); ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( $portfolio_category_filter && ! empty( $portfolio_args['available_terms'] ) ) :  ?>
	<?php
	// When Category Term is Active and is not parent
	$has_subcategory_active = false;
	
	if ( $portfolio_args['category'] && $portfolio_args['category_filter_subs'] ) {
		foreach ( $portfolio_args['available_terms'] as $term ) {
			if ( $term->parent != 0 ) {
				if ( $portfolio_args['category'] == $term->slug ) {
					$has_subcategory_active = kalium_portfolio_set_active_term_parents( $term, $portfolio_args['available_terms'] );
				}
			}
		}
	}
	?>
	<div class="pt-column">
		<div class="product-filter<?php when_match( $has_subcategory_active, 'subcategory-active' ); ?>">
			<ul class="portfolio-root-categories">
				<li class="portfolio-category-all<?php when_match( $portfolio_args['category'] == '', 'active' ); ?>">
					<a href="<?php echo esc_url( $portfolio_args['url'] ); ?>" data-term="*"><?php _e( 'All', 'kalium' ); ?></a>
				</li>
				<?php
				foreach ( $portfolio_args['available_terms'] as $term ) :
				
					if ( $term->parent != 0 ) {
						continue;
					}
					
					$term_link = kalium_portfolio_get_category_link( $term );
					$is_active = $portfolio_args['category'] == $term->slug;
					
					?>
					<li class="portfolio-category-item portfolio-category-<?php echo $term->slug; when_match( $is_active, 'active' ); ?>">
						<a href="<?php echo esc_url( $term_link ); ?>" data-term="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a>
					</li>
					<?php
						
				endforeach;
				?>
			</ul>
			
			<?php
			if ( $portfolio_filter_enable_subcategories ) {
				
				foreach ( $portfolio_args['available_terms'] as $term ) {
					kalium_portfolio_get_terms_by_parent_id( $term, array( 
						'available_terms'  => $portfolio_args['available_terms'], 
						'current_category' => $portfolio_args['category'],
					) );
				}
			}
			?>
		</div>
	</div>
	<?php endif; ?>
</div>