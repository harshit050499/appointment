<?php
	include('../connection.php');
    session_start();
	if(1)
	{
        $userid;
        $name=test_input($_POST['name']);
         $check=$db->prepare('SELECT * FROM  user_details WHERE name=?');
        $data=array($name);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            $userid=$datarow['id'];
        }
        if(validiate_input($name,0))
        {
             $check=$db->prepare('SELECT * FROM  event_details WHERE  user_id=?');
            $data=array($userid);
              $check->execute($data);
             while($datarow=$check->fetch())
             {
                ?>
                <div class="contain-list">
                    <div class="col-sm-4">
                        <div class="single-event">
                            <div class="event_details">
                                <div class="contain-name">
                                    <p><?php echo $datarow['ename'];?></p>
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
                            <div class="contain-des">
                                <p><?php echo $datarow['description'];?></p>
                            </div>
                        </div>
                    </div>
                    <div class="contain-button"></div>
                </div>
                <?php
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