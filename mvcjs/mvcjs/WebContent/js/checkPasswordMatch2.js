/**
 * Utility functions
 */
//"use strict;"
function checkPasswordMatch() {
	var password = $("#password").val();
	var retyped = $("#retypedPassword").val();
	var errorText = passwordMatch(password, retyped);
	$("#retypedError").html(errorText);
	if (errorText == "")
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