<?php
/**
 *	Masonry Portfolio Items
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

// Atts
if( function_exists( 'vc_map_get_attributes' ) ) {
	$masonry_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

$masonry_items = array();
$masonry_items_ids = array();

if ( preg_match_all( '/' . get_shortcode_regex() . '/', $content, $portfolio_items ) ) {
	
	foreach ( $portfolio_items[0] as $portfolio_item ) {
		$portfolio_item = preg_replace( '/^\[[^\s]+/i', '', substr( $portfolio_item, 0, -1 ) );
		$portfolio_item = $this->prepareAtts( shortcode_parse_atts( $portfolio_item ) );
		
		$id = $portfolio_item['portfolio_id'];
		
		if ( ! isset( $portfolio_item['box_size'] ) ) {	
			$portfolio_item['box_size'] = '8x3';
		}
		
		// Add Masonry Item to Array
		$masonry_items_ids[]  = $id;
		$masonry_items[ $id ] = $portfolio_item;
	}
}

// Use Portfolio Items shortcode to parse Masonry Items
include locate_template( 'vc_templates/lab_portfolio_items.php' );
