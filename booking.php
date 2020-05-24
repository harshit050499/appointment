<?php 
	// if( $_SESSION['mail']=="")
	// {
	// 	header("Location:index.php");
	// }
	if($_GET['n']=="" && $_GET['e']=="")
	{
		header("Location:error.php");
	}
	//$event=$_GET['e'];
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
<!-- <nav class="navbar navbar-inverse">
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
</nav> -->
<section>
    <div class="col-sm-12">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
       <!-- <div class="contain-head">
        <div class="back-button">
          <button class="btn btn-primary"><i class="fa fa-arrow-left" style="padding: 0px 4px;
    font-size: 14px;"></i>Back</button>
        </div> -->
        <div class="heading">
          <p>CONFIRM BOOKING</p>
        
        
      </div>
      <div class="contain-details" id="contain-details">
        
      </div>
      <div class="col-sm-2"></div>
    </div>
</section>
<script>
  function getevent()
  {
    
    var slot="<?php echo $_GET['s']?>";
    var eid="<?php echo $_GET['eid']?>";
    var name="<?php echo $_GET['n']?>";
    var token="<?php echo $_GET['token']?>";
    if( slot!="" && eid!="" && name!="")
    {
    $.ajax(
                  {
                    type:'POST',
                    url:"ajax/booking.php",
                    data:{slot:slot,eid:eid,name:name,form:"form",token:token},
                    success:function(data)
                    {
                      //alert(data);
                      $('#contain-details').html(data);
                    }
                  });
    }
    else
    {

    }
  }
  
  getevent();
  function save()
  {
    var name=document.getElementById('name').value;
    var email=document.getElementById('email').value;
    var spec=document.getElementById('spec').value;
     var slot="<?php echo $_GET['s']?>";
    var eid="<?php echo $_GET['eid']?>";
    var user="<?php echo $_GET['n']?>";
    var date="<?php echo $_GET['d']?>";
    if( slot!="" && eid!="" && name!="")
    {
    $.ajax(
                  {
                    type:'POST',
                    url:"ajax/bookinglog.php",
                    data:{slot:slot,eid:eid,user:user,name:name,email:email,date:date,spec:spec,submit:"<?php echo password_hash("submit", PASSWORD_DEFAULT)?>"},
                    success:function(data)
                    {
                      if(data==0)
                      {
                        alert('Appointment Booked Successfully');
                        window.location.href = "events.php?n=<?php echo $_GET['n'];?>";
                      }
                      else
                      {
                        alert(data);
                      }
                      
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