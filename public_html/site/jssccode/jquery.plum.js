/*!
 * Plum v1.5: A library of tools for jQuery
 *
 * Copyright 2011 RoboCreatif, LLC
 * <http://robocreatif.com>
 *
 * Date: 3 March, 2012
 */
var plum=plum||{};(function(a){String.prototype.plum=Number.prototype.plum=a.fn.plum=function(e,c){var d=e.split("."),b;e=d[0];if(d.length>1){b=c;c=d[1]}return typeof plum[e]==="function"?plum[e].call(this,c,b):this};a.each(["before","after","append","html"],function(c,b){c=a.fn[b];a.fn[b]=function(e){var d=c.apply(this,arguments);this.trigger("plum",[d,e]);return d}})}(jQuery));