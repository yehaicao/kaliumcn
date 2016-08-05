<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$form = '<div class="widget_search wp-widget">
			<form role="search" method="get" class="search-form search-bar" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'kalium' ) . '</span>
					<input type="search" class="form-control search-field" placeholder="' . __( 'Search site...', 'kalium' ) . '" value="' . get_search_query() . '" name="s" id="s" title="' . esc_attr_x( 'Search for:', 'label', 'kalium' ) . '" />
				</label>
				<input type="submit" class="search-submit go-button" id="searchsubmit" value="'. __( 'Go', 'kalium' ) .'" />
			</form>
		</div>';

echo $form;