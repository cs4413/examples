<?php  
class UserView {
	public static function show() {
		MasterView::showHeader();
		UserView::showDetails();
		MasterView::showFooter();
	}
	
	public static function showDetails() {
	   echo "I am the user";
	}
}
?>	