<!DOCTYPE html lang="en">
<html><head> 
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Demonstrating file upload</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
</head>
<body>
<h1>Sample upload</h1>

 <form enctype="multipart/form-data" action="/jstest/controllers/imageUploadController2.php" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
  <div><label>Upload profile picture</label>
       <input name="profilePicture" type="file" /></div>
  <div><input type="submit" value="Submit" /></div>
  </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>
