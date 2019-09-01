;(function($) {
	
	'use strict'
	
	var headerFixed = function() {
			var headerFix = $('.site-header').offset().top;
			$(window).on('ready scroll', function() {
				var y = $(this).scrollTop();
				if ( y > headerFix) {
					$('.site-header').addClass('fixed');
					$('body').addClass('siteScrolled');
				} else {
					$('.site-header').removeClass('fixed');
					$('body').removeClass('siteScrolled');
				}
				if ( y >= 107 ) {
					$('.site-header').addClass('float-header');
				} else {
					$('.site-header').removeClass('float-header');
				}
			});
	};
	
	var headerMenuLink = function() {
		$('.site-navigation a[href*="#"], .smoothscroll[href*="#"]').on('click',function (e) {
		    var target = this.hash;
		    var $target = $(target);

			if ( $target.length ) {
		    	e.preventDefault();
				$('html, body').stop().animate({
				     'scrollTop': $target.offset().top - 100
				}, 900, 'swing');
		        
		        return false;
			}
		});
	};
	
	var goTop = function() {
		$(window).scroll(function() {
			if ( $(this).scrollTop() > 800 ) {
				$('.go-top').addClass('show');
			} else {
				$('.go-top').removeClass('show');
			}
		}); 

		$('.go-top').on('click', function() {
			$("html, body").animate({ scrollTop: 0 }, 1000);
			return false;
		});
	};
	
	var responsiveMenu = function() {
		var	menuType = 'desktop';

		$(window).on('load resize', function() {
			var currMenuType = 'desktop';

			if ( matchMedia( 'only screen and (max-width: 1024px)' ).matches ) {
				currMenuType = 'mobile';
			}

			if ( currMenuType !== menuType ) {
				menuType = currMenuType;

				if ( currMenuType === 'mobile' ) {
					var $mobileMenu = $('#site-navigation').attr('id', 'site-navigation-mobi').hide();
					var hasChildMenu = $('#site-navigation-mobi').find('li:has(ul)');

					$('#header').find('.head-wrap').after($mobileMenu);
					hasChildMenu.children('ul').hide();
					hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
					$('.btn-menu').removeClass('active');
				} else {
					var $desktopMenu = $('#site-navigation-mobi').attr('id', 'site-navigation').removeAttr('style');

					$desktopMenu.find('.submenu').removeAttr('style');
					$('#header').find('.col-md-10').append($desktopMenu);
					$('.btn-submenu').remove();
				}
			}
		});

		$('.btn-menu').on('click', function() {
			$('#site-navigation-mobi').slideToggle(300);
			$(this).toggleClass('active');
		});

		$(document).on('click', '#site-navigation-mobi li .btn-submenu', function(e) {
			$(this).toggleClass('active').next('ul').slideToggle(300);
			e.stopImmediatePropagation()
		});
	}
	
	var bannerSlider = function() {
		$("#banner-slider").owlCarousel({
 
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			items : 1, 
			itemsDesktop : false,
			itemsDesktopSmall : false,
			itemsTablet: false,
			itemsMobile : false,
			navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
		 
		});
	}
	
	var productQty = function() {

		var singleqplus = $( '.single-product .summary .q-plus' );
		var singleqmin = $( '.single-product .summary .q-min' );
		$( '.single-product .summary ').find( '.quantity' ).find( 'input' ).before(singleqmin);
		$( '.single-product .summary ').find( '.quantity' ).find( 'input' ).after(singleqplus);


		function cartQtyButtons() {
			$( '.woocommerce-cart-form__contents .cart_item' ).each(function() {
				var cartqplus = $( this ).find( '.q-plus' );
				var cartqmin = $( this ).find( '.q-min' );

				$( this ).find( '.quantity' ).find( 'input' ).before(cartqmin);
				$( this ).find( '.quantity' ).find( 'input' ).after(cartqplus);
			});			
		}
		cartQtyButtons();

		$( 'body' ).on( 'click', '.q-plus, .q-min', function( e ) {
			e.preventDefault();
			var $qty = $( this ).closest( '.quantity' ).find( '.qty' ),
				currentVal = parseInt( $qty.val() ),
				isAdd = $( this ).hasClass( 'add' );

			!isNaN( currentVal ) && $qty.val( isAdd ? ++currentVal : ( currentVal > 0 ? --currentVal : currentVal ) );

			$("[name='update_cart']").removeAttr('disabled');

		} );

		$( 'body' ).on( 'updated_cart_totals', function(){
			cartQtyButtons();
		});

		if( $('body').hasClass('single-product') ) {
			if( $('.quantity.hidden').length || $('.input-text.qty').length < 1 ) {
				$('.q-min, .q-plus').remove();
			}
		}

	}
	
	// Dom Ready
	$(function() {
		headerFixed();
		headerMenuLink();
		goTop();
		responsiveMenu();
		bannerSlider();
		productQty();
   	});
	
	
})(jQuery);