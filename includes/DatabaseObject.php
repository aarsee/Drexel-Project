<?php
	//require_once('initialize.php');		Already included...
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class DatabaseObject
	{
		protected static $table_name = '';
		
		public static function find_all()
		{
			return static::find_by_sql('select * from '.static::$table_name );
		}
		
		public static function find_by_id( $sid=0 )
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where id="'.$sid.'"');
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		public static function find_by_sql( $sql='' )
		{
			global $database;
			$result_set = $database->execute_query( $sql );
			
			$object_array = array();
			while( $row = $database->fetch_array( $result_set ) )
			{
				$object_array[] = static::instantiate( $row );
			}
			return $object_array;
		}
				
		
		public static function count_all()
		{
			global $database;
			$sql = 'select COUNT(*) FROM ' . static::$table_name;
			
			$result_set = $database->execute_query( $sql );
			$row = $database->fetch_array( $result_set );
			
			return array_shift( $row );
		}
				
				
		//Get list of sanitized attributes(To prevent SQL Injection)...
		protected  function sanitized_attributes()
		{
			global $database;
			$clean_attributes = array();
			
			foreach( static::attributes() as $key => $value )
				$clean_attributes[$key] = $database->escape_value($value);
			
			return $clean_attributes;	
		}
		
		//List of only those attributes which have respective DATABASE Fields...
		protected  function attributes()
		{
			// Returns array of attribute name(as key) and values...
			$attributes = array();
			foreach( static::$db_fields as $field )
			{
				if( property_exists( static::$class_name , $field) )
					$attributes[$field] = $this->$field;
			}
			
			return $attributes;
		}

		private static function instantiate( $record )
		{
			//Can check for duplicaiton...
			$class_name = get_called_class();
			$object = new $class_name;
			
			foreach( $record as $attribute=>$value )
			{	
				if( $object->has_attribute( $attribute ) )
					$object->$attribute = $value;
			}
			
			return $object;
		}
		
		private function has_attribute( $attribute )
		{
			$object_vars = get_object_vars( $this );
			
			return array_key_exists( $attribute , $object_vars );
		}
		
		public function create()
		{
			global $database;
			$attributes = static::sanitized_attributes();
			
			$sql  = "INSERT into " . static::$table_name . " ( ";
		 	$sql .= join( ", " , array_keys( $attributes ) );
			$sql .= " ) VALUES ( '";
		 	$sql .= join( "', '" , array_values($attributes) );
			$sql .= "')";
			
			if( $database->execute_query( $sql ) )
			{
				$this->id = $database->insert_id();
				//log_action( 'Register' , 'New registration : '.$this->first_name );
				return true;
			}
			else
				return false;
			
		}
		
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
			$sql .= "WHERE id=" . $database->escape_value( $this->id );
		
			
			$database->execute_query( $sql );
			return ( $database->affected_rows() == 1 ) ? true : false;
						
		}
		
		public function delete()
		{
			global $database;
			
			$sql =  "DELETE from " . static::$table_name . " ";
			$sql .= "WHERE id=" . $database->escape_value( $this->id ) . " ";
			$sql .= "LIMIT 1";
			
			$database->execute_query( $sql );
			
			return ($database->affected_rows() ==1 ) ? true : false;
		}
		
		public static function find_last_recs( $limit )
		{
			return static::find_by_sql('select * from '.static::$table_name . ' order by id desc limit ' . $limit );
		}
				
	}	// End of class...

	
?>