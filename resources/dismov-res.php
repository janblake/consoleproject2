<?php




require 'db-res.php';

if(isset($_POST['check1'])){
    $imei = $_POST['imei'];
    
    $query = "SELECT device.id,device.entry_date,device.order_status,device.cust_id,customers.lastname,customers.firstname
                FROM device
                INNER JOIN customers
                ON device.cust_id = customers.id
                WHERE device.imei = $imei";

    $result=mysqli_query($conn,$query);
    while ($devices[] = mysqli_fetch_assoc($result));

    

    if(count($devices)>1){?>
        <table class="table table-striped table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ημερομηνία Καταχώρησης</th>
                    <th scope="col">Επώνυμο Πελάτη</th>
                    <th scope="col">Όνομα Πελάτη</th>
                    <th scope="col">Κατάσταση Βλάβης</th>
        
                </tr>
            </thead>
            <tbody>

            <?php 
                foreach ($devices as $device) { 
                    if(!isset($device)){
                        break;
                    }?>

                    <tr>
                        <td><?php echo $device['id']?></td>
                        <td><?php echo $device['entry_date']?></td>
                        <td><?php echo $device['lastname']?></td>
                        <td><?php echo $device['firstname']?></td>
                        <td><?php echo $device['order_status']?></td>
                    </tr>
            <?php } ?>
        </table>
        <?php
    }else{
        echo '<p class="alert alert-warning" >Δε βρέθηκαν συσκευές με ΙΜΕΙ: <b id="imeival">',$imei,'</b></p>';
        echo '<button class="btn btn-primary" type="button" name="create" id="createBtn" style="padding-left: 20px;">Δημιουργία νέας συσκευής με το παρόν ΙΜΕΙ.</button>';
    }
}

if(isset($_POST['check2'])){
    $sn = $_POST['sn'];
    
    $query = "SELECT device.id,device.entry_date,device.order_status,device.cust_id,customers.lastname,customers.firstname
                FROM device
                INNER JOIN customers
                ON device.cust_id = customers.id
                WHERE device.sn = $sn";

    $result=mysqli_query($conn,$query);
    while ($devices[] = mysqli_fetch_assoc($result));

    

    if(count($devices)>1){?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ημερομηνία Καταχώρησης</th>
                    <th scope="col">Επώνυμο Πελάτη</th>
                    <th scope="col">Όνομα Πελάτη</th>
                    <th scope="col">Κατάσταση Βλάβης</th>
        
                </tr>
            </thead>
            <tbody>

            <?php 
                foreach ($devices as $device) { 
                    if(!isset($device)){
                        break;
                    }?>

                    <tr>
                        <td><?php echo $device['id']?></td>
                        <td><?php echo $device['entry_date']?></td>
                        <td><?php echo $device['lastname']?></td>
                        <td><?php echo $device['firstname']?></td>
                        <td><?php echo $device['order_status']?></td>
                    </tr>
            <?php } ?>
        </table>
        <?php
    }else{
        echo '<p class="alert alert-warning" >Δε βρέθηκαν συσκευές με το παρόν Serial Number: <b>',$sn,'</b></p>';
        echo '<button  class="btn btn-primary" type="button" name="create" id="createBtn" style="padding-left: 20px;">Δημιουργία νέας συσκευής με το παρόν Serial Number.</button>';
    }
}