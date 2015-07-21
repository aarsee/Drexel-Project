<!DOCTYPE html>
<html lang="en">
<?php
	require_once('../includes/initialize.php');
?>

<?php
	//Load Session details...
	if (! $session->is_logged_in() )
		session_start();
	
	if( ! isset($_SESSION['user_id']) )
		header('location:login.php?msg=Please Log-in first.');
?>

<?php
	//Get user details...
	$user = User::find_by_id( $_SESSION['user_id'] );
?>

<?php
	//Check if 'id' attribute is passed and correct...
	if( isset( $_GET['id'] ) )
	{
		//Get the entire message...
		$message = Message::find_by_id( $_GET['id'] );

		//If not found, return to 'mailbox' page...
		if( ! $message )
			redirect_to('inbox');
			
		//If message gound, find its sender...
		$sender = User::find_by_id( $message->sender_id );
	}
	else
		redirect_to('inbox');
	
	//Check type of mail...		
	//Type = 'inbox'|'sent'|'draft'
	//If it is from 'inbox', mark it as 'read'...
	if( $_GET['type'] == 'inbox' )
	{
		$message_receiver = new Receiver();
		$message_receiver = Receiver::find_by_user_msg( $_SESSION['user_id'] , $_GET['id'] );
		$message_receiver->is_read = 'true';
		
		$message_receiver->update();
	}
?>

<?php
	//Count the no. of unread messages...
	$count = User::count_unread_messages( $user->id );
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>LLSCT | View Message</title>
	

	<link rel="stylesheet" href="../assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="../assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/css/neon-core.css">
	<link rel="stylesheet" href="../assets/css/neon-theme.css">
	<link rel="stylesheet" href="../assets/css/neon-forms.css">
	<link rel="stylesheet" href="../assets/css/custom.css">

	<script src="../assets/js/jquery-1.11.0.min.js"></script>

	<!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
</head>
<body class="page-body" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
	<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.html">
					<img src="../assets/images/logo@2x.png" width="120" alt="" />
				</a>
			</div>
			
						<!-- logo collapse icon -->
						
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
									
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
		</header>
				
		
		
				
		
			<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			
			<li class="active opened active">
				
			<li class="active">
				<a href="inbox">
					<i class="entypo-mail"></i>
					<span>Mailbox</span>
					<span class="badge badge-secondary"><?php echo $count; ?></span>
				</a>
			</li>
			
			<li>
				<a href="extra-calendar">
					<i class="entypo-bag"></i>
					<span>Calendar</span>
				</a>
            	<ul>
					<li>
						<a href="../my-calendar">
							<span>My Calendar</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="../public-calendar">
							<span>Public Calendar</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="../add-user">
					<i class="entypo-user-add"></i>
					<span>Add new User</span>
				</a>
			</li>
			<li>
				<a href="../team-lls">
					<i class="entypo-chart-bar"></i>
					<span>Team LLS</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class="entypo-clipboard"></i>
					<span>Survey</span>
				</a>
				<ul>
					<li>
						<a href="../create-survey">
							<span>Create Survey</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="../list-survey">
							<span>List Survey</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
				</ul>
				<ul>
					<li>
						<a href="../edit-survey">
							<span>Edit Survey</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="../view-response">
							<span>View Responses</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
				</ul>

				
				
				
			</li>
			<!--		May not need this...
			<li>
				<a href="extra-blank-page">
					<i class="entypo-chart-bar"></i>
					<span>About LLS</span>
				</a>
			</li>
			-->
			<li>
				<a href="../about-lls">
					<i class="entypo-feather"></i>
					<span>About LLS Collaboration Tool</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="entypo-flow-tree"></i>
					<span>Document Sharing</span>
				</a>
				<ul>
					<li>
						<a href="../drive-upload">
							<i class="entypo-flow-line"></i>
							<span>Upload</span>
						</a>
					</li>
					<li>
						<a href="../view-private-drive">
							<i class="entypo-flow-line"></i>
							<span>My Documents</span>
						</a>
					</li>
					<li>
						<a href="../view-public-drive">
							<i class="entypo-flow-line"></i>
							<span>Public Documents</span>
						</a>
					</li>
				</ul>
			</li>
				
				
	</div>	
	<!-- Sidebar ends... -->
	
	
	<div class="main-content">
		
<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
						<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="../assets/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
					<?php echo $user->get_full_name() ?>
				</a>
				
				<ul class="dropdown-menu">
					
					
				</ul>
			</li>
		
		</ul>
				
		
				
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			
			<li class="sep"></li>
			
			<li>
				<a href="../login?action=logout">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
		
	</div>
	
</div>

<hr />
<div class="mail-env">

	<!-- compose new email button -->
	<div class="mail-sidebar-row visible-xs">
		<a href="mailbox-compose.html" class="btn btn-success btn-icon btn-block">
			Compose Mail
			<i class="entypo-pencil"></i>
		</a>
	</div>
	
	
	<!-- Mail Body -->
	<div class="mail-body">
		
		<div class="mail-header">
			<!-- title -->
			<div class="mail-title">
				<?php
					echo $message->subject;
				?>
			</div>
			
			<!-- links -->
			<div class="mail-links">
				<a href="mailbox-process?page=<?php echo $_GET['type'] ?>&action=delete&checkboxes[]=<?php echo $message->id; ?>" class="btn btn-default">
					<i class="entypo-trash"></i>
				</a>
				
				<a class="btn btn-primary btn-icon" href="mailbox-compose?to=<?php echo $message->sender_id ?>&subject=Re : <?php echo $message->subject; ?>" >
					Reply
					<i class="entypo-reply"></i>
				</a>
			</div>
			<!-- End of links... -->
			
		</div>
		<!-- End of mail-header... -->
		
		<div class="mail-info">
			
			<div class="mail-sender dropdown">
				<?php
					if( $_GET['type'] == 'inbox' )
					{
						?>
							<img src="../assets/images/profile_pic/<?php echo $sender->profile_pic ?>" class="img-circle" width="30" /> 
								<span><?php echo $sender->get_full_name(); ?></span>
								(<?php echo $sender->email ?>) to <span>me</span>
						<?php
					}
					else
					{
						$receiver_ids = array();
						$receiver_ids = Receiver::find_by_message_id( $message->id );
						
						echo "From <span>me</span> to <br />";
						foreach( $receiver_ids as $receiver_id )
						{
							$receiver = User::find_by_id( $receiver_id->user_id );
							?>
								<span> <?php echo $receiver->first_name; ?></span>
								(<?php echo $receiver->email ?>) 
								<br />
							<?php
						} //foeach...
						
					}
				?>
				
				
			</div>
			
			<div class="mail-date">
				<?php
					$xplode = explode( " " , $message->date_time );
					$date_end = date("H:i" , strtotime($xplode[1]) ) . " - " . date("d F" , strtotime($xplode[0]) );
					echo "<be />" . $date_end;
				?>
			</div>
			
		</div>
		
		<div class="mail-text">
			
			<?php
				echo $message->body;
			?>
			
		</div>
		
		<!--
			******************************
			******* Attachments **********
			******************************
			
		<div class="mail-attachments">
			
			<h4>
				<i class="entypo-attach"></i> Attachments <span>(2)</span>
			</h4>
			
			<ul>
				<li>
					<a href="#" class="thumb">
						<img src="../assets/images/attach-1.png" class="img-rounded" />
					</a>
					
					<a href="#" class="name">
						IMG_007.jpg
						<span>14KB</span>
					</a>
					
					<div class="links">
						<a href="#">View</a> - 
						<a href="#">Download</a>
					</div>
				</li>
				
				<li>
					<a href="#" class="thumb download">
						<img src="../assets/images/attach-2.png" class="img-rounded" />
					</a>
					
					<a href="#" class="name">
						IMG_008.jpg
						<span>12KB</span>
					</a>
					
					<div class="links">
						<a href="#">View</a> - 
						<a href="#">Download</a>
					</div>
				</li>
				<li>
					<a href="#" class="thumb">
						<img src="../assets/images/attach-1.png" class="img-rounded" />
					</a>
					
					<a href="#" class="name">
						IMG_007.jpg
						<span>14KB</span>
					</a>
					
					<div class="links">
						<a href="#">View</a> - 
						<a href="#">Download</a>
					</div>
				</li>
				
				<li>
					<a href="#" class="thumb download">
						<img src="../assets/images/attach-2.png" class="img-rounded" />
					</a>
					
					<a href="#" class="name">
						IMG_008.jpg
						<span>12KB</span>
					</a>
					
					<div class="links">
						<a href="#">View</a> - 
						<a href="#">Download</a>
					</div>
				</li>
				<li>
					<a href="#" class="thumb">
						<img src="../assets/images/attach-1.png" class="img-rounded" />
					</a>
					
					<a href="#" class="name">
						IMG_007.jpg
						<span>14KB</span>
					</a>
					
					<div class="links">
						<a href="#">View</a> - 
						<a href="#">Download</a>
					</div>
				</li>
				
				<li>
					<a href="#" class="thumb download">
						<img src="../assets/images/attach-2.png" class="img-rounded" />
					</a>
					
					<a href="#" class="name">
						IMG_008.jpg
						<span>12KB</span>
					</a>
					
					<div class="links">
						<a href="#">View</a> - 
						<a href="#">Download</a>
					</div>
				</li>
			</ul>
			
		</div>
		
		
		-->
		
		<?php
			if( $_GET['type'] == 'inbox' )
			{
				?>
				<div class="mail-reply">
					<div class="fake-form">
						<div>
							<a href="mailbox-compose?to=<?php echo $message->sender_id; ?>&subject=Re : <?php echo $message->subject ?>">Reply</a> this message...
						</div>
					</div>
				</div>
				<?php
			}
		?>
		
	</div>
	
	<!-- Sidebar -->
	<div class="mail-sidebar">
		
		<!-- compose new email button -->
		<div class="mail-sidebar-row hidden-xs">
			<a href="mailbox-compose.html" class="btn btn-success btn-icon btn-block">
				Compose Mail
				<i class="entypo-pencil"></i>
			</a>
		</div>
		
		<!-- menu -->
		<ul class="mail-menu">
			<li class="active">
				<a href="#">
					<span class="badge badge-danger pull-right">
						<?php
							$count = User::count_unread_messages( $_SESSION['user_id'] );
							echo $count;
						?>
					</span>
					Inbox
				</a>
			</li>
			
			<li>
				<a href="sent">
					Sent
				</a>
			</li>
		
			<li>
				<a href="trash">
					Trash
				</a>
			</li>
		</ul>
	</div>
	
</div>



<hr /><!-- Footer -->
<footer class="main">
	
	<?php
		echo FOOTER;
	?>
	
</footer>	</div>
	
	
<div id="chat" class="fixed" data-current-user="Vivek Joshi" data-order-by-status="1" data-max-chat-history="25">
	
	<div class="chat-inner">
	
		
		<h2 class="chat-header">
			<a href="#" class="chat-close" data-animate="1"><i class="entypo-cancel"></i></a>
			
			<i class="entypo-users"></i>
			Chat
			<span class="badge badge-success is-hidden">0</span>
		</h2>
		
		
		<div class="chat-group" id="group-1">
			<strong>Favorites</strong>
			
			<a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
			<a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
			<a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
			<a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
			<a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
		</div>
		
		
		<div class="chat-group" id="group-2">
			<strong>Work</strong>
			
			<a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
			<a href="#" data-conversation-history="#sample_history_2"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
			<a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
		</div>
		
		
		<div class="chat-group" id="group-3">
			<strong>Social</strong>
			
			<a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
			<a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
			<a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
			<a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
		</div>
	
	</div>
	
	<!-- conversation template -->
	<div class="chat-conversation">
		
		<div class="conversation-header">
			<a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>
			
			<span class="user-status"></span>
			<span class="display-name"></span> 
			<small></small>
		</div>
		
		<ul class="conversation-body">	
		</ul>
		
		<div class="chat-textarea">
			<textarea class="form-control autogrow" placeholder="Type your message"></textarea>
		</div>
		
	</div>
	
</div>


<!-- Chat Histories -->
<ul class="chat-history" id="sample_history">
	<li>
		<span class="user">Vivek Joshi</span>
		<p>Are you here?</p>
		<span class="time">09:00</span>
	</li>
	
	<li class="opponent">
		<span class="user">Catherine J. Watkins</span>
		<p>This message is pre-queued.</p>
		<span class="time">09:25</span>
	</li>
	
	<li class="opponent">
		<span class="user">Catherine J. Watkins</span>
		<p>Whohoo!</p>
		<span class="time">09:26</span>
	</li>
	
	<li class="opponent unread">
		<span class="user">Catherine J. Watkins</span>
		<p>Do you like it?</p>
		<span class="time">09:27</span>
	</li>
</ul>




<!-- Chat Histories -->
<ul class="chat-history" id="sample_history_2">
	<li class="opponent unread">
		<span class="user">Daniel A. Pena</span>
		<p>I am going out.</p>
		<span class="time">08:21</span>
	</li>
	
	<li class="opponent unread">
		<span class="user">Daniel A. Pena</span>
		<p>Call me when you see this message.</p>
		<span class="time">08:27</span>
	</li>
</ul>	
	</div>




	<!-- Bottom Scripts -->
	<script src="../assets/js/gsap/main-gsap.js"></script>
	<script src="../assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	<script src="../assets/js/joinable.js"></script>
	<script src="../assets/js/resizeable.js"></script>
	<script src="../assets/js/neon-api.js"></script>
	<script src="../assets/js/neon-mail.js"></script>
	<script src="../assets/js/neon-chat.js"></script>
	<script src="../assets/js/neon-custom.js"></script>
	<script src="../assets/js/neon-demo.js"></script>

</body>
</html>