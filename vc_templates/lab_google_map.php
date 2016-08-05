<?php
/**
 *	Google Map
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

# Atts
$defaults = array(
	'height'       => '',
	'zoom'         => '',
	'map_options'  => '',
	'map_panby'	   => '',
	'map_controls' => '',
	'map_style'    => '',
	'map_type'     => '',
	'map_tilt'     => '',
	'map_heading'  => '',
	'el_class'     => '',
	'css'          => ''
);

if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$map_id         = uniqid( 'el_' );

$map_options    = explode( ',', $map_options );
$map_controls   = explode( ',', $map_controls );
$map_style_safe = vc_value_from_safe( $map_style );

// New bug fix
$map_style_b64dec = rawurldecode( base64_decode( strip_tags( $map_style ) ) );
	
if ( strpos( $map_style, '#E-' ) == 0 ) {
	$map_style = vc_value_from_safe( $map_style );
	
	if ( $map_style_b64dec && strpos( $map_style_b64dec, '[' ) >= 0 && substr( trim( $map_style_b64dec ), 0, 1 ) == '[' ) {
		$map_style = $map_style_b64dec;
	}
	
} elseif ( base64_decode( $map_style ) ) {
	$map_style = $map_style_b64dec;
}


$height = is_numeric( $height ) && $height > 10 ? $height : 400;

$map_locations = array();

if ( preg_match_all( '/' . get_shortcode_regex() . '/', $content, $map_locations_match ) ) {
	
	foreach ( $map_locations_match[0] as $location ) {
		$location = preg_replace( "/^\[[^\s]+/i", "", substr( $location, 0, -1 ) );
		$location_details = $this->prepareAtts( shortcode_parse_atts( $location ) );
		
		$location_details = shortcode_atts( array(
			'marker_image'       => '',
			'retina_marker'		 => '',
			'latitude'           => '0',
			'longitude'          => '0',
			'marker_title'       => '',
			'marker_description' => '',
		), $location_details );
		
		if ( $location_details['marker_image'] ) {
			$pin = wp_get_attachment_image_src( $location_details['marker_image'], 'original' );
			
			if ( $pin ) {
				$location_details['marker_image'] = $pin[0];
				$location_details['marker_image_size'] = array( $pin[1], $pin[2] );
			}
		} else {
			$location_details['marker_image'] = THEMEASSETS . 'images/icons/map/cd-icon-location.svg';
		}
		
		# When Description is "Safe Textarea"
		$marker_description_safe = vc_value_from_safe( $location_details['marker_description'] );
		
		if( strpos( $location_details['marker_description'], '#E-' ) == 0 ) {
			$location_details['marker_description'] = $marker_description_safe;
		}
		
		$location_details['marker_description'] = laborator_esc_script( wpautop( $location_details['marker_description'] ) );
		
		$map_locations[] = $location_details;
	}
}

# Pan By
$map_panby = explode( ',', $map_panby );

if ( ! is_numeric( $map_panby[0] ) ) {
	$map_panby[0] = 0;
}

if ( ! isset($map_panby[1] ) ) {
	$map_panby[1] = 0;
}

if ( ! in_array('pan-by', $map_options ) ) {
	$map_panby = array( 0, 0 );
}

# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "lab-google-map cd-google-map {$css_class}";

if ( in_array( 'fullwidth', $map_options ) ) {
	$css_class .= ' full-width-container';
}

# Enqueue Google Maps
if ( is_singular() ) {
	wp_enqueue_script( array( 'google-maps', 'lab-vc-google-maps' ) );
}

?>
<style> #<?php echo esc_attr( $map_id ); ?> { height: <?php echo absint( $height ); ?>px; } </style>

<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class( $css, ' ' ); ?>">
	<div id="<?php echo esc_attr( $map_id ); ?>"></div>
    <div class="cd-zoom cd-zoom-in hidden"></div>
    <div class="cd-zoom cd-zoom-out hidden"></div>
</div>

<script type="text/javascript">
var labVcMaps = labVcMaps || [];
labVcMaps.push({
	id: '<?php echo esc_js( $map_id ); ?>',
	
	locations: <?php echo json_encode($map_locations); ?>,
	
	zoom: <?php echo is_numeric($zoom) && $zoom > 0 ? intval($zoom) : 0; ?>,
	scrollwheel: <?php echo in_array('scroll-zoom', $map_options) ? 'true' : 'false'; ?>,
	dropPins: <?php echo in_array('drop-pins', $map_options) ? 'true' : 'false'; ?>,
	panBy: <?php echo json_encode($map_panby); ?>,
	tilt: <?php echo intval(in_array($map_type, array('satellite', 'hybrid')) ? $map_tilt : 0); ?>,
	heading: <?php echo intval($map_heading); ?>,
	
	mapType: '<?php echo esc_js($map_type) ?>',
	
	panControl: <?php echo in_array( 'panControl', $map_controls ) ? 'true' : 'false'; ?>,
	zoomControl: <?php echo in_array( 'zoomControl', $map_controls ) ? 'true' : 'false'; ?>,
	mapTypeControl: <?php echo in_array( 'mapTypeControl', $map_controls ) ? 'true' : 'false'; ?>,
	scaleControl: <?php echo in_array( 'scaleControl', $map_controls ) ? 'true' : 'false'; ?>,
	streetViewControl: <?php echo in_array(' streetViewControl', $map_controls ) ? 'true' : 'false'; ?>,
	overviewMapControl: <?php echo in_array( 'overviewMapControl', $map_controls ) ? 'true' : 'false'; ?>,
	plusMinusZoom: <?php echo in_array( 'plusMinusZoom', $map_controls ) ? 'true' : 'false'; ?>,
	
	
	styles: <?php echo in_array( 'map-style', $map_options ) && $map_style ? $map_style : "''"; ?>
});
</script>