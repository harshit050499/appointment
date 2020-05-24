<?php 
	// session_start();
	// if( $_SESSION['mail']=="")
	// {
	// 	header("Location:index.php");
	// }
	// if($_GET['n']=="" && $_GET['e']=="")
	// {
	// 	header("Location:error.php");
	// }

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
	<link rel="stylesheet" type="text/css" href="css/clndr.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

<section>
	<div class="col-sm-12">

		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="contain-head" style="float:left;margin:25px 0px;width: 100%;">
				<div class="back-button">
					<a href="events.php?n=<?php echo $_GET['n']?>"class="btn btn-primary"><i class="fa fa-arrow-left" style="padding: 0px 4px;
    font-size: 14px;"></i>Back</a>
				</div>
				<div class="heading">
					<p>Book An Appointment</p>
				</div>
				<div class="sub-heading">
					<p>This is the type of event made by <?php echo $_GET['n'];?></p>
				</div>
			</div>
			<div class="alldetail">
			<div class="col-sm-6">
			<div class="contain-details" id="con-details">
				</div>
			</div>
				<div class="col-sm-6">
					<div id="a">
						<div class="cal1"></div>
						<!-- <div class="nxt-button">
							<button class="btn btn-primary" onclick="getslot()">Select Time</button>
						</div> -->
					</div>
					<div id="b">
					
					<div class="slot-details" id="slot-details"></div>
					</div>
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
                            
        	                date=target['date']['_i'];
        	               	getslot();
        	                    $("#event").empty();
        	            }
        	        },
        	        
        	        showAdjacentMonths: true,
        	        adjacentDaysChangeMonth: false
        	    });
        });
    
    </script>
			
		</div>
		<div class="col-sm-2"></div>
	</div>
</section>
<script type="text/javascript">
	function getevent()
	{
		var ename="<?php echo $_GET['e']?>";
		var name="<?php echo $_GET['n']?>";
		var token="<?php echo password_hash("getevent", PASSWORD_DEFAULT)?>";
		if(ename!="" && name!="")
		{
		$.ajax(
									{
										type:'POST',
										url:"ajax/getevent.php",
										data:{ename:ename,name:name,token:token},
										success:function(data)
										{
											//alert(data);
											$('#con-details').html(data);
										}
									});
		}
		else
		{

		}
	}

	getevent();
	function getslot()
	{
		var a=document.getElementById('a');
    	var b=document.getElementById('b');	
    		a.classList.add('hidden');
			b.classList.remove('hidden');
			b.classList.add('show');
		var ename="<?php echo $_GET['e']?>";
		var name="<?php echo $_GET['n']?>";
		var token="<?php echo password_hash("getslot", PASSWORD_DEFAULT)?>";
		//alert(date);
		
		if(ename!="" && name!="")
		{
		$.ajax(
									{
										type:'POST',
										url:"ajax/getslot.php",
										data:{ename:ename,name:name,date:date,token:token},
										success:function(data)
										{
											//alert(data);
											$('#slot-details').html(data);
										}
									});
		}
	}

</script>
</body>
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</html>
