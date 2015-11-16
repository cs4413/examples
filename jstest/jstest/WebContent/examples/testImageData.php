<?php
require_once(dirname(__FILE__)."/../models/ImageData.class.php");
$myPath = dirname(__FILE__)."/../images/WaterDrops.jpg";
echo $myPath."<br>";
$testData = array();
$testData['tmp_name'] = $myPath;
$testData['size'] = filesize($myPath);
print_r($testData);

$myImage = new ImageData($testData);
echo $myImage->getImageWidth()."<br>";
echo $myImage ."<br>";
$fileBase = "../images/WaterDrops";
$pathName = dirname(__FILE__). "/$fileBase";
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

$newImage = ImageData::resizeImage($myImage->getImage(), 50, 50);
if (ImageData::writeImage($newImage, $pathName ."Icon.png"))
	echo "Image $pathName was written as a png Icon<br>";
else
	echo "Failed to write image $pathName as a png Icon<br>";
$IconFile = $fileBase."Icon.png";	
?>

<img src="<?=$IconFile?>" alt="didn't find Icon file"><br>
