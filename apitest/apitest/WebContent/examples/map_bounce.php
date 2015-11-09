<!DOCTYPE html lang="en">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../js/jquery.zrssfeed.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../css/jumbotron.css">
<link href="../css/jquery.zrssfeed.css" rel="stylesheet" type="text/css" />

<?php 
$configPath = dirname(__FILE__).DIRECTORY_SEPARATOR."..".
	  	      DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR.
		      ".." . DIRECTORY_SEPARATOR . "myConfig.ini";
$passArray = parse_ini_file($configPath);
$key = $passArray["googlekey"];
$key = 'http://maps.googleapis.com/maps/api/js?key='.$passArray["googlekey"].'&sensor=false';
echo '<script type="text/javascript" src="'.$key.'"></script>';
?>
<title>Google map - with bouncing marker</title>

<script>
$(document).ready(function() {
	var utsaCenter=new google.maps.LatLng(29.582587, -98.622400);
	var mapOptions = {
		zoom : 14,
		center : utsaCenter,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map($("#googleMap").get(0), mapOptions);
	var marker = new google.maps.Marker({
		                                  position: utsaCenter,
		                                  animation:google.maps.Animation.BOUNCE
		                                });
	marker.setMap(map);
	
	var utsaEpicenter = new google.maps.Circle({
		  center: utsaCenter,
		  radius: 200,
		  strokeColor: "#2020FF",
		  strokeOpacity:0.5,
		  strokeWeight:2,
		  fillColor:"#2020FF",
		  fillOpacity:0.2
		  });
	utsaEpicenter.setMap(map);
	
	var infowindow = new google.maps.InfoWindow({
		  content:"CS4413 fun!"
		  });

	infowindow.open(map, marker);


});
</script>
</head>

<body>
<div class = "container">
<h1>Google map - with bouncing marker</h1>
<h4>Script</h4>
<pre>
$(document).ready(function() {
	var utsaCenter=new google.maps.LatLng(29.582587, -98.622400);
	var mapOptions = {
		zoom : 14,
		center : utsaCenter,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map($("#gooleMap").get(0), mapOptions);
	var marker = new google.maps.Marker({
		                                  position: utsaCenter,
		                                  animation:google.maps.Animation.BOUNCE
		                                });
	marker.setMap(map);
	
	var utsaEpicenter = new google.maps.Circle({
		  center: utsaCenter,
		  radius: 200,
		  strokeColor: "#2020FF",
		  strokeOpacity:0.5,
		  strokeWeight:2,
		  fillColor:"#2020FF",
		  fillOpacity:0.2
		  });
	utsaEpicenter.setMap(map);
	
	var infowindow = new google.maps.InfoWindow({
		  content:"CS4413 fun!"
		  });

	infowindow.open(map, marker);


});
</pre>

<h4>Map</h4>
<div id="googleMap" style="width:500px;height:380px;"></div>
</div>
</body>
</html> 