<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

?>
<?php if ( $blog_show_header && ( $blog_title || $blog_description ) ) : ?>
<div class="section-title">

	<?php if ( $blog_title ) : ?>
	<h1><?php echo laborator_esc_script( $blog_title ); ?></h1>
	<?php endif; ?>

	<?php if($blog_description): ?>
	<p><?php echo nl2br( laborator_esc_script( $blog_description ) ); ?></p>
	<?php endif; ?>
</div>
<?php endif; ?>