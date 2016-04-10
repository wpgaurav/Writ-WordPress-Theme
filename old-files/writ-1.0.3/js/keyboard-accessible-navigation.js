/**
 * Makes the main navigation keyboard accessible.
 */

jQuery( document ).ready( function( $ ) {
	$( '.main-navigation' ).find( 'a' ).on( 'focus.bosco blur.writ', function() {
		$( this ).parents().toggleClass( 'focus' );
	} );
} );
