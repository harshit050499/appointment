<?php 
	session_start();
	if( $_SESSION['mail']=="")
	{
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/clndr.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Appointment</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="dashboard.php">Home</a></li>
      <li ><a href="myevents.php"> MY Events</a></li>
      <li class="active"><a href="Schedule.php">Scheduled events</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
    </ul>
  </div>
</nav>
	<section>
		<div class="col-sm-12">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="heading">
          		<p>SCHEDULED EVENTS</p>
			</div>
			<div class="contain" id="schedule"></div>
		</div>
		<div class="col-sm-2"></div>
	</div>

	</section>
	<script type="text/javascript">
		function schedule()
		{
			
			var token="<?php echo password_hash($_SESSION['mail'], PASSWORD_DEFAULT);?>";
			$.ajax(
									{
										url:"ajax/schedule.php",  
						                method:"POST",  
						                data:{token:token,submit:"submit"},    
						                success:function(data){  
						                	alert(data);
						                  $('#schedule').html(data);
						            }  
									});
		}
		schedule();
	</script>
</body>

</html>