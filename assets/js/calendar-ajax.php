<?php
	/*require_once('include/initialize.php')
	
	$user = new User();
	$user->first_name = 'temp from calendar-ajax';
	$user->create();*/
	
	echo $_POST['user_id'];
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		
		$.ajax({
            type: "POST",
            url: 'calendar-ajax.php',
            dataType: "ajax",
            data : {
				user_id : "1"
			},
                  success: function(data){
					  //$(this).addClass("newclass");
					  //$("div").remove(".myclass");
                      //alert(data);
					   
					   alert("Data : " + data);
                  }


        });
	});		
		alert('after');
	</script>
</head>
	
<body>
</body>
</html>
