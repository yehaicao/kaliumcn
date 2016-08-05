<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $blog_template, $sidebar_position, $thumb_size, $blog_post_formats, $blog_post_list_lazy_load, $blog_columns, $blog_animated_eye_hover;

// Get post info variables
include locate_template( 'tpls/post-details.php' );

$post_classes = array( 'box-holder' );

// Post Classes
if ( $blog_post_formats ) {
	$post_classes[] = 'supports-formats';
}

if ( $sidebar_position == 'left' ) {
	$post_classes[] = 'sidebar-is-left';
}

if ( ! $show_thumbnails ) {
	$post_classes[] = 'thumbnails-not-supported';
}

if ( $blog_post_list_lazy_load ) {
	$post_classes[] = 'do-lazy-load-on-shown';
}

switch ( $blog_columns ) {
	case '_1':
		$thumb_size = 'blog-thumb-3';
		$isotope_width = 'bw12';
		break;
		
	case '_2':
		$isotope_width = 'bw6';
		break;

	case '_4':
		$isotope_width = 'bw3';
		break;

	default:
		$isotope_width = 'bw4';
}

if ( isset( $blog_animated_eye_hover ) && $blog_animated_eye_hover ) {
	$post_classes[] = 'animated-eye-on-hover';
}

?>
<div class="isotope-item portfolio-item <?php echo esc_attr( $isotope_width ); ?> with-padding">
	<div <?php post_class( $post_classes ); ?>>

		<div class="post-format">
			<?php if ( $show_thumbnails ) : ?>
				<?php include locate_template( 'tpls/post-thumbnail.php' ); ?>
			<?php endif; ?>
		</div>

		<div class="post-info">
			<h2>
	    		<a href="<?php echo esc_url( $permalink ); ?>"><?php echo $post_title; ?></a>
	    	</h2>
	    	
			<?php echo wpautop( $post_excerpt ); ?>

			<?php include locate_template( 'tpls/post-category-date.php' ); ?>
		</div>
	</div>
</div>