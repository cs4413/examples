<?php
class GradesView {
	public static $numberLabs = 1;
    public static function show($grades) {  		
?>
	<!DOCTYPE html>
	<html>
	<head>
	<title>Automatic CS 4413 Grading Page</title>
	</head>
	<body>
	<h1>Automatic CS 4413 Grading Page</h1>
	<em>This will be fun to write.</em>
		<table>
<?php 
	$list = $grades->getClassList();
	foreach($list as $student) {
	
?>  
       <tr>
           <td><?php echo $student->getLastName(); ?></td>
           <td><?php echo $student->getFirstName(); ?></td>
         
           <?php 	
              for ($k = 1; $k <= GradesView::$numberLabs; $k++) {
              	  $ip = $student->getIpAddress()."/".$student->getLabString($k);
              	  echo '<td><a href="http://'.$ip.'">'.$ip.'</a></td>';
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