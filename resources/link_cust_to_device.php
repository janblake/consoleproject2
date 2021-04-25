<?php
require 'db-res.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$imei=$_POST['imei'];
$sn=$_POST['sn'];
$cust_id=$_POST['cust_id'];
$last=$_POST['last'];
$first=$_POST['first'];
$tel=$_POST['tel'];


if(strcmp($_POST['imei'],' ')!==1){


    $imei=$_POST['imei'];
    $query="SELECT id from device where imei=$imei";
    $result=mysqli_query($conn,$query);
    while ($devices[] = mysqli_fetch_assoc($result));
    
    $dev=http_build_query($devices[0]);
    $var = (int) filter_var($dev, FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE device SET cust_id=$cust_id WHERE id=$var";

    if (mysqli_query($conn, $sql)) {
        $str="ok";
    } else {
        $str= mysqli_error($conn);
    }
    echo "0";
    echo $imei;
    echo $last;
    echo $first;
    echo $tel;
    echo $cust_id;
    //header("Location: ../newmovement.php?imei=$imei&last=$last&first=$first&tel=$tel1&last_id=$last_id_int&mov=yes");
 }else{
    $sn=$_POST['sn'];
    $query="SELECT id from device where sn=$sn";
    $result=mysqli_query($conn,$query);
    while ($devices[] = mysqli_fetch_assoc($result));
    
    $dev=http_build_query($devices[0]);
    $var = (int) filter_var($dev, FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE device SET cust_id=$cust_id WHERE id=$var";

    if (mysqli_query($conn, $sql)) {
        $str="ok";
    } else {
        $str= mysqli_error($conn);
    }
    echo "1";
    echo $sn;
    echo $last;
    echo $first;
    echo $tel;
    echo $cust_id;
    //header("Location: ../newmovement.php?sn=$sn&last=$last&first=$first&tel=$tel1&last_id=$last_id_int&mov=yes");
}