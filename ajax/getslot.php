<?php
	include('../connection.php');
    
	if(password_verify("getslot",$_POST['token']))
	{
		 $userid;
        $sid;
        $flag=0;
        $name=test_input($_POST['name']);
        $ename=test_input($_POST['ename']);
         $check=$db->prepare('SELECT * FROM  user_details WHERE name=?');
        $data=array($name);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            $userid=$datarow['id'];
        }
        $result;
        $check=$db->prepare('SELECT * FROM  available WHERE user_id=? && date=?');
        $data=array($userid,$_POST['date']);
        $check->execute($data);
        //$a=array();
        while($datarow=$check->fetch())
        {
            $a[]=explode(",", $datarow['slot']);
        }
        //var_dump($a[0]);
        if(!empty($a))
        {
        $check=$db->prepare('SELECT * FROM  slotlist');
        $data=array();
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            $flag=0;
        	if(in_array($datarow['id'], $a[0]))
        	{
                 $check1=$db->prepare('SELECT * FROM  bookinglog WHERE username=?');
                 $data1=array($name);
                 $check1->execute($data1);
                while($datarow1=$check1->fetch())
                {
                    
                    if($_POST['date']==$datarow1['date'] && $datarow['id']==$datarow1['sid'])
                    {
                        $flag=1;
                    }
                
                }
                
        		?>
        		<div class="single-slot">
        		<div class="col-sm-6">
        			<div class="detail">
        				<p><?php echo $datarow['start']."-".$datarow['end'];?></p>
        			</div>
        		</div>
                <?php 
                if($flag == 0)
                {
                ?>
        		<div class="col-sm-6">

        			<div class="contain-button">
        				<a href="booking.php?n=<?php echo $name?>&s=<?php echo $datarow['id']?>&eid=<?php echo $ename?>&d=<?php echo $_POST['date'] ?>&token=<?php echo password_hash("booking", PASSWORD_DEFAULT)?>" class="btn btn-success">Confirm</a>
        			</div>

        		</div>
                <?php 
                }
                else
                {
                ?>
                <div class="booked-text">
                    <p>SLOT BOOKED</p>
                </div>
        		</div>

        		
        		<?php
                }
        	}
	}

}
else
{
    ?>
    <div class="booked-text">
                    <p>No slots available</p>
                </div>
                <?php
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