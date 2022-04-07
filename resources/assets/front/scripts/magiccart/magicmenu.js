/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2014-04-25 13:16:48
 * @@Modify Date: 2015-05-29 14:58:24
 * @@Function:
 */
 
jQuery(document).ready(function($) {

	// for Mobile
    $('.nav-mobile').meanmenu({
    	meanMenuContainer: ".header-wrapper-bottom",
    	meanScreenWidth: "991",
	});	

	(function(selector){
		var $content = $(selector);
		var $navDesktop = $('.nav-desktop', $content);
		

	    // Sticker Menu
	    if($navDesktop.hasClass('sticker')){			
			$(window).scroll(function () {
			 if ($(this).scrollTop() > 80) {
			  $('.header-bottom').addClass('header-container-fixed');
			 } 
			 else{
			  $('.header-bottom').removeClass('header-container-fixed');
			 }
			 return false;
			});
	    }
	    // End Sticker Menu

		var $window  = $(window).width();
		setReponsive($window);
		$(window).resize(function(){
			var $window = $(window).width();
			setReponsive($window);
	 	})
		var $navtop = $('.level0', $content);
		var maxW 	= $('.container').outerWidth();
		$navtop.each(function(index, val) {
			var $options  = $(this).data('options');
			var $cat_mega = $('.cat-mega', $(this));
			var $children = $('.children', $cat_mega);
			var columns   = $children.length;
			var wchil 	  = $children.outerWidth();
			if($options){
				var columns 	= parseInt($options.cat_columns);
				var cat 		= parseFloat($options.cat_proportions);
				var left 		= parseFloat($options.left_proportions);
				var right 	 	= parseFloat($options.right_proportions);
				if(isNaN(left)) left = 0; if(isNaN(right)) right = 0;
				var custom 		= left + right;
				var proportions = cat + left + right;
				var cat_width	= Math.floor(100*cat/proportions);
				var temp 		= 100/columns;
				var col_width 	= (temp+Math.floor(temp))/2; // approximately down
				var left_width	= 100*left/proportions;
				var right_width	= 100*right/proportions;
				var $childtop  	= $('.child-top', $(this));
				var $block_left = $('.mega-block-left', $(this));
					$block_left.width(left_width + '%');
				var $block_right = $('.mega-block-right', $(this));
					$block_right.width(right_width + '%');
					$cat_mega.width(cat_width + '%');
				var wcolumns  = wchil*columns;
					if(custom){
						var wTopMega = wcolumns + (left_width*wcolumns)/cat_width + (right_width*wcolumns)/cat_width
						if(wTopMega > maxW) wTopMega = maxW;
						$('.content-mega-horizontal',$(this)).width(wTopMega);
					} else {
						if(wcolumns > maxW)	wcolumns = Math.floor(maxW / wchil)*wchil;
						$('.content-mega-horizontal',$(this)).width(wcolumns);	
					} 
					$children.each(function(idx) {
						if(idx % columns ==0 && idx != 0)   $(this).css("clear", "both");
					});
			} else {
				var wcolumns 	= wchil*columns;
				if(wcolumns > maxW)	wcolumns = Math.floor(maxW / wchil)*wchil;
				$('.content-mega-horizontal',$(this)).width(wcolumns);	
			}

		});

		function setReponsive($window){
			if (767 <= $window){
				jQuery('.nav-mobile').hide();
				var $navtop = $('.level0', $content);
			    $navtop.hover(function(){
			    	var wrapper 		= $('.container');
			       	var postionWrapper 	= wrapper.offset();
			       	var wWrapper 		= wrapper.width();  	/*include padding border*/
			       	var wMega   		= $('.level-top-mega', this).outerWidth(); /*include padding + margin + border*/
			       	var actualWidth 	= $('.level-top-mega', this).width(); 		/*no padding, margin, border*/
			       	var extWidth      	= wMega - actualWidth;
			       	var postionMega 	= $(this).offset();
			       	var margin_top 		= 10; // set in config
			       	var xTop 			= postionMega.top  - postionWrapper.top + margin_top;
			       	var xLeft 			= wWrapper - wMega - (wWrapper - wrapper.width())/2;
			       	var xLeft2 			= postionMega.left - postionWrapper.left;
			       	if(xLeft > xLeft2) xLeft = xLeft2;
			       	var topMega = $(this).find('.level-top-mega');
			       	if(topMega.length){
			       		// topMega.css('top',xTop);
			       		topMega.css('left',xLeft);
			       		$(this).addClass('over');
			       	}
			    },function(){
			       $(this).removeClass('over');
			    })
			}
		}

	})('.magicmenu');
	
	// Vertical Menu
	(function(selector){
		var $content = $(selector);
		var $window  = $(window).width();
		setReponsive($window);
		$(window).resize(function(){
			var $window = $(window).width();
			setReponsive($window);
	 	})
		var $navtop = $('.level0', $content);
		var maxW 	= $('.container').outerWidth();
		$navtop.each(function(index, val) {
			var $options  = $(this).data('options');
			var $cat_mega = $('.cat-mega', $(this));
			var $children = $('.children', $cat_mega);
			var columns   = $children.length;
			var wchil 	  = $children.outerWidth();
			if($options){
				var columns 	= parseInt($options.cat_columns);
				var cat 		= parseFloat($options.cat_proportions);
				var left 		= parseFloat($options.left_proportions);
				var right 	 	= parseFloat($options.right_proportions);
				if(isNaN(left)) left = 0; if(isNaN(right)) right = 0;
				var custom 		= left + right;
				var proportions = cat + left + right;
				var cat_width	= Math.floor(100*cat/proportions);
				var temp 		= 100/columns;
				var col_width 	= (temp+Math.floor(temp))/2; // approximately down
				var left_width	= 100*left/proportions;
				var right_width	= 100*right/proportions;
				var $childtop  	= $('.child-top', $(this));
				var $block_left = $('.mega-block-left', $(this));
					$block_left.width(left_width + '%');
				var $block_right = $('.mega-block-right', $(this));
					$block_right.width(right_width + '%');
					$cat_mega.width(cat_width + '%');
				var wcolumns  = wchil*columns;
					if(custom){
						var wTopMega = wcolumns + (left_width*wcolumns)/cat_width + (right_width*wcolumns)/cat_width
						if(wTopMega > maxW) wTopMega = maxW;
						$('.content-mega-horizontal',$(this)).width(wTopMega);
					} else {
						if(wcolumns > maxW)	wcolumns = Math.floor(maxW / wchil)*wchil;
						$('.content-mega-horizontal',$(this)).width(wcolumns);	
					} 
					$children.each(function(idx) {
						if(idx % columns ==0 && idx != 0)   $(this).css("clear", "both");
					});
			} else {
				var wcolumns 	= wchil*columns;
				if(wcolumns > maxW)	wcolumns = Math.floor(maxW / wchil)*wchil;
				$('.content-mega-horizontal',$(this)).width(wcolumns);	
			}

		});

		function setReponsive($window){
			if (767 <= $window){
				var $navtop = $('.level0', $content);
				var $container = $('.container');
				var wContainer = $container.outerWidth();
			    $navtop.hover(function(){
			    	var $options = $(this).data('options');
			    	var children 		= $('.children', this);
			       	var colSet 			= children.length;
			       	if($options){
			    		var columns 	= parseInt($options.cat_columns);
			    		if(columns) colSet = columns;
			       	}
			       	var postionWrapper 	= $container.offset();
			       	var wWrapper 		= $container.outerWidth();  	/*include padding border*/
			       	var wVmenu			= $content.outerWidth(true);
			       	var postionMega 	= $(this).position();
			       	var margin_top 		= 0; // set in config
			       	var wChild 			= children.outerWidth();
			       	var outerChildren 	= wChild - children.width();
			       	var wMageMax 		= $container.width()- wVmenu;
			       	var wCatMega		= colSet*wChild;
			       	if(wCatMega > wMageMax) wCatMega = wMageMax;
			       	var rBlock 			= $('.mega-block-right', this);
			       	var wRblock 		= rBlock.width();
			       	var megaHorizontal 	= wCatMega + wRblock;
			       	if(megaHorizontal < wMageMax) $('.content-mega-horizontal', this).width(megaHorizontal);
			       	$('.cat-mega', this).width(wCatMega);
			       	$('.level-top-mega', this).css('top',postionMega.top);
			       	$('.level-top-mega', this).css('margin-left',wVmenu-2); // - margin

			    },function(){

			    })
			}
		}

	})('.vmagicmenu');

});

