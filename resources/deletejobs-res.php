<?php
require 'db-res-pdo.php';

echo 'ji';
if(isset($_POST['id'])){
    $sql= "DELETE FROM jobs WHERE id= '".$_POST['id']."'";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
}