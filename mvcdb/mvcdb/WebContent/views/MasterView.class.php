<?php
class MasterView {
	public static function showHeader($title) {
		if (is_null($title))
			$title = "";	
?>	 	
     <!DOCTYPE html>
     <html>
     <head>
     <title><?php echo $title; ?></title>
     </head>
     <body>
<?php  
     }

	public static function showFooter($footer) {
		if (!is_null($footer))
			echo $footer;	
?>	 	
    </body>
    </html>
 <?php  
     }
}
?>