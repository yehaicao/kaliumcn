<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

	// Kalium End of Wrapper
	do_action( 'kalium_wrapper_end' );
?>

	</div><?php // .wrapper end ?>
	
	<?php
		
	if ( apply_filters( 'kalium_show_footer', true ) ) { 
		get_template_part( 'tpls/footer-main' ); 
	}
	?>

	<?php wp_footer(); ?>
	
	<!-- <?php echo 'ET: ', microtime( true ) - TS, 's ', THEMEVERSION, ( is_child_theme() ? 'ch' : '' ); ?> -->
</body>
</html>