<?php  
class UserView {
	public static function show() {
		$_SESSION['headertitle'] = "User details";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showDetails();
		$_SESSION['footertitle'] ="<h3>User footer</h3>";
        MasterView::showFooter();
	}
	
	public static function showAll() {
		// Show all user objects on own page
		$_SESSION['headertitle'] = 'List of users';
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showAllDetails();
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
			return;
		echo '<div class = "container">';
		echo '<h1>Dashboard for '. $user->getUserName().'</h1>';
	    echo '<section><h2>My submissions</h2>';
	    echo '<ul>';
	    foreach ($userSubmissions as $submission) {
		   echo '<li> <a href = "/'.$base.'/submission/show/'. 
		                      $submission->getAssignmentId().'">Submission '.
		                      $submission->getAssignmentId().'</a></li>';
	    }
	    echo '</ul></section>';
	    
	    echo '<section><h2>My reviews</h2>';
	    echo '<ul>';
	    foreach ($userReviews as $review) {
	    	echo '<li> <a href = "/'.$base.'/review/show/'. 
		               $review->getReviewId().'">Review of assignment '.
		               $submission->getAssignmentId().'</a></li>';
	    }
	    echo '</ul></section>';
	    echo '</div>';
	}
	
	public static function showNew() {
	    // Create a new user page
		$_SESSION ['headertitle'] = "New user registration";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showNewDetails();
		$_SESSION['footertitle'] = "<h3>New user footer</h3>";
		MasterView::showFooter();
	}
		
	public static function showNewDetails() {
		$user = (array_key_exists ( 'user', $_SESSION )) ? $_SESSION ['user'] : null;
		$base = (array_key_exists ( 'base', $_SESSION )) ? $_SESSION ['base'] : "";
		
		echo '<div class="container-fluid">';
	    echo '<div class="row">';
	    echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
	    echo '<div class="col-md-6 col-sm-8 col-xs-10">';
	    echo '<h1>'.$_SESSION['headertitle'].'</h1>';
		echo '<form role="form" action ="/' . $base . '/user/new" method="Post">';

		// Error at the top of the form
		if (!is_null($user) && !empty($user->getError('userId'))) {
			echo  '<div class="form-group">';
			echo  '<label><span class="label label-danger">';
			echo  $user->getError('userId');
			echo '</span></label></div>';
		}
		echo '<div class="form-group">'; // User name
		echo '<label for="userName">User name:';
		echo '<span class="label label-danger">';
		if (!is_null($user))
			echo $user->getError('userName');
		echo '</span></label>';
		echo '<input type="text" class="form-control" id = "userName" name="userName"';
		if (!is_null($user))
			echo 'value = "'. $user->getUserName() .'"';
		echo 'required>';
		echo '</div>';
		
		echo '<div class="form-group">'; // User name
		echo '<label for="password">Password:';
		echo '<span class="label label-danger">';
		if (!is_null($user))
			echo $user->getError('password');
		echo '</span></label>';
		echo '<input type="text" class="form-control" id = "password" name="password"';
		if (!is_null($user))
			echo 'value = "'. $user->getPassword() .'"';
		echo 'required>';
		echo '</div>';
		
		echo '<div class="form-group">'; // User name
		echo '<label for="passwordRetry">Retype password:';
		echo '<span class="label label-danger">';
		if (!is_null($user))
			echo $user->getError('password');
		echo '</span></label>';
		echo '<input type="text" class="form-control" id = "passwordRetry" name="passwordRetry"';
		if (!is_null($user))
			echo 'value = "'. $user->getPasswordRetry() .'"';
		echo 'required readonly>';
		echo '</div>';
		
		echo '<button type="submit" class="btn btn-default">Submit</button>';
		echo '</form>';
		echo '</div>';
		echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
		echo '</div>';
		echo '</div>';
	}	
	
	public static function showUpdate() {
		$_SESSION['headertitle'] = "Update user";
		$_SESSION['styles'] = array('Jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showUpdateDetails();
		$_SESSION['footertitle'] = "The user update footer";
		MasterView::showFooter();
	}
	
	public static function showUpdateDetails() {
		$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
	
		echo '<div class="container-fluid">';
	    echo '<div class="row">';
	    echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
	    echo '<div class="col-md-6 col-sm-8 col-xs-10">';
	    echo '<h1>'.$_SESSION['headertitle'].'</h1>';
   	    if (is_null($user)) {
	       echo '<section>User does not exist</section>';
		   return;
	    }
		echo '<form role="form" method="Post" action ="/'.$base.
		            '/user/update/'.$user->getUserId().'">';
		// Error at the top of the form
		if (!is_null($user) && !empty($user->getError('userId'))) {
			echo  '<div class="form-group">';
			echo  '<label><span class="label label-danger">';
			echo  $user->getError('userId');
			echo '</span></label></div>';
		}
		echo '<div class="form-group">'; // User name
		echo '<label for="userName">User name:';
		echo '<span class="label label-danger">';
		if (!is_null($user))
			echo $user->getError('userName');
		echo '</span></label>';
		echo '<input type="text" class="form-control" id = "userName" name="userName"';
		if (!is_null($user))
			echo 'value = "'. $user->getUserName() .'"';
		echo 'required>';
		echo '</div>';
		
		echo '<div class="form-group">'; // User name
		echo '<label for="password">Password:';
		echo '<span class="label label-danger">';
		if (!is_null($user))
			echo $user->getError('password');
		echo '</span></label>';
		echo '<input type="text" class="form-control" id = "password" name="password"';
		echo 'required>';
		echo '</div>';
		
		echo '<div class="form-group">'; // User name
		echo '<label for="passwordRetry">Retype password:';
		echo '<span class="label label-danger">';
		if (!is_null($user))
			echo $user->getError('password');
		echo '</span></label>';
		echo '<input type="text" class="form-control" id = "passwordRetry" name="passwordRetry"';
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
?>	