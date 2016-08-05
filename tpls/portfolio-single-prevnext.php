<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( ! get_data( 'portfolio_prev_next' ) ) {
	return;
}

$portfolio_archive_link     = $portfolio_args['url'];
$archive_links_to_category  = $portfolio_args['archive_url_to_category'];

// Archive link to category page
if ( $archive_links_to_category ) {
	$portfolio_item_terms = get_the_terms( $post_id, 'portfolio_category' );
	
	if ( ! empty( $portfolio_item_terms ) ) {
		$portfolio_archive_link = get_term_link( reset( $portfolio_item_terms ) );
	}
}

$prev_next_type             = $portfolio_args['single']['prev_next']['type'];
$navigation_position        = $portfolio_args['single']['prev_next']['position'];

$include_categories         = $portfolio_args['single']['prev_next']['include_categories'];
$prev_next_show_titles      = $portfolio_args['single']['prev_next']['show_titles'];

$custom_prevnext_links      = get_field( 'custom_prevnext_links' );

if ( $custom_prevnext_links ) {
	$prev = apply_filters( 'kalium_portfolio_custom_prev_link', get_field( 'prevnext_previous_id' ) );
	$next = apply_filters( 'kalium_portfolio_custom_prev_link', get_field( 'prevnext_next_id' ) );
} else {
	$prev = apply_filters( 'kalium_portfolio_prev_link', get_next_post( $include_categories, '', 'portfolio_category' ), $include_categories );
	$next = apply_filters( 'kalium_portfolio_next_link', get_previous_post( $include_categories, '', 'portfolio_category' ), $include_categories );
}

$prev_title = get_the_title( $prev );
$next_title = get_the_title( $next );

// In Full background portfolio set prev/next navigation to fixed-right side mode
if ( ! empty( $portfolio_type_full_bg ) ) {
	$prev_next_type = 'fixed';
	$navigation_position = 'right-side';
}

// Next and Previous Title
$previous_title = __( 'Previous project', 'kalium' );
$next_title     = __( 'Next project', 'kalium' );

if ( $prev_next_show_titles ) {
	$previous_title    = '';
	$next_title        = '';

	if ( $prev ) {
		$previous_title = get_the_title( $prev );
	}
	
	if ( $next ) {
		$next_title = get_the_title( $next );
	}
}

if ( 'simple' == $prev_next_type ) :

	$prev_link = get_permalink( $prev );
	$next_link = get_permalink( $next );

	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="portfolio-big-navigation portfolio-navigation-type-simple wow fadeIn<?php echo $image_spacing == 'nospacing' ? ' with-margin' : ''; ?>">
				<div class="row">
		    		<div class="col-xs-5">
			    		<?php if ( $previous_title ) : ?>
			    		<a class="previous pc-only<?php echo ! $prev ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $prev_link ); ?>"><?php echo apply_filters( 'portfolio_previous_item_title', $previous_title ); ?></a>
			    		<a class="previous mobile-only<?php echo ! $prev ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $prev_link ); ?>"><i class="fa flaticon-arrow427"></i></a>
			    		<?php endif; ?>
		    		</div>

		    		<div class="col-xs-2 text-on-center">
			    		<a class="back-to-portfolio" href="<?php echo esc_url( $portfolio_archive_link ); ?>">
							<i class="fa flaticon-four60"></i>
						</a>
		    		</div>

		    		<div class="col-xs-5">
			    		<?php if ( $next_title ) : ?>
			    		<a class="next pc-only<?php echo ! $next ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $next_link ); ?>"><?php echo apply_filters( 'portfolio_next_item_title', $next_title ); ?></a>
			    		<a class="next mobile-only<?php echo ! $next ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $next_link ); ?>"><i class="fa flaticon-arrow427"></i></a>
			    		<?php endif; ?>
		    		</div>
				</div>
			</div>
		</div>
	</div>
	<?php

endif;


if ( 'fixed' == $prev_next_type ) :

	?>
	<div class="portfolio-navigation portfolio-navigation-type-fixed <?php echo esc_attr( $navigation_position ); ?> wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.9s">

		<a class="previous<?php echo ! $prev ? ' not-clickable' : ''; ?>" href="<?php echo get_permalink( $prev ); ?>" title="<?php echo esc_attr( $prev_title ); ?>">
			<i class="fa flaticon-arrow413"></i>
		</a>

		<a class="back-to-portfolio" href="<?php echo esc_url( $portfolio_archive_link ); ?>" title="<?php _e( 'Go to portfolio archive', 'kalium' ); ?>">
			<i class="fa flaticon-four60"></i>
		</a>

		<a class="next<?php echo ! $next ? ' not-clickable' : ''; ?>" href="<?php echo get_permalink( $next ); ?>" title="<?php echo esc_attr( $next_title ); ?>">
			<i class="fa flaticon-arrow413"></i>
		</a>
	</div>
	<?php

endif;
