<?php
  include('../connection.php');
    session_start();
  if(password_verify($_SESSION['mail'],$_POST['token']))
  {
        $result="";
        foreach ($_POST['check_list'] as $selected) {
            $result=$result.$selected.',';

        }
        
     $check=$db->prepare('INSERT INTO available(user_id,slot) VALUES(?,?)');
        $data=array($_SESSION['id'],$result);
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
    }

?>