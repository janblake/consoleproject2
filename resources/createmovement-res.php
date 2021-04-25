<?php
require 'db-res.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['createmov'])){
    $imei=$_POST['imei'];
    $sn = $_POST['sn'];
    $last=$_POST['lastnamemov'];
    $first=$_POST['firstnamemov'];
    $maltype = $_POST['maltype'];
    $malcom=$_POST['malcom'];
    $dateinput= $_POST['dateinput'];
    $malstage= "Έλεγχος";
    $war = $_POST['war'];
    if(strcmp($war,'ΝΑΙ')!==0){
        $nowar=$_POST['nowar'];
    }else{
        $nowar=" ";
    }
    if(!isset($_POST['datebuy'])){
        $datebuy=" ";
    }else{
        $datebuy = $_POST['datebuy'];
    }
    $place = $_POST['place'];
    $cost = $_POST['cost'];
    $precost = $_POST['precost'];
    $parel = $_POST['parel'];
    $unlockcode = $_POST['unlockcode'];
    $order_no = $_POST['no'];
    $notice = $_POST['notice'];

    if(strcmp($imei,"")!==0){
        $imei=$_POST['imei'];
        $query="SELECT device.model_name,device.manufacturer,model.model_name,manufacturers.man_name
        FROM device
        INNER JOIN model
        ON device.model_name=model.id
        INNER JOIN manufacturers
        ON device.manufacturer=manufacturers.id
        where imei=$imei";
        $result=mysqli_query($conn,$query);
        while ($devices[] = mysqli_fetch_assoc($result));
        foreach($devices as $device){
            if(!isset($device)){
                break;
            }
            $dev_model = $device['model_name'];
            $dev_man = $device['man_name'];
        }
        // $dev=http_build_query($devices[0]);
        // $devname=trim($dev,"model_name=");
    }else{
        $sn=$_POST['sn'];
        $query="SELECT device.model_name,device.manufacturer,model.model_name,manufacturers.man_name
        FROM device
        INNER JOIN model
        ON device.model_name=model.id
        INNER JOIN manufacturers
        ON device.manufacturer=manufacturers.id
        where sn=$sn";
        $result=mysqli_query($conn,$query);
        while ($devices[] = mysqli_fetch_assoc($result));
        foreach($devices as $device){
            if(!isset($device)){
                break;
            }
            $dev_model = $device['model_name'];
            $dev_man = $device['man_name'];
        }
    }
    
    
    $sql = "INSERT INTO movements (imei,sn,lastname,firstname,maltype,malcomment,subdate,malstatus,warranty,no_warranty_reason,saledate,saleplace,cost,precost,parel,unlock_code,order_no,notice,man,model) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../newmovement.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"ssssssssssssiissssss",$imei,$sn,$last,$first,$maltype,$malcom,$dateinput,$malstage,$war,$nowar,$datebuy,$place,$cost,$precost,$parel,$unlockcode,$order_no,$notice,$dev_man,$dev_model); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../newmovement.php");

}else{
    header("Location: ../newmovement.php");
  }