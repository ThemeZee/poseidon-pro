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
			$('.entry-content a, .entry-content a:link, .entry-content a:visited, .post-navigation a:link, .post-navigation a:visited, .comments-area a:link, .comments-area a:visited, .more-link:link, .more-link:visited, .breadcrumbs a:link, .breadcrumbs a:visited')
				.css('color', newval );
			$('.entry-content a, .post-navigation a, .more-link, .comments-area a, .breadcrumbs a')
				.hover( function() { $( this ).css('color', '#404040' ); },
						function() { $( this ).css('color', newval ); }
				);
			$('button, input[type="button"], input[type="reset"], input[type="submit"]')
				.css('background', newval );
			$('button, input[type="button"], input[type="reset"], input[type="submit"]')
				.hover( function() { $( this ).css('background', '#404040' ); },
						function() { $( this ).css('background', newval ); }
				);
			$('.entry-tags .meta-tags a')
				.hover( function() { $( this ).css('background', newval ); },
						function() { $( this ).css('background', '#eeeeee' ); }
				);
		} );
	} );
	
	/* Top Navigation Color Option */
	wp.customize( 'poseidon_theme_options[top_navi_color]', function( value ) {
		value.bind( function( newval ) {
			$('.header-bar-wrap, .top-navigation-menu ul')
				.css('background', newval );
		} );
	} );
	
	/* Widget Title Color Option */
	wp.customize( 'poseidon_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('.widget-title, .widget-title a:link, .widget-title a:visited, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title span, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab')
				.not( $('.footer-widgets .widget-title') )
				.css('color', newval );
			$('.tzwb-tabbed-content .tzwb-tabnavi li a')
				.hover( function() { $( this ).css('color', newval ); },
						function() { $( this ).css('color', '#404040' ); }
				)
				
		} );
	} );
	
	/* Widget Link Color Option */
	wp.customize( 'poseidon_theme_options[widget_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('.sidebar .widget a:link, .sidebar .widget a:visited')
				.not( $('.sidebar .widget_tag_cloud .tagcloud a, .sidebar .widget .entry-meta a, .tzwb-tabbed-content .tzwb-tabnavi li a, .tzwb-social-icons .social-icons-menu li a, .footer-widgets .widget a') )
				.css('color', newval );
			$('.sidebar .widget a')
				.not( $('.sidebar .widget_tag_cloud .tagcloud a, .sidebar .widget .entry-meta a, .tzwb-tabbed-content .tzwb-tabnavi li a, .tzwb-social-icons .social-icons-menu li a, .footer-widgets .widget a') )
				.hover( function() { $( this ).css('color', '#404040' ); },
						function() { $( this ).css('color', newval ); }
				);
			$('.sidebar .widget_tag_cloud .tagcloud a')
				.hover( function() { $( this ).css('background', newval ); },
						function() { $( this ).css('background', '#eeeeee' ); }
				);
			$('.tzwb-social-icons .social-icons-menu li a')
				.css('background', newval );
			$('.tzwb-social-icons .social-icons-menu li a')
				.hover( function() { $( this ).css('background', '#404040' ); },
						function() { $( this ).css('background', newval ); }
				);
				
		} );
	} );
	
	/* Footer Widgets Color Option */
	wp.customize( 'poseidon_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			$('.footer-widgets-background')
				.css('background', newval );
		} );
	} );
	
	
	/* Theme Fonts */	
	wp.customize( 'poseidon_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {
		
			// Embed Font
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":400,700";
			var googleFontSource = "<link id='poseidon-pro-custom-text-font' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#poseidon-pro-custom-text-font").length;
			
			if (checkLink > 0) {
				$("head").find("#poseidon-pro-custom-text-font").remove();
			}
			$("head").append(googleFontSource);
			
			// Set CSS
			$('body, button, input, select, textarea')
				.css('font-family', newval );
				
		} );
	} );
	
	wp.customize( 'poseidon_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {
		
			// Embed Font
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":400,700";
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
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":400,700";
			var googleFontSource = "<link id='poseidon-pro-custom-navi-font' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#poseidon-pro-custom-navi-font").length;
			
			if (checkLink > 0) {
				$("head").find("#poseidon-pro-custom-navi-font").remove();
			}
			$("head").append(googleFontSource);
			
			// Set CSS
			$('.top-navigation-menu a, .main-navigation-menu a, .footer-navigation-menu a')
				.css('font-family', newval );
				
		} );
	} );
	
	wp.customize( 'poseidon_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {
		
			// Embed Font
			var fontFamilyUrl = newval.split(" ").join("+");
			var googleFontPath = "http://fonts.googleapis.com/css?family="+fontFamilyUrl+":400,700";
			var googleFontSource = "<link id='poseidon-pro-custom-widget-title-font' href='"+googleFontPath+"' rel='stylesheet' type='text/css'>";					
			var checkLink = $("head").find("#poseidon-pro-custom-widget-title-font").length;
			
			if (checkLink > 0) {
				$("head").find("#poseidon-pro-custom-widget-title-font").remove();
			}
			$("head").append(googleFontSource);
			
			// Set CSS
			$('button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .widget-title, .post-pagination a, .post-pagination .current, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title span, .tzwb-tabbed-content .tzwb-tabnavi li a')
				.css('font-family', newval );
				
		} );
	} );

} )( jQuery );