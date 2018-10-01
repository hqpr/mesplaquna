(function( $, sr ){
	"use strict";
	/*jshint unused: vars */	
	
	// smartresize function from Paul Irish
	// http://www.paulirish.com/2009/throttled-smartresize-jquery-event-handler/
	// debouncing function from John Hann
	// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
	var debounce = function ( func, threshold, execAsap ) {
	   var timeout;

	   return function debounced () {
			var obj = this, args = arguments;
			function delayed () {
				if ( !execAsap )
					func.apply( obj, args );
				timeout = null;
			}

			if ( timeout )
				clearTimeout( timeout );
			else if ( execAsap )
				func.apply( obj, args );

			timeout = setTimeout( delayed, threshold || 100 );
	   };
	};
	// smartresize 
	jQuery.fn[ sr ] = function( fn ){  return fn ? this.bind( 'resize', debounce( fn ) ) : this.trigger( sr ); };

})( jQuery, 'smartresize' );



(function( $ ) {

	"use strict";
	/*global jQuery */
	/*jslint bitwise: true */

	var CANOS =  CANOS || {};

	CANOS.body = $( document.documentElement );

	/*---------------------------------------------*/
	/*	Window width/height check
	/*---------------------------------------------*/

	CANOS.viewport = function() {

		var e = window,
		a = 'inner';

		if ( ! ( 'innerWidth' in window ) ) {
			a = 'client';
			e = document.documentElement || document.body;
		}

		return { width : e[ a + 'Width' ] , height : e[ a + 'Height' ] };
	};

	/*---------------------------------------------*/
	/*	is iOS check
	/*---------------------------------------------*/

	CANOS.is_ios = function() {

		var iOS = /iPad|iPhone|iPod/.test(navigator.platform);

		return iOS;
	};

	/*---------------------------------------------*/
	/*	Firefox check
	/*---------------------------------------------*/

	CANOS.firefoxCheck = function() {

		var is_firefox = navigator.userAgent.toLowerCase().indexOf( 'firefox' ) > -1;

		if ( is_firefox ) {
			if ( document.documentElement.classList ) {
				document.documentElement.classList.add( 'firefox' );
			}
		}
	};

	/*---------------------------------------------*/
	/*	Logo Retina
	/*---------------------------------------------*/

	CANOS.retina = function( dektop, retina ) {

		if ( $( document.getElementById( retina ) ).length > 0 ) {
			var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1,
				desktopLogo = $( document.getElementById( dektop ) ),
				retinaLogo = $( document.getElementById( retina ) ),
				logoWidth = desktopLogo.width(),
				logoHeight = desktopLogo.height();

			if ( pixelRatio > 1 ) {
				retinaLogo.attr({ height: logoHeight, width: logoWidth });
				retinaLogo.css( 'display', 'inline-block' );
				desktopLogo.hide();
			}
		}
	};

	/*---------------------------------------------*/
	/*	Navigation Menu
	/*---------------------------------------------*/

	CANOS.siteNav = function() {

		var off_open = false,
			clickable = false,
			page = $( document.getElementById( 'page' ) ) ,
			menu_toggle = $( document.getElementById( 'site-navigation-toggle' ) );

		menu_toggle.on( 'click', function( e ) {
			e.preventDefault();
			if ( off_open === false ) {
				openMenu();
			} else {
				closeMenu();
			}
		});

		function openMenu() {
			if ( ! CANOS.body.hasClass( 'menu-open' ) ) {
				CANOS.body.addClass( 'move-left' );
				off_open = true;
				setTimeout( function () {	
					CANOS.body.addClass( 'off-open' );
					clickable = true;
				}, 1);
			}
		}

		function closeMenu() {
			if ( off_open === true ) {
				off_open = false;
				clickable = false;
				CANOS.body.removeClass( 'move-left' );
				setTimeout( function () {	
					CANOS.body.removeClass( 'off-open' );
				}, 1);
			}
		}

		$( window ).smartresize( function() {
			if ( off_open === true ) {
				closeMenu();
			}
		});

		page.on( 'click', function() {
			if ( off_open === true && clickable === true ) {
				closeMenu();
			}
		});
	};

	/*---------------------------------------------*/
	/*	Navigation Menu
	/*---------------------------------------------*/

	CANOS.siteSocial = function() {

		var social_open = false,
			clickable = false,
			page = $( document.getElementById( 'page' ) ) ,
			social_toggle = $( document.getElementById( 'site-follow-toggle' ) );

		social_toggle.on( 'click', function( e ) {
			e.preventDefault();
			if ( social_open === false ) {
				openSocial();
			} else {
				closeSocial();
			}
		});

		function openSocial() {
			if ( ! CANOS.body.hasClass( 'menu-open' ) ) {
				CANOS.body.addClass( 'move-bottom' );
				social_open = true;
				setTimeout( function () {	
					CANOS.body.addClass( 'social-open' );
					clickable = true;
				}, 1);
			}
		}

		function closeSocial() {
			if ( social_open === true ) {
				social_open = false;
				clickable = false;
				CANOS.body.removeClass( 'move-bottom' );
				setTimeout( function () {	
					CANOS.body.removeClass( 'social-open' );
				}, 1);
			}
		}

		$( window ).smartresize( function() {
			if ( social_open === true ) {
				closeSocial();
			}
		});

		page.on( 'click', function() {
			if ( social_open === true && clickable === true ) {
				closeSocial();
			}
		});
	};

	/*---------------------------------------------*/
	/*	Content/sidebar height
	/*---------------------------------------------*/

	CANOS.siteHeight = function() {

		function normalizeSiteHeight() {
			if ( document.getElementById( 'secondary' ) ) {
				$( document.getElementById( 'secondary' ) ).css({ 'min-height': '' });
				if ( document.getElementById( 'post-meta' ) ) {
					$( document.getElementById( 'secondary' ) ).css({ 'margin-top': 0 });
				}
			}
			$( document.getElementById( 'main' ) ).css({ 'min-height': '' });
		}

		function setSiteHeight() {
			if ( document.getElementById( 'secondary' ) ) {
				$( document.getElementById( 'secondary' ) ).css({ 'min-height': '' });
				if ( document.getElementById( 'post-meta' ) ) {
					$( document.getElementById( 'secondary' ) ).css({ 'margin-top': 0 });
				}
			}
			$( document.getElementById( 'main' ) ).css({ 'min-height': '' });

			if ( document.getElementById( 'secondary' ) ) {
				var content_height = $( document.getElementById( 'main' ) ).outerHeight(),
					sidebar_height = $( document.getElementById( 'secondary' ) ).outerHeight();

				if ( document.getElementById( 'post-meta' ) ) {
					var meta_height = $( document.getElementById( 'post-meta' ) ).outerHeight();
					sidebar_height = sidebar_height - meta_height;
					content_height = content_height - meta_height;
					$( document.getElementById( 'secondary' ) ).css({ 'margin-top': meta_height });
				}

				if ( content_height > sidebar_height ) {
					$( document.getElementById( 'secondary' ) ).css({ 'min-height': content_height });
				} else if ( content_height < sidebar_height ) {
					$( document.getElementById( 'main' ) ).css({ 'min-height': sidebar_height });
				}
			}
		}

		if ( CANOS.viewport().width >= 992 || CANOS.body.hasClass( 'no-responsive' ) ) {
			setSiteHeight();
		}

		$( window ).smartresize( function() {
			if ( CANOS.viewport().width >= 992 || CANOS.body.hasClass( 'no-responsive' ) ) {
				setSiteHeight();
			} else if ( CANOS.viewport().width < 992 || CANOS.body.hasClass( 'no-responsive' ) ) {
				normalizeSiteHeight();
			}
		});
	};

	/*---------------------------------------------*/
	/*	Back to top
	/*---------------------------------------------*/

	CANOS.backTop = function() {
		$( '#back-top' ).click( function() {
			$( 'body, html' ).animate({
				scrollTop: 0
			}, 300 );
			return false;
		});
	};

	/*---------------------------------------------*/
	/* Init Functions
	/*---------------------------------------------*/

	$( document ).ready( function() {
		CANOS.siteNav();
		CANOS.backTop();
		CANOS.firefoxCheck();
		if ( document.getElementById( 'site-follow' ) ) {
			CANOS.siteSocial();
		}

		if ( CANOS.is_ios() ) {
			$( document.documentElement ).addClass( 'is-ios' );
		}
	});

	$( window ).load( function() {
		CANOS.retina( 'desktop-logo', 'retina-logo' );
		CANOS.retina( 'footer-desktop-logo', 'footer-retina-logo' );
		CANOS.siteHeight();
	});

})( jQuery );
