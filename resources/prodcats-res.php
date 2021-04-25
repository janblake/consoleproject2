<?php
require 'db-res.php'; 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['submit'])){
    $prod_name=$_POST['name'];
    
    $sql = "INSERT INTO products (prod_name) VALUES (?)";
    $stmt=mysqli_stmt_init($conn);//create prepared statement
    if (!mysqli_stmt_prepare($stmt,$sql)){  //check if the prepared statement was succesfully prepared
        header("Location: ../productcats.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$prod_name); //bind the parameters with the placeholders
        mysqli_stmt_execute($stmt);
    }
    

    
    header("Location: ../productcats.php?signup=success");

}else{
    header("Location: ../productcats.php");
  }