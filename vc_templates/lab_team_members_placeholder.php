<?php
/**
 *	Member Placeholder
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $team_member_index, $columns_count, $reveal_effect, $hover_style, $img_size;

# Atts
$defaults = array(
	'image_title'  => '',
	'title'        => '',
	'sub_title'    => '',
	'link'         => '',
	'el_class'     => '',
);

#$atts = vc_shortcode_attribute_parse( $defaults, $atts );
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$link = vc_build_link( $link );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );


// Wow Effect
$wow_effect = $reveal_effect;
$wow_one_by_one = false;

if ( preg_match( '/-one/', $wow_effect ) ) {
	$wow_one_by_one = true;
	$wow_effect = str_replace( '-one', '', $wow_effect );
}


// Item Class
$item_class = array();

switch( $columns_count ) {
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
	<div class="new-member-join<?php echo $wow_effect ? esc_attr( " wow {$wow_effect}" ) : ""; ?>" data-wow-duration="1s"<?php if ( $wow_one_by_one ) : ?> data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s"<?php endif; ?>>
		<div class="thumb">
			<div class="hover-state padding">
				<div class="join-us">
					<img class="missing-pic" src="<?php echo THEMEASSETS; ?>images/icons/missing-pic.png" alt="<?php echo esc_attr( $sub_title ); ?>">
					<?php if ( $image_title ) : ?>
					<p class="your-image"><?php echo esc_html( $image_title ); ?></p>
					<?php endif; ?>

					<div class="details">
						<h2><?php echo esc_html( $title ); ?></h2>

						<?php if ( $sub_title ) : ?>
						<p class="text">
							<?php if ( $link['url'] ) : ?>
							<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>">
								<?php echo esc_html( $sub_title ); ?>
							</a>
							<?php else: ?>
								<?php echo laborator_strip_script( $sub_title, '<a>' ); ?>
							<?php endif; ?>
						</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="member-empty-spacing"></div>
		</div>
	</div>
</div>
<?php

// End of File
$team_member_index++;