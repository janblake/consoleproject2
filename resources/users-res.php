<?php
require 'db-res.php'; 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['submit'])){
  
    $regid=$_POST['name'];
    $regemail=$_POST['email'];
    $regpass=$_POST['pass'];
    $hashedpwd=password_hash($regpass,PASSWORD_DEFAULT);
    $regpoint=$_POST['point'];
    $regtype=$_POST['usertype'];
  
    $sql = "INSERT INTO users (username,email,pwd,point_loc,user_type) VALUES (?,?,?,?,?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
      header("Location: ../users.php?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"sssss",$regid,$regemail,$hashedpwd,$regpoint,$regtype); //bind the parameters with the placeholders
      mysqli_stmt_execute($stmt);
    }
  
    header("Location: ../users.php?signup=success");
  }else{
    header("Location: ../users.php");
  }