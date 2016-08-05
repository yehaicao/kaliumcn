<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

// Constants
define( 'THEMEDIR', 		get_template_directory() . '/' );
define( 'THEMEURL', 		get_template_directory_uri() . '/' );
define( 'THEMEASSETS',		THEMEURL . 'assets/' );
define( 'THEMEVERSION',		'1.9' );
define( 'TS',				microtime( true ) );

// Initial Actions
add_action( 'after_setup_theme', 		'laborator_after_setup_theme' );

add_action( 'init', 					'laborator_init' );
add_action( 'widgets_init', 			'laborator_widgets_init' );

add_action( 'wp_head', 					'laborator_favicon' );
add_action( 'wp_head', 					'laborator_wp_head', 100 );

add_action( 'wp_enqueue_scripts', 		'laborator_wp_enqueue_scripts' );
add_action( 'wp_print_scripts', 		'laborator_wp_print_scripts' );

add_action( 'admin_menu', 				'laborator_menu_page' );
add_action( 'admin_menu', 				'laborator_menu_page_plugin_updates' );
add_action( 'admin_menu', 				'laborator_menu_page_documentation', 100 );
add_action( 'admin_menu', 				'laborator_menu_page_browse_themes', 110 );

add_action( 'admin_print_styles', 		'laborator_admin_print_styles' );
add_action( 'admin_enqueue_scripts',	'laborator_admin_enqueue_scripts' );

add_action( 'wp_footer', 				'laborator_wp_footer' );
add_action( 'wp_footer', 				'kalium_parse_bottom_styles' ); 

// Theme Demo
if ( file_exists( THEMEDIR . 'theme-demo/theme-demo.php' ) && is_readable( THEMEDIR . 'theme-demo/theme-demo.php' ) && version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	require 'theme-demo/theme-demo.php';
}

// Core Files
require 'inc/lib/smof/smof.php';

require locate_template( 'inc/laborator_functions.php' );
require locate_template( 'inc/laborator_actions.php' );
require locate_template( 'inc/laborator_filters.php' );
require locate_template( 'inc/laborator_portfolio.php' );
require locate_template( 'inc/laborator_woocommerce.php' );
require locate_template( 'inc/laborator_vc.php' );
require locate_template( 'inc/laborator_thumbnails.php' );

require locate_template( 'inc/acf-fields.php' );

// Library
require 'inc/lib/BFI_Thumb.php';
require 'inc/lib/acf-revslider-field.php';
require 'inc/lib/class-tgm-plugin-activation.php';
require 'inc/lib/laborator/laborator_custom_css.php';
require 'inc/lib/laborator/laborator-acf-grouped-metaboxes/laborator-acf-grouped-metaboxes.php';

if ( is_admin() ) {
	require 'inc/lib/laborator/laborator-demo-content-importer/laborator_demo_content_importer.php';
}

// Sidekick Configuration
define( 'SK_PRODUCT_ID', 454 );
define( 'SK_ENVATO_PARTNER', 'iZmD68ShqUyvu7HzjPWPTzxGSJeNLVxGnRXM/0Pqxv4=' );
define( 'SK_ENVATO_SECRET', 'RqjBt/YyaTOjDq+lKLWhL10sFCMCJciT9SPUKLBBmso=' );