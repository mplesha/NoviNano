/**
 * Customizer Controls enhancements for a better user experience.
 */

// https://make.xwp.co/2016/07/24/dependently-contextual-customizer-controls/
// https://gist.github.com/westonruter/2c1e87e381ca0c9a3dcb1e3a61a9eb4d
( function( api ) {
	'use strict';

	// Add callback for when the header_layout setting exists.
	api( 'header_layout', function( setting ) {
		let isLayoutFull, linkSettingValueToControlActiveState;

		// Determine whether the dependent control should be displayed.
		isLayoutFull = function() {
			return 'full' === setting.get();
		};

		linkSettingValueToControlActiveState = function( control ) {
			let setActiveState = function() {
				control.active.set( isLayoutFull() );
			};

			control.active.validate = isLayoutFull;

			setActiveState();

			setting.bind( setActiveState );
		};

		api.control( 'header_logo_alignment', linkSettingValueToControlActiveState );
	} );

}( wp.customize ) );
