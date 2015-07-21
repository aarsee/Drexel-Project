<?php
	require_once('includes/initialize.php');
	
	
	$delete_user = User::find_by_id( $_GET['id'] );
	
	$delete_user->delete();
	
	redirect_to( $_SERVER['HTTP_REFERER'] );
?>	