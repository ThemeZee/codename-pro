/**
 * Header Search JS
 *
 * @package Codename Pro
 */

( function( $ ) {

	$( document ).ready( function() {
		var searchToggle = $( '#masthead .header-main .header-search button.header-search-icon' );
		var searchForm = $( '.site .header-search-form' );

		// Add an initial value for the attribute.
		searchToggle.attr( 'aria-expanded', 'false' );

		/* Display Search Form when search icon is clicked */
		searchToggle.on( 'click', function() {
			searchForm.toggleClass( 'active' ).find( '.search-form .search-field' ).focus();
			$( this ).attr( 'aria-expanded', searchForm.hasClass( 'active' ) );
		});

		/* Do not close search form if click is inside header search element */
		$('.site').on('click', '.header-search-form, .header-search', function (e) {
			e.stopPropagation();
		 });

		/* Close search form if click is outside header search element */
		$( document ).click( function() {
			searchForm.removeClass( 'active' );
			searchToggle.attr( 'aria-expanded', searchForm.hasClass( 'active' ) );
		});

		/* Close search form if Escape key is pressed */
		$( document ).keyup(function(e) {
			if ( e.which == 27 ) {
				searchForm.removeClass( 'active' );
				searchToggle.attr( 'aria-expanded', searchForm.hasClass( 'active' ) );
			}
		});
	} );

} )( jQuery );
