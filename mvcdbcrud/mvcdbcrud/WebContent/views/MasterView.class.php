<?php
class MasterView {
	public static function showHeader($sessionInfo) {
        echo "<!DOCTYPE html><html><head>";
        $title = (array_key_exists('headertitle', $sessionInfo))?
                  $sessionInfo['headertitle']: "";
        echo "<title>$title</title>";
        echo "</head><body>";
    }
    
    public static function showNavBar($sessionInfo) {
    	echo "<nav>";
    	if (array_key_exists('user', $sessionInfo) && !is_null($sessionInfo['user']))
    		echo "Hello " . $sessionInfo['user']->getUserName();
    	echo "</nav>";
    }

	public static function showFooter($sessionInfo) {
		$footer = (array_key_exists('footertitle', $sessionInfo))?
		           $sessionInfo['footertitle']: "";
		echo $footer;	
        echo "</body></html>"; 
    }
}
?>