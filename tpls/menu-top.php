<?php
/**
 *	Kalium WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

$menu_id = 'main-menu';

$menu_top_menu_id					= get_data( 'menu_top_menu_id' );
$menu_top_items_per_row             = get_data( 'menu_top_items_per_row' );

$menu_top_show_widgets              = get_data( 'menu_top_show_widgets' );
$menu_top_nav_links_center			= get_data( 'menu_top_nav_links_center' );
$menu_top_widgets_per_row           = get_data( 'menu_top_widgets_per_row' );
$menu_top_widgets_container_width   = get_data( 'menu_top_widgets_container_width' );

if ( $menu_top_menu_id != '-' ) {
	if ( $menu_top_menu_id != 'default' ) {
		$menu_id = str_replace( 'menu-', '', $menu_top_menu_id );
	}
	
	$nav = kalium_get_main_menu( $menu_id );
}

$menu_container_width = 'col-sm-12';
$widgets_container_width = 'col-sm-12';

if ( $menu_top_show_widgets ) {
	switch ( $menu_top_widgets_container_width ) {
		case 'col-3':
			$menu_container_width = 'col-sm-9';
			$widgets_container_width = 'col-sm-3';
			break;
			
		case 'col-4':
			$menu_container_width = 'col-sm-8';
			$widgets_container_width = 'col-sm-4';
			break;
			
		case 'col-5':
			$menu_container_width = 'col-sm-7';
			$widgets_container_width = 'col-sm-5';
			break;
			
		case 'col-7':
			$menu_container_width = 'col-sm-5';
			$widgets_container_width = 'col-sm-7';
			break;
			
		case 'col-8':
			$menu_container_width = 'col-sm-4';
			$widgets_container_width = 'col-sm-8';
			break;
			
		default:
			$menu_container_width = 'col-sm-6';
			$widgets_container_width = 'col-sm-6';
	}
	
	if ( $menu_top_menu_id == '-' ) {
		$widgets_container_width = 'col-sm-12';
	}
}


?>
<div class="top-menu-container menu-type-<?php echo get_data( 'main_menu_type' ); ?> <?php echo get_data( 'menu_top_skin' ); ?>">
	<div class="container">
		<div class="row row-table row-table-middle">
			
			<?php if ( isset( $nav ) && $nav ) : ?>
			<div class="<?php echo esc_attr( $menu_container_width ); ?>">
				<nav class="top-menu menu-row-<?php echo esc_attr( $menu_top_items_per_row ); echo $menu_top_nav_links_center ? ' first-level-centered' : '' ?>">
					<?php echo $nav; ?>
				</nav>
			</div>
			<?php endif; ?>
			
			<?php if ( $menu_top_show_widgets ) : ?>
			<div class="<?php echo esc_attr( $widgets_container_width ); ?>">
				<div class="row blog-sidebar">
				<?php
					dynamic_sidebar( 'top_menu_sidebar' );
				?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>