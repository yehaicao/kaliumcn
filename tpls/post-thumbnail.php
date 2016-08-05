<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $_wp_additional_image_sizes;

if ( isset( $_wp_additional_image_sizes[ $thumb_size ] ) ) {
	$default_image_size = $_wp_additional_image_sizes[ $thumb_size ];
} elseif ( $post_thumbnail_id ) {
	$img = wp_get_attachment_image_src( $post_thumbnail_id, apply_filters( 'kalium_blog_thumbnail_size', $thumb_size ) );
	$default_image_size = array( $img[1], $img[2] );
}

?>
<div class="thumb">
	
	<?php 
	// Parse Format Content (if allowed and available)
	include locate_template( 'tpls/post-format-content.php' );
	
	// Otherwise Show Thumbnail
	if ( $blog_post_format_parsed == false ) :
	
		include locate_template( 'tpls/post-thumbnail-simple.php' );
	
	endif;
	?>
	
</div>

<?php 
if ( $post_icon && is_single() == false ) : 
?>
<div class="post-type<?php when_match( 'blog-rounded' == $blog_template, 'center' ); ?>">
	<i class="<?php echo esc_attr( "icon {$post_icon}" ); ?>"></i>
</div>
<?php 
endif;