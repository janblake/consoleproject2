<?php  
require 'db-res.php'; 

if(!empty($_POST['cust_id'])){

    $last=$_POST['lastname'];
    $first=$_POST['firstname'];
    $tel1=$_POST['tel1'];
    
    $tel2=$_POST['tel2'];
    
    $address=$_POST['ad'];
    $postcode=$_POST['postcode'];
    $city=$_POST['city'];
    $email=$_POST['email'];
    $job=$_POST['job'];
    
    $query="UPDATE customers 
        SET lastname='$last',
        firstname='$first',
        tel1='$tel1',
        tel2='$tel2',
        ad='$address', 
        postcode='$postcode',
        city='$city',
        email='$email',
        job='$job'
        WHERE id='".$_POST['cust_id']."'";
        if (mysqli_query($conn, $query)) {
            echo "Record updated successfully";
        }else{
            echo "Error updating record: " . mysqli_error($conn);
        }?>
    <script> location.replace("../showcustomers.php");</script>
    <?php
    
}
