<?php
class SubmissionView {

	public static function show() {
		// Show a single Submission object
		$_SESSION['headertitle'] = "ClassBash Submission Report";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
        SubmissionView::showDetails();
		$_SESSION['footertitle'] ="<h3>Submission footer</h3>";
        MasterView::showFooter();
	}
	
	public static function showAll() {
		// Show all submission objects on own page
		$_SESSION['headertitle'] = "List of submissions";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showAllDetails();
		$_SESSION['footertitle'] ="<h3>Submission footer</h3>";
		MasterView::showFooter();
	}
	
	public static function showAllDetails() {
		// SHow a table of submission objects with links
		$submissions = (array_key_exists('submissions', $_SESSION))?$_SESSION['submissions']:array();
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";

	    echo '<div class="container">';
		echo '<h1>List of submissions</h1>';
		echo '<div class="table-responsive">';
		echo '<table class="table table-striped">';
		echo '<thead>';
		echo '<tr><th>Submitter</th><th>Assignment Id</th>
	         <th>Download</th><th>Show summary</th><th>Update</th><th>Review link</th></tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach($submissions as $submission) {
			echo '<tr><td>'.$submission->getSubmitterName().'</td>';
			echo '<td>'.$submission->getAssignmentId().'</td>';
			echo '<td><a href="/'.$base.'/submission/download/'.$submission->getSubmissionId().'">Download</a></td>';
			echo '<td><a href="/'.$base.'/submission/show/'.$submission->getSubmissionId().'">Show</a></td>';
			echo '<td><a href="/'.$base.'/submission/update/'.$submission->getSubmissionId().'">Update</a></td>';
			echo '<td><a href="/'.$base.'/review/new/'.$submission->getSubmissionId().'">Submit review</a></td></tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
		echo '</div>';
	}
	
  public static function showDetails() {
  	 $submission = (array_key_exists('submission', $_SESSION))?$_SESSION['submission']:null;
  	 $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
	 if (!is_null($submission)) { 
	  	 echo '<div class="container">';
	  	 echo '<h2>Submission: '.$submission->getSubmissionId().'</h2>';
	  	 echo '<p>Submitter name: '.$submission->getSubmitterName().'</p>';
	  	 echo '<p> Assignment Id: '. $submission->getAssignmentId() .'</p>';
	  	 echo '<p> File name: '. $submission->getSubmissionFile() .'</p>';
	  	 echo '<p> <a href="/' . $base.'/submission/download/'.
	  	 		$submission->getSubmissionId().'">Download</a></p>';
	  	 echo '</div>';
	 }
   }
   
   public static function showNew() {
   	  $_SESSION['headertitle'] = "Create a new submission";
      $_SESSION['styles'] = array('jumbotron.css');
      $_SESSION['scripts'] = array('assign.js');
   	  MasterView::showHeader();
   	  MasterView::showNavbar();
   	  self::showNewDetails();
   	  $_SESSION['footertitle'] = "<h3>Submission footer</h3>";
   	  MasterView::showFooter();
   	  $_SESSION['styles'] = array();
   	  $_SESSION['scripts'] = array();
   }
   
   public static function showNewDetails() {
   	  $submission = (array_key_exists('submission', $_SESSION))?$_SESSION['submission']:null;
   	  $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
   	  $instructors = (array_key_exists('instructors', $_SESSION))?$_SESSION['instructors']:array();
   	  echo '<div class="container-fluid">';
	  echo '<div class="row">';
	  echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
	  echo '<div class="col-md-6 col-sm-8 col-xs-10">';
	  echo '<h1>'.$_SESSION['headertitle'].'</h1>';
		
   	  echo '<form role = "form" enctype="multipart/form-data" 
   		   action ="/'.$base.'/submission/new" method="Post">';
   	  
   	  // Error at the top of the form
   	  if (!is_null($submission) && !empty($submission->getError('submissionId'))) {
   	  	echo  '<div class="form-group">';
   	  	echo  '<label><span class="label label-danger">';
   	  	echo  $submission->getError('submissionId');
   	  	echo '</span></label></div>';
   	  }
   	  
   	  echo '<div class="form-group">'; // Submitter name
   	  echo '<label for="submitterName">Submitter name:';
      echo '<span class="label label-danger">';
   	  if (!is_null($submission))
   		 echo $submission->getError('submitterName'); 
   	  echo '</span></label>';
   	  echo '<input type="text" class="form-control" id = "submitterName" name="submitterName"';
   	  if (!is_null($submission))
   		 echo 'value = "'. $submission->getSubmitterName() .'"';
   	  echo 'required>';
   	  echo '</div>';
   	  
   	  echo '<div class="form-group">';
   	  echo '<label for="instructor">Select instructor:</label>';
   	  echo '<select class="form-control" id="instructor" size="3" name="instructor">';
   	  foreach ($instructors as $instructor)
   	  	echo '<option value="'.$instructor.'">'.$instructor.'</option>';
   	  echo '</select>';
   	  echo '</div>';
   	  
   	  echo '<div class="form-group">';
   	  echo '<label for="assignmentId">Select assignment:</label>';
   	  echo '<select class="form-control" id="assignmentId" size="3" name="assignmentId">';
   	  echo '<option value="temp1">Temp 1</option>';
   	  echo '</select>';
   	  echo '</div>';
 
   	 
   	  echo '<div class="form-group">';  // File upload
   	  echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000" />';
   	  echo '<label for="submissionFile">Upload submission:';
   	  echo '<span class="label label-danger">';
   	  if (!is_null($submission))
   		  echo $submission->getError('submissionFile');
   	  echo '</span></label>';
   	  echo '<input name="submissionFile"
   	  		id = "submissionFile" type="file" required />';
      echo '</div>';
      
      echo '<button type="submit" class="btn btn-default">Submit</button>';
   	  echo '</form>';
      echo '</div>';   
      echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
      echo '</div>';
      echo '</div>';	
   }
   
// public static function showNewDetails() {
// 	$submission = (array_key_exists('submission', $_SESSION))?$_SESSION['submission']:null;
// 	$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
// 	echo '<div class="container-fluid">';
// 	echo '<div class="row">';
// 	echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
// 	echo '<div class="col-md-6 col-sm-8 col-xs-10">';
// 	echo '<h1>'.$_SESSION['headertitle'].'</h1>';

// 	echo '<form role = "form" enctype="multipart/form-data"
//    		   action ="/'.$base.'/submission/new" method="Post">';

// 	// Error at the top of the form
// 	if (!is_null($submission) && !empty($submission->getError('submissionId'))) {
// 		echo  '<div class="form-group">';
// 		echo  '<label><span class="label label-danger">';
// 		echo  $submission->getError('submissionId');
// 		echo '</span></label></div>';
// 	}

// 	echo '<div class="form-group">'; // Submitter name
// 	echo '<label for="submitterName">Submitter name:';
// 	echo '<span class="label label-danger">';
// 	if (!is_null($submission))
// 		echo $submission->getError('submitterName');
// 	echo '</span></label>';
// 	echo '<input type="text" class="form-control" id = "submitterName" name="submitterName"';
// 	if (!is_null($submission))
// 		echo 'value = "'. $submission->getSubmitterName() .'"';
// 	echo 'required>';
// 	echo '</div>';

// 	echo '<div class="form-group">'; //Assignment number
// 	echo '<label for="assignmentId">Assignment Id: ';
// 	echo '<span class="label label-danger">';
// 	if (!is_null($submission))
// 		echo $submission->getError('assignmentId');
// 	echo '</span></label>';
// 	echo '<input class="form-control" type = "number" min="1" id = "assignmentId"
// 	   		 required name ="assignmentId"';
// 	if (!is_null($submission))
// 		echo 'value = "'. $submission->getAssignmentId() .'"';
// 	echo '>';
// 	echo '</div>';

// 	echo '<div class="form-group">';  // File upload
// 	echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000" />';
// 	echo '<label for="submissionFile">Upload submission:';
// 	echo '<span class="label label-danger">';
// 	if (!is_null($submission))
// 		echo $submission->getError('submissionFile');
// 	echo '</span></label>';
// 	echo '<input name="submissionFile"
//    	  		id = "submissionFile" type="file" required />';
// 	echo '</div>';

// 	echo '<button type="submit" class="btn btn-default">Submit</button>';
// 	echo '</form>';
// 	echo '</div>';
// 	echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
// 	echo '</div>';
// 	echo '</div>';
// }

   public static function showUpdate() {
	  $_SESSION['headertitle'] = "Update submission";
	  $_SESSION['styles'] = array('Jumbotron.css');
	  MasterView::showHeader();
	  MasterView::showNavbar();
	  self::showUpdateDetails();
	  $_SESSION['footertitle'] = "The submission update footer";
	  MasterView::showFooter();
   }
   
   public static function showUpdateDetails() {
   	  $submission = (array_key_exists('submission', $_SESSION))?$_SESSION['submission']:null;
   	  $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";

	  echo '<div class="container-fluid">';
	  echo '<div class="row">';
	  echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
	  echo '<div class="col-md-6 col-sm-8 col-xs-10">';
	  echo '<h1>'.$_SESSION['headertitle'].'</h1>';
   	  if (is_null($submission)) {
	    echo '<section>Submission does not exist</section>';
		return;
	   }
	
	   	echo '<form role="form" enctype="multipart/form-data" 
	   			action ="/'.$base.'/submission/update" method="Post">'; 
	   	
	   	// Error at the top of the form
	   	if (!is_null($submission) && !empty($submission->getError('submissionId'))) {
	   		echo  '<div class="form-group">';
	   		echo  '<label><span class="label label-danger">';
	   		echo  $submission->getError('submissionId');
	   		echo '</span></label></div>';
	   	}
	   	echo '<div class="form-group">'; // Submitter name
	   	echo '<label for="submitterName">Submitter name:';
	   	echo '<span class="label label-danger">';
	   	if (!is_null($submission))
	   		echo $submission->getError('submitterName');
	   	echo '</span></label>';
	   	echo '<input type="text" class="form-control" id = "submitterName" name="submitterName"';
	   	if (!is_null($submission))
	   		echo 'value = "'. $submission->getSubmitterName() .'"';
	   	echo 'required readonly>';
	   	echo '</div>';
	   	
	   	echo '<div class="form-group">'; //Assignment number
	   	echo '<label for="assignmentId">Assignment Id: ';
	   	echo '<span class="label label-danger">';
	   	if (!is_null($submission))
	   		echo $submission->getError('assignmentId');
	   	echo '</span></label>';
	   	echo '<input class="form-control" type = "number" min="1" id = "assignmentId"
		   		 name ="assignmentId"';
	   	if (!is_null($submission))
	   		echo 'value = "'. $submission->getAssignmentId() .'"';
	   	echo 'required readonly>';
	   	echo '</div>';
	 
	   	echo '<div class="form-group">';
	   	echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000" />';
	   	echo '<label for="submissionFile">Submission file: ';
	   	echo '<span class="error">';
	   	if (!is_null($submission))
	   		echo $submission->getError('submissionFile');
	   	echo '</span></label>';
	   	echo '<input  type="file" class="btn btn-default" name="submissionFile" id = "submissionFile"';
	   	echo 'value = "'. $submission->getSubmissionFile() .'"';
	   	echo 'required>';
	   	echo '</div>';
	   	
	    echo '<button type="submit" class="btn btn-default">Submit</button>';
	   	echo '</form>';
	   	echo '</div>';
	   	echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
	   	echo '</div>';
	   	echo '</div>';

   }
}
