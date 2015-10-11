<?php
class MasterView {
	public static function showHeader($session_info) {
        echo "<!DOCTYPE html><html><head>";
        echo "<title>".$session_info['headertitle']."</title>";
        echo "</head><body>";
    }
    
    public static function showNavBar($session_info) {
    	echo "<nav>";
    	if (array_key_exists('user', $session_info) && !is_null($session_info['user']))
    		echo "Hello " . $session_info['user']->getUserName();
    	echo "</nav>";
    }

	public static function showFooter($session_info) {
		echo $session_info['footertitle'];	
        echo "</body></html>"; 
    }
}
?>