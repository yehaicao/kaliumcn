;( function( $, window, undefined ) {
	"use strict";
	
	$( document ).ready( function() {
		// Portfolio
		var $portfolio_item_type = $( '.post-type-portfolio #acf-field-item_type' );
		
		if ( $portfolio_item_type.length ) {
			var $item_type_images    	= $( '<div class="portfolio-item-type-images"><div class="loader"></div></div>' ),
				$warning_container      = $( '<div class="portfolio-item-type-warning"></div>' ),
				default_value           = $portfolio_item_type.val(),
				default_text            = $portfolio_item_type.find( 'option:selected' ).text(),
				is_editing 				= window.location.toString().match(/action=edit/),
				option_images = {
					'type-1' : 'portfolio-item-type-1.png',
					'type-2' : 'portfolio-item-type-2.png', 
					'type-3' : 'portfolio-item-type-3.png',
					'type-4' : 'portfolio-item-type-4.png',
					'type-5' : 'portfolio-item-type-5.png',
					'type-6' : 'portfolio-item-type-6.png',
					'type-7' : 'portfolio-item-type-7.png',
				};
			
			$portfolio_item_type.after( $warning_container ).after( $item_type_images );
			
			
			if ( is_editing ) {
				$warning_container.append( '<strong>Note:</strong> You are currently using <strong>' + default_text + '</strong> type. If you change this portfolio type you may lose some of the current settings.' );
			} else {
				/*
				$warning_container.append( '<strong>Note:</strong> To see full portfolio options, you must choose one of predefined portfolio styles above and click <strong>Publish</strong> button.' );
				
				setTimeout( function() {
					$warning_container.slideDown();
				}, 1000 );
				//*/
				
				// Set Portfolio Item Type
				acf.screen.item_type = $portfolio_item_type.val();
				$( document ).trigger( 'acf/update_field_groups' );
			}
			
			var loadedScreens = {},
				loaderInt = 0;
				
			loadedScreens[ $portfolio_item_type.val() ] = true;
			
			$portfolio_item_type.find( 'option' ).each( function( i, opt ) {
				var $opt = $( opt ),
					$opt_img = $( '<a href="#" class="portfolio-item-type-image-option"><img src="' + kalium_assets_dir + 'images/admin/' + option_images[ $opt.val() ] + '" /><span class="opt-label">' + $opt.html() + '</span></a>' );
					
				$item_type_images.append( $opt_img );
				
				$opt_img.on( 'click', function( ev ) {
					ev.preventDefault();
					
					$portfolio_item_type.val( $opt.val() );
					checkActive();
					
					// Loading Indicator
					$item_type_images.addClass( 'is-loading' );
					
					if ( typeof loadedScreens[ $opt.val() ] != 'undefined' ) {
						setTimeout( function() {
							$item_type_images.removeClass( 'is-loading' );
						}, 500 );
					}
					
					loadedScreens[ $opt.val() ] = true;
					
					window.clearTimeout( loaderInt );
					
					loaderInt = setTimeout( function() {
						$item_type_images.removeClass( 'is-loading' );
					}, 3000 );
					
					// Render Fields
					acf.screen.item_type = $opt.val();
					$( document ).trigger( 'acf/update_field_groups' );
				});
			});
			
			var checkActive = function() {
				$portfolio_item_type.find( 'option' ).each( function( i, opt ) {
					var $opt = $( opt ),
						$opt_img = $item_type_images.find( '.portfolio-item-type-image-option' ).eq( i );
					
					$opt_img.removeClass( 'active' );
					
					if ( $opt.is( ':selected' ) ) {
						$opt_img.addClass( 'active' );
					}
					
					// Show Warning
					if ( is_editing ) {
						if ( default_value != $portfolio_item_type.val() ) {
							$warning_container.slideDown();
						} else {
							$warning_container.slideUp();
						}
					}
				});
			}
			
			$portfolio_item_type.hide();
			checkActive();
			
			// Hide Loading Bar
			$( document ).on( 'acf/setup_fields', function( $el ) {
				$item_type_images.removeClass( 'is-loading' );
			} );
			
			// When New Post Is Created
			if ( ! $( '.page-title-action' ).is( ':visible' ) ) {
				$( '.acf_postbox' ).not( $portfolio_item_type.closest( '.acf_postbox' ) ).addClass( 'acf-hidden' );
			}
				
		}
		
		$( '#section-skin_palettes_list .skin-palette' ).each( function( i, el ) {
			var $el = $( el ),
				colors = [];
			
			$el.find( 'span' ).each( function( j, color ) {
				colors.push( color.style.backgroundColor );
			});
			
			$el.click( function( ev ) {
				ev.preventDefault();
				
				$( '#custom_skin_bg_color' ).iris( 'color', colors[0] );
				$( '#custom_skin_link_color' ).iris( 'color', colors[1] );
				$( '#custom_skin_headings_color' ).iris( 'color', colors[2] );
				$( '#custom_skin_paragraph_color' ).iris( 'color', colors[3] );
				$( '#custom_skin_footer_bg_color' ).iris( 'color', colors[4] );
				$( '#custom_skin_borders_color' ).iris( 'color', colors[5] );
			});
		});
		
		$( '.portfolio-likes-reset[data-id]' ).each( function( i, el ) {
			var $el = $( el );
			
			$el.on( 'click', function( ev ) {
				ev.preventDefault();				
				$el.addClass('is-loading');
				
				$.post( ajaxurl, { action: 'lab_portfolio_reset_likes', post_id: $el.data( 'id' ) }, function( resp ) {
					$el.removeClass( 'is-loading' );
					
					if ( resp == 'success' ) {
						$el.prev( '.likes-num' ).html( '0' );
					}
				});
			});
		});
		
		// Shop Reset Image Dimensions
		$( 'body' ).on( 'click', '#restore-default-shop-image-dimensions', function( ev ) {
			
			ev.preventDefault();
			
			var $this = $( this ),
				$em = $this.find( 'em' ),
				hasEm = $em.length == 1;
			
			if( $this.data( 'busy' ) )
			{
				return false;
			}
			
			$this.addClass( 'is-loading' ).data( 'busy', true );
			
			if( hasEm && ! $em.data( 'default' ) )
			{
				$em.data( 'default', $em.html() );
			}
			
			$.get( ajaxurl, { action: 'lab_wc_reset_image_dimensions', override_shop_image_dimensions: 1 }, function( resp ) {
				
				$this.data( 'busy', false ).removeClass( 'is-loading' );
				
				if ( hasEm && $em.data( 'success' ) ) {
					$em.fadeTo( 150, 0, function() {
						$em.html( '<i class="fa fa-check"></i> ' + $em.data( 'success' ) ).fadeTo( 300, 1 );
					} );
					
					setTimeout( function() {
						$em.fadeTo(150, 0, function() {
							$em.html( $em.data( 'default' ) ).fadeTo( 300, 1 );
						} );
					}, 3000 );
				}
			} );
			
		} );
		
		
		// Tabs in Custom CSS
		$('#acf-field-page_custom_css').bind('keydown.wpevent_InsertTab', function(e) {
			var el = e.target, selStart, selEnd, val, scroll, sel;
	
			if ( e.keyCode == 27 ) { // escape key
				// when pressing Escape: Opera 12 and 27 blur form fields, IE 8 clears them
				e.preventDefault();
				$(el).data('tab-out', true);
				return;
			}
	
			if ( e.keyCode != 9 || e.ctrlKey || e.altKey || e.shiftKey ) // tab key
				return;
	
			if ( $(el).data('tab-out') ) {
				$(el).data('tab-out', false);
				return;
			}
	
			selStart = el.selectionStart;
			selEnd = el.selectionEnd;
			val = el.value;
	
			if ( document.selection ) {
				el.focus();
				sel = document.selection.createRange();
				sel.text = '\t';
			} else if ( selStart >= 0 ) {
				scroll = this.scrollTop;
				el.value = val.substring(0, selStart).concat('\t', val.substring(selEnd) );
				el.selectionStart = el.selectionEnd = selStart + 1;
				this.scrollTop = scroll;
			}
	
			if ( e.stopPropagation )
				e.stopPropagation();
			if ( e.preventDefault )
				e.preventDefault();
		});
		
	} );

} )( jQuery, window );