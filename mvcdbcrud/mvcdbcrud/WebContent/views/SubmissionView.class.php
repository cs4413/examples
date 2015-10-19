<?php
class SubmissionView {

	public static function show() {
		// Show a single Submission object
		$_SESSION['headertitle'] = "ClassBash Submission Report";
		MasterView::showHeader();
		MasterView::showNavbar();
        SubmissionView::showDetails();
		$_SESSION['footertitle'] ="<h3>The footer goes here</h3>";
        MasterView::showFooter();
	}
	
	public static function showAll() {
		// SHow a table of submission objects with links
		if (array_key_exists('headertitle', $_SESSION)) {
			MasterView::showHeader();
			MasterView::showNavbar();
		}
		$submissions = (array_key_exists('submissions', $_SESSION))?$_SESSION['submissions']:array();
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";

		echo "<h1>ClassBash submission list</h1>";
		echo "<table>";
		echo "<thead>";
		echo "<tr><th>Submitter</th><th>Assignment number</th>
	         <th>Download</th><th>Show summary</th><th>Update</th><th>Review link</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach($submissions as $submission) {
			echo '<tr><td>'.$submission->getSubmitterName().'</td>';
			echo '<td>'.$submission->getAssignmentNumber().'</td>';
			echo '<td><a href="/'.$base.'/submission/download/'.$submission->getSubmissionId().'">Download</a></td>';
			echo '<td><a href="/'.$base.'/submission/show/'.$submission->getSubmissionId().'">Show</a></td>';
			echo '<td><a href="/'.$base.'/submission/update/'.$submission->getSubmissionId().'">Update</a></td>';
			echo '<td><a href="/'.$base.'/review/new/'.$submission->getSubmissionId().'">Submit review</a></td></tr>';
		}
		echo "</tbody>";
		echo "</table>";
		if (array_key_exists('footertitle', $_SESSION))
			MasterView::showFooter();
	}
	

  
  public static function showDetails() {
  	 $submission = (array_key_exists('submission', $_SESSION))?$_SESSION['submission']:null;
	  if (!is_null($submission)) {  	
	  	echo '<p>Submission Id: '.$submission->getSubmissionId().'<p>';
	  	echo '<p>Submitter name: '.$submission->getSubmitterName().'<p>';
	  	echo '<p> Assignment number: '. $submission->getAssignmentNumber() .'</p>';
	  	echo '<p> File name: '. $submission->getSubmissionFile() .'</p>';
	  }
   }
   
   public static function showNew() {
   	$submission = (array_key_exists('submission', $_SESSION))?$_SESSION['submission']:null;
   	$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
   	$_SESSION['headertitle'] = "ClassBash Submission Report";
   	MasterView::showHeader();
   
   	echo '<h1>ClassBash submission</h1>';
   	echo '<form enctype="multipart/form-data" 
   		   action ="/'.$base.'/submission/new" method="Post">';
   	echo '<p>Submitter name: <input type="text" required name ="submitterName"';
   	if (!is_null($submission))
   		echo 'value = "'. $submission->getSubmitterName() .'"';
   	echo '>';
   	echo '<span class="error">';
   	if (!is_null($submission))
   		echo $submission->getError('submitterName');
   	 
   	echo '</span></p>';
   	echo '<p> Assignment number: <input type = "number" min="1"
	   		 required name ="assignmentNumber"';
   	if (!is_null($submission))
   		echo 'value = "'. $submission->getAssignmentNumber() .'"';
   	echo '>';
   	echo '<span class="error">';
   	if (!is_null($submission))
   		echo $submission->getError('assignmentNumber');
   	echo '</span></p>';
   
   	echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000" />';
   	echo 'Upload submission: <input name="submissionFile" type="file" required /><br><br>';
   
   	echo '<input type="submit" value="Submit" />';
   	echo '</form>';
   	$_SESSION['footertitle'] = "The footer";
   	MasterView::showFooter();
   }
   
   public static function showUpdate() {
   	$submissions = (array_key_exists('submissions', $_SESSION))?$_SESSION['submissions']:null;
   	$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
   	$_SESSION['headertitle'] = "ClassBash update submission";
   	MasterView::showHeader();

   	echo '<h1>ClassBash submission update</h1>';
   	if (is_null($submissions) || empty($submissions) || is_null($submissions[0])) {
	    echo '<section>Submission does not exist</section>';
		return;
	}
	$submission = $submissions[0];
	if ($submission->getErrors() > 0) {
		$errors = $submission->getErrors();
		echo '<section><p>Errors:<br>';
		foreach($errors as $key => $value)
			echo $value . "<br>";
		echo '</p></section>';
	}
	echo '<section>';
	echo '<h3>Submission information:</h3>';
	echo 'Submitter name: '.$submission->getSubmitterName().'<br>';
	echo 'Submission Id: '.$submission->getSubmissionId().'<br>';
	echo 'Assignment number: '.$submission->getAssignmentNumber().'<br>'; 		 
   	echo '<form enctype="multipart/form-data" action ="/'.$base.'/submission/update" method="Post">';  
   	echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000" />';
   	echo 'Upload submission: <input name="submissionFile" type="file" required /><br><br>';
   
   	echo '<input type="submit" value="Submit" />';
   	echo '</form>';
   	$_SESSION['footertitle'] = "The submission update footer";
   	MasterView::showFooter();
   }
}
