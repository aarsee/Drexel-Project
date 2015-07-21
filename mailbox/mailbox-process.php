<?php
	/* READ ME
		This page is for updating tables for :
			1. Mark as read to incoming(inbox) message.
			2. Delete an inbox message(inbox) message.
			
			3. Delete an sent message message.
			
			4. Delete a message permanently(from trash table).
			
		Variables :
			1. action => Indicates the action :
				 i. delete
				ii. mark_as_read
			2. page   => Indicates the previous page :
				  i. inbox.php
				 ii. sent.php
			  	iii. trash.php 
	*/
?>

<?php
	require_once('../includes/initialize.php');
?>

<?php
	//Check and get the request...		(Either 'delete' of 'mark_as_read')
	if( isset( $_REQUEST['action'] ) && isset( $_REQUEST['page'] ) )
	{
		$action = $_REQUEST['action'];
		$page = $_REQUEST['page'];
	}
	else
		redirect_to('../extra-404');
?>

<?php
	//Process the 'action'...
	if( $action != 'send' )
		$selected_message_ids = $_REQUEST['checkboxes'];
	
	$trash_message = new Trash();
	
	if( $action == 'delete' )
	{
		//Inbox -> delete...
		if( $page == 'inbox' )
		{
			foreach( $selected_message_ids as $message_id )
			{
				$message_to_delete = Receiver::find_by_user_msg( $_SESSION['user_id'] , $message_id );
	
				//echo ".".$trash_message->user_id . ".";
				$trash_message->user_id = $message_to_delete->user_id;
				$trash_message->message_id = $message_to_delete->message_id;
				$trash_message->type = $page;
				$trash_message->create();
				
				//Delete message from INBOX now...
				$message_to_delete->delete();
			}
		}
		//Sent -> delete...
		else if( $page == 'sent' )
		{
			foreach( $selected_message_ids as $message_id )
			{
				//Fetch and update the 'is_deleted' column to virtually delete the message to the user's sentbox...
				$message_to_delete_virtualy = Message::find_by_user( $message_id );
				
				//echo $message_to_delete->id . " " . $message_to_delete->sender_id . " " . $message_to_delete->is_deleted . "<br />";
				//Delete VIRTUALLY if not deleted...
				//if( $message_to_delete_virtualy->is_deleted == 'false' )
				{
					//Delete message virtually from sent...
					$message_to_delete_virtualy->is_deleted = 'true';
					$message_to_delete_virtualy->update();
					
					// Can use $message_to_delete_virtualy->sender_id for 1st argument...
					$message = Message::find_by_user_msg( $message_to_delete_virtualy->id  , $_SESSION['user_id']);
					
					//$trash_message = new Trash();
					$trash_message->user_id = $message->sender_id; 
					$trash_message->message_id = $message->id;
					$trash_message->type = $page;	// 'sent'...
					$trash_message->create();
				}
			}//foreach	
		}
		//Trash -> delete...
		else if( $page == 'trash' )
		{
			foreach( $selected_message_ids as $message_id )
			{
				//Fetch and delete the entry from trash table...
				//It will remove the message permanantly from 'this' user's perspective...
				//But it will be stored in 'Messages' table for others...
				$message_to_remove = Trash::find_by_user_msg( $_SESSION['user_id'] , $message_id );
				$message_to_remove->delete();
				
				
			}//foreach...
		}
	}
	else if( $action == 'mark_as_read' )	
	{
		//for( $i=0 ; $i<count($selected_messages) ; $i++ )
		foreach( $selected_message_ids as $message_id )
		{
			$message = Receiver::find_by_user_msg( $_SESSION['user_id'] , $message_id );
			
			//Avoid 
			if( $message->is_read == 'false' )
			{
				$message->is_read = 'true';
				$message->update();
			}
		}
	}
	else if( $action == 'recover' )
	{
		foreach( $selected_message_ids as $message_id )
		{
			//Fetch the entry from 'trash' table...
			$message_to_remove = Trash::find_by_user_msg( $_SESSION['user_id'] , $message_id );
			
			//See from where it came... (type = inbox|sent)
			$type = ($message_to_remove->type == 'inbox') ? 'inbox' : 'sent';

			//Add a message entry to 'inbox' table if it is type=inbox...
			if( $type == 'inbox' )
			{
				$receiver = new Receiver();
				$receiver->user_id = $_SESSION['user_id'];
				$receiver->message_id = $message_id;
				$receiver->is_read = 'true';
				$receiver->create();
				print_r( $receiver );
			}
			//Set is_deleted=false in 'messages' table if it is type=sent...
			else if( $type == 'sent' )
			{
				$message = Message::find_by_user_msg( $_SESSION['user_id'] , $message_id );
				$message->is_deleted = 'false';
				$message->update();
			}
			
			//Remove it from 'trash'...
			$message_to_remove->delete();
			
			
		}//foreach...
	}
	else if( $action == 'send' )	//From compose page...
	{
		$message = new Message();
		$message->sender_id = $_SESSION['user_id'];
		$message->subject = $_REQUEST['subject'];
		$message->body = $_REQUEST['body'];
		$message->is_deleted = 'false';
		$message->date_time = date( 'Y-m-d H:i:s' );
		$message->create();
		
		$receiver_emails = explode(",", $_REQUEST['to']);
		foreach( $receiver_emails as $receiver_email )
		{
			$rcvr =  User::find_by_email( trim($receiver_email) );
			$last_message = Message::find_last_email( $receiver_email );
			
			$receiver = new Receiver();
			$receiver->user_id = $rcvr->id;
			$receiver->message_id = $last_message->id;
			$receiver->is_read = 'false';
			$receiver->create();
		}
	}
	
	
	//Action done, redirect bo back page...
	$page_to_return = $_SERVER['HTTP_REFERER'];
	redirect_to( $page_to_return );
	
?>