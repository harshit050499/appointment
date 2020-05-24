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
<style type="text/css">
	.hidden
	{
		display: none;
	}
	.show
	{
		display: block;
	}
</style>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="dashboard.php">Appointment</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="dashboard.php">Home</a></li>
      <li><a href="myevents.php"> My Events</a></li>
      <li><a href="schedule.php">Scheduled events</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="fa fa-sign-out "></span>Logout</a></li>
    </ul>
  </div>
</nav>
<section>
	<div class="col-sm-12">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="col-sm-4">
				<div class="welcome" style="font-size: 30px;">
					<p>Welcome,<span style="text-transform: capitalize;"><?php echo $_SESSION['name'];?></span></p>
				</div>
				<hr>
			</div>
			<div class="col-sm-4">
				<div class="link" style="text-align: center;font-size: 14px;">
					<p><b>Your Link:appointment/events.php?n=<?php echo $_SESSION['name']?></b><br>copy and share this link</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="neweventbtn" style="text-align: right;">
					<a href="newevent.php" class="btn btn-primary">Create New Event</a>
				</div>
			</div>
		</div>
		<div class="Col-sm-1"></div>

	</div>
</section>
<section>
	<div class="col-sm-12">
		<div class="heading">
			<p>AVAILBILITY SLOT</p>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="col-sm-6">
				<div class="heading">
					<p>Select Date and Time Slot</p>
				</div>
				<div class="cal1"></div>
				<div class="button" style="text-align: center;">
	                             <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="save();">
	                        </div>
			</div>
			<div class="col-sm-6">
				<div class="slot-list" style="float: left;width: 100%;">
				<form id="aform">
					<input type="hidden" name="token" id="token" value="<?php echo password_hash($_SESSION['mail'], PASSWORD_DEFAULT)?>">
					<div class="list" id="list" style="width: 100%;float: left;padding: 10px"></div>
			
			
	                    </form>
	                </div>

			</div>


		</div>
		<div class="col-sm-1">
				  
		</div>
	</div>
	<script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	 <script src="clndr.js"></script>
    
	<script>
    		var date;
		var calendar = {};
$(document).ready( function() {
    
        				calendar.clndr = $('.cal1').clndr({
        	   
        	        clickEvents: {
        	            click: function (target) {
                            
        	                date=target['date']['_i']
        	               
        	                    $("#event").empty();
        	            }
        	        },
        	        
        	        showAdjacentMonths: true,
        	        adjacentDaysChangeMonth: false
        	    });
        });
    
	</script>
</section>

	<script type="text/javascript">
		getlist();
		function getlist()
		{

			$.ajax(
									{
										type:'POST',
										url:"ajax/check.php?token=<?php echo $_SESSION['apikey']?>",
										data:{},
										success:function(data)
										{
											//alert(data);

											$('#list').html(data);
										}
									});
		}
		function save()
		{
								if(date!="")
								{
									var form=document.getElementById('aform');
									var data = new FormData(form);
									data.append('date', date);
									
									$.ajax(
									{
										url:"ajax/export.php?token=<?php echo $_SESSION['apikey']?>",  
						                method:"POST",  
						                data:data,  
						                contentType:false,  
						                processData:false,  
						                success:function(data){  
						                  if(data == 0)
						                  {
						                  	alert('Your availibility slots have been added');
						                  }
						                  else if(data==1)
						                  {
						                  	alert('Something Went Wrong! Try again');
						                  }
						                  else
						                  {
						                  	alert(data);
						                  	alert('Please select date as well as time!');
						                  }
						            }  
									});
								}
								else
								{
									alert('Please select date first');
								}
		}
		
	</script>
</body>
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>

</html>