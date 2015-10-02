<?php
class SubmissionView {
	public static function show($submission) {
		MasterView::showHeader("ClassBash Submission Form");
		SubmissionView::showDetails($submission);
		MasterView::showFooter("<h3>The footer goes here</h3>");
	}

	public static function showDetails($submission) {
?>
	
	<h1>ClassBash submission</h1>
	
	<form enctype="multipart/form-data" action ="submission" method="Post">
	<p>User name: <input type="text" name ="userName" 
	<?php if (!is_null($submission)) {
		     echo 'value = "'. $submission->getUserName() .'"';
	      }
	?>
	> 
	<span class="error">
	   <?php if (!is_null($submission)) {
	   	        echo $submission->getError('userName');
	         }
	   ?>
	</span></p>
    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
     Upload submission: <input name="submissionFile" type="file" />
     <br><br>
    <input type="submit" value="Submit" />
  </form>
<?php 
  }
}
?>