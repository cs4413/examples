<?php
class MasterView {
	public static function showHeader() {
        echo '<!DOCTYPE html lang="en"><html><head>';
        echo '<meta charset="utf-8">';
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">';
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">';
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>';
        $base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "";
        $scripts = (array_key_exists('scripts', $_SESSION))? $_SESSION['scripts']: array();
       
        echo '<script src="/mvcjs/js/assign.js"></script>';
//         echo '<script src="/';
//         echo $base;
//         echo '/js/';
//         echo $scripts[0];
//         echo '"></script>';
//         $script = $scripts[0];
//         $base = 'mvcjs';
//         for ($i = 0; $i < count($scripts); $i++) {
//         	echo '<script src="/';
//         	echo $base;
//         	echo '/js/';
//         	echo $scripts[i];
//         	echo '"></script>';
//         }
        //echo '<script scr="/'.$base.'/js/assign.js'. '"></script>';
        //echo '<script scr="/'.$base.'/js/assign.js"></script>';
//         $a = array();
//         foreach ($scripts as $script)  {
//         	array_push($a, $script);
//         	echo '<script scr="/'.$base.'/js/'.$script. '"></script>';
//         }
        $styles = (array_key_exists('styles', $_SESSION))? $_SESSION['styles']: array();
        foreach ($styles as $style ) 
           echo '<link href="/'.$base.'/css/'.$style. '" rel="stylesheet">';
      
        $title = (array_key_exists('headertitle', $_SESSION))? $_SESSION['headertitle']: "";
        echo "<title>$title</title>";
        echo "</head><body>";

    }

    public static function showNavBar() {
    	// Show the navbar
    	$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "";
    	$authenticatedUser = (array_key_exists('authenticatedUser', $_SESSION))? 
    	                 $_SESSION['authenticatedUser']:null;
    	$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
    	echo '<nav class="navbar navbar-inverse navbar-fixed-top">';
    	echo '<div class="container-fluid">';
    	echo '<div class="navbar-header">';
    	echo '<button type="button" class="navbar-toggle collapsed"';
    	echo 'data-toggle="collapse" data-target="#navbar"';
    	echo 'aria-expanded="false" aria-controls="navbar">';
    	echo '<span class="icon-bar"></span>';
    	echo '<span class="icon-bar"></span>';
    	echo '<span class="icon-bar"></span>';
    	echo '</button>';
    	echo '<a class="navbar-brand" href="/'.$base.'/">ClassBash</a>';
    	echo '</div>';
    	echo '<div id="navbar" class="navbar-collapse collapse">';
    	echo '<ul class="nav navbar-nav">';
    	if (!is_null($authenticatedUser))
    	   echo '<li class="active"><a href="/'.$base.'/user/show/'.
    	         $authenticatedUser->getUserId().'">Dashboard</a></li>';
    	echo '<li class="dropdown">';
    	echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Examples <span class="caret"></span></a>';
    	echo '<ul class="dropdown-menu">';
    	echo '<li><a href="/'.$base.'/examples/homepage.php">Homepage</a></li>';
    	echo '<li><a href="/'.$base.'/examples/carousel.php">Carousel</a></li>';
    	echo '<li><a href="/'.$base.'/examples/dashboard.php">Dashboard</a></li>';
    	echo '<li><a href="/'.$base.'/examples/form.php">Form</a></li>';
    	echo '<li><a href="/'.$base.'/examples/grid.php">Grid</a></li>';
    	echo '</ul>';
    	echo '</li>';
    	echo '</ul>';
    	if (!is_null($authenticatedUser)) {
    		echo '<form class="navbar-form navbar-right"
    			    method="post" action="/'.$base.'/logout">';
    		echo '<div class="form-group">';
    		echo '<span class="label label-default">Hi '.
    		          $authenticatedUser->getUserName().'</span>&nbsp; &nbsp;';
    		echo '</div>';
    		echo '<button type="submit" class="btn btn-success">Sign out</button>';
    		echo '</form>';
    	} else {
	    	echo '<form class="navbar-form navbar-right" 
	    			    method="post" action="/'.$base.'/login">';
	    	echo '<div class="form-group">';
	    	echo '<input type="text" placeholder="User name" class="form-control" name ="userName" ';
	        if (!is_null($user)) 
	   	        echo 'value = "'. $user->getUserName();
	    	echo 'required></div>';
	    	echo '<div class="form-group">';
	    	echo '<input type="password" placeholder="Password" 
	    			      class="form-control" name ="password">';
	    	echo '</div>';
	    	echo '<button type="submit" class="btn btn-success">Sign in</button>';
	    	echo '<a class="btn btn-primary" href="/'.$base.'/user/new" role="button">Register</a></p>';
	    	echo '</form>';

    	}
    	echo '</div>';
    	echo '</div>';
    	echo '</nav>';
    }
    
    public static function showHomeFooter() {
    	echo '<footer>';
    	echo '<p>&copy; Kay Robbins, UTSA 2015</p>';	
    	echo '<div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> and by';
    	echo '<a href="http://www.flaticon.com/authors/bogdan-rosu" title="Bogdan Rosu">';
    	echo 'Bogdan Rosu</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a>';
    	echo 'licensed by <a href="http://creativecommons.org/licenses/by/3.0/"';
    	echo '		title="Creative Commons BY 3.0">CC BY 3.0</a>';
    	echo '</footer>';
    }

	public static function showFooter() {
		$footer = (array_key_exists('footertitle', $_SESSION))?
		           $_SESSION['footertitle']: "";
		echo '<footer>'.$footer.'</footer>';	
    }
		           		
	public static function showPageEnd() { 
       echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>';
       echo '<script src="../../dist/js/bootstrap.min.js"></script>';
       echo '<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>';
       echo '</body></html>';
    }
}
?>