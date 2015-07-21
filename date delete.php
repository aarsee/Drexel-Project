<?php
	
		require_once('includes/initialize.php');
		
		$message = Message::find_by_id( 21 );
		
		$xplode = explode( " " , $message->date_time );
		print_r( $xplode );
		
		echo "<br /><br />";
		$string_end = $xplode[0];
		$date_end = date("F-d" , strtotime($string_end) )   . " " . date("H:i" , strtotime($xplode[1]) );
		echo "<be />" . $date_end;
?>