<?php
/**
 *	Portfolio Items
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Element Information
$lab_vc_element_path    = dirname( __FILE__ ) . '/';
$lab_vc_element_url     = site_url( str_replace( ABSPATH, '', $lab_vc_element_path ) );
$lab_vc_element_icon    = $lab_vc_element_url . 'portfolio.png';


// Portfolio Items
vc_map( array(
	'base'             => 'lab_portfolio_items',
	'name'             => 'Portfolio Items',
	"description"      => "Show portfolio items",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type' => 'loop',
			'heading' => 'Portfolio Items',
			'param_name' => 'portfolio_query',
			'settings' => array(
				'size' => array('hidden' => false, 'value' => 4 * 3),
				'order_by' => array('value' => 'date'),
				'post_type' => array('value' => 'portfolio', 'hidden' => false)
			),
			'description' => 'Create WordPress loop, to populate content from your site.'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Title',
			'param_name'     => 'title',
			'admin_label'    => true,
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
			'heading'        => 'Portfolio Type',
			'admin_label'    => true,
			'param_name'     => 'portfolio_type',
			'std'            => 'type-1',
			'value'          => array(
				'Thumbnails with Visible Titles'    => 'type-1',
				'Thumbnails with Titles Inside'     => 'type-2',
			),
			'description' => 'Select portfolio type to show items.'
		),
		array(
			'group'			 => 'Layout',
			'type'           => 'dropdown',
			'heading'        => 'Columns',
			'admin_label'    => true,
			'param_name'     => 'columns',
			'std'            => 'inherit',
			'value'          => array(
				'Inherit from Theme Options'    => 'inherit',
				'1 Item per Row'                => 1,
				'2 Items per Row'               => 2,
				'3 Items per Row'               => 3,
				'4 Items per Row'               => 4,
				'5 Items per Row'               => 5,
				'6 Items per Row'               => 6,
			),
			'description' => 'Number of columns to show portfolio items.'
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
			'group'			 => 'Layout',
			'type'           => 'dropdown',
			'heading'        => 'Item Spacing',
			'param_name'     => 'portfolio_spacing',
			'description'    => 'Spacing between portfolio items.',
			'std'			 => 'inherit',
			'value'          => array(
				'Inherit from Theme Options'    => 'inherit',
				'Yes'                       => 'yes',
				'No'                        => 'no',
			),
			'dependency' => array(
				'element'   => 'portfolio_type',
				'value' => array('type-2')
			),
		),
		array(
			'group'			 => 'Layout',
			'type'           => 'dropdown',
			'heading'        => 'Dynamic Image Height',
			'param_name'     => 'dynamic_image_height',
			'description'    => 'Use proportional image height for each item.',
			'std'			 => 'no',
			'value'          => array(
				'Yes'    => 'yes',
				'No'     => 'no',
			),
		),
		array(
			'group'			 => 'Layout',
			'type'           => 'dropdown',
			'heading'        => 'Title and Filter Container',
			'param_name'     => 'portfolio_full_width_title_container',
			'description'    => 'Include title and filter within container.',
			'std'			 => 'yes',
			'value'          => array(
				'Inherit from Theme Options'    => 'inherit',
				'Yes'                           => 'yes',
				'No'                            => 'no',
			),
			'dependency' => array(
				'element'   => 'portfolio_full_width',
				'value' => array('yes','no')
			),
		),
		array(
			'group'			 => 'Layout',
			'type'           => 'dropdown',
			'heading'        => 'Full-width Container',
			'param_name'     => 'portfolio_full_width',
			'description'    => 'Extend portfolio container to the browser edge. <br><small>Note: If you  use full-width container, you need to set this VC row container to <a href="http://drops.laborator.co/16vX6" target="_blank">Full width</a> as well.</small>',
			'std'			 => 'inherit',
			'value'          => array(
				'Inherit from Theme Options'    => 'inherit',
				'Yes'                           => 'yes',
				'No'                            => 'no',
			),
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
	)
) );

class WPBakeryShortCode_Lab_Portfolio_Items extends WPBakeryShortCode {}