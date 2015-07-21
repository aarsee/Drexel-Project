<?php
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class Receiver extends DatabaseObject
	{
		protected static $class_name = 'receiver';
		protected static $table_name = 'receivers';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'user_id' , 'message_id' , 'is_read' );
		public $user_id; 
		public $message_id;
		public $is_read;

		public static function is_msg_read( $user_id , $message_id )
		{
			$sql = "select is_read from " . self::$table_name ." where user_id=" . $user_id . " and message_id=" . $message_id . ";";
			
			$result_array = self::find_by_sql( $sql );
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		
		//To find all receivers of a perticular message...
		public static function find_by_message_id( $message_id = 0 )
		{
			global $database;
			return static::find_by_sql('select * from ' . static::$table_name . ' where message_id=' . $message_id);
				
			//return !empty($result_array) ? array_shift($result_array) : false;								
			//return $result_array;
		}
		
		//To find a perticular message to perticular receiver to set 'is_read'=true...
		public static function find_by_user_msg( $user_id = 0 , $message_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where message_id="' . $message_id . '"');
												
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		//Override...
		//As there is no 'id' column for whare clause...
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
			//$sql .= "WHERE id=" . $database->escape_value( $this->id );			<==== This is modification...
			$sql .= "WHERE user_id=" . $database->escape_value( $this->user_id ) . " ";
			$sql .= "AND message_id=" . $database->escape_value( $this->message_id );
			
			$database->execute_query( $sql );
			return ( $database->affected_rows() == 1 ) ? true : false;
						
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
