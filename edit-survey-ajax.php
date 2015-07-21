<?php
	require_once('includes/initialize.php');
	
	if( !isset($_GET['status']) )
		return;
		
	if( $_GET['status'] == 'true' )
		enable_survey( $_POST['id'] );
	
	if( $_GET['status'] == 'false')
		disable_survey( $_POST['id'] );


	function enable_survey( $id )
	{ 
		$question = Question::find_by_id( $id );
		$question->is_enabled = 'true';
		$question->update();
		
		echo "Survey enabled successfully...";
	}
	
	
	function disable_survey( $id )
	{
		$question = Question::find_by_id( $id );
		$question->is_enabled = 'false';
		$question->update();
		
		echo "Survey disabled successfully...";
	}

?>