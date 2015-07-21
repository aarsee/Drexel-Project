<?php

	defined('DS') ? null : define('DS' , DIRECTORY_SEPARATOR );
	
	defined('SITE_ROOT') ? null :
		define('SITE_ROOT' , DS .'opt'. DS.'lampp' . DS . 'htdocs' . DS . 'lls');
	
	defined('LIB_PATH') ? null :
		define('LIB_PATH' , SITE_ROOT.DS.'includes' );
	
	defined('SITE_NAME') ? null :
		define('SITE_NAME' , 'LLSCT' );
		
	defined('FOOTER') ? null :
		define('FOOTER' , '&copy 2014. Leukemia & Lymphoma Society ' );
	
	
	require_once( LIB_PATH.DS.'config.php' );
	require_once( LIB_PATH.DS.'functions.php' );
	require_once( LIB_PATH.DS.'MySQLDatabase.php' );
	require_once( LIB_PATH.DS.'DatabaseObject.php' );
	require_once( LIB_PATH.DS.'Pagination.php' );
	require_once( LIB_PATH.DS.'user.php' );
	require_once( LIB_PATH.DS.'Receiver.php' );
	require_once( LIB_PATH.DS.'question.php' );
	require_once( LIB_PATH.DS.'Option.php' );
	require_once( LIB_PATH.DS.'SurveyData.php' );
	require_once( LIB_PATH.DS.'Session.php' );
	require_once(LIB_PATH.DS.'UserStorage.php');
	require_once(LIB_PATH.DS.'UserSchedule.php');
	require_once(LIB_PATH.DS.'Trash.php');
	require_once(LIB_PATH.DS.'envolve_api_client.php');
	
	


	/*
	// Not to display Generic Error/Warnigs...
	// Do NOT uncomment this before hosting...
	
	error_reporting(E_ALL); 
	ini_set('log_errors','1'); 
	ini_set('display_errors','0'); 
	*/
	


?>
