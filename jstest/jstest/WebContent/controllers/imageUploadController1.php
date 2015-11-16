<?php
   $pictureForm = $_FILES['profilePicture'];
   $tmpName = $pictureForm['tmp_name'];
   $newFile = "/jstest/images/".$pictureForm['name'];
   move_uploaded_file($tmpName, $newFile);
   echo "Uploaded image:<br>";
?>
   <img src="<?=$newFile?>" alt="test image">


