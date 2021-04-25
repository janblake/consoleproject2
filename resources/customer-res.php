<?php
require 'db-res.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['submit'])){
    $last=$_POST['lastname'];
    $first=$_POST['firstname'];
    $tel1=$_POST['tel1'];
    if(empty($_POST['tel2'])){ 
        $tel2=null;
    }else{
        $tel2=$_POST['tel2'];
    }
    $address=$_POST['ad'];
    $postcode=$_POST['postcode'];
    $city=$_POST['city'];
    $email=$_POST['email'];
    $job=$_POST['job'];
    $date=date("Y-m-d");
    
    $sql = "INSERT INTO customers (tel1,tel2,postcode,lastname,firstname,ad,city,email,job,entry_date) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../necustomer.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"isisssssss",$tel1,$tel2,$postcode,$last,$first,$address,$city,$email,$job,$date); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../necustomer.php?signup=success");

}else{
    //header("Location: ../necustomer.php");
  }


if(isset($_POST['createcust'])){
    
    $last=$_POST['lastname'];
    $first=$_POST['firstname'];
    $tel1=$_POST['tel1'];
    if(empty($_POST['tel2'])){ 
        $tel2=null;
    }else{
        $tel2=$_POST['tel2'];
    }
    $address=$_POST['ad'];
    $postcode=$_POST['postcode'];
    $city=$_POST['city'];
    $email=$_POST['email'];
    $job=$_POST['job'];
    $date=date("Y-m-d");
    
    $sql = "INSERT INTO customers (tel1,tel2,postcode,lastname,firstname,ad,city,email,job,entry_date) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../newmovement.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"isisssssss",$tel1,$tel2,$postcode,$last,$first,$address,$city,$email,$job,$date); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
        $last_id = mysqli_insert_id($conn);
    }

    if(strcmp($_POST['imei'],' ')!==1){

        $imei=$_POST['imei'];
        $query="SELECT id from device where imei=$imei";
        $result=mysqli_query($conn,$query);
        while ($devices[] = mysqli_fetch_assoc($result));
        
        $dev=http_build_query($devices[0]);
        $var = (int) filter_var($dev, FILTER_SANITIZE_NUMBER_INT);

        $last_id_int=(int)$last_id;

        $sql = "UPDATE device SET cust_id=$last_id_int WHERE id=$var";

        if (mysqli_query($conn, $sql)) {
            $str="ok";
        } else {
            $str= mysqli_error($conn);
        }
        header("Location: ../newmovement.php?imei=$imei&last=$last&first=$first&tel=$tel1&last_id=$last_id_int&mov=yes");
    }else{
        $sn=$_POST['sn'];
        $query="SELECT id from device where sn=$sn";
        $result=mysqli_query($conn,$query);
        while ($devices[] = mysqli_fetch_assoc($result));
        
        $dev=http_build_query($devices[0]);
        $var = (int) filter_var($dev, FILTER_SANITIZE_NUMBER_INT);

        $last_id_int=(int)$last_id;

        $sql = "UPDATE device SET cust_id=$last_id_int WHERE id=$var";

        if (mysqli_query($conn, $sql)) {
            $str="ok";
        } else {
            $str= mysqli_error($conn);
        }
        header("Location: ../newmovement.php?sn=$sn&last=$last&first=$first&tel=$tel1&last_id=$last_id_int&mov=yes");
    }
    

}else{
    header("Location: ../newmovement.php");
  }