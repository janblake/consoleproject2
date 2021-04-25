<?php
require 'db-res.php'; 

$last_name = isset($_GET['lastname']) ? $_GET['lastname'] : '';
$first_name = isset($_GET['firstname']) ? $_GET['firstname'] : '';
$tel1 = isset($_GET['tel1']) ? $_GET['tel1'] : '';
$job = isset($_GET['job']) ? $_GET['job'] : '';

$limit = isset($_GET['per-page']) ? $_GET['per-page'] : 12;

$offset = 0;
$current_page = 1;
if(isset($_GET['page-number'])) {
    $current_page = (int)$_GET['page-number'];
    $offset = ($current_page * $limit) - $limit;
}

if(!empty($last_name)||!empty($first_name)||!empty($tel1)||!empty($job)){

    $query = "SELECT * FROM customers WHERE id > 0";
    
    
    if(!empty($last_name)){
        $query .= " AND lastname LIKE '%$last_name%'";
    }

    if (!empty($first_name)){
        $query .= " AND firstname LIKE '%$first_name%'";
    }

    if (!empty($tel1)){
        $query .= " AND tel1 LIKE '%$tel1%'";
    }

    if (!empty($job)){
        $query .= " AND job = '$job'";
    }



    $result = mysqli_query($conn, $query);
    while ($products[] = mysqli_fetch_assoc($result));
}else{
    $query = "SELECT * FROM customers WHERE id > 0";
    $result = mysqli_query($conn, $query);
    while ($products[] = mysqli_fetch_assoc($result));
}



$paged_products = array_slice($products, $offset, $limit);

$total_products = count($products);

// Get the total pages rounded up the nearest whole number
$total_pages = ceil( $total_products / $limit );

$paged = $total_products > count($paged_products) ? true : false;

if (count($paged_products)) {?>
    <table class="table table-striped table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Επώνυμο</th>
                <th scope="col">Όνομα</th>
                <th scope="col">Τηλέφωνο 1</th>
                <th scope="col">Τηλέφωνο 2</th>
                <th scope="col">Διεύθυνση</th>
                <th scope="col">Ταχυδρομικός Κώδικας</th>
                <th scope="col">Πόλη</th>
                <th scope="col">E-mail</th>
                <th scope="col">Επάγγελμα</th>
                <th scope="col">Καταχώρηση</th>
                <th scope="col">Επεξαργασία</th>
                <th scope="col">Διαγραφή</th>
             </tr>
        </thead>
        <tbody>

        <?php 
        $counter = 1;
        foreach ($paged_products as $product) { ?>
            <?php if($product['id']==null){
                break;
            }?>
            <tr>
            
            <td><?php echo $product['id']?></td>
            <td><?php echo $product['lastname']?></td>
            <td><?php echo $product['firstname']?></td>
            <td><?php echo $product['tel1']?></td>
            <td><?php echo $product['tel2']?></td>
            <td><?php echo $product['ad']?></td>
            <td><?php echo $product['postcode']?></td>
            <td><?php echo $product['city']?></td>
            <td><?php echo $product['email']?></td>
            <td><?php echo $product['job']?></td>
            <td><?php echo $product['entry_date']?></td>
            <td><button type="button" name="edit" id="<?php echo $product["id"];?>" class="btn btn-warning btn-xs edit">Επεξεργασία</button></td>
            <td><button type="button" name="delete" id="<?php echo $product["id"];?>" class="btn btn-danger btn-xs delete">Διαγραφή</button></td>
        </tr>
    <?php }?>  
    </table>
    


       
<?php  
            
}else {
    echo '<p class="alert alert-warning" >No results found.</p>';
}
 
if ($paged) {
    require('pagination.php');
}
?>
