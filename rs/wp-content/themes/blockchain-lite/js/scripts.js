jQuery(function ($) {
	'use strict';

	var $window = $(window);
	var $body = $('body');

	/* -----------------------------------------
	 Responsive Menus Init with mmenu
	 ----------------------------------------- */
	var $navWrap = $('.nav');
	var $navSubmenus = $navWrap.find('ul');
	var $mainNav = $('.navigation-main');
	var $mobileNav = $('#mobilemenu');

	$mainNav.each(function () {
		var $this = $(this);
		$this.clone()
			.removeAttr('id')
			.removeClass()
			.appendTo($mobileNav.find('ul'));
	});
	$mobileNav.find('li').removeAttr('id');

	$mobileNav.mmenu({
		offCanvas: {
			position: 'top',
			zposition: 'front'
		},
		autoHeight: true,
		navbars: [
			{
				position: 'top',
				content: [
					'prev',
					'title',
					'close'
				]
			}
		]
	});

	/* -----------------------------------------
	Menu classes based on available free space
	----------------------------------------- */
	function setMenuClasses() {
		if (!$navWrap.is(':visible')) {
			return;
		}

		var windowWidth = $window.width();

		$navSubmenus.each(function () {
			var $this = $(this);
			var $parent = $this.parent();
			$parent.removeClass('nav-open-left');
			var leftOffset = $this.offset().left + $this.outerWidth();

			if (leftOffset > windowWidth) {
				$parent.addClass('nav-open-left');
			}
		});
	}

	setMenuClasses();

	var resizeTimer;

	$window.on('resize', function () {
	  clearTimeout(resizeTimer);
	  resizeTimer = setTimeout(function () {
			setMenuClasses();
	  }, 350);
	});

	/* -----------------------------------------
	 Header Search Toggle
	 ----------------------------------------- */
	var $searchTrigger = $('.head-search-trigger');
	var $headSearchForm = $('.head-search-form');

	function dismissHeadSearch(e) {
		if (e) {
			e.preventDefault();
		}

		$headSearchForm.removeClass('head-search-expanded');
		$body.focus();
	}

	function displayHeadSearch(e) {
		if (e) {
			e.preventDefault();
		}

		$headSearchForm
			.addClass('head-search-expanded')
			.find('input')
			.focus();
	}

	function isHeadSearchVisible() {
		return $headSearchForm.hasClass('head-search-expanded')
	}

	$searchTrigger.on('click', displayHeadSearch);

	/* Event propagations */
	$(document).on('keydown', function (e) {
		e = e || window.e;
		if (e.keyCode === 27 && isHeadSearchVisible()) {
			dismissHeadSearch(e);
		}
	});

	$body
		.on('click', function (e) {
			if (isHeadSearchVisible()) {
				dismissHeadSearch();
			}
		})
		.find('.head-search-form, .head-search-trigger')
		.on('click', function (e) {
			e.stopPropagation();
		});

	/* -----------------------------------------
	 Responsive Videos with fitVids
	 ----------------------------------------- */
	$body.fitVids();

	$window.on('load', function () {
		/* -----------------------------------------
		 Isotope
		 ----------------------------------------- */
		$('.row-isotope').isotope();
	});
});
