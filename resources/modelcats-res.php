<?php
require 'db-res.php'; 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['submit'])){
    $man=$_POST['manufacturer'];
    $model=$_POST['name'];
    
    $sql = "INSERT INTO model (manufacturer,model_name) VALUES (?,?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../modelcats.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"ss",$man,$model); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../modelcats.php?signup=success");

}else{
    header("Location: ../modelcats.php");
  }