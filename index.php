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
	.optionbutton
	{
		margin: 50px 0px;
		width: 100%;
    float: left;
	}
	.contain-forms
	{
		margin: 25px 0px;
	}
</style>
<body style="background-color:#06508f; "> 
	<section style="margin-top: 30px;">
		<div class="col-sm-12">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="main-head">
					<p>APPOINTMENT BOOKING SYSTEM</p>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</section>
	<section>
	<div class="col-sm-12">
		
		<div class="col-sm-4">
			
		</div>
		
		<div class="col-sm-4">
			<div class="optionbutton" style="text-align: center;">
			<div class="col-sm-6">
				<button id="loginbutton" onclick="showlogin();">LOG IN</button>
			</div>
			<div class="col-sm-6">
				<button id="signupbutton" onclick="showsignup();">SIGN UP</button>
			</div>
			</div>
			<div class="contain-forms">
				<div class="login-form " id="loginform">
					<form>
						<fieldset>
						<div class="form-group">
							<label for="name">Email:</label>
							<input class="form-control" type="email" name="email" id="email">
						</div>
						<div class="form-group">
							<label for="name">Password:</label>
							<input class="form-control" type="password" name="password" id="password">
						</div>
					
						<div class="button" style="text-align: center;margin: 25px 0px;">
                                <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="login();">
                            </div>
                        </fieldset>
					</form>
				</div>
				<div class="signup-form hidden" id="signupform">
					<form id='form'>
						<fieldset>
						<div class="form-group">
							<label for="name">NAME:</label>
							<input class="form-control" type="text" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="name">Email:</label>
							<input class="form-control" type="email" name="email" id="email11">
						</div>
						<div class="form-group">
							<label for="name">Password:</label>
							<input class="form-control" type="password" name="password" id="password11">
						</div>
						<div class="form-group">
							<label for="name">Confirm Password</label>
							<input class="form-control" type="password" name="cpassword" id="cpassword">
						
						<div class="button" style="text-align: center;margin: 25px 0px;">
                                <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="save();">
                            </div>
                       
                    </fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	function showlogin()
	{
		var login=document.getElementById('loginform');
		var signup=document.getElementById('signupform');
		signup.classList.add('hidden');
		login.classList.remove('hidden');
		login.classList.add('show');
	}
	function showsignup()
	{
		var login=document.getElementById('loginform');
		var signup=document.getElementById('signupform');
		login.classList.add('hidden');
		signup.classList.remove('hidden');
		signup.classList.add('show');
	}
	function login()
	{
		var email=document.getElementById('email').value;
		var pass=document.getElementById('password').value;
		var token='<?php echo password_hash("login", PASSWORD_DEFAULT);?>';
		if(email!="" && pass!="")
		{
			if (ValidateEmail(email)) {

				$.ajax(
				{
					type:'POST',
					url:"ajax/login.php",
					data:{email:email,pass:pass,login:'login',token:token},
					success:function(data)
					{
						if(data == 0)
						{
							window.location = "dashboard.php";
						}
						else if(data == 1)
						{
							alert('invalid credentials');
						}
						else
						{
							alert(data);
						}
					}
				});
			}
		}

	}
	
	function save()
	{
			

			var name=document.getElementById('name').value;
			var email=document.getElementById('email11').value;
			var pass=document.getElementById('password11').value;
			var cpass =document.getElementById('cpassword').value;
			
			if(name!="" && email!="" && pass!="" && cpass!="" )
			{
			var a = ValidateEmail(email);
            var b = passmatch(pass,cpass);
            
            
				if( a== true && b== true){
                    $.ajax({
                                        type: "POST",
                                        url: "ajax/signup.php",
                                        data: {name:name,pass:pass,cpass:cpass,email:email,signup:'signup'},
                                        success: function(data){
                                          
                                             if(data == 3){
                                                alert('You are already registered. kindly Login.');

                                             }
                                             else if(data == 0){
                                                alert('registered sucessfully !. ');
                                                
                                                window.location.reload();
                                             }
                                             else if(data == 4)
                                             {
                                             	alert('name exist.Please enter another name!');
                                             }
                                             else if(data==7)
                                             {
                                             	alert("something went wrong");
                                             }
                                             else{
                                                alert(data);
                                             }
                                     
                                         
                                        }
                                      });
              }
			}
			else
			{
				alert("INPUT ALL THE DATA");
			}
	}
	function ValidateEmail(mail){     
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if(reg.test(mail)){
            return true;
        }
        else{
                alert("You have entered an invalid email address!");   
                return false;
            }
}
function passmatch(a,b){
   
    if(a == b){ return (true);}
    else{ alert("You have entered an invalid Password!"); return(false); }
}
</script>
</section>

<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</body>

</html>