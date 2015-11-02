/**
 *  Expander function
 */

$(document).ready( 
	$("h2").each(function() {
	     $(this).click(function() {
	    	 console.log("hello");
	    	 $(this).toggleClass("minus")
	          if ($(this).hasClass("minus")) {
	        	  console.log("minus");
	        	  $(this).next().show();
	          }else {
		          $(this).next().hide();
		          console.log("plus");
	          }
	       });
	})
);    