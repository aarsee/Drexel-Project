<?php
	require_once(LIB_PATH.DS.'MySQLDatabase.php');
	
	class UserSchedule extends DatabaseObject
	{
		protected static $class_name = 'userschedule';
		protected static $table_name = 'user_schedules';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'id' , 'user_id' , 'data' , 'start_time' , 'end_time' , 'allDay' , 'background' );
		public $id; 
		public $user_id;
		public $data;
		public $start_time;
		public $end_time;
		public $allDay;
		public $background;
		
		
		public static function find_by_user_id( $uid=0 )
		{
			global $database;
			$sql = 'select * from user_schedules';
			$result_array = static::find_by_sql( $sql );
			echo $sql . "<br />";
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
	}	//End of class 'User_Schedule'...

?>