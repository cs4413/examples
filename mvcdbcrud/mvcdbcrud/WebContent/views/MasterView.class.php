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
    	// Show the navbar
    	echo "<nav>";
    	$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
    	if (!is_null($user))
    	   echo "Hello ". $user->getUserName()." <br>";
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