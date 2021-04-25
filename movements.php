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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Sandbox | CodeBlock</title>
    <meta name="description" content="Create pagination with filters using PHP, JQuery and Ajax">
    
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700&display=swap" rel="stylesheet">
    
    

    <link rel="stylesheet" href="assets/global.css" type="text/css" media="all">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="assets/global.js"  type=" text/javascript"></script>
    
    
    
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
            <a class="dropdown-item" href="newmovement.php ">ΠΡΟΣΘΗΚΗ</a>
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


     <main class="container-fluid">

     

        
        <form id="filter-form" class="form" action='' method="GET">
        <div class="filters row">
            <div class="col-md-3">

            <span> ID: </span>
            <input type="text" name="idSearch" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
            </div>

            <div class="col-md-3">
            <span> IMEI: </span>
            <input type="text" name="imeiSearch" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
            </div>

            <div class="col-md-3">
            <span> Model: </span>
            <input type="text" name="modelSearch" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
            </div>

            <div class="col-md-3">
            <span> Status: </span>
            <select name="status" class="form-control form-control-sm">
            
                <option disabled selected value> -- select an option -- </option>
                <option value="Control">Control</options>
                <option value="Delivered">Delivered</options>
                <option value="Ready To Receive">Ready To Receive</options>
                
            </select>
            </div>

            
        </div>
        
        <div class="filters row">

            <div class="col-md-3">
            <span> Customer:  </span>
            <input type="text" name="custSearch" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
            </div>

            <div class="col-md-3">
            <span> Point: </span>
            <input type="text" name="pointSearch" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
            </div>

            <div class="col-md-3">
                <span> Show: </span>
                <select name="per-page" class="form-control form-control-sm">
                    <option value="3">3</options>
                    <option value="6">6</options>
                    <option value="9">9</options>
                    <option value="12">12</options>
                </select>
            </div>

            <div class="col-md-3">
                <input type="submit" value="Filter" class="btn btn-sm btn-secondary"/>
            </div>
        </div>
        </form>
        

        <div id="all-products" class="row all-products">
           
           <?php require('resources/products.php'); ?>
            
        </div>
     </main>
     
     
</body>

</html>