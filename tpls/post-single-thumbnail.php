<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


# Show Simple Thumbnail or Gallery
if ( ! get_data( 'blog_single_thumbnails' ) ) {
	return;
}

# Enqueue Nivo
wp_enqueue_script( 'nivo-lightbox' );
wp_enqueue_style( 'nivo-lightbox-default' );

?>
<div class="blog-head-holder nivo<?php when_match( $blog_post_list_lazy_load, 'do-lazy-load-on-shown' ); ?>">
	<?php include locate_template( 'tpls/post-thumbnail.php' ); ?>
</div>