<?php
	include('../connection.php');
    session_start();
    if( $_SESSION['apikey'] == $_GET['token'])
	{
		$check=$db->prepare('SELECT * FROM event_details');
        $data=array();
        $check->execute($data);
        while($datarow=$check->fetch())
        {
            if(password_verify($datarow['id'],$_POST['id']))
            {
            	$did=$datarow['id'];
            	break;
            }
        }
        $check=$db->prepare('DELETE FROM event_details where id=?');
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