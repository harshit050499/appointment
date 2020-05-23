<?php
	include('../connection.php');
    session_start();
	if(isset($_POST['form']))
	{
        $userid;
        $value;
        $name=test_input($_POST['name']);
        $slotid=test_input($_POST['slot']);
        $eid=test_input($_POST['eid']);
         $check=$db->prepare('SELECT * FROM  user_details WHERE name=?');
        $data=array($name);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            $userid=$datarow['id'];
        }
        $check=$db->prepare('SELECT * FROM  slotlist WHERE id=?');
        $data=array($slotid);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            $start=$datarow['start'];
            $end=$datarow['end'];
        }

        if(validiate_input($eid,0))
        {
             $check=$db->prepare('SELECT * FROM  event_details WHERE ename=? && user_id=?');
            $data=array($eid,$userid);
              $check->execute($data);
             while($datarow=$check->fetch())
             {
                ?>
                <div class="col-sm-6">
                    <div class="details">
                        <div class="contain-name">
                            <p><?php echo $datarow['ename']?></p>
                        </div>
                        <div class="contain-type">
                            <?php
                                if($datarow['etype'] == "location")
                                {
                                    $value="l";
                                    ?>
                                    <p><i class="fa fa-map-marker" ></i>Location Based</p>
                                    <?php
                                }
                                if($datarow['etype'] == "phone")
                                {
                                    $value="t";
                                     ?>
                                     <p><i class="fa fa-phone"></i>Telephonic</p>
                                    <?php
                                }
                                if($datarow['etype']  == "videocall")
                                {
                                    $value="v";
                                     ?>
                                     <p><i class="fa fa-video-camera"></i>Video Conferencing</p>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="contain-time">
                            <p><i class="fa fa-clock-o" style="padding: 8px;font-size: 30px;"></i><?php echo $start."-".$end?></p>
                        </div>
                        <div class="contain-des">
                        <p><?php  echo $datarow['description'];?></p>
                        </div>
                    </div>
               
                
                
                    
                
                <?php
             }
             ?>
        
     </div>

            <div class="col-sm-6">
                <div class="booking-form">
                    <div class="heading">
                        <p>Invitee Detail</p>
                    </div>
                    <div class="contain-form">
                        <form id='form'>
                               
                                    <div class="form-group">
                                    <label for="name"> Name:</label>
                                    <input class="form-control" type="text" name="name" id="name">
                                    </div>
                                    <div class="form-group">
                                    <label for="name">Email:</label>
                                    <input class="form-control" type="email" name="email" id="email">
                                    </div>
                                    <!-- <div class="form-group">
                                    <label for="name">Event Color:</label>
                                    <input class="form-control" type="text" name="tname" id="tname">
                                    </div> -->
                                    <div class="form-group">
                                    <label for="name">Specification</label>
                                    <?php
                                        if($value == 't')
                                        {
                                    ?>
                                    <input class="form-control" type="text" name="spec" id="spec" placeholder="Phone No">
                                    <?php } ?>
                                    <?php
                                        if($value == 'l')
                                        {
                                    ?>
                                    <input class="form-control" type="text" name="spec" id="spec" placeholder="Place of meet">
                                    <?php } ?>
                                    <?php
                                        if($value == 'v')
                                        {
                                    ?>
                                    <input class="form-control" type="text" name="spec" id="spec" placeholder="skype Id">
                                    <?php } ?>
                                    </div>
                                    <div class="button" style="text-align: center;margin: 25px 0px;">
                                 <input  class="button-submit btn btn-primary " type="submit" name="submit" style="background: rgb(177,4,0) !important; border:none !important; color: white !important;" onclick="save();">
                            </div>
                                </form>
                    </div>
                </div>
            </div>

                <script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
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