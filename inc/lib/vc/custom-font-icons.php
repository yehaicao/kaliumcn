<?php
/**
 *	Custom Font Icons
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

add_action( 'vc_after_init', 'lab_vc_custom_icon_fonts' );
add_action( 'vc_enqueue_font_icon_element', 'lab_vc_custom_icon_fonts_enqueue' );

add_action( 'vc_backend_editor_enqueue_js_css', 'lab_vc_iconpicker_editor_jscss' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'lab_vc_iconpicker_editor_jscss' );

add_filter( 'vc_iconpicker-type-linea', 'lab_custom_icon_font_list_linea' ); # Linea Icons List


function lab_vc_custom_icon_fonts() {
	
	# Add Extra Icon Fonts
	$param = WPBMap::getParam( 'vc_icon', 'type' );
	
	if( ! is_array($param))
	{
		return false;
	}
	
	$param['weight'] = 2;
	
	$param['value'] = array( 'Linea' => 'linea' ) + $param['value'];

	vc_update_shortcode_param( 'vc_icon', $param );


	# Add Param Type
	$attributes = array(
		'type'        => 'iconpicker',
		'heading'     => __('Icon', 'lab_composer' ),
		'param_name'  => 'icon_linea',
		'value'       => 'icon-basic-accelerator',
		'weight'	  => 1,
		'settings'    => array(
			'emptyIcon'      => false,
			'type'           => 'linea',
			'iconsPerPage'   => -1,
		),
		'dependency' => array(
			'element' => 'type',
			'value'   => 'linea',
		),
		'description' => 'Select icon from library.',
	);

	vc_add_param( 'vc_icon', $attributes );
	
	
	# Set Default Color to Black
	$param = WPBMap::getParam( 'vc_icon', 'color' );
	$param['std'] = 'black';
	
	vc_update_shortcode_param( 'vc_icon', $param );
	
	
	# Custom Icon
	add_action( 'admin_print_styles', 'lab_vc_custom_icon_css' );
}

function lab_vc_custom_icon_css() {
	# Change Icon for VC_ICON element
	$lab_vc_element_icon = site_url( str_replace( ABSPATH, '', dirname( __FILE__ ) . '/' ) ) . 'icon.png';
	
	?>
	<style>
	.wpb-elements-list-modal li[data-element="vc_icon"] .vc_element-icon {
		background-image: url(<?php echo $lab_vc_element_icon; ?>) !important;
		background-position: center center;
		background-size: 40px;
	}
	</style>
	<?php
}


function lab_vc_custom_icon_fonts_enqueue( $font ) {
	switch( $font ) {
		case "linea":
			wp_enqueue_style( 'font-lineaicons' );
			break;
	}
}


function lab_vc_iconpicker_editor_jscss() {
	wp_enqueue_style( 'font-lineaicons' );
}


function lab_custom_icon_font_list_linea( $icons ) {
	$linea_icons = array(
		array( 'icon-basic-accelerator' => 'Accelerator' ),
		array( 'icon-basic-alarm' => 'Alarm' ),
		array( 'icon-basic-anchor' => 'Anchor' ),
		array( 'icon-basic-anticlockwise' => 'Anticlockwise' ),
		array( 'icon-basic-archive' => 'Archive' ),
		array( 'icon-basic-archive-full' => 'Archive Full' ),
		array( 'icon-basic-ban' => 'Ban' ),
		array( 'icon-basic-battery-charge' => 'Battery Charge' ),
		array( 'icon-basic-battery-empty' => 'Battery Empty' ),
		array( 'icon-basic-battery-full' => 'Battery Full' ),
		array( 'icon-basic-battery-half' => 'Battery Half' ),
		array( 'icon-basic-bolt' => 'Bolt' ),
		array( 'icon-basic-book' => 'Book' ),
		array( 'icon-basic-book-pen' => 'Book Pen' ),
		array( 'icon-basic-book-pencil' => 'Book Pencil' ),
		array( 'icon-basic-bookmark' => 'Bookmark' ),
		array( 'icon-basic-calculator' => 'Calculator' ),
		array( 'icon-basic-calendar' => 'Calendar' ),
		array( 'icon-basic-cards-diamonds' => 'Cards Diamonds' ),
		array( 'icon-basic-cards-hearts' => 'Cards Hearts' ),
		array( 'icon-basic-case' => 'Case' ),
		array( 'icon-basic-chronometer' => 'Chronometer' ),
		array( 'icon-basic-clessidre' => 'Clessidre' ),
		array( 'icon-basic-clock' => 'Clock' ),
		array( 'icon-basic-clockwise' => 'Clockwise' ),
		array( 'icon-basic-cloud' => 'Cloud' ),
		array( 'icon-basic-clubs' => 'Clubs' ),
		array( 'icon-basic-compass' => 'Compass' ),
		array( 'icon-basic-cup' => 'Cup' ),
		array( 'icon-basic-diamonds' => 'Diamonds' ),
		array( 'icon-basic-display' => 'Display' ),
		array( 'icon-basic-download' => 'Download' ),
		array( 'icon-basic-exclamation' => 'Exclamation' ),
		array( 'icon-basic-eye' => 'Eye' ),
		array( 'icon-basic-eye-closed' => 'Eye Closed' ),
		array( 'icon-basic-female' => 'Female' ),
		array( 'icon-basic-flag1' => 'Flag1' ),
		array( 'icon-basic-flag2' => 'Flag2' ),
		array( 'icon-basic-floppydisk' => 'Floppydisk' ),
		array( 'icon-basic-folder' => 'Folder' ),
		array( 'icon-basic-folder-multiple' => 'Folder Multiple' ),
		array( 'icon-basic-gear' => 'Gear' ),
		array( 'icon-basic-geolocalize-01' => 'Geolocalize 01' ),
		array( 'icon-basic-geolocalize-05' => 'Geolocalize 05' ),
		array( 'icon-basic-globe' => 'Globe' ),
		array( 'icon-basic-gunsight' => 'Gunsight' ),
		array( 'icon-basic-hammer' => 'Hammer' ),
		array( 'icon-basic-headset' => 'Headset' ),
		array( 'icon-basic-heart' => 'Heart' ),
		array( 'icon-basic-heart-broken' => 'Heart Broken' ),
		array( 'icon-basic-helm' => 'Helm' ),
		array( 'icon-basic-home' => 'Home' ),
		array( 'icon-basic-info' => 'Info' ),
		array( 'icon-basic-ipod' => 'Ipod' ),
		array( 'icon-basic-joypad' => 'Joypad' ),
		array( 'icon-basic-key' => 'Key' ),
		array( 'icon-basic-keyboard' => 'Keyboard' ),
		array( 'icon-basic-laptop' => 'Laptop' ),
		array( 'icon-basic-life-buoy' => 'Life Buoy' ),
		array( 'icon-basic-lightbulb' => 'Lightbulb' ),
		array( 'icon-basic-link' => 'Link' ),
		array( 'icon-basic-lock' => 'Lock' ),
		array( 'icon-basic-lock-open' => 'Lock Open' ),
		array( 'icon-basic-magic-mouse' => 'Magic Mouse' ),
		array( 'icon-basic-magnifier' => 'Magnifier' ),
		array( 'icon-basic-magnifier-minus' => 'Magnifier Minus' ),
		array( 'icon-basic-magnifier-plus' => 'Magnifier Plus' ),
		array( 'icon-basic-mail' => 'Mail' ),
		array( 'icon-basic-mail-multiple' => 'Mail Multiple' ),
		array( 'icon-basic-mail-open' => 'Mail Open' ),
		array( 'icon-basic-mail-open-text' => 'Mail Open Text' ),
		array( 'icon-basic-male' => 'Male' ),
		array( 'icon-basic-map' => 'Map' ),
		array( 'icon-basic-message' => 'Message' ),
		array( 'icon-basic-message-multiple' => 'Message Multiple' ),
		array( 'icon-basic-message-txt' => 'Message Txt' ),
		array( 'icon-basic-mixer2' => 'Mixer2' ),
		array( 'icon-basic-mouse' => 'Mouse' ),
		array( 'icon-basic-notebook' => 'Notebook' ),
		array( 'icon-basic-notebook-pen' => 'Notebook Pen' ),
		array( 'icon-basic-notebook-pencil' => 'Notebook Pencil' ),
		array( 'icon-basic-paperplane' => 'Paperplane' ),
		array( 'icon-basic-pencil-ruler' => 'Pencil Ruler' ),
		array( 'icon-basic-pencil-ruler-pen' => 'Pencil Ruler Pen' ),
		array( 'icon-basic-photo' => 'Photo' ),
		array( 'icon-basic-picture' => 'Picture' ),
		array( 'icon-basic-picture-multiple' => 'Picture Multiple' ),
		array( 'icon-basic-pin1' => 'Pin1' ),
		array( 'icon-basic-pin2' => 'Pin2' ),
		array( 'icon-basic-postcard' => 'Postcard' ),
		array( 'icon-basic-postcard-multiple' => 'Postcard Multiple' ),
		array( 'icon-basic-printer' => 'Printer' ),
		array( 'icon-basic-question' => 'Question' ),
		array( 'icon-basic-rss' => 'Rss' ),
		array( 'icon-basic-server' => 'Server' ),
		array( 'icon-basic-server2' => 'Server2' ),
		array( 'icon-basic-server-cloud' => 'Server Cloud' ),
		array( 'icon-basic-server-download' => 'Server Download' ),
		array( 'icon-basic-server-upload' => 'Server Upload' ),
		array( 'icon-basic-settings' => 'Settings' ),
		array( 'icon-basic-share' => 'Share' ),
		array( 'icon-basic-sheet' => 'Sheet' ),
		array( 'icon-basic-sheet-multiple' => 'Sheet Multiple' ),
		array( 'icon-basic-sheet-pen' => 'Sheet Pen' ),
		array( 'icon-basic-sheet-pencil' => 'Sheet Pencil' ),
		array( 'icon-basic-sheet-txt' => 'Sheet Txt' ),
		array( 'icon-basic-signs' => 'Signs' ),
		array( 'icon-basic-smartphone' => 'Smartphone' ),
		array( 'icon-basic-spades' => 'Spades' ),
		array( 'icon-basic-spread' => 'Spread' ),
		array( 'icon-basic-spread-bookmark' => 'Spread Bookmark' ),
		array( 'icon-basic-spread-text' => 'Spread Text' ),
		array( 'icon-basic-spread-text-bookmark' => 'Spread Text Bookmark' ),
		array( 'icon-basic-star' => 'Star' ),
		array( 'icon-basic-tablet' => 'Tablet' ),
		array( 'icon-basic-target' => 'Target' ),
		array( 'icon-basic-todo' => 'Todo' ),
		array( 'icon-basic-todo-pen' => 'Todo Pen' ),
		array( 'icon-basic-todo-pencil' => 'Todo Pencil' ),
		array( 'icon-basic-todo-txt' => 'Todo Txt' ),
		array( 'icon-basic-todolist-pen' => 'Todolist Pen' ),
		array( 'icon-basic-todolist-pencil' => 'Todolist Pencil' ),
		array( 'icon-basic-trashcan' => 'Trashcan' ),
		array( 'icon-basic-trashcan-full' => 'Trashcan Full' ),
		array( 'icon-basic-trashcan-refresh' => 'Trashcan Refresh' ),
		array( 'icon-basic-trashcan-remove' => 'Trashcan Remove' ),
		array( 'icon-basic-upload' => 'Upload' ),
		array( 'icon-basic-usb' => 'Usb' ),
		array( 'icon-basic-video' => 'Video' ),
		array( 'icon-basic-watch' => 'Watch' ),
		array( 'icon-basic-webpage' => 'Webpage' ),
		array( 'icon-basic-webpage-img-txt' => 'Webpage Img Txt' ),
		array( 'icon-basic-webpage-multiple' => 'Webpage Multiple' ),
		array( 'icon-basic-webpage-txt' => 'Webpage Txt' ),
		array( 'icon-basic-world' => 'World' ),
		array( 'icon-ecommerce-bag' => 'Bag' ),
		array( 'icon-ecommerce-bag-check' => 'Bag Check' ),
		array( 'icon-ecommerce-bag-cloud' => 'Bag Cloud' ),
		array( 'icon-ecommerce-bag-download' => 'Bag Download' ),
		array( 'icon-ecommerce-bag-minus' => 'Bag Minus' ),
		array( 'icon-ecommerce-bag-plus' => 'Bag Plus' ),
		array( 'icon-ecommerce-bag-refresh' => 'Bag Refresh' ),
		array( 'icon-ecommerce-bag-remove' => 'Bag Remove' ),
		array( 'icon-ecommerce-bag-search' => 'Bag Search' ),
		array( 'icon-ecommerce-bag-upload' => 'Bag Upload' ),
		array( 'icon-ecommerce-banknote' => 'Banknote' ),
		array( 'icon-ecommerce-banknotes' => 'Banknotes' ),
		array( 'icon-ecommerce-basket' => 'Basket' ),
		array( 'icon-ecommerce-basket-check' => 'Basket Check' ),
		array( 'icon-ecommerce-basket-cloud' => 'Basket Cloud' ),
		array( 'icon-ecommerce-basket-download' => 'Basket Download' ),
		array( 'icon-ecommerce-basket-minus' => 'Basket Minus' ),
		array( 'icon-ecommerce-basket-plus' => 'Basket Plus' ),
		array( 'icon-ecommerce-basket-refresh' => 'Basket Refresh' ),
		array( 'icon-ecommerce-basket-remove' => 'Basket Remove' ),
		array( 'icon-ecommerce-basket-search' => 'Basket Search' ),
		array( 'icon-ecommerce-basket-upload' => 'Basket Upload' ),
		array( 'icon-ecommerce-bath' => 'Bath' ),
		array( 'icon-ecommerce-cart' => 'Cart' ),
		array( 'icon-ecommerce-cart-check' => 'Cart Check' ),
		array( 'icon-ecommerce-cart-cloud' => 'Cart Cloud' ),
		array( 'icon-ecommerce-cart-content' => 'Cart Content' ),
		array( 'icon-ecommerce-cart-download' => 'Cart Download' ),
		array( 'icon-ecommerce-cart-minus' => 'Cart Minus' ),
		array( 'icon-ecommerce-cart-plus' => 'Cart Plus' ),
		array( 'icon-ecommerce-cart-refresh' => 'Cart Refresh' ),
		array( 'icon-ecommerce-cart-remove' => 'Cart Remove' ),
		array( 'icon-ecommerce-cart-search' => 'Cart Search' ),
		array( 'icon-ecommerce-cart-upload' => 'Cart Upload' ),
		array( 'icon-ecommerce-cent' => 'Cent' ),
		array( 'icon-ecommerce-colon' => 'Colon' ),
		array( 'icon-ecommerce-creditcard' => 'Creditcard' ),
		array( 'icon-ecommerce-diamond' => 'Diamond' ),
		array( 'icon-ecommerce-dollar' => 'Dollar' ),
		array( 'icon-ecommerce-euro' => 'Euro' ),
		array( 'icon-ecommerce-franc' => 'Franc' ),
		array( 'icon-ecommerce-gift' => 'Gift' ),
		array( 'icon-ecommerce-graph1' => 'Graph1' ),
		array( 'icon-ecommerce-graph2' => 'Graph2' ),
		array( 'icon-ecommerce-graph3' => 'Graph3' ),
		array( 'icon-ecommerce-graph-decrease' => 'Graph Decrease' ),
		array( 'icon-ecommerce-graph-increase' => 'Graph Increase' ),
		array( 'icon-ecommerce-guarani' => 'Guarani' ),
		array( 'icon-ecommerce-kips' => 'Kips' ),
		array( 'icon-ecommerce-lira' => 'Lira' ),
		array( 'icon-ecommerce-megaphone' => 'Megaphone' ),
		array( 'icon-ecommerce-money' => 'Money' ),
		array( 'icon-ecommerce-naira' => 'Naira' ),
		array( 'icon-ecommerce-pesos' => 'Pesos' ),
		array( 'icon-ecommerce-pound' => 'Pound' ),
		array( 'icon-ecommerce-receipt' => 'Receipt' ),
		array( 'icon-ecommerce-receipt-bath' => 'Receipt Bath' ),
		array( 'icon-ecommerce-receipt-cent' => 'Receipt Cent' ),
		array( 'icon-ecommerce-receipt-dollar' => 'Receipt Dollar' ),
		array( 'icon-ecommerce-receipt-euro' => 'Receipt Euro' ),
		array( 'icon-ecommerce-receipt-franc' => 'Receipt Franc' ),
		array( 'icon-ecommerce-receipt-guarani' => 'Receipt Guarani' ),
		array( 'icon-ecommerce-receipt-kips' => 'Receipt Kips' ),
		array( 'icon-ecommerce-receipt-lira' => 'Receipt Lira' ),
		array( 'icon-ecommerce-receipt-naira' => 'Receipt Naira' ),
		array( 'icon-ecommerce-receipt-pesos' => 'Receipt Pesos' ),
		array( 'icon-ecommerce-receipt-pound' => 'Receipt Pound' ),
		array( 'icon-ecommerce-receipt-rublo' => 'Receipt Rublo' ),
		array( 'icon-ecommerce-receipt-rupee' => 'Receipt Rupee' ),
		array( 'icon-ecommerce-receipt-tugrik' => 'Receipt Tugrik' ),
		array( 'icon-ecommerce-receipt-won' => 'Receipt Won' ),
		array( 'icon-ecommerce-receipt-yen' => 'Receipt Yen' ),
		array( 'icon-ecommerce-receipt-yen2' => 'Receipt Yen2' ),
		array( 'icon-ecommerce-recept-colon' => 'Recept Colon' ),
		array( 'icon-ecommerce-rublo' => 'Rublo' ),
		array( 'icon-ecommerce-rupee' => 'Rupee' ),
		array( 'icon-ecommerce-safe' => 'Safe' ),
		array( 'icon-ecommerce-sale' => 'Sale' ),
		array( 'icon-ecommerce-sales' => 'Sales' ),
		array( 'icon-ecommerce-ticket' => 'Ticket' ),
		array( 'icon-ecommerce-tugriks' => 'Tugriks' ),
		array( 'icon-ecommerce-wallet' => 'Wallet' ),
		array( 'icon-ecommerce-won' => 'Won' ),
		array( 'icon-ecommerce-yen' => 'Yen' ),
		array( 'icon-ecommerce-yen2' => 'Yen2' ),
		array( 'icon-music-beginning-button' => 'Beginning Button' ),
		array( 'icon-music-bell' => 'Bell' ),
		array( 'icon-music-cd' => 'Cd' ),
		array( 'icon-music-diapason' => 'Diapason' ),
		array( 'icon-music-eject-button' => 'Eject Button' ),
		array( 'icon-music-end-button' => 'End Button' ),
		array( 'icon-music-fastforward-button' => 'Fastforward Button' ),
		array( 'icon-music-headphones' => 'Headphones' ),
		array( 'icon-music-ipod' => 'Ipod' ),
		array( 'icon-music-loudspeaker' => 'Loudspeaker' ),
		array( 'icon-music-microphone' => 'Microphone' ),
		array( 'icon-music-microphone-old' => 'Microphone Old' ),
		array( 'icon-music-mixer' => 'Mixer' ),
		array( 'icon-music-mute' => 'Mute' ),
		array( 'icon-music-note-multiple' => 'Note Multiple' ),
		array( 'icon-music-note-single' => 'Note Single' ),
		array( 'icon-music-pause-button' => 'Pause Button' ),
		array( 'icon-music-play-button' => 'Play Button' ),
		array( 'icon-music-playlist' => 'Playlist' ),
		array( 'icon-music-radio-ghettoblaster' => 'Radio Ghettoblaster' ),
		array( 'icon-music-radio-portable' => 'Radio Portable' ),
		array( 'icon-music-record' => 'Record' ),
		array( 'icon-music-recordplayer' => 'Recordplayer' ),
		array( 'icon-music-repeat-button' => 'Repeat Button' ),
		array( 'icon-music-rewind-button' => 'Rewind Button' ),
		array( 'icon-music-shuffle-button' => 'Shuffle Button' ),
		array( 'icon-music-stop-button' => 'Stop Button' ),
		array( 'icon-music-tape' => 'Tape' ),
		array( 'icon-music-volume-down' => 'Volume Down' ),
		array( 'icon-music-volume-up' => 'Volume Up' ),
	);

	return array_merge( $icons, $linea_icons );
}
