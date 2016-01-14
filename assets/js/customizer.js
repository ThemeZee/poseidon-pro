/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Poseidon Pro
 */

( function( $ ) {

	/* Link & Button Color Option */		
	wp.customize( 'poseidon_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {
			$('.entry-content a, .entry-content a:link, .entry-content a:visited, .top-navigation-menu a:link, .top-navigation-menu a:visited, .entry-meta a:link, .entry-meta a:visited, .entry-footer a:link, .entry-footer a:visited, .comment a:link, .comment a:visited, .widget a:link, .widget a:visited, .top-navigation-toggle:after, .top-navigation-menu .submenu-dropdown-toggle:before, .footer-navigation-toggle:after, .social-icons-navigation-toggle:after, .footer-navigation-menu a')
				.not( $('.more-link:link, .more-link:visited, .post-slider .zeeslide .entry-meta a:link, .post-slider .zeeslide .entry-meta a:visited, .widget-category-posts .entry-title a, .tzwb-tabbed-content .tzwb-tabnavi li a') )
				.css('color', newval );
			$('.entry-content a, .top-navigation-menu a, .entry-meta a, .entry-footer a, .comment a, .widget a, .top-navigation-toggle:after, .top-navigation-menu .submenu-dropdown-toggle:before, .footer-navigation-toggle:after, .social-icons-navigation-toggle:after, .footer-navigation-menu a')
				.not( $('.more-link:link, .more-link:visited, .post-slider .zeeslide .entry-meta a:link, .post-slider .zeeslide .entry-meta a:visited') )
				.hover( function() { $( this ).css('color', '#444444' ); },
						function() { $( this ).css('color', newval ); }
				);
			$('button, input[type="button"], input[type="reset"], input[type="submit"], .search-form .search-submit, .more-link, .post-pagination .current')
				.not( $('.post-slider .zeeslide .more-link, .top-navigation-toggle, .main-navigation-toggle, .footer-navigation-toggle, .social-icons-navigation-toggle') )
				.css('background', newval );
			$('button, input[type="button"], input[type="reset"], input[type="submit"], .search-form .search-submit, .more-link')
				.not( $('.post-slider .zeeslide .more-link, .top-navigation-toggle, .main-navigation-toggle, .footer-navigation-toggle, .social-icons-navigation-toggle') )
				.hover( function() { $( this ).css('background', '#444444' ); },
						function() { $( this ).css('background', newval ); }
				);
			$('.entry-tags .meta-tags a, .post-pagination a, .post-pagination .current, .comment-navigation a, .widget_tag_cloud .tagcloud a')
				.css('border', '1px solid ' + newval );
			$('.entry-tags .meta-tags a, .post-pagination a, .comment-navigation a, .widget_tag_cloud .tagcloud a')
				.hover( function() { $( this ).css( { 'background': newval, 'color': '#ffffff' } ); },
						function() { $( this ).css('background', '#ffffff' ); }
				);
		} );
	} );
	
	/* Navigation Color Option */
	wp.customize( 'poseidon_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			$('.primary-navigation, .main-navigation-toggle, .sidebar-navigation-toggle')
				.css('background', newval );
		} );
	} );
	
	/* Navigation Hover Color Option */
	wp.customize( 'poseidon_theme_options[navi_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation-menu ul, .main-navigation-menu ul a, .main-navigation-menu li.current-menu-item a')
				.css('background', newval );
			$('.main-navigation-menu a, .main-navigation-toggle, .sidebar-navigation-toggle')
				.hover( function() { $( this ).css( 'background',  newval ); },
						function() { $( this ).css( 'background', 'inherit' ); }
				);
		} );
	} );
	
	/* Title Color Option */
	wp.customize( 'poseidon_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			$('.site-title, .page-title, .entry-title, .entry-title a:link, .entry-title a:visited')
				.not( $('.post-slider .zeeslide .entry-title, .post-slider .zeeslide .entry-title a') )
				.css('color', newval );
			$('.entry-title')
				.not( $('.post-slider .zeeslide .entry-title, .post-slider .zeeslide .entry-title a') )
				.css('border-bottom', '3px solid ' + newval );
			$('.entry-title a, .site-title')
				.not( $('.post-slider .zeeslide .entry-title, .post-slider .zeeslide .entry-title a') )
				.hover( function() { $( this ).css('color', '#444444' ); },
						function() { $( this ).css('color', newval ); }
				);
		} );
	} );
	
	/* Widget Title Color Option */
	wp.customize( 'poseidon_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('.widget-title, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title span, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab')
				.css('background', newval );
			$('.widget-category-posts .widget-header .category-archive-link .category-archive-icon')
				.css('color', newval );
			$('.widget-category-posts .widget-header .category-archive-link')
				.hover( function() { $( this ).children( '.widget-title' ).css('background', '#444444' ); },
						function() { $( this ).children( '.widget-title' ).css('background', newval ); }
				);
			$('.tzwb-tabbed-content .tzwb-tabnavi li a')
				.hover( function() { $( this ).css('background', newval ); },
						function() { $( this ).css('background', '#444444' ); }
				)
				
		} );
	} );
	
	/* Slider Color Option */
	wp.customize( 'poseidon_theme_options[slider_color]', function( value ) {
		value.bind( function( newval ) {
			$('.post-slider .zeeslide .slide-content, .post-slider-controls .zeeflex-direction-nav a')
				.css('background', newval );
			$('.post-slider .zeeslide .more-link')
				.css('color', newval );
			$('.post-slider-controls .zeeflex-direction-nav a')
				.hover( function() { $( this ).css('background', '#444444' ); },
						function() { $( this ).css('background', newval ); }
				);
		} );
	} );
	
	
	/* Theme Fonts */	
	wp.customize( 'poseidon_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {
		
			// Embed Font
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl;
			var googleFontSource = "<link id='poseidon-pro-custom-text-font' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#poseidon-pro-custom-text-font").length;
			
			if (checkLink > 0) {
				$("head").find("#poseidon-pro-custom-text-font").remove();
			}
			$("head").append(googleFontSource);
			
			// Set CSS
			$('body, button, input, select, textarea, .top-navigation-menu a')
				.css('font-family', newval );
				
		} );
	} );
	
	wp.customize( 'poseidon_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {
		
			// Embed Font
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl;
			var googleFontSource = "<link id='poseidon-pro-custom-title-font' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#poseidon-pro-custom-title-font").length;
			
			if (checkLink > 0) {
				$("head").find("#poseidon-pro-custom-title-font").remove();
			}
			$("head").append(googleFontSource);
			
			// Set CSS
			$('.site-title, .page-title, .entry-title')
				.css('font-family', newval );
				
		} );
	} );
	
	wp.customize( 'poseidon_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {
		
			// Embed Font
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl;
			var googleFontSource = "<link id='poseidon-pro-custom-navi-font' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#poseidon-pro-custom-navi-font").length;
			
			if (checkLink > 0) {
				$("head").find("#poseidon-pro-custom-navi-font").remove();
			}
			$("head").append(googleFontSource);
			
			// Set CSS
			$('.main-navigation-menu a')
				.css('font-family', newval );
				
		} );
	} );
	
	wp.customize( 'poseidon_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {
		
			// Embed Font
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl;
			var googleFontSource = "<link id='poseidon-pro-custom-widget-title-font' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#poseidon-pro-custom-widget-title-font").length;
			
			if (checkLink > 0) {
				$("head").find("#poseidon-pro-custom-widget-title-font").remove();
			}
			$("head").append(googleFontSource);
			
			// Set CSS
			$('button, input[type="button"], input[type="reset"], input[type="submit"], .widget-title, .more-link, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title span')
				.css('font-family', newval );
				
		} );
	} );

} )( jQuery );