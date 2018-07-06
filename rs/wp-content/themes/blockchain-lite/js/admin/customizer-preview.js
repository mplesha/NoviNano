/**
 * Base Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Base Theme Customizer preview reload changes asynchronously.
 *
 * https://developer.wordpress.org/themes/customize-api/tools-for-improved-user-experience/#using-postmessage-for-improved-setting-previewing
 */

(function ($) {
	function createStyleSheet(settingName, styles) {
		var $styleElement;

		style = '<style class="' + settingName + '">';
		style += styles.reduce(function (rules, style) {
			rules += style.selectors + '{' + style.property + ':' + style.value + ';} ';
			return rules;
		}, '');
		style += '</style>';

		$styleElement = $('.' + settingName);

		if ($styleElement.length) {
			$styleElement.replaceWith(style);
		} else {
			$('head').append(style);
		}
	}

	//
	// Site title and description.
	//
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-logo a').text(to);
		});
	});

	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-tagline').text(to);
		});
	});

	//
	// Hero section
	//
	wp.customize('hero_text_color', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('color', to);
		});
	});

	wp.customize('hero_image', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-image', 'url(' + to + ')');
		});
	});

	wp.customize('hero_bg_color', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-color', to);
		});
	});

	wp.customize('hero_image_repeat', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-repeat', to);
		});
	});

	wp.customize('hero_image_position_x', function (value) {
		value.bind(function (to) {
			var $pageHero = $('.page-hero');
			var currentPosition = $pageHero.css('background-position');
			var newPosition = currentPosition.split(' ').map(function (pos, index) {
				return index === 0 ? to : pos;
			}).join(' ');

			$pageHero.css('background-position', newPosition);
		});
	});

	wp.customize('hero_image_position_y', function (value) {
		value.bind(function (to) {
			var $pageHero = $('.page-hero');
			var currentPosition = $pageHero.css('background-position');
			var newPosition = currentPosition.split(' ').map(function (pos, index) {
				return index === 1 ? to : pos;
			}).join(' ');

			$pageHero.css('background-position', newPosition);
		});
	});

	wp.customize('hero_image_attachment', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-attachment', to);
		});
	});

	wp.customize('hero_image_cover', function (value) {
		value.bind(function (to) {
			if (!to) {
				$('.page-hero').css('background-size', 'auto');
			} else {
				$('.page-hero').css('background-size', 'cover');
			}
		});
	});

	//
	// Header Top Menu Bar
	//
	wp.customize('header_top_bar_text_size', function (value) {
		value.bind(function (to) {
			$('.head-intro').css('font-size', to + 'px');
		});
	});

	wp.customize('header_top_bar_text_color', function (value) {
		value.bind(function (to) {
			$('.head-intro').css('color', to);
		});
	});

	wp.customize('header_top_bar_bg_color', function (value) {
		value.bind(function (to) {
			$('.head-intro').css('background-color', to);
		});
	});

	//
	// Header Main Menu Bar
	//
	wp.customize('header_primary_menu_padding', function (value) {
		value.bind(function (to) {
			$('.head-mast').css({
				paddingTop: to + 'px',
				paddingBottom: to + 'px'
			});
		});
	});

	wp.customize('header_primary_menu_text_size', function (value) {
		value.bind(function (to) {
			$('.navigation-main > li > a').css('.navigation-main > li > a', to + 'px');
		});
	});

	//
	// Footer Colors
	//
	wp.customize('footer_bg_color', function (value) {
		value.bind(function (to) {
			$('.footer-widgets').css('background-color', to);
		});
	});

	wp.customize('footer_text_color', function (value) {
		value.bind(function (to) {
			$('.footer-widgets,' +
				'.footer-widgets .widget,' +
				'.footer-widgets .widget-title,' +
				'.footer h1,.footer h2,.footer h3,' +
				'.footer h4,.footer h5,.footer h6,' +
				'.footer-widgets .ci-contact-widget-item i').css('color', to);
		});
	});

	wp.customize('footer_link_color', function (value) {
		value.bind(function (to) {
			$('.footer-widgets a,' +
				'.footer-widgets .widget a').css('color', to);
		});
	});

	wp.customize('footer_element_backgrounds', function (value) {
		value.bind(function (to) {
			$('.footer .item-btn,' +
				'.footer-widgets .social-icon,' +
				'.footer .ci-box-callout,' +
				'.footer .widget_nav_menu a').css('background-color', to);

			$('.footer .ci-schedule-widget-table tr').css('border-color', to);
		});
	});

	wp.customize('footer_border_color', function (value) {
		value.bind(function (to) {
			$('.footer .ci-contact-widget-item i,' +
				'.footer .data-item-eyebrow').css('color', to);

			$('.footer-info,' +
				'.footer .entry-item-media-title a,' +
				'.footer .widget-title,' +
				'.footer .ci-contact-widget-item,' +
				'.footer .data-item-wrap,' +
				'.footer .data-item-row,' +
				'.footer .widget_meta li a,' +
				'.footer .widget_pages li a,' +
				'.footer .widget_categories li a,' +
				'.footer .widget_archive li a,' +
				'.footer .widget_product_categories li a,' +
				'.footer .widget_layered_nav li a,' +
				'.footer .widget_recent_comments li,' +
				'.footer .widget_rss li,' +
				'.footer .widget_recent_entries li').css('border-color', to);
		});
	});

	wp.customize('footer_bottom_bg_color', function (value) {
		value.bind(function (to) {
			$('.footer-info').css('background-color', to);
		});
	});

	wp.customize('footer_bottom_text_color', function (value) {
		value.bind(function (to) {
			$('.footer-info').css('color', to);
		});
	});

	wp.customize('footer_bottom_link_color', function (value) {
		value.bind(function (to) {
			$('.footer-info a').css('color', to);
		});
	});

	wp.customize('footer_titles_color', function (value) {
		value.bind(function (to) {
			$('.footer .widget-title, .footer h1,.footer h2, ' +
				'.footer h3, .footer h4, .footer h5, .footer h6').css('color', to);
		});
	});

	//
	// Sidebar Colors
	//
	wp.customize('sidebar_bg_color', function (value) {
		value.bind(function (to) {
			$('.sidebar').css({
				backgroundColor: to,
				padding: '20px',
			});
		});
	});

	wp.customize('sidebar_text_color', function (value) {
		value.bind(function (to) {
			$('.sidebar,' +
				'.sidebar .widget,' +
				'.sidebar .data-item-value,' +
				'.sidebar .ci-contact-widget-item i').css('color', to);
		});
	});

	wp.customize('sidebar_link_color', function (value) {
		value.bind(function (to) {
			$('.sidebar a, .sidebar .widget a').not('.link-btn').css('color', to);
		});
	});

	wp.customize('sidebar_border_color', function (value) {
		value.bind(function (to) {
			$('.sidebar select, .sidebar input, .sidebar textarea').css('border-color', to);

			$('.sidebar .widget_recent_comments li,' +
				'.sidebar .widget_recent_entries li,' +
				'.sidebar .widget_rss li,' +
				'.sidebar .widget_meta li a,' +
				'.sidebar .widget_pages li a,' +
				'.sidebar .widget_categories li a,' +
				'.sidebar .widget_archive li a,' +
				'.sidebar .widget-title,' +
				'.sidebar .social-icon,' +
				'.sidebar .data-item-wrap,' +
				'.sidebar .data-item-list .data-item-row,' +
				'.sidebar .widget_nav_menu li a').css('border-bottom-color', to);
		});
	});

	wp.customize('sidebar_titles_color', function (value) {
		value.bind(function (to) {
			$('.sidebar .widget-title').css('color', to);
		});
	});

	//
	// Button colors
	//
	wp.customize('site_button_bg_color', function (value) {
		value.bind(function (to) {
			$('.btn,' +
				'.button,' +
				'.comment-reply-link,' +
				'input[type="submit"],' +
				'input[type="reset"],' +
				'button').css('background-color', to);
		});
	});

	wp.customize('site_button_text_color', function (value) {
		value.bind(function (to) {
			$('.btn,' +
				'.button,' +
				'.comment-reply-link,' +
				'input[type="submit"],' +
				'input[type="reset"],' +
				'button').css('color', to);
		});
	});

	wp.customize('site_button_hover_bg_color', function (value) {
		value.bind(function (to) {
			var style = '<style class="site_button_hover_bg_color">' +
				'.btn:hover,' +
				'.button:hover,' +
				'.comment-reply-link:hover,' +
				'input[type="submit"]:hover,' +
				'input[type="reset"]:hover,' +
				'button:hover' +
				'{ background-color: ' + to + ' !important; }</style>';

			var $el = $('.site_button_hover_bg_color');

			if ($el.length) {
				$el.replaceWith(style);
			} else {
				$('head').append(style);
			}
		});
	});

	wp.customize('site_button_hover_text_color', function (value) {
		value.bind(function (to) {
			var style = '<style class="site_button_hover_text_color">' +
				'.btn:hover,' +
				'.button:hover,' +
				'.comment-reply-link:hover,' +
				'input[type="submit"]:hover,' +
				'input[type="reset"]:hover,' +
				'button:hover' +
				'{ color: ' + to + ' !important; }</style>';

			var $el = $('.site_button_hover_bg_color');

			if ($el.length) {
				$el.replaceWith(style);
			} else {
				$('head').append(style);
			}
		});
	});

	wp.customize('site_button_border_color', function (value) {
		value.bind(function (to) {
			$('.btn,' +
				'.button,' +
				'.comment-reply-link,' +
				'input[type="submit"],' +
				'input[type="reset"],' +
				'button')
				.not('.customize-partial-edit-shortcut-button')
				.css('border-color', to);
		});
	});

	//
	// Typography / Content
	//
	wp.customize('content_h1_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h1, .entry-title').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h2_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h2').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h3_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h3').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h4_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h4').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h5_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h5').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h6_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h6').css('font-size', to + 'px');
		});
	});

	wp.customize('content_body_size', function (value) {
		value.bind(function (to) {
			$('.entry-content').css('font-size', to + 'px');
		});
	});

	//
	// Typography / Widgets
	//
	wp.customize('theme_widget_text_size', function (value) {
		value.bind(function (to) {
			$('.sidebar .widget,' +
				'.footer .widget,' +
				'.widget_meta li,' +
				'.widget_pages li,' +
				'.widget_categories li,' +
				'.widget_archive li,' +
				'.widget_nav_menu li,' +
				'.widget_recent_entries li').css('font-size', to + 'px');
		});
	});

	wp.customize('theme_widget_title_size', function (value) {
		value.bind(function (to) {
			$('.widget-title').css('font-size', to + 'px');
		});
	});

	wp.customize('theme_lightbox', function (value) {
		value.bind(function (to) {
			if (to) {
				$(".blockchain-lite-lightbox, a[data-lightbox^='gal']").magnificPopup({
					type: 'image',
					mainClass: 'mfp-with-zoom',
					gallery: {
						enabled: true
					},
					zoom: {
						enabled: true
					}
				});
			} else {
				$(".blockchain-lite-lightbox, a[data-lightbox^='gal']").off('click');
			}
		});
	});


	//
	// Theme global colors
	//
	wp.customize('site_accent_color', function (value) {
		value.bind(function (to) {
			createStyleSheet('site_accent_color', [
				{
					property: 'color',
					value: to,
					selectors: 'a,' +
					'.entry-title a:hover,' +
					'.entry-content blockquote::before,' +
					'.entry-item-read-more .fa,' +
					'.item-testimonial-content::before,' +
					'.text-theme,' +
					'.woocommerce-breadcrumb a:hover,' +
					'.product_meta a,' +
					'.star-rating,' +
					'.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a:hover,' +
					'.woocommerce-MyAccount-downloads .download-file a:hover,' +
					'.woocommerce-Address-title a:hover,' +
					'.widget_layered_nav_filters a:hover::before,' +
					'.widget_layered_nav li.chosen a:hover::before'
				},
				{
					property: 'background-color',
					value: to,
					selectors: '.widget_nav_menu a:hover,' +
					'.widget_nav_menu .current-menu-item > a,' +
					'.item-btn:hover,' +
					'.main .social-icon:hover,' +
					'.footer-widgets .social-icon:hover,' +
					'.onsale,' +
					'.woocommerce-product-gallery__trigger'
				},
				{
					property: 'border-color',
					value: to,
					selectors: '.widget_meta li a:hover,' +
					'.widget_pages li a:hover,' +
					'.widget_categories li a:hover,' +
					'.widget_archive li a:hover,' +
					'.widget_product_categories li a:hover,' +
					'.widget_layered_nav  li a:hover,' +
					'.navigation a:hover,' +
					'.main .social-icon:hover,' +
					'.qty:hover,' +
					'.woocommerce-pagination a:hover,' +
					'input,' +
					'textarea,' +
					'select,' +
					'input:hover,' +
					'textarea:hover,' +
					'select:hover,' +
					'input:focus,' +
					'textarea:focus,' +
					'select:focus,' +
					'.navigation-main > li:hover > a, ' +
					'.navigation-main > li > a:focus, ' +
					'.navigation-main > .current-menu-item > a, ' +
					'.navigation-main > .current-menu-parent > a, ' +
					'.navigation-main > .current-menu-ancestor > a,' +
					'.navigation-main > li > a:hover'
				},
			]);
		});
	});

	wp.customize('site_secondary_accent_color', function (value) {
		value.bind(function (to) {
			createStyleSheet('site_secondary_accent_color', [
				{
					property: 'color',
					value: to,
					selectors: '.entry-title a,' +
					'.entry-meta a,' +
					'.entry-content blockquote,' +
					'.entry-content-intro,' +
					'.entry-item-title a,' +
					'.entry-item-read-more,' +
					'.entry-item-media-title a,' +
					'.item-testimonial-content,' +
					'.navigation a,' +
					'.navigation .page-numbers,' +
					'.widget-title,' +
					'.ci-box-callout-title,' +
					'ul.products > li .woocommerce-loop-product__title,' +
					'.woocommerce-pagination > span,' +
					'.woocommerce-pagination li span,' +
					'ul.cart_list li > a,' +
					'ul.product_list_widget li > a'
				},
				{
					property: 'background-color',
					value: to,
					selectors: '.item-btn,' +
					'table.table-styled thead th,' +
					'.widget_nav_menu a,' +
					'.demo_store,' +
					'.price_slider .ui-slider-handle,' +
					'.navigation-main li li:hover > a,' +
					'.navigation-main li li > a:focus,' +
					'.navigation-main li .current-menu-item > a,' +
					'.navigation-main li .current-menu-parent > a,' +
					'.navigation-main li .current-menu-ancestor > a,' +
					'.navigation-main li .current_page_item > a,' +
					'.navigation-main li .current_page_parent > a,' +
					'.navigation-main li .current_page_ancestor > a'
				},
				{
					property: 'border-color',
					value: to,
					selectors: '.navigation .current,' +
					'.woocommerce-pagination .current'
				},
			]);
		});
	});

	wp.customize('site_text_color', function (value) {
		value.bind(function (to) {
			createStyleSheet('site_text_color', [
				{
					property: 'color',
					value: to,
					selectors: 'body,' +
					'blockquote cite,' +
					'.instagram-pics li a,' +
					'.null-instagram-feed a,' +
					'input,' +
					'textarea,' +
					'select,' +
					'.section-subtitle a,' +
					'.page-links .page-number,' +
					'.main .social-icon,' +
					'.btn-transparent,' +
					'.woocommerce-breadcrumb a,' +
					'ul.products > li .price,' +
					'.entry-summary .price,' +
					'.woocommerce-review-link,' +
					'.qty-handle,' +
					'.qty-handle:hover,' +
					'.reset_variations,' +
					'.wc-tabs a,' +
					'.shop_table .remove,' +
					'.shop_table .product-name a,' +
					'.shop_table .product-subtotal,' +
					'.woocommerce-remove-coupon,' +
					'.select2-container--default .select2-selection-single,' +
					'.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a,' +
					'.woocommerce-MyAccount-downloads .download-file a,' +
					'.woocommerce-Address-title a,' +
					'.widget_layered_nav_filters a,' +
					'.site-logo a, ' +
					'.site-tagline,' +
					'.navigation-main a'
				},
				{
					property: 'border-color',
					value: to,
					selectors: '.navigation a,' +
					'.navigation .page-numbers,' +
					'.page-links .page-number,' +
					'.entry-tags a,' +
					'.tag-cloud-link,'
				},
				{
					property: 'color',
					value: to,
					selectors: 'h1, h2, h3, h4, h5, h6,' +
					'.main .data-item-value'
				}
			]);
		});
	});

	wp.customize('site_grey_backgrounds', function (value) {
		value.bind(function (to) {
			$('.entry-content blockquote,' +
				'.entry-author-box,' +
				'.item-testimonial-content,' +
				'table.table-styled tbody tr:nth-child(even),' +
				'.woocommerce-message,' +
				'.woocommerce-error,' +
				'.woocommerce-info,' +
				'.woocommerce-noreviews,' +
				'.entry-summary .stock,' +
				'.shop_table.cart th,' +
				'.cart-collaterals .shop_table th').css('background-color', to);
		});
	});

	wp.customize('site_border_color', function (value) {
		value.bind(function (to) {
			createStyleSheet('site_border_color', [
				{
					property: 'border-color',
					value: to,
					selectors: 'blockquote,' +
					'.no-comments,' +
					'.sidebar .widget_recent_comments li,' +
					'.sidebar .widget_rss li,' +
					'.sidebar .widget_recent_entries li,' +
					'input,' +
					'textarea' +
					'select,' +
					'.woocommerce-breadcrumb,' +
					'.group_table tr,' +
					'.qty-handle,' +
					'.woocommerce-pagination,' +
					'.wc-tabs,' +
					'.shop_table.cart,' +
					'.shop_table.cart th,' +
					'.shop_table.cart td,' +
					'.cart-collaterals .shop_table,' +
					'.cart-collaterals .shop_table th,' +
					'.cart-collaterals .shop_table td,' +
					'#order_review_heading,' +
					'.payment_methods li,' +
					'.payment_box,' +
					'.select2-container--default .select2-selection--single,' +
					'.woocommerce-thankyou-order-details,' +
					'.wc-bacs-bank-details,' +
					'.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a,' +
					'.woocommerce-EditAccountForm fieldset,' +
					'.wc-form-login,' +
					'.widget_layered_nav_filters a,' +
					'.footer,' +
					'.head-mast:not(.over-background),' +
					'.entry-item-media,' +
					'.navigation,' +
					'.sidebar .social-icon,' +
					'table.table-styled.no-footer,' +
					'.main .widget-title,' +
					'.main .ci-contact-widget-item,' +
					'.main .ci-schedule-widget-table tr,' +
					'.main .ci-box-callout,' +
					'.main .data-item-wrap,' +
					'.main .data-item-list .data-item-row,' +
					'.sidebar .widget_meta li a,' +
					'.sidebar .widget_pages li a,' +
					'.sidebar .widget_categories li a,' +
					'.sidebar .widget_archive li a,' +
					'.sidebar .widget_product_categories li a,' +
					'.sidebar .widget_layered_nav li a'
				},
				{
					property: 'border-bottom-color',
					value: to,
					selectors: '.wc-tabs li.active a,' +
					'.wc-tabs a'
				},
				{
					property: 'background-color',
					value: to,
					selectors: '.price_slider',
				}
			]);
		});
	});

})(jQuery);
