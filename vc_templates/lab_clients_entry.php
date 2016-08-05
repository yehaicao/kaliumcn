<?php
/**
 *	Logo Entry
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $client_logo_index, $columns_count, $reveal_effect, $hover_style, $img_size;

# Atts
$defaults = array(
	'image'        => '',
	'name'         => '',
	'sub_title'    => '',
	'description'  => '',
	'link'         => '',
	'el_class'     => '',
);

#$atts = vc_shortcode_attribute_parse( $defaults, $atts );
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

# Element Class
$class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts);

# If no image return empty
if( ! $image){
	return;
}

$image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size, 'class' => 'img-responsive' ) );

$link = vc_build_link($link);

# Item Class
$item_class = array('client-logos-col');

if($link['url'])
{
	$item_class[] = 'with-link';
}

switch($columns_count)
{
	case 2:
		$item_class[] = 'col-sm-6';
		$wow_max_delay = 0.5;
		break;
		
	case 3:
		$item_class[] = 'col-sm-4';
		$wow_max_delay = 1.2;
		break;
		
	case 6:
		$item_class[] = 'col-md-2 col-sm-4';
		$wow_max_delay = 1.8;
		break;
		
	case 12:
		$item_class[] = 'col-md-1 col-sm-3';
		$wow_max_delay = 2;
		break;
		
	// 4 Columns
	default:
		$item_class[] = 'col-sm-3';
		$wow_max_delay = 1.5;
		$columns_count = 4;
}

# Wow Effect
$wow_effect = $reveal_effect;
$wow_one_by_one = false;

if(preg_match("/-one/", $wow_effect))
{
	$wow_one_by_one = true;
	$wow_effect = str_replace('-one', '', $wow_effect);
}

$wow_delay = min($client_logo_index * 0.1, $wow_max_delay);

?>
<div class="<?php echo implode(' ', $item_class); ?>">
	
	<div class="c-logo<?php echo $wow_effect ? esc_attr(" wow {$wow_effect}") : ""; ?>" data-wow-duration="1s"<?php if($wow_one_by_one): ?> data-wow-delay="<?php echo esc_attr($wow_delay); ?>s"<?php endif; ?>>
		<?php if($link['url']): ?>
			<a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo $image['thumbnail']; ?></a>
		<?php else: ?>
			<?php echo $image['thumbnail']; ?>
		<?php endif; ?>
		
		<?php if($hover_style != 'none'): ?>
		<div class="hover-state<?php echo $hover_style == 'distanced' ? ' hover-style-one' : ''; ?>">
			<div class="hover-state-content">
				<h3>
					<?php if($link['url']): ?>
						<a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($title); ?></a>
					<?php else: ?>
						<?php echo esc_attr($title); ?>
					<?php endif; ?>
				</h3>
				
				<?php if($description): ?>
				<div class="description">
					<?php echo laborator_esc_script(wpautop($description)); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
	
</div>
<?php

if(($client_logo_index+1) % $columns_count == 0){
	echo '<div class="clearfix"></div>';
}

# End of File
$client_logo_index++;