<?php
require 'db-res.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['searchcust'])){
    $last=$_POST['last'];

    $sql="SELECT * FROM customers WHERE lastname LIKE '%$last%'";
    $result = mysqli_query($conn, $sql);
    while ($customers[] = mysqli_fetch_assoc($result));

    if(count($customers)>1){?>

        <p class="alert alert-info">Διπλό κλίκ στο επώνυμο του πελάτη για δημιουργία κίνησης</p>
        
        <table class="table" id="mytable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Επώνυμο</th>
                    <th scope="col">Όνομα</th>
                    <th scope="col">Τηλέφωνο</th>
                    <th scope="col">Διεύθυνση</th>
        
                </tr>
            </thead>
            <tbody>

            <?php 
                $counter=1;
                foreach ($customers as $customer) { 
                    if(!isset($customer)){
                        break;
                    }?>

                    <tr>
                        <?php echo '<td id="cust_id'.$counter.'"> '.$customer['id'].'</td>'?>
                        <?php echo '<td><a href="#" onClick="get_id(this.id)" id="cust-info'.$counter.'"> '.$customer['lastname'].'</a></td>' ?>
                        <?php echo '<td id="first'.$counter.'"> '.$customer['firstname'].'</td>'?>
                        <?php echo '<td id="tel'.$counter.'"> '.$customer['tel1'].'</td>'?>
                        <td><?php echo $customer['ad']?></td>
                    </tr>
                <?php
                $counter++;
                } 
            ?>
        </table>
        <?php
    }else{
        echo '<p class="alert alert-warning" >Δε βρέθηκαν πελάτες για αυτό το επώνυμο.</p>';
    }
}
