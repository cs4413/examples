<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<title>XML simplexml demo</title>
</head>

<body>
<div class="container">
<h1>PhP simpleXML parser examples</h1>

<p>These examples were adapted from the W3C tutorials at <a href="http://www.w3schools.com/php/php_xml_parsers.asp">
http://www.w3schools.com/php/php_xml_parsers.asp</a></p>

<h2>Top level from a string</h2>
<?php
$myXMLData = "<?xml version='1.0' encoding='UTF-8'?>
<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>";

$xml = simplexml_load_string ( $myXMLData );
print_r ( $xml );
?>

<h2>Multiple levels from a file</h2>

<?php
$filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
             'resources'.DIRECTORY_SEPARATOR.'books.xml';
$xml = simplexml_load_file ($filename);
echo $xml->book [0]->title . "<br>";
echo $xml->book [1]->title . "<br>";

echo "<h3>Here is the entire array</h3>";
print_r ( $xml );
?> 

<h2>As child nodes</h2>

<?php
$xml = simplexml_load_file ($filename);
foreach ( $xml->children () as $books ) {
	echo $books->title . ", ";
	echo $books->author . ", ";
	echo $books->year . ", ";
	echo $books->price . "<br>";
}
?> 

<h2>Extracting attributes</h2>

<?php
$xml = simplexml_load_file ($filename);
echo $xml->book [0] ['category'] . "<br>";
echo $xml->book [1]->title ['lang'];
?> 

<h2>Attributes in a loop</h2>

<?php
$xml = simplexml_load_file ($filename) or die ( "Error: Cannot create object" );
foreach ( $xml->children () as $books ) {
	echo $books->title . " is in language " . $books->title ['lang'];
	echo "<br>";
}
?> 
</div>
</body>