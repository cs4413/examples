<?php
class GradesView {
    public static function show($grades, $labs) { 
?>
	<!DOCTYPE html>
	<html>
	<head>
	<title>Automatic CS 4413 Grading Page</title>
	<style>
       td.error a:link {color:red;}
       td.error a:visited {color:red;}
    </style>
	</head>
	<body>
	<h1>Automatic CS 4413 Grading Page</h1>
	<em>This will be fun to write.</em>
	<table>
	<thead>
	<tr>
	  <th>Last name</th> <th>First name</th> <th>IP address</th>
	     <?php for ($k = 1; $k <= $labs; $k++)  
	               echo "<th> Lab $k</th>";
	     ?>
	</tr>
	</thead>
<?php 
	$list = $grades->getClassList();
	foreach($list as $student) {
		$ip = $student->getIpAddress()
?>  
       <tr>
           <td><?php echo $student->getLastName(); ?></td>
           <td><?php echo $student->getFirstName(); ?></td>
           <td><?php echo $ip; ?></td>
           <?php 	
              for ($k = 1; $k <= $labs; $k++) {
              	  $labString = $student->getLabString($k);
              	  $labURL = "http://".$ip."/".$labString;
              	  //$retCode = Site::getHTTPReturnCode($labURL);
              	  $retCode = 200;
              	  $classSpec = ($retCode >= 400)? 'class="error"':'';
              	  //$classString = 'class = "error"';
              	  echo '<td ' .$classSpec.'><a href="'.$labURL.'">'.$labString.'</a></td>';
              }
            ?>
       </tr>
<?php } ?>               	
	</table>
	<h3>The footer goes here</h3>	
	</body>
	</html>
<?php
  }
  
}
?>