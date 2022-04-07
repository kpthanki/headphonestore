(function($) {
	"use strict";
	var mcTimer =1;
	var DisplayFormat = "<div class='timer-day box'><span class='day'>%%D%%</span><span class='title'>Days</span></div><div class='timer-hour box'><span class='hour'>%%H%%</span><span class='title'>Hours</span></div><div class='timer-min box'><span class='min'>%%M%%</span><span class='title'>Mins</span></div><div class='timer-sec box'><span class='sec'>%%S%%</span><span class='title'>Secs</span></div>";
	var CountStepper = -1;
	var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;


	if ($(".flex-index").length){
		$(".flex-index .flexslider").flexslider({
			selector: ".slides > .item",
			animation: "slide",
			minItems: 1,
			slideshow: false,
			prevText: "",
			nextText: "",
			maxItems: 1,
			after: function(){
				$(".bx-caption.play").removeClass("play");
				$(".bx-caption.start").removeClass("start");
				$(".flex-active-slide .bx-caption").addClass("start");
				$(".flex-active-slide .bx-caption").addClass("play");
			}
		});
		responsiveSlider($(".flex-index"),1300,true);
		$(window).resize(function(){
			responsiveSlider($(".flex-index"),1300,true);
		});
	}

	$("#footer-brand .magicbrand").bxSlider({
		moveSlides: 1,auto: 0, speed: 800, controls: 1, pager: 0, maxSlides: 6, slideWidth: 270, responsiveBreakpoints: {480 : 1 ,640 : 3 ,768 : 5 ,992 : 6 ,}
	});
	$(".em-responsive").each(function(){
		if ($(this).attr("start-responsive")){
			responsiveSlider($(this),parseInt($(this).attr("start-responsive"),10),false);
		}
	});
	$(window).resize(function(){
		$(".em-responsive").each(function(){
			if ($(this).attr("start-responsive")){
				responsiveSlider($(this),parseInt($(this).attr("start-responsive"),10),false);
			}
		});
	});
	$(".portfolio-bx-slider").bxSlider({
		pager : false,
		controls: true
	});
	$(".about-bx-slider").bxSlider({
		pager : false,
		controls: true
	});
	$('.testimonials-about .bx-testimonial').bxSlider({
		moveSlide: 1,
		mode: 'fade',
		auto: 1,
		speed: 800,
		pause: 5000,
		controls: 1,
		pager: 1,
		maxSlides: 1,
		responsiveBreakpoints: {480 : 1 ,640 : 1 ,768 : 1 ,992 : 1}
	});
	if($(".process-skill").length){
		$(".process-skill").each(function(){
			add_class_play_animation($(".process-skill"));
		});
		$(window).on("scroll",function(){
			$(".process-skill").each(function(){
				add_class_play_animation($(".process-skill"));
			});
		});
	}
	if ($(".custom-select").length){
		$(".custom-select").heapbox();
	}

	if ($(".number-input").length){
		$(".number-input .plus").on("click",function(){
			var inputSelector = $(this).parent().children("input");
			inputSelector.val(parseInt(inputSelector.val(),10) + 1);
		});
		$(".number-input .minus").on("click",function(){
			var inputSelector = $(this).parent().children("input");
            if (inputSelector.val()>1){
                inputSelector.val(parseInt(inputSelector.val(),10) - 1);
            }
		});
	}
	if ($("#popup-newsletter").length){
		popup();
	}
	countdown();
	if ($('#search_mini_form .ddslick').length){
		search_form();
	}
	if ($(".nav-accordion").length){
		page_categories();
	}
	fix_lat_vat();
	if ($(".featured-product-tab").length){
		magic_tab();
	}
	if ($(".product-collateral").length){
		product_tab();
	}
	if ($(".product-image-thumbs").length){
		$(".product-image-thumbs").bxSlider({
			moveSlide: 1,
			mode: 'horizontal',
			auto: 1,
			speed: 800,
			pause: 5000,
			controls: 1,
			pager: 1,
			maxSlides: 4,
			minSlides: 4,
			slideWidth: 75,
			slideMargin: 20
		});
	}
	slider_in_index();
	magic_product();
	if ($(".slider-ui").length){
		$(".slider-ui").each(function(){
			var slider_min = 0;
			var slider_max = 1000;
			var slider_min_start = 0;
			var slider_max_start = 1000;
			var selector = $(this);
			var iid = selector.attr("id");

			if (selector.attr("slider-min")) slider_min = parseInt(selector.attr("slider-min"),10);
			if (selector.attr("slider-max")) slider_max = parseInt(selector.attr("slider-max"),10);
			if (selector.attr("slider-min-start")) slider_min_start = parseInt(selector.attr("slider-min-start"),10);
			if (selector.attr("slider-max-start")) slider_max_start = parseInt(selector.attr("slider-max-start"),10);
			selector.slider({
				range : true,
				min: slider_min,
				max: slider_max,
				values : [slider_min_start,slider_max_start],
				slide: function( event, ui ) {
					$('.range_value_min[target="#' + iid + '"]').val( ui.values[ 0 ]);
					$('.range_value_max[target="#' + iid + '"]').val( ui.values[ 1 ]);
				}
			});
			$('.range_value_min[target="#' + iid + '"]').val(slider_min_start);
			$('.range_value_max[target="#' + iid + '"]').val(slider_max_start);
		});
		$('.range_value_min').on("change",function(){
			var value_this = parseInt(crop_currency($(this).val()),10);
			var selector_other = $('.range_value_max[target="' + $(this).attr("target") + '"]');
			var value_other = parseInt(crop_currency(selector_other.val()),10);
			if (!(selector_other.hasClass("error"))){
				if (value_this < 0 || value_this > value_other){
					$(this).addClass("error");
				}else{
					$(this).removeClass("error");
					$($(this).attr("target")).slider( "option", "values", [ value_this, value_other ] );
					$(this).val(value_this);
					selector_other.val( value_other);
				}
			}else{
				$(this).addClass("error");
			}
			return false;
		});

		$('.range_value_max').on("change",function(){
			var value_this = parseInt(crop_currency($(this).val()),10);
			var value_max = $( $(this).attr("target") ).slider( "option", "max" );
			var selector_other = $('.range_value_min[target="' + $(this).attr("target") + '"]');
			var value_other = parseInt(crop_currency(selector_other.val()),10);
			if (value_this > value_max){
				value_this = value_max;
				$(this).val(value_this);
			}
			if (!(selector_other.hasClass("error"))){
				if (value_this < value_other){
					$(this).addClass("error");
				}else{
					$(this).removeClass("error");
					$($(this).attr("target")).slider( "option", "values", [ value_other , value_this ] );
					$(this).val(value_this);
					selector_other.val( value_other);
				}
			}else{
				$(this).addClass("error");
			}
			return false;
		});
	}

	function crop_currency(value_string){
		var value_end = value_string;
		if (value_string.search("�") > -1){
			value_end = value_string.substring(1,value_string.length + 1);
		}
		return value_end;
	}

	$(window).bind('load',function(){
		if ($(".filter-control").length){
			filter_portfolio();
		}
		if ($(".blog-mansory").length){
			$('.blog-mansory').isotope({
			  itemSelector: '.blog-mansory-item',
			  percentPosition: true,
			  masonry: {
				// use outer width of grid-sizer for columnWidth
				columnWidth: 360,
				gutter: 30
			  }
			})
		}
	});

	function product_tab(){
		$(".toggle-tabs li").on("click",function(){
			$(".toggle-tabs li").removeClass("active");
			$(this).addClass("active");
			$(".box-collateral").removeClass("active");
			$($(this).attr("target")).addClass("active");
			return false;
		});
	}

	function search_form(){
		$('#search_mini_form .ddslick').ddslick({
			width: 160,
			onSelected: function (opt) {
				$('#search_mini_form #catsearch').val(opt.selectedData.value)
			}
		});
	}

	function add_class_play_animation(selector){
		var current_height = selector.height();
		var window_height = $(window).height();
		var current_offset = selector.offset();
		var current_top = current_offset.top;
		var window_top = window.scrollY;
		if (selector.hasClass("go-animation")){
			if (current_top > window_top) {
				if (((current_top - window_top) <= (window_height / 2)) || ((window_top + window_height - current_top) >= current_height)){
					selector.addClass('play-animation');
					selector.removeClass('go-animation');
					animate_number();
				}
			} else {
				if (((window_top - current_top - current_height) <= (window_height / 2)) || (current_top == window_height)){
					selector.addClass('play-animation');
					selector.removeClass('go-animation');
					animate_number();
				}
			}
		}
	}

	function countdown(){

		if ($(".count_down_box").length){
			$(".count_down_box").each(function(){
				var dthen = new Date($(this).attr("data-date-then"));
				var start_date = Date.parse($(this).attr("data-date-now"));
				var dnow = new Date(start_date);
				var ddiff = new Date((dthen)-(dnow));
				var gsecs = Math.floor(ddiff.valueOf()/1000);
				var iid = $(this).attr("id");
				CountBack(gsecs,iid, mcTimer);
				mcTimer++;
			});
		}
	}

	function CountBack(secs,iid,mcTimer) {
		var DisplayStr;
		if (secs < 0) {
			document.getElementById(iid).innerHTML = "";
			return;
		}
		DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
		DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
		DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
		DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));
		document.getElementById(iid).innerHTML = DisplayStr;
		setTimeout(function(){CountBack((secs+CountStepper),iid,mcTimer)}, SetTimeOutPeriod);
	}

	function calcage(secs, num1, num2) {
		var s = ((Math.floor(secs/num1)%num2)).toString();
		if (s.length < 2) s = "0" + s;
		return "<b>" + s + "</b>";
	}

	function popup(){
		var overlay = "#353535";
		var popup   = $('#popup-newsletter');
		var popupWrapper = popup.parent()
		var imageUrl = "{{asset('resources/front/assets/images/popup-newletter.jpg')}}";
		// var pwidth  = 810;
		var pwidth  = 610;
		// var pheight = 500;
		var pheight = 400;
		if (popup.attr("imageurl")) imageUrl = popup.attr("imageurl");
		if (popup.attr("pwidth")) pwidth = popup.attr("pwidth");
		if (popup.attr("pheight")) pheight = popup.attr("pheight");
		popup.append("<div class='close-btn'></div>")
		popup.css({
			'background-image' : 'url(' + imageUrl + ')',
			"width":"100%",
			"max-width": pwidth + "px",
			"min-height": pheight + "px",
		})
		// $("body").addClass("modal-active");
		// popupWrapper.fadeIn(400);
		// popupWrapper.bind("click",function(event){
		// 	var selector = $(event.target);
		// 	if (selector.hasClass("popup") || selector.hasClass("close-btn")){
		// 		popupWrapper.fadeOut(400);
		// 		$("body").removeClass("modal-active");
		// 		magic_product();
		// 	}
        //
		// });
		// Center for popup
		popup_center();
		$(window).resize(function(){
			popup_center();
		})
	}

	// Center for popup
	function popup_center(){
		var popup = $('#popup-newsletter');
		var pH = popup.height();
		var wH = $(window).height()
		if (pH < wH){
			var mT = ((wH - pH) / 2) - 35;
			// popup.css({
			// 	"margin-top" : mT + "px",
			// })
		}else{
			popup.css({
				"margin-top" : "none",
			})
		}
	}

	function animate_number(){
		$('.process-skill .process-bar').each(function(){
			var x = parseInt($(this).attr('data-number'),10);
			$(this).children(".percent-text").children("span").animateNumber({number: x},900);
		});
	}

	function filter_portfolio(){
		if ($(".filter-packery").length){
			$('.filter-content').isotope({
				itemSelector: '.filter-item',
				layoutMode: 'packery',
				packery: {
				  gutter: 10,
				  columnWidth: 285
				}
			});
			$('.filter-control li').each(function(){
				if ($(this).attr("filter") != "*"){
					$(this).attr("filter","." + $(this).attr("filter"));
				}
			});
			$('.filter-control li').on("click",function(){
				var control = $(this);
				$('.filter-control li').removeClass('active');
				control.addClass('active');
				$('.filter-content').isotope({
					filter: control.attr('filter'),
					itemSelector: '.filter-item',
					layoutMode: 'packery',
					packery: {
					  gutter: 10,
					  columnWidth: 285
					}
				});
				return false;
			});
		}else{
			$(".filter-control li").on("click",function(){
				if (!($(this).hasClass("active"))){
					var parent_selector = $(this).parent().attr("target");
					var filter = $(this).attr("filter");
					$(".filter-control li").removeClass("active");
					$(this).addClass("active");
					if (filter == "*"){
						$(parent_selector + " .filter-item").parent().show(400);
					}else{
						$(parent_selector + " .filter-item").each(function(){
							if ($(this).hasClass(filter)){
								if ($(this).parent().is(":hidden")){
									$(this).parent().show(400);
								}
							}else{
								if ($(this).parent().is(":visible")){
									$(this).parent().hide(400);
								}
							}
						});
					}
				}
				return false;
			});
		}
		$(".filter-content .view").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600,
			'speedOut'		:	200,
			'overlayShow'	:	false
		});
	}

	function page_categories(){
		$(".nav-accordion").magicaccordion({
			accordion:true,
			speed: 400,
			closedSign: 'collapse',
			openedSign: 'expand',
			easing: 'easeInOutQuad'
		});
	}

	function magic_tab(){
		$(".featured-product-tab .magictabs .item").on("click",function(){
			if (!($(this).hasClass("active"))){
				$(".featured-product-tab .magictabs .item").removeClass('active');
				$(".featured-product-tab .content-products .mage-magictabs").removeClass("active");
				$(this).addClass("active");
				$(".featured-product-tab .content-products ." + $(this).attr("data-type")).addClass("active");
			}
			return false;
		});
	}

	function fix_lat_vat() {
		$(window).bind("load",function(){
			var maxheight = 0;
			$(".magicproduct_news .bx-viewport .item").each(function(){
				if ($(this).height() > maxheight) maxheight = $(this).height();
			});
			$(".magicproduct_news .bx-viewport").height(maxheight);
		});
		$(".mini-maincart").mouseover(function(){
			$(".mini-contentCart").stop(true, true).delay(200).slideDown(200);
		});
		$(".mini-maincart").mouseout(function(){
			$(".mini-contentCart").stop(true, true).delay(200).fadeOut(500);
		});
	}

	(function(selector){
		var $backtotop = $(selector);
		$backtotop.hide();
		var height =  $(document).height();
		$(window).scroll(function () {
			var ajaxPopup = $('#toPopup');
			if(ajaxPopup.length) {
				var ajaxPosition = ajaxPopup.offset();
				ajaxPopup.css({
					top : ajaxPosition.top,
					position: 'absolute',
				});
			}
			if ($(this).scrollTop() > height/10) {
				$backtotop.fadeIn();
			} else {
				$backtotop.fadeOut();
			}
		});
		$backtotop.on("click",function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

	})('#backtotop');

	function slider_in_index(){

		$('.featured-product-tab .content-products .products-grid-rows').bxSlider({
			moveSlides:2,
			infiniteLoop:0,
			maxSlides: 4,
			slideWidth:278,
			slideMargin:20,
			pager:0,
			controls:1,
			visibleItems:4,
			responsiveBreakpoints:{
				"480":"1",
				"640":"2",
				"768":"2",
				"992":"3",
				"993":"4"
			}
		});
		$('.featured-product-tab .content-products .bx-slider-active').bxSlider({
			moveSlides:2,
			infiniteLoop:0,
			maxSlides:4,
			slideWidth:278,
			slideMargin:20,
			pager:0,
			controls:1,
			speed:500,
			pause:1000,
			visibleItems:4,
			responsiveBreakpoints:{
				480:1,
				640:2,
				768:3,
				992:3
			}
		});
		$('#testimonial .testimonial').bxSlider({
			moveSlide: 1,
			mode: 'fade',
			auto: 1,
			speed: 800,
			pause: 5000,
			controls: 1,
			pager: 1,
			maxSlides: 1,
			responsiveBreakpoints: {480 : 1 ,640 : 1 ,768 : 1 ,992 : 1}
		});
		$('#deal-slider').bxSlider({
			auto: true,
			captions: true,
			controls: 0,
			pager: 1,
			pause: 3000,
			speed: 1000,
			onSlideBefore: function(el) {
				el.siblings().find('.bx-caption').removeClass('play');
				el.find('.bx-caption').addClass('play').addClass('start');
			},
		});

	}

	function magic_product(){
		$(".magicproduct_trending").magicproduct({
			selector : ".magicproduct_trending", // Selector product grid
		});
		$(".magicproduct_news").magicproduct({
			tabs  : '.blogtabs',
			product  : '.content-blog',
		});
		$(".magicproduct_bottom").magicproduct({
			selector : ".magicproduct_bottom", // Selector product grid
		});
		$(".magicproduct_active").magicproduct({
			selector : ".magicproduct_active", // Selector product grid
		});
		$(".magicproduct_lastest_product").magicproduct({
			selector : ".magicproduct_lastest_news", // Selector product grid
		});
		$(".magic_active_product").magicproduct({
			selector : ".magic_active_product", // Selector product grid
		});
	}
	function responsiveSlider(selector,maxWidth,keepFontsize){
		var wWidth = $(window).width();
		if (wWidth < maxWidth){
			var wPercent = (wWidth / maxWidth) * 10;
			selector.css({
				"font-size" : wPercent + "px"
			});
		}else{
			if (keepFontsize == true){
				selector.css({
					"font-size" : "10px"
				});
			}else{
				selector.css({
					"font-size" : "none"
				});
			}

		}
	}

})(jQuery);
