<?php
/**
 *	Animated Text - AutoType
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


# Atts
$defaults = array(
	'typed_text'               => '',
	
	'typed_show_options'       => '',
	'typed_options_cursorchar' => '',
	'typed_options_loopcount'  => '',
	
	'typed_options_typespeed'  => '',
	'typed_options_backspeed'  => '',
	'typed_options_startdelay' => '',
	'typed_options_backdelay'  => '',
	
	'el_class'                 => '',
	'css'                      => ''
);

#$atts = vc_shortcode_attribute_parse($defaults, $atts);
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "auto-type-element {$css_class}";

# Process Text
$script = '';

# Typed Text
$typed_text_safe = vc_value_from_safe($typed_text);

if( strpos( $typed_text, '#E-' ) == 0 ) {
	$typed_text = $typed_text_safe;
}


if(preg_match_all("/(\*.*?\*)/is", $typed_text, $typed_entries))
{
	foreach($typed_entries[0] as $typed_entry)
	{
		$typed_options = array(
			'cursorChar' => $typed_options_cursorchar,
			'showCursor' => $typed_options_cursorchar ? true : false,
			
			'loop'       => $typed_options_loopcount == -1 || $typed_options_loopcount > 0 ? true : false,
			'loopCount'  => $typed_options_loopcount > 0 ? ($typed_options_loopcount-1) : 0,
			
			'typeSpeed'  => absint($typed_options_typespeed),
			'backSpeed'  => absint($typed_options_backspeed),
			
			'startDelay' => absint($typed_options_startdelay),
			'backDelay'  => absint($typed_options_backdelay),
		);
		
		$typed_processed = lab_text_autotype_process_entry($typed_entry, $typed_options);
		$typed_text = str_replace($typed_entry, $typed_processed['el'], $typed_text);
		$typed_text = preg_replace("/^\s*<br\s*(\/)?>/i", '', $typed_text);
		
		$script .= PHP_EOL . $typed_processed['script'];
	}
}

?>
<div class="<?php echo esc_attr($css_class) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<?php echo $typed_text; # escape processed via lab_text_autotype_process_entry ?>
</div>

<?php if($script): ?>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		<?php echo $script; ?>
	});
</script>
<?php endif; ?>