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
		echo '<tr><th>Submitter</th><th>Assignment number</th>
	         <th>Download</th><th>Show summary</th><th>Update</th><th>Review link</th></tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach($submissions as $submission) {
			echo '<tr><td>'.$submission->getSubmitterName().'</td>';
			echo '<td>'.$submission->getAssignmentNumber().'</td>';
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
	  if (!is_null($submission)) { 
	  	 echo '<div class="container">';
	  	 echo '<h2>Submission: '.$submission->getSubmissionId().'</h2>';
	  	 echo '<p>Submitter name: '.$submission->getSubmitterName().'</p>';
	  	 echo '<p> Assignment number: '. $submission->getAssignmentNumber() .'</p>';
	  	 echo '<p> File name: '. $submission->getSubmissionFile() .'</p>';
	  	 echo '</div>';
	  }
   }
   
   public static function showNew() {
   	  $_SESSION['headertitle'] = "Create a new submission";
      $_SESSION['styles'] = array('jumbotron.css');
   	  MasterView::showHeader();
   	  MasterView::showNavbar();
   	  self::showNewDetails();
   	  $_SESSION['footertitle'] = "<h3>Submission footer</h3>";
   	  MasterView::showFooter();
   }
   
   public static function showNewDetails() {
   	  $submission = (array_key_exists('submission', $_SESSION))?$_SESSION['submission']:null;
   	  $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
      echo '<div class="container">';
   	  echo '<h1>ClassBash submission</h1>';
   	  echo '<form role = "form" enctype="multipart/form-data" 
   		   action ="/'.$base.'/submission/new" method="Post">';
   	  echo '<div class="form-group">';
   	  echo '<label for="submitterName">Submitter name:';
      echo '<span class="error">';
   	  if (!is_null($submission))
   		 echo $submission->getError('submitterName'); 
   	  echo '</span></label>';
   	  echo '<input type="text" class="form-control" id = "submitterName" name="submitterName"';
   	  if (!is_null($submission))
   		 echo 'value = "'. $submission->getSubmitterName() .'"';
   	  echo 'required>';
   	  echo '</div>';
   	
   	  echo '<div class="form-group">';
   	  echo '<label for="assignmentNumber">Assignment number:';
      echo '<span class="error">';
   	  if (!is_null($submission))
   		 echo $submission->getError('assignmentNumber');
   	  echo '</span></label>';
   	  echo '<input class="form-control" type = "number" min="1" id = "assignmentNumber"
	   		 required name ="assignmentNumber"';
   	  if (!is_null($submission))
   		 echo 'value = "'. $submission->getAssignmentNumber() .'"';
   	  echo '>';
   	  echo '</div>';  
   	  echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000" />';
   	
   	  echo '<div class="form-group">';
   	  echo '<label for="submissionFile">Upload submission:';
   	  echo '<span class="error">';
   	  if (!is_null($submission))
   		  echo $submission->getError('submissionFile');
   	  echo '</span></label>';
   	  echo '<input class="form-control" name="submissionFile" type="file" required /><br><br>';
      echo '</div>';
   	  echo '<input type="submit" value="Submit" />';
   	  echo '</form>';
      echo '</div>';
   }
   
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
   	$submissions = (array_key_exists('submissions', $_SESSION))?$_SESSION['submissions']:null;
   	$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";

   	if (is_null($submissions) || empty($submissions) || is_null($submissions[0])) {
	    echo '<section>Submission does not exist</section>';
		return;
	}
	$submission = $submissions[0];
	echo '<div class ="container">';
	echo '<h3>Submission information:</h3>';
	echo 'Submitter name: '.$submission->getSubmitterName().'<br>';
	echo 'Submission Id: '.$submission->getSubmissionId().'<br>';
	echo 'Assignment number: '.$submission->getAssignmentNumber().'<br>';
	echo '<div class="container">';
	if ($submission->getErrors() > 0) {
		$errors = $submission->getErrors();
		echo 'Errors:<br>';
		foreach($errors as $key => $value)
			echo $value . "<br>";   
	}
	echo '</div>';
   	echo '<form role="form" enctype="multipart/form-data" 
   			action ="/'.$base.'/submission/update" method="Post">';  
   	echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000" />';
   	echo '<div class="form-group">';
   	echo '<label for="submissionFile">Submission file: ';
   	echo '<span class="error">';
   	if (!is_null($submission))
   		echo $submission->getError('submissionFile');
   	echo '</span></label>';
   	echo '<input class="form-control" type="file" name="submissionFile" id = "submissionFile"';
   	echo 'value = "'. $submission->getSubmissionFile() .'"';
   	echo 'required>';
   	echo '</div>';
   	echo '<input type="submit" value="Submit" />';
   	echo '</form>';
   	echo '</div>';
   }
}
