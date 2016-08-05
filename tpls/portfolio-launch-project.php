<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


$x_launch_link_href = explode( ',', $launch_link_href );
$x_launch_link_title = explode( ',', $launch_link_title );

$is_multiple = count( $x_launch_link_href ) > 0 && count( $x_launch_link_title ) == count( $x_launch_link_href );

if ( $launch_link_href ) : ?>
<div class="link">
	
	<?php if ( $is_multiple ) : ?>
		<?php foreach ( $x_launch_link_href as $i => $href ) : ?>
		<div class="project-multiple-links project-link-<?php echo $i + 1; ?>">
			<a href="<?php echo esc_url( $href ); ?>"<?php if ( $new_window ) : ?> target="_blank"<?php endif; ?>><?php echo esc_html( $x_launch_link_title[ $i ] ); ?></a>
		</div>
		<?php endforeach; ?>
	<?php else: ?>
	<a href="<?php echo esc_url( $launch_link_href ); ?>"<?php if ( $new_window ): ?> target="_blank"<?php endif; ?>><?php echo esc_html( $launch_link_title ); ?></a>
	<?php endif; ?>
	
</div>
<?php endif; ?>