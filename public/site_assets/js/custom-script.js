$(document).ready(function() {
	'use strict';  
	
	/*----------------------------------------
	   Tooltip
	------------------------------------------*/
	$('[data-toggle="tooltip"]').tooltip();
	
	/*----------------------------------------
		Scroll to Top
	----------------------------------------*/
	function BackToTop() {
		$('.vfx-scroll-top-btn').on('click', function() {
			$('html, body').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

		$(document).scroll(function() {
			var y = $(this).scrollTop();
			if (y > 600) {
				$('.vfx-scroll-top-btn').fadeIn();
			} else {
				$('.vfx-scroll-top-btn').fadeOut();
			}
		});
		$(document).scroll(function() {
			var m = $(this).scrollTop();
			if (m > 400) {
				$('.chat-popup').fadeIn();
			} else {
				$('.chat-popup').fadeOut();
			}
		});
	}
	BackToTop();

	$(window).scroll(function() {
		var scroll = $(window).scrollTop();

		if (scroll >= 100) {
			$(".header-top-section").addClass("header-top-none");
		} else {
			$(".header-top-section").removeClass("header-top-none");
		}
	});

	/*-------------------------------------------------*/
	/*    Scroll Between Sections
	/*-------------------------------------------------*/

	// Add scrollspy to <body>
	$('body').scrollspy({
		target: ".list_menu",
		offset: 50
	});

	// Add smooth scrolling on all links inside the navbar
	$("#list-menu a").on('click', function(event) {
		if (this.hash !== "") {
			event.preventDefault();

			var hash = this.hash;

			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 800, function() {

				// Add hash (#) to URL when done scrolling (default click behavior)
				window.location.hash = hash;
			});
		} // End if
	});

	$('.list-details-tab li, .hero_list li').on('click', (function() {
		$('li').removeClass("active");
		$(this).addClass("active");
	}));

	/* ----------------------------------------
		Hide Show Header on Scroll
	------------------------------------------ */
	function HideShowHeader() {

		var didScroll;
		var lastScrollTop = 0;
		var delta = 50;
		var navbarHeight = 75;
		var navbarHideAfter = navbarHeight

		$(window).scroll(function(event) {
			didScroll = true;
		});

		if ($('.scroll-hide').length > 0) {
			setInterval(function() {
				if (didScroll) {
					hasScrolled();
					didScroll = false;
				}
			}, 100);
		}
		return false;

		function hasScrolled() {
			var st = $(this).scrollTop();

			if (Math.abs(lastScrollTop - st) <= delta)
				return;

			if (st > lastScrollTop && st > navbarHideAfter) {
				if ($('.scroll-hide').length > 0) {
					$('header').addClass('hide');
				}
			} else {
				if ($('.scroll-hide').length > 0) {
					if (st + $(window).height() < $(document).height()) {
						$('header').removeClass('hide');
						$('.header.transparent').addClass('scroll');
					}
				}

				if ($(window).scrollTop() < 300) {
					$('.header.transparent').removeClass('scroll');
				}
			}

			lastScrollTop = st;
		}
	}
	HideShowHeader();

	/*------------------------------------------
		 Sticky Single Listing Menu
	-------------------------------------------*/
	$(window).on('load resize', function() {
		var containerWidth = $(".container").width();
		$('.fixed_nav').css('width', containerWidth);
	});
	$(window).scroll(function() {
		if ($(window).scrollTop() >= 700) {
			$('.list_menu').addClass('fixed-header');
		} else {
			$('.list_menu').removeClass('fixed-header');
		}
	});

	jQuery(document).ready(function($) {
		"use strict";

		/*-------------------------------------
			Magnific Popup js
		--------------------------------------*/
		$('.popup-yt, .property-yt').magnificPopup({
			type: 'iframe',
			mainClass: 'mfp-fade',
			preloader: true,
		});

		$('a.btn-gallery').on('click', function(event) {
			event.preventDefault();
			var gallery = $(this).attr('href');
			$(gallery).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled: true
				}
			}).magnificPopup('open');
		});

		/* -------------------------------------
			Footer Accordion
		-------------------------------------- */
		$(".vfx-nav-folderized h2").on('click', (function() {
			$(this).parent(".nav").toggleClass("open");
			$('html, body').animate({
				scrollTop: $(this).offset().top - 170
			}, 1500);
		}));

		/* -------------------------------------
			Responsive menu
		-------------------------------------- */
		var siteMenuClone = function() {

			$('.vfx-clone-navigation').each(function() {
				var $this = $(this);
				$this.clone().attr('class', 'site-nav-wrap').appendTo('.vfx-mobile-navigation-menu-body');
			});

			setTimeout(function() {
				var counter = 0;
				$('.vfx-mobile-navigation-menu .vfx-nav-children').each(function() {
					var $this = $(this);
					$this.prepend('<span class="arrow-collapse collapsed">');
					$this.find('.arrow-collapse').attr({
						'data-toggle': 'collapse',
						'data-target': '#collapseItem' + counter,
					});
					$this.find('> ul').attr({
						'class': 'collapse',
						'id': 'collapseItem' + counter,
					});
					counter++;
				});
			}, 1000);

			$('body').on('click', '.js-menu-toggle', function(e) {
				var $this = $(this);
				e.preventDefault();

				if ($('body').hasClass('offcanvas-menu')) {
					$('body').removeClass('offcanvas-menu');
					$this.removeClass('active');
				} else {
					$('body').addClass('offcanvas-menu');
					$this.addClass('active');
				}
			})

		};
		siteMenuClone();

		/* -------------------------------------
			Range Slider
		-------------------------------------- */
		/*========Area===========*/
		$("#slider-range_one").slider({
			range: true,
			min: 0,
			max: 8000,
			values: [1200, 4014],
			slide: function(event, ui) {
				$("#amount_one").val(ui.values[0] + " - " + ui.values[1] + " sq ft");
			}
		});
		$(" #amount_one").val($("#slider-range_one").slider("values", 0) +
			" - " + $("#slider-range_one").slider("values", 1) + " sq ft");
		/*==========Price===========*/
		/*$("#slider-range_two").slider({
			range: true,
			min: 0,
			max: 10000,
			values: [0, 6600],
			slide: function(event, ui) {
				$("#amount_two").val(ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$(" #amount_two").val($("#slider-range_two").slider("values", 0) +
			" - $" + $("#slider-range_two").slider("values", 1));*/
		
		/* -------------------------------------
			Slider
		-------------------------------------- */
		//Popular Property Slider
		var trending_place = new Swiper('.vfx-popular-property-wrap', {
			slidesPerView: 3,
			spaceBetween: 30,
			speed: 1500,
			loop: true,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			pagination: {
				el: '.vfx-popular-property-pagination',
				clickable: true,
			},
			// Responsive breakpoints
			breakpoints: {
				100: {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
				768: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				992: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				1249: {
					slidesPerView: 3,
					spaceBetween: 20
				}
			}
		});
		
		//Latest Property Slider
		var trending_place = new Swiper('.vfx-latest-property-wrap', {
			slidesPerView: 3,
			spaceBetween: 30,
			speed: 1500,
			loop: true,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			pagination: {
				el: '.vfx-latest-property-pagination',
				clickable: true,
			},
			// Responsive breakpoints
			breakpoints: {
				100: {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
				768: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				992: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				1249: {
					slidesPerView: 3,
					spaceBetween: 20
				}
			}
		});
		
		//Similar Listing Slider
		var similar_property = new Swiper('.similar-list-wrap', {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: false,
			speed: 1000,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			navigation: {
				nextEl: '.similar-next',
				prevEl: '.similar-prev',
			},
			// Responsive breakpoints
			breakpoints: {
				100: {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
				768: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				992: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				1249: {
					slidesPerView: 3,
					spaceBetween: 20
				}
			}
		});
		
		//Featured Listing Slider
		var featured_list = new Swiper('.featured-list', {
			slidesPerView: 1,
			spaceBetween: 5,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			// autoplay: {
			//     delay: 3000,
			//     disableOnInteraction: false,
			// },
			loop: true,
			speed: 1000,
			navigation: {
				nextEl: '.featured-next',
				prevEl: '.featured-prev',
			},
			// Responsive breakpoints
			breakpoints: {
				767: {
					slidesPerView: 1,
					spaceBetween: 30
				},
			}
		});
		
		//Single Featured List 
		var featured_list_two = new Swiper('.single-featured-list', {
			slidesPerView: 1,
			spaceBetween: 0,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			loop: true,
			speed: 1000,
			navigation: {
				nextEl: '.single-featured-next',
				prevEl: '.single-featured-prev',
			},

		});
		
		//Popular place slider one
		var popular_place = new Swiper('.popular-place-wrap.vfx1', {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: false,
			speed: 1000,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			navigation: {
				nextEl: '.popular-next',
				prevEl: '.popular-prev',
			},
			// Responsive breakpoints
			breakpoints: {
				100: {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
				768: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				992: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				1249: {
					slidesPerView: 3,
					spaceBetween: 20
				}
			}
		});

		//Team Slider
		var team_slider = new Swiper('.vfx-team-wrapper', {
			slidesPerView: 5,
			loop: true,
			speed: 1000,
			spaceBetween: 20,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			navigation: {
				nextEl: '.team_next',
				prevEl: '.team_prev',
			},
			// Responsive breakpoints
			breakpoints: {
				100: {
					slidesPerView: 2,
					slidesPerGroup: 1,
				},
				768: {
					slidesPerView: 3,
					slidesPerGroup: 1,
				},
				992: {
					slidesPerView: 4,
					slidesPerGroup: 1,
				},
				1025: {
					slidesPerView: 5,
					spaceBetween: 15
				},
				1200: {
					slidesPerView: 6,
					spaceBetween: 15
				}
			}
		});

		//Listing details carousel
		var list_details = new Swiper('.listing-details-slider', {
			slidesPerView: 3,
			spaceBetween: 0,
			loop: true,
			speed: 1000,
			navigation: {
				nextEl: '.listing-details-next',
				prevEl: '.listing-details-prev',
			},
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			breakpoints: {

				767: {
					slidesPerView: 1,
					spaceBetween: 15,
				}
			}
		});

		// Single Property Agency Slider
		var list_details = new Swiper('.single-agency-slider', {
			slidesPerView: 1,
			spaceBetween: 0,
			effect: 'fade',
			loop: true,
			speed: 1000,
			navigation: {
				nextEl: '.single-agency_next',
				prevEl: '.single-agency_prev',
			},
			autoplay: {
			    delay: 3000,
			    disableOnInteraction: false,
			},
			breakpoints: {

				767: {
					slidesPerView: 1,
					spaceBetween: 15,
				}
			}
		});

		/*---------------------------------
			Date Picker
		------------------------------------*/
		if ($("./*counter*/-widget").length > 0) {
			var countCurrent = $(".counter-widget").attr("data-countDate");
			$(".countdown").downCount({
				date: countCurrent,
				offset: 0
			});
		}

	});

	/*---------------------------------
	    Nice select
	-----------------------------------*/
	$('select').niceSelect();

	/*-------------------------------------
		Quantity Slider
	 -------------------------------------*/
	var quantitiy = 0;
	$('.quantity-right-plus').on("click", function(e) {
		e.preventDefault();
		var quantity = parseInt($(this).parent().siblings("input.input-number").val(), 10);
		$(this).parent().siblings("input.input-number").val(quantity + 1);
	});
	$('.quantity-left-minus').on("click", function(e) {
		e.preventDefault();
		var quantity = parseInt($(this).parent().siblings("input.input-number").val(), 10);
		if (quantity > 0) {
			$(this).parent().siblings("input.input-number").val(quantity - 1);
		}
	});

	$('#sort_by').on('change', function () {		 
		  var url = $(this).val(); 
		 
		  if (url) { 
			  window.location = url; 
		  }
		  return false;
	  });

});