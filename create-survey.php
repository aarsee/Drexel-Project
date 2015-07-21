<!DOCTYPE html>
<?php
	require_once('includes/initialize.php')
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
	$isError = false;
	
	if( isset( $_POST['submit'] ) )
	{
	  
	   $new_question = new Question();
	   $new_question->question_content = $_POST['question_content'];
	   $new_question->topic = $_POST['topic'];
	   $new_question->description = $_POST['description'];
	   $new_question->creator_id = $_SESSION['user_id'];
	   $new_question->is_enabled = ( isset($_POST['is_enabled']) ) ? 'true' : 'false'; 
	   $new_question->create();
	   
	   
	   //Fetch the last entered id from 'Question'...
	   $sql = "SELECT * FROM questions ORDER BY question_id desc limit 1";
	   $result_set = $database->execute_query( $sql );
	   $row = $database->fetch_array( $result_set );
	   $question_id= array_shift( $row );
	   
	   //set default value 'false' to $if_created...
	   //Used to display success of error message to user...
	   $if_created = 'false';
	   
	   $options= $_POST['option_content'];
	   $option_id = 1;
	   foreach($options as $option)
	   {
	     $new_option = new Option();
		 $new_option->option_id = $option_id;
		 $new_option->option_content = $option;
		 $new_option->question_id = $question_id;
		 
		 //If everything goes right, 'if_created' should be 'true'...
		 $if_creted = $new_option->create();
		 
		 $option_id++;
	   }
	   
	}
	
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>LLSCT | Create Survey</title>
	

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
	
	<!-- Script to add options dynamically... -->
	<script type="text/javascript">
	var option_number=3;
		function myF()
		{
			$("#add_new_option").before
			('<div class="form-group" ><label for="field-1" class="control-label">Option : ' + option_number++ + '</label><br /><div class="col-sm-5"><input type="text" class="form-control" name="option_content[]" data-validate="required" data-message-required="You must provide at least 2 options." /></div></div><br /><br /><br />');
		}	
	</script>
	
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
						<a href="edit-lock">
							<i class="entypo-mail"></i>
							Edit Password
						</a>
					</li>
					<li>
						<a href="upload-pic">
							<i class="entypo-mail"></i>
							Edit Picture
						</a>
					</li>
					
					
				</ul>
			</li>
		
		</ul>
				
		
	
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			
			<!-- Language Selector -->			
			
			
			
			<li class="sep"></li>
			
			<li>

	              <a href="login.php?action=logout">Log Out </a> <i class="entypo-logout right"></i>
			
			</li>
		</ul>
		
	</div>
	
</div>

<hr />
			
			
<?php

if( ! isset( $_POST['submit'] ) )
{
	?>
	<h2>Create New Survey</h2>
	<br />
	
	<div class="panel panel-primary">
	
		<div class="panel-heading">
			<div class="panel-title">Enter Details</div>
			
			<div class="panel-options">
				<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
			</div>
		</div>
		
		<div class="panel-body">
		
			
				<form method="post" action="create-survey" class="validate">
	
				<div class="form-group" >
					<label for="field-1" class="control-label">TOPIC</label>
					<br />
					<div class="col-sm-10">
					<input type="text" class="form-control" name="topic" data-validate="required" data-message-required="Topic is required for identification."/>
					</div>
				</div>
				<br /><br /><br />
				
				<div class="form-group" >
					<label for="field-1" class="control-label">Descriprtion</label>
					<br />
					<div class="col-sm-10">
					<textarea class="form-control" name="description"  rows="3" placeholder="Optional"></textarea>
					
					</div>
				</div>
				<br /><br /><br /><br />
				
				<br />
				<br />
				
				
				<div class="form-group" >
					<label for="field-1" class="control-label">Enter the question:</label>
					<br />
					<div class="col-sm-10">
					<input type="text" class="form-control"  name="question_content" data-validate="required" data-message-required="Question is required."/>
					</div>
				</div>
				<br /><br /><br />
				
				<div class="form-group" >
					<label for="field-1" class="control-label">Option 1 :</label>
					<br />
					<div class="col-sm-5">
					<input type="text" class="form-control" name="option_content[]" data-validate="required" data-message-required="You must provide at least 2 options." />
		 			</div>
				</div>
				<br /><br /><br />
				
				
				<div class="form-group" >
					<label for="field-1" class="control-label">Option 2 :</label>
					<br />
					<div class="col-sm-5">
					<input type="text" class="form-control" name="option_content[]" data-validate="required" data-message-required="You must provide at least 2 options." />
		 			</div>
				</div>
				<br /><br /><br />
				
				
				<div class="form-group" id="add_new_option">
						<input type="button" value="Add New Option" class="add" onClick="myF()" /> 
				</div>
				<br /><br /><br />
				
				
				
				
				<div class="form-group" >
					<label for="field-1" class="control-label">
						Allow others to answer? 
						<br />
					<br />
					<div class="col-sm-5">
						<div id="label-switch" class="make-switch" data-on-label="Allow" data-off-label="Deny">
							<input type="checkbox" name="is_enabled" checked="">
						</div>
					</div>		
				</div>
				
				<br /><br /><br />
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-success">Create Survey</button>
					<button type="reset" class="btn">Reset </button>
				</div>
			
			</form>
		
		</div>
	
		
	</div>
	<!-- "Add User" Ends... -->

<?php
}			//Closing 'if'...
else		//Display message of either Success of Failure...
{
	//Check if submission was successfull...
	if( $if_created )
	{
		?>
		<div align="center">
			<!-- Leave space before the button -->
			<div class="col-md-1"></div>
			
			<div>
				<button type="button" class="btn btn-success col-md-4">Survey created succesfully.</button>
			</div>
			
			<!-- Leave space before the button -->
			<div class="col-md-1"></div>
			
			<div>
				<button type="button" class="btn btn-info col-md-4" onClick="window.location.assign('create-survey.php')">Create another survey.</button>
			</div>
		</div>
		<?php
	}
	else			// if_created = false (Boolean, not string)...
	{
		?>
		<div align="center">
			<!-- Leave space before the button -->
			<div class="col-md-1"></div>
				
			<div align="center">
				<button type="button" class="btn btn-danger col-md-4">Survey creation failed.</button>
			</div>
			
			<!-- Leave space before the button -->
			<div class="col-md-1"></div>
			
			<div align="center">
				<button type="button" class="btn btn-info col-md-4" onClick="window.location.assign('survey.php')">Try again.</button>
			</div>
		</div>
		<?php
	}
}
?>




<br /><br /><br />	
<!-- Footer -->
	<footer class="main" >
	
		<?php 
			echo FOOTER;
		?>
		
	</footer>	
	</div>
	
	


	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/bootstrap-switch.min.js"></script>
	<script src="assets/js/neon-demo.js"></script>
	
	
	

</body>
</html>
