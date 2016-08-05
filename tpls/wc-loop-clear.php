<?php
/**
 *	Kalium WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

if( $woocommerce_loop['loop'] > 0 )
{
	if( $woocommerce_loop['loop'] % $shop_columns == 0 )
	{
		?>
		<div class="clear visible-md visible-lg"></div>
		<?php
	}
		
	if( $shop_columns != 2 && $woocommerce_loop['loop'] % 2 == 0 )
	{
		?>
		<div class="clear visible-xs"></div>
		<?php
	}
}