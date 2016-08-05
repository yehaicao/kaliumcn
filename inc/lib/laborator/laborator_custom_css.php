<?php
/**
 *	Custom Theme CSS
 *
 *	Version: 1.0
 *	Date: 11/22/14
 *
 *	Developed by: Arlind
 *	URL: www.laborator.co
 */


add_action( 'admin_menu', 'lab_custom_css_menu' );
add_action( 'wp_head', 'lab_custom_css_wp_print_styles' );
add_action( 'admin_print_styles', 'lab_custom_css_admin_print_styles' );

function lab_custom_css_menu() {
	add_menu_page( 'Custom CSS', 'Custom CSS', 'edit_theme_options', 'laborator_custom_css', 'laborator_custom_css_page' );
}

function laborator_custom_css_page() {
	if ( isset( $_POST['laborator_custom_css'] ) ) {
		$laborator_custom_css = post( 'laborator_custom_css' );
		laborator_set_custom_css( $laborator_custom_css );
		$success = true;
	}

	if ( isset( $_POST['laborator_custom_css_lg'] ) ) {
		$laborator_custom_css = post( 'laborator_custom_css_lg' );
		laborator_set_custom_css($laborator_custom_css, 'lg' );
		$success = true;
	}

	if ( isset( $_POST['laborator_custom_css_md'] ) ) {
		$laborator_custom_css = post( 'laborator_custom_css_md' );
		laborator_set_custom_css( $laborator_custom_css, 'md' );
		$success = true;
	}

	if ( isset( $_POST['laborator_custom_css_sm'] ) ) {
		$laborator_custom_css = post( 'laborator_custom_css_sm' );
		laborator_set_custom_css( $laborator_custom_css, 'sm' );
		$success = true;
	}

	if ( isset( $_POST['laborator_custom_css_xs'] ) ) {
		$laborator_custom_css = post( 'laborator_custom_css_xs' );
		laborator_set_custom_css( $laborator_custom_css, 'xs' );
		$success = true;
	}


	if ( isset( $_POST['laborator_custom_css_less'] ) ) {
		$laborator_custom_css = post( 'laborator_custom_css_less' );
		laborator_set_custom_css( $laborator_custom_css, 'less' );
		$success = true;
	}

	if ( isset( $_POST['laborator_custom_css_sass'] ) ) {
		$laborator_custom_css = post( 'laborator_custom_css_sass' );
		laborator_set_custom_css( $laborator_custom_css, 'sass' );
		$success = true;
	}


	if ( isset( $success ) ) {
		?>
		<div class="updated">
			<p>
				<strong>Changes have been saved.</strong>
			</p>
		</div>
		<?php
	}

	$codemirror_path = THEMEURL . "inc/lib/laborator/custom-css-lib/codemirror-4.7/";

	$custom_css    = laborator_get_custom_css();
	$custom_css_lg = laborator_get_custom_css( 'lg' );
	$custom_css_md = laborator_get_custom_css( 'md' );
	$custom_css_sm = laborator_get_custom_css( 'sm' );
	$custom_css_xs = laborator_get_custom_css( 'xs' );

	$custom_css_less = laborator_get_custom_css( 'less' );
	$custom_css_sass = laborator_get_custom_css( 'sass' );

	$current_tab = 'main';

	if ( lab_get( 'tab' ) == 'responsive') {
		$current_tab = 'responsive';
	}

	if ( lab_get( 'tab' ) == 'less') {
		$current_tab = 'less';
	}

	if ( lab_get( 'tab' ) == 'sass') {
		$current_tab = 'sass';
	}
?>
<!-- CodeMirror -->
<script src="<?php echo $codemirror_path . 'lib/codemirror.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo $codemirror_path . 'lib/codemirror.css'; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo $codemirror_path . 'theme/neo.css'; ?>" type="text/css">

<!-- Search -->
<script src="<?php echo $codemirror_path . 'addon/search/searchcursor.js'; ?>"></script>
<script src="<?php echo $codemirror_path . 'addon/search/search.js'; ?>"></script>

<!-- Dialog -->
<script src="<?php echo $codemirror_path . 'addon/dialog/dialog.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo $codemirror_path . 'addon/dialog/dialog.css'; ?>" type="text/css">

<!-- Mode -->
<script src="<?php echo $codemirror_path . 'mode/css/css.js'; ?>"></script>


<div class="wrap">

	<h2 id="main-title">Custom CSS</h2>

	<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
		<a href="?page=<?php echo lab_get( 'page' ); ?>&tab=main" class="nav-tab<?php echo $current_tab == 'main' ? ' nav-tab-active' : ''; ?>">General Style</a>
		<a href="?page=<?php echo lab_get( 'page' ); ?>&tab=responsive" class="nav-tab<?php echo $current_tab == 'responsive' ? ' nav-tab-active' : ''; ?>">Responsive</a>
		<a href="?page=<?php echo lab_get( 'page' ); ?>&tab=less" class="nav-tab<?php echo $current_tab == 'less' ? ' nav-tab-active' : ''; ?>">LESS</a>
		<a href="?page=<?php echo lab_get( 'page' ); ?>&tab=sass" class="nav-tab<?php echo $current_tab == 'sass' ? ' nav-tab-active' : ''; ?>">SASS</a>
		<a href="<?php echo home_url(); ?>" target="_blank" class="nav-tab nav-tab-right">Preview Site</a>
	</h2>

	<?php if ( $current_tab == 'main'): ?>
	<h3>Apply your own stylesheet here</h3>

	<form method="post">
		<textarea class="large-text code" id="laborator_custom_css" name="laborator_custom_css" rows="10" placeholder="Loading code editor..."><?php echo $custom_css; ?></textarea>
		<button type="submit" class="button button-primary save" name="save_changes">Save Changes</button>
	</form>

	<script type="text/javascript">
	window.onload = function()
	{
		var cmirror = CodeMirror.fromTextArea(document.getElementById("laborator_custom_css"), {
				lineNumbers: true,
				autofocus: true,
				mode: "css",
				theme: "neo",
				tabSize: 4,
				indentUnit: 4,
				indentWithTabs: true
			}),
			body = document.body,
			html = document.documentElement;

		var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight ) - 340;

		cmirror.setSize("100%", height);
	}
	</script>

	<?php elseif ( $current_tab == 'responsive'): ?>
	<h3>Targeting custom screen sizes</h3>

	<form method="post">
		<h4>
			<small>
				Minimum Screen Size: <strong>1200px</strong>
			</small>

			LG - Large Screen
		</h4>

		<textarea class="large-text code" id="laborator_custom_css_lg" name="laborator_custom_css_lg" rows="10" placeholder="Loading code editor..."><?php echo $custom_css_lg; ?></textarea>


		<h4>
			<small>
				Minimum Screen Size: <strong>992px</strong>
			</small>

			MD - Medium Screen
		</h4>

		<textarea class="large-text code" id="laborator_custom_css_md" name="laborator_custom_css_md" rows="10" placeholder="Loading code editor..."><?php echo $custom_css_md; ?></textarea>


		<h4>
			<small>
				Minimum Screen Size: <strong>768px</strong>
			</small>

			SM - Small Screen
		</h4>

		<textarea class="large-text code" id="laborator_custom_css_sm" name="laborator_custom_css_sm" rows="10" placeholder="Loading code editor..."><?php echo $custom_css_sm; ?></textarea>


		<h4>
			<small>
				Maximum Screen Size: <strong>768px</strong>
			</small>

			XS - Extra Small Screen
		</h4>

		<textarea class="large-text code" id="laborator_custom_css_xs" name="laborator_custom_css_xs" rows="10" placeholder="Loading code editor..."><?php echo $custom_css_xs; ?></textarea>


		<script type="text/javascript">
		window.onload = function()
		{
			var cmirror1 = CodeMirror.fromTextArea(document.getElementById("laborator_custom_css_lg"), {lineNumbers: true, mode: "css", theme: "neo", tabSize: 4, indentUnit: 4, indentWithTabs: true}),
				cmirror2 = CodeMirror.fromTextArea(document.getElementById("laborator_custom_css_md"), {lineNumbers: true, mode: "css", theme: "neo", tabSize: 4, indentUnit: 4, indentWithTabs: true}),
				cmirror3 = CodeMirror.fromTextArea(document.getElementById("laborator_custom_css_sm"), {lineNumbers: true, mode: "css", theme: "neo", tabSize: 4, indentUnit: 4, indentWithTabs: true}),
				cmirror4 = CodeMirror.fromTextArea(document.getElementById("laborator_custom_css_xs"), {lineNumbers: true, mode: "css", theme: "neo", tabSize: 4, indentUnit: 4, indentWithTabs: true});

			cmirror1.setSize("100%", "100%");
			cmirror2.setSize("100%", "100%");
			cmirror3.setSize("100%", "100%");
			cmirror4.setSize("100%", "100%");
		}
		</script>


		<button type="submit" class="button button-primary save" name="save_changes">Save Changes</button>
	</form>
	<?php elseif ( $current_tab == 'less'): ?>
	<h3>Apply your own style in <a href="http://www.lesscss.org/" target="_blank">LESS</a> language</h3>

	<form method="post">
		<textarea class="large-text code" id="laborator_custom_css_less" name="laborator_custom_css_less" rows="10" placeholder="Loading code editor..."><?php echo $custom_css_less; ?></textarea>
		<button type="submit" class="button button-primary save" name="save_changes">Save Changes</button>
	</form>

	<script src="<?php echo $codemirror_path . "mode/sass/sass.js"; ?>"></script>
	<script type="text/javascript">
	window.onload = function()
	{
		var cmirror = CodeMirror.fromTextArea(document.getElementById("laborator_custom_css_less"), {
				lineNumbers: true,
				autofocus: true,
				mode: "sass",
				theme: "neo",
				tabSize: 4,
				indentUnit: 4,
				indentWithTabs: true
			}),
			body = document.body,
			html = document.documentElement;

		var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight ) - 340;

		cmirror.setSize("100%", height);
	}
	</script>
	<?php elseif ( $current_tab == 'sass'): ?>
	<h3>Apply your own style in <a href="http://sass-lang.com/" target="_blank">SASS</a> language</h3>

	<form method="post">
		<textarea class="large-text code" id="laborator_custom_css_sass" name="laborator_custom_css_sass" rows="10" placeholder="Loading code editor..."><?php echo $custom_css_sass; ?></textarea>
		<button type="submit" class="button button-primary save" name="save_changes">Save Changes</button>
	</form>

	<script src="<?php echo $codemirror_path . "mode/sass/sass.js"; ?>"></script>
	<script type="text/javascript">
	window.onload = function()
	{
		var cmirror = CodeMirror.fromTextArea(document.getElementById("laborator_custom_css_sass"), {
				lineNumbers: true,
				autofocus: true,
				mode: "sass",
				theme: "neo",
				tabSize: 4,
				indentUnit: 4,
				indentWithTabs: true
			}),
			body = document.body,
			html = document.documentElement;

		var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight ) - 340;

		cmirror.setSize("100%", height);
	}
	</script>
	<?php endif; ?>

	<p class="explain">
		For better experience with CSS Editor:<br />

		Start Searching:
		<code>Ctrl-F / Cmd-F</code>
		<br />

		Find next:
		<code>Ctrl-G / Cmd-G</code>
		<br />

		Find previous:
		<code>Shift-Ctrl-G / Shift-Cmd-G</code>
		<br />

		Replace:
		<code>Shift-Ctrl-F / Cmd-Option-F</code>
		<br />

		Replace all:
		<code>Shift-Ctrl-R / Shift-Cmd-Option-F</code>
	</p>

	<p class="footer">
		* The CSS written here will not be lost when you update the theme. <br />
		* Please be aware as by doing customisation (in theme files) if something happens like miss-editing files the responsibility is yours and we won't support you on finding the problem, as we are only guiding you how to get the results you need. <br />
		* Sometimes you need to add <code>!important</code> rule to overwrite the default value set by the theme, example: <code>font-size: 18px <strong>!important</strong></code>.
	</p>

	<p class="laborator-copyrights clear">&copy; <strong>Custom CSS</strong> plugin created by <a href="http://laborator.co/" target="_blank">Laborator.co</a></p>

	<style>
		#main-title {
			margin-left: 10px;
			margin-bottom: 5px;
		}

		form h4 {
			margin: 0;
			margin-bottom: 3px;
			padding: 5px 15px;
			text-transform: uppercase;
			background: #fff;
			border: 1px solid #e0e0e0;
		}

		form h4 small {
			float: right;
			color: #999;
		}

		form h4 small strong {
			color: #111;
			text-decoration: underline;
		}

		form .CodeMirror + h4,
		form textarea + h4 {
			margin-top: 25px !important;
		}

		.CodeMirror {
			border: 1px solid #e0e0e0;
			min-height: 150px;
		}

		.CodeMirror .CodeMirror-scroll {
			min-height: 150px;
		}

		.wp-core-ui .button-primary.save {
			margin-top: 15px;
		}

		.updated {
			margin-top: 15px !important;
		}

		p.footer {
			margin-top: 30px;
			margin-bottom: 25px;
			font-size: 11px;
			color: #777;
			width: 100%;
		}

		p.footer code {
			font-size: 11px;
		}

		p.explain {
			float: right;
			display: none;
			font-size: 11px;
			width: 25%;
			text-align: right;
		}

		p.explain code {
			color: #444;
			font-size: 10px;
			text-transform: uppercase;
		}

		.nav-tab-right {
			float: right;
			top: 2px;
			position: relative;
			margin-right: -5px;
		}

		.laborator-copyrights {
			margin: 0;
			font-size: 11px;
			position: relative;
			border-top: 1px solid #ddd;
			padding-top: 8px;
			color: #888;
			margin-bottom: 5px;
			margin-top: 5px;
		}
	</style>
</div>
<?php
}

function laborator_get_custom_css( $ex = '' ) {
	$default = "body {\n}";

	if ( in_array( $ex, array( 'lg', 'md', 'sm', 'xs' ) ) ) {
		$default = '';
	}
	
	if ( $ex == 'less' ) {
		$default = "@my-var: #ccc;\n@my-other-var: #fff;\n\n.any-container {\n\t.nested-container {\n\t\tcolor: @my-var;\n\t}\n}";
	} elseif ( $ex == 'sass' ) {
		$default = "\$color: #abc;\n\ndiv.example-el {\n\tcolor: lighten(\$color, 20%);\n}";
	}

	if ( ! is_admin() ) {
		$default = '';
	}

	return trim( stripslashes( get_option( 'laborator_custom_css' . ( $ex ? "_{$ex}" : '' ), $default ) ) );
}

function laborator_set_custom_css( $css, $ex = '' ) {
	
	// Compile Less Instantly
	if ( $ex == 'less' ) {
		if ( ! class_exists( 'lessc' ) ) {
			require_once( 'custom-css-lib/lessc.inc.php' );
		}

		$less = new lessc;
		$compiled_less = '';

		try {
			$compiled_less = $less->compile( $css );
			update_option( "laborator_custom_css_{$ex}_compiled", $compiled_less );
		}
		catch (Exception $e){}
	}
	
	
	// Compile Sass Instantly
	if ( $ex == 'sass' ) {
		if ( ! class_exists( 'sassc' ) ) {
			require_once( 'custom-css-lib/scss.inc.php' );
		}

		$scss = new scssc;
		$compiled_sass = '';

		try {
			$compiled_sass = $scss->compile( $css );
			update_option( "laborator_custom_css_{$ex}_compiled", $compiled_sass );
		} catch ( Exception $e ){}
	}
	
	update_option( 'laborator_custom_css' . ( $ex ? "_{$ex}" : '' ), $css );
}


function lab_custom_css_wp_print_styles() {
	$screen_lg = 1200;
	$screen_md = 992;
	$screen_sm = 480;
	$screen_xs = 480;

	$custom_css    = laborator_get_custom_css();
	$custom_css_lg = laborator_get_custom_css( 'lg' );
	$custom_css_md = laborator_get_custom_css( 'md' );
	$custom_css_sm = laborator_get_custom_css( 'sm' );
	$custom_css_xs = laborator_get_custom_css( 'xs' );

	$custom_css_less = laborator_get_custom_css( 'less_compiled' );
	$custom_css_sass = laborator_get_custom_css( 'sass_compiled' );

	$custom_css_append = '';

	if ( $custom_css ) {
		$custom_css_append .= $custom_css;
		$custom_css_append .= PHP_EOL . PHP_EOL;
	}


	# XS - Media Screen CSS
	if ( $custom_css_xs ) {
		$custom_css_append .= "@media screen and (max-width: {$screen_xs}px){" . PHP_EOL;
		$custom_css_append .= $custom_css_xs . PHP_EOL;
		$custom_css_append .= '}';
		$custom_css_append .= PHP_EOL . PHP_EOL;
	}

	# SM - Media Screen CSS
	if ( $custom_css_sm ) {
		$custom_css_append .= "@media screen and (min-width: {$screen_sm}px){" . PHP_EOL;
		$custom_css_append .= $custom_css_sm . PHP_EOL;
		$custom_css_append .= '}';
		$custom_css_append .= PHP_EOL . PHP_EOL;
	}

	# MD - Media Screen CSS
	if ( $custom_css_md ) {
		$custom_css_append .= "@media screen and (min-width: {$screen_md}px){" . PHP_EOL;
		$custom_css_append .= $custom_css_md . PHP_EOL;
		$custom_css_append .= '}';
		$custom_css_append .= PHP_EOL . PHP_EOL;
	}

	# LG - Media Screen CSS
	if ( $custom_css_lg ) {
		$custom_css_append .= "@media screen and (min-width: {$screen_lg}px){" . PHP_EOL;
		$custom_css_append .= $custom_css_lg . PHP_EOL;
		$custom_css_append .= '}';
		$custom_css_append .= PHP_EOL . PHP_EOL;
	}


	# LESS CSS
	if ( $custom_css_less ) {
		$custom_css_append .= $custom_css_less;
		$custom_css_append .= PHP_EOL . PHP_EOL;
	}


	# SASS CSS
	if ( $custom_css_sass ) {
		$custom_css_append .= $custom_css_sass;
		$custom_css_append .= PHP_EOL . PHP_EOL;
	}


	if ( $custom_css_append = trim( $custom_css_append ) ) {
		echo '<style id="theme-custom-css">' . PHP_EOL . compress_text( $custom_css_append ) . PHP_EOL . '</style>';
	}
}


function lab_custom_css_admin_print_styles() {
	?>
	<style>

	#toplevel_page_laborator_custom_css .wp-menu-image {
		background: url(<?php echo THEMEURL . "inc/lib/laborator/custom-css-lib/custom-css-icon.png"; ?>) no-repeat 11px 8px !important;
		background-size: 16px 48px !important;
		-moz-background-size: 16px 48px !important;
		-webkit-background-size: 16px 48px !important;
	}

	#toplevel_page_laborator_custom_css .wp-menu-image:before {
		display: none;
	}

	#toplevel_page_laborator_custom_css .wp-menu-image img {
		display: none;
	}

	#toplevel_page_laborator_custom_css:hover .wp-menu-image, 
	#toplevel_page_laborator_custom_css.wp-has-current-submenu .wp-menu-image, 
	#toplevel_page_laborator_custom_css.current .wp-menu-image {
		background-position: 11px -24px !important;
	}

	</style>
	<?php
}


# Export
if ( lab_get( 'lab-custom-css-export' ) && is_admin() ) {
	$custom_css    = laborator_get_custom_css();
	$custom_css_lg = laborator_get_custom_css( 'lg' );
	$custom_css_md = laborator_get_custom_css( 'md' );
	$custom_css_sm = laborator_get_custom_css( 'sm' );
	$custom_css_xs = laborator_get_custom_css( 'xs' );

	$custom_css_less = laborator_get_custom_css( 'less' );
	$custom_css_sass = laborator_get_custom_css( 'sass' );

	$options = array(
		'laborator_custom_css' => $custom_css,

		'laborator_custom_css_lg' => $custom_css_lg,
		'laborator_custom_css_md' => $custom_css_md,
		'laborator_custom_css_sm' => $custom_css_sm,
		'laborator_custom_css_lg' => $custom_css_xs,

		'laborator_custom_css_less' => $custom_css_less,
		'laborator_custom_css_sass' => $custom_css_sass,
	);

	echo base64_encode( json_encode( $options ) );

	exit;
}