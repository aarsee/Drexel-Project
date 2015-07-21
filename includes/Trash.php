<?php
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class Trash extends DatabaseObject
	{
		protected static $class_name = 'trash';
		protected static $table_name = 'trash';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'user_id' , 'message_id' , 'type' );
		public $user_id; 
		public $message_id;
		public $type;

		//Overrided because of column 'user_id' instead of 'id'
		public static function find_by_id( $sid=0 )
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where user_id="'.$sid.'"');
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		//To find a perticular message to perticular receiver to set 'is_read'=true...
		public static function find_by_user_msg( $user_id = 0 , $message_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where user_id="'.$user_id .
												'" and message_id="' . $message_id . '"');
												
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		//Overrided...
		public function create()
		{
			global $database;
			$attributes = static::sanitized_attributes();
			
			$sql  = "INSERT into " . static::$table_name . " ( ";
		 	$sql .= join( ", " , array_keys( $attributes ) );
			$sql .= " ) VALUES ( '";
		 	$sql .= join( "', '" , array_values($attributes) );
			$sql .= "')";
			
			echo $sql; 
			
			if( $database->execute_query( $sql ) )
			{
				$this->id = $database->insert_id();
				//log_action( 'Register' , 'New registration : '.$this->first_name );
				return true;
			}
			else
				return false;
			
		}
		
		//Override...
		//As there is no 'id' column for where clause...
		public function delete()
		{
			
			global $database;
			
			$sql =  "DELETE from " . static::$table_name . " ";
			$sql .= "WHERE user_id=" . $database->escape_value( $this->user_id ) . " ";
			$sql .= "AND message_id=" . $database->escape_value( $this->message_id ) . " ";
			$sql .= "LIMIT 1";
			
			$database->execute_query( $sql );
			
			return ($database->affected_rows() == 1 ) ? true : false;
		}

	}	//End of class 'Inbox'...

?>
