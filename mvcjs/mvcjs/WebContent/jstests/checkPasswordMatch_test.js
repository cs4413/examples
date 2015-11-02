
QUnit.test( "test check password", function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});


QUnit.test("check passwordMatch", function (assert) {
	expect(4);  // Perform 4 assertions (check for asynchronous tests)
	assert.notEqual(passwordMatch("", ""), "", 
	"It should return an error when password and retyped are empty strings");
	assert.equal(passwordMatch("abc", "abc"), "", 
	"It should not return an error when password and retyped are non-empty matches");
	assert.notEqual(passwordMatch("", "abc"), "", 
	"It should return an error when password is empty but retyped is not");
	assert.notEqual(passwordMatch("abc", ""), "", 
	"It should return an error when retyped is empty but password is not");
});


QUnit.test("matching", function (assert) {
	expect(2);
	var error = $("#retypedError");
	var password = $("#password").val();
	var retyped = $("#retypedPassword").val();
	assert.equal(password, "", "It should have empty password");
	$("#password").val("abc");
	password = $("#password").val();
	assert.equal(password, "abc", "It should be non empty when set");

});