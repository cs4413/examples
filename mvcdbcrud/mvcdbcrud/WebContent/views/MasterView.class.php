<?php
class MasterView {
	public static function showHeader() {
        echo "<!DOCTYPE html><html><head>";
        $title = (array_key_exists('headertitle', $_SESSION))?
                  $_SESSION['headertitle']: "";
        echo "<title>$title</title>";
        echo "</head><body>";
    }
    
    public static function showNavBar() {
    	echo "<nav>";
    	//print_r($_SESSION);
    	$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
    	//if (array_key_exists('user', $_SESSION) && !is_null($_SESSION['user']))
    	//	echo "Hello " . $_SESSION['user']->getUserName();
    	if (is_null($user))
    	   echo "USER: $user <br>";
    	elseif (is_a($user, 'user'))
    		echo $user;
    	else {
    		echo "not a user";
    		print_r($user);
    	}
    	echo "</nav>";
    }

	public static function showFooter() {
		$footer = (array_key_exists('footertitle', $_SESSION))?
		           $_SESSION['footertitle']: "";
		echo $footer;	
        echo "</body></html>"; 
    }
}
?>