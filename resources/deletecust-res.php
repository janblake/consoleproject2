<?php
require 'db-res-pdo.php';


if(isset($_POST['id'])){
    $sql= "DELETE FROM customers WHERE id= '".$_POST['id']."'";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
}