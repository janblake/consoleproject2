<?php
require 'db-res.php'; 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['submit'])){
    $device=$_POST['device'];
    $imei=$_POST['imei'];
    $sn=$_POST['sn'];
    $man=$_POST['man'];
    $model=$_POST['modelname'];
    if(isset($_POST['cid'])){
        $cid=$_POST['cid']; 
    }else{
        $cid="";
    }
    if(isset($_POST['malname'])){
        $malname=$_POST['malname'];
    }else{
        $malname=""; 
    }
    
    
    $date=date("Y-m-d");

    
    $sql = "INSERT INTO device (cust_id,category,imei,sn,manufacturer,model_name,mal_name,order_status,entry_date) VALUES (?,?,?,?,?,?,?,'Control',?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../newdevice.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"isisssss",$cid,$device,$imei,$sn,$man,$model,$malname,$date); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../newdevice.php?signup=success");

}else{
    header("Location: ../newdevice.php");
}


if(isset($_POST['subdev'])){
    $device=$_POST['device'];
    $imei=$_POST['imei'];
    $sn=$_POST['sn'];
    $man=$_POST['man'];
    $model=$_POST['modelname'];
    if(isset($_POST['cid'])){
        $cid=$_POST['cid']; 
    }else{
        $cid="";
    }
    if(isset($_POST['malname'])){
        $malname=$_POST['malname'];
    }else{
        $malname=""; 
    }
    
    
    $date=date("Y-m-d");

    
    $sql = "INSERT INTO device (cust_id,category,imei,sn,manufacturer,model_name,mal_name,order_status,entry_date) VALUES (?,?,?,?,?,?,?,'Control',?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../newmovement.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"isisssss",$cid,$device,$imei,$sn,$man,$model,$malname,$date); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../newmovement.php?imei=$imei&sn=$sn&createcust=yes");

}else{
    header("Location: ../newmovement.php");
}
