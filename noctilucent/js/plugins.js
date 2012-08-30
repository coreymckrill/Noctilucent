// jQuery local fallback
window.jQuery || document.write('<script src="'+plugins_js_vars.jquery+'"><\/script>');

// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/

window.log = function f() {
    log.history = log.history || [];
    log.history.push(arguments);
    if (this.console) {
        var args = arguments;
        var newarr;

        try {
            args.callee = f.caller;
        } catch(e) {

        }

        newarr = [].slice.call(args);

        if (typeof console.log === 'object') {
            log.apply.call(console.log, console, newarr);
        } else {
            console.log.apply(console, newarr);
        }
    }
};

// make it safe to use console.log always

(function(a) {
    function b() {}
    var c = "assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn";
    var d;
    for (c = c.split(","); !!(d = c.pop());) {
        a[d] = a[d] || b;
    }
})(function() {
    try {
        console.log();
        return window.console;
    } catch(a) {
        return (window.console = {});
    }
}());

// place any jQuery/helper plugins in here, instead of separate, slower script files.

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

/*! http://tinynav.viljamis.com v1.03 by @viljamis */ /*
(function(a,i,g){a.fn.tinyNav=function(j){var c=a.extend({active:"selected",header:!1},j);return this.each(function(){g++;var h=a(this),d="tinynav"+g,e=".l_"+d,b=a("<select/>").addClass("tinynav "+d);if(h.is("ul,ol")){c.header&&b.append(a("<option/>").text("Navigation"));var f="";h.addClass("l_"+d).find("a").each(function(){f+='<option value="'+a(this).attr("href")+'">'+a(this).text()+"</option>"});b.append(f);c.header||b.find(":eq("+a(e+" li").index(a(e+" li."+c.active))+")").attr("selected",!0);
b.change(function(){i.location.href=a(this).val()});a(e).after(b)}})}})(jQuery,this,0);
													  */

/*! http://tinynav.viljamis.com v1.03 by @viljamis */
/*! Edited by Corey 20120624 */
(function ($, window, i) {
  $.fn.tinyNav = function (options) {

    // Default settings
    var settings = $.extend({
      'active' : 'selected', // String: Set the "active" class
      'header' : false // Boolean: Show header instead of the active item
    }, options);

    return this.each(function () {

      // Used for namespacing
      i++;

      var $nav = $(this),
        // Namespacing
        namespace = 'tinynav',
        namespace_i = namespace + i,
        l_namespace_i = '.l_' + namespace_i,
        $select = $('<select/>').addClass(namespace + ' ' + namespace_i),
		depth = $nav.parents().length;

      if ($nav.is('ul,ol')) {

        if (settings.header) {
          $select.append(
            $('<option/>').text('Navigation')
          );
        }

        // Build options
        var options = '';

        $nav
          .addClass('l_' + namespace_i)
          .find('a')
          .each(function () {
            var offset = ($(this).parents().length - depth)/2 - 1,
				step = '';
			for(var i = offset; i > 0; i--){
				step += '&ndash;';
			}
			options +=
              '<option value="' + $(this).attr('href') + '">' + step +
              $(this).text() +
              '</option>';
          });

        // Append options into a select
        $select.append(options);

        // Select the active item
        if (!settings.header) {
          $select
            .find(':eq(' + $(l_namespace_i + ' li')
            .index($(l_namespace_i + ' li.' + settings.active)) + ')')
            .attr('selected', true);
        }

        // Change window location
        $select.change(function () {
          window.location.href = $(this).val();
        });

        // Inject select
        $(l_namespace_i).after($select);

      }

    });

  };
})(jQuery, this, 0);