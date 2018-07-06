<?php
	/**
	 * Generates CSS based on standard customizer settings.
	 *
	 * @return string
	 */
	function blockchain_lite_get_customizer_css() {
		ob_start();

		//
		// Logo
		//
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( get_theme_mod( 'limit_logo_size' ) && ! empty( $custom_logo_id ) ) {
			$image_metadata = wp_get_attachment_metadata( $custom_logo_id );
			$max_width      = floor( $image_metadata['width'] / 2 );
			?>
			.header img.custom-logo {
				width: <?php echo intval( $max_width ); ?>px;
				max-width: 100%;
			}
			<?php
		}


		if ( apply_filters( 'blockchain_lite_customizable_header', true ) ) {
			//
			// Header Top Menu Bar
			//
			$header_top_bar_padding = get_theme_mod( 'header_top_bar_padding' );

			if ( ! empty( $header_top_bar_padding ) ) {
				?>
				.head-intro {
					padding-top: <?php echo intval( $header_top_bar_padding ); ?>px;
					padding-bottom: <?php echo intval( $header_top_bar_padding ); ?>px;
				}
				<?php
			}

			$header_top_bar_text_size = get_theme_mod( 'header_top_bar_text_size' );

			if ( ! empty( $header_top_bar_text_size ) ) {
				?>
				.head-intro {
					font-size: <?php echo intval( $header_top_bar_text_size ); ?>px;
				}
				<?php
			}

			$header_top_bar_text_color = get_theme_mod( 'header_top_bar_text_color' );

			if ( ! empty( $header_top_bar_text_color ) ) {
				?>
				.head-intro {
					color: <?php echo sanitize_hex_color( $header_top_bar_text_color ); ?>;
				}
				<?php
			}

			$header_top_bar_bg_color = get_theme_mod( 'header_top_bar_bg_color' );

			if ( ! empty( $header_top_bar_bg_color ) ) {
				?>
				.head-intro {
					background-color: <?php echo sanitize_hex_color( $header_top_bar_bg_color ); ?>;
				}
				<?php
			}

			//
			// Header Main Menu Bar
			//
			$header_primary_menu_padding = get_theme_mod( 'header_primary_menu_padding' );

			if ( ! empty( $header_primary_menu_padding ) ) {
				?>
				.head-mast {
					padding-top: <?php echo intval( $header_primary_menu_padding ); ?>px;
					padding-bottom: <?php echo intval( $header_primary_menu_padding ); ?>px;
				}
				<?php
			}

			$header_primary_menu_text_size = get_theme_mod( 'header_primary_menu_text_size' );

			if ( ! empty( $header_primary_menu_text_size ) ) {
				?>
				.navigation-main > li > a {
					font-size: <?php echo intval( $header_primary_menu_text_size ); ?>px;
				}
				<?php
			}
		} // filter blockchain_lite_customizable_header


		if ( apply_filters( 'blockchain_lite_customizable_footer', true ) ) {
			//
			// Footer Colors
			//
			$footer_bg_color = get_theme_mod( 'footer_bg_color' );

			if ( ! empty( $footer_bg_color ) ) {
				?>
				.footer-widgets {
					background-color: <?php echo sanitize_hex_color( $footer_bg_color ); ?>;
				}
				<?php
			}

			$footer_text_color = get_theme_mod( 'footer_text_color' );

			if ( ! empty( $footer_text_color ) ) {
				?>
				.footer-widgets,
				.footer-widgets .widget,
				.footer-widgets .widget-title,
				.footer h1,
				.footer h2,
				.footer h3,
				.footer h4,
				.footer h5,
				.footer h6,
				.footer-widgets .ci-contact-widget-item i {
					color: <?php echo sanitize_hex_color( $footer_text_color ); ?>;
				}
				<?php
			}

			$footer_element_backgrounds = get_theme_mod( 'footer_element_backgrounds' );

			if ( ! empty( $footer_element_backgrounds ) ) {
				?>
				.footer .item-btn,
				.footer-widgets .social-icon,
				.footer .ci-box-callout,
				.footer .widget_nav_menu a {
					background-color: <?php echo sanitize_hex_color( $footer_element_backgrounds ); ?>;
				}

				.footer .ci-schedule-widget-table tr {
					border-color <?php echo sanitize_hex_color( $footer_element_backgrounds ); ?>;
				}
				<?php
			}

			$footer_border_color = get_theme_mod( 'footer_border_color' );

			if ( ! empty( $footer_border_color ) ) {
				?>
				.footer .ci-contact-widget-item i,
				.footer .data-item-eyebrow {
					color: <?php echo sanitize_hex_color( $footer_border_color ); ?>;
				}

				.footer-info,
				.footer .entry-item-media-title a,
				.footer .widget-title,
				.footer .ci-contact-widget-item,
				.footer .data-item-wrap,
				.footer .data-item-row,
				.footer .widget_meta li a,
				.footer .widget_pages li a,
				.footer .widget_categories li a,
				.footer .widget_archive li a,
				.footer .widget_product_categories li a,
				.footer .widget_layered_nav li a,
				.footer .widget_recent_comments li,
				.footer .widget_rss li,
				.footer .widget_recent_entries li {
					border-color: <?php echo sanitize_hex_color( $footer_border_color ); ?>;
				}
				<?php
			}

			$footer_bottom_bg_color = get_theme_mod( 'footer_bottom_bg_color' );

			if ( ! empty( $footer_bottom_bg_color ) ) {
				?>
				.footer-info {
					background-color: <?php echo sanitize_hex_color( $footer_bottom_bg_color ); ?>;
				}
				<?php
			}

			$footer_bottom_text_color = get_theme_mod( 'footer_bottom_text_color' );

			if ( ! empty( $footer_bottom_text_color ) ) {
				?>
				.footer-info {
					color: <?php echo sanitize_hex_color( $footer_bottom_text_color ); ?>;
				}
				<?php
			}

			$footer_bottom_link_color = get_theme_mod( 'footer_bottom_link_color' );

			if ( ! empty( $footer_bottom_link_color ) ) {
				?>
				.footer-info a,
				.footer-info a:hover {
					color: <?php echo sanitize_hex_color( $footer_bottom_link_color ); ?>;
				}
				<?php
			}

			$footer_titles_color = get_theme_mod( 'footer_titles_color' );

			if ( ! empty( $footer_titles_color ) ) {
				?>
				.footer .widget-title,
				.footer h1,
				.footer h2,
				.footer h3,
				.footer h4,
				.footer h5,
				.footer h6 {
					color: <?php echo sanitize_hex_color( $footer_titles_color ); ?>;
				}
				<?php
			}
		} // filter blockchain_lite_customizable_footer


		//
		// Sidebar Colors
		//
		$sidebar_bg_color = get_theme_mod( 'sidebar_bg_color' );

		if ( ! empty( $sidebar_bg_color ) ) {
			?>
			.sidebar {
				background-color: <?php echo sanitize_hex_color( $sidebar_bg_color ); ?>;
				padding: 20px;
			}
			<?php
		}

		$sidebar_text_color = get_theme_mod( 'sidebar_text_color' );

		if ( ! empty( $sidebar_text_color ) ) {
			?>
			.sidebar,
			.sidebar .widget,
			.sidebar .ci-contact-widget-item i,
			.sidebar .data-item-value {
				color: <?php echo sanitize_hex_color( $sidebar_text_color ); ?>;
			}
			<?php
		}

		$sidebar_link_color = get_theme_mod( 'sidebar_link_color' );

		if ( ! empty( $sidebar_link_color ) ) {
			?>
			.sidebar a:not(.item-btn),
			.sidebar .widget a:not(.item-btn) {
				color: <?php echo sanitize_hex_color( $sidebar_link_color ); ?>;
			}
			<?php
		}

		$sidebar_link_hover_color = get_theme_mod( 'sidebar_link_hover_color' );

		if ( ! empty( $sidebar_link_hover_color ) ) {
			?>
			.sidebar a:hover,
			.sidebar .widget a:hover {
				color: <?php echo sanitize_hex_color( $sidebar_link_hover_color ); ?>;
			}
			<?php
		}

		$sidebar_border_color = get_theme_mod( 'sidebar_border_color' );

		if ( ! empty( $sidebar_border_color ) ) {
			?>
			.sidebar select,
			.sidebar input,
			.sidebar textarea,
			.sidebar .widget-title,
			.sidebar .data-item-wrap,
			.sidebar .data-item-list .data-item-row,
			.sidebar .social-icon {
				border-color: <?php echo sanitize_hex_color( $sidebar_border_color ); ?>;
			}

			.sidebar .widget_recent_comments li,
			.sidebar .widget_recent_entries li,
			.sidebar .widget_rss li,
			.sidebar .widget_meta li a,
			.sidebar .widget_pages li a,
			.sidebar .widget_categories li a,
			.sidebar .widget_archive li a,
			.sidebar .widget_nav_menu li a {
				border-bottom-color: <?php echo sanitize_hex_color( $sidebar_border_color ); ?>;
			}
			<?php
		}

		$sidebar_titles_color = get_theme_mod( 'sidebar_titles_color' );

		if ( ! empty( $sidebar_titles_color ) ) {
			?>
			.sidebar .widget-title {
				color: <?php echo sanitize_hex_color( $sidebar_titles_color ); ?>;
			}
			<?php
		}

		//
		// Button colors
		//
		$site_button_bg_color = get_theme_mod( 'site_button_bg_color' );

		if ( ! empty( $site_button_bg_color ) ) {
			?>
			.btn,
			.button,
			.comment-reply-link,
			input[type="submit"],
			input[type="reset"],
			button,
			.item-filter {
				background-color: <?php echo sanitize_hex_color( $site_button_bg_color ); ?>;
			}
			<?php
		}

		$site_button_text_color = get_theme_mod( 'site_button_text_color' );

		if ( ! empty( $site_button_text_color ) ) {
			?>
			.btn,
			.button,
			.comment-reply-link,
			input[type="submit"],
			input[type="reset"],
			button,
			.item-filter {
				color: <?php echo sanitize_hex_color( $site_button_text_color ); ?>;
			}
			<?php
		}

		$site_button_hover_bg_color = get_theme_mod( 'site_button_hover_bg_color' );

		if ( ! empty( $site_button_hover_bg_color ) ) {
			?>
			.btn:hover,
			.button:hover,
			.comment-reply-link:hover,
			input[type="submit"]:hover,
			input[type="reset"]:hover,
			button:hover,
			.item-filter:hovre,
			.filter-active {
				background-color: <?php echo sanitize_hex_color( $site_button_hover_bg_color ); ?>;
			}
			<?php
		}

		$site_button_hover_text_color = get_theme_mod( 'site_button_hover_text_color' );

		if ( ! empty( $site_button_hover_text_color ) ) {
			?>
			.btn:hover,
			.button:hover,
			.comment-reply-link:hover,
			input[type="submit"]:hover,
			input[type="reset"]:hover,
			button:hover,
			.item-filter:hover,
			.filter-active {
				color: <?php echo sanitize_hex_color( $site_button_hover_text_color ); ?>;
			}
			<?php
		}

		$site_button_border_color = get_theme_mod( 'site_button_border_color' );

		if ( ! empty( $site_button_border_color ) ) {
			?>
			.btn,
			.button,
			.comment-reply-link,
			input[type="submit"],
			input[type="reset"],
			button,
			.item-filter {
				border-color: <?php echo sanitize_hex_color( $site_button_border_color ); ?>;
			}
			<?php
		}

		//
		// Typography / Content
		//
		if ( get_theme_mod( 'content_h1_size' ) ) {
			?>
			.entry-content h1,
			.entry-title {
				font-size: <?php echo intval( get_theme_mod( 'content_h1_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h2_size' ) ) {
			?>
			.entry-content h2 {
				font-size: <?php echo intval( get_theme_mod( 'content_h2_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h3_size' ) ) {
			?>
			.entry-content h3 {
				font-size: <?php echo intval( get_theme_mod( 'content_h3_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h4_size' ) ) {
			?>
			.entry-content h4 {
				font-size: <?php echo intval( get_theme_mod( 'content_h4_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h5_size' ) ) {
			?>
			.entry-content h5 {
				font-size: <?php echo intval( get_theme_mod( 'content_h5_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h6_size' ) ) {
			?>
			.entry-content h6 {
				font-size: <?php echo intval( get_theme_mod( 'content_h6_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_body_size' ) ) {
			?>
			.entry-content {
				font-size: <?php echo intval( get_theme_mod( 'content_body_size' ) ); ?>px;
			}
			<?php
		}

		//
		// Typography / Widgets
		//
		if ( get_theme_mod( 'theme_widget_text_size' ) ) {
			?>
			.sidebar .widget,
			.footer .widget,
			.widget_meta li,
			.widget_pages li,
			.widget_categories li,
			.widget_archive li,
			.widget_nav_menu li,
			.widget_recent_entries li {
				font-size: <?php echo intval( get_theme_mod( 'theme_widget_text_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'theme_widget_title_size' ) ) {
			?>
			.widget-title {
				font-size: <?php echo intval( get_theme_mod( 'theme_widget_title_size' ) ); ?>px;
			}
			<?php
		}


		//
		// Global Colors
		//
		$site_accent_color = get_theme_mod( 'site_accent_color' );

		if ( ! empty( $site_accent_color ) ) {
			?>
			a,
			.entry-title a:hover,
			.entry-content blockquote::before,
			.entry-item-read-more .fa,
			.item-testimonial-content::before,
			.text-theme,
			.woocommerce-breadcrumb a:hover,
			.product_meta a,
			.star-rating,
			.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a:hover,
			.woocommerce-MyAccount-downloads .download-file a:hover,
			.woocommerce-Address-title a:hover,
			.widget_layered_nav_filters a:hover::before,
			.widget_layered_nav li.chosen a:hover::before {
				color: <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			a:hover {
				color: <?php echo sanitize_hex_color( blockchain_lite_color_luminance( $site_accent_color, .1 ) ); ?>;
			}

			a:focus {
				outline: 1px dotted <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			.widget_meta li a:hover,
			.widget_pages li a:hover,
			.widget_categories li a:hover,
			.widget_archive li a:hover,
			.widget_product_categories li a:hover,
			.widget_layered_nav  li a:hover,
			.navigation a:hover,
			.main .social-icon:hover,
			.qty:hover,
			.woocommerce-pagination a:hover,
			.navigation-main > li:hover > a,
			.navigation-main > li > a:focus,
			.navigation-main > .current-menu-item > a,
			.navigation-main > .current-menu-parent > a,
			.navigation-main > .current-menu-ancestor > a,
			.navigation-main > .current_page_item > a,
			.navigation-main > .current_page_parent > a,
			.navigation-main > .current_page_ancestor > a {
				border-color: <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			.widget_nav_menu a:hover,
			.widget_nav_menu .current-menu-item > a,
			.item-btn:hover,
			.main .social-icon:hover,
			.footer-widgets .social-icon:hover,
			.onsale,
			.woocommerce-product-gallery__trigger {
				background-color: <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			input,
			textarea,
			select,
			input:hover,
			textarea:hover,
			select:hover,
			input:focus,
			textarea:focus,
			select:focus,
			.blockchain-lite-slick-slider .slick-dots .slick-active button {
				border-color: <?php echo sanitize_hex_color( $site_accent_color ); ?>;
				box-shadow: 0 2px 0 <?php echo sanitize_hex_color( blockchain_lite_hex2rgba( $site_accent_color, .2 ) ); ?>;
			}
			<?php
		}

		$site_secondary_accent_color = get_theme_mod( 'site_secondary_accent_color' );

		if ( ! empty( $site_secondary_accent_color ) ) {
			?>
			.entry-title a,
			.entry-meta a,
			.entry-content blockquote,
			.entry-content-intro,
			.entry-item-title a,
			.entry-item-read-more,
			.entry-item-media-title a,
			.item-testimonial-content,
			.navigation a,
			.navigation .page-numbers,
			.widget-title,
			.ci-box-callout-title,
			ul.products > li .woocommerce-loop-product__title,
			.woocommerce-pagination > span,
			.woocommerce-pagination li span,
			ul.cart_list li > a,
			ul.product_list_widget li > a {
				color: <?php echo sanitize_hex_color( $site_secondary_accent_color ); ?>;
			}

			.item-btn,
			table.table-styled thead th,
			.widget_nav_menu a,
			.demo_store,
			.price_slider .ui-slider-handle,
			.navigation-main li li:hover > a,
			.navigation-main li li > a:focus,
			.navigation-main li .current-menu-item > a,
			.navigation-main li .current-menu-parent > a,
			.navigation-main li .current-menu-ancestor > a,
			.navigation-main li .current_page_item > a,
			.navigation-main li .current_page_parent > a,
			.navigation-main li .current_page_ancestor > a {
				background-color: <?php echo sanitize_hex_color( $site_secondary_accent_color ); ?>;
			}

			.navigation .current,
			.woocommerce-pagination .current {
				border-color: <?php echo sanitize_hex_color( $site_secondary_accent_color ); ?>;
			}
			<?php
		}

		$site_text_color = get_theme_mod( 'site_text_color' );

		if ( ! empty( $site_text_color ) ) {
			$site_text_color_dark = blockchain_lite_color_luminance( $site_text_color, -0.5 );
			?>
			body,
			blockquote cite,
			.instagram-pics li a,
			.null-instagram-feed a,
			input,
			textarea,
			select,
			.section-subtitle a,
			.page-links .page-number,
			.main .social-icon,
			.btn-transparent,
			.woocommerce-breadcrumb a,
			ul.products > li .price,
			.entry-summary .price,
			.woocommerce-review-link,
			.qty-handle,
			.qty-handle:hover,
			.reset_variations,
			.wc-tabs a,
			.shop_table .remove,
			.shop_table .product-name a,
			.shop_table .product-subtotal,
			.woocommerce-remove-coupon,
			.select2-container--default .select2-selection-single,
			.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a,
			.woocommerce-MyAccount-downloads .download-file a,
			.woocommerce-Address-title a,
			.widget_layered_nav_filters a,
			.site-logo a,
			.site-tagline,
			.navigation-main a {
				color: <?php echo sanitize_hex_color( $site_text_color ); ?>;
			}

			.navigation a,
			.navigation .page-numbers,
			.page-links .page-number,
			.entry-tags a,
			.tag-cloud-link,
			.sidebar .widget_meta li a,
			.sidebar .widget_pages li a,
			.sidebar .widget_categories li a,
			.sidebar .widget_archive li a,
			.sidebar .widget_product_categories li a,
			.sidebar .widget_layered_nav li a,
			.navigation-main .nav-button > a {
				border-color: <?php echo sanitize_hex_color( $site_text_color_dark ); ?>;
			}

			h1, h2, h3, h4, h5, h6,
			.main .data-item-value {
				color: <?php echo sanitize_hex_color( $site_text_color_dark ); ?>;
			}
			<?php
		}

		$site_grey_backgrounds = get_theme_mod( 'site_grey_backgrounds' );

		if ( ! empty( $site_grey_backgrounds ) ) {
			?>
			.entry-content blockquote,
			.entry-author-box,
			.item-testimonial-content,
			table.table-styled tbody tr:nth-child(even),
			.woocommerce-message,
			.woocommerce-error,
			.woocommerce-info,
			.woocommerce-noreviews,
			.entry-summary .stock,
			.shop_table.cart th,
			.cart-collaterals .shop_table th {
				background-color: <?php echo sanitize_hex_color( $site_grey_backgrounds ); ?>;
			}
			<?php
		}

		$site_border_color = get_theme_mod( 'site_border_color' );

		if ( ! empty( $site_border_color ) ) {
			?>
			blockquote,
			.no-comments,
			.sidebar .widget_recent_comments li,
			.sidebar .widget_rss li,
			.sidebar .widget_recent_entries li,
			input,
			textarea
			select,
			.woocommerce-breadcrumb,
			.group_table tr,
			.qty-handle,
			.woocommerce-pagination,
			.wc-tabs,
			.shop_table.cart,
			.shop_table.cart th,
			.shop_table.cart td,
			.cart-collaterals .shop_table,
			.cart-collaterals .shop_table th,
			.cart-collaterals .shop_table td,
			#order_review_heading,
			.payment_methods li,
			.payment_box,
			.select2-container--default .select2-selection--single,
			.woocommerce-thankyou-order-details,
			.wc-bacs-bank-details,
			.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a,
			.woocommerce-EditAccountForm fieldset,
			.wc-form-login,
			.widget_layered_nav_filters a,
			.footer,
			.head-mast:not(.over-background),
			.entry-item-media,
			.navigation,
			.sidebar .social-icon,
			table.table-styled.no-footer,
			.main .widget-title,
			.main .ci-contact-widget-item,
			.main .ci-schedule-widget-table tr,
			.main .ci-box-callout,
			.main .data-item-wrap,
			.main .data-item-list .data-item-row,
			.sidebar .widget_meta li a,
			.sidebar .widget_pages li a,
			.sidebar .widget_categories li a,
			.sidebar .widget_archive li a,
			.sidebar .widget_product_categories li a,
			.sidebar .widget_layered_nav li a {
				border-color: <?php echo sanitize_hex_color( $site_border_color ); ?>;
			}

			.wc-tabs li.active a,
			.wc-tabs a {
				border-bottom-color: <?php echo sanitize_hex_color( $site_border_color ); ?>;
			}

			.price_slider {
				background-color: <?php echo sanitize_hex_color( $site_border_color ); ?>;
			}
			<?php
		}

		$css = ob_get_clean();
		return apply_filters( 'blockchain_lite_customizer_css', $css );
	}

	function blockchain_lite_get_hero_styles() {
		$hero  = blockchain_lite_get_hero_data();
		$style = '';

		if ( ! $hero['show'] ) {
			return apply_filters( 'blockchain_lite_hero_styles', $style, $hero );
		}

		$styles_selector  = '.page-hero';
		$overlay_selector = '.page-hero::before';

		$support = get_theme_support( 'blockchain-lite-hero' );
		$support = $support[0];
		if ( is_page_template( 'templates/builder.php' ) && true === $support['required'] ) {
			$styles_selector  = '.header';
			$overlay_selector = '.header::before';
		}

		$styles_selector  = apply_filters( 'blockchain_lite_hero_styles_selector', $styles_selector );
		$overlay_selector = apply_filters( 'blockchain_lite_hero_styles_overlay_selector', $overlay_selector );

		if ( $hero['overlay_color'] ) {
			$style .= $overlay_selector . ' { ';
			$style .= sprintf( 'background-color: %s; ',
				$hero['overlay_color']
			);
			$style .= '} ' . PHP_EOL;
		}

		if ( $hero['bg_color'] || $hero['image'] || $hero['text_color'] ) {
			$style .= $styles_selector . ' { ';

			if ( $hero['bg_color'] ) {
				$style .= sprintf( 'background-color: %s; ',
					$hero['bg_color']
				);
			}

			if ( $hero['text_color'] ) {
				$style .= sprintf( 'color: %s; ',
					$hero['text_color']
				);
			}

			if ( $hero['image'] ) {
				$style .= sprintf( 'background-image: url(%s); ',
					$hero['image']
				);

				if ( $hero['image_repeat'] ) {
					$style .= sprintf( 'background-repeat: %s; ',
						$hero['image_repeat']
					);
				}

				if ( $hero['image_position_x'] && $hero['image_position_y'] ) {
					$style .= sprintf( 'background-position: %s %s; ',
						$hero['image_position_x'],
						$hero['image_position_y']
					);
				}

				if ( $hero['image_attachment'] ) {
					$style .= sprintf( 'background-attachment: %s; ',
						$hero['image_attachment']
					);
				}

				if ( ! $hero['image_cover'] ) {
					$style .= 'background-size: auto; ';
				}
			}

			$style .= '}';
		}

		return apply_filters( 'blockchain_lite_hero_styles', $style, $hero );
	}

	if ( ! function_exists( 'blockchain_lite_get_all_customizer_css' ) ) :
		function blockchain_lite_get_all_customizer_css() {
			$styles = array(
				'customizer' => blockchain_lite_get_customizer_css(),
				'hero'       => blockchain_lite_get_hero_styles(),
			);

			$styles = apply_filters( 'blockchain_lite_all_customizer_css', $styles );

			return implode( PHP_EOL, $styles );
		}
	endif;
