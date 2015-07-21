<?php 

	require_once('includes/initialize.php');
	
	if( ! isset( $_REQUEST['event'] ) )
	{
		//Start date...
		$xplode = explode( " " , $_REQUEST['start'] );
		$string_start = $xplode[3] . "-" . $xplode[1] . "-" . $xplode[2] . " " . $xplode[4];
		$date_start = date("Y-m-d H:i:s" , strtotime($string_start) );
		
		//End date...
		$xplode = explode( " " , $_REQUEST['start'] );
		$string_end = $xplode[3] . "-" . $xplode[1] . "-" . $xplode[2] . " " . $xplode[4];
		$date_end = date("Y-m-d H:i:s" , strtotime($string_end) );
		
		
		$new_schedule = new UserSchedule();
		$new_schedule->user_id = $_SESSION['user_id'];	
		$new_schedule->start_time = $date_start;
		$new_schedule->data = $_REQUEST['data'];
		$new_schedule->allDay = $_REQUEST['allDay'];
		$new_schedule->end_time = $date_end;
		$new_schedule->background = $_REQUEST['color'];
		$new_schedule->create();
	
		echo $date_start;
	}
	else
	{
		//Start date...
		$xplode = explode( " " , $_REQUEST['start'] );
		$string_start = $xplode[3] . "-" . $xplode[1] . "-" . $xplode[2] . " " . $xplode[4];
		$date_start = date("Y-m-d H:i:s" , strtotime($string_start) );
		
		//End date...
		$xplode = explode( " " , $_REQUEST['end'] );
		$string_end = $xplode[3] . "-" . $xplode[1] . "-" . $xplode[2] . " " . $xplode[4];
		$date_end = date("Y-m-d H:i:s" , strtotime($string_end) );
		
		
		$new_schedule = new UserSchedule();
		$new_schedule->id = $_REQUEST['id'];
		$new_schedule->user_id = $_SESSION['user_id'];	
		$new_schedule->start_time = $date_start;
		$new_schedule->data = $_REQUEST['data'];
		$new_schedule->allDay = $_REQUEST['allDay'];
		$new_schedule->end_time = $date_end;
		$new_schedule->background = $_REQUEST['color'];
		$new_schedule->update();
	}
?>