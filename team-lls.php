<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');
?>

<?php
	//Load Session details...
	if (! $session->is_logged_in() )
		session_start();
	
	if( ! isset($_SESSION['user_id']) )
		redirect_to('login.php?msg=Please Log-in first.');
	$user=User::find_by_id($_SESSION['user_id']);
?>

<?php
 	if( isset($_GET['name'] ) )
		$user_array = User::find_by_sql("SELECT * FROM users WHERE first_name LIKE '%" . $_GET['name']. 
											"%' OR last_name LIKE '%" . $_GET['name']. "%'" );
	else
		$user_array=User::find_all();
?>

<?php
	$path = 'assets/images/profile_pic/' . $user->profile_pic;
	echo( 
		envapi_get_html_for_reg_user(
			'176644-3EaSQ9JhWGaxqDH2EJ91XS3smNIPajiD', 
			$user->first_name, 
			$user->last_name, 
			$path,
			false, 
			"HI")
	);
?>



<?php
	if( isset( $_POST['submit'] ) )
	{
	    $user = new User();
  		$user=  User::find_by_id($_SESSION['user_id']);
		if($user->password == $_POST['current_password'])
		{
		$user->password= $_POST['new_password'];
		$user->update_password($_SESSION['user_id'],$_POST['new_password']);
		redirect_to("mailbox/inbox.php?msg=Password changed successfully");
		}
		else
		{ 
		  echo "You have entered wrong password";
		}
	
	    	
	}
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>LLSCT | Team LLS</title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

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
					<img src="assets/images/logo@2x.png" width="120" alt="" />
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
				<a href="mailbox/inbox">
					<i class="entypo-mail"></i>
					<span>Mailbox</span>
					<span class="badge badge-secondary"></span>
				</a>
			</li>
			
			<li>
				<a href="extra-calendar">
					<i class="entypo-calendar"></i>
					<span>Calendar</span>
				</a>
            	<ul>
					<li>
						<a href="my-calendar">
							<span>My Calendar</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="public-calendar">
							<span>Public Calendar</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="add-user">
					<i class="entypo-user-add"></i>
					<span>Add new User</span>
				</a>
			</li>
			<li>
				<a href="team-lls">
					<i class="entypo-users"></i>
					<span>Team LLS</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class="entypo-chart-bar"></i>
					<span>Survey</span>
				</a>
				<ul>
					<li>
						<a href="create-survey">
							<span>Create Survey</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="list-survey">
							<span>List Survey</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
				</ul>
				<ul>
					<li>
						<a href="edit-survey">
							<span>Edit Survey</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="view-response">
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
				<a href="about-lls">
					<i class="entypo-feather"></i>
					<span>About LLS Collaboration Tool</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="entypo-drive"></i>
					<span>Document Sharing</span>
				</a>
				<ul>
					<li>
						<a href="drive-upload">
							<i class="entypo-flow-line"></i>
							<span>Upload</span>
						</a>
					</li>
					<li>
						<a href="view-private-drive">
							<i class="entypo-flow-line"></i>
							<span>My Documents</span>
						</a>
					</li>
					<li>
						<a href="view-public-drive">
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
	 <img src="assets/images/profile_pic/<?php echo $user->profile_pic;?>" width="44" height="44" class="img-circle"  />
					<?php   
						echo $user->get_full_name();
					?>
				</a>
				
				<ul class="dropdown-menu">
					
					<!-- Reverse Caret -->
					<li class="caret"></li>
					
					<!-- Profile sub-links -->
					<li>
						<a href="edit-profile">
							<i class="entypo-user"></i>
							Edit Profile
						</a>
					</li>
					
					<li>
						<a href="edit-password">
							<i class="entypo-lock"></i>
							Edit Password
						</a>
					</li>
					
					<li>
						<a href="upload-pic">
							<i class="entypo-user"></i>
							Edit Picture
						</a>
					</li>
					
					
				</ul>
			</li>
		
		</ul>
				
		<ul class="user-info pull-left pull-right-xs pull-none-xsm">
			
			<!-- Raw Notifications -->
			
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			
			
			
			
			<li class="sep"></li>
			
			<li>
	              <a href="login.php?action=logout">Log Out </a> <i class="entypo-logout right"></i>
			</li>
		</ul>
		
	</div>
	
</div>

<hr />
		
		
		
		
<!-- Main content starts here... -->
<br />
<div class="row">
	<div class="col-md-12 col-sm-5">
		<form method="get" role="form" class="search-form-full">
			<div class="form-group">
				<input type="text" class="form-control" name="name" id="search-input" placeholder="Type a name and hit Enter..." />
				<i class="entypo-search"></i>
			</div>
		</form>
	</div>
</div>

<?php
	$if_executed = false;	
	foreach($user_array as $user)
	{
		$if_executed = true;
		?>
				<!-- Single Member -->
				<div class="member-entry">
				
			<a  class="member-img">
				<img src="assets/images/profile_pic/<?php echo $user->profile_pic;?>" class="img-rounded" />
				
			</a>
			
			<div class="member-details">
				<h4>
					<a href="extra-timeline.php"><?php echo $user->first_name." ".$user->last_name; ?></a>
				</h4>
				
				<!-- Details with Icons -->		<div class="row info-list">
					
					<div class="col-sm-4">
						<i class="entypo-briefcase"></i>
						<a nohref><?php echo $user->position; ?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-linkedin"></i>
						<a href="<?php echo $user->linked_url ?>"><?php echo "View Connections" ?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-skype"></i>
						<a href="skype:<?php echo $user->skype_id; ?>?call"> <?php echo $user->skype_id; ?> (Video)</a>
					</div>
					
					<div class="clear"></div>
					
					<div class="col-sm-4">
						<i class="entypo-mobile"></i>
						<a nohref><?php echo $user->contact_no; ?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-mail"></i>
						<a href="Mailbox/mailbox-compose?to=<?php echo $user->id; ?>"><?php echo $user->email; ?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-skype"></i>
						<a href="skype:<?php echo $user->skype_id?>?call,video="FALSE""> <?php echo $user->skype_id; ?> (Voice)</a>
					</div>
					
				</div>
			</div>
	  </div>
	  
			<!-- Single Member Ends -->
	<?php	
	}
	
	//Extra padding for left sidebar...
	if( ! $if_executed )
		echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
?>

<!-- Extra paddign for left sidebar... -->
<br /><br /><br /><br /><br /><br /><br />
		
<!-- Main content ends here... -->

	
	
	<!-- Main section e here.. -->
</div>

<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
function initialize()
{
	var $ = jQuery,
		map_canvas = $("#sample-checkin");
	
	var location = new google.maps.LatLng(36.738888, -119.783013),
		map = new google.maps.Map(map_canvas[0], {
		center: location,
		zoom: 14,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false
	});
	
	var marker = new google.maps.Marker({
		position: location,
		map: map
	});
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
		<?php 
			echo FOOTER;
		?>
		
<!-- Footer -->
	</div>



	</div>




	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>
