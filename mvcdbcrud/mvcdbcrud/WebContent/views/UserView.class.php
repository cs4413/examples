<?php  
class UserView {
	public static function show($sessionInfo) {
		MasterView::showHeader($sessionInfo);
		UserView::showDetails($sessionInfo);
		MasterView::showFooter($sessionInfo);
	}
	
	public static function showDetails($sessionInfo) {
	   echo "I am the user";
	}
}
?>	