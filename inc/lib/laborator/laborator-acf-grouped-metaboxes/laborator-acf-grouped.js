;( function( $, window, undefined ) {
	"use strict";
	
	$( document ).ready( function() {
		
		if ( typeof lab_acf_metaboxes == 'object' ) {
			
			var initial_tab   	= 0,
				$wp_mb			= $( '.postbox-container #lab-acf-grouping-metabox' ),
				$container      = $( '.laborator-acf-grouped-container' ),
				$tabs           = $container.find( '.lab-acf-grouped-tabs' ),
				$tabs_container = $container.find( '.lab-acf-grouped-tabs-container' ),
				active_tab_set	= false;
			
			for ( var i in lab_acf_metaboxes ) {
				var metabox        = lab_acf_metaboxes[ i ],
					browseby 	   = $( '#acf_' + metabox.slug ).length ? 'slug' : 'id',
					metabox_dom_id = '#acf_' + ( browseby == 'slug' ? metabox.slug : metabox.id ),
					$metabox       = $( metabox_dom_id );
				
				if ( $metabox.length == 1 ) {
					metabox.domId = metabox_dom_id;
					metabox.$metabox = $metabox;
					
					// Create Tab ID
					var $tab_id    	  = $( '<li><a></a></li>' ),
						$tab_icon	  = $( '<i class="fa"></i>' ),
						$tab_link     = $tab_id.find( 'a' ),
						tab_id        = browseby == 'slug' ? metabox.slug : metabox.id,
						tab_title     = $metabox.find( '> h2 > span, > h3 > span' ).html();
					
					$tab_link.html( tab_title.replace( /\(.*/, '' ) ).attr( {
						href: '#acf_' + tab_id,
						title: tab_title
					} );
					
					if ( metabox.icon ) {
						$tab_icon.addClass( 'fa-' + metabox.icon ).prependTo( $tab_link );
					}
					
					// Initialize Data on DOM
					$tab_id.data( 'metabox', metabox );
					
					if ( $metabox.hasClass( 'acf-hidden' ) == false ) {
						$tab_id.addClass( 'visible' );
					}
					
					$tabs.append( $tab_id );
					
					// Assign Tab ID
					metabox.$tabId = $tab_id;
					
					// Append Metabox
					$metabox.appendTo( $tabs_container );
					
					// Set active tab based on cookie
					if ( Cookies.get( 'lab_acf_current_tab_' + acf.post_id ) == metabox.slug && $metabox.hasClass( 'acf-hidden' ) == false ) {
						$tab_id.addClass( 'active' );
						$metabox.addClass( 'lab-acf-visible' );
						active_tab_set = true;
					}
				}
			}
			
			
			// API
			var setActiveTab = function( active_metabox ) {
				
				if ( typeof active_metabox == 'object' ) {
					
					for ( var i in lab_acf_metaboxes ) {
						var metabox = lab_acf_metaboxes[ i ];
						
						if ( metabox.$metabox.is( ':visible' ) ) {
							metabox.$metabox.removeClass( 'lab-acf-visible' );
						}
					}
					
					$tabs.find( 'li' ).removeClass( 'active' );
					
					active_metabox.$metabox.addClass( 'lab-acf-visible' );
					active_metabox.$tabId.addClass( 'active' );
					
					Cookies.set( "lab_acf_current_tab_" + acf.post_id, active_metabox.slug );
				}
			}
			
			var checkAvailableTabs = function() {
				var currentTab = null;
				
				for ( var i in lab_acf_metaboxes ) {
					var metabox = lab_acf_metaboxes[ i ];
					
					if ( ! metabox.$metabox ) {
						continue;
					}
					
					if ( metabox.$metabox.hasClass( 'acf-hidden' ) == false ) {						
						// Show Metabox Tab
						if ( metabox.$tabId.hasClass( 'visible') == false ) {
							metabox.$tabId.addClass( 'visible' );
						}
					} else { 
						// Hide Metabox Tab
						if ( metabox.$tabId.hasClass( 'visible') == true ) {							
							metabox.$metabox.removeClass( 'lab-acf-visible' );
							metabox.$tabId.removeClass( 'visible' );
						}
					}
				}
				
				// If there is no active tab
				var $visible_tabs = $tabs.find( '> li.visible' );
				
				if ( $visible_tabs.length > 0 && $visible_tabs.filter( '.active' ).is( ':visible' ) == false ) {
					if ( active_tab_set == false ) {
						setActiveTab( $visible_tabs.eq( 0 ).data( 'metabox' ) );
					}
				} else {
					if ( $visible_tabs.length == 0 ) {
						$container.addClass( 'hidden' );
					} else {
						$container.removeClass( 'hidden' );
					}
				}
				
				// Min height for content pane
				$tabs_container.css( 'min-height', $tabs.outerHeight() + 15 );
			}
			
			var labAcfLoadingPanels = function() {
				$wp_mb.addClass( 'loading-panels' );
				
				if ( typeof this.tm != 'undefined' ) {
					window.clearTimeout( this.tm );
				}
				
				this.tm = setTimeout( function() {
					if ( $wp_mb.hasClass( 'loading-panels' ) ) {
						labAcfLoadingPanelsFinished();
					}
				}, 2000 );
			}
			
			var labAcfLoadingPanelsFinished = function() {
				$wp_mb.removeClass( 'loading-panels' );
			}
			
			
			// Events
			$tabs.on( 'click', 'a', function( ev ) {
				ev.preventDefault();
				
				var $this = $( this ),
					$tab_id = $this.parent(),
					metabox = $tab_id.data( 'metabox' );
				
				setActiveTab( metabox );
			} );
			
			$( document ).on( 'acf/update_field_groups', labAcfLoadingPanels );
			
			$( document ).ajaxComplete(function( event, request, settings ) {
				if ( settings.data && settings.data.match( /acf%2Flocation/ ) ) {
					checkAvailableTabs();
					setTimeout( labAcfLoadingPanelsFinished, 150 );
				}
			} );
			
			$( document ).on( 'acf/setup_fields acf/update_field_groups', checkAvailableTabs );
			
			checkAvailableTabs();
			
			
			// Set Active tab
			var $active_tab_id = $tabs.find( 'li.visible' ).eq( initial_tab );
			
			if ( $active_tab_id.length ) {
				if ( active_tab_set == false ) {
					setActiveTab( $active_tab_id.data( 'metabox' ) );
				}
			} else {
				$tabs.find( 'li.visible' ).first().find( 'a' ).click();
			}
			
			// Loaded
			setTimeout( function() {
				$container.addClass( 'loaded' );
			}, 100 );
		}
		
	} );
	
	(function(g,f){'use strict';var h=function(e){if("object"!==typeof e.document)throw Error("Cookies.js requires a `window` with a `document` object");var b=function(a,d,c){return 1===arguments.length?b.get(a):b.set(a,d,c)};b._document=e.document;b._cacheKeyPrefix="cookey.";b._maxExpireDate=new Date("Fri, 31 Dec 9999 23:59:59 UTC");b.defaults={path:"/",secure:!1};b.get=function(a){b._cachedDocumentCookie!==b._document.cookie&&b._renewCache();a=b._cache[b._cacheKeyPrefix+a];return a===f?f:decodeURIComponent(a)};
b.set=function(a,d,c){c=b._getExtendedOptions(c);c.expires=b._getExpiresDate(d===f?-1:c.expires);b._document.cookie=b._generateCookieString(a,d,c);return b};b.expire=function(a,d){return b.set(a,f,d)};b._getExtendedOptions=function(a){return{path:a&&a.path||b.defaults.path,domain:a&&a.domain||b.defaults.domain,expires:a&&a.expires||b.defaults.expires,secure:a&&a.secure!==f?a.secure:b.defaults.secure}};b._isValidDate=function(a){return"[object Date]"===Object.prototype.toString.call(a)&&!isNaN(a.getTime())};
b._getExpiresDate=function(a,d){d=d||new Date;"number"===typeof a?a=Infinity===a?b._maxExpireDate:new Date(d.getTime()+1E3*a):"string"===typeof a&&(a=new Date(a));if(a&&!b._isValidDate(a))throw Error("`expires` parameter cannot be converted to a valid Date instance");return a};b._generateCookieString=function(a,b,c){a=a.replace(/[^#$&+\^`|]/g,encodeURIComponent);a=a.replace(/\(/g,"%28").replace(/\)/g,"%29");b=(b+"").replace(/[^!#$&-+\--:<-\[\]-~]/g,encodeURIComponent);c=c||{};a=a+"="+b+(c.path?";path="+
c.path:"");a+=c.domain?";domain="+c.domain:"";a+=c.expires?";expires="+c.expires.toUTCString():"";return a+=c.secure?";secure":""};b._getCacheFromString=function(a){var d={};a=a?a.split("; "):[];for(var c=0;c<a.length;c++){var e=b._getKeyValuePairFromCookieString(a[c]);d[b._cacheKeyPrefix+e.key]===f&&(d[b._cacheKeyPrefix+e.key]=e.value)}return d};b._getKeyValuePairFromCookieString=function(a){var b=a.indexOf("="),b=0>b?a.length:b,c=a.substr(0,b),e;try{e=decodeURIComponent(c)}catch(f){console&&"function"===
typeof console.error&&console.error('Could not decode cookie with key "'+c+'"',f)}return{key:e,value:a.substr(b+1)}};b._renewCache=function(){b._cache=b._getCacheFromString(b._document.cookie);b._cachedDocumentCookie=b._document.cookie};b._areEnabled=function(){var a="1"===b.set("cookies.js",1).get("cookies.js");b.expire("cookies.js");return a};b.enabled=b._areEnabled();return b},e="object"===typeof g.document?h(g):h;"function"===typeof define&&define.amd?define(function(){return e}):"object"===typeof exports?
("object"===typeof module&&"object"===typeof module.exports&&(exports=module.exports=e),exports.Cookies=e):g.Cookies=e})("undefined"===typeof window?this:window);

} )( jQuery, window );

