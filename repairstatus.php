<?php
  session_start();
  if(!isset($_SESSION['usr'])){?>
      <script> location.replace("index.php");</script>
      <?php
  }
 ?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Sandbox | CodeBlock</title>
    <meta name="description" content="Create pagination with filters using PHP, JQuery and Ajax">
    
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/global.css" type="text/css" media="all">
    
    <script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    
    
    
    
</head>





<body>
     
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ΚΙΝΗΣΕΙΣ
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">ΠΡΟΣΘΗΚΗ</a>
            <a class="dropdown-item" href="movements.php">ΠΑΡΟΥΣΙΑΣΗ</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ΠΕΛΑΤΕΣ
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="necustomer.php">ΠΡΟΣΘΗΚΗ</a>
            <a class="dropdown-item" href="showcustomers.php">ΠΑΡΟΥΣΙΑΣΗ</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ΣΥΣΚΕΥΕΣ
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="newdevice.php">ΠΡΟΣΘΗΚΗ</a>
            <a class="dropdown-item" href="showdevices.php">ΠΑΡΟΥΣΙΑΣΗ</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ΑΝΤΑΛΛΑΚΤΙΚΑ
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">ΠΡΟΣΘΗΚΗ</a>
            <a class="dropdown-item" href="#">ΠΑΡΟΥΣΙΑΣΗ</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="repairstatus.php">ΣΤΑΔΙΟ ΕΠΙΣΚΕΥΗΣ</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ADMIN
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="productcats.php">ΚΑΤΗΓΟΡΙΕΣ ΠΡΟΙΟΝΤΩΝ</a>
            <a class="dropdown-item" href="malfunctioncats.php">ΚΑΤΗΓΟΡΙΕΣ ΒΛΑΒΩΝ</a>
            <a class="dropdown-item" href="manufacturercats.php">ΚΑΤΗΓΟΡΙΕΣ ΚΑΤΑΣΚΕΥΑΣΤΩΝ</a>
            <a class="dropdown-item" href="modelcats.php">ΚΑΤΗΓΟΡΙΕΣ ΜΟΝΤΕΛΩΝ ΚΑΤΑΣΚΕΥΑΣΤΩΝ</a>
            <a class="dropdown-item" href="jobcats.php">ΚΑΤΗΓΟΡΙΕΣ ΕΠΑΓΓΕΛΜΑΤΩΝ</a>
            <a class="dropdown-item" href="nowarcats.php">ΚΑΤΗΓΟΡΙΕΣ ΜΗ-ΕΓΓΥΗΣΗΣ</a>
            <a class="dropdown-item" href="users.php"> ΔΙΑΧΕΙΡΙΣΗ ΧΡΗΣΤΩΝ</a>
            </div>
        </li>
        </ul>
    </div>
    <div >
            <?php
                if(isset($_SESSION['usr'])){
                    echo "<h6 style='color:#FFFFFF; margin-right:40px;'>Χειριστής : ".$_SESSION['usr']."</h6>";
                }
            ?>
        </div>
        
        
        <div class="float-right">
            <form action="resources/logout-res.php" method="POST" class="form-inline my-2 my-lg-0 ">
                <button class="btn btn-light my-2 my-sm-0 " type="submit">Αποσύνδεση</button>
            </form>
        </div>
    </nav>

    <main class="container">
        <div class="row">
            <div class="col-md-4"></div>
        
            <div class="col-md-4">
                <h1>Στάδιο Επισκευής</h1>
                <br>
                <h4>Μάθετε σε τι κατάσταση βρίσκεται το προϊον σας</h4>
                <br>
                <h6>Συμπληρώστε το παρακάτω πεδίο για να ενημερωθείτε</h6>
                <br>
                <form  method="POST" class="form" id="filter-form">
                    <div class="form-group">
                    
                        <input type="search" name="repair-id" id="repair-search" placeholder="Repair ID" class="form-control form-control-sm sb" required>
                        <button type="submit" name="submit" class="btn btn-primary">Αναζήτηση</button>
                    </div> 
                </form>
            </div>
        </div>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
                require 'resources/db-res.php';  
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $repairid=$_POST['repair-id'];


                if(isset($_POST['submit'])){
                    
                    if(!empty($repairid)){
                        $sql="SELECT device.id,device.model_name,device.cust_id,device.order_status,customers.lastname,customers.firstname,model.model_name 
                        FROM device
                        INNER JOIN model
                        ON device.model_name=model.id
                        INNER JOIN customers
                        ON device.cust_id=customers.id 
                        WHERE device.id = $repairid";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {?>
                            
                            <table class="table table-dark" >
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            
                                <tr>
                                
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['lastname']?></td>
                                <td><?php echo $row['firstname']?></td>
                                <td><?php echo $row['model_name']?></td>
                                <td><?php echo $row['order_status']?></td>
                            </tr>
                        <?php }?>  
                        </table>


            <?php
        } else {
            echo '<p class="alert alert-warning" >No results found.</p>';
        }
    }
}



?>
    </main> 
</body>



</html>



