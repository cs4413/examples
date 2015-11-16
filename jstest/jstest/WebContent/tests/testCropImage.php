<?php
require_once(dirname(__FILE__)."/utilities/ImageData.class.php");
$myPath = dirname(__FILE__)."/./images/temp.png";
echo $myPath."<br>";
$testData = array();
$testData['tmp_name'] = $myPath;
$testData['size'] = filesize($myPath);
print_r($testData);

$myImage = new ImageData($testData);
echo $myImage->getImageWidth()."<br>";
echo $myImage ."<br>";
$pathName = dirname(__FILE__). "/./images/tempFull";
if (ImageData::writeImage($myImage->getImage(), $pathName .".jpg"))
	echo "Image $pathName was written in jpg<br>";
else 
	echo "Failed to write image $pathName to jpg<br>";

if (ImageData::writeImage($myImage->getImage(), $pathName .".png"))
	echo "Image $pathName was written in png<br>";
else
	echo "Failed to write image $pathName to png<br>";

if (ImageData::writeImage($myImage->getImage(), $pathName .".gif"))
	echo "Image $pathName was written in gif<br>";
else
	echo "Failed to write image $pathName to gif<br>";

$newImage = $myImage->getResizedImage(50, 50);
if (ImageData::writeImage($newImage, $pathName ."Icon.png"))
	echo "Image $pathName was written as a png Icon<br>";
else
	echo "Failed to write image $pathName as a png Icon<br>";
	
?>