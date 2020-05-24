<?php
	include('../connection.php');
    session_start();
    if( $_SESSION['apikey'] == $_GET['token'])
	{
		$check=$db->prepare('SELECT * FROM bookinglog');
        $data=array();
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            if(password_verify($datarow['tid'],$_POST['id']))
            {
            	$did=$datarow['tid'];
            	break;
            }
        }
        $check=$db->prepare('DELETE FROM bookinglog where tid=?');
        $data=array($did);
        $execute=$check->execute($data);
        if($execute)
        {
        	echo 0;
        }
        else
        {
        	echo 1;
        }

	}
    ?>