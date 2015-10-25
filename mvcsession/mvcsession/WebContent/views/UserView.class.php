<?php  
class UserView {
	public static function show() {
		$_SESSION['headertitle'] = "User details";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		
		UserView::showDetails();
		$_SESSION['footertitle'] ="<h3>The footer goes here</h3>";
        MasterView::showFooter();
	}
	
	public static function showAll() {
		// Show all user objects on own page
		$_SESSION['headertitle'] = 'List of users';
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		UserView::showAllDetails();
		$_SESSION['footertitle'] ='<h3>Users list footer</h3>';
		MasterView::showFooter();
	}
	
	public static function showAllDetails() {
		// Show a table of users with links
		$users = (array_key_exists('users', $_SESSION))?$_SESSION['users']:array();
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		
		echo '<div class="container">';
		echo '<h1>List of users</h1>';
		echo '<div class="table-responsive">';
		echo '<table class="table table-striped">';
		echo '<thead>';
		echo '<tr><th>User Id</th><th>User name</th> <th>Show</th><th>Update</th></tr>';
		echo '</thead>';
		echo '<tbody>';
	
		foreach($users as $user) {
			echo '<tr>';
			echo '<td>'.$user->getUserId().'</td>';
			echo '<td>'.$user->getUserName().'</td>';
			echo '<td><a href="/'.$base.'/user/show/'.$user->getUserId().'">Show</a></td>';
			echo '<td><a href="/'.$base.'/user/update/'.$user->getUserId().'">Update</a></td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
        echo '</div>';
	}
	
	public static function showDetails() {
		$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
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
			   echo '<li> <a href = "/'.$base.'/submission/show/'. 
			                      $submission->getAssignmentNumber().'">Submission '.
			                      $submission->getAssignmentNumber().'</a></li>';
		    }
		    echo '</ul></section>';
		    
		    echo '<section><h2>My reviews</h2>';
		    echo '<ul>';
		    foreach ($userReviews as $review) {
		    	echo '<li> <a href = "/'.$base.'/review/show/'. 
			               $review->getReviewId().'">Review of assignment '.
			               $submission->getAssignmentNumber().'</a></li>';
		    }
		    echo '</ul></section>';
		}
	}
	public static function showNew() {
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		$base = (array_key_exists ( 'base', $_SESSION )) ? $_SESSION ['base'] : "";
		$_SESSION ['headertitle'] = "New user registration";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		
		echo '<div class="container">';
		echo '<h1 class ="page-header">'.$_SESSION['headertitle'].'</h1>';
		echo "</div>";
		
		echo '<div class="container">';

		if (!is_null($user) && $user->getErrors() > 0) {
			$errors = $user->getErrors();
			foreach($errors as $key => $value)
				echo $value . "<br>";
		}
		echo '</div>';
		
		echo '<form role="form" action ="/' . $base . '/user/new" method="Post">';
		
		echo '<div class="form-group">';
        echo '<label for="userName">User name:</label>';
        echo '<input type="text" name ="userName" id = "reviewerName"';
		if (! is_null ($user))
			echo 'value = "' . $user->getUserName () . '"';
		echo '><span class="error">';
		if (! is_null ( $user ))
			echo $user->getError ( 'userName' );
		echo '</span></p>';
		echo '</div>';
		
		echo '<div class="form-group">';
		echo '<label for="password">Password:</label>';
		echo '<input type="text" id = "password" name ="password"><span class="error">';
		if (! is_null ( $user ))
			echo $user->getError ( 'password' );
		echo '</span>';
		echo '</div>';
		
		echo '<button type="submit" class="btn btn-default">Submit</button>';
	    echo '</form>';
        echo '</div>';
        $_SESSION['footertitle'] = "<h3>User registration footer</h3>";
        MasterView::showFooter();
	}	
	
	public static function showUpdate() {
		$users = (array_key_exists('users', $_SESSION))?$_SESSION['users']:null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
				$_SESSION['headertitle'] = "ClassBash User Update";
		MasterView::showHeader();
		echo '<h1>ClassBash user update</h1>';
		if (is_null($users) || empty($users) || is_null($users[0])) {
			echo '<section>users does not exist</section>';
			return;
		}
		$user = $users[0];
		if ($user->getErrors() > 0) {
			$errors = $user->getErrors();
			echo '<section><p>Errors:<br>';
			foreach($errors as $key => $value)
				echo $value . "<br>";
			echo '</p></section>';
		}

		echo '<section><form method="Post" action ="/'.$base.
		            '/user/update/'.$user->getUserId().'">';
		echo '<p>User name: <input type="text" name ="userName"';
		if (!is_null($user))
			echo 'value = "'. $user->getUserName() .'"';
		echo '><span class="error">';
		if (!is_null($user))
			echo $user->getError('userName');
		echo '</span></p>';
		
		echo '<p>Password: <input type="text" name ="password"><span class="error">';
		if (!is_null($user))
			echo $user->getError('password');
		echo '</span></p>';
		
		echo '<input type="submit" value="Submit" />';
		echo '</form></section>';
		$_SESSION['footertitle'] = "The footer";
		MasterView::showFooter();
	}
}
?>	