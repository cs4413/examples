/**
 * Utility functions
 */
//"use strict;"
function checkPasswordMatch () {
	var error = document.getElementById("retypedError");
	var password = document.getElementById("password").value;
	var retyped = document.getElementById("retypedPassword").value;
	console.log("Hello there");
	if (password == null || retyped == null || password.length == 0 || retyped.length ==0)
	    error.innerHTML = "Password or retyped value cannot be empty";
	else {
		password = password.trim();
		retyped = retyped.trim();
		if (password.length == 0 || retyped.length == 0)
			error.innerHTML = "Password or retyped value cannot blanks";
		else if (password != retyped)
		   error.innerHTML = "Retyped password does not match";
		else
		  error.innerHTML = "";
	}
}