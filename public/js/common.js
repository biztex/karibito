/**
 * common.js
 *
 *  version --- 1.0
 *  updated --- 2017/11/30
 */


/* !stack ------------------------------------------------------------------- */
jQuery(document).ready(function ($) {
	pageScroll();
	rollover();
	common();
});

/* !isUA -------------------------------------------------------------------- */
var isUA = (function () {
	var ua = navigator.userAgent.toLowerCase();
	indexOfKey = function (key) { return (ua.indexOf(key) != -1) ? true : false; }
	var o = {};
	o.ie = function () { return indexOfKey("msie"); }
	o.fx = function () { return indexOfKey("firefox"); }
	o.chrome = function () { return indexOfKey("chrome"); }
	o.opera = function () { return indexOfKey("opera"); }
	o.android = function () { return indexOfKey("android"); }
	o.ipad = function () { return indexOfKey("ipad"); }
	o.ipod = function () { return indexOfKey("ipod"); }
	o.iphone = function () { return indexOfKey("iphone"); }
	return o;
})();

/* !rollover ---------------------------------------------------------------- */
var rollover = function () {
	var suffix = { normal: '_no.', over: '_on.' }
	$('a.over, img.over, input.over').each(function () {
		var a = null;
		var img = null;

		var elem = $(this).get(0);
		if (elem.nodeName.toLowerCase() == 'a') {
			a = $(this);
			img = $('img', this);
		} else if (elem.nodeName.toLowerCase() == 'img' || elem.nodeName.toLowerCase() == 'input') {
			img = $(this);
		}

		var src_no = img.attr('src');
		var src_on = src_no.replace(suffix.normal, suffix.over);

		if (elem.nodeName.toLowerCase() == 'a') {
			a.bind("mouseover focus", function () { img.attr('src', src_on); })
				.bind("mouseout blur", function () { img.attr('src', src_no); });
		} else if (elem.nodeName.toLowerCase() == 'img') {
			img.bind("mouseover", function () { img.attr('src', src_on); })
				.bind("mouseout", function () { img.attr('src', src_no); });
		} else if (elem.nodeName.toLowerCase() == 'input') {
			img.bind("mouseover focus", function () { img.attr('src', src_on); })
				.bind("mouseout blur", function () { img.attr('src', src_no); });
		}

		var cacheimg = document.createElement('img');
		cacheimg.src = src_on;
	});
};
/* !pageScroll -------------------------------------------------------------- */
var pageScroll = function () {
	jQuery.easing.easeInOutCubic = function (x, t, b, c, d) {
		if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
		return c / 2 * ((t -= 2) * t * t + 2) + b;
	};

	$(window).on('load resize', function () {
		//var scrolltop = $('#headerIn').height(); //header fixed
		$('a.scroll, .scroll a').each(function () {
			$(this).unbind('click').bind("click keypress", function (e) {
				e.preventDefault();
				var target = $(this).attr('href');
				//var targetY = $(target).offset().top-scrolltop; //header fixed
				var targetY = $(target).offset().top;
				var parent = (isUA.opera()) ? (document.compatMode == 'BackCompat') ? 'body' : 'html' : 'html,body';
				$(parent).animate(
					{ scrollTop: targetY },
					400
				);
				return false;
			});
		});
	});

	$('.pageTop a').click(function () {
		$('html,body').animate({ scrollTop: 0 }, 'slow', 'swing');
		return false;
	});
}



/* !common --------------------------------------------------- */
var common = (function () {
	var scrollTop = 0;
	$(window).scroll(function () {
		scrollTop = $(window).scrollTop();
	});
	var windowTop = 0;
	$(window).scroll(function () {
		var scrolls = $(this).scrollTop();

		if (scrolls <= 0) {
			// $("#header").stop().fadeIn(200).removeClass("showFixed");
			$("#header").removeClass("showFixed");
		} else {
			if (scrolls >= windowTop) {
				windowTop = scrolls;
				// $("#header").stop().fadeOut(200).removeClass("showFixed");
				$("#header").removeClass("showFixed");

			} else {
				windowTop = scrolls;
				// $("#header").stop().fadeIn(200).addClass("showFixed");
				$("#header").addClass("showFixed");
			}
		}

	});
	//スマホグローバルナビ
	// $(".btnMenu").click(function(){
	// 	$("header nav").animate({ height: 'toggle', opacity: 'toggle' }, 'first');
	// 	$(this).toggleClass("active");
	// });
	// $(window).resize(function(){
	// 	setTimeout(function(){
	// 		if($(window).width() > 767) {
	// 			$("header nav").attr("style","");
	// 		}
	// 	},500);
	// });



	$(".searchBtnSp").click(function () {
		$('.searchWrapSp').toggleClass('active');
	});

	$(".serviceLink .span").click(function () {
		$(this).prev().toggleClass('active');
	});

	$("#gNavi .navLink").hover(function () {
		$(this).find('.navBox').addClass('active');
	}, function () {
		$(this).find('.navBox').removeClass('active');
	});

	// $(".navLinkA").click(function(){
	// 	$(this).next().toggleClass('active');
	// 	return false;
	// });

	$(".searchBtnSp").click(function () {
		$('.searchWrapSp').stop().fadeIn(200);
	});
	$(".searchClose").click(function () {
		$('.searchWrapSp').stop().fadeOut(200);
	});
	$(".searchItemUl .span").click(function () {
		$(this).toggleClass('active');
		$(this).next().slideToggle('active');
	});

	// $("#hiddenFile").click(function(){
	// 	$('.searchWrapSp').toggleClass('active');
	// });


	$(".btnMenu,.overlay").click(function () {
		if ($(".btnMenu").hasClass('active')) {
			$(".btnMenu").removeClass('active');
			$('header nav').removeClass('active').stop().fadeOut(200);
			$('.overlay').stop().fadeOut(200);
			$('body').removeClass('menuOpen');
			$('#wrapper').css('top', '0');
			$('html,body').animate(
				{ scrollTop: $('.overlay').text() },
				10
			);
		} else {
			$(".btnMenu").addClass('active');
			$('header nav').addClass('active').stop().fadeIn(200);
			$('.overlay').stop().fadeIn(200, function () {
				$('body').addClass('menuOpen')
				$('#wrapper').css('top', '-' + scrollTop + 'px');
				$('.overlay').text(scrollTop);
			});
		}
	});

	$(window).on('load resize', function () {
		setTimeout(function () {
			if ($(window).width() > 767) {
				$("header nav").removeClass('active').attr("style", "");
				$(".btnMenu").removeClass('active');
				// $('header nav').removeClass('active').stop().fadeOut(200);
				$('.overlay').stop().fadeOut(200);
				$('body').removeClass('menuOpen');
				$('#wrapper').css('top', '0');


				if ($('.sliderSP02').hasClass('isSlider')) {
					$('.sliderSP02').slick('unslick');
					$('.sliderSP02').removeClass('isSlider');
				}
			} else {
				if (!$('.sliderSP02').hasClass('isSlider')) {
					$('.sliderSP02').slick({
						infinite: false,
						arrows: true,
						slidesToShow: 2,
						slidesToScroll: 1,
						variableWidth: true,
						responsive: [{
							breakpoint: 768,
							settings: {
								arrows: false,
								// centerMode:true,
							}
						}]
					});
					$('.sliderSP02').addClass('isSlider');
				}
			}

		}, 500);
	});

	$('.biggerlink').biggerlink();

	$(".otherBtn").click(function () {
		$(this).toggleClass("active");
		$(this).parents('.tabBox').find('.otherWrap').stop().slideDown(200);
		return false;
	});

	$('#mainVisual .slider').slick({
		autoplay: true,
		infinite: true,
		arrows: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		centerMode: true,
		variableWidth: true,
		responsive: [{
			breakpoint: 768,
			settings: {
				slidesToShow: 2,
			}
		}]
	});

	$(".aboutFeatures .slider").slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		dots: true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3,
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
				}
			}
		]
	});
	$(".aboutFeatures .slider").on('afterChange', function (event, slick, currentSlide) {
		muchHeight();
	});
	$('.sliderSP').slick({
		infinite: false,
		arrows: true,
		slidesToShow: 2,
		slidesToScroll: 1,
		variableWidth: true,
		responsive: [{
			breakpoint: 768,
			settings: {
				arrows: false,
			}
		}]
	});

	$('.detailStyle .slider .big').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.detailStyle .slider .small'
	});
	$('.detailStyle .slider .small').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.detailStyle .slider .big',
		arrows: false,
		focusOnSelect: true,
	});

	$('.tabWrap').each(function () {
		var $this = $(this),
			$btn = $this.find('.tabLink a'),
			$box = $this.find('.tabBox');
		$btn.click(function () {
			var _target = $(this).attr('href');
			$btn.removeClass('is_active');
			$(this).addClass('is_active');
			$box.removeClass('is_active');
			$(_target).addClass('is_active');
			return false;
		});
	});


	$(window).on('load resize', function () {
		$('.toggleWrap').each(function () {
			var $btn = $(this).find('.toggleBtn');
			var $box = $(this).find('.toggleBox');
			if ($(window).width() > 767) {
				$btn.unbind('click');
				$box.attr("style", "");
			} else {
				$btn.unbind('click').click(function () {
					if ($(this).hasClass('open')) {
						$(this).removeClass('open');
						$box.stop().slideUp(200);
					} else {
						$(this).addClass('open');
						$box.stop().slideDown(200);
					}
				});
			}
		});
		$('.toggleWrapPC li').each(function () {
			var $btn = $(this).find('.toggleBtn');
			var $box = $(this).find('.toggleBox');
			$btn.unbind('click').click(function () {
				if ($(this).hasClass('open')) {
					$(this).removeClass('open');
					$box.stop().slideUp(200);
				} else {
					$(this).addClass('open');
					$box.stop().slideDown(200);
				}
			});
		});
	});

	$('.imgBox').each(function () {
		$(this).css({ backgroundImage: 'url(' + $(this).data('img') + ')' });
	});
	$('.specialtyItem').each(function () {
		$(this).find(".specialtyBtn").click(function () {
			$(this).before($(this).prev().clone());
		});
	});

	$('.fancybox').fancybox({
		helpers: {
			overlay: {
				locked: true
			}
		},
		closeBtn: false
	});
	$('.fancyPersonCancel,.fancyRegisterSubmit,.fancyPersonSign').click(function () {
		parent.$.fancybox.close();
	});

	$(".serviceLink .box").slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		dots: false,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3,
				}
			}
		]
	});

});



function ophiddenFile() {
	var dd = $('#hiddenFile').val().split('\\');
	$('#showSrc').val(dd[dd.length - 1]);
	if (dd == '') {
		$('#showButton').removeClass('active');
	} else {
		$('#showButton').addClass('active');
	}

}



$(function () {
	$('.tabSelectArea').each(function () {
		var $this = $(this),
			$links = $this.find('.tabSelectLinks'),
			$box = $this.find('.tabSelectBox');
		$links.change(function () {
			var target = $(this).val();
			$box.removeClass('is-active');
			$(target).addClass('is-active');
		});
	});

	$('.templateOpen').click(function () {
		$('.templatePopup').addClass('is-open');
	});

	$('.templateOverlay,.templateClose').click(function () {
		$('.templatePopup').removeClass('is-open');
	});

	$('.templateOverlay,.templateClose').click(function () {
		$('.templatePopup').removeClass('is-open');
	});

	$('.templateInput').click(function () {
		var text = $('.templateBox.is-active').find('textarea').val();
		$('.templateText').val(text);
		$('.templatePopup').removeClass('is-open');
	});
});


$(".creditCode .link").on("click", function () {
	return false;
});
