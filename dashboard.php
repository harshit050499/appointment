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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <button class="btn btn-primary my-2 my-sm-0" type="submit">logout</button>
     
    </ul>
  </div>
</nav>
<section>
	<div class="col-sm-12">
		<div class="heading">
			<p>AVAILBILITY SLOT</p>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="slot-list" style="float: left;width: 100%;">
				<form id="aform">
					<input type="hidden" name="token" id="token" value="<?php echo password_hash($_SESSION['mail'], PASSWORD_DEFAULT)?>">
					<div class="list" id="list"></div>
				
				
				
			</div>
			
			<div class="button" style="text-align: center;margin: 25px 0px;">
	                             <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="save();">
	                        </div>
		</div>
		<div class="col-sm-2">
		</div>
	</div>
</section>
	<script type="text/javascript">
		getlist();
		function getlist()
		{

			$.ajax(
									{
										type:'POST',
										url:"ajax/check.php",
										
										success:function(data)
										{
											alert(data);
											$('#list').html(data);
										}
									});
		}
		function save()
		{
									var form=document.getElementById('aform');
									
									//alert(test);
									var data = new FormData(form);
									$.ajax(
									{
										url:"ajax/export.php",  
						                method:"POST",  
						                data:data,  
						                contentType:false,  
						                processData:false,  
						                success:function(data){  
						                  alert(data);
						            }  
									});
		}
	</script>
</body>
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</html>