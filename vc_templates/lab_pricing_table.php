<?php
/**
 *	Pricing Table Shortcode
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$unique_id = 'divider-' . mt_rand(1000, 10000);

if( function_exists( 'uniqid' ) ) {
	$unique_id .= uniqid();
}

$plan_features = array_filter( explode( PHP_EOL, $plan_features ) );

$purchase_link = vc_build_link( $purchase_link );

# Custom Class
$css_classes = array(
	$this->getExtraClass( $el_class ),
	'pricing-table',
	vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

/*
header_background_color
header_text_color

title_background_color
title_text_color

purchase_background_color
purchase_text_color
*/

if( $header_background_color ) {
	$header_text_color = empty( $header_text_color ) ? '#ffffff' : $header_text_color;
	
	generate_custom_style( "#{$unique_id} .plan .plan-head", "background-color: {$header_background_color};" );
	generate_custom_style( "#{$unique_id} .plan .plan-head *", "color: {$header_text_color};" );
}

if( $title_background_color ) {
	$title_text_color = empty( $title_text_color ) ? '#ffffff' : $title_text_color;
	
	generate_custom_style( "#{$unique_id} .plan .plan-name", "background-color: {$title_background_color};" );
	generate_custom_style( "#{$unique_id} .plan .plan-name", "color: {$title_text_color};" );
}

if( $purchase_background_color ) {
	$purchase_text_color = empty( $purchase_text_color ) ? '#ffffff' : $purchase_text_color;
	
	generate_custom_style( "#{$unique_id} .plan .plan-action .btn", "background-color: {$purchase_background_color} !important; color: {$purchase_text_color} !important;" );
}
?>
<div id="<?php echo $unique_id; ?>" class="<?php echo $css_class; ?>">
	
	<ul class="plan">
		<li class="plan-head">
			<p class="price"><?php echo $plan_price; ?></p>
			<?php 
			if( $plan_description):
				echo wpautop( do_shortcode( $plan_description ) );
			endif; 
			?>
		</li>
		
		<?php if( $title ): ?>
		<li class="plan-name"><?php echo $title; ?></li>
		<?php endif; ?>
		
		<?php
		foreach( $plan_features as $feature ):
			
			$feature = preg_replace( '/\*(.*?)\*/', '<strong>$1</strong>', $feature );
			?>
			<li class="plan-row">
				<?php echo do_shortcode( $feature ); ?>
			</li>
			<?php
			
		endforeach;
		?>
		
		<?php if( $purchase_link['title'] ): ?>
		<li class="plan-action">
			<a href="<?php echo esc_url($purchase_link['url']); ?>" target="<?php echo esc_attr($purchase_link['target']); ?>" class="btn btn-primary">
				<?php echo esc_html($purchase_link['title']); ?>
			</a>
		</li>
		<?php endif; ?>
	</ul>
	
</div> <!-- pricing-table -->