<?php
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class SurveyData extends DatabaseObject
	{
		protected static $class_name = 'SurveyData';
		protected static $table_name = 'survey_data';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'respondent_id' , 'question_id' , 'option_id' );
		public $respondent_id; 
		public $question_id; 
		public $option_id;

		
		
		//To find a perticular message to perticular receiver to set 'is_deleted'=true...
		public static function find_by_user( $user_id = 0 )
		{
			global $database;
			$result_array = static::find_by_sql( 'select * from ' . static::$table_name . ' where respondent_id='.$user_id );
												
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		
		//To find a perticular message to perticular sender to send it to 'trash' table...
		public static function find_by_question_response( $question_id = 0 , $respondent_id = 0 )
		{
			global $database;
 			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where respondent_id='.$respondent_id .
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
