<?php
  include('../connection.php');
    session_start();
  if($_GET['token'] == $_SESSION['apikey'])
  {
        $result="";
        $flag=0;
         $date=test_input($_POST['date']);
        foreach ($_POST['check_list'] as $selected) {
             $result=$result.$selected.',';

        }
       if($result!="" && $date!="")
       { 
         $check=$db->prepare('SELECT * FROM available');
          $data=array();
          $check->execute();
          while($datarow=$check->fetch())
          {
            if($datarow['date'] == $date && $datarow['user_id'] == $_SESSION['id'])
            {
              $flag=1;
            }
          }
          if($flag==0)
          {
          $check=$db->prepare('INSERT INTO available(user_id,slot,date) VALUES(?,?,?)');
          $data=array($_SESSION['id'],$result,$date);
          $execute= $check->execute($data);
            if($execute)
            {
               echo 0;
             }
           else
           {
            echo 1;
           }
          }
          else
          {
          $check=$db->prepare('UPDATE available SET slot=? WHERE user_id=?');
          $data=array($result,$_SESSION['id']);
          $execute= $check->execute($data);
           if($execute)
            {
               echo 0;
             }
           else
           {
            echo 1;
           }
          }
    }
         
    
  }
    else
    {        
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