<?php
require 'db-res.php'; 

$cat = isset($_GET['cat']) ? $_GET['cat'] : '';
$man = isset($_GET['man']) ? $_GET['man'] : '';
$imei = isset($_GET['imei']) ? $_GET['imei'] : '';
$model = isset($_GET['modelname']) ? $_GET['modelname'] : '';

$limit = isset($_GET['per-page']) ? $_GET['per-page'] : 12;

$offset = 0;
$current_page = 1;
if(isset($_GET['page-number'])) {
    $current_page = (int)$_GET['page-number'];
    $offset = ($current_page * $limit) - $limit;
}

if(!empty($cat)||!empty($man)||!empty($imei)||!empty($model)){

    $query = "SELECT device.id,device.category,device.imei,device.sn,device.manufacturer,device.model_name,device.mal_name,products.prod_name,manufacturers.man_name,model.model_name,malfunction.mal_desc 
            FROM device 
            INNER JOIN products
            ON device.category=products.id
            INNER JOIN manufacturers 
            ON device.manufacturer=manufacturers.id
            INNER JOIN model
            ON device.model_name=model.id
            INNER JOIN malfunction
            ON device.mal_name=malfunction.id
            WHERE device.id > 0 ";
    
    
    if(!empty($cat)){
        $query .= "AND products.prod_name = '$cat' ";
    }

    if (!empty($man)){
        $query .= " AND manufacturers.man_name = '$man'";
    }

    if (!empty($imei)){
        $query .= " AND imei LIKE '%$imei%'";
    }

    if (!empty($model)){
        $query .= " AND model.model_name LIKE '%$model%'";
    }


    $result = mysqli_query($conn, $query);
    while ($products[] = mysqli_fetch_assoc($result));
}else{
    $query = "SELECT device.id,device.category,device.imei,device.sn,device.manufacturer,device.model_name,device.mal_name,products.prod_name,manufacturers.man_name,model.model_name,malfunction.mal_desc 
            FROM device 
            INNER JOIN products
            ON device.category=products.id
            INNER JOIN manufacturers 
            ON device.manufacturer=manufacturers.id
            INNER JOIN model
            ON device.model_name=model.id
            INNER JOIN malfunction
            ON device.mal_name=malfunction.id";
            
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
                <th scope="col">Κατηγορία</th>
                <th scope="col">IMEI</th>
                <th scope="col">S/N</th>
                <th scope="col">Κατασκευαστής</th>
                <th scope="col">Μοντέλο</th>
                <th scope="col">Βλάβη</th>
                <th scope="col">Επεξεργασία</th>
    
             </tr>
        </thead>
        <tbody>

        <?php 
        $counter = 1;
        foreach ($paged_products as $product) { 
             if(!isset($product)){
                break;
        }?>
        <tr>
            
            <td><?php echo $product['id']?></td>
            <td><?php echo $product['prod_name']?></td>
            <td><?php echo $product['imei']?></td>
            <td><?php echo $product['sn']?></td>
            <td><?php echo $product['man_name']?></td>
            <td><?php echo $product['model_name']?></td>
            <td><?php echo $product['mal_desc']?></td>
            <td><button type="button" name="edit" id="<?php echo $product["id"];?>" class="btn btn-warning btn-xs edit">Επεξεργασία</button></td>
            
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
