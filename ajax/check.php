<?php
    include('../connection.php');
    session_start();
    if(password_verify($_SESSION['mail'], $_POST['token']))
    {
        $check=$db->prepare('SELECT * from slotlist');
            $data=array();
            $check->execute($data);
            $count=0;
            if($check->rowcount()>0)
            {
                while($datarow=$check->fetch())
                {
                    
                    ?>
                    <div class="col-sm-3">
                        <div class="" style="float: left;width: 100%;">
                            <input type="checkbox" name="check_list[]" value="<?php echo $datarow['id'] ?>"><label style="padding: 10px 17px;"><?php echo $datarow['start'].'-'.$datarow['end']?></label>
                        </div>
                        
                        </div>
                        <?php
                    }
                    $count++;
            }
        
    }

?>