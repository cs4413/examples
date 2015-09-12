<?php
include '../models/User.class.php';
$inputForm = ($_SERVER["REQUEST_METHOD"] == "POST")?$_POST:null;
$user = new User($inputForm);

include '../views/loginForm.php';
?>
 