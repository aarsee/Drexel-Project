<?php
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class UserStorage extends DatabaseObject
	{
		protected static $class_name = 'userstorage';
		protected static $table_name = 'user_storage';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'id' , 'file_name' , 'file_type' , 'size' , 'owner_id');
		public $id; 
		public $file_name;
		public $file_type;
		public $size;
		public $owner_id;
		
		private $temp_path;
		private $upload_dir = "drive";
		private $errors = array();
	
		protected $upload_errors = array (
		UPLOAD_ERR_OK => "No errors",
		UPLOAD_ERR_INI_SIZE => "Larger than maximum upload size",
		UPLOAD_ERR_FORM_SIZE => "Larger than maximum file size",
		UPLOAD_ERR_PARTIAL => "Partial upload",
		UPLOAD_ERR_NO_FILE => "No file",
		UPLOAD_ERR_NO_TMP_DIR => "No temp dir",
		UPLOAD_ERR_CANT_WRITE => "Can't write",
		UPLOAD_ERR_EXTENSION => "File stopped by extension"
		);
	
		public function attach_file($file)
		{

			if(!$file || empty($file) || !is_array($file))
			{
				$this->errors[] = "No files uploaded";
				return false;
			}elseif($file['error']!=0)
				{
				$this->errors[] = $this->upload_errors[$file['error']];
				return false;
				}
			else
			{
				$this->temp_path = $file['tmp_name'];
				$this->file_name = basename($file['name']);
				$this->file_type = $file['type'];
				$this->size = $file['size'];
				$this->owner_id = $_SESSION['user_id'];
				return true;
			}		
		}
		


		public function save_with_file()
		{
			if(isset($this->id))
			{
				$this->update();	
			}else
			{
				if(!empty($this->errors))
					return false;
				if(empty($this->file_name) || empty($this->temp_path))
				{
					$this->errors[] = "The file location was not available";
					return false;
				}

			$target_path = SITE_ROOT.DS.$this->upload_dir.DS.$this->file_name;

			
			if(file_exists($target_path))
			{	
				$this->errors[]="The file {$this->filename} already exists";
				return false;
			}


			if(move_uploaded_file($this->temp_path,$target_path))
			{
				if($this->create())
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

		}
}
?>
