<?php
/**
 *	Masonry Portfolio Items
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url(str_replace(ABSPATH, '', $lab_vc_element_path));
$lab_vc_element_icon    = $lab_vc_element_url . 'masonry.png';


// Portfolio Items
vc_map( array(
	'base'                     => 'lab_masonry_portfolio',
	'name'                     => 'Masonry Portfolio',
	"description"              => "Custom portfolio boxes",
	"content_element"          => true,
	"show_settings_on_create"  => true,
	"as_parent"                => array('only' => 'lab_masonry_portfolio_item'),
	'category'                 => 'Laborator',
	'icon'                     => $lab_vc_element_icon,
	'params'                   => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'value'          => '',
			'description'	 => 'Main title of this widget. (Optional)'
		),
		array(
			'type'           => 'textarea',
			'heading'        => 'Description',
			'param_name'     => 'description',
			'value'          => '',
			'description'	 => 'Description under main portfolio title. (Optional)'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Category Filter',
			'param_name'     => 'category_filter',
			'value'          => array(
				'Yes' => 'yes',
				'No'  => 'no',
			),
			'description'    => 'Show category filter above the portfolio items.',
		),
		array(
			'group'			 => 'Layout',
			'type'           => 'dropdown',
			'heading'        => 'Reveal Effect',
			'param_name'     => 'reveal_effect',
			'std'            => 'inherit',
			'value'          => array(
				'Inherit from Theme Options'    => 'inherit',
				'None'                          => 'none',
				'Fade'                          => 'fade',
				'Slide and Fade'                => 'slidenfade',
				'Zoom In'                       => 'zoom',
				'Fade (one by one)'             => 'fade-one',
				'Slide and Fade (one by one)'   => 'slidenfade-one',
				'Zoom In (one by one)'          => 'zoom-one',
			),
			'description' => 'Reveal effect for portfolio items.'
		),
		
		array(
			'group' => 'Layout',
			'type' => 'dropdown',
			'param_name' => 'portfolio_spacing',
			'value' => array(
				'Inherit from Theme Options'    => 'inherit',
				'Yes'                           => 'yes',
				'No'                            => 'no',
			),
			'heading' => 'Item Spacing',
			'description' => 'Spacing between portfolio items.'
		),
		array(
			'group'			 => 'Pagination',
			'type'           => 'dropdown',
			'heading'        => 'Pagination Type',
			'param_name'     => 'pagination_type',
			'description'    => 'Select pagination type to use with this widget.',
			'std'			 => 'static',
			'value'          => array(
				'No "Show More" button'     => 'hide',
				'Static "Show More" button' => 'static',
				'Endless Pagination'        => 'endless',
			),
		),
		array(
			'group'			 => 'Pagination',
			'type'           => 'vc_link',
			'heading'        => 'More Link',
			'param_name'     => 'more_link',
			'value'          => '',
			'description'	 => 'This will show "More" button in the end of portfolio items.',
			'dependency' => array(
				'element'   => 'pagination_type',
				'value' => array('static')
			),
		),
		array(
			'group'			 => 'Pagination',
			'type' 			 => 'checkbox',
			'heading' 		 => 'Auto Reveal',
			'param_name' 	 => 'endless_auto_reveal',
			'value' => array(
				'Yes' => 'yes',
			),
			'dependency' => array(
				'element'   => 'pagination_type',
				'value' => array('endless')
			),
		),
		array(
			'group'			 => 'Pagination',
			'type'           => 'textfield',
			'heading'        => 'Show more button text',
			'param_name'     => 'endless_show_more_button_text',
			'value'          => 'Show More',
			'dependency' => array(
				'element'   => 'pagination_type',
				'value' => array('endless')
			),
		),
		array(
			'group'			 => 'Pagination',
			'type'           => 'textfield',
			'heading'        => 'No more items to show text',
			'param_name'     => 'endless_no_more_items_button_text',
			'value'          => 'No more portfolio items to show',
			'dependency' => array(
				'element'   => 'pagination_type',
				'value' => array('endless')
			),
		),
		array(
			'group'			 => 'Pagination',
			'type'           => 'textfield',
			'heading'        => 'Items per Page',
			'param_name'     => 'per_page',
			'value'          => '',
			'description'	 => 'Set the initial number of items you want to show (leave empty to show all added items)',
			'dependency' => array(
				'element'   => 'pagination_type',
				'value' => array('endless')
			),
		),
		array(
			'group'			 => 'Pagination',
			'type'           => 'textfield',
			'heading'        => 'Number of Items to Fetch',
			'param_name'     => 'endless_per_page',
			'value'          => '',
			'description'	 => 'Apart from "Items per Page", you can set custom number of items to fetch when "Show More" is clicked (Optional)',
			'dependency' => array(
				'element'   => 'pagination_type',
				'value' => array('endless')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Extra class name',
			'param_name'     => 'el_class',
			'description'    => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => 'Design options'
		)
	),
	"js_view" => 'VcColumnView'
) );


// Portfolio Item (child of Google Map)
$portfolio_items_list = array();

if( is_admin() ) {
	$portfolio_items = get_posts(array(
		'post_type' => 'portfolio',
		'posts_per_page' => -1
	));
	
	foreach ( $portfolio_items as $portfolio ) {
		$portfolio_items_list[ $portfolio->post_title ] = $portfolio->ID;
	}
}

vc_map( array(
	"base"             => "lab_masonry_portfolio_item",
	"name"             => "Portfolio Item",
	"description"      => "Insert single item",
	"category"         => 'Laborator',
	"content_element"  => true,
	"icon"			   => $lab_vc_element_icon,
	"as_child"         => array( 'only' => 'lab_masonry_portfolio' ),
	'admin_enqueue_js' => $lab_vc_element_url . 'init-lab-masonry.js',
	"params"           => array(
		array(
			'type'           => 'dropdown',
			'heading'        => 'Box Size',
			'admin_label'    => true,
			'param_name'     => 'box_size',
			'value'          => array(
				'8 col - small'     => '8x3',
				'8 col - medium'    => '8x4',
				'8 col - large'     => '8x6',
				
				'6 col - small'     => '6x3',
				'6 col - medium'    => '6x4',
				'6 col - large'     => '6x6',
				
				'5 col - small'     => '5x3',
				'5 col - medium'    => '5x4',
				'5 col - large'     => '5x6',
				
				'4 col - small'     => '4x3',
				'4 col - medium'    => '4x4',
				'4 col - large'     => '4x6',
				
				'3 col - small'     => '3x3',
				'3 col - medium'    => '3x4',
				'3 col - large'     => '3x6',
				
				'12 col - small'    => '12x4',
				'12 col - medium'   => '12x5',
				'12 col - large'    => '12x6',
				
				'9 col - small'     => '9x3',
				'9 col - medium'    => '9x4',
				'9 col - large'     => '9x6',
			),
			'description' => 'Select portfolio type to show items.'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => 'Portfolio Item',
			'admin_label'    => true,
			'param_name'     => 'portfolio_id',
			'value'          => $portfolio_items_list,
			'description' => 'Select an item from portfolio to show in masonry grid. Duplicate Items will be removed.'
		),
	)
) );

class WPBakeryShortCode_Lab_Masonry_Portfolio extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Lab_Masonry_Portfolio_Item extends WPBakeryShortCode {}