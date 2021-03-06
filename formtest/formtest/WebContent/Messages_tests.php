<head>
</head>
<body>
<h1>UserData tests</h1>

<?php
include_once("Messages.class.php");
?>

<h2>It should set errors from a file</h2>
<?php 
Messages::setErrors("errors_English.txt");

echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "LAST_NAME_HAS_INVALID_CHARS: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";

echo (empty(Messages::getError("LAST_NAME_TOO_SHORT")))?
      "Failed: it did not set LAST_NAME_TOO_SHORT from file":"";
?>

<h2>It should allow reset</h2>
<?php 
Messages::reset();

echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "LAST_NAME_HAS_INVALID_CHARS: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";

?>

