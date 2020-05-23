<?php
	include('../connection.php');
    session_start();
	if(password_verify($_SESSION['mail'],$_POST['token']) && $_POST['submit'] == "submit")
	{
		$userid;
		 $check=$db->prepare('SELECT * FROM  user_details WHERE email=?');
        $data=array($_SESSION['mail']);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            $userid=$datarow['id'];
        }
         $check=$db->prepare('SELECT * FROM  event_details WHERE user_id=?');
        $data=array($userid);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
           ?>
           <div class="col-sm-4">
           	<div class="single-myevent">
           		<div class="my-eventtop"></div>
           		<div class="myevent-det">
           		<div class="myevent-name">
           			<p><?php echo $datarow['ename']?></p>
           		</div>
           		<div class="myevent-type">
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
                            <div class="myevent-des">
                                <p><?php echo $datarow['description'];?></p>
                            </div>
                </div>
                <div class="deletebutton">
                	<a href="delete.php?sid=<?php echo password_hash($datarow['id'], PASSWORD_DEFAULT)?>" class="btn btn-danger1">Delete</a>
                </div>
           	</div>
           </div>
           <?php
        }

	}
	?>