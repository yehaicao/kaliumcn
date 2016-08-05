<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( ! $portfolio_args['share'] && ! $portfolio_args['likes'] ) {
	return;
}

$portfolio_like_share_layout = $portfolio_args[ 'share_layout' ];

// Like Icon Class
$like_icon_default = 'fa-heart-o';
$like_icon_liked = 'fa-heart';

switch( $portfolio_args['likes_icon'] ) {
	// Star Icon
	case 'star':
		$like_icon_default = 'fa-star-o';
		$like_icon_liked = 'fa-star';
		break;
		
	// Thumb Up Icon
	case 'thumb':
		$like_icon_default = 'fa-thumbs-o-up';
		$like_icon_liked = 'fa-thumbs-up';
		break;
}

// Default Layout
if ( $portfolio_like_share_layout == 'default' ) :

	?>
	<div class="social-links-plain">

		<?php if ( $portfolio_args['likes'] ) : $likes = get_post_likes(); ?>
		<div class="likes">
			<a href="#" class="like-btn like-icon-<?php echo esc_attr( $portfolio_args['likes_icon'] ); ?>" data-id="<?php echo get_the_id(); ?>">
				<i class="icon fa <?php echo $likes['liked'] ? $like_icon_liked : $like_icon_default; ?>"></i>
				<span class="counter like-count"><?php echo esc_html( $likes['count'] ); ?></span>
			</a>
		</div>
		<?php endif; ?>

		<?php if ( $portfolio_args['share'] ) : ?>
		<div class="share-social">
			<h4><?php _e( 'Share', 'kalium' ); ?></h4>
			<div class="social-links">
				<?php
				foreach ( $portfolio_args['share_networks']['visible'] as $network_id => $network ) :

					if ( $network_id == 'placebo' ) {
						continue;
					}

					share_story_network_link( $network_id, $post_id );

				endforeach;
				?>
			</div>
		</div>
		<?php endif; ?>

	</div>
	<?php

endif;

// Rounded Buttons
if ( $portfolio_like_share_layout == 'rounded' ) :

	?>
	<div class="social-links-rounded">

		<div class="social-links">
			<?php if ( $portfolio_args['likes'] ) : $likes = get_post_likes(); ?>
			<a href="#" class="social-share-icon like-btn like-icon-<?php echo esc_attr( $portfolio_args['likes_icon'] ); ?><?php echo $likes['liked'] ? ' is-liked' : ''; ?>" data-id="<?php the_ID(); ?>">
				<i class="icon fa <?php echo $likes['liked'] ? $like_icon_liked : $like_icon_default; ?>"></i>
				<span class="like-count"><?php echo esc_html( $likes['count'] ); ?></span>
			</a>
			<?php endif; ?>

			<?php
			if ( $portfolio_args['share'] ) :

				foreach ( $portfolio_args['share_networks']['visible'] as $network_id => $network ) :

					if ( $network_id == 'placebo' ) {
						continue;
					}

					share_story_network_link( $network_id, $post_id, 'social-share-icon', true );

				endforeach;

			endif;
			?>
		</div>

	</div>
	<?php

endif;
