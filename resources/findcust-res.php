<?php  
require 'db-res.php';  
 if(isset($_POST["cust_id"]))  
 {  
    $query = "SELECT * FROM customers WHERE id = '".$_POST["cust_id"]."'";  
    $result = mysqli_query($conn, $query);  
    $row = mysqli_fetch_array($result);  
    echo json_encode($row);  
 }  
 ?>