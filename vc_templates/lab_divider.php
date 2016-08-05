<?php
/**
 *	Divider
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

$css_classes = array(
	$this->getExtraClass( $el_class ),
	vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

if( $type == 'text' ) {
	
	if( $text_color ) {
		
		if( $text_style == 4 && empty( $text_color_font ) ) {
			$text_color_font = '#ffffff';
		}
		
		$text_color_font = empty( $text_color_font ) ? $text_color : $text_color_font;
		
		generate_custom_style( "#{$unique_id} .lab-divider-content span", "color: {$text_color_font};" );
		
		switch( $text_style ) {
				
			case '1':
				generate_custom_style( "#{$unique_id} div span", "border-color: {$text_color};" );
				break;
			
			case '2':
			case '3':
				generate_custom_style( "#{$unique_id} .divider-line span ", "border-top-color: {$text_color};" );
				break;
				
			case '4':
				generate_custom_style( "#{$unique_id} div span", "border-color: {$text_color};" );
				generate_custom_style( "#{$unique_id} .lab-divider-content span", "background-color: {$text_color};" );
				break;
				
			case '5':
				generate_custom_style( "#{$unique_id} .divider-line span", "background-color: {$text_color};" );
				break;
				
		}
	}
	
	?>	
	<div id="<?php echo $unique_id; ?>" class="lab-divider divider-type-<?php echo $text_style; echo $css_class ? " {$css_class}" : ''; ?>">
		<div class="divider-line divider-left">
			<span></span>
			<span class="double-line"></span>
		</div>
	
		<div class="lab-divider-content">
			<span><?php echo do_shortcode( $title ); ?></span>
		</div>
		
		<div class="divider-line divider-right">
			<span></span>
			<span class="double-line"></span>
		</div>
	</div>
	<?php
} else {
	$width = floatval( $plain_width );
	
	$plain_style_attr = '';
	
	if( $width && is_numeric( $width ) && $width > 0 && $width <= 100 ) {
		$plain_style_attr .= 'display: block; width: ' . $width . ( strstr( $plain_width, 'px' ) ? 'px' : '%' ) . ';';
	}
	
	if( $plain_color ) {
		$plain_style_attr .= ' border-bottom-color: ' . $plain_color;
	}
	
	generate_custom_style( "#{$unique_id} .lab-divider-content", $plain_style_attr );
	
	?>
	<div id="<?php echo $unique_id; ?>" class="lab-divider divider-plain type-<?php echo $plain_style; echo $css_class ? " {$css_class}" : ''; ?>">
		<div class="lab-divider-content"></div>
	</div>
	<?php
}


return;
?>
<div class="lab-divider divider-type-1">
	<div class="divider-line divider-left">
		<span></span>
		
	</div>

	<div class="lab-divider-content">
		<span>Check out our latest Projects</span>
	</div> <!-- lab-divider-content -->
	
	<div class="divider-line divider-right">
		<span></span>
	</div>
</div> <!-- divider-type-1 :END-->

<div class="lab-divider divider-type-2">
	<div class="divider-line divider-left">
		<span></span>
	</div>

	<div class="lab-divider-content">
		<span>Thick</span>
	</div> <!-- lab-divider-content -->
	
	<div class="divider-line divider-right">
		<span></span>
	</div>
</div> <!-- divider-type-2 :END-->

<div class="lab-divider divider-type-3">
	<div class="divider-line divider-left">
		<span></span>
		<span class="double-line"></span>
	</div>

	<div class="lab-divider-content">
		<span>Check out our latest Projects</span>
	</div> <!-- lab-divider-content -->
	
	<div class="divider-line divider-right">
		<span></span>
		<span class="double-line"></span>
	</div>
</div> <!-- divider-type-3 :END-->


<div class="lab-divider divider-type-4">
	<div class="divider-line divider-left">
		<span></span>
	</div>

	<div class="lab-divider-content">
		<span>Divider</span>
	</div> <!-- lab-divider-content -->
	
	<div class="divider-line divider-right">
		<span></span>
	</div>
</div> <!-- divider-type-4 :END-->

<div class="lab-divider divider-type-5">
	<div class="divider-line divider-left">
		<span></span>
	</div>

	<div class="lab-divider-content">
		<span>Dotted</span>
	</div> <!-- lab-divider-content -->
	
	<div class="divider-line divider-right">
		<span></span>
	</div>
</div> <!-- divider-type-5 :END-->

<div class="lab-divider divider-type-6">
	<div class="divider-line divider-left">
		<span></span>
	</div>

	<div class="lab-divider-content">
		<span>Striped</span>
	</div> <!-- lab-divider-content -->
	
	<div class="divider-line divider-right">
		<span></span>
	</div>
</div> <!-- divider-type-6 :END-->

<div class="lab-divider divider-plain type-1">
	<div class="lab-divider-content"></div> <!-- lab-divider-content -->
</div> <!-- divider-plain-type-1 :END-->

<div class="lab-divider divider-plain type-2">
	<div class="lab-divider-content"></div> <!-- lab-divider-content -->
</div> <!-- divider-plain-type-2 :END-->

<div class="lab-divider divider-plain type-3">
	<div class="lab-divider-content"></div> <!-- lab-divider-content -->
</div> <!-- divider-plain-type-3 :END-->
