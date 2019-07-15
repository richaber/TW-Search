/**
 * twSearch encapsulated functions.
 */
var twSearch = ( function () {

	/**
	 * The jQuery element that had focus when the dialog was opened, else null.
	 *
	 * @type {null}
	 */
	var previouslyFocusedElement = null

	/**
	 * Is the dialog currently open?
	 *
	 * @type {boolean}
	 */
	var dialogOpen = false

	/**
	 * Set the jQuery element that opened the dialog.
	 *
	 * @param newPreviouslyFocusedElement
	 */
	function setPreviouslyFocusedElement ( newPreviouslyFocusedElement = null ) {
		previouslyFocusedElement = newPreviouslyFocusedElement
	}

	/**
	 * Get the jQuery element that opened the dialog, else null.
	 *
	 * @returns {*}
	 */
	function getPreviouslyFocusedElement () {
		return previouslyFocusedElement
	}

	/**
	 * Set dialog open.
	 *
	 * @param newDialogOpen
	 */
	function setDialogOpen ( newDialogOpen = false ) {
		dialogOpen = newDialogOpen
	}

	/**
	 * Get dialog open.
	 *
	 * @returns {boolean}
	 */
	function getDialogOpen () {
		return dialogOpen
	}

	/**
	 * Functions to make available to outside consumers.
	 */
	return {
		/**
		 * Get the dialog open status.
		 *
		 * @returns {boolean}
		 */
		getDialogOpen: function () {
			return getDialogOpen()
		},
		/**
		 * Get the jQuery element that had focus that opened the dialog, else
		 * null.
		 *
		 * @returns {*}
		 */
		getPreviouslyFocusedElement: function () {
			return getPreviouslyFocusedElement()
		},
		/**
		 * Open the dialog.
		 *
		 * @param eventInitiator
		 */
		openDialog: function ( eventInitiator ) {

			setPreviouslyFocusedElement( eventInitiator )

			jQuery( '.twSearchBg' ).show()
			jQuery( '.twSearchFormWrapper' ).animate(
				{ right: 0, easing: 'easein' },
				250,
			)
			jQuery( '.twSearchPopup' ).show()
			jQuery( 'body' ).addClass( 'modal-ready' )

			setDialogOpen( true )

			jQuery( '#twSearchInput' ).focus()
		},
		/**
		 * Close the dialog.
		 */
		closeDialog: function () {
			jQuery( '.twSearchBg' ).hide()
			jQuery( '.twSearchPopup' ).hide()
			jQuery( '.twSearchFormWrapper' ).animate(
				{ right: '-100%' },
				50,
			)

			jQuery( previouslyFocusedElement ).focus()

			setDialogOpen( false )

			setPreviouslyFocusedElement( null )

			jQuery( 'body' ).removeClass( 'modal-ready' )
		},
	}

} )()

/**
 * Shorthand for jQuery( document ).ready().
 */
jQuery( function () {

	/**
	 * When the search initiator link is clicked, open the dialog.
	 */
	jQuery( document ).on( 'click', '.js-twSearch', function ( event ) {
		event.preventDefault()
		twSearch.openDialog( jQuery( this ) )
	} )

	/**
	 * When the escape key is pressed, close the dialog.
	 */
	jQuery( document ).on( 'keydown', function ( event ) {
		// 27 = Escape
		if ( event.keyCode === 27 && true === twSearch.getDialogOpen() ) {
			twSearch.closeDialog()
		}
	} )

	/**
	 * When the close button is pressed, close the dialog.
	 */
	jQuery( document ).on( 'click', 'button.twSearchClose', function ( event ) {
		event.preventDefault()
		twSearch.closeDialog()
	} )
} )
