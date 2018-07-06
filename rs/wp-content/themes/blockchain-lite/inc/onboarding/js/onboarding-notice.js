jQuery( document ).ready( function( $ ) {
	$( '.blockchain-lite-onboarding-notice' ).on( 'click', '.notice-dismiss', function( e ) {
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'blockchain_lite_dismiss_onboarding',
				nonce: blockchain_lite_Onboarding.dismiss_nonce,
				dismissed: true
			},
			dataType: 'text',
			success: function( response ) {
				// console.log( response );
			}
		} );
	});
} );
