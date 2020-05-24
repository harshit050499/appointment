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

<!-- JS, Popper.js, and jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/clndr.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="dashboard.php">Appointment</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="dashboard.php">Home</a></li>
      <li class="active"><a href="myevents.php"> My Events</a></li>
      <li><a href="schedule.php">Scheduled events</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="fa fa-sign-out "></span>Logout</a></li>
    </ul>
  </div>
</nav>
<section>
	<div class="col-sm-12">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			 <div class="heading">
          		<p>MY EVENTS</p>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="neweventbtn" style="text-align: right;">
					<a href="newevent.php" class="btn btn-primary">Create New Event</a>
				</div>
		</div>
	</div>
</section>
<section>
	<div class="col-sm-12">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="contain" id="myevent"></div>
		</div>
		<div class="col-sm-2"></div>
	</div>

</section>
<script type="text/javascript">
	function myevents()
		{
			
			
			$.ajax(
									{
										url:"ajax/getmyevent.php?token=<?php echo $_SESSION['apikey'];?>",  
						                method:"POST",  
						                data:{submit:"submit"},    
						                success:function(data){  
						                  $('#myevent').html(data);
						            }  
									});
		}
		function deleting(id) {

			
			$.ajax(
									{
										url:"ajax/delete.php?token=<?php echo $_SESSION['apikey'];?>",  
						                method:"POST",  
						                data:{id:id},    
						                success:function(data){  
						                	if(data == 0)
						                	{
						                		alert('The event was deleted');
						                	}
						                	else
						                	{
						                		alert(data);
						                	}
						            }  
									});
		}
		myevents();
</script>
</body>
</html>
