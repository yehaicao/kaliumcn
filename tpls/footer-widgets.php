<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( ! get_data( 'footer_widgets' ) ) {
	return;
}

$footer_bottom_visible  = get_data( 'footer_bottom_visible' );
$footer_collapse_mobile = get_data( 'footer_collapse_mobile' );

$footer_widgets_classes = array( 'footer-widgets' );

if ( $footer_collapse_mobile ) {
	$footer_widgets_classes[] = 'footer-collapsed-mobile';
}

?>
<div class="<?php echo implode(' ', $footer_widgets_classes); ?>">

	<?php // <div class="footer-dash"></div> ?>
	
	<?php if ( $footer_collapse_mobile ) : ?>
	<a href="#" class="footer-collapse-link">
		<span>.</span>
		<span>.</span>
		<span>.</span>
	</a>
	<?php endif; ?>

	<div class="row">
		<?php dynamic_sidebar( 'footer_sidebar' ); ?>
	</div>

</div>

<hr>