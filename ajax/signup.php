
<?php
function keygen($length=10)
{
    $key = '';
    list($usec, $sec) = explode(' ', microtime());
    mt_srand((float) $sec + ((float) $usec * 100000));
    
    $inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));

    for($i=0; $i<$length; $i++)
    {
        $key .= $inputs{mt_rand(0,61)};
    }
    return $key;
}

	include('../connection.php');
    session_start();
	if(isset($_POST["signup"]))
	{
		
		$name=test_input($_POST['name']);
		$email=test_input($_POST['email']);
		$pass=test_input($_POST['pass']);
		$cpass=test_input($_POST['cpass']);
		$flag=0;
        $key=password_hash(keygen(), PASSWORD_DEFAULT);
		if(validiate_input($name,0) && validiate_input($email,1) && validiate_input($pass,2))
		{
			$check=$db->prepare('SELECT * from user_details WHERE  email = ?');
			$data=array($email);
			$check->execute($data);
			if($check->rowCount() == 1)
			{
				$flag=1;
				echo 3;
			}
			if($flag==0)
			{
				$password1_hash=password_hash($pass,PASSWORD_DEFAULT);
				$query=$db->prepare("INSERT INTO user_details(name,email,password,apikey) VALUES (?, ?, ?,?)");
				$data=array($name,$email,$password1_hash,$key);
				$execute=$query->execute($data);
				if($execute)
				{
					
					echo 0;
				}
				else
				{
					echo 7;
				}
			}
		}
	}




	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function validiate_input($data, $type){

    if($type==0){
        //echo "0";
        if(preg_match('/[^a-zA-Z0-9 ._-]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }
    }
    if($type==1){
        //echo "1";
        if (preg_match("/^[a-zA-Z0-9 ._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $data)) {
            //echo "match";
            return true;
        }else{
            //echo "injection";
            return false;
        }

    }
    if($type==2){
        //echo "2";
        if (preg_match('/[^a-zA-Z0-9@&_-]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }

    }
    if($type==3){
        //echo "2";
        if (preg_match('/[^a-zA-Z0-9 _,]+/i', $data)) {
            //echo "injection";
            return false;
        }else{
            //echo "match";
            return true;
        }

    }

}
?>