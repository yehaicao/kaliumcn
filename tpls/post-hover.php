<?php
/**
 *	Kalium WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */
		
// Hover State
if($hover_state):
	?>
	<span href="<?php echo esc_url($permalink); ?>" class="hover-state<?php
		if(in_array($thumbnail_hover_effect, array('distanced', 'distanced-no-opacity'))) echo ' hover-style-one';
		if(in_array($thumbnail_hover_effect, array('full-cover-no-opacity', 'distanced-no-opacity'))) echo ' no-opacity';
	?>">
		<i class="icon<?php echo " {$hover_state}"; ?>"></i>
	</span>
	<?php
endif;