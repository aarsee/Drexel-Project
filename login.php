<!DOCTYPE html>
<?php
	require_once('includes/initialize.php');
?>

<?php
	//If user requested Log-out... 
	if( (!empty( $_GET['action'] )) && $_GET['action']=='logout' )
	{		
		$session->logout();
		session_destroy();
		redirect_to('login');
	}
?>

<?php
	//If session has already atarted...
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	
	if( isset($_SESSION['user_id']) )
		redirect_to('mailbox/inbox');
?>


<?php
	$isError = false;
	if( isset( $_POST['submit'] ) )
	{
		$email = trim( $_POST['email'] );
		$password = trim( $_POST['password'] );
		
		$found_user = User::authenticate( $email , $password );
		
		if( $found_user )
		{
			$session->login( $found_user );
			redirect_to('mailbox/inbox');
		}
		
		//If not redirected yet, User has entered incorrect credential...		
		$isError = true;
	}
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>LLSCT | Login</title>
	

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
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			<div class="logo">
				<a href="index.html">
					<img src="assets/images/logo@2x.png" width="160" alt="" />
				</a>
			</div>
			
			
			
			<p class="description">Dear user, log in to access the LLS Collaboration Tool!</p>
		
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3><?php  echo "abcdefgh"; ?></h3>
				<span>logging in... 
                </span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div>53%</div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
            <?php 
				if( $isError )
				{
					?>
					<div class="">
						<h3>Invalid login</h3>
						<p>Make sure you have entered correct credentials.</p>
					</div>
					<?php
				}
			?>
			
			
			<form method="post" action="login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" data-validate="required" name="email" id="username" placeholder="E-mail" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" data-validate="required" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="E">
					<button type="submit" name="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Log In
					</button>
				</div>
					
			</form>
			
			
			<div class="login-bottom-links">
				
				
				
			</div>
			
		</div>
		
	</div>
	
</div>


	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>
