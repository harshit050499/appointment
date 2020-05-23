<?php
	include('../connection.php');
    session_start();
	if(password_verify($_SESSION['mail'],$_POST['token']))
	{
        $userid;
        $ename=test_input($_POST['ename']);
        $name=test_input($_POST['name']);
         $check=$db->prepare('SELECT * FROM  user_details WHERE name=?');
        $data=array($name);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            $userid=$datarow['id'];
        }
        if(validiate_input($ename,0))
        {
             $check=$db->prepare('SELECT * FROM  event_details WHERE ename=? && user_id=?');
            $data=array($ename,$userid);
              $check->execute($data);
             while($datarow=$check->fetch())
             {
                ?>
                
                    <div class="col-sm-6">
                        <div class="details">
                            <div class="contain-name">

                                <p><?php echo $ename?></p>
                            </div>
                            <div class="contain-type">
                                <?php
                                    if($datarow['etype'] == "location")
                                    {
                                        ?>
                                        <p><i class="fa fa-map-marker" ></i>Location Based</p>
                                        <?php
                                    }
                                    if($datarow['etype'] == "phone")
                                    {
                                         ?>
                                         <p><i class="fa fa-phone"></i>Telephonic</p>
                                        <?php
                                    }
                                    if($datarow['etype']  == "videocall")
                                    {
                                         ?>
                                         <p><i class="fa fa-video-camera"></i>Video Conferencing</p>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>   
                    </div>
                <?php } ?>
                    <div class="col-sm-6">
                        <div class="header">
                        <p>AVAILABLE SLOT</p>
                    </div>
                        <?php
                        $check=$db->prepare('SELECT * FROM  user_details WHERE name=?');
                        $data=array($name);
                        $check->execute($data);
                        while($datarow=$check->fetch())
                        {
                            $userid=$datarow['id'];
                        }
                        $result;
                        $check=$db->prepare('SELECT * FROM  available WHERE user_id=?');
                        $data=array($userid);
                        $check->execute($data);
                        while($datarow=$check->fetch())
                        {
                            $a[]=explode(",", $datarow['slot']);
                        }
        
                        $check=$db->prepare('SELECT * FROM  slotlist');
                        $data=array();
                        $check->execute($data);
                        while($datarow=$check->fetch())
                        {

                            if(in_array($datarow['id'], $a[0]))
                            {
                            ?>
                                <div class="single-slot">
                                    <div class="col-sm-6">
                                         <div class="detail">
                                            <p><?php echo $datarow['start']."-".$datarow['end'];?></p>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="contain-button">
                                    <a href="booking.php?n=<?php echo $name?>&s=<?php echo $datarow['id']?>&eid=<?php echo $ename?>" class="btn btn-primary">Confirm</a>
                                </div>
                            </div>
                            </div>
                
                                <?php
                                 }
                        }
                                ?>
                    
              
                
                    
                </div>
                <?php
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