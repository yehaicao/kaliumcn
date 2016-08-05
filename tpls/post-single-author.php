<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $post, $wp_roles;

if ( ! $blog_author_info ) {
	return;
}

$user_id        = $post->post_author;
$author         = get_userdata( $user_id );
$description    = $author->description;
$role           = reset( $author->roles );
$role_title     = $wp_roles->roles[ $role ]['name'];

$link 		  = get_author_posts_url( $user_id );
$link_blank	  = false;

if ( $author->user_url ) {
	$link = $author->user_url;
	$link_blank = true;
}

if ( apply_filters( 'kalium_blog_post_author_link', $link, $user_id ) ) {
	$link_a_open  = '<a href="' . $link . '" class="author-link"' . ( $link_blank ? ' target="_blank"' : '' ) . '>';
	$link_a_close = '</a>';
}
?>
<div class="blog-author-holder<?php 
	when_match( empty( $description ), 'has-no-description' ); 
?>">
	
	<div class="author-avatar">
		<?php echo ( $link ? $link_a_open : '' ) . get_avatar( $user_id, 96 * 2 ) . ( $link ? $link_a_close : '' ); ?>
	</div>
	
	<div class="author-details">
		<?php
		if ( $link ) {
			echo $link_a_open;
		}
		?>
		<span class="author-name">
			<?php the_author(); ?>
			<em><?php echo $role_title; ?></em>
		</span>
		<?php
	
		if ( $link ) {
			echo $link_a_close;
		}
		?>
		
		<?php if ( $blog_author_info_placement == 'bottom' && $description ) : ?>
		<div class="author-description">
		<?php echo do_shortcode( $description ); ?>
		</div>
		<?php endif; ?>
	</div>
</div>