<?php
		include('../connection.php');
    include('../email.php');
        
   
	if(password_verify("submit",$_POST['submit']))
	{
		$name=test_input($_POST['name']);
		$email=test_input($_POST['email']);
		$spec=test_input($_POST['spec']);
		$sid=test_input($_POST['slot']);
		$username=test_input($_POST['user']);
		$eventname=test_input($_POST['eid']);
        $date=test_input($_POST['date']);
		$eventid;
        $time;
		if(validiate_input($email,1) && validiate_input($name,0) && validiate_input($spec,0) && validiate_input($sid,0) && validiate_input($username,0) && validiate_input($eventname,0))
		{
		 	$check=$db->prepare('SELECT * FROM  event_details WHERE ename=?');
            $data=array($eventname);
              $check->execute($data);
             while($datarow=$check->fetch())
             {
             	$eventid=$datarow['id'];
             }
             $check=$db->prepare('SELECT * FROM  slotlist WHERE id=?');
            $data=array($sid);
              $check->execute($data);
             while($datarow=$check->fetch())
             {
                $time=$datarow['start']."-".$datarow['end'];
             }
             $query=$db->prepare("INSERT INTO bookinglog(iname,iemail,spec,sid,username,eid,date) VALUES (?, ?, ?,?,?,?,?)");
			 $data=array($name,$email,$spec,$sid,$username,$eventid,$date);
			 $execute=$query->execute($data);
			if($execute)
			{
					//send_mail($email,$username,$time,$date);
					echo 0;
					
			}
			else
			{
					echo 7;
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
