<?php
require 'db-res.php'; 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['submit'])){
    $nowar=$_POST['name'];
    
    $sql = "INSERT INTO nowarranty (nowar_reason) VALUES (?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../nowarcats.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$nowar); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../nowarcats.php?signup=success");

}else{
    header("Location: ../nowarcats.php");
  }