<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $wp_query, $force_show_heading_title, $force_heading_title, $force_heading_description;

if ( ! is_singular() && ! $force_show_heading_title ) {
	return;
}

$the_title = '';
$the_description = '';

$qo = get_queried_object();

if ( $qo instanceof WP_Post && $qo->ID > 0 ) {
	$show_heading_title = get_field( 'heading_title', $qo->ID );
	
	if ( $show_heading_title ) {
		$title_type         = get_field( 'page_heading_title_type', $qo->ID );
		$description_type   = get_field( 'page_heading_description_type', $qo->ID );
		
		$custom_title       = get_field( 'page_heading_custom_title', $qo->ID );
		$custom_description = get_field( 'page_heading_custom_description', $qo->ID );
		
		$the_title = $custom_title;
		$the_description = $custom_description;
		
		if ( $title_type == 'post_title' ) {
			$the_title = get_the_title( $qo );
		}
		
		if ( $description_type == 'post_content' ) {
			$the_description = $qo->post_content;
		}
	}
}
else if ( $force_show_heading_title ) {
	$show_heading_title    = true;
	$the_title             = $force_heading_title;
	$the_description       = $force_heading_description;
}

if ( isset( $show_heading_title ) && $show_heading_title && ( $the_title || $the_description ) ) {
	?>
	<div class="container page-heading-title">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-title">
					<h2><?php echo laborator_esc_script( $the_title ); ?></h2>
					<?php
					if ( $the_description ) {
						echo apply_filters( 'the_content', laborator_esc_script( $the_description ) );
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
		
	define( 'HEADING_TITLE_DISPLAYED', true );
}