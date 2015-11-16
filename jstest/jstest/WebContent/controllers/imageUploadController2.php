<?php

if (!$_SERVER["REQUEST_METHOD"] == "POST" ||
    !array_key_exists('profilePicture', $_FILES))
	header('Location: /jstest/examples/imageForm2.php');
else {
   $pictureForm = $_FILES['profilePicture'];
   $tmpName = $pictureForm['tmp_name'];
   if (empty($tmpName))
   	  header('Location: /jstest/examples/imageForm2.php');
   elseif (move_uploaded_file($tmpName, "/jstest/images/".$pictureForm['name']))
     header('Location: /jstest/examples/examples.php');
   else {
     print_r($_FILES);
     echo "Hello";
   }
}

?>