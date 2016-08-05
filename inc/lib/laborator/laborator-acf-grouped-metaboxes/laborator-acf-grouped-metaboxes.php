<?php
/**
 *	Grouping of ACF Metaboxes
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $lab_acf_metaboxes;

$lab_acf_metaboxes = array(
	 array(
		'id'	=> 4398,
		'slug'	=> 'acf_audio-post-format-settings',
		'icon'	=> 'volume-up',
	),
	 array(
		'id'	=> 2896,
		'slug'	=> 'acf_video-post-format-settings',
		'icon'	=> 'video-camera',
	),
	 array(
		'id'	=> 2873,
		'slug'	=> 'acf_post-slider-images',
		'icon'	=> 'image',
	),
	 array(
		'id'	=> 1981,
		'slug'	=> 'acf_portfolio-settings',
		'icon'	=> 'file-text',
	),
	 array(
		'id'	=> 1823,
		'slug'	=> 'acf_portfolio-item-type',
		'icon'	=> 'th',
	),
	 array(
		'id'	=> 1825,
		'slug'	=> 'acf_side-portfolio-portfolio-type-1',
		'icon'	=> 'check',
	),
	 array(
		'id'	=> 1912,
		'slug'	=> 'acf_columned-portfolio-type-2',
		'icon'	=> 'check',
	),
	 array(
		'id'	=> 1916,
		'slug'	=> 'acf_carousel-portfolio-type-3',
		'icon'	=> 'check',
	),
	 array(
		'id'	=> 1919,
		'slug'	=> 'acf_zig-zag-portfolio-type-4',
		'icon'	=> 'check',
	),
	 array(
		'id'	=> 1943,
		'slug'	=> 'acf_fullscreen-portfolio-type-5',
		'icon'	=> 'check',
	),
	 array(
		'id'	=> 4460,
		'slug'	=> 'acf_lightbox-portfolio-type-6',
		'icon'	=> 'check',
	),
	 array(
		'id'	=> 1909,
		'slug'	=> 'acf_general-details',
		'icon'	=> 'wrench',
	),
	 array(
		'id'	=> 1908,
		'slug'	=> 'acf_project-link',
		'icon'	=> 'link',
	),
	 array(
		'id'	=> 1907,
		'slug'	=> 'acf_checklists',
		'icon'	=> 'list',
	),
	 array(
		'id'	=> 1904,
		'slug'	=> 'acf_portfolio-gallery',
		'icon'	=> 'image',
	),
	 array(
		'id'	=> 1913,
		'slug'	=> 'acf_portfolio-gallery-2',
		'icon'	=> 'image',
	),
	 array(
		'id'	=> 1917,
		'slug'	=> 'acf_portfolio-gallery-3',
		'icon'	=> 'image',
	),
	 array(
		'id'	=> 1921,
		'slug'	=> 'acf_portfolio-gallery-4',
		'icon'	=> 'image',
	),
	 array(
		'id'	=> 2070,
		'slug'	=> 'acf_other-settings',
		'icon'	=> 'cog',
	),
	 array(
		'id'	=> 1763,
		'slug'	=> 'acf_page-options',
		'icon'	=> 'toggle-on',
	),
	 array(
		'id'	=> 1774,
		'slug'	=> 'acf_post-settings',
		'icon'	=> 'file-text-o',
	),
	array(
		'id'	=> 4660,
		'slug'	=> 'acf_custom-css',
		'icon'	=> 'code',
	),
);

/*
	To retrieve the list array list, execute this JS snippet in Console (Make sure you are in Custom Fields page):
	
	====== START ======
	
	var arr = '$lab_acf_metaboxes = array(' + "\n";
	
	jQuery( '.post_name' ).each( function( i, el ) {
		var id = jQuery( this ).parent().attr( 'id' ).replace( 'inline_', '' ),
			id_str = jQuery( el ).text();
		
		arr += "\t array(\n\t\t'id'\t=> " + id + ",\n\t\t'slug'\t=> '" + id_str + "',\n\t\t'icon'\t=> '',\n\t),\n";
	} );
	
	arr += "\n);";
	
	console.clear();
	arr;
	
	====== END ======
*/

if ( function_exists( 'is_acf_pro_activated' ) && is_acf_pro_activated() ) {
	// Grouped ACF is not supported for ACF Pro
	return;
}


// Setup Admin UI for Grouped ACF Metaboxes
if ( is_admin() ) {
	add_action( 'add_meta_boxes', 'lab_acf_grouped_metaboxes_init', 10, 2 );
	
}

function lab_acf_grouped_metaboxes_init( $post_type, $post ) {
	
	$loading_indicaator = '<div class="panel-loading-indicator"><i class="fa fa-circle-o-notch fa-spin"></i></div>';
	$allowed_post_types = array( 'post', 'page', 'portfolio', 'product' );
	
	if ( in_array( $post_type, $allowed_post_types ) ) {	
		add_meta_box( 'lab-acf-grouping-metabox', $loading_indicaator . 'Parameters and Options', 'lab_acf_grouped_metaboxes_container', $post_type, 'normal', 'high' );
		lab_acf_grouped_metaboxes_load();
	}
}

function lab_acf_grouped_show_styles() {
	global $lab_acf_metaboxes;
	
	?>
	<style>
		<?php
		foreach ( $lab_acf_metaboxes as $acf_metabox ) {
			$acf_dom_id = 'acf_' . ( defined( 'ACF_LITE' ) ? $acf_metabox['slug'] : $acf_metabox['id'] );
			#$acf_dom_id = 'acf_' . $acf_metabox['slug'];
			echo "#{$acf_dom_id} { display: none; }\n";
			echo "#{$acf_dom_id}.lab-acf-visible { display: block !important; }\n";
		}
		?>
	</style>
	<?php
}

function lab_acf_grouped_metaboxes_load() {
	
	global $lab_acf_metaboxes;
	
		
	// Load Resources
	wp_enqueue_style( 'laborator-acf-grouped', THEMEURL . 'inc/lib/laborator/laborator-acf-grouped-metaboxes/laborator-acf-grouped.css', null, '1.0' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_enqueue_script( 'tweenlite' );
	wp_enqueue_script( 'laborator-acf-grouped', THEMEURL . 'inc/lib/laborator/laborator-acf-grouped-metaboxes/laborator-acf-grouped.js' );
	
	// Hide Metaboxes
	add_action( 'admin_footer', 'lab_acf_grouped_show_styles' );
}

function lab_acf_grouped_metaboxes_container() {
	
	global $lab_acf_metaboxes;
	
	?>
	<script>
		var lab_acf_metaboxes = <?php echo json_encode( $lab_acf_metaboxes ); ?>;
	</script>
	
	
	<div class="laborator-acf-grouped-container">
		<?php /*<div class="laborator-acf-grouped-header">
			<h2>
				<div class="panel-loading-indicator">
					<i class="fa fa-circle-o-notch fa-spin"></i>
				</div>
				Options and Parameters
			</h2>
		</div>*/ ?>
		
		<div class="laborator-acf-grouped">
			<div class="loading-options-indicator">
				<span>
					<i class="fa fa-circle-o-notch fa-spin"></i>
					Loading Options...
				</span>
			</div>
			<ul class="lab-acf-grouped-tabs"></ul>
			<div class="lab-acf-grouped-tabs-container"></div>
		</div>
	</div>
	<?php
}