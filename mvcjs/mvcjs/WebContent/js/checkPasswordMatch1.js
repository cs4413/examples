/**
 * Utility functions
 */
//"use strict;"
function checkPasswordMatch() {
	var error = document.getElementById("retypedError");
	var password = document.getElementById("password").value;
	var retyped = document.getElementById("retypedPassword").value;
	error.innerHTML = passwordMatch(password, retyped);
	if (error.innerHTML == "")
		return true;
	else
		return false;
}

function passwordMatch(password, retyped) {
    var msg = "";
	if (password == null || retyped == null || password.length == 0 || retyped.length ==0)
	    msg = "Password or retyped value cannot be empty";
	else {
		password = password.trim();
		retyped = retyped.trim();
		if (password.length == 0 || retyped.length == 0)
			msg = "Password or retyped value cannot blanks";
		else if (password != retyped)
		    msg = "Retyped password does not match";
	}
	return msg;
}