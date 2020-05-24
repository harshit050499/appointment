<?php
		include('../connection.php');
    session_start();
	if($_SESSION['apikey'] == $_GET['token'])
	{
		$check=$db->prepare('SELECT b.tid,b.iname,b.spec,b.username,b.sid,b.eid,b.date,s.start,s.end,e.ename,e.etype FROM `bookinglog` as b JOIN user_details as u ON b.username=u.name JOIN slotlist as s ON s.id=b.sid JOIN event_details as e ON e.id=b.eid WHERE b.username=?');
        $data=array($_SESSION['name']);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
        	?>
        	<div class="single-schedule">
        		<div class="col-sm-2">
        			
        			<p><b>TIME:&nbsp;</b><?php echo $datarow['start']."-".$datarow['end']?><br><b>DATE:&nbsp;</b><?php echo $datarow['date']?></p>
        		</div>
        		<div class="col-sm-2">
        			<p><b>INVITEE NAME<br></b><?php echo $datarow['iname']?></p>
        		</div>
                <div class="col-sm-2">
                    <p><b>EVENT NAME<br></b><?php echo $datarow['ename']?></p>
                </div>
        		<div class="col-sm-2">
        			<p><b>Meeting at<br></b><?php echo $datarow['spec'];?></p>
        		</div>
               

                
        		<div class="col-sm-2">
        			<button onclick="cancel('<?php echo password_hash($datarow['tid'], PASSWORD_DEFAULT);?>');" class="btn btn-danger1">Cancel</button>
        		</div>
                <div class="col-sm-2">
                    <button onclick="cancel('<?php echo password_hash($datarow['tid'], PASSWORD_DEFAULT);?>');" class="btn btn-primary">ADD TO CALENDER</button>
                </div>
        	</div>
        	<?php
           
           
        }
	}
?>