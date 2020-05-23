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
       <button class="btn btn-outline-success my-2 my-sm-0" type="submit">logout</button>
     
    </ul>
  </div>
</nav>
<section>
	<div class="col-sm-12">

		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="contain-head">
				<div class="back-button">
					<button class="btn btn-primary"><i class="fa fa-arrow-left" style="padding: 0px 4px;
    font-size: 14px;"></i>Back</button>
				</div>
				<div class="heading">
					<p>Create A New Event</p>
				</div>
			</div>
			<div class="event-contain" style="float: left;width: 100%;">
						<div class="contain-form" style="float: left;width: 100%;">
							<form id='form'>
								<input type="hidden" id="token" name="token" value="<?php echo password_hash($_SESSION['mail'], PASSWORD_DEFAULT)?>">
									<div class="form-group">
									<label for="name">Event Name:</label>
									<input class="form-control" type="text" name="ename" id="ename">
									</div>
									<div class="form-group">
									<label for="name">Event Type:</label>
									<input class="form-control" type="text" name="etype" id="etype">
									</div>
									<!-- <div class="form-group">
									<label for="name">Event Color:</label>
									<input class="form-control" type="text" name="tname" id="tname">
									</div> -->
									<div class="form-group">
									<label for="name">Description/Instruction:</label>
									<textarea class="form-control" type="text" name="des" id="des" placeholder="any specific information invitee should know"></textarea> 
									</div>
									<div class="button" style="text-align: center;margin: 25px 0px;">
	                             <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="save();">
	                        </div>
								</form>
							</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</section>
<script type="text/javascript">
	function save()
		{
									
									var ename=document.getElementById('ename').value;
									var etype=document.getElementById('etype').value;
									var des=document.getElementById('des').value;
									var token=document.getElementById('token').value;
									if(ename!="" && etype!="")
									{
										$.ajax(
										{
											url:"ajax/addevent.php",  
							                method:"POST",  
							                data:{ename:ename,etype:etype,des:des,add:"add",token:token},  
							                 
							                success:function(data){  
							                  if(data==0)
							                  {
							                  	alert('Type of Event added successfully');
							                  }
							                  else if(data==1)
							                  {
							                  	alert('Error!please try again');
							                  }
							                  else if(data==2)
							                  {
							                  	alert("Enter a Valid Input");
							                  }
							                  else
							                  {
							                  	alert(data);
							                  }
							            }  
										});
								}
								else
								{
									alert('please fill all the fields');
								}
		}
</script>
</body>
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</html>