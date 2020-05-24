<?php
	include('../connection.php');
    session_start();
   
	if($_SESSION['apikey'] == $_GET['token'])
	{
       $ename=test_input($_POST['ename']);
     $etype=test_input($_POST['etype']);
     $des=test_input($_POST['des']);
    if(validiate_input($ename,0) && validiate_input($etype,0) && validiate_input($des,0) )
    {
         $check=$db->prepare('INSERT INTO event_details(ename,etype,description,user_id) VALUES(?,?,?,?)');
        $data=array($ename,$etype,$des,$_SESSION['id']);
         $execute= $check->execute($data);
            if($execute)
            {
               echo 0;
           }
           else
           {
            echo 1;
           }

    }
    else
    {
        echo 2;
    }
		
	}
    else
    {     
      echo 7;   
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