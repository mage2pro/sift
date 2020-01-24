// 2020-01-24 https://sift.com/developers/docs/curl/javascript-api
define(['df-lodash', 'Magento_Customer/js/customer-data'], function(_, cd) {return function(d) {
	var c = cd.get('customer')();
	var f = function() {
		var _sift = window._sift = window._sift || [];
		/**
		 * 2020-01-25
		 * 1) «Change the parameter to _setAccount above to your JavaScript Snippet key.»
		 * https://sift.com/developers/docs/curl/javascript-api
		 * 2) Despite of the `_setAccount` name, the value should be the Beacon Key, not the Account ID.
		 */
		_sift.push(['_setAccount', d['key']]);
		// 2020-01-25
		// «Set _session_id to a string that identifies a unique session ID for the visitor's current browsing session.»
		// https://sift.com/developers/docs/curl/javascript-api
		_sift.push(['_setSessionId', c.quoteId]);
		// 2020-01-25
		// «Set _user_id to a string that identifies the user, e.g. a user ID, username, or email address.
		// (Leave user_id blank if you do not yet know the ID of the user.).
		// This user ID should be consistent with $user_id in your Events API requests.»
		// https://sift.com/developers/docs/curl/javascript-api
		_sift.push(['_setUserId', c.id]);
		/**
		 * 2020-01-25
		 * 1) https://sift.com/developers/docs/curl/javascript-api
		 * 2) «Using the JavaScript snippet in a Single Page App»: https://support.sift.com/hc/en-us/articles/208370598
		 * 3) @todo It seems that every checkout step should fire `_trackPageview`:
		 * https://github.com/mage2pro/sift/issues/1
		 */
		_sift.push(['_trackPageview']);
		var f = function() {
			var e = document.createElement('script');
			e.src = 'https://cdn.sift.com/s.js';
			document.body.appendChild(e);
		};
		window.attachEvent ? window.attachEvent('onload', f) : window.addEventListener('load', f, false);
	};
	!_.isEmpty(c) ? f() : cd.reload('customer').done(function() {c = cd.get('customer')(); f();});
}});