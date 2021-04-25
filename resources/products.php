<?php
require 'db-res.php'; 

$id_filter = isset($_GET['idSearch']) ? $_GET['idSearch'] : '';
$imei_filter = isset($_GET['imeiSearch']) ? $_GET['imeiSearch'] : '';
$model_filter = isset($_GET['modelSearch']) ? $_GET['modelSearch'] : '';
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$customer_filter = isset($_GET['custSearch']) ? $_GET['custSearch'] : '';
$point_filter = isset($_GET['pointSearch']) ? $_GET['pointSearch'] : '';

$limit = isset($_GET['per-page']) ? $_GET['per-page'] : 3;

$offset = 0;
$current_page = 1;
if(isset($_GET['page-number'])) {
    $current_page = (int)$_GET['page-number'];
    $offset = ($current_page * $limit) - $limit;
}

if(!empty($id_filter)||!empty($imei_filter)||!empty($model_filter)||!empty($status_filter)||!empty($customer_filter)||!empty($point_filter)){

    $query = "SELECT * FROM movements WHERE id>0";
    
    
    if(!empty($id_filter)){
        $query .= " AND id = $id_filter";
    }

    if (!empty($imei_filter)){
        $query .= " AND IMEI LIKE '%$imei_filter%'";
    }

    if (!empty($model_filter)){
        $query .= " AND model LIKE '%$model_filter%'";
    }

    if (!empty($status_filter)){
        $query .= " AND orderStatus = '$status_filter'";
    }

    if (!empty($customer_filter)){
        $query .= " AND customer LIKE '%$customer_filter%'";
    }

    if (!empty($point_filter)){
        $query .= " AND point LIKE '%$point_filter%'";
    }

    $result = mysqli_query($conn, $query);
    while ($products[] = mysqli_fetch_assoc($result));
}else{
    $query = "SELECT * FROM movements WHERE id>0";
    $result = mysqli_query($conn, $query);
    while ($products[] = mysqli_fetch_assoc($result));
}

$paged_products = array_slice($products, $offset, $limit);

$total_products = count($products);

// Get the total pages rounded up the nearest whole number
$total_pages = ceil( $total_products / $limit );

$paged = $total_products > count($paged_products) ? true : false;

if (count($paged_products)) {?>
    <table class="table table-striped table-bordered table-dark" style="font-size:small;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Πελάτης</th>
                <th scope="col">IMEI</th>
                <th scope="col">SN</th>
                <th scope="col">Μοντέλο</th>
                <th scope="col">Κωδικός Ξεκλειδώματος</th>
                <th scope="col">Είδος Βλάβης</th>
                <th scope="col">Status</th>
                <th scope="col">Κόστος</th>
                <th scope="col">Προσυμφωνηθέν Κόστος</th>
                <th scope="col">Εγγύηση</th>
                <th scope="col">Καταχώρηση</th>
                <th scope="col">Επεξαργασία</th>
                <th scope="col">Διαγραφή</th>
             </tr>
        </thead>
        <tbody>

        <?php 
        foreach ($paged_products as $product) { ?>
            <?php if(!isset($product['id'])){
                break;
            }?>
            <tr>
            
            <td><?php echo $product['id']?></td>
            <td><?php echo $product['lastname']." ".$product['firstname']?></td>
            <td><?php echo $product['imei']?></td>
            <td><?php echo $product['sn']?></td>
            <td><?php echo $product['man'].",".$product['model']?></td>
            <td><?php echo $product['unlock_code']?></td>
            <td><?php echo $product['maltype']?></td>
            <td><?php echo $product['malstatus']?></td>
            <td><?php echo $product['cost']?></td>
            <td><?php echo $product['precost']?></td>
            <td><?php echo $product['warranty']?></td>
            <td><?php echo $product['subdate']?></td>
            <td><button type="button" name="edit" id="<?php echo $product["id"];?>" class="btn btn-warning btn-xs edit" style="font-size:small;">Επεξεργασία</button></td>
            <td><button type="button" name="delete" id="<?php echo $product["id"];?>" class="btn btn-danger btn-xs delete" style="font-size:small;">Διαγραφή</button></td>
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


















