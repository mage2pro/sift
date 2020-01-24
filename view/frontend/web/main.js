// 2020-01-24 https://sift.com/developers/docs/curl/javascript-api
define(['df-lodash', 'Magento_Customer/js/customer-data'], function(_, cd) {return function(d) {
	var c = cd.get('customer')();
	var f = function() {
		var _sift = window._sift = window._sift || [];
		_sift.push(['_setAccount', d['beaconKey']]);
		_sift.push(['_setSessionId', c.quoteId]);
		_sift.push(['_setUserId', c.id]);
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