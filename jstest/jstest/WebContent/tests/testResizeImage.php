<?php
require_once(dirname(__FILE__)."/../models/ImageData.class.php");
$myPath = dirname(__FILE__)."/../images/lincoln.png";
$tempFileBase = "../images/lincoln";
echo $myPath."<br>";

$testData = array();
$testData['tmp_name'] = $myPath;
$testData['size'] = filesize($myPath);
print_r($testData);

echo "<h2>Original image</h2>";
$myImage = new ImageData($testData);
echo $myImage->getImageWidth()."<br>";
echo $myImage ."<br>";
$tempFile = $tempFileBase.".png";
echo $tempFile."<br>";
?>
<img src="<?=$tempFile?>" alt="test image"><br>

<?php 
echo "<h2>Resized to 200 x 150<h2>";
$thisImage = $myImage->getImage();
$newImage1 = ImageData::resizeImage($thisImage, 200, 150);
$x = imagesx($newImage1);
$y = imagesy($newImage1);
echo "Width=$x Height=$y<br>";
$tempFile = $tempFileBase."1.png";
$tempPath = dirname(__FILE__)."/".$tempFile;
$myImage->writeImage($newImage1, $tempPath);
?>
<img src="<?=$tempFile?>" alt="test image"><br>

<?php 
echo "<h2>Resized to 500 x 500<h2>";
$newImage2 = ImageData::resizeImage($thisImage, 500, 500);
$x = imagesx($newImage2);
$y = imagesy($newImage2);
echo "Width=$x Height=$y<br>";
$tempFile = $tempFileBase."2.png";
$tempPath = dirname(__FILE__)."/".$tempFile;
$myImage->writeImage($newImage2, $tempPath);
?>
<img src="<?=$tempFile?>" alt="test image"><br>

<?php
echo "<h2>Cropped -- aspect ratio 1<h2>";
$newImage3 = ImageData::cropImage($myImage->getImage(), 1);
$x = imagesx($newImage3);
$y = imagesy($newImage3);
echo "Width=$x Height=$y<br>";
$tempFile = $tempFileBase."3.png";
$tempPath = dirname(__FILE__)."/".$tempFile;
$myImage->writeImage($newImage3, $tempPath);
?>
<img src="<?=$tempFile?>" alt="test image"><br>

<?php
echo "<h2>Resized of cropped -- aspect ratio 1<h2>";
$newImage4 = ImageData::resizeImage($newImage3, 500, 500);
$x = imagesx($newImage4);
$y = imagesy($newImage4);
echo "Width=$x Height=$y<br>";
$tempFile = $tempFileBase."4.png";
$tempPath = dirname(__FILE__)."/".$tempFile;
$myImage->writeImage($newImage4, $tempPath);
?>
<img src="<?=$tempFile?>" alt="test image"><br>


<?php
echo "<h2>Resized preserving original aspect ratio<h2>";
$aspect = imagesx($thisImage)/imagesy($thisImage);
$newImage5 = ImageData::resizeImage($thisImage, $aspect*500, 500);
$x = imagesx($newImage5);
$y = imagesy($newImage5);
echo "Width=$x Height=$y<br>";
$tempFile = $tempFileBase."5.png";
$tempPath = dirname(__FILE__)."/".$tempFile;
$myImage->writeImage($newImage5, $tempPath);
?>
<img src="<?=$tempFile?>" alt="test image"><br>