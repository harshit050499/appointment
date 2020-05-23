<?php
		include('../connection.php');
    session_start();
	if(password_verify($_SESSION['mail'],$_POST['token']))
	{
		$check=$db->prepare('SELECT b.tid,b.iname,b.spec,b.username,b.sid,b.eid,b.date,s.start,s.end FROM `bookinglog` as b JOIN user_details as u ON b.username=u.name JOIN slotlist as s ON s.id=b.sid WHERE b.username=?');
        $data=array($_SESSION['name']);
        $check->execute($data);
        while($datarow=$check->fetch())
        {
        	?>
        	<div class="single-schedule">
        		<div class="col-sm-3">
        			
        			<p><?php echo $datarow['start']."-".$datarow['end']?><br><?php echo $datarow['date']?></p>
        		</div>
        		<div class="col-sm-3">
        			<p><?php echo $datarow['iname']?></p>
        		</div>
        		<div class="col-sm-3">
        			<p><?php echo $datarow['spec'];?></p>
        		</div>
        		<div class="col-sm-3">
        			<a href="cancel.php?id=<?php echo password_hash($datarow['tid'], PASSWORD_DEFAULT);?>&token=<?php echo password_hash("delete", PASSWORD_DEFAULT)?>" class="btn btn-danger1">Cancel</a>
        		</div>
        	</div>
        	<?php
           
           
        }
	}
?>