<?php
/**
 *	Kalium WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

$menu_sidebar_menu_id       = get_data( 'menu_sidebar_menu_id' );
$menu_sidebar_skin          = get_data( 'menu_sidebar_skin' );
$menu_sidebar_alignment     = get_data( 'menu_sidebar_alignment' );
$menu_sidebar_show_widgets  = get_data( 'menu_sidebar_show_widgets' );

$menu_id = 'main-menu';

if ( $menu_sidebar_menu_id != 'default' ) {
	$menu_id = str_replace( 'menu-', '', $menu_sidebar_menu_id );
}

$nav = kalium_get_main_menu( $menu_id );

?>
<div class="sidebar-menu-wrapper menu-type-<?php echo esc_attr( $main_menu_type ); ?> sidebar-alignment-<?php echo esc_attr( $menu_sidebar_alignment ); ?> <?php echo esc_attr( $menu_sidebar_skin ); ?>">
	<div class="sidebar-menu-container">
		
		<a class="sidebar-menu-close" href="#"></a>
		
		<?php if ( $nav ) : ?>
		<div class="sidebar-main-menu">
			<?php echo $nav; ?>
		</div>
		<?php endif; ?>
		
		<?php if ( $menu_sidebar_show_widgets ) : ?>
		<div class="sidebar-menu-widgets blog-sidebar">
			<?php dynamic_sidebar( 'sidebar_menu_sidebar' ); ?>
		</div>
		<?php endif; ?>
		
	</div>
</div>

<div class="sidebar-menu-disabler"></div>