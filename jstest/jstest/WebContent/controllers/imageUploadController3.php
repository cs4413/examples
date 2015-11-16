<?php
require_once(dirname(__FILE__)."/jstest/models/ImageData.class.php");
if (!$_SERVER["REQUEST_METHOD"] == "POST" ||
    !array_key_exists('profilePicture', $_FILES))
	header('Location: /jstest/examples/imageForm3.php');
else {
   $pictureForm = $_FILES['profilePicture'];
   $tmpName = $pictureForm['tmp_name'];
   print_r($pictureForm);
   echo "$tmpName -- is here<br>";
   $image = new ImageData($pictureForm);
   echo $image."<br>";
   
}

?>