<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


// After Setup Theme
function laborator_after_setup_theme() {
	// Theme Support
	add_theme_support( 'html5' );
	add_theme_support( 'menus' );
	add_theme_support( 'widgets' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'featured-image' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-formats', array( 'video', 'quote', 'image', 'link', 'gallery', 'audio' ) );
	add_theme_support( 'title-tag' );

	// Theme Textdomain
	load_theme_textdomain( 'kalium', get_template_directory() . '/languages' );

	// Register Menus
	register_nav_menus(
		array(
			'main-menu'   => 'Main Menu',
			'mobile-menu' => 'Mobile Menu',
		)
	);
	
	// Content Width
	$GLOBALS['content_width'] = apply_filters( 'kalium_content_width', 945 );
}


// Base Functionality
function laborator_init() {
	global $theme_version, $theme_name;
	
	$theme_obj     = wp_get_theme();
	$theme_version = $theme_obj->get( 'Version' );
	
	if ( is_child_theme() ) {
		$template_dir     = basename( get_template_directory() );
		$theme_obj        = wp_get_theme( $template_dir );
		$theme_version    = $theme_obj->get( 'Version' );
	}
	
	// Styles
	wp_register_style( 'bootstrap', THEMEASSETS . 'css/bootstrap.css', null, null );
	wp_register_style( 'main', THEMEASSETS . 'css/main.css', null, $theme_version );

	wp_register_style( 'font-awesome', THEMEASSETS . 'css/fonts/font-awesome/font-awesome.css', null, null );
	wp_register_style( 'font-flaticons', THEMEASSETS . 'css/fonts/flaticons-custom/flaticon.css', null, null );
	wp_register_style( 'font-lineaicons', THEMEASSETS . 'css/fonts/linea-iconfont/linea_iconfont.css', null, null );

	wp_register_style( 'style', get_template_directory_uri() . '/style.css', null, $theme_version );


	// Scripts
	wp_register_script( 'bootstrap', THEMEASSETS . 'js/bootstrap.min.js', null, null, true );
	wp_register_script( 'joinable', THEMEASSETS . 'js/joinable.min.js', null, $theme_version, true );
	
	wp_register_script( 'custom', THEMEASSETS . 'js/custom.min.js', null, $theme_version, true );


		// Owl Carousel
		wp_register_script( 'owl-carousel', THEMEASSETS . 'js/owl-carousel/owl.carousel.min.js', null, null, true );
		wp_register_style( 'owl-carousel', THEMEASSETS . 'js/owl-carousel/owl-carousel.css', null, null );

		// Video JS
		wp_register_script( 'video-js', THEMEASSETS . 'js/video-js/video.min.js', null, null, true );
		wp_register_style( 'video-js', THEMEASSETS . 'js/video-js/video-js.min.css', null, null );
		
		wp_register_script( 'video-js-youtube', THEMEASSETS . 'js/video-js-youtube.js', array ('video-js' ), null, true );
		

		// Nivo Lightbox
		if ( apply_filters( 'kalium_enable_nivo_lightbox', true ) ) {
			wp_register_script( 'nivo-lightbox', THEMEASSETS . 'js/nivo-lightbox/nivo-lightbox.min.js', null, null, true );
			wp_register_style( 'nivo-lightbox', THEMEASSETS . 'js/nivo-lightbox/nivo-lightbox.css', null, null );
			wp_register_style( 'nivo-lightbox-default', THEMEASSETS . 'js/nivo-lightbox/themes/default/default.css', array( 'nivo-lightbox' ), null);
		}
		
		// Owl Carousel
		wp_register_script( 'slick', THEMEASSETS . 'js/slick/slick.min.js', null, null, true );
		wp_register_style( 'slick', THEMEASSETS . 'js/slick/slick.css', null, null );
		
		// Fluid Box
		wp_register_script( 'fluidbox', THEMEASSETS . 'js/fluidbox/jquery.fluidbox.min.js', null, null, true );
		wp_register_style( 'fluidbox', THEMEASSETS . 'js/fluidbox/css/fluidbox.css', null, null );
		
		// Light Gallery
		wp_register_script( 'light-gallery', THEMEASSETS . 'js/light-gallery/js/lightgallery-all.min.js', null, null, true );
		
		wp_register_style( 'light-gallery', THEMEASSETS . 'js/light-gallery/css/lightgallery.min.css', null, null );
		wp_register_style( 'light-gallery-transitions', THEMEASSETS . 'js/light-gallery/css/lg-transitions.min.css', null, null );
		
		
		// Admin JS & CSS
		wp_register_script( 'admin-js', THEMEASSETS . 'js/admin-main.js', null, null );
		wp_register_style( 'admin-css', THEMEASSETS . 'css/admin/main.css', null, $theme_version );


	// Google Maps
	if ( false == is_admin() ) {
		wp_register_script( 'google-maps', '//maps.googleapis.com/maps/api/js', null, 3, true );
	}
}


// Enqueue Scritps and other stuff
function laborator_wp_enqueue_scripts() {
	
	// Styles
	wp_enqueue_style( array( 'bootstrap', 'main', 'font-awesome', 'font-flaticons', 'font-lineaicons' ) );
	
	// Somebody don't want to include style.css of the theme
	if( get_data( 'do_not_enqueue_style_css' ) != true ) {
		wp_enqueue_style( 'style' );
	}

	// Scripts
	wp_enqueue_script( array( 'jquery', 'bootstrap', 'joinable' ) );

	// Custom Skin
	if ( get_data( 'use_custom_skin' ) ) {
		
		if ( false == apply_filters( 'kalium_use_filebased_custom_skin', kalium_use_filebased_custom_skin() ) ) {
		
			if ( '' != get_option( 'permalink_structure' ) && true != get_data( 'theme_skin_include_alternate' ) ) {
				wp_enqueue_style( 'custom-skin', home_url( 'skin.css' ), null, null );
			} else {
				wp_enqueue_style( 'custom-skin', home_url( '?custom-skin=1' ), null, null );
			}
		}
	}
	
	// Single Post
	if ( is_single() ) {		
		wp_enqueue_script( array( 'fluidbox' ) );
		wp_enqueue_style( array( 'fluidbox' ) );
		
		if ( comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	// Fonts
	laborator_load_font();
}


// Custom Skin (used only
if ( isset( $_GET['custom-skin'] ) ) {
	kalium_custom_skin_parse_css();
}

function kalium_custom_skin_parse_css() {
	$kalium_skin_custom_css = get_option( 'kalium_skin_custom_css' );
	
	header( 'Content-Type: text/css; charset: UTF-8' );
	header( 'Content-Length: ' . strlen( $kalium_skin_custom_css ) );
	header( 'Cache-Control: public, max-age=2592000' );
	header( 'Date: ' . gmdate( 'D, d M Y H:i:s \G\M\T', time() ) );
	header( 'Expires: ' . gmdate( 'D, d M Y H:i:s \G\M\T', time() + ( 60 * 60 * 24 * 30 ) ) );
	header( 'ETag: ' . md5( $kalium_skin_custom_css ) );
	header( 'X-Cache: HIT' );
	
	echo $kalium_skin_custom_css;
	die();
}

// Custom Skin for Pretty Permalinks
add_action( 'init', 'lab_custom_skin_rewrite', 10 );

function lab_custom_skin_rewrite() {
	global $wp_rewrite;
	
	if ( '' !== $wp_rewrite->permalink_structure ) {	
		add_rewrite_rule( 'skin.css', 'index.php?custom-skin=use', 'top' );
		add_rewrite_tag( '%custom-skin%', 'use' );
	}
}

// Show Custom Skin on Pretty Permalinks
add_action( 'wp', 'lab_custom_skin_template_redirect', 10 );

function lab_custom_skin_template_redirect() {
	
	global $wp_rewrite;
	
	if ( '' !== $wp_rewrite->permalink_structure ) {	
		
		if ( ! in_array( 'skin.css', array_keys( $wp_rewrite->rules ) ) ) {
			flush_rewrite_rules();
		}
		
		if ( get_query_var( 'custom-skin' ) == 'use' ) {
			kalium_custom_skin_parse_css();
		}
	}
}

// Custom Skin Canonical Redirect Disable
add_filter( 'redirect_canonical', 'lab_custom_skin_redirect_canonical' );

function lab_custom_skin_redirect_canonical( $redirect_url ) {
	
	if ( get_query_var( 'custom-skin' ) == 'use' ) {
		return false;
	}
	
	return $redirect_url;
}


// Print scripts in the header
function laborator_wp_print_scripts() {
?>
<script type="text/javascript">
var ajaxurl = ajaxurl || '<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>';
</script>
<?php
}



// Laborator Menu Page
function laborator_menu_page() {
	global $menu;

	// Add Separator
	$menu[] = array( '', 'read', 'separator-lab', '', 'wp-menu-separator' );
	
	add_menu_page( 'Laborator', 'Laborator', 'edit_theme_options', 'laborator_options', 'laborator_null_function' );

	if ( lab_get( 'page' ) == 'laborator_options' ) {
		wp_redirect( admin_url( 'themes.php?page=theme-options' ) );
	}
}

function laborator_null_function() {
}


// Redirect to Theme Options
function laborator_options() {
	wp_redirect( admin_url( 'themes.php?page=theme-options' ) );
}


// Theme Options Link in Admin Bar
add_action( 'admin_bar_menu', 'laborator_modify_admin_bar', 10000 );

function kalium_get_plugin_updates_requires() {
	global $tgmpa;
	
	// Plugin Updates Notification
	$plugin_updates = 0;
	$updates_notification = '';
	
	if ( $tgmpa instanceof TGM_Plugin_Activation && ! $tgmpa->is_tgmpa_complete() ) {
		// Plugins
		$plugins = $tgmpa->plugins;
		
		foreach ( $tgmpa->plugins as $slug => $plugin ) {
			if ( $tgmpa->is_plugin_active( $slug ) && true == $tgmpa->does_plugin_have_update( $slug ) ) {
				$plugin_updates++;
			}
		}
	}
	
	if ( $plugin_updates > 0 ) {
		$updates_notification = " <span class=\"lab-update-badge\">{$plugin_updates}</span>";
	}
	
	return array( $plugin_updates, $updates_notification );
}

function laborator_modify_admin_bar( $wp_admin_bar ) {
	
	list( $plugin_updates, $updates_notification ) = kalium_get_plugin_updates_requires();
	
	$icon = '<i class="wp-menu-image dashicons-before dashicons-admin-generic laborator-admin-bar-menu"></i>';
	
	// Add Admin Bar Menu Links
	$wp_admin_bar->add_menu( array( 
		'id'      => 'laborator-options',
		'title'   => $icon . wp_get_theme(),
		'href'    => is_admin() ? home_url() : admin_url( 'themes.php?page=theme-options' ),
		'meta'	  => array( 'target' => is_admin() ? '_blank' : '_self' )
	) );
	
	$wp_admin_bar->add_menu( array( 
		'parent'  => 'laborator-options',
		'id'      => 'laborator-options-sub',
		'title'   => 'Theme Options - w  p l o c k e r .c o m',
		'href'    => admin_url( 'themes.php?page=theme-options' )
	) );
		
	if ( $plugin_updates > 0 ) {
		$wp_admin_bar->add_menu( array( 
			'parent'  => 'laborator-options',
			'id'      => 'install-plugins',
			'title'   => 'Update Plugins' . $updates_notification,
			'href'    => admin_url( 'themes.php?page=tgmpa-install-plugins' )
		) );
	}
	
	$wp_admin_bar->add_menu( array( 
		'parent'  => 'laborator-options',
		'id'      => 'laborator-custom-css',
		'title'   => 'Custom CSS',
		'href'    => admin_url( 'admin.php?page=laborator_custom_css' )
	) );
	
	$wp_admin_bar->add_menu( array( 
		'parent'  => 'laborator-options',
		'id'      => 'laborator-demo-content-importer',
		'title'   => 'Demo Content',
		'href'    => admin_url( 'admin.php?page=laborator_demo_content_installer' )
	) );
	
	$wp_admin_bar->add_menu( array( 
		'parent'  => 'laborator-options',
		'id'      => 'laborator-help',
		'title'   => 'Theme Help',
		'href'    => admin_url( 'admin.php?page=laborator_docs' )
	) );
	
	$wp_admin_bar->add_menu( array( 
		'parent'  => 'laborator-options',
		'id'      => 'laborator-themes',
		'title'   => 'Browse Our Themes',
		'href'    => 'http://bit.do/ZYMg',
		'meta'	  => array( 'target' => '_blank' )
	) );
}

// Plugin Updates Admin Menu Link
function laborator_menu_page_plugin_updates() {
	
	// Updates Notification
	list( $plugin_updates, $updates_notification ) = kalium_get_plugin_updates_requires();
	
	if ( $plugin_updates > 0 ) {
		add_submenu_page( 'laborator_options', 'Update Plugins', 'Update Plugins' . $updates_notification, 'edit_theme_options', 'tgmpa-install-plugins', 'laborator_null_function' ); 
	}
}

// Documentation Page iFrame
function laborator_menu_page_documentation() {
	add_submenu_page( 'laborator_options', 'Documentation', 'Theme Help', 'edit_theme_options', 'laborator_docs', 'laborator_documentation_page' );
	add_submenu_page( 'themes.php', 'Documentation', 'Theme Help', 'edit_theme_options', 'laborator_docs', 'laborator_documentation_page' );
}

// Browse Themes Admin Menu Link
function laborator_menu_page_browse_themes() {
	add_submenu_page( 'laborator_options', 'Browse Our Themes', 'Browse Our Themes', 'edit_theme_options', 'http://themeforest.net/user/Laborator/portfolio?ref=Laborator', 'laborator_null_function' );
}

function laborator_documentation_page() {
	add_thickbox();
?>
<div class="wrap">
	<h2>Documentation</h2>

	<p>You can read full theme documentation by clicking the button below:</p>

	<p>
		<a href="//documentation.laborator.co/item/kalium/?theme-inline=true" class="button button-primary" id="lab_read_docs">Read Documentation</a>
	</p>


	<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {
		$( '#lab_read_docs' ).click( function( ev ) {
			ev.preventDefault();
			var href = $( this ).attr( 'href' );
			tb_show( 'Theme Documentation' , href + '?TB_iframe=1&width=1280&height=650' );
		} );
	} );
	</script>

	<style>
		.lab-faq-links {
		}

		.lab-faq-links li {
			margin-top: 18px;
			background: #FFF;
			border: 1px solid #E0E0E0;
			padding: 0;
		}
		
		.lab-faq-links li > strong {
			display: block;
			padding: 10px 15px;
			background: rgba(238,238,238,0.6);
		}
	
		.lab-faq-links li:target {
			-webkit-animation: blink 1s 3;
			-moz-animation: blink 1s 3;
			-o-animation: blink 1s 3;
			animation: blink 1s 3;
		}

		.lab-faq-links li pre {
			font-size: 13px;
			max-width: 100%;
			word-break: break-word;
			padding: 10px 15px;
			padding-top: 5px;
			white-space: pre-line;
		}

		.lab-faq-links .warn {
			display: block;
			font-family: Arial, Helvetica, sans-serif;
			border: 1px solid #999;
			padding: 10px;
			font-size: 12px;
			text-transform: uppercase;
		}		
		
		@-webkit-keyframes blink {
		    0% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		
		    50% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 1);
		    }
		    
		    100% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		}
		
		@keyframes blink {
		    0% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		
		    50% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 1);
		    }
		    
		    100% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		}
	</style>

	<br />
	<h3>Frequently Asked Questions</h3>
	<hr />

	<ul class="lab-faq-links">
		<li id="update-theme">

			<strong>How do I update the theme?</strong>

			<pre>1. Go to Envato Toolkit link in the menu (firstly activate it <a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>">here</a> if you haven't already).

2. There you type your username i.e. <strong>EnvatoUsername</strong> and your <strong>Secret API Key</strong> that can be found on &quot;My Settings&quot; page on ThemeForest,
   example: <a href="http://drops.laborator.co/1cTZb" target="_blank">http://drops.laborator.co/1cTZb</a>.

3. To check for theme updates click on <strong>Envato Toolkit</strong> and choose Themes tab. 
   View this screenshot to see when the new update is available: <a href="http://drops.laborator.co/141DA" target="_blank">http://drops.laborator.co/141DA</a>.</pre>
		</li>

		<li id="update-visual-composer">

			<strong>How to update premium plugins that are bundled with the theme?</strong>

			<pre>Each time new theme update is available, we will include latest versions of premium plugins that are bundled with the theme.

To have latest version of premium plugins you need also to have the latest version of Kalium theme as well.

When new update is available for any of theme bundled plugins you will receive a notification that tells you need to update a specific plugin/s. 
Click this link <a href="http://drops.laborator.co/12DUv" target="_blank">http://drops.laborator.co/12DUv</a> to see how this notification popup looks like.

Then click <strong>Update</strong> for each plugin separately or check them all and choose Update from the dropdown and click apply. 
This screenshot <a href="http://drops.laborator.co/17J6H" target="_blank">http://drops.laborator.co/17J6H</a> will describe how to update plugins.

It may happen sometimes that after you update any plugin, <strong>Activate</strong> link to appear below that plugin, just ignore it because it is already activated.

<strong class="warn">Important Note: You don't have to buy these plugins, they are bundled with the theme</strong></pre>
		</li>

		<li id="regenerate-thumbnails">

			<strong>Regenerate Thumbnails</strong>

			<pre>If your thumbnails are not correctly cropped, you can regenerate them by following these steps:

1. Go to Plugins > Add New

2. Search for "<strong>Regenerate Thumbnails</strong>" (created by <strong>Alex Mills</strong>)

3. Install and activate that plugin.

4. Go to Tools > Regen. Thumbnails

5. Click "Regenerate All Thumbnails" button and let the process to finish till it reaches 100 percent.</pre>
		</li>

		<li id="flush-rewrite-rules">

			<strong>Flush Rewrite Rules</strong>

			<pre>If it happens to get <strong>404 Page not found</strong> error on some pages/posts that already exist, then you need to flush rewrite rules in order to fix this issue (this works in most cases).

To do apply <strong>rewrite rules flush</strong> follow these steps:

1. Go to <a href="<?php echo admin_url( 'options-permalink.php' ); ?>" target="_blank">Settings &gt; Permalinks</a>

2. Click "Save Changes" button.

That's all, check those pages to see if its fixed.</pre>
		</li>
	</ul>
</div>
<?php
}


// Admin Enqueue
function laborator_admin_enqueue_scripts() {
	wp_enqueue_script( 'admin-js' );
	wp_enqueue_style( 'admin-css' );
	
	?>
	<script type="text/javascript">var kalium_assets_dir = "<?php echo esc_attr( THEMEASSETS ); ?>";</script>
	<?php
}



// Admin Print Styles
function laborator_admin_print_styles() {
?>
<style>
	
.laborator-admin-bar-menu {
	position: relative !important;
	display: inline-block;
	width: 16px !important;
	height: 16px !important;
	background: url(<?php echo get_template_directory_uri(); ?>/assets/images/laborator-icon.png) no-repeat 0px 0px !important;
	background-size: 16px !important;
	margin-right: 8px !important;
	top: 3px !important;
}

#wp-admin-bar-laborator-options:hover .laborator-admin-bar-menu {
	background-position: 0 -32px !important;
}

.laborator-admin-bar-menu:before {
	display: none !important;
}

#toplevel_page_laborator_options .wp-menu-image {
	background: url(<?php echo get_template_directory_uri(); ?>/assets/images/laborator-icon.png) no-repeat 11px 8px !important;
	background-size: 16px !important;
}

#toplevel_page_laborator_options .wp-menu-image:before {
	display: none;
}

#toplevel_page_laborator_options .wp-menu-image img {
	display: none;
}

#toplevel_page_laborator_options:hover .wp-menu-image, #toplevel_page_laborator_options.wp-has-current-submenu .wp-menu-image {
	background-position: 11px -24px !important;
}

</style>
<?php
}


function laborator_wp_head() {
	
	// Custom JavaScript in Header
	$user_custom_js_head = get_data( 'user_custom_js_head' );
	
	if ( ! empty( $user_custom_js_head ) ) {
		
		if ( ! preg_match( "/^\s*<script/", $user_custom_js_head ) ) {
			$user_custom_js_head = '<script> ' . $user_custom_js_head . ' </script>';
		}
		
		echo $user_custom_js_head;
	}
}


function laborator_wp_footer() {
	
	// Custom.js
	wp_enqueue_script( 'custom' );

	// Custom JavaScript in Footer
	$user_custom_js = get_data( 'user_custom_js' );
	
	if ( ! empty( $user_custom_js ) ) {
		
		if ( ! preg_match( "/^\s*<script/", $user_custom_js ) ) {
			$user_custom_js = '<script> ' . $user_custom_js . ' </script>';
		}
		
		echo $user_custom_js;
	}
}



// Fav Icon
function laborator_favicon() {
	$favicon_image = get_data( 'favicon_image' );
	$apple_touch_icon = get_data( 'apple_touch_icon' );

	if ( $favicon_image || $apple_touch_icon ) {
		
		if ( is_numeric( $favicon_image ) ) {
			$favicon_image = wp_get_attachment_image_src( $favicon_image, 'full' );
			
			if ( $favicon_image ) {
				$favicon_image = $favicon_image[0];
			}
		}
		
		if ( is_numeric( $apple_touch_icon ) ) {
			$apple_touch_icon = wp_get_attachment_image_src( $apple_touch_icon, 'full' );
			
			if ( $apple_touch_icon ) {
				$apple_touch_icon = $apple_touch_icon[0];
			}
		}
		
		if ( $favicon_image ) {
			$favicon_image = str_replace( array( 'http:', 'https:' ), '', $favicon_image );
		}
		
		if ( $apple_touch_icon ) {
			$apple_touch_icon = str_replace( array( 'http:', 'https:' ), '', $apple_touch_icon );
		}
	?>
	<?php /*<!-- Favicons -->*/ ?>
	<?php if ( $favicon_image ) : ?>
	<link rel="shortcut icon" href="<?php echo esc_attr( $favicon_image ); ?>">
	<?php endif; ?>
	<?php if ( $apple_touch_icon ) : ?>
	<link rel="apple-touch-icon-precomposed" href="<?php echo esc_attr( $apple_touch_icon ); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_attr( $apple_touch_icon ); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_attr( $apple_touch_icon ); ?>">
	<?php endif; ?>
	<?php
	}
}



// Widgets Init
function laborator_widgets_init() {
	// Blog Sidebar
	$blog_sidebar = array(
		'id' => 'blog_sidebar',
		'name' => 'Blog Widgets',

		'before_widget' => '<div class="sidebar-box-holder wp-widget %1$s %2$s">',
		'after_widget' => '</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar( $blog_sidebar );


	// Footer Sidebar
	$footer_sidebar_column = 'col-xs-12';

	switch ( get_data( 'footer_widgets_columns' ) ) {
		case "two":
			$footer_sidebar_column = 'col-sm-6';
			break;

		case "three":
			$footer_sidebar_column = 'col-sm-4';
			break;

		case "four":
			$footer_sidebar_column = 'col-sm-3';
			break;
			
		case "five":
			$footer_sidebar_column = 'col-sm-2-4';
			break;

		case "six":
			$footer_sidebar_column = 'col-sm-2';
			break;
	}

	$footer_sidebar = array(
		'id' => 'footer_sidebar',
		'name' => 'Footer Widgets',

		'before_widget' =>
			'<div class="' . $footer_sidebar_column . '">'
				. '<div class="wp-widget section %2$s %1$s">',

		'after_widget' =>
			'</div>' .
		'</div>',

		'before_title' => '<h3>',
		'after_title' => '</h3>'
	);

	register_sidebar( $footer_sidebar );



	// Top Menu Sidebar
	$top_menu_sidebar_column = 'col-md-2 col-sm-4';

	switch ( get_data( 'menu_top_widgets_per_row' ) ) {
		case 'six':
			$top_menu_sidebar_column = 'col-sm-6';
			break;

		case 'four':
			$top_menu_sidebar_column = 'col-sm-4';
			break;

		case 'three':
			$top_menu_sidebar_column = 'col-md-3 col-sm-6';
			break;
	}

	$top_menu_sidebar = array(
		'id' => 'top_menu_sidebar',
		'name' => 'Top Menu Widgets',

		'before_widget' =>
			'<div class="' . $top_menu_sidebar_column . '">'
				. '<div class="sidebar-box-holder wp-widget %1$s %2$s">',

		'after_widget' =>
			'</div>' .
		'</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar( $top_menu_sidebar );



	// Sidebar Menu Widgets
	$sidebar_menu_sidebar = array(
		'id' => 'sidebar_menu_sidebar',
		'name' => 'Sidebar Menu Widgets',

		'before_widget' => '<div class="sidebar-box-holder wp-widget %1$s %2$s">',
		'after_widget' => '</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar( $sidebar_menu_sidebar );
	
	
	// Shop Sidebar
	$shop_sidebar = array(
		'id' => 'shop_sidebar',
		'name' => 'Shop Widgets',

		'before_widget' => '<div class="sidebar-box-holder wp-widget %1$s %2$s">',
		'after_widget' => '</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar( $shop_sidebar );

}


// Third party plugins
add_action( 'tgmpa_register', 'kalium_register_required_plugins' );

function kalium_register_required_plugins() {
	global $theme_version, $theme_name;
	
	$plugins = array(

		array(
			'name'               => 'Portfolio Post Type',
			'slug'               => 'portfolio-post-type',
			'required'           => false,
			'version'            => '',
		),

		array(
			'name'               => 'WooCommerce',
			'slug'               => 'woocommerce',
			'required'           => false,
			'version'            => '',
		),

		array(
			'name'               => 'Visual Composer',
			'slug'               => 'js_composer',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/js_composer.zip',
			'required'           => false,
			'version'            => '4.11.2.1',
		),

		array(
			'name'               => 'Revolution Slider',
			'slug'               => 'revslider',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/revslider.zip',
			'required'           => false,
			'version'            => '5.2.5.2',
		),

		array(
			'name'               => 'Layer Slider',
			'slug'               => 'LayerSlider',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/layersliderwp-5.6.8.installable.zip',
			'required'           => false,
			'version'            => '5.6.8',
			'minimum_version'	 => null
		),

		array(
			'name'               => 'Envato Market (Theme Updater)',
			'slug'               => 'envato-market',
			'source'    		 => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required'           => false
		),

		array(
			'name'               => 'Sidekick - WordPress training',
			'slug'               => 'sidekick',
			'required'           => false,
		),

		array(
			'name'               => 'Advanced Custom Fields',
			'slug'               => 'advanced-custom-fields',
			'required'           => true,
		),

		array(
			'name'               => 'ACF Repeater',
			'slug'               => 'acf-repeater',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/acf-repeater.zip',
			'required'           => true,
		),

		array(
			'name'               => 'ACF Flexible Content',
			'slug'               => 'acf-flexible-content',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/acf-flexible-content.zip',
			'required'           => true,
		),

		array(
			'name'               => 'ACF Gallery',
			'slug'               => 'acf-gallery',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/acf-gallery.zip',
			'required'           => true,
		),

	);
	
	// WooCommerce Quantity Buttons Plugin Suggest
	if ( function_exists( 'WC' ) ) {
		$plugins[] = array(
			'name'       => 'WooCommerce Quantity Increment',
			'slug'       => 'woocommerce-quantity-increment',
			'required'   => false,
		);
	}
	
	
	// Plugins Updater and Installer Message
	$message = '<div class="notice notice-info is-dismissible" style="margin-top: 20px;">
		<p><strong>Note from Laborator:</strong> To ensure the latest version of <em>theme required</em> plugins, you must have the latest version of <strong>' . $theme_name . '</strong> as well.</p>
		<p>Your current theme version is: <strong>' . $theme_version . '</strong> – <a class="thickbox" href="http://laborator.co/theme-version-check.php?theme=' . basename( get_template_directory_uri() ) . '&version=' . $theme_version . '&ts=' . time() . '&TB_iframe=true" title="Laborator Theme Version Checker" target="_blank">Click here to check if you have the latest version of this theme</a>.</p>
		<p style="font-size: 12px; color: #888;">If any of theme required plugins has released new update after the date that we released ' . "{$theme_name} {$theme_version}" . ', we will include the latest version of that plugin in the next update.</p>
	</div>';
		
	if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'tgmpa-install-plugins' ) {		
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
		
		add_action( 'admin_print_styles', create_function( '', 'echo "<style> iframe#TB_iframeContent { margin-bottom: -5px !important; width: 100% !important;} </style>";' ) );
	}
	
	$config = array(
		'id'           => 'kalium',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => $message,
	);

	tgmpa( $plugins, $config );
}



// Remove greensock from LayerSlider because it causes theme incompatibility issues
add_action( 'wp_enqueue_scripts', 'layerslider_remove_greensock' );

function layerslider_remove_greensock() {
	wp_dequeue_script( 'greensock' );
}




// Blog Pagination (endless)
add_action( 'wp_ajax_laborator_get_paged_blog_posts', 'laborator_get_paged_blog_posts' );
add_action( 'wp_ajax_nopriv_laborator_get_paged_blog_posts', 'laborator_get_paged_blog_posts' );

function laborator_get_paged_blog_posts() {
	$resp = array(
		'content' => ''
	);

	// Query Meta Vars
	$page  = post( 'page' );
	$opts  = post( 'opts' );
	$pp    = post( 'pp' );
	$q 	   = isset( $opts['q'] ) ? $opts['q'] : '';

	// Unserialize Query Details (if has)
	if ( $q ) {
		$q = json_decode( $q );
	}

	$query_args = array(
		'posts_per_page'  => $pp,
		'paged'           => $page,
		'post_status'     => 'publish'
	);

	if ( $q ) {
		$query_args = array_merge( $q, $query_args );
	}

	// Init query
	$query = new WP_Query( $query_args );

	// Import blog options
	include_once( THEMEDIR . 'tpls/blog-query.php' );

	// Disable lazy loading for AJAX request
	if ( $blog_template == 'blog-masonry' ) {
		//$blog_post_list_lazy_load = false;
	}

	// Custom Excerpt length for items
	if ( $sidebar_position != 'hide' ) {
		add_filter( 'excerpt_length', 'laborator_short_excerpt_length' );
	}
		
	// Proportional Image Height
	if ( $blog_proportional_thumbs ) {
		add_filter( 'kalium_blog_thumbnail_size', 'kalium_blog_thumbnail_size_proportional' );
	}

	switch ( $blog_columns ) {
		case '_3':
			add_filter( 'excerpt_length', 'laborator_short_excerpt_length' );
			break;

		case '_4':
			add_filter( 'excerpt_length', 'laborator_supershort_excerpt_length' );
			break;
	}

	// Collect posts
	ob_start();

	while ( $query->have_posts() ) {
		$query->the_post();

		switch ( $opts['useFormat'] ) {
			case 2:
				get_template_part( 'tpls/post-format-2' );
				break;

			default:
				get_template_part( 'tpls/post-format-1' );
		}
	}

	$content = ob_get_clean();

	// Set up content
	$resp['content'] = $content;

	echo json_encode( $resp );

	die();
}


// Coming Soon Mode
add_action( 'template_redirect', 'laborator_coming_soon_mode' );

function laborator_coming_soon_mode() {
	global $current_user;

	$maintenance_mode  = get_data( 'maintenance_mode' );
	$coming_soon_mode  = get_data( 'coming_soon_mode' );

	$manage_options    = current_user_can( 'manage_options' );

	if ( $coming_soon_mode && $manage_options == false || lab_get( 'view-coming-soon' ) ) {
		get_template_part( 'coming-soon-mode' );
		die();
	}

	if ( $maintenance_mode && $manage_options == false || lab_get( 'view-maintenance' ) ) {
		get_template_part( 'maintenance-mode' );
		die();
	}
}

// Like Feature
add_action( 'wp_ajax_laborator_update_likes', 'laborator_update_like_count' );
add_action( 'wp_ajax_nopriv_laborator_update_likes', 'laborator_update_like_count' );

function laborator_update_like_count() {
	$output    = array(
		'liked' => false,
		'count' => 0
	);

	$post_id   = intval( $_GET['post_id'] );
	$user_ip   = get_the_user_ip();

	if ( filter_var( $post_id, FILTER_VALIDATE_INT ) ) {
		$the_post = get_post( $post_id );

		if ( $the_post ) {
			$likes = $the_post->post_likes;
			$likes = is_array( $likes ) ? $likes : array();

			if ( ! in_array( $user_ip, $likes ) ) {
				// Like Post
				$output['liked'] = true;

				$likes[] = $user_ip;
				$output['count'] = count( $likes );

				update_post_meta( $post_id, 'post_likes', $likes );
			} else {
				// Unlike Post
				$output['liked'] = false;

				$key = array_search( $user_ip, $likes );

				if ( false !== $key ) {
					unset( $likes[ $key ] );
				}

				$output['count'] = count( $likes );

				update_post_meta( $post_id, 'post_likes', $likes );
			}
			
			if ( function_exists( 'wp_cache_post_change' ) ) {
				wp_cache_post_change( $post_id );
			}
		}

	}

	echo json_encode( $output );

	exit();
}

// Page Custom CSS
add_action( 'wp', 'kalium_custom_page_css_wp' );
add_action( 'get_footer', 'kalium_custom_page_css' );

function kalium_custom_page_css_wp() {
	$qo = get_queried_object();
	
	if ( $qo instanceof WP_Post ) {
		$page_custom_css = trim( $qo->page_custom_css );
	}
	
	if ( ! defined( 'PAGE_CUSTOM_CSS' ) && ! empty( $page_custom_css ) ) {
		$post_id = $qo->ID;
		$page_custom_css = str_replace( '.post-ID', ".page-id-{$post_id}", $page_custom_css );
		
		define( 'PAGE_CUSTOM_CSS', $page_custom_css );
	}
}

function kalium_custom_page_css() {
	if ( defined( 'PAGE_CUSTOM_CSS' ) ) {
		echo '<style>' . PAGE_CUSTOM_CSS . '</style>';
	}
}


// Search Results Filter
add_action( 'pre_get_posts', 'kalium_search_pre_get_posts' );

function kalium_search_pre_get_posts( $wp_query ) {
	global $s;
	
	if ( is_search() && false == is_admin() ) {	
		$search_post_types = get_data( 'search_post_types' );
		$post_types = array();
		
		foreach ( $search_post_types as $post_type => $include ) {
			if ( $include ) {
				$post_types[] = $post_type;
			}
		}
		
		if ( defined( 'WC_INSTALLED' ) && ! isset( $search_post_types[ 'product' ] ) ) {
			$post_types[] = 'product';
		}
		
		if ( count( $post_types ) ) {
			$wp_query->set( 'post_type', $post_types );
		}
		
		remove_action( 'pre_get_posts', 'kalium_search_pre_get_posts' );
	}
}


// Google Meta Theme Color (Phone)
add_action( 'wp_head', 'kalium_google_theme_color' );

function kalium_google_theme_color() {
	if ($google_theme_color = get_data( 'google_theme_color' ) ) {
	?>
	<meta name="theme-color" content="<?php echo esc_attr( $google_theme_color ); ?>">
	<?php
	}
}


// Revolution Slider set as Theme
define( 'REV_SLIDER_AS_THEME', true );

if ( function_exists( 'set_revslider_as_theme' ) ) {
	set_revslider_as_theme();
	
	global $wp_filter;

	if ( ! empty( $wp_filter[ 'admin_notices' ] ) && is_array( $wp_filter[ 'admin_notices' ] ) && count( $wp_filter[ 'admin_notices' ] ) ) {
		foreach ( $wp_filter[ 'admin_notices' ] as $priority => $priority_filters ) {
			foreach ( $priority_filters as $filter_hashname => $fn ) {
				if ( strpos( $filter_hashname, 'addActivateNotification' ) ) {
					unset( $wp_filter['admin_notices'][$priority][$filter_hashname] );
				}
			}
		}
	}
}


// Page Options – Logo and Menu
add_action( 'wp', 'check_for_custom_logo_in_page' );

function check_for_custom_logo_in_page() {
	
	global $wp_query;
	
	if ( ! ( is_singular() || is_home() ) ) {
		return;
	}
	
	$post_id = get_queried_object_id();
	
	$custom_logo           = get_field( 'custom_logo', $post_id );
	$custom_menu_skin      = get_field( 'custom_menu_skin', $post_id );
	$sticky_menu_on_page   = get_field( 'sticky_menu_on_page', $post_id );
	$sticky_menu_skin	   = get_field( 'sticky_menu_skin', $post_id );
	
	if ( $custom_logo && is_numeric( $custom_logo ) ) {
		$custom_logo_width = get_field( 'custom_logo_width' );
		
		add_filter( 'get_data_use_uploaded_logo', '__return_true' );
		add_filter( 'get_data_custom_logo_image', laborator_immediate_return_fn( $custom_logo ) );
		
		if ( is_numeric( $custom_logo_width ) && $custom_logo_width > 0 ) {
			add_filter( 'get_data_custom_logo_max_width', laborator_immediate_return_fn( $custom_logo_width ) );
		}
	}
	
	if ( $custom_menu_skin && in_array( $custom_menu_skin, array( 'menu-skin-main', 'menu-skin-dark', 'menu-skin-light' ) ) ) {
		add_filter( 'get_data_menu_full_bg_skin', laborator_immediate_return_fn( $custom_menu_skin ) );
		add_filter( 'get_data_menu_standard_skin', laborator_immediate_return_fn( $custom_menu_skin ) );
		add_filter( 'get_data_menu_top_skin', laborator_immediate_return_fn( $custom_menu_skin ) );
		add_filter( 'get_data_menu_sidebar_skin', laborator_immediate_return_fn( $custom_menu_skin ) );
	}
	
	if ( $sticky_menu_on_page && in_array( $sticky_menu_on_page, array( 'enable', 'disable' ) ) ) {
		add_filter( 'get_data_header_sticky_menu', ( $sticky_menu_on_page == 'enable' ? '__return_true' : '__return_false' ) );
		
		if ( $sticky_menu_skin ) {
			add_filter( 'get_data_header_sticky_menu_skin', laborator_immediate_return_fn( $sticky_menu_skin ) );
		}
	}
}


// Go to Top Feature
if ( get_data( 'footer_go_to_top' ) ) {
	add_action( 'wp_footer', 'kalium_go_to_top_link' );
}

function kalium_go_to_top_link() {
	
	$activate_when = get_data( 'footer_go_to_top_activate' );
	$button_type   = get_data( 'footer_go_to_top_type' );
	$position      = get_data( 'footer_go_to_top_position' );
	
	$type = 'pixels';
	
	if ( strpos( $activate_when, '%' ) ) {
		$type = 'percentage';
	} else if ( trim( strtolower( $activate_when ) ) == 'footer' ) {
		$type = 'footer';
	}
	
	?>
	<a href="#top" class="go-to-top<?php echo $button_type == 'circle' ? ' rounded' : ''; echo ' position-' . $position; ?>" data-type="<?php echo $type; ?>" data-val="<?php echo in_array( $type, array( 'pixels', 'percentage' ) ) ? intval( $activate_when ) : esc_attr( $activate_when ); ?>">
		<i class="flaticon-bottom4"></i>
	</a>
	<?php
}


// Holiday Season Wishes (13 dec – 05 jan)
add_action( 'admin_head', 'laborator_holidays_wishes_css' );

function laborator_holidays_wishes_css() {
	global $pagenow;
	
	if ( $pagenow == 'themes.php' && lab_get( 'page' ) == 'theme-options' ) {
		return;
	}
	
	$time          = time();
	$date_start    = date( 'Y' ) . '-12-13';
	$date_end      = ( date( 'Y' ) + 1 ) . '-01-04';
	
	if ( strtotime( $date_start ) <= $time && strtotime( $date_end ) >= $time ) {
		$x = is_rtl() ? 'left' : 'right';
		echo "<style type='text/css'> #laborator-holidays { float: $x; padding-$x: 15px; padding-top: 8px; margin: 0; font-size: 11px; } </style>";
	
		add_action( 'admin_notices', 'laborator_holidays_wishes' );
	}
}

function laborator_holidays_wishes() {
	echo "<p id='laborator-holidays'>Happy Holiday Season from <strong>Laborator</strong> team!</p>";
}
// End: Holiday Season Wishes



// Revolution Slider Logo Switch
add_action( 'wp_footer', 'kalium_revolution_slider_inpage_logo_switch' );

function kalium_revolution_slider_inpage_logo_switch() {
	$post_id = get_queried_object_id();
	
	if ( $post_id && get_field( 'revolution_slider_logo_switch', $post_id ) ) {
		$custom_logos = get_field( 'revolution_slider_custom_logos', $post_id );
		
		if ( ! empty( $custom_logos ) && is_array( $custom_logos ) ) {
			$custom_logos_json = array();
			
			foreach ( $custom_logos as $i => $logo ) {
				$entry = array(
					'id'		   => $i + 1,
					'slider'       => 'revapi' . $logo['slider'],
					'activeSlides' => explode( ',', empty( $logo['slide_number'] ) ? '0' : $logo['slide_number'] ),
					'logoWidth'	   => intval( $logo['logo_width'] ),
					'menuSkin'	   => $logo['menu_skin']
				);
				
				// Current Slides
				$entry['activeSlides'] = array_map( 'intval', $entry['activeSlides'] );
				
				// Active Logo Selector
				$active_logo_selector = "header.main-header.rsls-initialized.rsls-id-{$entry['id']}";
				
				// Logo
				if ( is_array( $logo['logo'] ) ) {
					unset( $logo['logo']['sizes'] );
					$entry['logo'] = $logo['logo'];
					
					generate_custom_style( "{$active_logo_selector}.rsls-has-active-logo .header-logo .rsls-id-{$entry['id']}", "visibility: visible; opacity: 1; -webkit-opacity: 1; -moz-opacity: 1; filter: alpha(opacity=100)" );
				}
				
				// Custom Logo Width
				if ( $entry['logoWidth'] ) {
					generate_custom_style( "{$active_logo_selector}.rsls-has-active-logo .header-logo", "width: {$entry['logoWidth']}px;" );
				}
				
				// Transparent Background
				if ( $logo['transparent_background'] ) {
					generate_custom_style( "{$active_logo_selector}", 'background: transparent !important;' );
				}
				
				// No Bottom Border and Shadow
				if ( $logo['no_bottom_border'] ) {
					generate_custom_style( "{$active_logo_selector}", 'border-bottom-color: transparent !important;' );
					generate_custom_style( "{$active_logo_selector}", 'box-shadow: none; -webkit-box-shadow: none !important; -moz-box-shadow: none !important; -ms-box-shadow: none !important;' );
				}
				
				$custom_logos_json[] = $entry;
			}
			
			?>
			<script type="text/javascript">
				var revSliderCustomLogos = <?php echo json_encode( $custom_logos_json ); ?>;
			</script>
			<?php
		}
	}
}


// Open Graph Meta
add_action( 'wp_head', 'kalium_wp_head_open_graph_meta', 5 );

function kalium_wp_head_open_graph_meta() {
	global $post;
	
	// Only show if open graph meta is allowed
	if ( ! apply_filters( 'kalium_open_graph_meta', true ) ) {
		return;
	}
	
	// Do not show open graph meta on single posts
	if ( ! is_singular() ) {
		return;
	}

	$image = '';
	
	if ( has_post_thumbnail( $post->ID ) ) {
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'original' );
		$image = esc_attr( $featured_image[0] );
	}

	?>

	<meta property="og:type" content="article"/>
	<meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>"/>
	<meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>"/>
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
	<meta property="og:description" content="<?php echo esc_attr( get_the_excerpt() ); ?>"/>

	<?php if ( '' != $image ) : ?>
	<meta property="og:image" content="<?php echo $image; ?>"/>
	<?php endif;
}