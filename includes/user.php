<?php
	require_once('initialize.php');
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class User extends DatabaseObject
	{
		protected static $class_name = 'user';
		protected static $table_name = 'users';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'id' , 'first_name' , 'last_name' , 'email' , 'password' , 'profile_pic' , 'position' , 'skype_id' ,
											 'linked_url' , 'contact_no' );
		public $id; 
		public $username;
		public $email;
		public $first_name;
		public $last_name;
		public $password;
		public $profile_pic;
		public $position;
		public $skype_id;
		public $linked_url;
		public $contact_no;
		public $file_type;
	
		
		
		public $errors = array();
	
		public $upload_errors = array (
		UPLOAD_ERR_OK => "No errors",
		UPLOAD_ERR_INI_SIZE => "Larger than maximum upload size",
		UPLOAD_ERR_FORM_SIZE => "Larger than maximum file size",
		UPLOAD_ERR_PARTIAL => "Partial upload",
		UPLOAD_ERR_NO_FILE => "No file",
		UPLOAD_ERR_NO_TMP_DIR => "No temp dir",
		UPLOAD_ERR_CANT_WRITE => "Can't write",
		UPLOAD_ERR_EXTENSION => "File stopped by extension"
		);
		
	  	public $temp_path;
		private $upload_dir = "assets/images/profile_pic";
		
		public function get_full_name()
		{
			return $this->first_name . ' ' . $this->last_name;
		}
	 
	    	
			
			public function attach_file($file)
			{

			if(!$file || empty($file) || !is_array($file))
			{
				$this->errors[] = "No files uploaded";
				return false;
			}
			/*elseif($file['error']!=0)
				{
				$this->errors[] = $this->upload_errors[$file['error']];
				return false;
				
				}*/
			else
			{
				$this->temp_path = $file['tmp_name'];
				$this->profile_pic = basename($file['name']);
				$this->file_type = $file['type'];
				$this->size = $file['size'];
				return true;
			}		
		}
		
		public static function find_by_email( $email='' )
		{
			global $database;
			$result_array = static::find_by_sql('select * from ' . static::$table_name . ' where email="'.$email.'"');
			return !empty($result_array) ? array_shift($result_array) : false;
		}

		public function save()
		{
			
			if(isset($this->id))
			{
				if(!empty($this->errors))
					return false;
				if(empty($this->profile_pic) || empty($this->temp_path))
				{
			        echo $this->temp_path;
					$this->errors[] = "The file location was not available";
					return false;
				}

				$target_path = SITE_ROOT.DS.$this->upload_dir.DS.$this->profile_pic;
			
				if(file_exists($target_path))
				{	
					$this->errors[]="The file {$this->profile_pic} already exists. \nPlease choose different name and try again.";
					return false;
				}


				if(move_uploaded_file($this->temp_path,$target_path))
				{
					if($this->update())
					{
						unset($this->temp_path);
						return true;
					}
				}	
				else
				{
					$this->errors[] = "The file upload failed possibly due to incorrect permissions";
					return false;	
				}
			
			}
			return true;
		}
		
	    
		public static function authenticate( $email='' ,$password='' )
		{
			global $database;
			$email = $database->escape_value( $email );
			$password = $database->escape_value( $password );
			
			$sql = "select * from users where email='" . $email . "' and password='" . $password . "';";
			
			$result_array = self::find_by_sql( $sql );
			return !empty($result_array) ? array_shift($result_array) : false;
			
		}
		
		//Count unreaded message(From 'inbox' table)...
		public static function count_unread_messages( $user_id=0 )
		{
			global $database;
			$sql = 'select COUNT(*) FROM receivers where user_id=' . $user_id . " and is_read='false'";
			
			$result_set = $database->execute_query( $sql );
			$row = $database->fetch_array( $result_set );
			
			return array_shift( $row );		
		}
		
			public function update_password($user_id, $new_password  )
		{
			global $database;
			$attributes = static::sanitized_attributes();
			$attribute_pairs = array();
			
			foreach( $attributes as $key => $value )
			{
				$attribute_pairs[] = $key."='".$value."'";
			}
			
			$sql  = "UPDATE " . static::$table_name . " SET ";
			$sql .= "password='" . $new_password . "' "; 
			$sql .= "WHERE id=" . $user_id;
			
			echo "SQL:" . $sql . "<br />";
			
			$database->execute_query( $sql );
			return ( $database->affected_rows() == 1 ) ? true : false;
						
		}
		
		
	}	//End of class 'User'...

?>