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
    	if (array_key_exists('user', $_SESSION) && !is_null($_SESSION['user']))
    		echo "Hello " . $_SESSION['user']->getUserName();
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