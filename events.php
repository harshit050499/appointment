<?php 
	session_start();
	// if( $_SESSION['mail']=="")
	// {
	// 	header("Location:index.php");
	// }
	if($_GET['n']=="")
	{
		header("Location:error.php");
	}
	$name=$_GET['n'];
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

<section>
    <div class="col-sm-12">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
       <div class="contain-head" style="width: 100%;float:left;margin: 25px 0px;">
       
        <div class="heading">
          <p>SCHEDULED EVENTS</p>
        </div>
        <div class="sub-heading">
          <p>This are all the events which are schduled by <?php echo $_GET['n'];?></p>
        </div>
      </div>
      <div class="contain-event">
        <div class="event-list" id="event-list"></div>
      </div>
      </div>
      <div class="col-sm-2"></div>
    </div>
</section>
<script>
  function getevent()
  {
    
    var name="<?php echo $_GET['n']?>";
    var token="<?php echo password_hash("eventlist", PASSWORD_DEFAULT)?>";
    if( name!="")
    {
    $.ajax(
                  {
                    type:'POST',
                    url:"ajax/eventlist.php",
                    data:{name:name,token:token},
                    success:function(data)
                    {
                     // alert(data);
                      $('#event-list').html(data);
                    }
                  });
    }
    else
    {

    }
  }
  
  getevent();
</script>
</body>
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</html>