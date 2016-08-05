<?php
/**
 *	Team Member
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $team_member_index, $columns_count, $reveal_effect, $hover_style, $img_size;

// Atts
$defaults = array(
	'image'        => '',
	'name'         => '',
	'sub_title'    => '',
	'description'  => '',
	'link'         => '',
	'el_class'     => '',
);

//$atts = vc_shortcode_attribute_parse( $defaults, $atts );
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

if ( strpos( $description, '#E-' ) !== false ) {
	$description = vc_value_from_safe( $description );
	$description = nl2br( $description );
}

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

// If no image return empty
if( ! $image){
	return;
}

$thumb_size = $img_size;

$link = vc_build_link( $link );

// Wow Effect
$wow_effect = $reveal_effect;
$wow_one_by_one = false;

if ( preg_match( '/-one/', $wow_effect ) ) {
	$wow_one_by_one = true;
	$wow_effect = str_replace('-one', '', $wow_effect);
}

// Item Class
$item_class = array();

switch($columns_count)
{
	case 1:
		$item_class[] = 'col-sm-12';
		$wow_max_delay = 0.2;
		break;

	case 2:
		$item_class[] = 'col-sm-6';
		$wow_max_delay = 0.5;
		break;

	case 3:
		$item_class[] = 'col-md-4 col-sm-6';
		$wow_max_delay = 1.2;
		break;

	case 4:
		$item_class[] = 'col-md-3 col-sm-6';
		$wow_max_delay = 1.5;
		break;
}

$wow_delay = min( $team_member_index * 0.1, $wow_max_delay );

?>
<div class="<?php echo implode( ' ', $item_class ); ?>">

	<div class="member do-lazy-load-on-shown<?php echo esc_attr( $css_class ); when_match( $wow_effect, "wow {$wow_effect}" ); ?>" data-wow-duration="1s"<?php if ( $wow_one_by_one ) : ?> data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s"<?php endif; ?>>
		<div class="thumb">
			<?php if($hover_style != 'none'): ?>
			<div class="hover-state padding<?php when_match( $hover_style == 'distanced', 'hover-style-one' ); ?>">
				<?php if($description): ?>
				<div class="social">
					<?php echo $description; # escaped by ACF plugin ?>
				</div>
				<?php endif; ?>

				<div class="member-details">
					<h2>
						<?php if ( $link['url'] ) : ?>
							<a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>" title="<?php echo esc_attr($link['title']); ?>"><?php echo esc_html($name); ?></a>
						<?php else : ?>
							<?php echo esc_html($name); ?>
						<?php endif; ?>
					</h2>
					<?php if ( $sub_title ) : ?>
					<p class="job-title"><?php echo esc_html( $sub_title ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( $link['url'] ) : ?>
				<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>">
					<?php echo laborator_show_image_placeholder( $image, $thumb_size ); ?>
				</a>
			<?php else : ?>
				<?php echo laborator_show_image_placeholder( $image, $thumb_size ); ?>
			<?php endif; ?>
		</div>
	</div>

</div>
<?php


# End of File
$team_member_index++;