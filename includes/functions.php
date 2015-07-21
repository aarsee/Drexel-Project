<?php
	include_once('initialize.php');

	function strip_zeros_from_date( $marked_string='' )
	{
		$no_zeros = str_replace('*0' , '' , $marked_string );
		
		$cleared_string = str_replace( '*' , '' , $no_zeros );
		return $cleared_string;
	}
	
	function redirect_to( $location=NULL )
	{
		if( $location != NULL )
		{
			$redirect = "location:".$location;
			echo $redirect;
			header( $redirect );
			exit;
		}
	}

	function __autoload( $class_name )
	{
		$class_name = strtolower( $class_name );
		$path = LIB_PATH.DS.$class_name.'.php';
		
		if( file_exists( $path ) )
			require_once( $path );
		else
			die( 'The file ' . $class_name . '.php could not be found...' );
	}
	
	function log_action( $action , $message='' )
	{
		$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
		
		$new = file_exists( $logfile ) ? false : true;
		
		if( $handle = fopen( $logfile , 'a' ) )
		{
			$timestamp = strftime("%d-%m-%Y %H:%M:%S" , time() );
			$content = $timestamp . " Action : " . $action . " => " . $message . "\n";
			
			fwrite( $handle , $content );
			fclose( $handle );
			
			if( $new )
				chmod( $logfile , 0755 );
		}
		else
			echo "Could not open the log file...";
	}

	

?>