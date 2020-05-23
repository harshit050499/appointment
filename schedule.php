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
	<section>
		<div class="col-sm-12">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
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
	</script>
</body>

</html>