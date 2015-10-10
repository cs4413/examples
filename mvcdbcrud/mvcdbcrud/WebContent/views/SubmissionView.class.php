<?php
class SubmissionView {

	public static function show($submission, $header = null, $footer = null) {
		// Show a single Submission object
		if (!is_null($header))
			MasterView::showHeader($header);
		echo '<h1>ClassBash submission</h1>';
		if (!is_null($submission)) {
			echo '<p>Submission Id: '.$submission->getSubmissionId().'<p>';
			echo '<p>User name: '.$submission->getUserName().'<p>';
			echo '<p> Assignment number: '. $submission->getAssignmentNumber() .'</p>';
			echo '<p> File name: '. $submission->getSubmissionFile() .'</p>';
		}
		if (!is_null($footer))
			MasterView::showHeader($footer);
	}
	
	public static function showAll($submissions = null, $header = null, $footer = null) {
		// SHow a table of submission objects with links
		if (!is_null($header))
		   MasterView::showHeader($header);
		echo "<h1>ClassBash submission list</h1>";
		echo "<table>";
		echo "<thead>";
		echo "<tr><th>User name</th><th>Assignment number</th>
	         <th>Submission</th><th>Review link</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach($submissions as $submission) {
			echo '<tr><td>'.$submission->getUserName().'</td>';
			echo '<td>'.$submission->getAssignmentNumber().'</td>';
			echo '<td><a href="submission/download/'.$submission->getSubmissionId().'">Download</a></td>';
			echo '<td><a href="review/'.$submission->getSubmissionId().'">Submit review</a></td></tr>';
		}
		echo "</tbody>";
		echo "</table>";
		if (!is_null($footer))
			MasterView::showFooter($footer);
	}
	
	public static function showNew($submission = null, $header = null, $footer = null) {
		if (!is_null($header))
			MasterView::showHeader($header);
	   echo '<h1>ClassBash submission</h1>';
	   echo '<form enctype="multipart/form-data" action ="submission/new" method="Post">';
	   echo '<p>User name: <input type="text" required name ="userName"'; 
	   if (!is_null($submission))  
		  echo 'value = "'. $submission->getUserName() .'"';
	   echo '>'; 
	   echo '<span class="error">';
	   if (!is_null($submission))  
	   	  echo $submission->getError('userName');
	      
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
       if (!is_null($footer))
       	MasterView::showFooter($footer);
  }
}
