<?php
require_once(dirname(__FILE__)."/jstest/models/ImageData.class.php");
if (!$_SERVER["REQUEST_METHOD"] == "POST" ||
    !array_key_exists('profilePicture', $_FILES))
	header('Location: /jstest/imageForm3.php');
else {
   $pictureForm = $_FILES['profilePicture'];
   $tmpName = $pictureForm['tmp_name'];
   if ($tmpName == "") 
       echo "Just checking";
   else {
       header("Content-type: ".$pictureForm['type']);
   	   $myImage = new ImageData($pictureForm);
   	   imagejpeg($myImage->getImage()); 
   }	 
}

?>