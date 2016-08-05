<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */
 
global $post;

the_post();

get_header();

$is_vc_container = preg_match( "/\[vc_row.*?\]/i", $post->post_content );

if ( ! empty( $post->post_password ) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) {
	$is_vc_container = false;
}

// Page Title (Show or Hide)
$show_title = $is_vc_container == false && is_singular();

if ( function_exists( 'is_woocommerce' ) ) {
	if ( is_account_page() || is_checkout() ) {
		$show_title = false;
	}
}

?>
<div class="<?php echo $is_vc_container ? 'vc-container' : 'container default-margin'; ?>">
	
	<?php if ( ! defined( 'HEADING_TITLE_DISPLAYED' ) && apply_filters( 'kalium_page_title', $show_title ) ) : ?>
	<h1 class="wp-page-title"><?php the_title(); ?></h1>
	<?php endif; ?>
	
	<?php the_content(); ?>
</div>
<?php

get_footer();