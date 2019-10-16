/**
 * Header Search JS
 *
 * @package Codename Pro
 */

( function( $ ) {

	$( document ).ready( function() {

		/* Display Search Form when search icon is clicked */
		$( '#masthead .header-main .header-search a.header-search-icon' ).on( 'click', function() {
			$( '#masthead .header-main .header-search .header-search-form' ).toggle().find( '.search-form .search-field' ).focus();
			$( this ).toggleClass( 'active' );
		});

		/* Do not close search form if click is inside header search element */
		$( '#masthead .header-main .header-search' ).click( function(e) {
			e.stopPropagation();
		});

		/* Close search form if click is outside header search element */
		$( document ).click( function() {
			$( '#masthead .header-main .header-search .header-search-form' ).hide();
		});
	} );

} )( jQuery );
