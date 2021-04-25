<?php  
require 'db-res.php'; 
 if(isset($_POST["dev_id"]))  
 {  
    $query = "SELECT device.id,device.category,device.imei,device.sn,device.manufacturer,device.model_name,device.mal_name,device.cust_id,device.order_status,products.prod_name,manufacturers.man_name,model.model_name,malfunction.mal_desc 
    FROM device 
    INNER JOIN products
    ON device.category=products.id
    INNER JOIN manufacturers 
    ON device.manufacturer=manufacturers.id
    INNER JOIN model
    ON device.model_name=model.id
    INNER JOIN malfunction
    ON device.mal_name=malfunction.id
    WHERE device.id = '".$_POST["dev_id"]."'";
    $result = mysqli_query($conn, $query);  
    $row = mysqli_fetch_array($result);  
    echo json_encode($row);  
    
 }  
 ?>