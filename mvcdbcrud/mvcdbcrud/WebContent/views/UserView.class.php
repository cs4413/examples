<?php  
class UserView {
	public static function show() {
		$_SESSION['headertitle'] = "User details";
		MasterView::showHeader();
		MasterView::showNavbar();
		
		UserView::showDetails();
		$_SESSION['footertitle'] ="<h3>The footer goes here</h3>";
        MasterView::showFooter();
	}
	
	
	public static function showAll() {
		// SHow a table of users with links
		if (array_key_exists('headertitle', $_SESSION)) {
			MasterView::showHeader();
			MasterView::showNavbar();
		}
		$users = (array_key_exists('users', $_SESSION))?$_SESSION['users']:array();
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo "<h1>ClassBash user list</h1>";
		echo "<table>";
		echo "<thead>";
		echo "<tr><th>User Id</th><th>User Id</th></tr>";
		echo "</thead>";
		echo "<tbody>";
	
// 		foreach($users as $user) {
// 			echo '<tr>';
// 			echo '<td><a href="/'.$base.'/user/show/'.$review->getReviewId().'">Review '. $review->getReviewId().'</a></td>';
// 			echo '<td><a href="/'.$base.'/submission/show/'.$review->getSubmissionId().'">Submission '. $review->getSubmissionId().'</a></td>';
// 			echo '<td>'.$review->getUserName().'</td>';
// 			echo '<td>'.$review->getScore().'</td>';
// 			echo '</tr>';
// 		}
		echo "</tbody>";
		echo "</table>";
		if (array_key_exists('footertitle', $_SESSION))
			MasterView::showFooter();
	}
	
	public static function showDetails() {
		$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
		$userReviews = (array_key_exists('userReviews', $_SESSION))?
		                $_SESSION['userReviews']:array();
		$userSubmissions = (array_key_exists('userSubmissions', $_SESSION))?
		                $_SESSION['userSubmissions']:array();
		if (is_null($user)) 
			echo '<p>Unknown user<p>';
		else {
			echo '<h1>Dashboard for '. $user->getUserName().'</h1>';
		    echo '<section><h2>My submissions</h2>';
		    echo '<ul>';
		    foreach ($userSubmissions as $submission) {
			   echo '<li> Assignment: '.$submission->getAssignmentNumber().'</li>';
		    }
		    echo '</ul></section>';
		    
		    echo '<section><h2>My reviews</h2>';
		    echo '<ul>';
		    foreach ($userReviews as $review) {
		    	echo '<li> Submission: '.$review->getSubmissionId().'</li>';
		    }
		    echo '</ul></section>';
		}
	}
}
?>	