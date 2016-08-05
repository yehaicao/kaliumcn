<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

the_post();

$item_type = get_field( 'item_type' );

// Custom Item Link Redirect
if ( get_field( 'item_linking' ) == 'external' ) {
	
	$launch_link_href = get_field( 'launch_link_href' );
	
	if ( $launch_link_href ) {
		
		if ( $launch_link_href != '#' ) {
			wp_redirect( $launch_link_href );
		} else { 
			// Disabled item links, will redirect to closest next/previous post
			$include_categories  = get_data( 'portfolio_prev_next_category' ) ? true : false;
			
			$prev = get_next_post( $include_categories, '', 'portfolio_category' );
			$next = get_previous_post( $include_categories, '', 'portfolio_category' );
			
			if( ! empty( $next ) ) {
				wp_redirect( get_permalink( $next ) );
			} else if( ! empty( $prev ) ) {
				wp_redirect( get_permalink( $prev ) );
			}
		}
		
		die();
	}
}

// Disable Lightbox
if ( get_data( 'portfolio_disable_lightbox' ) ) {
	add_filter( 'body_class', create_function( '$classes', '$classes[] = "lightbox-disabled"; return $classes;' ) );
}

get_header();

if ( ! post_password_required() ) {
	
	switch ( $item_type ) {
		case 'type-1':
			get_template_part( 'tpls/portfolio-single-1' );
			break;
	
		case 'type-2':
			get_template_part( 'tpls/portfolio-single-2' );
			break;
	
		case 'type-3':
			get_template_part( 'tpls/portfolio-single-3' );
			break;
	
		case 'type-4':
			get_template_part( 'tpls/portfolio-single-4' );
			break;
	
		case 'type-5':
			get_template_part( 'tpls/portfolio-single-5' );
			break;
	
		case 'type-6':
			get_template_part( 'tpls/portfolio-single-6' );
			break;
	
		case 'type-7':
			get_template_part( 'tpls/portfolio-single-7' );
			break;
	}
} else {
	?>
	<div class="container default-margin password-protected-portfolio-item">
		<div class="row">
			<div class="col-sm-12"><?php echo the_content(); ?></div>
		</div>
	</div>
	<?php
}

get_footer();