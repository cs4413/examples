<?php  
class UserView {
	public static function show($user) {
		MasterView::showHeader("ClassBash User Page");
		UserView::showDetails($user);
		MasterView::showFooter("<h3>The footer goes here</h3>");
	}
	
	public static function showDetails($user) {
	   echo "I am the user";
	}
}
?>	