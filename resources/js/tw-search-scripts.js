/**
 * Ported from W3C examples for better accessibility than previous iterations.
 *
 * Prefixed/Pseudo-Namespaced to prevent collisions with any other libraries that may implement the same.
 *
 * @link https://www.w3.org/TR/wai-aria-practices/examples/dialog-modal/dialog.html
 *
 * This content is licensed according to the W3C Software License at
 * @link https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 */

/**
 * @namespace twSearchAria
 */
var twSearchAria = twSearchAria || {};

/**
 * @desc
 *  Key code constants
 */
twSearchAria.KeyCode = {
	BACKSPACE: 8,
	TAB: 9,
	RETURN: 13,
	ESC: 27,
	SPACE: 32,
	PAGE_UP: 33,
	PAGE_DOWN: 34,
	END: 35,
	HOME: 36,
	LEFT: 37,
	UP: 38,
	RIGHT: 39,
	DOWN: 40,
	DELETE: 46
};

twSearchAria.Utils = twSearchAria.Utils || {};

// Polyfill src https://developer.mozilla.org/en-US/docs/Web/API/Element/matches#Polyfill
twSearchAria.Utils.matches = function (element, selector) {
	if (!Element.prototype.matches) {
		Element.prototype.matches =
			Element.prototype.matchesSelector ||
			Element.prototype.mozMatchesSelector ||
			Element.prototype.msMatchesSelector ||
			Element.prototype.oMatchesSelector ||
			Element.prototype.webkitMatchesSelector ||
			function (s) {
				var matches = element.parentNode.querySelectorAll(s);
				var i = matches.length;
				while (--i >= 0 && matches.item(i) !== this) {}
				return i > -1;
			};
	}

	return element.matches(selector);
};

twSearchAria.Utils.remove = function (item) {
	if (item.remove && typeof item.remove === 'function') {
		return item.remove();
	}
	if (item.parentNode &&
		item.parentNode.removeChild &&
		typeof item.parentNode.removeChild === 'function') {
		return item.parentNode.removeChild(item);
	}
	return false;
};

twSearchAria.Utils.isFocusable = function (element) {
	if (element.tabIndex > 0 || (element.tabIndex === 0 && element.getAttribute('tabIndex') !== null)) {
		return true;
	}

	if (element.disabled) {
		return false;
	}

	switch (element.nodeName) {
		case 'A':
			return !!element.href && element.rel != 'ignore';
		case 'INPUT':
			return element.type != 'hidden' && element.type != 'file';
		case 'BUTTON':
		case 'SELECT':
		case 'TEXTAREA':
			return true;
		default:
			return false;
	}
};

twSearchAria.Utils.getAncestorBySelector = function (element, selector) {
	if (!twSearchAria.Utils.matches(element, selector + ' ' + element.tagName)) {
		// Element is not inside an element that matches selector
		return null;
	}

	// Move up the DOM tree until a parent matching the selector is found
	var currentNode = element;
	var ancestor = null;
	while (ancestor === null) {
		if (twSearchAria.Utils.matches(currentNode.parentNode, selector)) {
			ancestor = currentNode.parentNode;
		}
		else {
			currentNode = currentNode.parentNode;
		}
	}

	return ancestor;
};

twSearchAria.Utils.hasClass = function (element, className) {
	return (new RegExp('(\\s|^)' + className + '(\\s|$)')).test(element.className);
};

twSearchAria.Utils.addClass = function (element, className) {
	if (!twSearchAria.Utils.hasClass(element, className)) {
		element.className += ' ' + className;
	}
};

twSearchAria.Utils.removeClass = function (element, className) {
	var classRegex = new RegExp('(\\s|^)' + className + '(\\s|$)');
	element.className = element.className.replace(classRegex, ' ').trim();
};

twSearchAria.Utils.bindMethods = function (object /* , ...methodNames */) {
	var methodNames = Array.prototype.slice.call(arguments, 1);
	methodNames.forEach(function (method) {
		object[method] = object[method].bind(object);
	});
};

/*
 *   This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 */

twSearchAria.Utils = twSearchAria.Utils || {};

(function () {
	/*
	 * When util functions move focus around, set this true so the focus listener
	 * can ignore the events.
	 */
	twSearchAria.Utils.IgnoreUtilFocusChanges = false;

	twSearchAria.Utils.dialogOpenClass = 'has-dialog';

	/**
	 * @desc Set focus on descendant nodes until the first focusable element is
	 *       found.
	 * @param element
	 *          DOM node for which to find the first focusable descendant.
	 * @returns
	 *  true if a focusable element is found and focus is set.
	 */
	twSearchAria.Utils.focusFirstDescendant = function (element) {
		for (var i = 0; i < element.childNodes.length; i++) {
			var child = element.childNodes[i];
			if (twSearchAria.Utils.attemptFocus(child) ||
				twSearchAria.Utils.focusFirstDescendant(child)) {
				return true;
			}
		}
		return false;
	}; // end focusFirstDescendant

	/**
	 * @desc Find the last descendant node that is focusable.
	 * @param element
	 *          DOM node for which to find the last focusable descendant.
	 * @returns
	 *  true if a focusable element is found and focus is set.
	 */
	twSearchAria.Utils.focusLastDescendant = function (element) {
		for (var i = element.childNodes.length - 1; i >= 0; i--) {
			var child = element.childNodes[i];
			if (twSearchAria.Utils.attemptFocus(child) ||
				twSearchAria.Utils.focusLastDescendant(child)) {
				return true;
			}
		}
		return false;
	}; // end focusLastDescendant

	/**
	 * @desc Set Attempt to set focus on the current node.
	 * @param element
	 *          The node to attempt to focus on.
	 * @returns
	 *  true if element is focused.
	 */
	twSearchAria.Utils.attemptFocus = function (element) {
		if (!twSearchAria.Utils.isFocusable(element)) {
			return false;
		}

		twSearchAria.Utils.IgnoreUtilFocusChanges = true;
		try {
			element.focus();
		}
		catch (e) {
		}
		twSearchAria.Utils.IgnoreUtilFocusChanges = false;
		return (document.activeElement === element);
	}; // end attemptFocus

	/* Modals can open modals. Keep track of them with this array. */
	twSearchAria.OpenDialogList = twSearchAria.OpenDialogList || new Array(0);

	/**
	 * @returns the last opened dialog (the current dialog)
	 */
	twSearchAria.getCurrentDialog = function () {
		if (twSearchAria.OpenDialogList && twSearchAria.OpenDialogList.length) {
			return twSearchAria.OpenDialogList[twSearchAria.OpenDialogList.length - 1];
		}
	};

	twSearchAria.closeCurrentDialog = function () {
		var currentDialog = twSearchAria.getCurrentDialog();
		if (currentDialog) {
			currentDialog.close();
			return true;
		}

		return false;
	};

	twSearchAria.handleEscape = function (event) {
		var key = event.which || event.keyCode;

		if (key === twSearchAria.KeyCode.ESC && twSearchAria.closeCurrentDialog()) {
			event.stopPropagation();
		}
	};

	document.addEventListener('keyup', twSearchAria.handleEscape);

	/**
	 * @constructor
	 * @desc Dialog object providing modal focus management.
	 *
	 * Assumptions: The element serving as the dialog container is present in the
	 * DOM and hidden. The dialog container has role='dialog'.
	 *
	 * @param dialogId
	 *          The ID of the element serving as the dialog container.
	 * @param focusAfterClosed
	 *          Either the DOM node or the ID of the DOM node to focus when the
	 *          dialog closes.
	 * @param focusFirst
	 *          Optional parameter containing either the DOM node or the ID of the
	 *          DOM node to focus when the dialog opens. If not specified, the
	 *          first focusable element in the dialog will receive focus.
	 */
	twSearchAria.Dialog = function (dialogId, focusAfterClosed, focusFirst) {
		this.dialogNode = document.getElementById(dialogId);
		if (this.dialogNode === null) {
			throw new Error('No element found with id="' + dialogId + '".');
		}

		var validRoles = ['dialog', 'alertdialog'];
		var isDialog = (this.dialogNode.getAttribute('role') || '')
		.trim()
		.split(/\s+/g)
		.some(function (token) {
			return validRoles.some(function (role) {
				return token === role;
			});
		});
		if (!isDialog) {
			throw new Error(
				'Dialog() requires a DOM element with ARIA role of dialog or alertdialog.');
		}

		// Wrap in an individual backdrop element if one doesn't exist
		// Native <dialog> elements use the ::backdrop pseudo-element, which
		// works similarly.
		var backdropClass = 'twSearchDialogBackdrop';
		if (this.dialogNode.parentNode.classList.contains(backdropClass)) {
			this.backdropNode = this.dialogNode.parentNode;
		}
		else {
			this.backdropNode = document.createElement('div');
			this.backdropNode.className = backdropClass;
			this.dialogNode.parentNode.insertBefore(this.backdropNode, this.dialogNode);
			this.backdropNode.appendChild(this.dialogNode);
		}
		this.backdropNode.classList.add('active');

		// Disable scroll on the body element
		document.body.classList.add(twSearchAria.Utils.dialogOpenClass);

		if (typeof focusAfterClosed === 'string') {
			this.focusAfterClosed = document.getElementById(focusAfterClosed);
		}
		else if (typeof focusAfterClosed === 'object') {
			this.focusAfterClosed = focusAfterClosed;
		}
		else {
			throw new Error(
				'the focusAfterClosed parameter is required for the twSearchAria.Dialog constructor.');
		}

		if (typeof focusFirst === 'string') {
			this.focusFirst = document.getElementById(focusFirst);
		}
		else if (typeof focusFirst === 'object') {
			this.focusFirst = focusFirst;
		}
		else {
			this.focusFirst = null;
		}

		// Bracket the dialog node with two invisible, focusable nodes.
		// While this dialog is open, we use these to make sure that focus never
		// leaves the document even if dialogNode is the first or last node.
		var preDiv = document.createElement('div');
		this.preNode = this.dialogNode.parentNode.insertBefore(preDiv,
			this.dialogNode);
		this.preNode.tabIndex = 0;
		var postDiv = document.createElement('div');
		this.postNode = this.dialogNode.parentNode.insertBefore(postDiv,
			this.dialogNode.nextSibling);
		this.postNode.tabIndex = 0;

		// If this modal is opening on top of one that is already open,
		// get rid of the document focus listener of the open dialog.
		if (twSearchAria.OpenDialogList.length > 0) {
			twSearchAria.getCurrentDialog().removeListeners();
		}

		this.addListeners();
		twSearchAria.OpenDialogList.push(this);
		// this.clearDialog();
		this.dialogNode.className = 'default_dialog'; // make visible

		if (this.focusFirst) {
			this.focusFirst.focus();
		}
		else {
			twSearchAria.Utils.focusFirstDescendant(this.dialogNode);
		}

		this.lastFocus = document.activeElement;
	}; // end Dialog constructor

	twSearchAria.Dialog.prototype.clearDialog = function () {
		Array.prototype.map.call(
			this.dialogNode.querySelectorAll('input'),
			function (input) {
				if ( 'submit' !== input.type ) {
					input.value = '';
				}
			}
		);
	};

	/**
	 * @desc
	 *  Hides the current top dialog,
	 *  removes listeners of the top dialog,
	 *  restore listeners of a parent dialog if one was open under the one that just closed,
	 *  and sets focus on the element specified for focusAfterClosed.
	 */
	twSearchAria.Dialog.prototype.close = function () {
		twSearchAria.OpenDialogList.pop();
		this.removeListeners();
		twSearchAria.Utils.remove(this.preNode);
		twSearchAria.Utils.remove(this.postNode);
		this.dialogNode.className = 'twSearchHidden';
		this.backdropNode.classList.remove('active');
		this.focusAfterClosed.focus();

		// If a dialog was open underneath this one, restore its listeners.
		if (twSearchAria.OpenDialogList.length > 0) {
			twSearchAria.getCurrentDialog().addListeners();
		}
		else {
			document.body.classList.remove(twSearchAria.Utils.dialogOpenClass);
		}
	}; // end close

	/**
	 * @desc
	 *  Hides the current dialog and replaces it with another.
	 *
	 * @param newDialogId
	 *  ID of the dialog that will replace the currently open top dialog.
	 * @param newFocusAfterClosed
	 *  Optional ID or DOM node specifying where to place focus when the new dialog closes.
	 *  If not specified, focus will be placed on the element specified by the dialog being replaced.
	 * @param newFocusFirst
	 *  Optional ID or DOM node specifying where to place focus in the new dialog when it opens.
	 *  If not specified, the first focusable element will receive focus.
	 */
	twSearchAria.Dialog.prototype.replace = function (newDialogId, newFocusAfterClosed,
													  newFocusFirst) {
		var closedDialog = twSearchAria.getCurrentDialog();
		twSearchAria.OpenDialogList.pop();
		this.removeListeners();
		twSearchAria.Utils.remove(this.preNode);
		twSearchAria.Utils.remove(this.postNode);
		this.dialogNode.className = 'twSearchHidden';
		this.backdropNode.classList.remove('active');

		var focusAfterClosed = newFocusAfterClosed || this.focusAfterClosed;
		var dialog = new twSearchAria.Dialog(newDialogId, focusAfterClosed, newFocusFirst);
	}; // end replace

	twSearchAria.Dialog.prototype.addListeners = function () {
		document.addEventListener('focus', this.trapFocus, true);
	}; // end addListeners

	twSearchAria.Dialog.prototype.removeListeners = function () {
		document.removeEventListener('focus', this.trapFocus, true);
	}; // end removeListeners

	twSearchAria.Dialog.prototype.trapFocus = function (event) {
		if (twSearchAria.Utils.IgnoreUtilFocusChanges) {
			return;
		}
		var currentDialog = twSearchAria.getCurrentDialog();
		if (currentDialog.dialogNode.contains(event.target)) {
			currentDialog.lastFocus = event.target;
		}
		else {
			twSearchAria.Utils.focusFirstDescendant(currentDialog.dialogNode);
			if (currentDialog.lastFocus == document.activeElement) {
				twSearchAria.Utils.focusLastDescendant(currentDialog.dialogNode);
			}
			currentDialog.lastFocus = document.activeElement;
		}
	}; // end trapFocus

	twSearchOpenDialog = function (dialogId, focusAfterClosed, focusFirst) {
		var dialog = new twSearchAria.Dialog(dialogId, focusAfterClosed, focusFirst);
	};

	twSearchCloseDialog = function (closeButton) {
		var topDialog = twSearchAria.getCurrentDialog();
		if (topDialog.dialogNode.contains(closeButton)) {
			topDialog.close();
		}
	}; // end closeDialog

	twSearchReplaceDialog = function (newDialogId, newFocusAfterClosed,
									 newFocusFirst) {
		var topDialog = twSearchAria.getCurrentDialog();
		if (topDialog.dialogNode.contains(document.activeElement)) {
			topDialog.replace(newDialogId, newFocusAfterClosed, newFocusFirst);
		}
	}; // end replaceDialog

}());

jQuery( function () {

	jQuery( document ).on( 'click', '.js-twSearch', function ( event ) {
		event.preventDefault()
		twSearchOpenDialog( 'twSearchDialog', this );
	} )

	jQuery( document ).on( 'click', '.twSearchClose', function ( event ) {
		event.preventDefault()
		twSearchCloseDialog( this )
	} )

} )
