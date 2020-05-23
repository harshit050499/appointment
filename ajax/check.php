<?php
    include('../connection.php');
    session_start();
    if(1)
    {
        $check=$db->prepare('SELECT * from slotlist');
            $data=array();
            $check->execute($data);
            if($check->rowcount()>0)
            {
                while($datarow=$check->fetch())
                {
                    ?>
                    <div class="col-sm-3">
                        <input type="checkbox" name="check_list[]" value="<?php echo $datarow['id'] ?>"><label style="padding: 10px 18px;"><?php echo $datarow['start'].'-'.$datarow['end']?></label>
                        </div>
                    <?php
                }
        
    }
}
?>