<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$nav = kalium_get_main_menu();

// Menu In Use
$menu_type	 = get_data( 'main_menu_type' );
$sticky_menu = get_data( 'header_sticky_menu' );


// Header Options
$header_vpadding_top    = get_data( 'header_vpadding_top' );
$header_vpadding_bottom = get_data( 'header_vpadding_bottom' );
$header_fullwidth       = get_data( 'header_fullwidth' );

// Header Classes
$header_classes = array( 'main-header' );
$header_classes[] = 'menu-type-' . esc_attr( $menu_type );

// Fullwidth Header
if ( $header_fullwidth ) {
	$header_classes[] = 'fullwidth-header';
}

// Header Options
$header_options = array(
	'stickyMenu' => false
);

// Current Menu Skin
switch ( $menu_type ) {
	// Fullscreen Menu
	case 'full-bg-menu':
		$current_menu_skin = get_data( 'menu_full_bg_skin' );
		break;
		
	// Standard Menu
	case 'standard-menu':
		$current_menu_skin = get_data( 'menu_standard_skin' );
		break;
	
	// Top Menu
	case 'top-menu':
		$current_menu_skin = get_data( 'menu_top_skin' );
		break;
	
	// Sidebar Menu
	case 'sidebar-menu':
		$current_menu_skin = get_data( 'menu_sidebar_skin' );
		break;
}

$header_options['currentMenuSkin'] = isset( $current_menu_skin ) ? $current_menu_skin : '';

// Header Vertical Padding
if ( is_numeric( $header_vpadding_top ) && $header_vpadding_top > 0 ) {
	generate_custom_style( 'header.main-header', "padding-top: {$header_vpadding_top}px;" );
	
	// Responsive
	if ( $header_vpadding_top >= 40 ) {
		generate_custom_style( 'header.main-header', 'padding-top: ' . ( $header_vpadding_top / 2 ) . 'px;', 'screen and (max-width: 992px)' );
	}
	
	if ( $header_vpadding_top >= 40 ) {
		generate_custom_style( 'header.main-header', 'padding-top: ' . ( $header_vpadding_top / 3 ) . 'px;', 'screen and (max-width: 768px)' );
	}
}

if ( is_numeric( $header_vpadding_bottom ) && $header_vpadding_bottom > 0 ) {
	generate_custom_style( 'header.main-header', "padding-bottom: {$header_vpadding_bottom}px;" );
	
	// Responsive
	if ( $header_vpadding_top >= 40 ) {
		generate_custom_style( 'header.main-header', 'padding-bottom: ' . ( $header_vpadding_bottom / 2 ) . 'px;', 'screen and (max-width: 992px)' );
	}
	
	if ( $header_vpadding_top >= 40 ) {
		generate_custom_style( 'header.main-header', 'padding-bottom: ' . ( $header_vpadding_bottom / 3 ) . 'px;', 'screen and (max-width: 768px)' );
	}
}

// Sticky Menu
if ( $sticky_menu ) {
	$header_classes[] = 'is-sticky';
	
	$header_sticky_vpadding        = get_data( 'header_sticky_vpadding' );
	$header_sticky_bg              = get_data( 'header_sticky_bg' );
	$header_sticky_bg_alpha        = get_data( 'header_sticky_bg_alpha' );
	$header_sticky_mobile          = get_data( 'header_sticky_mobile' );
	$header_sticky_autohide        = get_data( 'header_sticky_autohide' );
	$header_sticky_menu_skin       = get_data( 'header_sticky_menu_skin' );
	$header_sticky_custom_logo     = get_data( 'header_sticky_custom_logo' );
	$header_sticky_logo_image_id   = get_data( 'header_sticky_logo_image_id' );
	
	$header_options['stickyMenu']      = true;
	$header_options['stickyMobile']    = $header_sticky_mobile ? true : false;
	
	$sticky_initialized_class = 'header.main-header.is-sticky.sticky-initialized';
	
	// Sticky Menu Background – Active Mode
	if ( $header_sticky_bg ) {
		$header_sticky_bg_rgba = laborator_hex2rgba( $header_sticky_bg, intval( $header_sticky_bg_alpha ) / 100 );
		generate_custom_style( "{$sticky_initialized_class}.sticky-active", "background-color: {$header_sticky_bg_rgba};", '', true );
	}
	
	// Vertical Padding of Sticky Menu
	if ( is_numeric( $header_sticky_vpadding ) && $header_sticky_vpadding >= 0 ) {
		generate_custom_style( "{$sticky_initialized_class}.sticky-active.sticky-fully-hidden", "padding-top: {$header_sticky_vpadding}px; padding-bottom: {$header_sticky_vpadding}px;", '', true );
	}
	
	$header_options['stickyMenuSkin'] = $header_sticky_menu_skin;
	
	// Custom Logo Width
	$header_sticky_logo_width = get_data( 'header_sticky_logo_width' );
	
	if( $header_sticky_logo_width ) {
		$header_options['stickyLogoWidth'] = $header_sticky_logo_width;
		generate_custom_style( "{$sticky_initialized_class}.sticky-active .logo-image", "width: {$header_sticky_logo_width}px;", '', true );
	}
	
	// Custom Logo Image
	$header_options['stickyUseCustomLogo'] = false;
	
	if ( $header_sticky_custom_logo && $header_sticky_logo_image_id ) {
		$sticky_logo = wp_get_attachment_image_src( $header_sticky_logo_image_id, 'original' );
		
		$header_options['stickyUseCustomLogo'] = true;
		$header_options['stickyCustomLogo'] = str_replace( array( 'http:', 'https:' ), '', $sticky_logo );
		
		$header_classes[] = 'has-sticky-logo';
		
		// Sticky Logo Height
		if ( is_array( $sticky_logo ) ) {
			$header_sticky_logo_height = $sticky_logo[2];
			
			if ( $header_sticky_logo_width ) {
				$header_sticky_logo_height = ( $sticky_logo[2] / $sticky_logo[1] ) * $header_sticky_logo_width;
			}
			
			generate_custom_style( "{$sticky_initialized_class}.sticky-active .logo-image", "height: {$header_sticky_logo_height}px;", '', true );
		}
	}
	
	// Autohide Sticky Menu
	$header_options['autoHide'] = false;
	
	if ( $header_sticky_autohide ) {
		$header_options['autoHide'] = true;
		
		$header_classes[] = 'sticky-auto-hide';
	}
	
	// Bottom Border and Shadow
	$header_sticky_border = get_data( 'header_sticky_border' );
	
	// Sticky Header Border and Shadow
	if ( $header_sticky_border ) {
		
		// Border
		$header_sticky_border_color = get_data( 'header_sticky_border_color' );
		
		if ( $header_sticky_border_color ) {
			$header_sticky_border_color_alpha    = get_data( 'header_sticky_border_color_alpha' );
			$header_sticky_border_width          = get_data( 'header_sticky_border_width' );
			$header_sticky_border_apply_when     = get_data( 'header_sticky_border_apply_when' );
			$header_sticky_border_color_rgba     = laborator_hex2rgba( $header_sticky_border_color, intval( $header_sticky_border_color_alpha ) / 100 );
			
			$header_sticky_border_color_selector = $sticky_initialized_class;
			
			if ( 'sticky-active' == $header_sticky_border_apply_when ) {
				$header_sticky_border_color_selector .= '.sticky-active.sticky-fully-hidden';
			} else if ( 'sticky-inactive' == $header_sticky_border_apply_when ) {
				generate_custom_style( "{$header_sticky_border_color_selector}.sticky-active.sticky-fully-hidden", 'border-bottom-color: transparent !important;', '', true );
			}
			
			generate_custom_style( "{$header_sticky_border_color_selector}", "border-bottom: {$header_sticky_border_width} solid {$header_sticky_border_color_rgba};", '', true );
		}
		
		// Shadow
		$header_sticky_shadow_color       = get_data( 'header_sticky_shadow_color' );
		
		if ( $header_sticky_shadow_color ) {
			
			$header_sticky_shadow_color_alpha    = get_data( 'header_sticky_shadow_color_alpha' );
			$header_sticky_shadow_width          = get_data( 'header_sticky_shadow_width' );
			$header_sticky_shadow_blur           = get_data( 'header_sticky_shadow_blur' );
			$header_sticky_shadow_apply_when     = get_data( 'header_sticky_shadow_apply_when' );
			$header_sticky_shadow_color_rgba     = laborator_hex2rgba( $header_sticky_shadow_color, intval( $header_sticky_shadow_color_alpha ) / 100 );
			
			$header_sticky_shadow_color_selector = $sticky_initialized_class;
			$shadow_property_css                 = "0px 0px {$header_sticky_shadow_blur} {$header_sticky_shadow_width} ";
			
			if ( 'sticky-active' == $header_sticky_shadow_apply_when ) {
				$header_sticky_shadow_color_selector .= '.sticky-active.sticky-fully-hidden';
			} else if ( 'sticky-inactive' == $header_sticky_shadow_apply_when ) {
				generate_custom_style( "{$header_sticky_shadow_color_selector}.sticky-active.sticky-fully-hidden", "box-shadow: {$shadow_property_css} transparent !important; -webkit-box-shadow: {$shadow_property_css} transparent !important; -moz-box-shadow: {$shadow_property_css} transparent !important;", '', true );
			}
			
			// Color Property
			$shadow_property_css .= $header_sticky_shadow_color_rgba;
			
			generate_custom_style( "{$header_sticky_shadow_color_selector}", "box-shadow: {$shadow_property_css}; -webkit-box-shadow: {$shadow_property_css}; -moz-box-shadow: {$shadow_property_css};" );
		}
	}
}
?>
<header class="<?php echo implode( ' ', $header_classes ); ?>">
	<div class="container">

		<div class="logo-and-menu-container">
			
			<div class="logo-column">
				<?php get_template_part( 'tpls/logo' ); ?>
			</div>
				
			<div class="menu-column">
			<?php
			// Show Menu (by type)
			switch ( $menu_type ) :
			
				case 'full-bg-menu':
				
					$menu_full_bg_search_field      = get_data( 'menu_full_bg_search_field' );
					$menu_full_bg_submenu_indicator = get_data( 'menu_full_bg_submenu_indicator' );
					$menu_full_bg_alignment         = get_data( 'menu_full_bg_alignment' );
					$menu_full_bg_footer_block		= get_data( 'menu_full_bg_footer_block' );
					$menu_full_bg_skin				= get_data( 'menu_full_bg_skin' );
					
					$menu_bar_skin_active = $menu_full_bg_skin;
					
					switch ( $menu_full_bg_skin ) {
						case "menu-skin-light":
							$menu_bar_skin_active = 'menu-skin-dark';
							break;
							
						default:
							$menu_bar_skin_active = 'menu-skin-light';
					}
					?>
									
					<?php 
					// Cart Menu Icon
					if ( is_shop_supported() ) : 
						
						lab_wc_cart_menu_icon( $menu_full_bg_skin ); 
						
					endif; 	
					?>
					
					<a class="menu-bar <?php echo esc_attr( $menu_full_bg_skin ); ?>" data-menu-skin-default="<?php echo esc_attr( $menu_full_bg_skin ); ?>" data-menu-skin-active="<?php echo esc_attr( $menu_bar_skin_active ); ?>" href="#">
						<?php kalium_menu_icon_or_label(); ?>
					</a>
					<?php
						break;
				
				case 'standard-menu':
					
					$menu_standard_menu_bar_visible    = get_data( 'menu_standard_menu_bar_visible' );
					$menu_standard_skin                = get_data( 'menu_standard_skin' );
					$menu_standard_menu_bar_effect     = get_data( 'menu_standard_menu_bar_effect' );
					
					?>
					<div class="standard-menu-container<?php 
						when_match( $menu_standard_menu_bar_visible, "menu-bar-root-items-hidden" );
						echo " {$menu_standard_skin}";
						echo " {$menu_standard_menu_bar_effect}";
					?>">
						
						<a class="menu-bar<?php 
							echo " {$menu_standard_skin}"; 
							when_match( $menu_standard_menu_bar_visible, '', 'hidden-md hidden-lg' );
						?>" href="#">
							<?php kalium_menu_icon_or_label(); ?>
						</a>
						
						<?php 
						// Cart Menu Icon
						if ( is_shop_supported() ) : 
							
							lab_wc_cart_menu_icon( $menu_standard_skin );
							
						endif; 	
						?>
						
						<nav><?php echo $nav; // No escaping needed, this is wp_nav_menu() with echo=false ?></nav>
					</div>
					<?php
					break;
			
			case 'top-menu':
			
				$menu_top_skin = get_data( 'menu_top_skin' );
				?>
				
				<?php 
				// Cart Menu Icon
				if ( is_shop_supported() ) : 
					
					lab_wc_cart_menu_icon( $menu_top_skin ); 
					
				endif; 	
				?>
				
				<a class="menu-bar <?php echo esc_attr( $menu_top_skin ); ?>" href="#">
					<?php kalium_menu_icon_or_label(); ?>
				</a>
				<?php
					break;
			
			case 'sidebar-menu':
				
				$menu_sidebar_skin = get_data( 'menu_sidebar_skin' );
				
				?>
				
				<?php 
				// Cart Menu Icon
				if ( is_shop_supported() ) : 
					
					lab_wc_cart_menu_icon( $menu_sidebar_skin ); 
					
				endif; 	
				?>
				
				<a class="menu-bar <?php echo esc_attr( $menu_sidebar_skin ); ?>" href="#">
					<?php kalium_menu_icon_or_label(); ?>
				</a>
				<?php	
				
				endswitch;
				?>
			</div>
		</div>
		
		<?php
		// Full Screen Menu Container
		if ( $menu_type == 'full-bg-menu' ) :
		?>
		<div class="full-screen-menu menu-open-effect-fade<?php 
			echo " {$menu_full_bg_skin}";
			when_match( $menu_full_bg_submenu_indicator, 'submenu-indicator' );
			when_match( $menu_full_bg_alignment == 'centered-horizontal', 'menu-horizontally-center' );
			when_match( in_array( $menu_full_bg_alignment, array( 'centered', 'centered-horizontal' ) ), 'menu-aligned-center' );
			when_match( $menu_full_bg_footer_block, 'has-fullmenu-footer' );
		?>">
			<div class="container">
				<nav>
				<?php 
				echo $nav;
					
				if ( $menu_full_bg_search_field ) :
					
					?>
					<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" enctype="application/x-www-form-urlencoded">
						<input id="full-bg-search-inp" type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
						
						<label for="full-bg-search-inp">
							<?php 
								echo __( 'Search', 'kalium' );
								echo '<span><i></i><i></i><i></i></span>'; 
							?>
							</label>
						</form>
						<?php
						
					endif; 
					?>
					</nav>
				</div>
				
				<?php 
				if ( $menu_full_bg_footer_block ) : 
				?>
				<div class="full-menu-footer">
					<div class="container">
						<div class="right-part">
							<?php echo do_shortcode( '[lab_social_networks rounded]' ); ?>
						</div>
						
						<div class="left-part">
							<?php echo do_shortcode( get_data( 'footer_text' ) ); ?>
						</div>
					</div>
				</div>
				<?php 
				endif; 
				?>
			</div>
		<?php
		endif;
		// End of: Full Screen Menu Container
		?>

	</div>
</header>

<script type="text/javascript">
	var headerOptions = <?php echo json_encode( $header_options ); ?>;
</script>
<?php

get_template_part( "tpls/page-heading-title" );
