<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$footer_fixed           = get_data( 'footer_fixed' );
$footer_fullwidth       = get_data( 'footer_fullwidth' );

$footer_style           = get_data( 'footer_style' );

$footer_text            = get_data( 'footer_text' );
$footer_text_right      = get_data( 'footer_text_right' );

$footer_bottom_style    = get_data('footer_bottom_style');

$footer_classes = array( 'main-footer', 'footer-bottom-' . esc_attr( $footer_bottom_style ) );

if ( $footer_fixed ) {
	$footer_classes[] = 'fixed-footer';
	
	if ( $footer_fixed == 'fixed-fade' ) {
		$footer_classes[] = 'fixed-footer-fade';
	}
	else if ( $footer_fixed == 'fixed-slide' ) {
		$footer_classes[] = 'fixed-footer-slide';
	}
}

if ( $footer_style ) {
	$footer_classes[] = 'main-footer-' . esc_attr( $footer_style );
}

// Full-width footer
if ( $footer_fullwidth ) {
	$footer_classes[] = 'footer-fullwidth';
}
?>
<footer id="footer" class="<?php echo implode( ' ', $footer_classes ); ?>">
	<div class="container">
		<?php get_template_part( 'tpls/footer-widgets' ); ?>
	</div>

	<?php if ( get_data( 'footer_bottom_visible' ) ) : ?>
	<div class="footer-bottom">
		<div class="container">

			<div class="footer-bottom-content">
					<?php if ( $footer_text_right ) : ?>
					<div class="footer-content-right">
						<?php echo do_shortcode( laborator_esc_script( $footer_text_right ) ); ?>
					</div>
					<?php endif; ?>

					<?php if ( $footer_text ) : ?>
					<div class="footer-content-left">
						<div class="copyrights">
							<p><?php echo do_shortcode( laborator_esc_script( $footer_text ) ); ?> Kalium中文版由<a href="http://www.wordpressleaf.com/" rel="nofollow" target="_blank"> WordPress Leaf</a>荣誉出品</p>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
	<?php endif; ?>

</footer>