/*
 * Cleannum
 * Simple plugin to remove non-numeric characters. I use this on form fields where currency is entered.
 * I also wanted to try my hand at creating a jQuery plugin. So this is basically a wrapper for code based on
 * numberformatting code by Justin Barlow. Works with jQuery 1.3.2+
 *
 * By: Brad Rozier
 *
 * Usage: $(selector).cleannum();
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Based on number formatting by Justin Barlow
 *
 * Revision: 1.0
 *
 */

 $.fn.cleannum = function() {

    return this.each(function() {
		obj = $(this);
		var str = obj.val();
		str += '';
		var rgx = /^\d|\.|-$/;
		var out = '';
		for( var i = 0; i < str.length; i++ ){
		if( rgx.test( str.charAt(i) ) ){
			  if( !( ( str.charAt(i) == '.' && out.indexOf( '.' ) != -1 ) ||
					 ( str.charAt(i) == '-' && out.length != 0 ) ) ){
				out += str.charAt(i);
				}
			}
		}
		if(out == ""){ out = 0;}
		obj.val(out);
		
    });
 };



/*
 *	For the commas
 **/

$.fn.digits = function(){ 
    return this.each(function(){ 
        $(this).val( $(this).val().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
    })
}


/*
 *	Nicer rates
 **/

$.fn.niceRates = function(){ 
    return this.each(function(){
	
			var amount = $(this).val();
			if(amount >=1){
				//greater than a dollar
				niceAmnt = '$' + Math.round(amount*100)/100;
			}else{
				//less than a dollar
				niceAmnt = Math.round(amount*10000)/100 + '¢';
			}
			
      var suffix = $(this).next().text();
			suffix = suffix.split('/');
  		//$(this).parent().find('span').text(value + unit + '/' + suffix[1]).css({width:'85px'});
			$(this).parent().find('span').text(niceAmnt + '/' + suffix[1]).css({width:'87px'});
			$(this).hide();
    });
}



// /**
//  *	Even better
//  **/
// 
// /* Copyright (c) 2009 Michael Manning (actingthemaggot.com) Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.*/
// (function(A) {
//     A.fn.extend({
//         currency: function(B) {
//             var C = {
//                 s: ",",
//                 d: ".",
//                 c: 2
//             };
//             C = A.extend({},
//             C, B);
//             return this.each(function() {
//                 var D = (C.n || A(this).text());
//                 D = (typeof D === "number") ? D: ((/\./.test(D)) ? parseFloat(D) : parseInt(D)),
//                 s = D < 0 ? "-": "",
//                 i = parseInt(D = Math.abs( + D || 0).toFixed(C.c)) + "",
//                 j = (j = i.length) > 3 ? j % 3: 0;
//                 A(this).text(s + (j ? i.substr(0, j) + C.s: "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + C.s) + (C.c ? C.d + Math.abs(D - i).toFixed(C.c).slice(2) : ""));
//                 return this
//             })
//         }
//     })
// })(jQuery);
// jQuery.currency = function() {
//     var A = jQuery("<span>").text(arguments[0]).currency(arguments[1]);
//     return A.text()
// };