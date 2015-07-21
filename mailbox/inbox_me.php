<!DOCTYPE html>
<html lang="en">
<?php
	require_once('../includes/initialize.php');
	require_once('../envolve_api_client.php');
	echo( 
		envapi_get_html_for_reg_user(
			'176644-3EaSQ9JhWGaxqDH2EJ91XS3smNIPajiD', 
			'Vivek', 
			'Joshi', 
			'http://www.example.com/pic.png', 
			false, 
			"Hello World!")
	);
?>

<?php
	//Load Session details...
	if (! $session->is_logged_in() )
		session_start();
	
	if( ! isset($_SESSION['user_id']) )
		redirect_to('../login.php?msg=Please Log-in first.');
?>

<?php
	//Count the no. of unread messages...
	$count = User::count_unread_messages( $_SESSION['user_id'] );
?>

<?php
	//Get user details...
	$user = User::find_by_id( $_SESSION['user_id'] );
	//Get user's inbox...	
	$sql = "select * from receivers where user_id=".$_SESSION['user_id']." order by message_id desc" ;
	$inbox_message_ids = Receiver::find_by_sql( $sql );
?>


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>LLSCT | Mailbox | Inbox</title>
	

	<link rel="stylesheet" href="../assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="../assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/css/neon-core.css">
	<link rel="stylesheet" href="../assets/css/neon-theme.css">
	<link rel="stylesheet" href="../assets/css/neon-forms.css">
	<link rel="stylesheet" href="../assets/css/custom.css">


	<!-- Envolve Chat -->
<script type="text/javascript">
var envoSn=176644;
var envProtoType = (("https:" == document.location.protocol) ? "https://" : "http://");
document.write(unescape("%3Cscript src='" + envProtoType + "d.envolve.com/env.nocache.js' type='text/javascript'%3E%3C/script%3E"));
</script>
	
	
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
				<a href="index">
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
			
			<!-- Search Bar -->
			
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
						<a href="#">
							<i class="entypo-flow-line"></i>
							<span>Share</span>
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
					<img src = "../assets/images/profile_pic/<?php echo  $user->profile_pic; ?>" alt="" class="img-circle" width="44" />
					<?php   
						echo $user->get_full_name();
					?>
				</a>
				
				<ul class="dropdown-menu">
					
					<!-- Reverse Caret -->
					<li class="caret"></li>
					
					<!-- Profile sub-links -->
					<li>
						<a href="../edit-profile">
							<i class="entypo-user"></i>
							Edit Profile
						</a>
					</li>
					
					<li>
						<a href="../edit-password">
							<i class="entypo-mail"></i>
							Edit Password
						</a>
					</li>
					
				</ul>
			</li>
		
		</ul>
				
		<ul class="user-info pull-left pull-right-xs pull-none-xsm">
			
			<!-- Raw Notifications -->
			<li class="notifications dropdown">
				
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="entypo-attention"></i>
					<span class="badge badge-info">6</span>
				</a>
				
				<ul class="dropdown-menu">
					<li class="top">
	<p class="small">
		<a href="#" class="pull-right">Mark all Read</a>
		You have <strong>3</strong> new notifications.
	</p>
</li>

<li>
	<ul class="dropdown-menu-list scroller">
		<li class="unread notification-success">
			<a href="#">
				<i class="entypo-user-add pull-right"></i>
				
				<span class="line">
					<strong>New user registered</strong>
				</span>
				
				<span class="line small">
					30 seconds ago
				</span>
			</a>
		</li>
		
		<li class="unread notification-secondary">
			<a href="#">
				<i class="entypo-heart pull-right"></i>
				
				<span class="line">
					<strong>Someone special liked this</strong>
				</span>
				
				<span class="line small">
					2 minutes ago
				</span>
			</a>
		</li>
		
		<li class="notification-primary">
			<a href="#">
				<i class="entypo-user pull-right"></i>
				
				<span class="line">
					<strong>Privacy settings have been changed</strong>
				</span>
				
				<span class="line small">
					3 hours ago
				</span>
			</a>
		</li>
		
		<li class="notification-danger">
			<a href="#">
				<i class="entypo-cancel-circled pull-right"></i>
				
				<span class="line">
					John cancelled the event
				</span>
				
				<span class="line small">
					9 hours ago
				</span>
			</a>
		</li>
		
		<li class="notification-info">
			<a href="#">
				<i class="entypo-info pull-right"></i>
				
				<span class="line">
					The server is status is stable
				</span>
				
				<span class="line small">
					yesterday at 10:30am
				</span>
			</a>
		</li>
		
		<li class="notification-warning">
			<a href="#">
				<i class="entypo-rss pull-right"></i>
				
				<span class="line">
					New comments waiting approval
				</span>
				
				<span class="line small">
					last week
				</span>
			</a>
		</li>
	</ul>
</li>

<li class="external">
	<a href="#">View all notifications</a>
</li>				</ul>
				
			</li>
			
			<!-- Message Notifications -->
			<li class="notifications dropdown">
				
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="entypo-mail"></i>
					<span class="badge badge-secondary">10</span>
				</a>
				
				<ul class="dropdown-menu">
					<li>
	<ul class="dropdown-menu-list scroller">
		<li class="active">
			<a href="#">
				<span class="image pull-right">
					<img src="assets/images/thumb-1.png" alt="" class="img-circle" />
				</span>
				
				<span class="line">
					<strong>Luc Chartier</strong>
					- yesterday
				</span>
				
				<span class="line desc small">
					This ain’t our first item, it is the best of the rest.
				</span>
			</a>
		</li>
		
		<li class="active">
			<a href="#">
				<span class="image pull-right">
					<img src="assets/images/thumb-2.png" alt="" class="img-circle" />
				</span>
				
				<span class="line">
					<strong>Salma Nyberg</strong>
					- 2 days ago
				</span>
				
				<span class="line desc small">
					Oh he decisively impression attachment friendship so if everything. 
				</span>
			</a>
		</li>
		
		<li>
			<a href="#">
				<span class="image pull-right">
					<img src="../assets/images/thumb-3.png" alt="" class="img-circle" />
				</span>
				
				<span class="line">
					Hayden Cartwright
					- a week ago
				</span>
				
				<span class="line desc small">
					Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
				</span>
			</a>
		</li>
		
		<li>
			<a href="#">
				<span class="image pull-right">
					<img src="../assets/images/thumb-4.png" alt="" class="img-circle" />
				</span>
				
				<span class="line">
					Sandra Eberhardt
					- 16 days ago
				</span>
				
				<span class="line desc small">
					On so attention necessary at by provision otherwise existence direction.
				</span>
			</a>
		</li>
	</ul>
</li>

<li class="external">
	<a href="mailbox">All Messages</a>
</li>				</ul>
				
			</li>
			
			<!-- Task Notifications -->
	



				</ul>
				
			</li>
		
		</ul>
	
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			
			
			<!--<li>
				<a href="#" data-toggle="chat" data-animate="1" data-collapse-sidebar="1">
					<i class="entypo-chat"></i>
					Chat
					
					<span class="badge badge-success chat-notifications-badge is-hidden">0</span>
				</a>
			</li> -->
			
			<li class="sep"></li>
			
			<li>
				<a href="extra-login">
					<a href="../login.php?action=logout">Log Out </a> <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
		
	</div>
	
</div>

<hr />
<div class="mail-env">

	<!-- compose new email button -->
	<div class="mail-sidebar-row visible-xs">
		<a href="mailbox-compose" class="btn btn-success btn-icon btn-block">
			Compose Mail
			<i class="entypo-pencil"></i>
		</a>
	</div>
	
	
	<!-- Mail Body -->
	<div class="mail-body">
		
		<div class="mail-header">
			<!-- title -->
			<h3 class="mail-title">
				Inbox
				<span class="count">
					<?php
						echo "(" . $count . ")";
					?>
				</span>
			</h3>
			
			<!-- search -->
			
		</div>
		
		<!-- 
			<form> to perform actions like :
				1. Mark as read.
				2. Delete (Move to trash).
			added bt >> ME <<
		-->
		<form action="mailbox-process" method="post">
			
			<!-- Hidden field indicating the page... -->
			<input type="hidden" name="page" value="inbox" />
		
		<!-- mail table -->
		<table class="table mail-table">
			<!-- mail table header -->
			<thead>
				<tr>
					<th width="5%">
						<div class="checkbox checkbox-replace">
							<input type="checkbox" />
						</div>
					</th>
					<th>
						<button type="submit" name="action" value="delete" class="btn btn-red btn-icon icon-left">
							Delete
							<i class="entypo-cancel"></i>
						</button>
									
						<button type="submit" name="action" value="mark_as_read" class="btn btn-blue btn-icon icon-left">
							Mark as read
							<i class="entypo-check"></i>
						</button>

					</th>
					<th colspan="4">
						
						<div class="mail-pagination" colspan="2">
							<strong>1-30</strong> <span>of 789</span>
							
							<div class="btn-group">
								<a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a>
								<a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a>
							</div>
						</div>
					</th>
				</tr>
			</thead>
			
			<!-- email list -->
			<tbody>
				
				<?php 
					foreach( $inbox_message_ids as $msg )
					{
						$message = Message::find_by_id( $msg->message_id );

						$result = Receiver::is_msg_read( $_SESSION['user_id'] , $message->id );
						
						$class = 'read';
						if( $result->is_read == 'true' )
							$class = 'read';
						else
							$class = 'unread';
						
						?>
						<!-- Single message -->
						<tr class="<?php echo $class; ?>">
							<td>
								<div class="checkbox checkbox-replace">
									<input type="checkbox" name="checkboxes[]" value="<?php echo $message->id; ?>" />
								</div>
							</td>
							<td class="col-name">
								
								<a href="mailbox-message?id=<?php echo $message->id; ?>&type=inbox" class="col-name"> 
									<?php echo $message->subject; ?> 
								</a>
							</td>
							<td class="col-subject">
								<a href="mailbox-message?id=<?php echo $message->id; ?>&type=inbox">
									<?php echo $message->body; ?>
								</a>
							</td>
							<td class="col-options">
								<a href="mailbox-message"><i class="entypo-attach"></i></a>
							</td>
							<td class="col-time">
							<?php
							
								//$date = $message->date_time;
								$mysql_date_time = strtotime( $message->date_time );
								$phpdatetime = date("%Y", time() );
								//echo $message->date_time;
								
							?>
							13:48
							</td>
						</tr>
						<!-- Single message ends... -->
						
						<?php
					}
					?>
				
			</tbody>
			
			<!-- mail table footer -->
			<tfoot>
				<tr>
					<th width="5%">
						<div class="checkbox checkbox-replace">
							<input type="checkbox" />
						</div>
					</th>
					<th>
						<button type="submit" name="action" value="delete" class="btn btn-red btn-icon icon-left">
							Delete
							<i class="entypo-cancel"></i>
						</button>
									
						<button type="submit" name="action" value="mark_as_read" class="btn btn-blue btn-icon icon-left">
							Mark as read
							<i class="entypo-check"></i>
						</button>

					</th>
					<th colspan="4">
						
						<div class="mail-pagination" colspan="2">
							<strong>1-30</strong> <span>of 789</span>
							
							<div class="btn-group">
								<a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a>
								<a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a>
							</div>
						</div>
					</th>
				</tr>
			</tfoot>
		</table>
		</form>
	</div>
	
	<!-- Sidebar -->
	<div class="mail-sidebar">
		
		<!-- compose new email button -->
		<div class="mail-sidebar-row hidden-xs">
			<a href="mailbox-compose" class="btn btn-success btn-icon btn-block">
				Compose Mail
				<i class="entypo-pencil"></i>
			</a>
		</div>
		
		<!-- menu -->
		<ul class="mail-menu">
			<li class="active">
				<a href="inbox">
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
					<!-- <span class="badge badge-gray pull-right"> 1 </span> -->
					Sent
				</a>
			</li>
			
			<li>
				<a href="trash">
					Trash
				</a>
			</li>
		</ul>
		
		<div class="mail-distancer"></div>
		
		
		
		<!-- menu -->
		
		
	</div>
	
</div>

<hr /><!-- Footer -->
<footer class="main">
	
		
	&copy; 2014 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>
	
</footer>	</div>
	
	
<div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">
	
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
		<span class="user">Art Ramadani</span>
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