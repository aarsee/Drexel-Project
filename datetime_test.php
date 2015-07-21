<?php

	$my_date =  date("Y-m-d H:i:s");
	echo "Date : " . $my_date  . "<br />";
	
	print_r( getdate( date("Y-m-d H:i:s") ) );
	
	echo "<br /><br /><br />";
	
	$date = time();
	$mysql_time = strftime("%Y-%m-%d %H:%M:%S" , $date);
	$mysql_date = strftime("%d" , $date);
	
	echo $mysql_time . "<br />" . $mysql_date;
?>