<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

get_header();

?>
<div class="container">
	<div class="page-container">
		<div class="error-holder">
			<div class="box">
				<p class="error-type">
					<span class="flashing-num-1">4</span>
					<span class="flashing-num-1 del-1">0</span>
					<span class="flashing-num-1 del-2">4</span>
				</p>
			</div>
			<p class="error-text"><?php _e('Not found!', 'kalium'); ?></p>
			<p><?php printf( __( 'We’re sorry, the page you have looked for does not exist in our database! <br /> Perhaps you would like to go to our <a href="%s">home page</a>?', 'kalium' ), home_url() ); ?></p>
		</div>
	</div>

</div>
<?php

get_footer();