<?php  
require 'db-res.php';  

if(!empty($_POST['dev_id'])){

    $device=$_POST['device'];
    $imei=$_POST['imei'];
    $sn=$_POST['sn'];
    
    $man=$_POST['man'];
    
    $modelname=$_POST['modelname'];
    $cid=$_POST['cid'];
    $malname=$_POST['malname'];
    $order=$_POST['status'];


    $query="SELECT id FROM customers WHERE id= $cid";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0){?>
        <script> location.replace("../showdevices.php?error=nocust");</script>
        <?php
        
        exit(); 
    }
    
    $query="UPDATE device 
        SET category='$device',
        imei='$imei',
        sn='$sn',
        manufacturer='$man',
        model_name='$modelname', 
        mal_name='$malname',
        cust_id='$cid',
        order_status='$order'
        WHERE id='".$_POST['dev_id']."'";
        if (mysqli_query($conn, $query)) {
            echo "Record updated successfully";
        }else{
            echo "Error updating record: " . mysqli_error($conn);
        }?>
    <script> location.replace("../showdevices.php?update=success");</script>
    <?php
    
}
