// jQuery local fallback
window.jQuery || document.write('<script src="'+plugins_js_vars.jquery+'"><\/script>');

// Avoid `console` errors in browsers that lack a console.
(function() {
	var method;
	var noop = function () {};
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while (length--) {
		method = methods[length];

		// Only stub undefined methods.
		if (!console[method]) {
			console[method] = noop;
		}
	}
}());

/*!
* Baseline.js 1.0
*
* Copyright 2012, Daniel Eden http://daneden.me
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*
* Date: Wed June 20 11:39:00 2012 GMT
*/
(function($){$.fn.baseline=function(breakpoints){var tall,newHeight,base,old=0;return this.each(function(){var $this=$(this);var setbase=function(breakpoints){if(typeof breakpoints==='number'){base=breakpoints;}else if(typeof breakpoints==='object'){for(key in breakpoints){var current=parseInt(key);if(document.width>current&&current>=old){base=breakpoints[key];old=current;}}}
$this.css('maxHeight','none');tall=$this.height();newHeight=Math.floor(tall/base)*base;$this.css('maxHeight',newHeight);}
setbase(breakpoints);$(window).resize(function(){setbase(breakpoints);});});}})(jQuery);
