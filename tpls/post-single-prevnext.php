<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( ! get_data( 'blog_post_prev_next' ) ) {
	return;
}

$include_categories = apply_filters( 'kalium_blog_postnav_include_categories', false );

$prev = get_next_post( $include_categories );
$next = get_previous_post( $include_categories );

?>
<div class="row">
	<div class="col-sm-12">
		<div class="post-controls">

			<?php if ( $prev ) : ?>
			<a href="<?php echo get_permalink( $prev ); ?>" class="prev-post">
				<span class="prev arrow">
					<i class="flaticon-arrow427"></i>
				</span>
				<span class="post-title">
					<em><?php _e( 'Newer Post', 'kalium' ); ?></em>
					<strong><?php echo get_the_title( $prev ); ?></strong>
				</span>
			</a>
			<?php endif; ?>

			<?php if ( $next ) : ?>
			<a href="<?php echo get_permalink( $next ); ?>" class="next-post">
				<span class="next arrow">
					<i class="flaticon-arrow413"></i>
				</span>
				<span class="post-title">
					<em><?php _e( 'Older Post', 'kalium' ); ?></em>
					<strong><?php echo get_the_title( $next ); ?></strong>
				</span>
			</a>
			<?php endif; ?>
		</div>
	</div>
</div>