<?php
require 'db-res.php'; 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['submit'])){
    $device=$_POST['device'];
    $mal_desc=$_POST['name'];
    
    $sql = "INSERT INTO malfunction (device,mal_desc) VALUES (?,?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../malfunctioncats.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"ss",$device,$mal_desc); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../malfunctioncats.php?signup=success");

}else{
    header("Location: ../malfunctioncats.php");
  }