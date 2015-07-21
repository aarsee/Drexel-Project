<?php
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class Message extends DatabaseObject
	{
		protected static $class_name = 'message';
		protected static $table_name = 'messages';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'id' , 'sender_id' , 'subject' , 'body' , 'date_time' , 'is_deleted' );
		public $id; 
		public $sender_id; 
		public $subject;
		public $body;
		public $date_time;
		public $is_deleted;
		
		
		//To find a perticular message to perticular receiver to set 'is_deleted'=true...
		public static function find_by_user( $user_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql( 'select * from ' . static::$table_name . ' where id='.$user_id );
												
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		
		//To find a perticular message to perticular sender to send it to 'trash' table...
		public static function find_by_user_msg( $user_id = 0 , $message_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where id="'.$message_id .
												'" and sender_id="' . $user_id . '"');
															
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		//Overrided...
		//Because of modified WHERE clause...
		public function update()
		{
			global $database;
			$attributes = static::sanitized_attributes();
			$attribute_pairs = array();
			
			foreach( $attributes as $key => $value )
			{
				$attribute_pairs[] = $key."='".$value."'";
			}
			
			$sql  = "UPDATE " . static::$table_name . " SET ";
			$sql .= join( ", " , $attribute_pairs ) . " ";
			$sql .= "WHERE id=" . $database->escape_value( $this->id ) . " ";
			$sql .= "AND sender_id=" .  $database->escape_value( $this->sender_id ); 
			

			$database->execute_query( $sql );
			return ( $database->affected_rows() == 1 ) ? true : false;
						
		}
		
		public static function find_last_email()
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' order by id DESC');
			return !empty($result_array) ? array_shift($result_array) : false;
		}
	}	//End of class 'Message'...

?>
