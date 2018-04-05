/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Poseidon Pro
 */

( function( $ ) {

	/* Header Search checkbox */
	wp.customize( 'poseidon_theme_options[header_search]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.primary-navigation .main-navigation-menu li.header-search' );
			} else {
				showElement( '.primary-navigation .main-navigation-menu li.header-search' );
			}
		} );
	} );

	/* Author Bio checkbox */
	wp.customize( 'poseidon_theme_options[author_bio]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.type-post .entry-footer .entry-author' );
			} else {
				showElement( '.type-post .entry-footer .entry-author' );
			}
		} );
	} );

	/* Header Color Option */
	wp.customize( 'poseidon_theme_options[header_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css, text_color, hover_color, border_color, dotted_color,
				post_primary_color = '#22aadd',
				post_secondary_color = '#22aadd',
				link_color = '#22aadd';

			if( typeof wp.customize.value( 'poseidon_theme_options[post_primary_color]' ) !== 'undefined' ) {
				post_primary_color = wp.customize.value( 'poseidon_theme_options[post_primary_color]' ).get();
			}

			if( typeof wp.customize.value( 'poseidon_theme_options[post_secondary_color]' ) !== 'undefined' ) {
				post_secondary_color = wp.customize.value( 'poseidon_theme_options[post_secondary_color]' ).get();
			}

			if( typeof wp.customize.value( 'poseidon_theme_options[link_color]' ) !== 'undefined' ) {
				link_color = wp.customize.value( 'poseidon_theme_options[link_color]' ).get();
			}

			custom_css = '.site-header, .main-navigation-menu ul, .footer-wrap { background: ' + newval + '; }';

			if( isColorDark( newval ) ) {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				border_color = 'rgba(255,255,255,0.12)';
				dotted_color = 'rgba(255,255,255,0.24)';

				custom_css += '.site-branding, .site-title, .site-title a:link, .site-title a:visited, .site-info a:link, .site-info a:visited { color: ' + text_color + ' !important; }';
				custom_css += '.site-title a:hover, .site-title a:active, .site-info, .site-info a:hover, .site-info a:active { color: ' + hover_color + ' !important; }';

			} else {
				text_color = '#404040';
				hover_color = 'rgba(0,0,0,0.6)';
				border_color = 'rgba(0,0,0,0.12)';
				dotted_color = 'rgba(0,0,0,0.24)';

				custom_css += '.site-branding, .site-info { color: ' + text_color + '; }';
				custom_css += '.site-title, .site-title a:link, .site-title a:visited { color: ' + post_primary_color + '; }';
				custom_css += '.site-title a:hover, .site-title a:active { color: ' + post_secondary_color + '; }';

				custom_css += '.site-info a:link, .site-info a:visited { color: ' + link_color + '; }';
				custom_css += '.site-info a:hover, .site-info a:active { color: #404040; }';
			}

			custom_css += '.site-header, .footer-wrap { border-color: ' + border_color + '; }';
			custom_css += '.main-navigation-menu ul { border-left-color: ' + border_color + '; border-right-color: ' + border_color + '; border-bottom-color: ' + border_color + '; }';
			custom_css += '.main-navigation-menu ul a { border-color: ' + dotted_color + '; }';

			addColorStyles( custom_css, 1 );
		} );
	} );

	/* Link & Button Color Option */
	wp.customize( 'poseidon_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = 'a:link, a:visited, .more-link, .widget-title a:hover, .widget-title a:active, .tzwb-tabbed-content .tzwb-tabnavi li a:hover, .tzwb-tabbed-content .tzwb-tabnavi li a:active, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab, .site-info a:link, .site-info a:visited { color: ' + newval + '; }';
			custom_css += 'a:hover, a:focus, a:active, .site-info a:hover, .site-info a:active { color: #404040; }';

			custom_css += 'button, input[type="button"], input[type="reset"], input[type="submit"], .entry-tags .meta-tags a:hover, .entry-tags .meta-tags a:active, .widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:active, .scroll-to-top-button, .scroll-to-top-button:focus, .scroll-to-top-button:active, .tzwb-social-icons .social-icons-menu li a { color: #fff; background: ' + newval + '; }';
			custom_css += 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, button:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active, .scroll-to-top-button:hover { background: #404040; }';

			addColorStyles( custom_css, 2 );

			custom_css = '.widget-title a:hover, .widget-title a:active { color: ' + newval + '; }';

			addColorStyles( custom_css, 9 );
		} );
	} );

	/* Top Navigation Color Option */
	wp.customize( 'poseidon_theme_options[top_navi_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css, text_color, hover_color, border_color, border;

			custom_css = '.header-bar-wrap, .top-navigation-menu ul { background: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = 'rgba(0,0,0,0.75)';
				hover_color = 'rgba(0,0,0,0.6)';
				border_color = 'rgba(0,0,0,0.15)';
				border = '.header-bar-wrap { border-bottom: 1px solid rgba(0,0,0,0.1); }';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				border_color = 'rgba(255,255,255,0.15)';
				border = '.header-bar-wrap { border-bottom: none }';
			}

			custom_css += '.header-bar-wrap, .top-navigation-menu a, .top-navigation-menu a:link, .top-navigation-menu a:visited, .top-navigation-toggle, .top-navigation-toggle:focus, .top-navigation-menu .submenu-dropdown-toggle, .header-bar .social-icons-menu li a, .header-bar .social-icons-menu li a:link, .header-bar .social-icons-menu li a:visited { color: ' + text_color + '; }';
			custom_css += '.top-navigation-menu a:hover, .top-navigation-menu a:active, .top-navigation-toggle:hover, .top-navigation-toggle:active, .top-navigation-menu .submenu-dropdown-toggle:hover, .top-navigation-menu .submenu-dropdown-toggle:active, .header-bar .social-icons-menu li a:hover, .header-bar .social-icons-menu li a:active { color: ' + hover_color + '; }';
			custom_css += '.top-navigation-menu, .top-navigation-menu a, .top-navigation-menu ul, .top-navigation-menu ul a, .top-navigation-menu ul li:last-child > a { border-color: ' + border_color + '; }';
			custom_css += border;

			addColorStyles( custom_css, 3 );
		} );
	} );

	/* Navigation (primary) Color Option */
	wp.customize( 'poseidon_theme_options[navi_primary_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css,
				navi_secondary_color = '#22aadd';

			if( typeof wp.customize.value( 'poseidon_theme_options[navi_secondary_color]' ) !== 'undefined' ) {
				navi_secondary_color = wp.customize.value( 'poseidon_theme_options[navi_secondary_color]' ).get();
			}

			custom_css = '.main-navigation-menu a:link, .main-navigation-menu a:visited, .main-navigation-toggle, .main-navigation-menu .submenu-dropdown-toggle, .footer-navigation-menu a:link, .footer-navigation-menu a:visited, .header-search .header-search-icon { color: ' + newval + '; }';
			custom_css += '.main-navigation-menu a:hover, .main-navigation-menu a:active, .main-navigation-toggle:hover, .main-navigation-menu .submenu-dropdown-toggle:hover, .footer-navigation-menu a:hover, .footer-navigation-menu a:active { color: ' + navi_secondary_color + '; }';
			custom_css += '.main-navigation-menu, .main-navigation-menu ul { border-top-color: ' + newval + '; }';

			addColorStyles( custom_css, 4 );
		} );
	} );

	/* Navigation (secondary) Color Option */
	wp.customize( 'poseidon_theme_options[navi_secondary_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.main-navigation-menu a:hover, .main-navigation-menu a:active, .main-navigation-menu li.current-menu-item > a, .main-navigation-toggle:hover, .main-navigation-menu .submenu-dropdown-toggle:hover, .footer-navigation-menu a:hover, .footer-navigation-menu a:active { color: ' + newval + '; }';

			addColorStyles( custom_css, 5 );
		} );
	} );

	/* Post Titles (primary) Color Option */
	wp.customize( 'poseidon_theme_options[post_primary_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css,
				post_secondary_color = '#22aadd';

			if( typeof wp.customize.value( 'poseidon_theme_options[post_secondary_color]' ) !== 'undefined' ) {
				post_secondary_color = wp.customize.value( 'poseidon_theme_options[post_secondary_color]' ).get();
			}

			custom_css = '.site-title, .site-title a:link, .site-title a:visited, .page-title, .entry-title, .entry-title a:link, .entry-title a:visited { color: ' + newval + '; }';
			custom_css += '.site-title a:hover, .site-title a:active, .entry-title a:hover, .entry-title a:active { color: ' + post_secondary_color + '; }';

			addColorStyles( custom_css, 6 );
		} );
	} );

	/* Post Titles (secondary) Color Option */
	wp.customize( 'poseidon_theme_options[post_secondary_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.site-title a:hover, .site-title a:active, .entry-title a:hover, .entry-title a:active { color: ' + newval + '; }';

			addColorStyles( custom_css, 7 );
		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'poseidon_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css,
				link_color = '#22aadd';

			if( typeof wp.customize.value( 'poseidon_theme_options[link_color]' ) !== 'undefined' ) {
				link_color = wp.customize.value( 'poseidon_theme_options[link_color]' ).get();
			}

			custom_css = '.widget-title, .widget-title a:link, .widget-title a:visited, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title span { color: ' + newval + '; }';
			custom_css += '.widget-title a:hover, .widget-title a:active { color: ' + link_color + '; }';

			addColorStyles( custom_css, 8 );
		} );
	} );

	/* Footer Widgets Color Option */
	wp.customize( 'poseidon_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css, text_color, hover_color, bg_color, bg_hover_color, border_color, border;

			custom_css = '.footer-widgets-background { background: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = 'rgba(0,0,0,0.8)';
				hover_color = 'rgba(0,0,0,0.6)';
				bg_color = 'rgba(0,0,0,0.1)';
				bg_hover_color = 'rgba(0,0,0,0.2)';
				border_color = 'rgba(0,0,0,0.08)';
				border = '.footer-widgets-background { border-top: 1px solid rgba(0,0,0,0.1); }';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				bg_color = 'rgba(255,255,255,0.1)';
				bg_hover_color = 'rgba(255,255,255,0.2)'
				border_color = 'rgba(255,255,255,0.15)';
				border = '.footer-widgets-background { border-top: none }';
			}

			custom_css += border;
			custom_css += '.footer-widgets .widget-title, .footer-widgets .widget a:link, .footer-widgets .widget a:visited { color: ' + text_color + '; }';
			custom_css += '.footer-widgets .widget, .footer-widgets .widget a:hover, .footer-widgets .widget a:active { color: ' + hover_color + '; }';
			custom_css += '.footer-widgets .widget-title, .footer-widgets .tzwb-tabbed-content .tzwb-tabnavi { border-color: ' + border_color + '; }';

			custom_css += '#footer-widgets .tzwb-social-icons .social-icons-menu li a, #footer-widgets .widget_tag_cloud .tagcloud a { background: ' + bg_color + '; }';
			custom_css += '#footer-widgets .tzwb-social-icons .social-icons-menu li a:hover, #footer-widgets .widget_tag_cloud .tagcloud a:hover, #footer-widgets .widget_tag_cloud .tagcloud a:active { color: ' + text_color + '; background: ' + bg_hover_color + '; }';
			custom_css += '.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:link, .footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:visited { color: ' + hover_color + '; }';
			custom_css += '.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:hover, .footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:active, .footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab { color: ' + text_color + '; }';

			addColorStyles( custom_css, 10 );
		} );
	} );

	/* Theme Fonts */
	wp.customize( 'poseidon_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='poseidon-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#poseidon-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#poseidon-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( 'body, button, input, select, textarea' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'poseidon_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='poseidon-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#poseidon-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#poseidon-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.site-title, .page-title, .entry-title' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'poseidon_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='poseidon-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#poseidon-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#poseidon-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.top-navigation-menu a, .main-navigation-menu a, .footer-navigation-menu a' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'poseidon_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='poseidon-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#poseidon-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#poseidon-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .widget-title, .pagination a, .pagination .current, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title span, .tzwb-tabbed-content .tzwb-tabnavi li a' )
				.css( 'font-family', newFont );

		} );
	} );

	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden'
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible'
		});
	}

	function hexdec( hexString ) {
		hexString = ( hexString + '' ).replace( /[^a-f0-9]/gi, '' );
		return parseInt( hexString, 16 );
	}

	function getColorBrightness( hexColor ) {

		// Remove # string.
		hexColor = hexColor.replace( '#', '' );

		// Convert into RGB.
		var r = hexdec( hexColor.substring( 0, 2 ) );
		var g = hexdec( hexColor.substring( 2, 4 ) );
		var b = hexdec( hexColor.substring( 4, 6 ) );

		return ( ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000 );
	}

	function isColorLight( hexColor ) {
		return ( getColorBrightness( hexColor ) > 130 );
	}

	function isColorDark( hexColor ) {
		return ( getColorBrightness( hexColor ) <= 130 );
	}

	function writeColorStyles() {
		for( var i = 1; i < 11; i++) {
			$( 'head' ).append( '<style id="poseidon-pro-colors-' + i + '"></style>' );
		}
	}

	function addColorStyles( colorRules, priority ) {

		// Write Color Styles if they do not exist.
		if ( ! $( '#poseidon-pro-colors-1' ).length ) {
			writeColorStyles();
		}

		$( '#poseidon-pro-colors-' + priority ).html( colorRules );
	}

} )( jQuery );
