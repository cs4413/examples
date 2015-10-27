<?php  
class AssignmentView {
	
	public static function show() {
		$_SESSION['headertitle'] = "Assignment for ClassBash";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showDetails();
		$_SESSION['footertitle'] ="<h3>The assignment footer</h3>";
        MasterView::showFooter();
	}
	
	public static function showAll() {
		// Show all assignment objects on own page
		$_SESSION['headertitle'] = 'List of assignments';
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showAllDetails();
		$_SESSION['footertitle'] ='<h3>Assignments list footer</h3>';
		MasterView::showFooter();
	}
	
	public static function showAllDetails() {
		// Show a table of assignment objects with links
		$assignments = (array_key_exists('assignments', $_SESSION))?$_SESSION['assignments']:array();
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo '<div class="container">';
		echo '<h1>List of assignments</h1>';
		echo '<div class="table-responsive">';
		echo '<table class="table table-striped">';
		echo '<thead>';
		echo '<tr><th>Assignment Id</th><th>Assignment Owner</th>
			 <th>Title</th><th>Description</th></tr>';
		echo '</thead>';
		echo '<tbody>';
	
		foreach($assignments as $assignment) {
			echo '<tr>';
			echo '<td>'. $assignment->getAssignmentId().'</td>';
			echo '<td><a href="/'.$base.'/assignment/show/'.$assignment->getAssignmentId().'">Assignment '. $assignment ->getAssignmentId().'</a></td>';
			echo '<td>'.$assignment->getAssignmentTitle().'</td>';
			echo '<td>'.$assignment->getAssignmentDescription().'</td>';
	        echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
		echo '</div>';
	}
	
	public static function showDetails() {
		// Show the details of a review object without header or footer
		$assignment = (array_key_exists('assignment', $_SESSION))?$_SESSION['assignment']:null;
	    if (!is_null($assignment)) {
	    	echo '<div class="container">';
	    	echo '<h2>Assignment: '.$assignment->getAssignmentId().'</h2>';
			echo '<p>Assignment owner name: '.$assignment->getAssignmentOwnerName().'</p>';
			echo '<p>Assignment title: '. $assignment->getAssignmentTitle() .'</p>';
			echo '<p>Description:<br> '. $assignment->getAssignmentDescription() .'</p>';
			echo '</div>';
		}
	}
	
	public static function showNew() {
		$_SESSION['headertitle'] = "Create a new ClassBash review";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showNewDetails();
		$_SESSION['footertitle'] = "<h3>Review footer</h3>";
		MasterView::showFooter();
	}
	
	public static function showNewDetails() {
	   $assignment = (array_key_exists('assignment', $_SESSION))?$_SESSION['assignment']:null;
	   $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
	   
	   echo '<div class="container">';
	   echo '<h1>New Assignment</h1>';

	   echo '<form role="form" method="post" action="/'.$base.'/assignment/new">';
	   
	   // Error at the top of the form
	   if (!is_null($assignment) && !empty($assignment->getError('assignmentId'))) {
	     	echo  '<div class="form-group">';
	   	    echo  '<label><span class="label label-danger">';
	   		echo  $assignment->getError('assignmentId');
	   	    echo '</span></label></div>';
	   }
	   	   
	   echo  '<div class="form-group">';
       echo  '<label for="assignmentOwnerName">Assignment owner: ';
       echo '<span class="label label-danger">';
   	   if (!is_null($assignment))
   		  echo $assignment->getError('assignmentOwnerName');
   	   echo '</span></label>';
	   echo '<input type="text" class="form-control" id = "assignmentOwnerName" name="assignmentOwnerName"';
	   if (!is_null($assignment)) 
		   echo 'value = "'. $assignment->getAssignmentOwnerName() .'"';
	   echo 'required>';
	   echo '</div>';
	   
	   echo '<div class="form-group">';
	   echo '<label for="assignmentId">Assignment Id:</label>';
	   echo '<input type="text" class="form-control" name="assignmentId" id="assignmentId';
	   if (!is_null($assignment)) 
		   echo 'value = "'. $assignment->getAssignmentId() .'"';
	   echo 'required>';
	   echo '</div>';
	   
	   echo '<div class="form-group">';
	   echo '<label for="assignmentTitle">Assignment title:';
	   echo '<span class="label label-danger">';
	   if (!is_null($assignment))
	     	echo $assignment->getError('assignmentTitle');
	   echo '</span></label>';
	   echo '<input class="form-control" type="text" name="assignmentTitle" id="assignmentTitle';
	   if (!is_null($assignment))
	   	  echo 'value = "'. $assignment->getAssignmentTitle() .'"';
	   echo 'required>';
	   echo '</div>';
	   
	   echo '<div class="form-group">';
	   echo '<label for="review">Assignment description:';
	   echo '<span class="label label-danger">';
	   if (!is_null($assignment))
	   	  echo $assignment->getError('assignmentDescription');
	   echo '</span></label>';
       echo '<textarea class="form-control" name="assignmentDescription" id = "assignmentDescription"
       		placeholder="Write a description of the assignment here" rows="10" required>';
       if (!is_null($assignment))
          echo $assignment->getAssignmentDescription();
       echo '</textarea>';
       echo '</div>';
       
       echo '<button type="submit" class="btn btn-default">Submit</button>';
	   echo '</form>';
       echo '</div>';
	}
	
	public static function showUpdate() {
		$_SESSION['headertitle'] = "Update assignment";
		$_SESSION['styles'] = array('Jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showUpdateDetails();
	}	
		
	public static function showUpdateDetails() {
		$assignment = (array_key_exists('assignment', $_SESSION))?$_SESSION['assignment']:null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo '<div class="container">';
		echo '<h1>'.$_SESSION['headertitle'].'</h1>';
		echo "</div>";
		
		echo '<div class="container">';
		if (is_null($assignment)) {
			echo '<section>Assignment does not exist</section></div>';
			return;
		}

		echo '<section>';
		echo '<h3>Assignment information:</h3>';
		echo 'Assignment owner name: '.$assignment->getAssignmentOwnerName().'<br>';
		echo 'Assignment Id: '.$assignment->getAssignmentId().'<br>';
		echo '</section>';

		echo '<form role="form" method="post" action="/'.$base.'/assignment/update/'.
		                         $assignment->getAssignmentId().'">';
		// Error at the top of the form
		if (!is_null($assignment) && !empty($assignment->getError('assignmentId'))) {
			echo  '<div class="form-group">';
			echo  '<label><span class="label label-danger">';
			echo  $assignment->getError('assignmentId');
			echo '</span></label></div>';
		}
		
		echo '<div class="form-group">';
		echo '<label for="assignmentTitle">Assignment title: ';
		echo '<span class="label label-danger">';
   	    if (!is_null($assignment))
   		    echo $assignment->getError('assignmentTitle');
   	    echo '</span></label>';
		echo '<input class="form-control" type="text" name="assignmentTitle" id = "assignmentTitle"';
		echo 'value = "'. $assignment->getAssignmentTitle() .'"';
		echo 'required>';
		echo '</div>';
			
	    echo '<div class="form-group">';
		echo '<label for="assignmentDescription">Assignment description: ';
		echo '<span class="label label-danger">';
		if (!is_null($assignment))
   		    echo $assignment->getError('assignmentDescription');
   	    echo '</span></label>';

		echo '<textarea class="form-control" name="assignmentDescription" id="assignmentDescription" 
				placeholder="Describe the assignment here" rows="10" required>';
        echo $assignment->getAssignmentDescription();
        echo '</textarea>';
        echo '</div>';
        
		echo '<button type="submit" class="btn btn-default">Submit</button>';
	    echo '</form>';
        echo '</div>';     
		echo '</div>';	
	}
}
?>

