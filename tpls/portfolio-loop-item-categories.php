<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

// What to show
$portfolio_loop_subtitles = $portfolio_args['subtitles'];

// Hide option is selected
if ( $portfolio_loop_subtitles == 'hide' ) {
	return;
}

// Show Subtitle
if ( 'subtitle' == $portfolio_loop_subtitles && $portfolio_item_subtitle ) {
	echo '<p class="sub-title">' . do_shortcode( $portfolio_item_subtitle ) . '</p>';	
}
// Categories
elseif ( in_array( $portfolio_loop_subtitles, array( 'categories', 'categories-parent' ) ) && ! empty( $portfolio_item_terms ) ) {
	$j = 0;
	
	echo '<p class="terms">';
	
	foreach ( $portfolio_item_terms as $term ) :
	
		// Parent Categories Check
		if ( $portfolio_loop_subtitles == 'categories-parent' && $term->parent != 0 ) {
			continue;
		}
	
		// Term Separator
		echo $j > 0 ? ', ' : '';
	
		?>
		<a href="<?php echo esc_url( kalium_portfolio_get_category_link( $term ) ); ?>" data-term="<?php echo esc_attr( $term->slug ); ?>">
			<?php echo esc_html( $term->name ); ?>
		</a>
		<?php
	
		$j++;
	
	endforeach;
	
	echo '</p>';
}