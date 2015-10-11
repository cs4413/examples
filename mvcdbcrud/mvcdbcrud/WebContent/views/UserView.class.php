<?php  
class UserView {
	public static function show($sessionInfo) {
		MasterView::showHeader("ClassBash User Page");
		UserView::showDetails($sessionInfo);
		MasterView::showFooter("<h3>The footer goes here</h3>");
	}
	
	public static function showDetails($sessionInfo) {
	   echo "I am the user";
	}
}
?>	