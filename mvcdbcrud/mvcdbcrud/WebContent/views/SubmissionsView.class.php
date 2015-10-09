<?php
class SubmissionsView {
	public static function show($submissions) {
		MasterView::showHeader("ClassBash Submissions");
		SubmissionsView::showDetails($submissions);
		MasterView::showFooter("<h3>The footer goes here</h3>");
	}

	public static function showDetails($submissions) {
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
	     echo '<td><a href="submission/'.$submission->getSubmissionFile().'">Download</a></td>';
	     echo '<td><a href="review/'.$submission->getSubmissionId().'">Submit review</a></td></tr>';
	   }
	   echo "</tbody>";
	   echo "</table>";
	}
}
?>
