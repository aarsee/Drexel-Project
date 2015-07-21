<?php 
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class Question extends DatabaseObject
	{
		protected static $class_name = 'question';
		protected static $table_name = 'questions';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'question_id' , 'question_content' , 'creator_id' , 'is_enabled' , 'topic' , 'description');
		public $question_id; 
		public $question_content; 
		public $creator_id;
		public $is_enabled;
		public $topic;
		public $description;
      
	    

		
		//Overrided because of diffrent column name...
		public static function find_by_id( $question_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql( 'select * from ' . static::$table_name . ' where question_id='.$question_id );
												
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		
		//To find a perticular message to perticular sender to send it to 'trash' table...
		public static function find_by_question_response( $question_id = 0 , $option_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where option_id="'.$option_id .
												' and question_id="' . $question_id . '"');
							
			//echo 'select * from ' . static::$table_name . ' where id="'.$user_id .
												//'" and sender_id="' . $message_id . '"';
								
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
			$sql .= "WHERE question_id=" . $database->escape_value( $this->question_id ); 
			
			
			$database->execute_query( $sql );
			return ( $database->affected_rows() == 1 ) ? true : false;
						
		}
		
		//Returns the data (0-30)...
		public function get_date()
		{
			
		}
		
	}	//End of class 'Message'...

?>
