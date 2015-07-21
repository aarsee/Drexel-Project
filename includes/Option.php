<?php
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class Option extends DatabaseObject
	{
		protected static $class_name = 'option';
		protected static $table_name = 'options';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'option_id' , 'question_id' , 'option_content'  );
		public $option_id; 
		public $question_id; 
		public $option_content;
		
		
		
		//To find a perticular message to perticular receiver to set 'is_deleted'=true...
		public static function find_by_user( $user_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql( 'select * from ' . static::$table_name . ' where option_id='.$user_id );
												
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		public static function find_by_question( $question_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql( 'select * from ' . static::$table_name . ' where question_id='.$question_id );
												
			return !empty($result_array) ? $result_array : false;
		}
		
		
		
		//To find a perticular message to perticular sender to send it to 'trash' table...
		public static function find_by_option_question( $option_id = 0 , $question_id = 0 )
		{
			global $database;

			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where option_id='.$option_id .
												 ' and question_id ='.$question_id );
							
						
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
		
		//Returns the data (0-30)...
		public function get_date()
		{
			
		}
		
	}	//End of class 'Message'...

?>
