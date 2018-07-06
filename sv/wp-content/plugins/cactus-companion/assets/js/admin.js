(function( $ ) {
	
	// Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.wp-color-picker').wpColorPicker();
    });
	
	// Handle sidebar collapse in preview.
	$( '.cactus-template-preview' ).on(
		'click', '.collapse-sidebar', function () {
			event.preventDefault();
			var overlay = $( '.cactus-template-preview' );
			if ( overlay.hasClass( 'expanded' ) ) {
				overlay.removeClass( 'expanded' );
				overlay.addClass( 'collapsed' );
				return false;
			}

			if ( overlay.hasClass( 'collapsed' ) ) {
				overlay.removeClass( 'collapsed' );
				overlay.addClass( 'expanded' );
				return false;
			}
		}
	);

	// Handle responsive buttons.
	$( '.cactus-responsive-preview' ).on(
		'click', 'button', function () {
			$( '.cactus-template-preview' ).removeClass( 'preview-mobile preview-tablet preview-desktop' );
			var deviceClass = 'preview-' + $( this ).data( 'device' );
			$( '.cactus-responsive-preview button' ).each(
				function () {
					$( this ).attr( 'aria-pressed', 'false' );
					$( this ).removeClass( 'active' );
				}
			);

			$( '.cactus-responsive-preview' ).removeClass( $( this ).attr( 'class' ).split( ' ' ).pop() );
			$( '.cactus-template-preview' ).addClass( deviceClass );
			$( this ).addClass( 'active' );
		}
	);

	// Hide preview.
	$( '.close-full-overlay' ).on(
		'click', function () {
			$( '.cactus-template-preview .cactus-theme-info.active' ).removeClass( 'active' );
			$( '.cactus-template-preview' ).hide();
			$( '.cactus-template-frame' ).attr( 'src', '' );
			$('body.cactus-companion_page_cactus-template').css({'overflow-y':'auto'});
		}
	);
			
	// Open preview routine.
	$( '.cactus-preview-template' ).on(
		'click', function () {
			var templateSlug = $( this ).data( 'template-slug' );
			var previewUrl = $( this ).data( 'demo-url' );
			$( '.cactus-template-frame' ).attr( 'src', previewUrl );
			$( '.cactus-theme-info.' + templateSlug ).addClass( 'active' );
			setupImportButton();
			$( '.cactus-template-preview' ).fadeIn();
			$('body.cactus-companion_page_cactus-template').css({'overflow-y':'hidden'});
		}
	);
	
	$( '.cactus-next-prev .next-theme' ).on(
				'click', function () {
					var active = $( '.cactus-theme-info.active' ).removeClass( 'active' );
					if ( active.next() && active.next().length ) {
						active.next().addClass( 'active' );
					} else {
						active.siblings( ':first' ).addClass( 'active' );
					}
					changePreviewSource();
					setupImportButton();
				}
			);
			$( '.cactus-next-prev .previous-theme' ).on(
				'click', function () {
					var active = $( '.cactus-theme-info.active' ).removeClass( 'active' );
					if ( active.prev() && active.prev().length ) {
						active.prev().addClass( 'active' );
					} else {
						active.siblings( ':last' ).addClass( 'active' );
					}
					changePreviewSource();
					setupImportButton();
				}
			);

			// Change preview source.
			function changePreviewSource() {
				var previewUrl = $( '.cactus-theme-info.active' ).data( 'demo-url' );
				$( '.cactus-template-frame' ).attr( 'src', previewUrl );
			}
	
	function setupImportButton() {
		var installable = $( '.active .cactus-installable' );
		if ( installable.length > 0 ) {
			$( '.wp-full-overlay-header .cactus-import-template' ).text( cactus_companion_admin.i18n.t1 );
		} else {
			$( '.wp-full-overlay-header .cactus-import-template' ).text( cactus_companion_admin.i18n.t2 );
		}
		var activeTheme = $( '.cactus-theme-info.active' );
		var button = $( '.wp-full-overlay-header .cactus-import-template' );
		$( button ).attr( 'data-template-file', $( activeTheme ).data( 'template-file' ) );
		$( button ).attr( 'data-template-title', $( activeTheme ).data( 'template-title' ) );
		$( button ).attr( 'data-template-slug', $( activeTheme ).data( 'template-slug' ) );
	}
	
	
	// Handle import click.
	$( '.wp-full-overlay-header' ).on(
		'click', '.cactus-import-template', function () {
			$( this ).addClass( 'cactus-import-queue updating-message cactus-updating' ).html( '' );
			$( '.cactus-template-preview .close-full-overlay, .cactus-next-prev' ).remove();
			var template_url = $( this ).data( 'template-file' );
			var template_name = $( this ).data( 'template-title' );
			var template_slug = $( this ).data( 'template-slug' );
			
			if ( $( '.active .cactus-installable' ).length || $( '.active .cactus-activate' ).length ) {

				checkAndInstallPlugins();
			} else {
				$.ajax(
					{
						url: cactus_companion_admin.ajaxurl,
						beforeSend: function ( xhr ) {
							$( '.cactus-import-queue' ).addClass( 'cactus-updating' ).html( '' );
							xhr.setRequestHeader( 'X-WP-Nonce', cactus_companion_admin.nonce );
						},
						// async: false,
						data: {
							template_url: template_url,
							template_name: template_name,
							template_slug: template_slug,
							action: 'cactus_import_elementor'
						},
						type: 'POST',
						success: function ( data ) {
							$( '.cactus-updating' ).replaceWith( '<span class="cactus-done-import"><i class="dashicons-yes dashicons"></i></span>' );
							var obj = $.parseJSON( data );
							location.href = obj.redirect_url;
						},
						error: function ( error ) {
							console.error( error );
						},
						complete: function() {
							$( '.cactus-updating' ).replaceWith( '<span class="cactus-done-import"><i class="dashicons-yes dashicons"></i></span>' );
						}
					}, 'json'
				);
			}
		}
	);

	function checkAndInstallPlugins() {
		var installable = $( '.active .cactus-installable' );
		var toActivate = $( '.active .cactus-activate' );
		if ( installable.length || toActivate.length ) {

			$( installable ).each(
				function () {
					var plugin = $( this );
					$( plugin ).removeClass( 'cactus-installable' ).addClass( 'cactus-installing' );
					$( plugin ).find( 'span.dashicons' ).replaceWith( '<span class="dashicons dashicons-update" style="-webkit-animation: rotation 2s infinite linear; animation: rotation 2s infinite linear; color: #ffb227 "></span>' );
					var slug = $( this ).find( '.cactus-install-plugin' ).attr( 'data-slug' );
					wp.updates.installPlugin(
						{
							slug: slug,
							success: function ( response ) {
								activatePlugin( response.activateUrl, plugin );
							}
						}
					);
				}
			);

			$( toActivate ).each(
				function () {
						var plugin = $( this );
						var activateUrl = $( plugin ).find( '.activate-now' ).attr( 'href' );
					if (typeof activateUrl !== 'undefined') {
						activatePlugin( activateUrl, plugin );
					}
				}
			);
		}
	}

	function activatePlugin( activationUrl, plugin ) {
		$.ajax(
			{
				type: 'GET',
				url: activationUrl,
				beforeSend: function() {
					$( plugin ).removeClass( 'cactus-activate' ).addClass( 'cactus-installing' );
					$( plugin ).find( 'span.dashicons' ).replaceWith( '<span class="dashicons dashicons-update" style="-webkit-animation: rotation 2s infinite linear; animation: rotation 2s infinite linear; color: #ffb227 "></span>' );
				},
				success: function () {
					$( plugin ).find( '.dashicons' ).replaceWith( '<span class="dashicons dashicons-yes" style="color: #34a85e"></span>' );
					$( plugin ).removeClass( 'cactus-installing' );
				},
				complete: function() {
					if ( $( '.active .cactus-installing' ).length === 0 ) {
						$( '.cactus-import-queue' ).trigger( 'click' );
					}
				}
			}
		);
	}
     
})( jQuery );