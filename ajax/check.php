<?php
    include('../connection.php');
    session_start();
    if($_SESSION['apikey'] == $_GET['token'])
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
                        <div class="indi-slot" style="float: left;width: 100%;">
                           <input class="form-control" type="checkbox" name="check_list[]" value="<?php echo $datarow['id'] ?>">
                           <div style="text-align: center;"><label style="padding: 10px;"><?php echo $datarow['start'].'-'.$datarow['end']?></label></div>
                        </div>
                        
                        </div>
                        <?php
                   
                     
            }
        
    }
}
?>