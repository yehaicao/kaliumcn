<?php
/**
 *	Theme Options
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

add_action( 'init','of_options' );

/*
	Advanced Folding Instructions
	
	'afolds' => 1 (element container)
	
	
	'afold' => "option_name:value1,value2,value3" (match any)
	'afold' => 'option_name:checked'
	'afold' => 'option_name:notChecked'
	'afold' => 'option_name:hasMedia'
	'afold' => 'option_name:hasNotMedia'
*/

if ( ! function_exists( 'of_options' ) ) {
	
	function of_options() {


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;

$of_options = array();

$show_sidebar_options = array(
	'hide'     => '隐藏侧边栏',
	'right'    => '在右边显示侧边栏',
	'left'     => '在左边显示侧边栏',
);

$endless_pagination_style = array(
	'_1' => '顺滑加载',
	'_2' => '跳跃加载',
);

$menu_type_skins = array(
	'menu-skin-main'   => '默认（初始主题颜色）',
	'menu-skin-dark'   => '黑色（暗）',
	'menu-skin-light'  => '白色（亮）',
);

$lab_social_networks_shortcode = "<code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[lab_social_networks]</code> or <code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[lab_social_networks rounded]</code>";


/***** LOGO ****/
$of_options[] = array( 	'name' 		=> 'Branding',
            'cnname' 		=> '标识',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-cube'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'branding-tabs',
						'tabs'		=> array(
							'branding-main'  => '标识设置',
							'branding-other' => '其他设置',
						)
				);

$of_options[] = array(  'name'   	=> '站点标识',
						'desc'   	=> '输入的文本将作为标识显示',
						'id'   		=> 'logo_text',
						'std'   	=> get_bloginfo('title'),
						'type'   	=> 'text',
						
						'tab_id'	=> 'branding-main'
					);

$of_options[] = array(
						'desc'   	=> '上传自定义LOGO',
						'id'   		=> 'use_uploaded_logo',
						'std'   	=> 0,
						'on'  		=> '开启',
						'off'  		=> '关闭',
						'type'   	=> 'switch',
						'folds'  	=> 1,
						
						'tab_id'	=> 'branding-main',
					);

$of_options[] = array(	'name' 		=> '自定义LOGO',
						'desc' 		=> "上传/选择您的自定义LOGO图像<br><small><span class=\"note\">注意：</span> 如果你想上传SVG格式的LOGO, 请安装 <a href=\"https://wordpress.org/plugins/svg-support/\" target=\"_blank\">SVG支持插件</a>.</small>",
						'id' 		=> 'custom_logo_image',
						'std' 		=> "",
						'type' 		=> 'media',
						'mod' 		=> 'min',
						'fold' 		=> 'use_uploaded_logo',
						'afolds'	=> true,
						
						'tab_id'	=> 'branding-main'
					);

$of_options[] = array( 	'desc' 		=> '设置上传的标志的最大宽度（可选）<br><small><strong>注意</strong>： 如果设置为空，将使用原始LOGO宽度。</small>',
						'id' 		=> 'custom_logo_max_width',
						'std' 		=> "",
						'plc'		=> 'Logo宽度',
						'type' 		=> 'text',
						'numeric'	=> true,
						'fold' 		=> 'use_uploaded_logo',
						'afold'		=> 'custom_logo_image:hasMedia',
						'postfix'	=> 'px',
						
						'tab_id'	=> 'branding-main'
				);

$of_options[] = array( 	'desc' 		=> '设置上传的LOGO在移动设备中的最大宽度（可选）<br><small><strong>注意</strong>： 如果设置为空，它将从上面字段继承LOGO最大宽度。</small>',
						'id' 		=> 'custom_logo_mobile_max_width',
						'std' 		=> "",
						'plc'		=> '移动设备Logo宽度',
						'type' 		=> 'text',
						'numeric'	=> true,
						'fold' 		=> 'use_uploaded_logo',
						'afold'		=> 'custom_logo_image:hasMedia',
						'postfix'	=> 'px',
						
						'tab_id'	=> 'branding-main'
				);


$of_options[] = array(	'name' 		=> '图标',
						'desc' 		=> '请选择 64x64 大小的PNG格式的图标',
						'id' 		=> 'favicon_image',
						'std' 		=> "",
						'type' 		=> 'media',
						'mod' 		=> 'min',
						
						'tab_id'	=> 'branding-other'
					);


$of_options[] = array(	'name' 		=> '苹果触摸图标',
						'desc' 		=> '要求图像大小 114x114 (PNG 格式)',
						'id' 		=> 'apple_touch_icon',
						'std' 		=> "",
						'type' 		=> 'media',
						'mod' 		=> 'min',
						
						'tab_id'	=> 'branding-other'
					);

$of_options[] = array(	'name'		=> 'Google 主题颜色',
						'desc'   	=> "只应用在移动设备上, <a href=\"http://updates.html5rocks.com/2014/11/Support-for-theme-color-in-Chrome-39-for-Android\" target=\"_blank\">点击这里</a> 学习更多",
						'id'   		=> 'google_theme_color',
						'std'   	=> '',
						'type'   	=> 'color',
						
						'tab_id'	=> 'branding-other'
					);
/***** END OF: LOGO ****/

$of_options[] = array( 	'name' 		=> 'Header and Menu',
             'cnname'		=> '页眉和菜单',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-header'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'header-and-menu-tabs',
						'tabs'		=> array(
							'header-settings-menu'           => '菜单设置',
							'header-settings-sticky-menu'    => '置顶菜单',
							'header-settings-position'       => '页眉设置',
							'header-settings-other'          => '其他设置',
						)
				);

$of_options[] = array( 	'name'		=> '页眉位置',         
						'desc' 		=> '页眉位置（LOGO和菜单容器）',
						'id' 		=> 'header_position',
						'std' 		=> 'static',
						'options'	=> array(
							'static' => '静止',
							'absolute' => '绝对',
						),
						'type' 		=> 'select',
						
						'afolds'	=> true,
						
						'tab_id'	=> 'header-settings-position'
				);

$of_options[] = array( 	'desc' 		=> "页眉间距<br><small><span class=\"note\">注意：</span> 如果页眉位置设置为绝对，此设置将生效。</small>",
						'id' 		=> 'header_spacing',
						'std' 		=> "",
						'plc'		=> '默认为： 0',
						'type' 		=> 'text',
						'numeric'	=> true,
						'postfix'	=> 'px',
						
						'afold'		=> 'header_position:absolute',
						
						'tab_id'	=> 'header-settings-position'
				);

$of_options[] = array( 	'name'		=> '页眉垂直填充',
						'desc' 		=> "为页眉设置自定义顶部填充（可选）",
						'id' 		=> 'header_vpadding_top',
						'std' 		=> "",
						'plc'		=> '默认为： 50',
						'type' 		=> 'text',
						'numeric'	=> true,
						'postfix'	=> 'px',
						
						'tab_id'	=> 'header-settings-position'
				);

$of_options[] = array( 	'desc' 		=> "为页眉设置自定义底部填充（可选）",
						'id' 		=> 'header_vpadding_bottom',
						'std' 		=> "",
						'plc'		=> '默认为： 50',
						'type' 		=> 'text',
						'numeric'	=> true,
						'postfix'	=> 'px',
						
						'tab_id'	=> 'header-settings-position'
				);

$of_options[] = array( 	'name' 		=> '满屏宽页眉',
						'desc' 		=> "将页眉容器扩展到浏览器边缘",
						'id' 		=> 'header_fullwidth',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'afold'		=> '',
						
						'tab_id'	=> 'header-settings-position',
				);

$of_options[] = array( 	'name'		=> '主菜单类型',
						'desc' 		=> '设置默认菜单样式为一般站点导航。',
						'id' 		=> 'main_menu_type',
						'std' 		=> 'full-bg-menu',
						'options'	=> array(							
							'full-bg-menu'   => THEMEASSETS . 'images/admin/menu-full-bg.png',
							'standard-menu'  => THEMEASSETS . 'images/admin/menu-standard.png',
							'top-menu'       => THEMEASSETS . 'images/admin/menu-top.png',
							'sidebar-menu'   => THEMEASSETS . 'images/admin/menu-sidebar.png',
						),
						'type' 		=> 'images',
						'descrs'	=> array(
							'full-bg-menu'   => '全背景菜单',
							'standard-menu'  => '标准菜单',
							'top-menu'       => '顶部菜单',
							'sidebar-menu'   => '侧边栏菜单',
						),
						'afolds'	=> true,
						
						'tab_id'	=> 'header-settings-menu'
				);

$of_options[] = array( 	'name' 		=> '全背景菜单设置',
						'desc' 		=> '子菜单指示图标',
						'id' 		=> 'menu_full_bg_submenu_indicator',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'afold'		=> 'main_menu_type:full-bg-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '搜索框放置在最后一个菜单项之后',
						'id' 		=> 'menu_full_bg_search_field',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'afold'		=> 'main_menu_type:full-bg-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '显示版权和社交网络（底部）',
						'id' 		=> 'menu_full_bg_footer_block',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'afold'		=> 'main_menu_type:full-bg-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '菜单对齐（当切换时）',
						'id' 		=> 'menu_full_bg_alignment',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> array(
							'left'                   => '左侧',
							'centered'               => '居中',
							'centered-horizontal'    => '居中 (水平)',
						),
						
						'afold'		=> 'main_menu_type:full-bg-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '选择此菜单类型的调色板',
						'id' 		=> 'menu_full_bg_skin',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> $menu_type_skins,
						'afold'		=> 'main_menu_type:full-bg-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);


$of_options[] = array( 	'name' 		=> '标准菜单',
						'desc' 		=> "仅在点击<strong>菜单栏</strong>时显示菜单链接",
						'id' 		=> 'menu_standard_menu_bar_visible',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						'afold'		=> 'main_menu_type:standard-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> "显示<strong>菜单栏</strong>点击效果",
						'id' 		=> 'menu_standard_menu_bar_effect',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> array(
							'reveal-from-top'    => '从顶部变换',
							'reveal-from-right'  => '从右边变换',
							'reveal-from-left'   => '从左边变换',
							'reveal-from-bottom' => '从底部变换',
							'reveal-fade'        => '仅变色',
						),
						'fold'		=> 'menu_standard_menu_bar_visible',
						'afold'		=> 'main_menu_type:standard-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '选择此菜单类型的调色板',
						'id' 		=> 'menu_standard_skin',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> $menu_type_skins,
						'afold'		=> 'main_menu_type:standard-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);


$of_options[] = array( 	'name' 		=> '顶部菜单设置',
						'desc' 		=> "显示顶部菜单小工具(<a href=\"widgets.php\">管理小工具</a>)",
						'id' 		=> 'menu_top_show_widgets',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '中心菜单项目链接（仅第一级）',
						'id' 		=> 'menu_top_nav_links_center',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$menus_list = array(
	'default'  => '- 主菜单（默认） -'
);

if(is_admin())
{
	$nav_menus = wp_get_nav_menus();
	
	foreach($nav_menus as $item)
	{
		$menus_list["menu-{$item->term_id}"] = $item->name;
	}
}

$of_options[] = array( 	'desc' 		=> '选择顶部菜单的菜单',
						'id' 		=> 'menu_top_menu_id',
						'std' 		=> 'default',
						'type' 		=> 'select',
						'options'	=> array_merge($menus_list, array('-' => '(没有菜单显示)')),
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '每行的菜单项（仅适用于根级别）',
						'id' 		=> 'menu_top_items_per_row',
						'std' 		=> 'items-3',
						'type' 		=> 'select',
						'options'	=> array(
							'items-1'  => '每行1个菜单项',
							'items-2'  => '每行2个菜单项',
							'items-3'  => '每行3个菜单项',
							'items-4'  => '每行4个菜单项',
							'items-5'  => '每行5个菜单项',
							'items-6'  => '每行6个菜单项',
							'items-7'  => '每行7个菜单项',
							'items-8'  => '每行8个菜单项',
						),
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '小工具容器宽度',
						'id' 		=> 'menu_top_widgets_container_width',
						'std' 		=> 'col-6',
						'type' 		=> 'select',
						'options'	=> array(
							'col-3' => '行宽的 25% ',
							'col-4' => '行宽的 33% ',
							'col-5' => '行宽的 40% ',
							'col-6' => '行宽的 50% ',
							'col-7' => '行宽的 60% ',
							'col-8' => '行宽的 65% ',
						),
						'fold'		=> 'menu_top_show_widgets',
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '为顶部菜单设置每行小工具数量',
						'id' 		=> 'menu_top_widgets_per_row',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> array(
							'six'    => '每行2个小工具',
							'four'   => '每行3个小工具',
							'three'  => '每行4个小工具',
						),
						'fold'		=> 'menu_top_show_widgets',
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '选择此菜单类型的调色板',
						'id' 		=> 'menu_top_skin',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> $menu_type_skins,
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> "使顶部菜单包含在页眉中
										<br>
										<small class=\"nowrap\">
											当您不使用顶部菜单作为主菜单时，您可以通过启用此选项来选择包含它
											<br>
											当您要单独显示此菜单类型，通过单击 <strong>.top-menu-toggle</strong> 类的一个元素来启用此选项。
										</small>",
						'id' 		=> 'menu_top_force_include',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						'afold'		=> 'main_menu_type:top-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);


$of_options[] = array( 	'name' 		=> '侧边栏菜单设置',
						'desc' 		=> "显示侧边栏菜单小工具 (<a href=\"widgets.php\">管理小工具</a>)",
						'id' 		=> 'menu_sidebar_show_widgets',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'afold'		=> 'main_menu_type:sidebar-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);


$of_options[] = array( 	'desc' 		=> '选择要用于侧边栏的主菜单',
						'id' 		=> 'menu_sidebar_menu_id',
						'std' 		=> 'default',
						'type' 		=> 'select',
						'options'	=> array_merge($menus_list, array('-' => '(没有菜单显示)')),
						'afold'		=> 'main_menu_type:sidebar-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '侧边栏在浏览器窗口中对齐',
						'id' 		=> 'menu_sidebar_alignment',
						'std' 		=> 'right',
						'type' 		=> 'select',
						'options'	=> array(
							'left'   => '左边',
							'right'  => '右边',
						),
						'fold'		=> 'menu_top_show_widgets',
						'afold'		=> 'main_menu_type:sidebar-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> '选择此菜单类型的调色板',
						'id' 		=> 'menu_sidebar_skin',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> $menu_type_skins,
						'afold'		=> 'main_menu_type:sidebar-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'desc' 		=> "使侧边栏菜单包含在页眉中 
										<br>
										<small class=\"nowrap\">
											当你不使用侧边栏菜单作为主菜单时，您可以通过启用此选项来选择包含它 
											<br>
											当您要单独显示此菜单类型，通过单击<strong>.sidebar-menu-toggle</strong>类的一个元素来启用此选项。
										</small>",
						'id' 		=> 'menu_sidebar_force_include',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						'afold'		=> 'main_menu_type:sidebar-menu',
						
						'tab_id'	=> 'header-settings-menu',
				);

$of_options[] = array( 	'name' 		=> '定制多层菜单标签',
						'desc' 		=> "你能用文本或者文本与图标来替换三道横线图标.<br><small>注意： 如果菜单类型设置为带有可见链接的<strong>标准菜单</strong>，那么此项不可用。</small>",
						'id' 		=> 'menu_hamburger_custom_label',
						'std' 		=> 0,
						'on' 		=> '启用',
						'off' 		=> '禁用',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'tab_id'	=> 'header-settings-other',
				);

$of_options[] = array(	'desc' 		=> "显示文本<br><small><span class=\"note\">注意：</span> 此文本用于&quot;显示菜单&quot; 指示。</small>",
						'id' 		=> 'menu_hamburger_custom_label_text',
						'std'		=> 'MENU',
						'type' 		=> 'text',
						'fold'		=> 'menu_hamburger_custom_label',
						
						'tab_id'	=> 'header-settings-other'
				);

$of_options[] = array(	'desc' 		=> "关闭文本<br><small><span class=\"note\">注意：</span> 此文本用于 &quot;隐藏菜单&quot; 指示。</small>",
						'id' 		=> 'menu_hamburger_custom_label_close_text',
						'std'		=> 'CLOSE',
						'type' 		=> 'text',
						'fold'		=> 'menu_hamburger_custom_label',
						
						'tab_id'	=> 'header-settings-other'
				);
				
$of_options[] = array( 	'desc' 		=> '多层菜单图标可见',
						'id' 		=> 'menu_hamburger_custom_icon_position',
						'std' 		=> 'hide',
						'type' 		=> 'select',
						'options'	=> array(
							'hide'   => '隐藏图标',
							'left'   => '左边',
							'right'  => '右边',
						),
						'fold'		=> 'menu_hamburger_custom_label',
						
						'tab_id'	=> 'header-settings-other'
				);

$of_options[] = array( 	'name' 		=> '移动菜单上的搜索框',
						'desc' 		=> '在移动菜单上显示或隐藏搜索框',
						'id' 		=> 'menu_mobile_search_field',
						'std' 		=> 1,
						'on' 		=> '显示',
						'off' 		=> '隐藏',
						'type' 		=> 'switch',
						
						'tab_id'	=> 'header-settings-other'
				);

$of_options[] = array( 	'name' 		=> '置顶菜单',
						'desc' 		=> '完全使用或禁用置顶菜单',
						'id' 		=> 'header_sticky_menu',
						'std' 		=> 0,
						'on' 		=> '启用',
						'off' 		=> '禁用',
						'type' 		=> 'switch',
						'afolds'	=> 1,
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array(	'desc'   	=> "移动模式下置顶菜单<br><small><span class=\"note\">注意：</span> 启用或禁用移动设备上的置顶菜单。</small>",
						'id'   		=> 'header_sticky_mobile',
						'std'   	=> 1,
						'on' 		=> '开启',
						'off' 		=> '关闭',
						'type'   	=> 'switch',
						'folds'  	=> 1,
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
					);

$of_options[] = array(	'desc'   	=> "自动隐藏模式<br><small><span class=\"note\">注意：</span> 只有当用户向上升滚动时，才显示出置顶菜单。</small>",
						'id'   		=> 'header_sticky_autohide',
						'std'   	=> 0,
						'on' 		=> '开启',
						'off' 		=> '关闭',
						'type'   	=> 'switch',
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
					);

$of_options[] = array( 	'name'		=> '样式选项',
						'desc' 		=> '当置顶菜单活动时，你能使用的背景色',
						'id' 		=> 'header_sticky_bg',
						'std' 		=> '',
						'type' 		=> 'color',
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '置顶菜单背景不透明度<br><small><strong>注意</strong>： 输入从1到100的不透明度值。</small>',
						'id' 		=> 'header_sticky_bg_alpha',
						'std' 		=> '90',
						'min' 		=> '1',
						'step'		=> '1',
						'max' 		=> '100',
						'type' 		=> 'text',
						'numeric'	=> true,
						'postfix'	=> '%',
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array(	'desc' 		=> "活动状态的置顶菜单垂直填充<br /><small><span class=\"note\">注意：</span> 填充页眉LOGO/菜单的上面和下面。</small>",
						'id' 		=> 'header_sticky_vpadding',
						'plc' 		=> '如果你不想改变大小请留空',
						'std'		=> '10',
						'type' 		=> 'text',
						'numeric'	=> true,
						'postfix'	=> 'px',
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '当置顶菜单活动时，请选择使用的皮肤。',
						'id' 		=> 'header_sticky_menu_skin',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> array_merge(array('' => '用户默认'), $menu_type_skins),
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array(	'desc'   	=> "底部边框和阴影<br><small><strong>注意</strong>： 为置顶菜单使用底部边框和（或）阴影。</small>",
						'id'   		=> 'header_sticky_border',
						'std'   	=> 0,
						'on' 		=> '开启',
						'off' 		=> '关闭',
						'type'   	=> 'switch',
						'folds'		=> true,
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
					);

$width_in_pixels = array();
$blur_in_pixels = array();

for ( $i = 0; $i <= 30; $i++ ) {
	$width_in_pixels[] = $i . 'px';
}

for ( $i = 0; $i <= 60; $i++ ) {
	$blur_in_pixels[] = $i . 'px';
}

$border_apply_when_options = array(
	'always'           => '总是',
	'sticky-active'    => '仅在置顶菜单活动时',
	'sticky-inactive'  => '仅在置顶菜单停止时',
);

$of_options[] = array( 	'name'		=> '边框',
						'desc' 		=> '边框颜色（可选）',
						'id' 		=> 'header_sticky_border_color',
						'std' 		=> '',
						'type' 		=> 'color',
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '边框颜色的不透明度',
						'id' 		=> 'header_sticky_border_color_alpha',
						'std' 		=> '100',
						'min' 		=> '1',
						'step'		=> '1',
						'max' 		=> '100',
						'type' 		=> 'text',
						'postfix'	=> '%',
						'numeric'	=> true,
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '边框宽度',
						'id' 		=> 'header_sticky_border_width',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> $width_in_pixels,
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '何时使用边框',
						'id' 		=> 'header_sticky_border_apply_when',
						'std' 		=> 'sticky-active',
						'type' 		=> 'select',
						'options'	=> $border_apply_when_options,
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'name'		=> '阴影',
						'desc' 		=> '阴影颜色（可选）',
						'id' 		=> 'header_sticky_shadow_color',
						'std' 		=> '',
						'type' 		=> 'color',
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '阴影颜色的不透明度',
						'id' 		=> 'header_sticky_shadow_color_alpha',
						'std' 		=> '75',
						'min' 		=> '1',
						'step'		=> '1',
						'max' 		=> '100',
						'type' 		=> 'text',
						'postfix'	=> '%',
						'numeric'	=> true,
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '阴影宽度',
						'id' 		=> 'header_sticky_shadow_width',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> $width_in_pixels,
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '模糊半径',
						'id' 		=> 'header_sticky_shadow_blur',
						'type' 		=> 'select',
						'options'	=> $blur_in_pixels,
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'desc' 		=> '何时使用阴影',
						'id' 		=> 'header_sticky_shadow_apply_when',
						'std' 		=> 'sticky-active',
						'type' 		=> 'select',
						'options'	=> $border_apply_when_options,
						'fold' 		=> 'header_sticky_border',
						
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array(	'name'		=> '自定义LOGO',
						'desc'   	=> '当置顶菜单活动时，切换到自定义LOGO（可选）',
						'id'   		=> 'header_sticky_custom_logo',
						'std'   	=> 0,
						'on'  		=> '开启',
						'off'  		=> '关闭',
						'type'   	=> 'switch',
						'folds'  	=> 1,
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
					);

$of_options[] = array(	#'name'		=> 'Upload Logo',
						'desc' 		=> "为置顶菜单上传/选择你的自定义LOGO图像",
						'id' 		=> 'header_sticky_logo_image_id',
						'std' 		=> "",
						'type' 		=> 'media',
						'mod' 		=> 'min',
						'fold' 		=> 'header_sticky_custom_logo',
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
					);

$of_options[] = array( 	'desc' 		=> "为上传的LOGO设置最大宽度, 主要用于你上传了视网膜(@2x) LOGO时。<br /><small><span class=\"note\">注意：</span> 即使您不上传自定义LOGO，您也可以在置顶菜单中设置当前LOGO的自定义宽度。</small>",
						'id' 		=> 'header_sticky_logo_width',
						'std' 		=> "",
						'plc'		=> '用于置顶菜单的自定义LOGO宽度',
						'type' 		=> 'text',
						'postfix'	=> 'px',
						'numeric'	=> true,
						//'fold' 		=> 'header_sticky_custom_logo',
						'afold' 	=> 'header_sticky_menu:checked',
						
						'tab_id'	=> 'header-settings-sticky-menu',
				);

$of_options[] = array( 	'name' 		=> 'Footer',
            	'cnname' 		=> '页脚',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-sort-amount-asc'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'footer-tabs',
						'tabs'		=> array(
							'footer-general'     => '一般设置',
							'footer-widgets'     => '页脚小工具',
							'footer-custom-js'   => 'JavaScript &amp; 追踪代码',
						)
				);

$of_options[] = array( 	'name' 		=> '页脚的能见度',
						'desc' 		=> '全局显示或隐藏页脚',
						'id' 		=> 'footer_visibility',
						'std' 		=> 1,
						'on' 		=> '显示',
						'off' 		=> '隐藏',
						'type' 		=> 'switch',
						
						'afolds'	=> true,
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'desc' 		=> '设置背景颜色。留空则为透明背景。',
						'id' 		=> 'footer_bg',
						'std' 		=> '#eeeeee',
						'type' 		=> 'color',
						'fold'		=> 'footer_bg_transparent',
						
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'name' 		=> '页脚选项',
						'desc' 		=> '页脚类型<br><small><strong>注意</strong>： 设置此选项将固定页脚放置到封皮之后的窗口底部边缘。</small>',
						'id' 		=> 'footer_fixed',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> array(
							''               => '正常',
							'fixed'          => '固定在底部（没有动画）',
							'fixed-fade'     => '固定到底部使用淡出动画',
							'fixed-slide'    => '固定到底部使用幻灯片动画',
						),
						
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);
				
$of_options[] = array( 	'desc' 		=> '文本颜色<br><small><strong>注意</strong>： 选择“页脚”文本颜色，默认颜色为主题皮肤。</small>',
						'id' 		=> 'footer_style',
						'std' 		=> '',
						'type' 		=> 'select',
						'options'	=> array(
							''           => '默认（基于当前皮肤）',
							'inverted'   => '白色',
						),
						
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'desc' 		=> "全宽页脚<br><small>将页脚容器扩展到浏览器边缘。</small>",
						'id' 		=> 'footer_fullwidth',
						'std' 		=> 0,
						'on' 		=> '开启',
						'off' 		=> '关闭',
						'type' 		=> 'switch',
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'name' 		=> '页脚底部部分',
						'desc' 		=> '启用或移除底部页脚与版权文本',
						'id' 		=> 'footer_bottom_visible',
						'std' 		=> 1,
						'on' 		=> '显示',
						'off' 		=> '隐藏',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'name' 		=> '页脚风格',
						'desc' 		=> '选择你想要使用的底部页脚类型',
						'id' 		=> 'footer_bottom_style',
						'std' 		=> 'horizontal',
						'type' 		=> 'images',
						'options' 	=> array(
							'horizontal' => THEMEASSETS . 'images/admin/footer-style-horizontal.png',
							'vertical'   => THEMEASSETS . 'images/admin/footer-style-vertical.png',
						),
						'fold'		=> 'footer_bottom_visible',
						'descrs'	=> array(
							'horizontal' => '多列',
							'vertical'   => '居中',
						),
						
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'name' 		=> '页脚文本',
						'desc' 		=> '左边页脚-在页脚中的版权文本',
						'id' 		=> 'footer_text',
						'std' 		=> "&copy; Copyright ".date('Y').'. All Rights Reserved',
						'type' 		=> 'textarea',
						'fold'		=> 'footer_bottom_visible',
						
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'desc' 		=> '右边页脚 - 在页脚底部的右边区块的内容<br><small><strong>注意</strong>：您还可以在页脚文本中添加社交网络，例如： ' . $lab_social_networks_shortcode . '</small>',
						'id' 		=> 'footer_text_right',
						'std' 		=> "[lab_social_networks]",
						'type' 		=> 'textarea',
						'fold'		=> 'footer_bottom_visible',
						
						'afold'		=> 'footer_visibility:checked',
						
						'tab_id'	=> 'footer-general',
				);

$of_options[] = array( 	'name' 		=> '页脚小工具',
						'desc' 		=> '显示或隐藏页脚小工具',
						'id' 		=> 'footer_widgets',
						'std' 		=> 1,
						'on' 		=> '显示',
						'off' 		=> '隐藏',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'tab_id'	=> 'footer-widgets',
				);

$of_options[] = array( 	'desc' 		=> '设置拆分窗口的小工具的列数',
						'id' 		=> 'footer_widgets_columns',
						'std' 		=> 'three',
						'type' 		=> 'select',
						'options' 	=> array(
							'one'    => '每行一列',// (1/1)",
							'two'    => '每行两列',// (1/2)",
							'three'  => '每行三列',// (1/3)",
							'four'   => '每行四列',// (1/4)",
							'five'    => '每行五列',// (1/4)",
							'six'    => '每行六列',// (1/6)"
						),
						'fold'		=> 'footer_widgets',
						
						'tab_id'	=> 'footer-widgets',
				);

$of_options[] = array( 	'desc' 		=> "在移动设备中折叠或展开页脚小工具<br><small><span class=\"note\">注意：</span> 用户仍然可以看到页脚小工具（如果折叠），当他们点击<strong>三个点（…）</strong> 的链接时。</small>",
						'id' 		=> 'footer_collapse_mobile',
						'std' 		=> 0,
						'on' 		=> '折叠',
						'off' 		=> '展开',
						'type' 		=> 'switch',
						'fold'		=> 'footer_widgets',
						
						'tab_id'	=> 'footer-widgets',
				);
				
$of_options[] = array( 	'name' 		=> '自定义JavaScript信息',
						'desc' 		=> "",
						'id' 		=> 'portfolio_lb',
						'std' 		=> "
						<h3 style=\"margin: 0 0 10px;\">自定义 JavaScript</h3>
						<p>
							&lt;script&gt;&lt;/script&gt; 标签是可选的。<br>
							建议在页脚添加自定义JavaScript，除非你被要求在页眉添加它。
						</p>",
						'icon' 		=> true,
						'type' 		=> 'info',
						
						'tab_id'	=> 'footer-custom-js'
					);

$of_options[] = array( 	'name' 		=> '页眉 JavaScript',
						'desc' 		=> "在这里添加你的JavaScript代码。输入的代码将被添加到 &lt;head&gt; 标签中。<br /><small><strong>注意</strong>：除非是被要求在页眉放置JavaScript，否则建议把你的JavaScript放置在页脚部分。<a href=\"https://developer.yahoo.com/performance/rules.html#js_bottom=\" target=\"_blank\">学习更多</a></small>",
						'id' 		=> 'user_custom_js_head',
						'std' 		=> "",
						'type' 		=> 'textarea',
						'plc'		=> "// Example\nvar a = 1;\nvar b = 2;\n\nfunction fx( c ) {\n\treturn Math.pow( a + b, c );\n}",
						
						'tab_id'	=> 'footer-custom-js',
				);

$of_options[] = array( 	'name' 		=> '页脚 JavaScript',
						'desc' 		=> "在这里添加你的JavaScript代码。这里输入的代码将添加在页面页脚中。<br /><small><span class=\"note\">例如：</span> Google Analytics （谷歌分析跟踪）代码可以在这里添加。</small>",
						'id' 		=> 'user_custom_js',
						'std' 		=> "",
						'type' 		=> 'textarea',
						'plc'		=> "",
						
						'tab_id'	=> 'footer-custom-js',
				);


// BLOG SETTINGS
$of_options[] = array( 	'name' 		=> 'Blog Settings',
              'cnname' 		=> '博客设置',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-newspaper-o'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'blog-settings-tabs',
						'tabs'		=> array(
							'blog-settings-loop'     => '博客页面',
							'blog-settings-single'   => '文章页面',
							'blog-settings-sharing'  => '分享设置',
							'blog-settings-other'    => '其他设置',
						)
				);
				

$of_options[] = array( 	'name' 		=> "博客标题 & 描述",
						'desc' 		=> '在博客页面显示头部标题和描述',
						'id' 		=> 'blog_show_header_title',
						'std' 		=> 1,
						'on' 		=> '显示',
						'off' 		=> '隐藏',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'tab_id' 	=> 'blog-settings-other',
				);

$of_options[] = array( 	'desc' 		=> '博客头部标题（可选）',
						'id' 		=> 'blog_title',
						'std' 		=> 'Blog',
						'plc'		=> "",
						'type' 		=> 'text',
						'fold'		=> 'blog_show_header_title',
						
						'tab_id' 	=> 'blog-settings-other',
				);

$of_options[] = array( 	'desc' 		=> '头部的博客描述（可选）',
						'id' 		=> 'blog_description',
						'std'		=> 'Our everyday thoughts are presented here'.PHP_EOL."Music, video presentations, photo-shootings and more",
						'plc' 		=> "",
						'type' 		=> 'textarea',
						'type' 		=> 'textarea',
						'fold'		=> 'blog_show_header_title',
						
						'tab_id' 	=> 'blog-settings-other',
 				);

$of_options[] = array( 	'name'		=> '默认博客模板',
						'desc' 		=> '选择你喜欢的博客模板显示博客文章',
						'id' 		=> 'blog_template',
						'std' 		=> 'blog-squared',
						'options'	=> array(
							
							'blog-squared' => THEMEASSETS . 'images/admin/blog-template-squared.png',
							'blog-rounded'   => THEMEASSETS . 'images/admin/blog-template-rounded.png',
							'blog-masonry'   => THEMEASSETS . 'images/admin/blog-template-masonry.png',
						),
						'descrs'	=> array(
							'blog-squared'   => '经典',
							'blog-rounded'   => '圆形',
							'blog-masonry'   => '堆砌',
						),
						'type' 		=> 'images',
						'afolds'	=> true,
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'name' 		=> '侧边栏',
					 	'desc' 		=> "设置侧边栏位置或者隐藏它",
						'id' 		=> 'blog_sidebar_position',
						'std' 		=> 'right',
						'type' 		=> 'select',
						'options' 	=> $show_sidebar_options,
						
						'tab_id' 	=> 'blog-settings-loop',
				);
				
$of_options[] = array( 	'name' 		=> '博客选项',
						'desc' 		=> '缩略图',
						'id' 		=> 'blog_thumbnails',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '文章日期',
						'id' 		=> 'blog_post_date',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '显示文章类型图标',
						'id' 		=> 'blog_post_type_icon',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '支持文章格式',
						'id' 		=> 'blog_post_formats',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-loop',
				);
				
$of_options[] = array( 	'desc' 		=> '使用比例缩略图高度',
						'id' 		=> 'blog_loop_proportional_thumbnails',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '缩略图延时加载',
						'id' 		=> 'blog_post_list_lazy_load',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '在项目上鼠标悬停使用动画眼睛',
						'id' 		=> 'blog_post_hover_animatd_eye',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '列数（仅适用于堆砌风格博客）',
						'id' 		=> 'blog_columns',
						'std' 		=> '_3',
						'options'	=> array(
							'_1' => '1 列',
							'_2' => '2 列',
							'_3' => '3 列',
							'_4' => '4 列'
						),
						'type' 		=> 'select',
						
						'afold'		=> 'blog_template:blog-masonry',
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '缩略图悬停效果',
						'id' 		=> 'blog_thumbnail_hover_effect',
						'std' 		=> 'full-cover',
						'options'	=> array(
							''						 => 'No hover effect',
							'full-cover'             => '低透明度的全覆盖',
							'distanced'              => '低透明度的部分覆盖',
							'full-cover-no-opacity'  => '全覆盖（没有透明的背景）',
							'distanced-no-opacity'   => '部分覆盖（没有透明的背景）',
						),
						'type' 		=> 'select',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '画廊图片自动切换的间隔（0 - 禁用）',
						'id' 		=> 'blog_gallery_autoswitch',
						'std' 		=> "",
						'plc'		=> '默认: 5 (秒)',
						'type' 		=> 'text',
						'numeric'	=> true,
						
						'tab_id' 	=> 'blog-settings-loop',
				);



$of_options[] = array( 	'name' 		=> '分页',
						'desc' 		=> '选择分页类型',
						'id' 		=> 'blog_pagination_type',
						'std' 		=> 'center',
						'type' 		=> 'select',
						'options' 	=> array(
							'normal'         => '正常的分页',
							'endless'        => '无尽滚动',
							'endless-reveal' => "无尽滚动 + 自动显示"
						),
						
						'afolds'	=> true,
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '加载时无尽滚动的分页样式',
						'id' 		=> 'blog_endless_pagination_style',
						'std' 		=> '_1',
						'type' 		=> 'select',
						'options' 	=> $endless_pagination_style,
						
						'afold'		=> 'blog_pagination_type:endless,endless-reveal',
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'desc' 		=> '设置分页位置',
						'id' 		=> 'blog_pagination_position',
						'std' 		=> 'center',
						'type' 		=> 'select',
						'options' 	=> array('left' => '左边', 'center' => '居中', 'right' => '右边'),
						
						'tab_id' 	=> 'blog-settings-loop',
				);

$of_options[] = array( 	'name' 		=> '文章选项',
						'desc' 		=> '单个文章缩略图',
						'id' 		=> 'blog_single_thumbnails',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '作者信息',
						'id' 		=> 'blog_author_info',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '文章日期',
						'id' 		=> 'blog_post_date_single',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '显示分类',
						'id' 		=> 'blog_category',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '显示标签',
						'id' 		=> 'blog_tags',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '显示前后文章链接',
						'id' 		=> 'blog_post_prev_next',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '放置特色图片',
						'id' 		=> 'blog_featured_image_placement',
						'std' 		=> 'container',
						'options'	=> array(
							'container'  => '盒装',
							'full-width' => '全宽',
						),
						'type' 		=> 'select',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '特色图片大小',
						'id' 		=> 'blog_featured_image_size_type',
						'std' 		=> 'default',
						'options'	=> array(
							'default' => '默认缩略图大小',
							'full' 	  => '原始图片大小',
						),
						'type' 		=> 'select',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '放置作者信息',
						'id' 		=> 'blog_author_info_placement',
						'std' 		=> 'left',
						'options'	=> array(
							'left'   => '左侧',
							'right'  => '右侧',
							'bottom' => '在文章下面',
						),
						'type' 		=> 'select',
						'fold'		=> 'blog_author_info',
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'desc' 		=> "特色图像缩略图高度（仅适用于单个文章）。 如果你改变这个值，你需要再次<a href=\"admin.php?page=laborator_docs#regenerate-thumbnails\" target=\"_blank\">重新生成缩略图</a> ",
						'id' 		=> 'blog_thumbnail_height',
						'std' 		=> "",
						'plc'		=> '如果留空表示默认值： 490',
						'type' 		=> 'text',
						'numeric'	=> true,
						
						'tab_id' 	=> 'blog-settings-single',
				);

$of_options[] = array( 	'name' 		=> '分享故事',
						'desc' 		=> '允许或禁止在社交网络上分享博客文章',
						'id' 		=> 'blog_share_story',
						'std' 		=> 0,
						'on' 		=> '允许分享',
						'off' 		=> '禁止分享',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'tab_id'	=> 'blog-settings-sharing'
				);

$share_story_networks = array(
			'visible' => array (
				'placebo'	=> 'placebo',
				'fb'   	 	=> 'Facebook',
				'tw'   	 	=> 'Twitter',
				'lin'       => 'LinkedIn',
				'tlr'       => 'Tumblr',
				'gp'       	=> 'Google Plus',
			),

			'hidden' => array (
				'placebo'   => 'placebo',
				'pi'       	=> 'Pinterest',
				'em'       	=> 'Email',
				'vk'       	=> 'VKontakte',
			),
);

$of_options[] = array( 	'name' 		=> '分享到社交网络',
						'desc' 		=> '选择社交网络，游客可以分享你的博客文章。visible-可见，hidden-隐藏。',
						'id' 		=> 'blog_share_story_networks',
						'std' 		=> $share_story_networks,
						'type' 		=> 'sorter',
						'fold'		=> 'blog_share_story',
						
						'tab_id'	=> 'blog-settings-sharing'
				);

$of_options[] = array( 	'desc' 		=> '显示圆形的社交网络图标与链接',
						'id' 		=> 'blog_share_story_rounded_icons',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'fold'		=> 'blog_share_story',
						
						'tab_id'	=> 'blog-settings-sharing'
				);
// END OF BLOG SETTINGS


// PORTFOLIO SETTINGS
$of_options[] = array( 	'name' 		=> 'Portfolio Settings',
             'cnname' 		=> '作品集设置',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-th'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'portfolio-settings-tabs',
						'tabs'		=> array(
							'portfolio-settings-layout'      => '作品集布局',
							'portfolio-settings-loop'        => '作品集页面',
							'portfolio-settings-single'      => '文章页面',
							'portfolio-settings-lightbox'    => '灯箱选项',
							'portfolio-settings-sharing'     => '分享设置',
							'portfolio-settings-other'       => '其他设置',
						)
				);


$of_options[] = array( 	'name' 		=> '作品集布局类型',
						'desc' 		=> "选择默认类型来显示作品集项目。<br /><small><span class=\"note\">注意：</span>您可以为单独的作品集页面覆盖此设置。</small><br><br>",
						'id' 		=> 'portfolio_type',
						'std' 		=> 'type-1',
						'type' 		=> 'images',
						'options' 	=> array(
							'type-1' => THEMEASSETS . 'images/admin/portfolio-grid/portfolio-type-1.png',
							'type-2' => THEMEASSETS . 'images/admin/portfolio-grid/portfolio-type-2.png',
							'type-3' => THEMEASSETS . 'images/admin/portfolio-grid/portfolio-type-3.png',
							//'type-4' => THEMEASSETS . 'images/admin/portfolio-grid/portfolio-type-4.png',
						),
						'descrs'	=> array(
							'type-1' => '可见标题',
							'type-2' => '标题在内',
							'type-3' => '标题在内 + 堆砌布局',
						),
						'afolds'	=> 1,
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'name' 		=> '可见标题设置',
						'desc' 		=> '使用动态缩略图高度（不裁剪）',
						'id' 		=> 'portfolio_type_1_dynamic_height',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '在项目悬停上使用动画眼睛',
						'id' 		=> 'portfolio_type_1_hover_animatd_eye',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '当前视图类型的列数',
						'id' 		=> 'portfolio_type_1_columns_count',
						'std' 		=> '4',
						'type' 		=> 'select',
						'options' 	=> array(
							'1'  => '每行一个项目',
							'2'  => '每行两个项目',
							'3'  => '每行三个项目',
							'4'  => '每行四个项目',
							'5'  => '每行五个项目',
							'6'  => '每行六个项目',
						),
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> "此类型的每页作品集项目<br><small><span class=\"note\">注意：</span> 在单页输入<strong> -1</strong> 值显示所有的作品集项目。</small>",
						'id' 		=> 'portfolio_type_1_items_per_page',
						'std' 		=> "",
						'plc'		=> '(留空使用WordPress默认)',
						'type' 		=> 'text',
						'numeric'	=> true,
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);


$of_options[] = array( 	'name'		=> '缩略图选项',
						'desc' 		=> '悬停效果',
						'id' 		=> 'portfolio_type_1_hover_effect',
						'std' 		=> 'full',
						'type' 		=> 'select',
						'options' 	=> array(
							'none'       => '没有悬停效果',
							'full'       => '全背景悬停',
							'distanced'  => '部分背景悬停'
						),
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '悬停透明度',
						'id' 		=> 'portfolio_type_1_hover_transparency',
						'std' 		=> 'opacity',
						'type' 		=> 'select',
						'options' 	=> array(
							'opacity'    => '应用透明度',
							'no-opacity' => '没有透明度',
						),
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '此类型的悬停颜色背景',
						'id' 		=> 'portfolio_type_1_hover_color',
						'std' 		=> "",
						'type' 		=> 'color',
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> "此类型的缩略图大小<br><small>如果你改变尺寸你必须 <a href=\"admin.php?page=laborator_docs#regenerate-thumbnails\" target=\"_blank\">重新生成缩略图</a>.</small>",
						'id' 		=> 'portfolio_thumbnail_size_1',
						'std' 		=> "",
						'plc'		=> '留空使用默认： 505x420',
						'type' 		=> 'text',
						'afold'		=> 'portfolio_type:type-1',
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);


$of_options[] = array( 	'name' 		=> "标题在内 &amp; 堆砌布局设置",
						'desc' 		=> '作品集项目像按钮一样显示',
						'id' 		=> 'portfolio_type_2_likes_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '当前视图类型的列数',
						'id' 		=> 'portfolio_type_2_columns_count',
						'std' 		=> '4',
						'type' 		=> 'select',
						'options' 	=> array(
							'1'  => '每行一个项目',
							'2'  => '每行两个项目',
							'3'  => '每行三个项目',
							'4'  => '每行四个项目',
							'5'  => '每行五个项目',
							'6'  => '每行六个项目',
						),
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '作品集项目之间的间距',
						'id' 		=> 'portfolio_type_2_grid_spacing',
						'std' 		=> 'four',
						'type' 		=> 'select',
						'options' 	=> array(
							'normal' => '默认间距',
							'merged' => '合并（无间距）'
						),
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> "默认项目间距<br><small><span class=\"note\">注意：</span> 当选择 &quot;合并&quot; 间距时，不会被应用。</small>",
						'id' 		=> 'portfolio_type_2_default_spacing',
						'std' 		=> "",
						'plc'		=> '默认间距： 30',
						'type' 		=> 'text',
						'numeric'	=> true,
						'postfix'	=> 'px',
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> "此类型每页的作品集项目<br><small><span class=\"note\">注意：</span> 在单页输入<strong>-1</strong>值显示所有的作品集项目。</small>",
						'id' 		=> 'portfolio_type_2_items_per_page',
						'std' 		=> "",
						'plc'		=> '(留空使用WordPress默认)',
						'type' 		=> 'text',
						'numeric'	=> true,
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'name'		=> '缩略图选项',
						'desc' 		=> '悬停效果',
						'id' 		=> 'portfolio_type_2_hover_effect',
						'std' 		=> 'full',
						'type' 		=> 'select',
						'options' 	=> array(
							'none'       => '没有悬停效果',
							'full'       => '全背景悬停',
							'distanced'  => '部分背景悬停'
						),
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '悬停文本位置',
						'id' 		=> 'portfolio_type_2_hover_text_position',
						'std' 		=> 'bottom-left',
						'type' 		=> 'select',
						'options' 	=> array(
							'top-left'       => '左上方',
							'top-right'      => '右上方',
							'center'         => '居中',
							'bottom-left'    => '左下方',
							'bottom-right'   => '右下方',
						),
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '悬停透明度',
						'id' 		=> 'portfolio_type_2_hover_transparency',
						'std' 		=> 'opacity',
						'type' 		=> 'select',
						'options' 	=> array(
							'opacity'    => '应用透明度',
							'no-opacity' => '没有透明度',
						),
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '悬停背景样式',
						'id' 		=> 'portfolio_type_2_hover_style',
						'std' 		=> 'primary',
						'type' 		=> 'select',
						'options' 	=> array(
							'primary'=> '主题颜色',
							'black'  => '黑色的背景',
							'white'  => '白色的背景'
						),
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '此类型的悬停颜色背景',
						'id' 		=> 'portfolio_type_2_hover_color',
						'std' 		=> "",
						'type' 		=> 'color',
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);
				

$of_options[] = array( 	'desc' 		=> "此类型的缩略图大小<br><small>如果你改变尺寸你必须<a href=\"admin.php?page=laborator_docs#regenerate-thumbnails\" target=\"_blank\">重新生成缩略图</a>.</small>",
						'id' 		=> 'portfolio_thumbnail_size_2',
						'std' 		=> "",
						'plc'		=> '留空使用默认： 505x420',
						'type' 		=> 'text',
						'afold'		=> "portfolio_type:type-2,type-3",
						
						'tab_id' 	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'name' 		=> '全宽作品集',
						'desc' 		=> '将作品集容器扩展到浏览器边缘',
						'id' 		=> 'portfolio_full_width',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'folds'		=> true,
						
						'tab_id'	=> 'portfolio-settings-layout'
				);

$of_options[] = array( 	'desc' 		=> '包括容器内的标题和过滤器',
						'id' 		=> 'portfolio_full_width_title_filter_container',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'fold'		=> 'portfolio_full_width',
						
						'tab_id'	=> 'portfolio-settings-layout'
				);

// Portfolio Loop
$of_options[] = array( 	'name' 		=> '作品集页面选项',
						'desc' 		=> '作品集项目类似特辑',
						'id' 		=> 'portfolio_likes',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						
						'tab_id'	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '作品集项目分类过滤',
						'id' 		=> 'portfolio_category_filter',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						
						'tab_id'	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '使用子分类过滤',
						'id' 		=> 'portfolio_filter_enable_subcategories',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_category_filter',
						
						'tab_id'	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "喜欢图标类型<br><small><strong>注意</strong>： 选择 \"喜欢\" 图标形状显示。.</small>",
						'id' 		=> 'portfolio_likes_icon',
						'std' 		=> 'categories',
						'type' 		=> 'select',
						'options' 	=> array(
							'heart'  => '心形',
							'thumb'  => '竖起大拇指',
							'star'   => '星星',
						),
						
						'fold'		=> 'portfolio_likes',
						
						'tab_id'	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "作品集项目标题下的信息<br><small><span class=\"note\">注意：</span> 选择你想要显示在循环中的作品集标题下的内容类型。</small>",
						'id' 		=> 'portfolio_loop_subtitles',
						'std' 		=> 'categories',
						'type' 		=> 'select',
						'options' 	=> array(
							'categories'         => '显示项目分类',
							'categories-parent'  => '只显示项目父分类',
							'subtitle'           => '显示项目子标题',
							'hide'               => '隐藏'
						),
						
						'tab_id'	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '作品集项目显示效果',
						'id' 		=> 'portfolio_reveal_effect',
						'std' 		=> 'slidenfade',
						'type' 		=> 'select',
						'options' 	=> array(
							'none'			 => '无',
							'fade'           => '褪色',
							'slidenfade'     => '幻灯片和褪色',
							'zoom'           => '放大',
							'fade-one'       => '褪色（一个接一个）',
							'slidenfade-one' => '幻灯片和褪色（一个接一个）)',
							'zoom-one'       => '放大（一个接一个）'
						),
						
						'tab_id'	=> 'portfolio-settings-loop'
				);

$portfolio_post_type_obj = get_post_type_object( 'portfolio' );
$portfolio_prefix_url_slug_placeholder = '';

if ( $portfolio_post_type_obj != null ) {
	$portfolio_prefix_url_slug_placeholder = '当前作品集固定链接块： ' . $portfolio_post_type_obj->rewrite['slug'];
}

if ( $portfolio_prefix_url_slug_placeholder )  {
	
	$of_options[] = array( 	'name'		=> 'URL重写选项',
							'desc'		=> "自定义作品集项目的URL前缀<br><small><span class=\"note\">注意：</span> 当您更改此设置时，您需要<a href=\"" . admin_url( 'themes.php?page=laborator_docs#flush-rewrite-rules' ) . "\" target=\"_blank\">刷新重写规则</a>。</small>",
							'id' 		=> 'portfolio_prefix_url_slug',
							'std' 		=> "",
							'plc'		=> $portfolio_prefix_url_slug_placeholder,
							'type' 		=> 'text',
						
						'tab_id'	=> 'portfolio-settings-loop',
					);
					
	// Portfolio Category URL prefix
	$portfolio_category_args = apply_filters( 'portfolioposttype_category_args', array() );

	$portfolio_category_prefix_url_slug_placeholder = '';
	
	if( ! empty ( $portfolio_category_args['rewrite']['slug'] ) ) {
		$portfolio_category_prefix_url_slug_placeholder = $portfolio_category_args['rewrite']['slug'];
	}
	
	$of_options[] = array( 	'desc'		=> "自定义作品集分类的URL前缀<br><small><span class=\"note\">注意：</span> 当您更改此设置时，您需要<a href=\"" . admin_url( 'themes.php?page=laborator_docs#flush-rewrite-rules' ) . "\" target=\"_blank\">刷新重写规则</a>。</small>",
							'id' 		=> 'portfolio_category_prefix_url_slug',
							'std' 		=> "",
							'plc'		=> '当前分类固定链接块： ' . $portfolio_category_prefix_url_slug_placeholder,
							'type' 		=> 'text',
						
						'tab_id'	=> 'portfolio-settings-loop',
					);
}

$of_options[] = array( 	'desc' 		=> "过滤器的链接类型<br><small><strong>注意</strong>： 设置作品集过滤器链接：绝对链接或附加的哈希链接。 <a href=\"http://drops.laborator.co/FKg2\" target=\"_blank\">Click to learn more</a>.</small>",
						'id' 		=> 'portfolio_filter_link_type',
						'std' 		=> 'hash',
						'type' 		=> 'select',
						'options' 	=> array(
							'hash'       => '哈希（附加在URL的结尾）',
							'pushState'  => '绝对的分类链接（pushState）',
						),
						
						'fold'		=> 'portfolio_category_filter',
						
						'tab_id'	=> 'portfolio-settings-loop'
				);


$of_options[] = array( 	'name' 		=> '分页',
						'desc' 		=> '选择分页类型',
						'id' 		=> 'portfolio_pagination_type',
						'std' 		=> 'center',
						'type' 		=> 'select',
						'options' 	=> array(
							'normal'         => '正常分页',
							'endless'        => '无尽滚动',
							'endless-reveal' => "无尽滚动 + 自动显示"
						),
						
						'afolds'	=> true,
						
						'tab_id' 	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '加载时无尽滚动的分页样式',
						'id' 		=> 'portfolio_endless_pagination_style',
						'std' 		=> '_1',
						'type' 		=> 'select',
						'options' 	=> $endless_pagination_style,
						
						'afold'		=> 'portfolio_pagination_type:endless,endless-reveal',
						
						'tab_id' 	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "获取的项目数<br><small><strong>注意</strong>：指定当单击“显示更多”时要获取的自定义项目数。（可选）</small>",
						'id' 		=> 'portfolio_endless_pagination_fetch_count',
						'plc' 		=> '留空表示继承值',
						'type' 		=> 'text',
						
						'afold'		=> 'portfolio_pagination_type:endless,endless-reveal',
						
						'tab_id' 	=> 'portfolio-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '设置分页位置',
						'id' 		=> 'portfolio_pagination_position',
						'std' 		=> 'center',
						'type' 		=> 'select',
						'options' 	=> array('left' => '左侧', 'center' => '居中', 'right' => '右侧'),
						
						'tab_id' 	=> 'portfolio-settings-loop'
				);
				

// Portfolio: Single
$of_options[] = array( 	'name' 		=> '项目选项',
						'desc' 		=> "在单个项目上使用<strong>上下页</strong> 导航",
						'id' 		=> 'portfolio_prev_next',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> 1,
						
						'tab_id'	=> 'portfolio-settings-single'
				);

$of_options[] = array( 	'desc' 		=> '在当前分类项目上使用上下页链接',
						'id' 		=> 'portfolio_prev_next_category',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_prev_next',
						
						'tab_id'	=> 'portfolio-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "当指向<strong>上下页</strong>链接时显示项目标题",
						'id' 		=> 'portfolio_prev_next_show_titles',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-single'
				);

$of_options[] = array( 	'desc' 		=> '禁用灯箱图片',
						'id' 		=> 'portfolio_disable_lightbox',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-single',
				);

$of_options[] = array( 	'desc' 		=> '作品集归档的网址链接到当前项目分类',
						'id' 		=> 'portfolio_archive_url_category',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'afolds'	=> true,
						
						'tab_id'	=> 'portfolio-settings-single',
				);

$of_options[] = array( 	'desc' 		=> "作品集归档网址（如果为空将使用默认作品集归档网址）<br><small><span class=\"note\">注意：</span> 此URL将被用在上下页导航中</small>",
						'id' 		=> 'portfolio_archive_url',
						'std' 		=> "",
						'plc'		=> get_post_type_archive_link('portfolio'),
						'type' 		=> 'text',
						'fold'		=> 'portfolio_prev_next',
						
						'afold'		=> 'portfolio_archive_url_category:notChecked',
						
						'tab_id'	=> 'portfolio-settings-single'
				);

$of_options[] = array( 	'desc' 		=> '选择默认上下页导航设计布局',
						'id' 		=> 'portfolio_prev_next_type',
						'std' 		=> 'simple',
						'type' 		=> 'select',
						'options' 	=> array(
							'simple' => '简单的上下页导航（在页面最后部分）',
							'fixed'  => '固定位置的上下页导航',
						),
						'fold'		=> 'portfolio_prev_next',
						
						'afolds'	=> true,
						
						'tab_id'	=> 'portfolio-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "在浏览器中上下页导航对齐方式。<br /><small><span class=\"note\">注意：</span> 此设置仅在固定位置的上下页导航中被支持。</small>",
						'id' 		=> 'portfolio_prev_next_position',
						'std' 		=> 'right-side',
						'type' 		=> 'select',
						'options' 	=> array(
							'left-side'  => '上下页导航 - 左侧',
							'centered'   => '上下页导航 - 居中',
							'right-side' => '上下页导航 - 右侧',
						),
						'fold'		=> 'portfolio_prev_next',
						
						'afold'		=> 'portfolio_prev_next_type:fixed',
						
						'tab_id'	=> 'portfolio-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "喜欢 &amp; 分享 设计布局",
						'id' 		=> 'portfolio_like_share_layout',
						'std' 		=> 'default',
						'type' 		=> 'select',
						'options' 	=> array(
							'default'    => '普通的链接',
							'rounded'    => '圆形链接（圆状）',
						),
						
						'tab_id'	=> 'portfolio-settings-single'
				);


// Lightbox: General
$of_options[] = array( 	'name' 		=> '灯箱作品集项目类型设置',
						'desc' 		=> "",
						'id' 		=> 'portfolio_lb',
						'std' 		=> "<h3 style=\"margin: 0 0 10px;\">通知</h3>
						<p>下面的设置将只会应用于&quot;灯箱&quot;作品集项目。</p>",
						'icon' 		=> true,
						'type' 		=> 'info',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
					);

$of_options[] = array( 	'name' 		=> '灯箱导航',
						'desc' 		=> "浏览模式<br><small>注意：如果设置为“链接”的模式，灯箱将通过上一个和下一个箭头在列表中连续显示所有的作品集项目。</small>",
						'id' 		=> 'portfolio_lb_navigation_mode',
						'std' 		=> 'single',
						'type' 		=> 'select',
						'options' 	=> array(
							'single' => '单个项目',
							'linked' => '链接',
						),
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
					

$of_options[] = array(	'name' 		=> '一般设置',
						'desc' 		=> '启用全屏模式',
						'id' 		=> 'portfolio_lb_fullscreen',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> '启用字幕标题',
						'id' 		=> 'portfolio_lb_captions',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> '启用下载',
						'id' 		=> 'portfolio_lb_download',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> '显示计数器',
						'id' 		=> 'portfolio_lb_counter',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> '幻灯片拖动',
						'id' 		=> 'portfolio_lb_draggable',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> '启用项目的URL重写（hash）',
						'id' 		=> 'portfolio_lb_hash',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> "无限循环（下/上）",
						'id' 		=> 'portfolio_lb_loop',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> '启用寻呼机',
						'id' 		=> 'portfolio_lb_pager',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);

$of_options[] = array( 	'desc' 		=> '选择灯箱皮肤',
						'id' 		=> 'portfolio_lb_skin',
						'std' 		=> 'lg-skin-kalium-default',
						'type' 		=> 'select',
						'options' 	=> array(
							'lg-default-skin'                                => '经典',
							'lg-skin-kalium-default'                         => 'Kalium 暗',
							'lg-skin-kalium-default lg-skin-kalium-light'    => 'Kalium 亮'
						),
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);
				
$of_options[] = array( 	'desc' 		=> '图片间切换的类型。（请大家一一试验有些专业词语实在翻译不好。翻译作者：www.wordpressleaf.com）',
						'id' 		=> 'portfolio_lb_mode',
						'std' 		=> 'lg-fade',
						'type' 		=> 'select',
						'options' 	=> array(
							'lg-slide'                       => '幻灯片',
							'lg-fade'                        => '褪色',
							'lg-zoom-in'                     => '放大',
							'lg-zoom-in-big'                 => '放大（大）', 
							'lg-zoom-out'                    => '缩小',
							'lg-zoom-out-big'                => '缩小（大）', 
							'lg-zoom-out-in'                 => '缩小放大',
							'lg-zoom-in-out'                 => '放大缩小',
							'lg-soft-zoom'                   => '软变焦', 
							'lg-scale-up'                    => '按比例增加', 
							'lg-slide-circular'              => '回转滑动', 
							'lg-slide-circular-vertical'     => '垂直回转滑动', 
							'lg-slide-vertical'              => '垂直滑动', 
							'lg-slide-vertical-growth'       => '垂直增长滑动', 
							'lg-slide-skew-only'             => '仅斜向滑动', 
							'lg-slide-skew-only-rev'         => '仅反向斜向滑动',
							'lg-slide-skew-only-y'           => '仅在y轴上斜向滑动', 
							'lg-slide-skew-only-y-rev'       => '仅在y轴上反向斜向滑动',
							'lg-slide-skew'                  => '斜向滑动', 
							'lg-slide-skew-rev'              => '反向斜向滑动',
							'lg-slide-skew-cross'            => '交错斜向滑动', 
							'lg-slide-skew-cross-rev'        => '反向交错斜向滑动',
							'lg-slide-skew-ver'              => '垂直斜向滑动', 
							'lg-slide-skew-ver-rev'          => '反向垂直斜向滑动',
							'lg-slide-skew-ver-cross'        => '交错垂直斜向滑动', 
							'lg-slide-skew-ver-cross-rev'    => '反向交错垂直斜向滑动',
							'lg-lollipop'                    => '棒糖形', 
							'lg-lollipop-rev'                => '反向棒糖形',
							'lg-rotate'                      => '旋转', 
							'lg-rotate-rev'                  => '反向旋转',
							'lg-tube'                        => '管状',
						),
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);

$of_options[] = array( 	'desc' 		=> "过渡持续时间（秒）<br><small><span class=\"note\">注意：</span> 仅输入数字值。</small>",
						'id' 		=> 'portfolio_lb_speed',
						'std' 		=> '',
						'plc'		=> '默认： 0.6',
						'postfix'	=> 's',
						'type' 		=> 'text',
						'numeric'	=> true,
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);

$of_options[] = array( 	'desc' 		=> "延迟在几秒后，隐藏画廊控件<br><small><span class=\"note\">注意：</span> 仅输入数字值。</small>",
						'id' 		=> 'portfolio_lb_hide_bars_delay',
						'std' 		=> '',
						'plc'		=> '默认： 3',
						'postfix'	=> 's',
						'type' 		=> 'text',
						'numeric'	=> true,
						
						'tab_id'	=> 'portfolio-settings-lightbox',
				);

$of_options[] = array( 	'desc' 		=> "画廊项目的图像尺寸<br><small><span class=\"note\">注意：</span> 输入定义的图像尺寸。 点击 <a href=\"https://codex.wordpress.org/Function_Reference/the_post_thumbnail#Thumbnail_Sizes\" target=\"_blank\">此处</a> 学习更多。</small>",
						'id' 		=> 'portfolio_lb_image_size_large',
						'std' 		=> '',
						'plc'		=> '默认：原始尺寸',
						'type' 		=> 'text',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> "缩略图的图像尺寸<br><small><span class=\"note\">注意：</span> 输入定义的图像尺寸。 点击 <a href=\"https://codex.wordpress.org/Function_Reference/the_post_thumbnail#Thumbnail_Sizes\" target=\"_blank\">此处</a> 学习更多。</small>",
						'id' 		=> 'portfolio_lb_image_size_thumbnail',
						'std' 		=> '',
						'plc'		=> '默认：缩略图尺寸',
						'type' 		=> 'text',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

// Lightbox: Thumbnails				
$of_options[] = array( 	'name' 		=> '缩略图',
						'desc' 		=> '启用灯箱缩略图',
						'id' 		=> 'portfolio_lb_thumbnails',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> '单行缩略图 (swipe nav)',
						'id' 		=> 'portfolio_lb_thumbnails_animated',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_lb_thumbnails',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> '缩略图上拉动字幕',
						'id' 		=> 'portfolio_lb_thumbnails_pullcaptions_up',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_lb_thumbnails',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> '默认显示缩略图',
						'id' 		=> 'portfolio_lb_thumbnails_show',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_lb_thumbnails',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> "缩略图大小<br><small><span class=\"note\">注意：</span> 应用在宽度值上。</small>",
						'id' 		=> 'portfolio_lb_thumbnails_width',
						'std' 		=> '',
						'plc'		=> '100',
						'type' 		=> 'text',
						'postfix' 	=> 'px',
						'numeric'	=> true,
						'fold'		=> 'portfolio_lb_thumbnails',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> "缩略图容器的高度",
						'id' 		=> 'portfolio_lb_thumbnails_container_height',
						'std' 		=> '',
						'plc'		=> '100',
						'type' 		=> 'text',
						'postfix' 	=> 'px',
						'numeric'	=> true,
						'fold'		=> 'portfolio_lb_thumbnails',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

/*TMP$of_options[] = array( 	'desc' 		=> 'Thumbnails pager position',
						'id' 		=> 'portfolio_lb_thumbnails_pager_position',
						'std' 		=> 'middle',
						'type' 		=> 'select',
						'options' 	=> array(
							'left'   => 'Left',
							'middle' => 'Middle',
							'right'  => 'Right'
						),
						'fold'		=> 'portfolio_lb_thumbnails'
				);*/


// Lightbox: AutoPlay
$of_options[] = array( 	'name' 		=> '自动播放',
						'desc' 		=> '启用画廊自动播放',
						'id' 		=> 'portfolio_lb_autoplay',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> "显示或隐藏自动播放控制按钮",
						'id' 		=> 'portfolio_lb_autoplay_controls',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_lb_autoplay',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> '启用自动播放进度条',
						'id' 		=> 'portfolio_lb_autoplay_progressbar',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_lb_autoplay',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> '强制自动播放',
						'id' 		=> 'portfolio_lb_autoplay_force_autoplay',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'fold'		=> 'portfolio_lb_autoplay',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> "每一个自动转换之间的时间（以秒计算）<br><small><span class=\"note\">注意：</span> 仅输入数字值。</small>",
						'id' 		=> 'portfolio_lb_autoplay_pause',
						'std' 		=> '',
						'plc'		=> '默认： 5',
						'type' 		=> 'text',
						'numeric'	=> true,
						'fold'		=> 'portfolio_lb_autoplay',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);


// Lightbox: Zoom
$of_options[] = array( 	'name' 		=> '缩放',
						'desc' 		=> '启用缩放选项',
						'id' 		=> 'portfolio_lb_zoom',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);

$of_options[] = array( 	'desc' 		=> "缩放比例<br><small><span class=\"note\">Note:</span> 缩放应递增/递减的值。</small>",
						'id' 		=> 'portfolio_lb_zoom_scale',
						'std' 		=> '',
						'plc'		=> '默认： 1',
						'type' 		=> 'text',
						'numeric'	=> true,
						'fold'		=> 'portfolio_lb_zoom',
						
						'tab_id'	=> 'portfolio-settings-lightbox'
				);


$of_options[] = array( 	'name' 		=> '分享项目',
						'desc' 		=> '允许或禁止在社交网络上分享作品集项目',
						'id' 		=> 'portfolio_share_item',
						'std' 		=> 0,
						'on' 		=> '允许分享',
						'off' 		=> '禁止分享',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'tab_id' 	=> 'portfolio-settings-sharing'
				);


$share_portfolio_networks = array(
			'visible' => array (
				'placebo'	=> 'placebo',
				'fb'   	 	=> 'Facebook',
				'tw'   	 	=> 'Twitter',
				'pr'   	 	=> 'Print Page',
			),

			'hidden' => array (
				'placebo'   => 'placebo',
				'pi'       	=> 'Pinterest',
				'em'       	=> 'Email',
				'tlr'       => 'Tumblr',
				'lin'       => 'LinkedIn',
				'gp'       	=> 'Google Plus',
				'vk'       	=> 'VKontakte',
			),
);

$of_options[] = array( 	'name' 		=> '分享到社交网络',
						'desc' 		=> '选择社交网络，游客可以分享你的作品集项目。visible-可见，hidden-隐藏。',
						'id' 		=> 'portfolio_share_item_networks',
						'std' 		=> $share_portfolio_networks,
						'type' 		=> 'sorter',
						'fold'		=> 'portfolio_share_item',
						
						'tab_id' 	=> 'portfolio-settings-sharing'
				);


$of_options[] = array( 	'name' 		=> "作品集标题 & 描述",
						'desc' 		=> "在作品集页面显示头部标题和描述 <br /><small><span class=\"note\">注意：</span> 在个人作品集页面上，您可以重写此设置。</small>",
						'id' 		=> 'portfolio_show_header_title',
						'std' 		=> 1,
						'on' 		=> 'Show',
						'off' 		=> 'Hide',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'tab_id' 	=> 'portfolio-settings-other'
				);

$of_options[] = array( 	'desc' 		=> '作品集头部标题（可选）',
						'id' 		=> 'portfolio_title',
						'std' 		=> 'Portfolio',
						'plc'		=> "",
						'type' 		=> 'text',
						'fold'		=> 'portfolio_show_header_title',
						
						'tab_id' 	=> 'portfolio-settings-other'
				);

$of_options[] = array( 	'desc' 		=> '头部的作品集描述（可选）',
						'id' 		=> 'portfolio_description',
						'std'		=> "Our everyday work is presented here, we do what we love,'.PHP_EOL.'Case studies, video presentations and photo-shootings below",
						'plc' 		=> "",
						'type' 		=> 'textarea',
						'fold'		=> 'portfolio_show_header_title',
						
						'tab_id' 	=> 'portfolio-settings-other'
				);

$of_options[] = array( 	'name' 		=> '作品集标签',
						'desc' 		=> "启用作品集标签<br><small>注意：作品集标签用来过滤/分组作品集项目，仅在管理区域可用。</small>",
						'id' 		=> 'portfolio_enable_tags',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'portfolio-settings-other'
				);
				
// END OF PORTFOLIO SETTINGS


// SHOP SETTINGS
$of_options[] = array( 	'name' 		=> 'Shop Settings',
            	'cnname' 		=> '商店设置',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-shopping-cart'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'shop-settings-tabs',
						'tabs'		=> array(
							'shop-settings-loop'             => '目录页',
							'shop-settings-single'           => '单页',
							'shop-settings-sharing'          => '分享设置',
							'shop-settings-other'            => '其他设置',
							'shop-settings-img-dimensions'   => '图像尺寸',
						)
				);

$of_options[] = array( 	'name'		=> '商店目录布局',
						'desc' 		=> "",
						'id' 		=> 'shop_catalog_layout',
						'std' 		=> 'default',
						'options'	=> array(
							'default'            => THEMEASSETS . 'images/admin/shop-loop-layout-1.png',
							'full-bg'            => THEMEASSETS . 'images/admin/shop-loop-layout-2.png',
							'distanced-centered' => THEMEASSETS . 'images/admin/shop-loop-layout-3.png',
							'transparent-bg'     => THEMEASSETS . 'images/admin/shop-loop-layout-4.png',
						),
						'descrs'	=> array(
							'default'            => '默认',
							'full-bg'            => '全背景',
							'distanced-centered' => '部分背景居中',
							'transparent-bg'     => '最小',
						),
						'type' 		=> 'images',
						
						'afolds'	=> true,
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'name' 		=> '目录选项',
						'desc' 		=> '商店头部标题和结果计数',
						'id' 		=> 'shop_title_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '目录页中的产品分类',
						'id' 		=> 'shop_sorting_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "显示<strong>销售</strong> 徽章",
						'id' 		=> 'shop_sale_ribbon_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "显示<strong>缺货</strong> 徽章",
						'id' 		=> 'shop_oos_ribbon_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "显示<strong>精选</strong> 徽章",
						'id' 		=> 'shop_featured_ribbon_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '显示项目分类',
						'id' 		=> 'shop_product_category_listing',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '显示项目价格',
						'id' 		=> 'shop_product_price_listing',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '添加到购物车产品',
						'id' 		=> 'shop_add_to_cart_listing',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "启用<font color='#dd1f26'><strong>目录</strong></font>模式",
						'id' 		=> 'shop_catalog_mode',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> true,
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "<strong>目录模式</strong> &ndash; 隐藏价格",
						'id' 		=> 'shop_catalog_mode_hide_prices',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'fold'		=> 'shop_catalog_mode',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '堆砌模式',
						'id' 		=> 'shop_loop_masonry',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> 1,
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '使用比例缩略图高度',
						'id' 		=> 'shop_loop_thumb_proportional',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> 1,
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "堆砌布局模式<br /><small><span class=\"note\">注意：</span> 当 <strong>堆砌模式</strong> 被激活，你可以选择布局渲染。.</small>",
						'id' 		=> 'shop_loop_masonry_layout_mode',
						'std' 		=> 'fitRows',
						'type' 		=> 'select',
						'options' 	=> array(
							'masonry'    => '默认堆砌',
							'fitRows'    => '适合行'
						),
						'fold'		=> 'shop_loop_masonry',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "目录缩略图尺寸<br /><small><span class=\"note\">注意：</span> 您不想显示项目缩略图，那么你可以选择尺寸大小变量。</small>",
						'id' 		=> 'shop_loop_thumb_proportional_size',
						'std' 		=> 'large',
						'type' 		=> 'select',
						'options' 	=> array(
							'original'   => '原始（全尺寸）',
							'large'      => '大',
							'medium'     => '中等'
						),
						'fold'		=> 'shop_loop_thumb_proportional',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '项目缩略图预览类型',
						'id' 		=> 'shop_item_preview_type',
						'std' 		=> 'fade',
						'type' 		=> 'select',
						'options' 	=> array(
							'fade'       => '悬停切换第二图像',
							'gallery'    => '产品画廊滑动',
							'none'       => '无'
						),
						
						'afold'		=> 'shop_catalog_layout:default',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "商店侧边栏可见方式<br /><small>选择是否要显示边栏或者商店不显示侧边栏。</small>",
						'id' 		=> 'shop_sidebar',
						'std' 		=> 'hide',
						'type' 		=> 'select',
						'options' 	=> $show_sidebar_options,
						
						'tab_id'	=> 'shop-settings-loop'
				);

$shop_columns_count = array(
	'two'    => '每行2个产品',
	'three'  => '每行3个产品',
	'four'   => '每行4个产品',
	'five'   => '每行5个产品',
	'six'    => '每行6个产品',
	'decide' => '当侧边栏存在的时候决定'
);

function lab_wc_product_categories_name_replace($item)
{
	return str_replace( 'products per row', 'categories per row', $item);
}

$of_options[] = array( 	'name' 		=> '产品类别',
						'desc' 		=> '为产品类别设置列数',
						'id' 		=> 'shop_category_columns',
						'std' 		=> 'decide',
						'options'	=> array_map( 'lab_wc_product_categories_name_replace', $shop_columns_count ),
						'type' 		=> 'select',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "类别图片大小 <br /><small>如果你改变尺寸，你必须 <a href=\"admin.php?page=laborator_docs#regenerate-thumbnails\" target=\"_blank\">重新生成缩略图</a>。</small>",
						'id' 		=> 'shop_category_image_size',
						'std' 		=> "",
						'plc'		=> '默认： 500x290',
						'type' 		=> 'text',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'name' 		=> "产品 列 &amp; 行",
						'desc' 		=> "每页产品<br /><small>用列数计算行数，并提供每页的总产品数。</small>",
						'id' 		=> 'shop_products_per_page',
						'std' 		=> 'rows-4',
						'type' 		=> 'select',
						'options' 	=> array(
							'rows-1' => '1 行',
							'rows-2' => '2 行',
							'rows-3' => '3 行',
							'rows-4' => '4 行',
							'rows-5' => '5 行',
							'rows-6' => '6 行',
							'rows-7' => '7 行',
							'rows-8' => '8 行',
							'rows-9' => '9 行',
							'rows-10'=> '10 行',
						),
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> "设置你想在每行显示多少产品<br /><small>如果你选择了<strong>当侧边栏存在的时候决定</strong>，将切换到3列产品。当侧边栏存在的时，每行会显示4个产品。</small>",
						'id' 		=> 'shop_product_columns',
						'std' 		=> 'decide',
						'type' 		=> 'select',
						'options' 	=> $shop_columns_count,
						
						'tab_id'	=> 'shop-settings-loop'
				);
				

$of_options[] = array( 	'name' 		=> '分页',
					 	'desc' 		=> '选择分页类型',
						'id' 		=> 'shop_pagination_type',
						'std' 		=> 'normal',
						'type' 		=> 'select',
						'options' 	=> array(
							'normal'         => '正常分页',
							'endless'        => '无尽滚动',
							'endless-reveal' => "无尽滚动 + 自动显示"
						),
						
						'afolds'	=> true,
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '加载时无尽滚动的分页样式',
						'id' 		=> 'shop_endless_pagination_style',
						'std' 		=> '_1',
						'type' 		=> 'select',
						'options' 	=> $endless_pagination_style,
						
						'afold'		=> 'shop_pagination_type:endless,endless-reveal',
						
						'tab_id'	=> 'shop-settings-loop'
				);

$of_options[] = array( 	'desc' 		=> '设置分页位置',
						'id' 		=> 'shop_pagination_position',
						'std' 		=> 'center',
						'type' 		=> 'select',
						'options' 	=> array('left' => '左侧', 'center' => '居中', 'right' => '右侧'),
						
						'tab_id'	=> 'shop-settings-loop'
				);

// ! Shop: Single
$of_options[] = array( 	'name' 		=> '产品详情',
						'desc' 		=> "",
						'id' 		=> 'shop_single_product_images_layout',
						'std' 		=> 'default',
						'options'	=> array(
							'default'        => THEMEASSETS . 'images/admin/shop-single-product-image-layout-default.png',
							'plain'          => THEMEASSETS . 'images/admin/shop-single-product-image-layout-plain.png',
							'plain-sticky'   => THEMEASSETS . 'images/admin/shop-single-product-image-layout-plain-sticky.png',
						),
						'descrs'	=> array(
							'default'        => '主图片在上缩略图在下',
							'plain'          => '普通图像列表',
							'plain-sticky'   => '固定描述位置'
						),
						'type' 		=> 'images',
						
						'tab_id'	=> 'shop-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "产品图片列大小<br /><small><span class=\"note\">注意：</span> 设置产品图片容器的大小。</small>",
						'id' 		=> 'shop_single_image_column_size',
						'std' 		=> 'medium',
						'type' 		=> 'select',
						'options' 	=> array(
							'small'   => "小 (4/12)",
							'medium'  => "中 (5/12)",
							'large'  => "大 (6/12)",
							'xlarge'  => "超大 (8/12)",
						),
						
						'tab_id'	=> 'shop-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "产品图片对齐<br /><small><span class=\"note\">注意：</span> 设置产品图片容器左右对齐。</small>",
						'id' 		=> 'shop_single_image_alignment',
						'std' 		=> 'left',
						'type' 		=> 'select',
						'options' 	=> array(
							'left'   => '左侧',
							'right'  => '右侧'
						),
						
						'tab_id'	=> 'shop-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "产品图片大小<br /><small><span class=\"note\">注意：</span> 默认会使用WooCommerce图片大小，直到你选择不同的图片大小为止。</small>",
						'id' 		=> 'shop_single_image_size',
						'std' 		=> 'default',
						'type' 		=> 'select',
						'options' 	=> array(
							'default'    => 'WooCommerce 默认',
							'large'      => '大',
							'full'       => '原始（全尺寸）',
						),
						
						'tab_id'	=> 'shop-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "自动旋转产品图片<br><small><span class=\"note\">注意：</span> 单位是秒，默认值是<strong>5</strong>秒，输入<strong>0</strong>来禁用自动旋转。</small>",
						'id' 		=> 'shop_single_auto_rotate_image',
						'std' 		=> "",
						'plc'		=> '默认值： 5',
						'postfix'	=> 's',
						'type' 		=> 'text',
						'numeric'	=> true,
						
						'tab_id'	=> 'shop-settings-single',
				);

$of_options[] = array( 	'desc' 		=> "评级方式<br /><small><span class=\"note\">注意：</span> 为产品选择显示的评级方式。</small>",
						'id' 		=> 'shop_single_rating_style',
						'std' 		=> 'circles',
						'type' 		=> 'select',
						'options' 	=> array(
							'stars'      => '星星',
							'circles'    => '圆圈',
							'rectangles' => '矩形'
						),
						
						'tab_id'	=> 'shop-settings-single'
				);

$of_options[] = array( 	'desc' 		=> "相关产品数量<br><small><span class=\"note\">注意：</span> 单产品页面上显示的相关产品数量。</small>",
						'id' 		=> 'shop_related_products_per_page',
						'std' 		=> 4,
						'type' 		=> 'select',
						'options' 	=> range(12, 0),
						
						'tab_id'	=> 'shop-settings-single'
				);

$of_options[] = array( 	'name'		=> '分享产品',
						'desc' 		=> '启用在社交网络上分享产品',
						'id' 		=> 'shop_single_share_product',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'folds'		=> 1,
						
						'tab_id'	=> 'shop-settings-sharing'
				);

$share_product_networks = array(
			'visible' => array (
				'placebo'	=> 'placebo',
				'fb'   	 	=> 'Facebook',
				'tw'   	 	=> 'Twitter',
				'gp'       	=> 'Google Plus',
				'pi'        => 'Pinterest',
				'em'       	=> 'Email',
			),

			'hidden' => array (
				'placebo'   => 'placebo',
				'lin'       => 'LinkedIn',
				'tlr'       => 'Tumblr',
				'vk'        => 'VKontakte',
			),
);

$of_options[] = array( 	'desc' 		=> "分享产品的网络<br><small><span class=\"note\">注意：</span>选择你允许用户分享你商店产品的社交网络</small>",
						'id' 		=> 'shop_share_product_networks',
						'std' 		=> $share_product_networks,
						'type' 		=> 'sorter',
						'options' 	=> array(
							'rows-1' => '1 row',
							'rows-2' => '2 rows',
						),
						'fold'		=> 'shop_single_share_product',
						
						'tab_id'	=> 'shop-settings-sharing'
				);

$of_options[] = array( 	'name' 		=> '迷你购物车',
						'desc' 		=> '在菜单中显示购物车图标',
						'id' 		=> 'shop_cart_icon_menu',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> 1,
						
						'tab_id'	=> 'shop-settings-other'
				);

$of_options[] = array( 	'desc' 		=> '项目计数指示器',
						'id' 		=> 'shop_cart_icon_menu_count',
						'std' 		=> 1,
						'type' 		=> 'checkbox',
						'fold'		=> 'shop_cart_icon_menu',
						
						'tab_id'	=> 'shop-settings-other'
				);

$of_options[] = array( 	'desc' 		=> '如果为空的时候，隐藏购物车图标。',
						'id' 		=> 'shop_cart_icon_menu_hide_empty',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'fold'		=> 'shop_cart_icon_menu',
						
						'tab_id'	=> 'shop-settings-other'
				);

$of_options[] = array( 	'desc' 		=> 'Ajax模式（在页面被加载后加载数据）',
						'id' 		=> 'shop_cart_icon_menu_ajax',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'fold'		=> 'shop_cart_icon_menu',
						
						'tab_id'	=> 'shop-settings-other'
				);

$of_options[] = array( 	'desc' 		=> "迷你购物车内容弹出菜单<br><small><span class=\"note\">注意：</span>购物车弹出菜单包含项目：购物车内最近项目，结账，购物车URL。 </small>",
						'id' 		=> 'shop_cart_contents',
						'std' 		=> 'show-on-click',
						'type' 		=> 'select',
						'options' 	=> array(
							'hide' => '不显示购物车内容弹出菜单',
							'show-on-click' => '在点击时显示购物车内容弹出菜单',
							'show-on-hover' => '在悬停时显示购物车内容弹出菜单',
						),
						'fold'		=> 'shop_cart_icon_menu',
						
						'tab_id'	=> 'shop-settings-other'
				);

$of_options[] = array( 	'desc' 		=> "购物车图标 <br /><small>选择你想在菜单中显示的购物车图标</small>",
						'id' 		=> 'shop_cart_icon',
						'std' 		=> 'ecommerce-cart-content',
						'options'	=> array(							
							'ecommerce-cart-content' => THEMEASSETS . 'images/admin/cart-menu-icon-1.png',
							'ecommerce-bag'          => THEMEASSETS . 'images/admin/cart-menu-icon-2.png',
							'ecommerce-basket'       => THEMEASSETS . 'images/admin/cart-menu-icon-3.png',
						),
						'type' 		=> 'images',
						'fold'		=> 'shop_cart_icon_menu',
						
						'tab_id'	=> 'shop-settings-other'
				);
				

if( defined( 'WC_INSTALLED' ) )
{					
	$shop_catalog_image_size        = get_option( 'shop_catalog_image_size' );
	$shop_single_image_size         = get_option( 'shop_single_image_size' );
	$shop_thumbnail_image_size      = get_option( 'shop_thumbnail_image_size' );
	$woocommerce_enable_lightbox    = get_option( 'woocommerce_enable_lightbox' );
	
	if( is_array( $shop_catalog_image_size ) )
	{
		$shop_catalog_image_size = $shop_catalog_image_size['width'] . 'x' . $shop_catalog_image_size['height'] . ($shop_catalog_image_size['crop'] ? ' (Cropped)' : '');
	}
	
	if( is_array( $shop_single_image_size ) )
	{
		$shop_single_image_size = $shop_single_image_size['width'] . 'x' . $shop_single_image_size['height'] . ($shop_single_image_size['crop'] ? ' (Cropped)' : '');
	}
	
	if( is_array( $shop_thumbnail_image_size ) )
	{
		$shop_thumbnail_image_size = $shop_thumbnail_image_size['width'] . 'x' . $shop_thumbnail_image_size['height'] . ($shop_thumbnail_image_size['crop'] ? ' (Cropped)' : '');
	}
	
	$of_options[] = array( 	'name' 		=> 'Image Dimensions Info',
							'desc' 		=> "",
							'id' 		=> 'shop_image_dimensions_info',
							'std' 		=> "<h3 style=\"margin: 0 0 10px;\">Shop Image Dimensions</h3>
							<p>
								Here are the current image dimensions being used for shop images:
								<span style='display:block; height: 10px;'></span>
								<span class='shop-imgd-info'>
									<em>Catalog Image Size:</em>
									<strong>{$shop_catalog_image_size}</strong>
								</span>
								
								<span class='shop-imgd-info'>
									<em>Single Image Size:</em>
									<strong>{$shop_single_image_size}</strong>
								</span class='shop-imgd-info'>
								
								<span class='shop-imgd-info'>
									<em>Thumbnail Image Size:</em>
									<strong>{$shop_thumbnail_image_size}</strong>
								</span>
								
								<span class='shop-imgd-info'>
									<em>Lightbox Status:</em>
									<strong>".($woocommerce_enable_lightbox ? 'Enabled <abbr title=\'This theme already has a built-in lightbox\'>(Not recommended)</abbr>' : 'Disabled')."</strong>
								</span>
								
								<br>
								
								<span class=\"note\">Note:</span> After changing image dimensions (or importing demo shop content) you may need to <a href=\"http://wordpress.org/extend/plugins/regenerate-thumbnails/\" target=\"_blank\">regenerate your thumbnails</a>.
							</p>
							<a href=\"".admin_url( 'admin.php?page=wc-settings&tab=products&section=display' ) ."\" class=\"button button-inline button-small\">Edit WooCommerce Image Settings</a> 
							<a href=\"#\" id=\"restore-default-shop-image-dimensions\" class=\"button button-inline button-small button-primary\"><span class=\"loading-spinner\"><i class=\"fa fa-circle-o-notch fa-spin\"></i></span> <em data-success=\"Image dimensions have been reset\">Restore Default Image Dimensions</em></a>",
							'icon' 		=> true,
							'type' 		=> 'info',
							
							'tab_id'	=> 'shop-settings-img-dimensions'
					);
}
/*

$of_options[] = array( 	'desc' 		=> 'Sidebar visibility (single page)',
						'id' 		=> 'shop_single_sidebar',
						'std' 		=> 'hide',
						'type' 		=> 'select',
						'options' 	=> $show_sidebar_options
				);

$of_options[] = array( 	//'name' 		=> 'Footer Sidebar Columns',
					 	'desc' 		=> "Set the number of columns to show in <strong>footer</strong> sidebar",
						'id' 		=> 'shop_sidebar_footer_columns',
						'std' 		=> '4',
						'type' 		=> 'select',
						'options' 	=> array('2', '3', '4'),
						'fold'		=> 'shop_sidebar_footer'
				);

$of_options[] = array( 	'desc' 		=> "Show <strong>footer</strong> sidebar",
						'id' 		=> 'shop_sidebar_footer',
						'std' 		=> 0,
						'type' 		=> 'checkbox',
						'folds'		=> 1
				);


$of_options[] = array( 	'name' 		=> 'Single Item Settings',
						'desc' 		=> "Show <strong>sale</strong> badge (single page)",
						'id' 		=> 'shop_single_sale_ribbon_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);

$of_options[] = array( 	'desc' 		=> "Show <strong>out of stock</strong> badge (single page)",
						'id' 		=> 'shop_single_oos_ribbon_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);

$of_options[] = array( 	'desc' 		=> "Show <strong>featured</strong> badge (single page)",
						'id' 		=> 'shop_single_featured_ribbon_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);

$of_options[] = array( 	'desc' 		=> "Product <strong>Next-Prev</strong> navigation",
						'id' 		=> 'shop_single_next_prev',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);

$of_options[] = array( 	'desc' 		=> "Show product <strong>rating</strong> (below title)",
						'id' 		=> 'shop_single_rating',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);

$of_options[] = array( 	'desc' 		=> 'Show product category (below title)',
						'id' 		=> 'shop_single_product_category',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);

$of_options[] = array( 	'desc' 		=> "Product meta (id, sku, category and tags)",
						'id' 		=> 'shop_single_meta_show',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);

$of_options[] = array( 	'desc' 		=> "Product image size. <br /><small>If you change dimensions you must <a href=\"admin.php?page=laborator_docs#regenerate-thumbnails\">regenerate thumbnails</a>.</small>",
						'id' 		=> 'shop_single_image_size',
						'std' 		=> "",
						'plc'		=> 'Default: 555x710',
						'type' 		=> 'text'
				);

$of_options[] = array( 	'desc' 		=> 'Auto rotate product images',
						'id' 		=> 'shop_single_auto_rotate_image',
						'std' 		=> "",
						'plc'		=> 'Default: 5 (seconds) - 0 to disable',
						'type' 		=> 'text'
				);

$of_options[] = array( 	'desc' 		=> 'Product aside thumbnails to show (they will be splitted)',
						'id' 		=> 'shop_single_aside_thumbnails_count',
						'std' 		=> 5,
						'type' 		=> 'select',
						'options' 	=> range(1, 10)
				);


$of_options[] = array( 	'name' 		=> 'Share Product Networks',
						'desc' 		=> 'Select social networks that you allow users to share the products of your shop',
						'id' 		=> 'shop_share_product_networks',
						'std' 		=> $share_product_networks,
						'type' 		=> 'sorter',
						'fold'		=> 'shop_share_product'
				);

$of_options[] = array( 	'name'		=> 'Category Settings',
						'desc' 		=> 'Category columns per row',
						'id' 		=> 'shop_category_columns',
						'std' 		=> 4,
						'type' 		=> 'select',
						'options' 	=> range(2, 4)
				);

$of_options[] = array( 	'desc' 		=> 'Show items count for category (category page)',
						'id' 		=> 'shop_category_count',
						'std' 		=> 1,
						'type' 		=> 'checkbox'
				);
*/
// END OF SHOP SETTINGS


// OTHER SETTINGS
$of_options[] = array( 	'name' 		=> 'Other Settings',
            'cnname' 		=> '其他设置',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-gears'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'other-settings-tabs',
						'tabs'		=> array(
							'other-settings-misc'                    => '杂项',
							'other-settings-search'                  => '搜索设置',
							'other-settings-video-audio-settings'    => '视频 &amp; 音频设置',
						)
				);
				
$of_options[] = array(  'name'		=> '主题样式文件(style.css)',
						'desc'   	=> '禁用主题 style.css 排队（enqueue）',
						'id'   		=> 'do_not_enqueue_style_css',
						'std'   	=> 0,
						'type'   	=> 'checkbox',
						
						'tab_id'	=> 'other-settings-misc',
					);
				
$of_options[] = array( 	'name' 		=> '回到顶部',
						'desc' 		=> "当用户在页面中向下滚动时显示&quot;回到顶部&quot;的链接。",
						'id' 		=> 'footer_go_to_top',
						'std' 		=> 0,
						'on' 		=> '显示',
						'off' 		=> '隐藏',
						'type' 		=> 'switch',
						'folds'		=> 1,
						
						'tab_id'	=> 'other-settings-misc'
				);

$of_options[] = array( 	'desc' 		=> "设置&quot;回到顶部&quot;的链接被显示时，用户需要滚动的像素或窗口百分比。<br><small><span class=\"note\">注意：</span>如果您将值设置为<strong>footer</strong>，则只有当用户看到页脚时才会出现链接。 </small>",
						'id' 		=> 'footer_go_to_top_activate',
						'std' 		=> 'footer',
						'plc'		=> "",
						'type' 		=> 'text',
						'fold'		=> 'footer_go_to_top',
						
						'tab_id'	=> 'other-settings-misc'
				);

$of_options[] = array( 	'desc' 		=> '回到顶部链接的容器盒形状',
						'id' 		=> 'footer_go_to_top_type',
						'std' 		=> 'circle',
						'type' 		=> 'select',
						'options' 	=> array(
							'square' => '正方形',
							'circle' => '圆形',
						),
						'fold'		=> 'footer_go_to_top',
						
						'tab_id'	=> 'other-settings-misc'
				);

$of_options[] = array( 	'desc' 		=> '链接位置',
						'id' 		=> 'footer_go_to_top_position',
						'std' 		=> 'bottom-right',
						'type' 		=> 'select',
						'options' 	=> array(
							'bottom-right'   => '右下',
							'bottom-left'    => '左下',
							'bottom-center'  => '底部中间',
							
							'top-right'      => '右上',
							'top-left'       => '左上',
							'top-center'     => '顶部中间',
						),
						'fold'		=> 'footer_go_to_top',
						
						'tab_id'	=> 'other-settings-misc'
				);



$post_types_obj = get_post_types(array('_builtin' => false, 'publicly_queryable' => true, 'exclude_from_search' => false), 'objects');

$post_types = array();

$post_types['post'] = 'Posts';
$post_types['page'] = 'Pages';

foreach($post_types_obj as $pt => $obj)
{
	$post_types[$pt] = $obj->labels->name;
}


$of_options[] = array( 	'name'		=> '搜索结果',
						'desc' 		=> '选择在搜索结果中运行的文章类型。',
						'id' 		=> 'search_post_types',
						'std' 		=> array('post', 'page', 'product'),
						'type' 		=> 'multicheck',
						'options' 	=> $post_types,
						
						'tab_id'	=> 'other-settings-search'
				);

$of_options[] = array( 	'name'		=> "视频 &amp; 音频播放器",
						'desc' 		=> "选择默认视频和音频播放器的皮肤使用<br><small><span class=\"note\">注意：</span> 这为音频和视频的嵌入替换WordPress默认播放器。</small>",
						'id' 		=> 'videojs_player_skin',
						'std' 		=> 'minimal',
						'options'	=> array(
							'standard'   => '标准皮肤',
							'minimal'    => '迷你皮肤',
						),
						'type' 		=> 'select',
						
						'tab_id'	=> 'other-settings-video-audio-settings'
				);

$of_options[] = array( 	'desc' 		=> "预加载视频嵌入<br><small><span class=\"note\">注意：</span>要了解更多关于视频预加载 <a href=\"http://www.stevesouders.com/blog/2013/04/12/html5-video-preload/\" target=\"_blank\">点击这里</a>.</small>",
						'id' 		=> 'videojs_player_preload',
						'std' 		=> 'auto',
						'options'	=> array(
							'auto'       => '自动',
							'none'       => '无',
							'metadata'   => '仅meta数据预加载',
						),
						'type' 		=> 'select',
						
						'tab_id'	=> 'other-settings-video-audio-settings'
				);
				
$of_options[] = array(  'desc'   	=> "自动播放视频<br><small><span class=\"note\">注意：</span> 启用该选项你文章中的所有视频都将自动播放。</small>",
						'id'   		=> 'videojs_player_autoplay',
						'std'   	=> 'no',
						'options'	=> array(
							'no'     => '禁用',
							'yes'    => '启用',
						),
						'type'   	=> 'select',
						
						'tab_id'	=> 'other-settings-video-audio-settings',
					);
				
$of_options[] = array(  'desc'   	=> "循环视频<br><small><span class=\"note\">注意：</span> 视频将在结束后重新开始。(无限循环)</small>",
						'id'   		=> 'videojs_player_loop',
						'std'   	=> 'no',
						'options'	=> array(
							'no'     => '禁用',
							'yes'    => '启用',
						),
						'type'   	=> 'select',
						
						'tab_id'	=> 'other-settings-video-audio-settings',
					);
// END OF OTHER SETTINGS


$fonts_list = array(
	'ABeeZee' => 'ABeeZee',
	'Abel' => 'Abel',
	'Abril Fatface' => 'Abril Fatface',
	'Aclonica' => 'Aclonica',
	'Acme' => 'Acme',
	'Actor' => 'Actor',
	'Adamina' => 'Adamina',
	'Advent Pro' => 'Advent Pro',
	'Aguafina Script' => 'Aguafina Script',
	'Akronim' => 'Akronim',
	'Aladin' => 'Aladin',
	'Aldrich' => 'Aldrich',
	'Alef' => 'Alef',
	'Alegreya' => 'Alegreya',
	'Alegreya SC' => 'Alegreya SC',
	'Alegreya Sans' => 'Alegreya Sans',
	'Alegreya Sans SC' => 'Alegreya Sans SC',
	'Alex Brush' => 'Alex Brush',
	'Alfa Slab One' => 'Alfa Slab One',
	'Alice' => 'Alice',
	'Alike' => 'Alike',
	'Alike Angular' => 'Alike Angular',
	'Allan' => 'Allan',
	'Allerta' => 'Allerta',
	'Allerta Stencil' => 'Allerta Stencil',
	'Allura' => 'Allura',
	'Almendra' => 'Almendra',
	'Almendra Display' => 'Almendra Display',
	'Almendra SC' => 'Almendra SC',
	'Amarante' => 'Amarante',
	'Amaranth' => 'Amaranth',
	'Amatic SC' => 'Amatic SC',
	'Amethysta' => 'Amethysta',
	'Amiri' => 'Amiri',
	'Amita' => 'Amita',
	'Anaheim' => 'Anaheim',
	'Andada' => 'Andada',
	'Andika' => 'Andika',
	'Angkor' => 'Angkor',
	'Annie Use Your Telescope' => 'Annie Use Your Telescope',
	'Anonymous Pro' => 'Anonymous Pro',
	'Antic' => 'Antic',
	'Antic Didone' => 'Antic Didone',
	'Antic Slab' => 'Antic Slab',
	'Anton' => 'Anton',
	'Arapey' => 'Arapey',
	'Arbutus' => 'Arbutus',
	'Arbutus Slab' => 'Arbutus Slab',
	'Architects Daughter' => 'Architects Daughter',
	'Archivo Black' => 'Archivo Black',
	'Archivo Narrow' => 'Archivo Narrow',
	'Arimo' => 'Arimo',
	'Arizonia' => 'Arizonia',
	'Armata' => 'Armata',
	'Artifika' => 'Artifika',
	'Arvo' => 'Arvo',
	'Arya' => 'Arya',
	'Asap' => 'Asap',
	'Asar' => 'Asar',
	'Asset' => 'Asset',
	'Astloch' => 'Astloch',
	'Asul' => 'Asul',
	'Atomic Age' => 'Atomic Age',
	'Aubrey' => 'Aubrey',
	'Audiowide' => 'Audiowide',
	'Autour One' => 'Autour One',
	'Average' => 'Average',
	'Average Sans' => 'Average Sans',
	'Averia Gruesa Libre' => 'Averia Gruesa Libre',
	'Averia Libre' => 'Averia Libre',
	'Averia Sans Libre' => 'Averia Sans Libre',
	'Averia Serif Libre' => 'Averia Serif Libre',
	'Bad Script' => 'Bad Script',
	'Balthazar' => 'Balthazar',
	'Bangers' => 'Bangers',
	'Basic' => 'Basic',
	'Battambang' => 'Battambang',
	'Baumans' => 'Baumans',
	'Bayon' => 'Bayon',
	'Belgrano' => 'Belgrano',
	'Belleza' => 'Belleza',
	'BenchNine' => 'BenchNine',
	'Bentham' => 'Bentham',
	'Berkshire Swash' => 'Berkshire Swash',
	'Bevan' => 'Bevan',
	'Bigelow Rules' => 'Bigelow Rules',
	'Bigshot One' => 'Bigshot One',
	'Bilbo' => 'Bilbo',
	'Bilbo Swash Caps' => 'Bilbo Swash Caps',
	'Biryani' => 'Biryani',
	'Bitter' => 'Bitter',
	'Black Ops One' => 'Black Ops One',
	'Bokor' => 'Bokor',
	'Bonbon' => 'Bonbon',
	'Boogaloo' => 'Boogaloo',
	'Bowlby One' => 'Bowlby One',
	'Bowlby One SC' => 'Bowlby One SC',
	'Brawler' => 'Brawler',
	'Bree Serif' => 'Bree Serif',
	'Bubblegum Sans' => 'Bubblegum Sans',
	'Bubbler One' => 'Bubbler One',
	'Buda' => 'Buda',
	'Buenard' => 'Buenard',
	'Butcherman' => 'Butcherman',
	'Butterfly Kids' => 'Butterfly Kids',
	'Cabin' => 'Cabin',
	'Cabin Condensed' => 'Cabin Condensed',
	'Cabin Sketch' => 'Cabin Sketch',
	'Caesar Dressing' => 'Caesar Dressing',
	'Cagliostro' => 'Cagliostro',
	'Calligraffitti' => 'Calligraffitti',
	'Cambay' => 'Cambay',
	'Cambo' => 'Cambo',
	'Candal' => 'Candal',
	'Cantarell' => 'Cantarell',
	'Cantata One' => 'Cantata One',
	'Cantora One' => 'Cantora One',
	'Capriola' => 'Capriola',
	'Cardo' => 'Cardo',
	'Carme' => 'Carme',
	'Carrois Gothic' => 'Carrois Gothic',
	'Carrois Gothic SC' => 'Carrois Gothic SC',
	'Carter One' => 'Carter One',
	'Catamaran' => 'Catamaran',
	'Caudex' => 'Caudex',
	'Caveat' => 'Caveat',
	'Caveat Brush' => 'Caveat Brush',
	'Cedarville Cursive' => 'Cedarville Cursive',
	'Ceviche One' => 'Ceviche One',
	'Changa One' => 'Changa One',
	'Chango' => 'Chango',
	'Chau Philomene One' => 'Chau Philomene One',
	'Chela One' => 'Chela One',
	'Chelsea Market' => 'Chelsea Market',
	'Chenla' => 'Chenla',
	'Cherry Cream Soda' => 'Cherry Cream Soda',
	'Cherry Swash' => 'Cherry Swash',
	'Chewy' => 'Chewy',
	'Chicle' => 'Chicle',
	'Chivo' => 'Chivo',
	'Chonburi' => 'Chonburi',
	'Cinzel' => 'Cinzel',
	'Cinzel Decorative' => 'Cinzel Decorative',
	'Clicker Script' => 'Clicker Script',
	'Coda' => 'Coda',
	'Coda Caption' => 'Coda Caption',
	'Codystar' => 'Codystar',
	'Combo' => 'Combo',
	'Comfortaa' => 'Comfortaa',
	'Coming Soon' => 'Coming Soon',
	'Concert One' => 'Concert One',
	'Condiment' => 'Condiment',
	'Content' => 'Content',
	'Contrail One' => 'Contrail One',
	'Convergence' => 'Convergence',
	'Cookie' => 'Cookie',
	'Copse' => 'Copse',
	'Corben' => 'Corben',
	'Courgette' => 'Courgette',
	'Cousine' => 'Cousine',
	'Coustard' => 'Coustard',
	'Covered By Your Grace' => 'Covered By Your Grace',
	'Crafty Girls' => 'Crafty Girls',
	'Creepster' => 'Creepster',
	'Crete Round' => 'Crete Round',
	'Crimson Text' => 'Crimson Text',
	'Croissant One' => 'Croissant One',
	'Crushed' => 'Crushed',
	'Cuprum' => 'Cuprum',
	'Cutive' => 'Cutive',
	'Cutive Mono' => 'Cutive Mono',
	'Damion' => 'Damion',
	'Dancing Script' => 'Dancing Script',
	'Dangrek' => 'Dangrek',
	'Dawning of a New Day' => 'Dawning of a New Day',
	'Days One' => 'Days One',
	'Dekko' => 'Dekko',
	'Delius' => 'Delius',
	'Delius Swash Caps' => 'Delius Swash Caps',
	'Delius Unicase' => 'Delius Unicase',
	'Della Respira' => 'Della Respira',
	'Denk One' => 'Denk One',
	'Devonshire' => 'Devonshire',
	'Dhurjati' => 'Dhurjati',
	'Didact Gothic' => 'Didact Gothic',
	'Diplomata' => 'Diplomata',
	'Diplomata SC' => 'Diplomata SC',
	'Domine' => 'Domine',
	'Donegal One' => 'Donegal One',
	'Doppio One' => 'Doppio One',
	'Dorsa' => 'Dorsa',
	'Dosis' => 'Dosis',
	'Dr Sugiyama' => 'Dr Sugiyama',
	'Droid Sans' => 'Droid Sans',
	'Droid Sans Mono' => 'Droid Sans Mono',
	'Droid Serif' => 'Droid Serif',
	'Duru Sans' => 'Duru Sans',
	'Dynalight' => 'Dynalight',
	'EB Garamond' => 'EB Garamond',
	'Eagle Lake' => 'Eagle Lake',
	'Eater' => 'Eater',
	'Economica' => 'Economica',
	'Eczar' => 'Eczar',
	'Ek Mukta' => 'Ek Mukta',
	'Electrolize' => 'Electrolize',
	'Elsie' => 'Elsie',
	'Elsie Swash Caps' => 'Elsie Swash Caps',
	'Emblema One' => 'Emblema One',
	'Emilys Candy' => 'Emilys Candy',
	'Engagement' => 'Engagement',
	'Englebert' => 'Englebert',
	'Enriqueta' => 'Enriqueta',
	'Erica One' => 'Erica One',
	'Esteban' => 'Esteban',
	'Euphoria Script' => 'Euphoria Script',
	'Ewert' => 'Ewert',
	'Exo' => 'Exo',
	'Exo 2' => 'Exo 2',
	'Expletus Sans' => 'Expletus Sans',
	'Fanwood Text' => 'Fanwood Text',
	'Fascinate' => 'Fascinate',
	'Fascinate Inline' => 'Fascinate Inline',
	'Faster One' => 'Faster One',
	'Fasthand' => 'Fasthand',
	'Fauna One' => 'Fauna One',
	'Federant' => 'Federant',
	'Federo' => 'Federo',
	'Felipa' => 'Felipa',
	'Fenix' => 'Fenix',
	'Finger Paint' => 'Finger Paint',
	'Fira Mono' => 'Fira Mono',
	'Fira Sans' => 'Fira Sans',
	'Fjalla One' => 'Fjalla One',
	'Fjord One' => 'Fjord One',
	'Flamenco' => 'Flamenco',
	'Flavors' => 'Flavors',
	'Fondamento' => 'Fondamento',
	'Fontdiner Swanky' => 'Fontdiner Swanky',
	'Forum' => 'Forum',
	'Francois One' => 'Francois One',
	'Freckle Face' => 'Freckle Face',
	'Fredericka the Great' => 'Fredericka the Great',
	'Fredoka One' => 'Fredoka One',
	'Freehand' => 'Freehand',
	'Fresca' => 'Fresca',
	'Frijole' => 'Frijole',
	'Fruktur' => 'Fruktur',
	'Fugaz One' => 'Fugaz One',
	'GFS Didot' => 'GFS Didot',
	'GFS Neohellenic' => 'GFS Neohellenic',
	'Gabriela' => 'Gabriela',
	'Gafata' => 'Gafata',
	'Galdeano' => 'Galdeano',
	'Galindo' => 'Galindo',
	'Gentium Basic' => 'Gentium Basic',
	'Gentium Book Basic' => 'Gentium Book Basic',
	'Geo' => 'Geo',
	'Georgia' => 'Georgia',
	'Geostar' => 'Geostar',
	'Geostar Fill' => 'Geostar Fill',
	'Germania One' => 'Germania One',
	'Gidugu' => 'Gidugu',
	'Gilda Display' => 'Gilda Display',
	'Give You Glory' => 'Give You Glory',
	'Glass Antiqua' => 'Glass Antiqua',
	'Glegoo' => 'Glegoo',
	'Gloria Hallelujah' => 'Gloria Hallelujah',
	'Goblin One' => 'Goblin One',
	'Gochi Hand' => 'Gochi Hand',
	'Gorditas' => 'Gorditas',
	'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
	'Graduate' => 'Graduate',
	'Grand Hotel' => 'Grand Hotel',
	'Gravitas One' => 'Gravitas One',
	'Great Vibes' => 'Great Vibes',
	'Griffy' => 'Griffy',
	'Gruppo' => 'Gruppo',
	'Gudea' => 'Gudea',
	'Gurajada' => 'Gurajada',
	'Habibi' => 'Habibi',
	'Halant' => 'Halant',
	'Hammersmith One' => 'Hammersmith One',
	'Hanalei' => 'Hanalei',
	'Hanalei Fill' => 'Hanalei Fill',
	'Handlee' => 'Handlee',
	'Hanuman' => 'Hanuman',
	'Happy Monkey' => 'Happy Monkey',
	'Headland One' => 'Headland One',
	'Henny Penny' => 'Henny Penny',
	'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
	'Hind' => 'Hind',
	'Hind Siliguri' => 'Hind Siliguri',
	'Hind Vadodara' => 'Hind Vadodara',
	'Holtwood One SC' => 'Holtwood One SC',
	'Homemade Apple' => 'Homemade Apple',
	'Homenaje' => 'Homenaje',
	'IM Fell DW Pica' => 'IM Fell DW Pica',
	'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
	'IM Fell Double Pica' => 'IM Fell Double Pica',
	'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
	'IM Fell English' => 'IM Fell English',
	'IM Fell English SC' => 'IM Fell English SC',
	'IM Fell French Canon' => 'IM Fell French Canon',
	'IM Fell French Canon SC' => 'IM Fell French Canon SC',
	'IM Fell Great Primer' => 'IM Fell Great Primer',
	'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
	'Iceberg' => 'Iceberg',
	'Iceland' => 'Iceland',
	'Imprima' => 'Imprima',
	'Inconsolata' => 'Inconsolata',
	'Inder' => 'Inder',
	'Indie Flower' => 'Indie Flower',
	'Inika' => 'Inika',
	'Inknut Antiqua' => 'Inknut Antiqua',
	'Irish Grover' => 'Irish Grover',
	'Istok Web' => 'Istok Web',
	'Italiana' => 'Italiana',
	'Italianno' => 'Italianno',
	'Itim' => 'Itim',
	'Jacques Francois' => 'Jacques Francois',
	'Jacques Francois Shadow' => 'Jacques Francois Shadow',
	'Jaldi' => 'Jaldi',
	'Jim Nightshade' => 'Jim Nightshade',
	'Jockey One' => 'Jockey One',
	'Jolly Lodger' => 'Jolly Lodger',
	'Josefin Sans' => 'Josefin Sans',
	'Josefin Slab' => 'Josefin Slab',
	'Joti One' => 'Joti One',
	'Judson' => 'Judson',
	'Julee' => 'Julee',
	'Julius Sans One' => 'Julius Sans One',
	'Junge' => 'Junge',
	'Jura' => 'Jura',
	'Just Another Hand' => 'Just Another Hand',
	'Just Me Again Down Here' => 'Just Me Again Down Here',
	'Kadwa' => 'Kadwa',
	'Kalam' => 'Kalam',
	'Kameron' => 'Kameron',
	'Kanit' => 'Kanit',
	'Kantumruy' => 'Kantumruy',
	'Karla' => 'Karla',
	'Karma' => 'Karma',
	'Kaushan Script' => 'Kaushan Script',
	'Kavoon' => 'Kavoon',
	'Kdam Thmor' => 'Kdam Thmor',
	'Keania One' => 'Keania One',
	'Kelly Slab' => 'Kelly Slab',
	'Kenia' => 'Kenia',
	'Khand' => 'Khand',
	'Khmer' => 'Khmer',
	'Khula' => 'Khula',
	'Kite One' => 'Kite One',
	'Knewave' => 'Knewave',
	'Kotta One' => 'Kotta One',
	'Koulen' => 'Koulen',
	'Kranky' => 'Kranky',
	'Kreon' => 'Kreon',
	'Kristi' => 'Kristi',
	'Krona One' => 'Krona One',
	'Kurale' => 'Kurale',
	'La Belle Aurore' => 'La Belle Aurore',
	'Laila' => 'Laila',
	'Lakki Reddy' => 'Lakki Reddy',
	'Lancelot' => 'Lancelot',
	'Lateef' => 'Lateef',
	'Lato' => 'Lato',
	'League Script' => 'League Script',
	'Leckerli One' => 'Leckerli One',
	'Ledger' => 'Ledger',
	'Lekton' => 'Lekton',
	'Lemon' => 'Lemon',
	'Libre Baskerville' => 'Libre Baskerville',
	'Life Savers' => 'Life Savers',
	'Lilita One' => 'Lilita One',
	'Lily Script One' => 'Lily Script One',
	'Limelight' => 'Limelight',
	'Linden Hill' => 'Linden Hill',
	'Lobster' => 'Lobster',
	'Lobster Two' => 'Lobster Two',
	'Londrina Outline' => 'Londrina Outline',
	'Londrina Shadow' => 'Londrina Shadow',
	'Londrina Sketch' => 'Londrina Sketch',
	'Londrina Solid' => 'Londrina Solid',
	'Lora' => 'Lora',
	'Love Ya Like A Sister' => 'Love Ya Like A Sister',
	'Loved by the King' => 'Loved by the King',
	'Lovers Quarrel' => 'Lovers Quarrel',
	'Luckiest Guy' => 'Luckiest Guy',
	'Lusitana' => 'Lusitana',
	'Lustria' => 'Lustria',
	'Macondo' => 'Macondo',
	'Macondo Swash Caps' => 'Macondo Swash Caps',
	'Magra' => 'Magra',
	'Maiden Orange' => 'Maiden Orange',
	'Mako' => 'Mako',
	'Mallanna' => 'Mallanna',
	'Mandali' => 'Mandali',
	'Marcellus' => 'Marcellus',
	'Marcellus SC' => 'Marcellus SC',
	'Marck Script' => 'Marck Script',
	'Margarine' => 'Margarine',
	'Marko One' => 'Marko One',
	'Marmelad' => 'Marmelad',
	'Martel' => 'Martel',
	'Martel Sans' => 'Martel Sans',
	'Marvel' => 'Marvel',
	'Mate' => 'Mate',
	'Mate SC' => 'Mate SC',
	'Maven Pro' => 'Maven Pro',
	'McLaren' => 'McLaren',
	'Meddon' => 'Meddon',
	'MedievalSharp' => 'MedievalSharp',
	'Medula One' => 'Medula One',
	'Megrim' => 'Megrim',
	'Meie Script' => 'Meie Script',
	'Merienda' => 'Merienda',
	'Merienda One' => 'Merienda One',
	'Merriweather' => 'Merriweather',
	'Merriweather Sans' => 'Merriweather Sans',
	'Metal' => 'Metal',
	'Metal Mania' => 'Metal Mania',
	'Metamorphous' => 'Metamorphous',
	'Metrophobic' => 'Metrophobic',
	'Michroma' => 'Michroma',
	'Microsoft YaHei' => 'Microsoft YaHei',
	'Milonga' => 'Milonga',
	'Miltonian' => 'Miltonian',
	'Miltonian Tattoo' => 'Miltonian Tattoo',
	'Miniver' => 'Miniver',
	'Miss Fajardose' => 'Miss Fajardose',
	'Modak' => 'Modak',
	'Modern Antiqua' => 'Modern Antiqua',
	'Molengo' => 'Molengo',
	'Molle' => 'Molle',
	'Monda' => 'Monda',
	'Monofett' => 'Monofett',
	'Monoton' => 'Monoton',
	'Monsieur La Doulaise' => 'Monsieur La Doulaise',
	'Montaga' => 'Montaga',
	'Montez' => 'Montez',
	'Montserrat' => 'Montserrat',
	'Montserrat Alternates' => 'Montserrat Alternates',
	'Montserrat Subrayada' => 'Montserrat Subrayada',
	'Moul' => 'Moul',
	'Moulpali' => 'Moulpali',
	'Mountains of Christmas' => 'Mountains of Christmas',
	'Mouse Memoirs' => 'Mouse Memoirs',
	'Mr Bedfort' => 'Mr Bedfort',
	'Mr Dafoe' => 'Mr Dafoe',
	'Mr De Haviland' => 'Mr De Haviland',
	'Mrs Saint Delafield' => 'Mrs Saint Delafield',
	'Mrs Sheppards' => 'Mrs Sheppards',
	'Muli' => 'Muli',
	'Mystery Quest' => 'Mystery Quest',
	'NTR' => 'NTR',
	'Neucha' => 'Neucha',
	'Neuton' => 'Neuton',
	'New Rocker' => 'New Rocker',
	'News Cycle' => 'News Cycle',
	'Niconne' => 'Niconne',
	'Nixie One' => 'Nixie One',
	'Nobile' => 'Nobile',
	'Nokora' => 'Nokora',
	'Norican' => 'Norican',
	'Nosifer' => 'Nosifer',
	'Nothing You Could Do' => 'Nothing You Could Do',
	'Noticia Text' => 'Noticia Text',
	'Noto Sans' => 'Noto Sans',
	'Noto Serif' => 'Noto Serif',
	'Nova Cut' => 'Nova Cut',
	'Nova Flat' => 'Nova Flat',
	'Nova Mono' => 'Nova Mono',
	'Nova Oval' => 'Nova Oval',
	'Nova Round' => 'Nova Round',
	'Nova Script' => 'Nova Script',
	'Nova Slim' => 'Nova Slim',
	'Nova Square' => 'Nova Square',
	'Numans' => 'Numans',
	'Nunito' => 'Nunito',
	'Odor Mean Chey' => 'Odor Mean Chey',
	'Offside' => 'Offside',
	'Old Standard TT' => 'Old Standard TT',
	'Oldenburg' => 'Oldenburg',
	'Oleo Script' => 'Oleo Script',
	'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
	'Open Sans' => 'Open Sans',
	'Open Sans Condensed' => 'Open Sans Condensed',
	'Oranienbaum' => 'Oranienbaum',
	'Orbitron' => 'Orbitron',
	'Oregano' => 'Oregano',
	'Orienta' => 'Orienta',
	'Original Surfer' => 'Original Surfer',
	'Oswald' => 'Oswald',
	'Over the Rainbow' => 'Over the Rainbow',
	'Overlock' => 'Overlock',
	'Overlock SC' => 'Overlock SC',
	'Ovo' => 'Ovo',
	'Oxygen' => 'Oxygen',
	'Oxygen Mono' => 'Oxygen Mono',
	'PT Mono' => 'PT Mono',
	'PT Sans' => 'PT Sans',
	'PT Sans Caption' => 'PT Sans Caption',
	'PT Sans Narrow' => 'PT Sans Narrow',
	'PT Serif' => 'PT Serif',
	'PT Serif Caption' => 'PT Serif Caption',
	'Pacifico' => 'Pacifico',
	'Palanquin' => 'Palanquin',
	'Palanquin Dark' => 'Palanquin Dark',
	'Paprika' => 'Paprika',
	'Parisienne' => 'Parisienne',
	'Passero One' => 'Passero One',
	'Passion One' => 'Passion One',
	'Pathway Gothic One' => 'Pathway Gothic One',
	'Patrick Hand' => 'Patrick Hand',
	'Patrick Hand SC' => 'Patrick Hand SC',
	'Patua One' => 'Patua One',
	'Paytone One' => 'Paytone One',
	'Peddana' => 'Peddana',
	'Peralta' => 'Peralta',
	'Permanent Marker' => 'Permanent Marker',
	'Petit Formal Script' => 'Petit Formal Script',
	'Petrona' => 'Petrona',
	'Philosopher' => 'Philosopher',
	'Piedra' => 'Piedra',
	'Pinyon Script' => 'Pinyon Script',
	'Pirata One' => 'Pirata One',
	'Plaster' => 'Plaster',
	'Play' => 'Play',
	'Playball' => 'Playball',
	'Playfair Display' => 'Playfair Display',
	'Playfair Display SC' => 'Playfair Display SC',
	'Podkova' => 'Podkova',
	'Poiret One' => 'Poiret One',
	'Poller One' => 'Poller One',
	'Poly' => 'Poly',
	'Pompiere' => 'Pompiere',
	'Pontano Sans' => 'Pontano Sans',
	'Poppins' => 'Poppins',
	'Port Lligat Sans' => 'Port Lligat Sans',
	'Port Lligat Slab' => 'Port Lligat Slab',
	'Pragati Narrow' => 'Pragati Narrow',
	'Prata' => 'Prata',
	'Preahvihear' => 'Preahvihear',
	'Press Start 2P' => 'Press Start 2P',
	'Princess Sofia' => 'Princess Sofia',
	'Prociono' => 'Prociono',
	'Prosto One' => 'Prosto One',
	'Puritan' => 'Puritan',
	'Purple Purse' => 'Purple Purse',
	'Quando' => 'Quando',
	'Quantico' => 'Quantico',
	'Quattrocento' => 'Quattrocento',
	'Quattrocento Sans' => 'Quattrocento Sans',
	'Questrial' => 'Questrial',
	'Quicksand' => 'Quicksand',
	'Quintessential' => 'Quintessential',
	'Qwigley' => 'Qwigley',
	'Racing Sans One' => 'Racing Sans One',
	'Radley' => 'Radley',
	'Rajdhani' => 'Rajdhani',
	'Raleway' => 'Raleway',
	'Raleway Dots' => 'Raleway Dots',
	'Ramabhadra' => 'Ramabhadra',
	'Ramaraja' => 'Ramaraja',
	'Rambla' => 'Rambla',
	'Rammetto One' => 'Rammetto One',
	'Ranchers' => 'Ranchers',
	'Rancho' => 'Rancho',
	'Ranga' => 'Ranga',
	'Rationale' => 'Rationale',
	'Ravi Prakash' => 'Ravi Prakash',
	'Redressed' => 'Redressed',
	'Reenie Beanie' => 'Reenie Beanie',
	'Revalia' => 'Revalia',
	'Rhodium Libre' => 'Rhodium Libre',
	'Ribeye' => 'Ribeye',
	'Ribeye Marrow' => 'Ribeye Marrow',
	'Righteous' => 'Righteous',
	'Risque' => 'Risque',
	'Roboto' => 'Roboto',
	'Roboto Condensed' => 'Roboto Condensed',
	'Roboto Mono' => 'Roboto Mono',
	'Roboto Slab' => 'Roboto Slab',
	'Rochester' => 'Rochester',
	'Rock Salt' => 'Rock Salt',
	'Rokkitt' => 'Rokkitt',
	'Romanesco' => 'Romanesco',
	'Ropa Sans' => 'Ropa Sans',
	'Rosario' => 'Rosario',
	'Rosarivo' => 'Rosarivo',
	'Rouge Script' => 'Rouge Script',
	'Rozha One' => 'Rozha One',
	'Rubik' => 'Rubik',
	'Rubik Mono One' => 'Rubik Mono One',
	'Rubik One' => 'Rubik One',
	'Ruda' => 'Ruda',
	'Rufina' => 'Rufina',
	'Ruge Boogie' => 'Ruge Boogie',
	'Ruluko' => 'Ruluko',
	'Rum Raisin' => 'Rum Raisin',
	'Ruslan Display' => 'Ruslan Display',
	'Russo One' => 'Russo One',
	'Ruthie' => 'Ruthie',
	'Rye' => 'Rye',
	'Sacramento' => 'Sacramento',
	'Sahitya' => 'Sahitya',
	'Sail' => 'Sail',
	'Salsa' => 'Salsa',
	'Sanchez' => 'Sanchez',
	'Sancreek' => 'Sancreek',
	'Sansita One' => 'Sansita One',
	'Sarala' => 'Sarala',
	'Sarina' => 'Sarina',
	'Sarpanch' => 'Sarpanch',
	'Satisfy' => 'Satisfy',
	'Scada' => 'Scada',
	'Scheherazade' => 'Scheherazade',
	'Schoolbell' => 'Schoolbell',
	'Seaweed Script' => 'Seaweed Script',
	'Sevillana' => 'Sevillana',
	'Seymour One' => 'Seymour One',
	'Shadows Into Light' => 'Shadows Into Light',
	'Shadows Into Light Two' => 'Shadows Into Light Two',
	'Shanti' => 'Shanti',
	'Share' => 'Share',
	'Share Tech' => 'Share Tech',
	'Share Tech Mono' => 'Share Tech Mono',
	'Shojumaru' => 'Shojumaru',
	'Short Stack' => 'Short Stack',
	'Siemreap' => 'Siemreap',
	'Sigmar One' => 'Sigmar One',
	'Signika' => 'Signika',
	'Signika Negative' => 'Signika Negative',
	'Simonetta' => 'Simonetta',
	'Sintony' => 'Sintony',
	'Sirin Stencil' => 'Sirin Stencil',
	'Six Caps' => 'Six Caps',
	'Skranji' => 'Skranji',
	'Slabo 13px' => 'Slabo 13px',
	'Slabo 27px' => 'Slabo 27px',
	'Slackey' => 'Slackey',
	'Smokum' => 'Smokum',
	'Smythe' => 'Smythe',
	'Sniglet' => 'Sniglet',
	'Snippet' => 'Snippet',
	'Snowburst One' => 'Snowburst One',
	'Sofadi One' => 'Sofadi One',
	'Sofia' => 'Sofia',
	'Sonsie One' => 'Sonsie One',
	'Sorts Mill Goudy' => 'Sorts Mill Goudy',
	'Source Code Pro' => 'Source Code Pro',
	'Source Sans Pro' => 'Source Sans Pro',
	'Source Serif Pro' => 'Source Serif Pro',
	'Special Elite' => 'Special Elite',
	'Spicy Rice' => 'Spicy Rice',
	'Spinnaker' => 'Spinnaker',
	'Spirax' => 'Spirax',
	'Squada One' => 'Squada One',
	'Sree Krushnadevaraya' => 'Sree Krushnadevaraya',
	'Stalemate' => 'Stalemate',
	'Stalinist One' => 'Stalinist One',
	'Stardos Stencil' => 'Stardos Stencil',
	'Stint Ultra Condensed' => 'Stint Ultra Condensed',
	'Stint Ultra Expanded' => 'Stint Ultra Expanded',
	'Stoke' => 'Stoke',
	'Strait' => 'Strait',
	'Sue Ellen Francisco' => 'Sue Ellen Francisco',
	'Sumana' => 'Sumana',
	'Sunshiney' => 'Sunshiney',
	'Supermercado One' => 'Supermercado One',
	'Sura' => 'Sura',
	'Suranna' => 'Suranna',
	'Suravaram' => 'Suravaram',
	'Suwannaphum' => 'Suwannaphum',
	'Swanky and Moo Moo' => 'Swanky and Moo Moo',
	'Syncopate' => 'Syncopate',
	'Tangerine' => 'Tangerine',
	'Taprom' => 'Taprom',
	'Tauri' => 'Tauri',
	'Teko' => 'Teko',
	'Telex' => 'Telex',
	'Tenali Ramakrishna' => 'Tenali Ramakrishna',
	'Tenor Sans' => 'Tenor Sans',
	'Text Me One' => 'Text Me One',
	'The Girl Next Door' => 'The Girl Next Door',
	'Tienne' => 'Tienne',
	'Tillana' => 'Tillana',
	'Timmana' => 'Timmana',
	'Tinos' => 'Tinos',
	'Titan One' => 'Titan One',
	'Titillium Web' => 'Titillium Web',
	'Trade Winds' => 'Trade Winds',
	'Trocchi' => 'Trocchi',
	'Trochut' => 'Trochut',
	'Trykker' => 'Trykker',
	'Tulpen One' => 'Tulpen One',
	'Ubuntu' => 'Ubuntu',
	'Ubuntu Condensed' => 'Ubuntu Condensed',
	'Ubuntu Mono' => 'Ubuntu Mono',
	'Ultra' => 'Ultra',
	'Uncial Antiqua' => 'Uncial Antiqua',
	'Underdog' => 'Underdog',
	'Unica One' => 'Unica One',
	'UnifrakturCook' => 'UnifrakturCook',
	'UnifrakturMaguntia' => 'UnifrakturMaguntia',
	'Unkempt' => 'Unkempt',
	'Unlock' => 'Unlock',
	'Unna' => 'Unna',
	'VT323' => 'VT323',
	'Vampiro One' => 'Vampiro One',
	'Varela' => 'Varela',
	'Varela Round' => 'Varela Round',
	'Vast Shadow' => 'Vast Shadow',
	'Vesper Libre' => 'Vesper Libre',
	'Vibur' => 'Vibur',
	'Vidaloka' => 'Vidaloka',
	'Viga' => 'Viga',
	'Voces' => 'Voces',
	'Volkhov' => 'Volkhov',
	'Vollkorn' => 'Vollkorn',
	'Voltaire' => 'Voltaire',
	'Waiting for the Sunrise' => 'Waiting for the Sunrise',
	'Wallpoet' => 'Wallpoet',
	'Walter Turncoat' => 'Walter Turncoat',
	'Warnes' => 'Warnes',
	'Wellfleet' => 'Wellfleet',
	'Wendy One' => 'Wendy One',
	'Wire One' => 'Wire One',
	'Work Sans' => 'Work Sans',
	'Xin Gothic' => 'Xin Gothic',
	'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
	'Yantramanav' => 'Yantramanav',
	'Yellowtail' => 'Yellowtail',
	'Yeseva One' => 'Yeseva One',
	'Yesteryear' => 'Yesteryear',
	'Zeyada' => 'Zeyada',
);

$font_preview = array(
	'text' => "<span class=\"nums\">1234567890</span><span class=\"uppers\">ABCDEFGHIKLMNOPQRSTVXYZ</span><span class=\"lowers\">abcdefghiklmnopqrstvxyz</span>",
	'size' => '25px'
);

$font_primary_list      = array_merge(array('none' => 'Use default'), $fonts_list);
$font_heading_list    = array_merge(array('none' => 'Use default'), $fonts_list);

$font_weights = array(
	'' => 'Use Default',
	300, 
	400, 
	500, 
	600, 
	700, 
	'bold' => 'Bold'
);

$text_transforms = array(
	''             => '用户默认',
	'none'         => '无', 
	'uppercase'    => '大写', 
	'lowercase'    => '小写', 
	'capitalize'   => '大写标题', 
);


$of_options[] = array( 	'name' 		=> 'Typography',
            'cnname' => '排版',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-font'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'typography-settings-tabs',
						'tabs'		=> array(
							'typography-settings-google'     => '谷歌字体',
							'typography-settings-custom'     => '自定义字体',
							'typography-settings-typekit'    => 'Typekit字体',
						)
				);
				
$of_options[] = array(  'name'		=> '使用自定义字体',
						'desc'   	=> '用你的首选字体替换默认主题字体',
						'id'   		=> 'use_custom_font',
						'std'   	=> 0,
						'folds'  	=> 1,
						'on'  		=> '开启',
						'off'  		=> '关闭',
						'type'   	=> 'switch',
						
						'afolds'	=> true,
						
						'tab_id' 	=> 'typography-settings-google'
					);

$of_options[] = array( 	'name' 		=> '主要字体',
						'desc' 		=> '用于主体和段落的字体类型',
						'id' 		=> 'font_primary',
						'std' 		=> 'Select a font',
						'type' 		=> 'select_google_font',
						'preview' 	=> $font_preview,
						'options' 	=> $font_primary_list,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-google'
				);

$of_options[] = array( 	'desc' 		=> '主要字体粗细',
						'id' 		=> 'font_primary_weight',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $font_weights,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-google'
				);

$of_options[] = array( 	'desc' 		=> '主要字体文本大小写',
						'id' 		=> 'font_primary_transform',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $text_transforms,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-google'
				);

$font_subsets = array(
	'latin-ext'    => 'Latin Ext',
	'cyrillic'     => 'Cyrillic',
	'greek'        => 'Greek',
	'vietnamese'   => 'Vietnamese',
	'cyrillic-ext' => 'Cyrillic Ext',
	'greek-ext'    => 'Greek Ext',
);
				
$of_options[] = array( 	'desc' 		=> "选择额外的子集来使用这个字体（可选）<br><small>注意：请确保字体已支持选定的字符集。</small>",
						'id' 		=> 'font_primary_subset',
						'std' 		=> '',
						'type' 		=> 'multicheck',
						'options' 	=> $font_subsets,
						'fold'		=> 'use_custom_font',
						
						'tab_id'	=> 'typography-settings-google'
				);

$of_options[] = array( 	'name' 		=> '标题字体',
						'desc' 		=> '选择要用于菜单和标题的主字体',
						'id' 		=> 'font_heading',
						'std' 		=> 'Select a font',
						'type' 		=> 'select_google_font',
						'preview' 	=> $font_preview,
						'options' 	=> $font_heading_list,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-google'
				);

$of_options[] = array( 	'desc' 		=> '标题字体粗细',
						'id' 		=> 'font_heading_weight',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $font_weights,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-google'
				);

$of_options[] = array( 	'desc' 		=> '标题字体文本大小写',
						'id' 		=> 'font_heading_transform',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $text_transforms,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-google'
				);
				
$of_options[] = array( 	'desc' 		=> "选择额外的子集来使用这个字体（可选）<br><small>注意：请确保字体已支持选定的字符集。</small>",
						'id' 		=> 'font_heading_subset',
						'std' 		=> '',
						'type' 		=> 'multicheck',
						'options' 	=> $font_subsets,
						'fold'		=> 'use_custom_font',
						
						'tab_id'	=> 'typography-settings-google'
				);

$of_options[] = array( 	'name' 		=> '自定义字体',
						'desc' 		=> "",
						'id' 		=> 'custom_gf_warning',
						'std' 		=> "<h3 style=\"margin: 0 0 10px;\">警告</h3>
						要包含自定义字体，必须启用<strong>谷歌字体</strong>选项卡中的<strong>使用自定义字体</strong>。",
						'icon' 		=> true,
						'type' 		=> 'info',
						
						'afold'		=> 'use_custom_font:notChecked',
						
						'tab_id' 	=> 'typography-settings-custom'
				);

$of_options[] = array( 	'name' 		=> '自定义字体',
						'desc' 		=> "",
						'id' 		=> 'custom_gf',
						'std' 		=> "<h3 style=\"margin: 0 0 10px;\">包含自定义的网页字体</h3>
						如果你想增加你个人的字体到你的网站（谷歌webfonts或任何Web字体提供商）你可以在下面应用字体参数。 <br />
						首先包含字体的网址资源，然后在该字段的下一个位置框中输入该字体的名称（不包括<em>font-family:</em>）。<br />
						否则，留空的话将使用上一页列表中被选择的默认字体。",
						'icon' 		=> true,
						'type' 		=> 'info',
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);


$of_options[] = array( 	'name' 		=> '自定义主要字体',
						'desc' 		=> '主要字体URL',
						'id' 		=> 'custom_primary_font_url',
						'std' 		=> "",
						'plc'		=> "i.e. http://fonts.googleapis.com/css?family=Oswald",
						'type' 		=> 'text',
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);


$of_options[] = array( 	'desc' 		=> '主要字体名称',
						'id' 		=> 'custom_primary_font_name',
						'std' 		=> "",
						'plc'		=> "'Oswald', sans-serif",
						'type' 		=> 'text',
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);

$of_options[] = array( 	'desc' 		=> '主要字体粗细',
						'id' 		=> 'custom_primary_font_weight',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $font_weights,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);

$of_options[] = array( 	'desc' 		=> '主要字体文本大小写',
						'id' 		=> 'custom_primary_font_transform',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $text_transforms,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);


$of_options[] = array( 	'name' 		=> '自定义标题字体',
						'desc' 		=> '标题字体URL',
						'id' 		=> 'custom_heading_font_url',
						'std' 		=> "",
						'plc'		=> "i.e. http://fonts.googleapis.com/css?family=Oswald",
						'type' 		=> 'text',
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);


$of_options[] = array( 	'desc' 		=> '标题字体名称',
						'id' 		=> 'custom_heading_font_name',
						'std' 		=> "",
						'plc'		=> "'Oswald', sans-serif",
						'type' 		=> 'text',
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);

$of_options[] = array( 	'desc' 		=> '标题字体粗细',
						'id' 		=> 'custom_heading_font_weight',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $font_weights,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);

$of_options[] = array( 	'desc' 		=> '标题字体文本大小',
						'id' 		=> 'custom_heading_font_transform',
						'std' 		=> "",
						'type' 		=> 'select',
						'options' 	=> $text_transforms,
						'fold'		=> 'use_custom_font',
						
						'tab_id' 	=> 'typography-settings-custom'
				);
				
$of_options[] = array(  'name'		=> 'Typekit字体',
						'desc'   	=> "如果你想使用Typekit字体，启用此设置",
						'id'   		=> 'use_tykekit_font',
						'std'   	=> 0,
						'folds'  	=> 1,
						'on'  		=> 'Enable',
						'off'  		=> 'Disable',
						'type'   	=> 'switch',
						
						'tab_id' 	=> 'typography-settings-typekit'
					);

$of_options[] = array( 	'desc' 		=> '在这里粘贴Typekit嵌入代码',
						'id' 		=> 'typekit_embed_code',
						'std' 		=> "",
						'type' 		=> 'textarea',
						'fold'		=> 'use_tykekit_font',
						
						'tab_id' 	=> 'typography-settings-typekit'
				);



$of_options[] = array( 	'name' 		=> 'Theme Styling',
             'cnname' 		=> '主题样式',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-tint'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'styling-settings-tabs',
						'tabs'		=> array(
							'styling-settings-skin'          => '自定义皮肤',
							'styling-settings-borders'       => '主题边框',
							'styling-settings-custom-css'    => '自定义CSS',
						)
				);
				
$of_options[] = array(  'name'		=> '自定义皮肤生成器',
						'desc'   	=> '为这个主题创建你自己的皮肤',
						'id'   		=> 'use_custom_skin',
						'std'   	=> 0,
						'folds'  	=> 1,
						'on'  		=> 'Yes',
						'off'  		=> 'No',
						'type'   	=> 'switch',
						
						'tab_id'	=> 'styling-settings-skin'
					);
				
$of_options[] = array(  'desc'   	=> '如果皮肤显示404错误或没有被应用，请勾选此选项。',
						'id'   		=> 'theme_skin_include_alternate',
						'std'   	=> 0,
						'type'   	=> 'checkbox',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
					);

$of_options[] = array(	'name'		=> '皮肤颜色',
						'desc'   	=> '背景颜色',
						'id'   		=> 'custom_skin_bg_color',
						'std'   	=> '#FFF',
						'type'   	=> 'color',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
					);

$of_options[] = array(	'desc'   	=> '链接颜色',
						'id'   		=> 'custom_skin_link_color',
						'std'   	=> '#F6364D',
						'type'   	=> 'color',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
					);

$of_options[] = array(	'desc'   	=> '标题颜色',
						'id'   		=> 'custom_skin_headings_color',
						'std'   	=> '#F6364D',
						'type'   	=> 'color',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
					);

$of_options[] = array(	'desc'   	=> '段落颜色',
						'id'   		=> 'custom_skin_paragraph_color',
						'std'   	=> '#777777',
						'type'   	=> 'color',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
					);

$of_options[] = array(	'desc'   	=> '页脚背景颜色',
						'id'   		=> 'custom_skin_footer_bg_color',
						'std'   	=> '#FAFAFA',
						'type'   	=> 'color',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
					);

$of_options[] = array(	'desc'   	=> '边框颜色',
						'id'   		=> 'custom_skin_borders_color',
						'std'   	=> '#EEEEEE',
						'type'   	=> 'color',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
					);
					

$of_options[] = array( 	'name' 		=> 'Custom CSS',
						'desc' 		=> "",
						'id' 		=> 'skin_palettes_list',
						'std' 		=> "
						<h3 style=\"margin: 0 0 10px;\">我们的预设皮肤调色板</h3>".
						'
						<a href="#" class=\'skin-palette\'>
							<span style="background-color: #FFF;"></span>
							<span style="background-color: #F6364D;"></span>
							<span style="background-color: #F6364D;"></span>
							<span style="background-color: #777;"></span>
							<span style="background-color: #FAFAFA;"></span>
							<span style="background-color: #EEE;"></span>
							
							<em>Pink</em>
						</a>
						
						<a href="#" class=\'skin-palette\'>
							<span style="background-color: #f2f0ec;"></span>
							<span style="background-color: #e09a0e;"></span>
							<span style="background-color: #242321;"></span>
							<span style="background-color: #242321;"></span>
							<span style="background-color: #ece9e4;"></span>
							<span style="background-color: #FFF;"></span>
							
							<em>Gold</em>
						</a>
						
						<a href="#" class=\'skin-palette\'>
							<span style="background-color: #FFF;"></span>
							<span style="background-color: #a58f60;"></span>
							<span style="background-color: #222;"></span>
							<span style="background-color: #555;"></span>
							<span style="background-color: #EAEAEA;"></span>
							<span style="background-color: #EEE;"></span>
							
							<em>Creme</em>
						</a>
						
						<a href="#" class=\'skin-palette\'>
							<span style="background-color: #333333;"></span>
							<span style="background-color: #FBC441;"></span>
							<span style="background-color: #FFF;"></span>
							<span style="background-color: #CCC;"></span>
							<span style="background-color: #222;"></span>
							<span style="background-color: #333;"></span>
							
							<em>Dark Skin</em>
						</a>
						'
						,
						'icon' 		=> true,
						'type' 		=> 'info',
						'fold'  	=> 'use_custom_skin',
						
						'tab_id'	=> 'styling-settings-skin',
				);


				

// BORDERS
/*
$of_options[] = array( 	'name' 		=> 'Borders',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-square-o'
				);
*/
				
$of_options[] = array(  'name'		=> '主题边框',
						'desc'   	=> '显示或隐藏主题边框',
						'id'   		=> 'theme_borders',
						'std'   	=> 0,
						'folds'  	=> 1,
						'on'  		=> '显示',
						'off'  		=> '隐藏',
						'type'   	=> 'switch',
						
						'tab_id'	=> 'styling-settings-borders'
					);
				
$of_options[] = array(  'name'		=> '边框设置',
						'desc'   	=> '用动画显示边框',
						'id'   		=> 'theme_borders_animation',
						'std'   	=> 'fade',
						'options'	=> array(
							'none'   => 'No Animations',
							'fade'   => 'Fade In',
							'slide'  => 'Slide In',
						),
						'type'   	=> 'select',
						'fold'  	=> 'theme_borders',
						
						'tab_id'	=> 'styling-settings-borders',
						
						'afolds'	=> 1
					);
				
$of_options[] = array(  'desc'   	=> '边框动画持续时间 秒（如果动画是启用的）',
						'id'   		=> 'theme_borders_animation_duration',
						'std'   	=> '1',
						'type'   	=> 'text',
						'numeric'	=> true,
						'fold'  	=> 'theme_borders',
						
						'afold'		=> 'theme_borders_animation:fade,slide',
						
						'tab_id'	=> 'styling-settings-borders',
					);
				
$of_options[] = array(  'desc'   	=> '边框动画延迟 秒 （如果动画是启用的）',
						'id'   		=> 'theme_borders_animation_delay',
						'std'   	=> '0.2',
						'type'   	=> 'text',
						'numeric'	=> true,
						'fold'  	=> 'theme_borders',
						
						'afold'		=> 'theme_borders_animation:fade,slide',
						
						'tab_id'	=> 'styling-settings-borders',
					);
				
$of_options[] = array(  'desc'   	=> '边框厚度',
						'id'   		=> 'theme_borders_thickness',
						'std'   	=> '',
						'plc'		=> '如果不设置，默认使用: 22',
						'type'   	=> 'text',
						'postfix'	=> 'px',
						'numeric'	=> true,
						'fold'  	=> 'theme_borders',
						
						'tab_id'	=> 'styling-settings-borders',
					);

$of_options[] = array(	'desc'   	=> '设置边框颜色',
						'id'   		=> 'theme_borders_color',
						'std'   	=> '#f3f3ef',
						'type'   	=> 'color',
						'fold'  	=> 'theme_borders',
						
						'tab_id'	=> 'styling-settings-borders',
					);
// END OF BORDERS

					

$of_options[] = array( 	'name' 		=> '自定义CSS',
						'desc' 		=> "",
						'id' 		=> 'custom_css_feature',
						'std' 		=> "<h3 style=\"margin: 0 0 10px;\">自定义CSS</h3>
						<p>我们已经移动了这个选项，将它从主题设置搬到了我们指定的自定义CSS工具。点击下面的按钮来添加你自己的CSS：</p>
						<a href=\"admin.php?page=laborator_custom_css\" class=\"button\">前往自定义CSS编辑器</a>",
						'icon' 		=> true,
						'type' 		=> 'info',
						
						'tab_id'	=> 'styling-settings-custom-css'
				);


$of_options[] = array( 	'name' 		=> 'Social Networks',
           'cnname' 		=> '社交网络',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-share-alt'
				);

$social_networks_ordering = array(
			'visible' => array (
				'placebo'	=> 'placebo',
				'fb'   	 	=> 'Facebook',
				'tw'   	 	=> 'Twitter',
				'ig'        => 'Instagram',
				'vm'        => 'Vimeo',
				'be'        => 'Behance',
				'fs'        => 'Foursquare',
				'custom'    => 'Custom Link',
			),

			'hidden' => array (
				'placebo'   => 'placebo',
				'gp'        => "Google+",
				'lin'       => 'LinkedIn',
				'yt'        => 'YouTube',
				'drb'       => 'Dribbble',
				'pi'        => 'Pinterest',
				'vk'        => 'VKontakte',
				'da'        => 'DeviantArt',
				'fl'        => 'Flickr',
				'vi'        => 'Vine',
				'tu'        => 'Tumblr',
				'sk'        => 'Skype',
				'gh'        => 'GitHub',
				'sc'        => 'SoundCloud',
				'hz'        => 'Houzz',
				'px'        => '500px',
				'xi'        => 'Xing',
				'sp'        => 'Spotify',
				'sn'        => 'Snapchat',
			),
);

$of_options[] = array( 	'name' 		=> '社交网络调整',
						'desc' 		=> "设置在页脚出现的社交网络按钮顺序。复制这个短代码来使用社交网络链接列表：<br> " . $lab_social_networks_shortcode,
						'id' 		=> 'social_order',
						'std' 		=> $social_networks_ordering,
						'type' 		=> 'sorter'
				);
				

$of_options[] = array( 	'name'		=> '链接目标',
						'desc' 		=> '在新窗口或当前窗口中打开社交链接',
						'id' 		=> 'social_networks_target_attr',
						'std' 		=> '_blank',
						'type' 		=> 'select',
						'options' 	=> array(
							'_self'  => 'Same Window',
							'_blank' => 'New Window',
						)
				);

$of_options[] = array( 	'name' 		=> '社交网络',
						'desc' 		=> 'Facebook',
						'id' 		=> 'social_network_link_fb',
						'std' 		=> "",
						'plc'		=> "http://facebook.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Twitter',
						'id' 		=> 'social_network_link_tw',
						'std' 		=> "",
						'plc'		=> "http://twitter.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'LinkedIn',
						'id' 		=> 'social_network_link_lin',
						'std' 		=> "",
						'plc'		=> "http://linkedin.com/in/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'YouTube',
						'id' 		=> 'social_network_link_yt',
						'std' 		=> "",
						'plc'		=> "http://youtube.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Vimeo',
						'id' 		=> 'social_network_link_vm',
						'std' 		=> "",
						'plc'		=> "http://vimeo.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Dribbble',
						'id' 		=> 'social_network_link_drb',
						'std' 		=> "",
						'plc'		=> "http://dribbble.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Instagram',
						'id' 		=> 'social_network_link_ig',
						'std' 		=> "",
						'plc'		=> "http://instagram.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Pinterest',
						'id' 		=> 'social_network_link_pi',
						'std' 		=> "",
						'plc'		=> "http://pinterest.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Google Plus',
						'id' 		=> 'social_network_link_gp',
						'std' 		=> "",
						'plc'		=> "http://plus.google.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'VKontakte',
						'id' 		=> 'social_network_link_vk',
						'std' 		=> "",
						'plc'		=> "http://vk.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'DeviantArt',
						'id' 		=> 'social_network_link_da',
						'std' 		=> "",
						'plc'		=> "http://username.deviantart.com",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Tumblr',
						'id' 		=> 'social_network_link_tu',
						'std' 		=> "",
						'plc'		=> "http://username.tumblr.com",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Vine',
						'id' 		=> 'social_network_link_vi',
						'std' 		=> "",
						'plc'		=> "http://vine.co/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Behance',
						'id' 		=> 'social_network_link_be',
						'std' 		=> "",
						'plc'		=> "http://www.behance.net/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Flickr',
						'id' 		=> 'social_network_link_fl',
						'std' 		=> "",
						'plc'		=> "http://www.flickr.com/photos/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Foursquare',
						'id' 		=> 'social_network_link_fs',
						'std' 		=> "",
						'plc'		=> "http://foursquare.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Skype',
						'id' 		=> 'social_network_link_sk',
						'std' 		=> "",
						'plc'		=> 'skype:username',
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'GitHub',
						'id' 		=> 'social_network_link_gh',
						'std' 		=> "",
						'plc'		=> "https://github.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'SoundCloud',
						'id' 		=> 'social_network_link_sc',
						'std' 		=> "",
						'plc'		=> "https://soundcloud.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Houzz',
						'id' 		=> 'social_network_link_hz',
						'std' 		=> "",
						'plc'		=> "http://www.houzz.com/user/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> '500px',
						'id' 		=> 'social_network_link_px',
						'std' 		=> "",
						'plc'		=> "https://500px.com/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Xing',
						'id' 		=> 'social_network_link_xi',
						'std' 		=> "",
						'plc'		=> "https://www.xing.com/profile/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Spotify',
						'id' 		=> 'social_network_link_sp',
						'std' 		=> "",
						'plc'		=> "https://open.spotify.com/user/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> "",
						'desc' 		=> 'Snapchat',
						'id' 		=> 'social_network_link_sn',
						'std' 		=> "",
						'plc'		=> "https://www.snapchat.com/add/username",
						'type' 		=> 'text'
				);

$of_options[] = array( 	'name' 		=> '自定义链接',
						'desc' 		=> '链接标题',
						'id' 		=> 'social_network_custom_link_title',
						'std' 		=> "",
						'plc'		=> 'My Custom Link',
						'type' 		=> 'text'
				);

$of_options[] = array( 	'desc' 		=> '链接地址',
						'id' 		=> 'social_network_custom_link_link',
						'std' 		=> "",
						'plc'		=> "http://www.mywebsite.com/",
						'type' 		=> 'text'
				);



$of_options[] = array( 	'name' 		=> 'Coming Soon Mode',
            'cnname' 		=> '即将来临模式',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-clock-o',
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'coming-soon-settings-tabs',
						'tabs'		=> array(
							'coming-soon-settings-main'          => '基本设置',
							'coming-soon-settings-countdown'     => '倒数计时器',
							'coming-soon-settings-custom-bg'     => '自定义背景',
							'coming-soon-settings-custom-logo'   => '自定义LOGO',
						)
				);


$of_options[] = array( 	'name' 		=> '即将来临模式警告',
						'desc' 		=> "",
						'id' 		=> 'custom_coming_soon_warning',
						'std' 		=> "<h3 style=\"margin: 0 0 10px;\">警告</h3>
						要查看此选项卡上的设置，你必须启用“基本设置”选项卡中的“即将来临”模式。.",
						'icon' 		=> true,
						'type' 		=> 'info',
						
						'afold'		=> 'coming_soon_mode:notChecked',
						
						'tab_id' 	=> 'coming-soon-settings-countdown'
				);

$last = end( $of_options );

$last['tab_id'] = 'coming-soon-settings-custom-bg'; 
$of_options[] = $last;

$last['tab_id'] = 'coming-soon-settings-custom-logo'; 
$of_options[] = $last;

$of_options[] = array(	'name'		=> '即将来临模式',
						'desc'   	=> "激活带倒数计时器的即将来临模式 <br /><small>请注意，作为一个管理员，你不会看到即将到来模式页面，除非你点击<a href=\"" . home_url( '?view-coming-soon=true' ) . "\" target=\"_blank\">这里</a>。</small>",
						'id'   		=> 'coming_soon_mode',
						'std'   	=> 0,
						'on'  		=> '启用',
						'off'  		=> '禁用',
						'type'   	=> 'switch',
						'afolds'	=> 1,
						
						'tab_id'	=> 'coming-soon-settings-main'
					);

$of_options[] = array( 	'name' 		=> '标题和描述',
						'desc' 		=> '设置在这页显示的页面标题(留空使用网站标语)',
						'id' 		=> 'coming_soon_mode_title',
						'std' 		=> "",
						'type' 		=> 'text',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-main'
				);

$of_options[] = array( 	'desc' 		=> '向你的访客解释为什么或什么时候回来的描述文本。',
						'id' 		=> 'coming_soon_mode_description',
						'std' 		=> "We are currently working on the back-end,
our team is working hard and we鈥檒l be back within the time",
						'type' 		=> 'textarea',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-main'
				);

$of_options[] = array(	'name'   	=> '社交网络',
						'desc'   	=> '在该页页脚中显示或隐藏社交网络按钮',
						'id'   		=> 'coming_soon_mode_social_networks',
						'std'   	=> 0,
						'on'  		=> '显示',
						'off'  		=> '隐藏',
						'type'   	=> 'switch',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-main'
					);

$of_options[] = array(	'name'   	=> '倒数计时器',
						'desc'   	=> '显示或隐藏倒数计时器',
						'id'   		=> 'coming_soon_mode_countdown',
						'std'   	=> 0,
						'on'  		=> '显示',
						'off'  		=> '隐藏',
						'type'   	=> 'switch',
						'folds'  	=> 1,
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-countdown'
					);

$of_options[] = array( 	'name'		=> '发布日期',
						'desc' 		=> '输入网站即将上线的日期(格式 YYYY-MM-DD HH:MM:SS)',
						'id' 		=> 'coming_soon_mode_date',
						'std' 		=> date('Y-m-d', strtotime("+3 months")) . ' 18:00:00',
						'plc'		=> "http://plus.google.com/username",
						'type' 		=> 'text',
						'fold'		=> 'coming_soon_mode_countdown',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-countdown'
				);

$of_options[] = array(	'name'   	=> '自定义背景',
						'desc'   	=> '包含此页的自定义背景图像',
						'id'   		=> 'coming_soon_mode_custom_bg',
						'std'   	=> 0,
						'on'  		=> '开启',
						'off'  		=> '关闭',
						'type'   	=> 'switch',
						'folds'  	=> 1,
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-bg'
					);

$of_options[] = array(	'name' 		=> '上传背景图像',
						'desc' 		=> "从画廊中上传/选择你的自定义背景图像",
						'id' 		=> 'coming_soon_mode_custom_bg_id',
						'std' 		=> "",
						'type' 		=> 'media',
						'mod' 		=> 'min',
						'fold' 		=> 'coming_soon_mode_custom_bg',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-bg'
					);

$of_options[] = array( 	'desc' 		=> '背景填充选项',
						'id' 		=> 'coming_soon_mode_custom_bg_size',
						'std' 		=> 'cover',
						'type' 		=> 'select',
						'options' 	=> array(
							'cover'      => '覆盖',
							'contain'    => '包含',
						),
						'fold'		=> 'coming_soon_mode_custom_bg',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-bg'
				);

$of_options[] = array( 	'desc' 		=> '背景颜色（可选）',
						'id' 		=> 'coming_soon_mode_custom_bg_color',
						'std' 		=> '',
						'type' 		=> 'color',
						'fold'		=> 'coming_soon_mode_custom_bg',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-bg'
				);

$of_options[] = array( 	'desc' 		=> '文本颜色（可选）',
						'id' 		=> 'coming_soon_mode_custom_txt_color',
						'std' 		=> '',
						'type' 		=> 'color',
						'fold'		=> 'coming_soon_mode_custom_bg',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-bg'
				);

$of_options[] = array(	'name'   	=> '自定义Logo',
						'desc'   	=> '使用自定义Logo',
						'id'   		=> 'coming_soon_mode_use_uploaded_logo',
						'std'   	=> 0,
						'on'  		=> '开启',
						'off'  		=> '关闭',
						'type'   	=> 'switch',
						'folds'  	=> 1,
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-logo'
					);

$of_options[] = array(	'name' 		=> '上传Logo',
						'desc' 		=> "如果你想替代LOGO位置的默认上传LOGO，请从画廊中选择上传你的自定义LOGO。",
						'id' 		=> 'coming_soon_mode_custom_logo_image',
						'std' 		=> "",
						'type' 		=> 'media',
						'mod' 		=> 'min',
						'fold' 		=> 'coming_soon_mode_use_uploaded_logo',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-logo'
					);

$of_options[] = array( 	'desc' 		=> '设置上传LOGO的最大宽度',
						'id' 		=> 'coming_soon_mode_custom_logo_max_width',
						'std' 		=> "",
						'plc'		=> 'Logo Width',
						'type' 		=> 'text',
						'numeric'	=> true,
						'postfix'	=> 'px',
						'fold' 		=> 'coming_soon_mode_use_uploaded_logo',
						'afold'		=> 'coming_soon_mode:checked',
						
						'tab_id'	=> 'coming-soon-settings-custom-logo'
				);



$of_options[] = array( 	'name' 		=> 'Maintenance Mode',
            'cnname' 		=> '维护模式',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-wrench',
				);

$of_options[] = array(	'name'   	=> '维护模式',
						'desc'   	=> "启用或禁用维护模式。请注意，如果即将来临模式启用，那么此页将不可见。 <br /><small>请注意，作为一个管理员，你不会看到即将来临模式页面，除非你点击<a href=\"" . home_url( '?view-maintenance=true' ) . "\" target=\"_blank\">这里</a>。</small>",
						'id'   		=> 'maintenance_mode',
						'std'   	=> 0,
						'on'  		=> '启用',
						'off'  		=> '禁用',
						'type'   	=> 'switch',
						'folds'		=> 1
					);

$of_options[] = array( 	'name' 		=> '标题和描述',
						'desc' 		=> '设置此页页面标题(留空使用站点标语)',
						'id' 		=> 'maintenance_mode_title',
						'std' 		=> "",
						'type' 		=> 'text',
						'fold'		=> 'maintenance_mode'
				);

$of_options[] = array( 	'desc' 		=> '向你的访客解释为什么该站处于维护模式的描述文本。',
						'id' 		=> 'maintenance_mode_description',
						'std' 		=> "We are currently working on the back-end,
our team is working hard and we鈥檒l be back within the time",
						'type' 		=> 'textarea',
						'fold'		=> 'maintenance_mode'
				);

$of_options[] = array(	'name'   	=> '自定义背景',
						'desc'   	=> '包含此页的自定义背景图像',
						'id'   		=> 'maintenance_mode_custom_bg',
						'std'   	=> 0,
						'on'  		=> '开启',
						'off'  		=> '关闭',
						'type'   	=> 'switch',
						'folds'  	=> 1,
						'fold'		=> 'maintenance_mode'
					);

$of_options[] = array(	'name' 		=> '上传背景图像',
						'desc' 		=> "从画廊中上传/选择你的自定义背景图像",
						'id' 		=> 'maintenance_mode_custom_bg_id',
						'std' 		=> "",
						'type' 		=> 'media',
						'mod' 		=> 'min',
						'fold' 		=> 'maintenance_mode_custom_bg'
					);

$of_options[] = array( 	'desc' 		=> '背景填充选项',
						'id' 		=> 'maintenance_mode_custom_bg_size',
						'std' 		=> 'cover',
						'type' 		=> 'select',
						'options' 	=> array(
							'cover'      => '覆盖',
							'contain'    => '包含',
						),
						'fold'		=> 'maintenance_mode_custom_bg'
				);

$of_options[] = array( 	'desc' 		=> '背景颜色（可选）',
						'id' 		=> 'maintenance_mode_custom_bg_color',
						'std' 		=> '',
						'type' 		=> 'color',
						'fold'		=> 'maintenance_mode_custom_bg'
				);

$of_options[] = array( 	'desc' 		=> '文本颜色（可选）',
						'id' 		=> 'maintenance_mode_custom_txt_color',
						'std' 		=> '',
						'type' 		=> 'color',
						'fold'		=> 'maintenance_mode_custom_bg'
				);


// Backup Options
$of_options[] = array( 	'name' 		=> 'Backup Options',
            'cnname' 		=> '备份选项',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-download'
				);

$of_options[] = array( 	'name' 		=> '备份和恢复选项',
						'id' 		=> 'of_backup',
						'std' 		=> "",
						'type' 		=> 'backup',
						'desc' 		=> '您可以使用下面的两个按钮来备份当前选项，然后在稍后还原它。如果你想尝试设置一下，但以防你需要恢复为此想保留旧的设置，这是非常有用的。',
				);

$of_options[] = array( 	'name' 		=> '转移主题选项数据',
						'id' 		=> 'of_transfer',
						'std' 		=> "",
						'type' 		=> 'transfer',
						'desc' 		=> '你能通过复制文本框中的文本在不同的安装间转移保存的主题选项数据。要从另一个安装导入数据，请用另一个安装中的数据替换文本框中的数据，并点击“导入选项”按钮。',
				);

// Backup Options
$of_options[] = array( 	'name' 		=> 'WordPress Leaf',
            	'cnname' 		=> '汉化作者',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-sort-amount-asc'
				);

$of_options[] = array( 	'type' 		=> 'tabs',
						'id'		=> 'wordpressleaf-tabs',
						'tabs'		=> array(
							'wordpress_leaf_main_tab'   => '汉化作者',
						)
				);
				
				
$of_options[] = array( 	'name' 		=> 'WordPress Leaf',
						'desc' 		=> "",
						'id' 		=> 'wordpressleaf_tab',
						'std' 		=> "
						<h3 style=\"margin: 0 0 10px;\">WordPress Leaf</h3>
						<p>
							Kalium主题中文汉化版 由<a href=\"http://www.wordpressleaf.com/\" target=\"_blank\"> WordPress Leaf</a> 荣誉出品<br>
							<a target=\"_blank\" href=\"http://www.wordpressleaf.com\" class=\"wordpressleaf-badge wp-badge\">WordPress Leaf</a><br>
							注意：Kalium主题中文汉化版仅做学习使用，WordPress Leaf对可能出现的BUG或漏洞不承担任何责任，你可以请前往<a href=\"https://themeforest.net/user/laborator/portfolio\" target=\"_blank\"> 官方网站</a>购买英文正版。<br>
							<br>
							<h3 style=\"margin: 0 0 10px;\">捐助我们</h3>
							如果您愿意捐助我们，请点击<a href=\"http://www.wordpressleaf.com/donate\" target=\"_blank\"><strong>这里</strong></a>或者使用微信扫描下面的二维码进行捐助。谢谢！<br>
							<img src=\"http://www.wordpressleaf.com/wp-content/themes/wordpressleaf/assets/images/weixin.png\" width=\"140\" height=\"140\" alt=\"捐助我们\">  <br>
							如果网络不可用，请扫描下面这张的本地二维码 :)。<br>
							<img src=\"".THEMEASSETS . "images/admin/portfolio-grid/weixin.png\" width=\"140\" height=\"140\" alt=\"捐助我们\"><br>
							您可以加入QQ群对主题进行讨论：489986071。<br>
							
						</p>",
						'icon' 		=> true,
						'type' 		=> 'info',
						
						'tab_id'	=> 'wordpress_leaf_main_tab'
					);			

$of_options[] = array( 	'name' 		=> 'Documentation',
            'cnname' 		=> '文档',
						'type' 		=> 'heading',
						'icon'		=> 'fa fa-life-ring',
						'redirect'	=> admin_url('admin.php?page=laborator_docs')
				);

$of_options[] = array( 	'name' 		=> 'Theme Documentation',
						'desc' 		=> "",
						'id' 		=> 'theme_documentation',
						'std' 		=> "<h3 style=\"margin: 0 0 10px;\">Theme Documentation</h3>
						<a href=\"" . admin_url( 'themes.php?page=laborator_docs' ) . "\">Click here to access theme documentation &raquo;</a>",
						'icon' 		=> true,
						'type' 		=> 'info'
				);

	}//End function: of_options()
	
}//End check if function exists: of_options()
