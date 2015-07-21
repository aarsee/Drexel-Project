<?php

	require_once(LIB_PATH.DS.'config.php');
	
	
	$DB_SERVER = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
	$DB_NAME = 'lls';
	
	
	class MySQLDatabase {
		
		private $connection;
		protected $last_query;
		private $magic_quotes_status;
		private $mysql_real_escape_string_exists;

		public function __construct($server='' , $user='' , $pass='' , $database='') {
			$this->open_connection( $server , $user , $pass , $database );
			
			$this->magic_quotes_status = get_magic_quotes_gpc();
			$this->mysql_real_escape_string_exists = function_exists( 'mysql_real_escape_string' );
			
		}
		
		// Function to open connnection and select the database...
		public function open_connection( $DB_SERVER , $DB_USER , $DB_PASS , $DB_NAME ) 
		{
			$this->connection = mysql_connect( $DB_SERVER , $DB_USER , $DB_PASS )
					or die ('Server connection failed : '.mysql_error() );
			
			//Select the database...
			$db_select = mysql_select_db( $DB_NAME , $this->connection )  								
							or die('Databse selection feilded : '.mysql_error() );	
		}
		
		//Function to close the Database connection...
		public function close_connection() 
		{
			if( isset($this->connection ) ) {
				mysql_close( $this->connection );
				unset($this->connection );
			}
		}
		
		public function execute_query( $sql='' )
		{		
			$this->last_query = $sql;
			$result = mysql_query( $sql , $this->connection );
			$this->confirm_result( $result );
			return $result;
		}
		
		private function confirm_result( $result )
		{
			if( !$result )
			{
				$disp_error = '<strong>Database query failed : </strong>'.mysql_error().'<br />';
				$disp_error .= '<strong>Last Query was : </strong>'.$this->last_query . "<br />";

				die( $disp_error );
			}

		}
		
		public function escape_value( $value )
		{
			
			if( $this->mysql_real_escape_string_exists )
			{
				if( $this->magic_quotes_status )
					$value = stripslashes( $value );
					
				$value = mysql_real_escape_string( $value );
			}
			else
			{
				if( ! $this->magic_quotes_status )
					$value = addslashes( $value );

				$value = mysql_real_escape_string( $value );
			}
			return $value;
		}
		
		public function fetch_array( $result_set )
		{
			return mysql_fetch_array( $result_set );
		}
		
		public function num_rows( $result_set )
		{
			mysql_num_rows( $result_set );
		}
		
		public function insert_id() 
		{
			mysql_insert_id( $this->connection );
		}
		
		public function affected_rows()
		{
			mysql_affected_rows( $this->connection );
		}
		
	}		// End of class..
	
	$database = new MySQLDatabase( $DB_SERVER , $DB_USER , $DB_PASS , $DB_NAME );
	
?>