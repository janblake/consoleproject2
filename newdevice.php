<?php
  session_start();
  if(!isset($_SESSION['usr'])){?>
      <script> location.replace("index.php");</script>
      <?php
  }
 ?>

<?php
require 'resources/db-res.php'; 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$sql="SELECT id,prod_name FROM products";

$result=mysqli_query($conn,$sql);

while($row = $result->fetch_assoc()){
  $cats[] = array("id" => $row['id'], "val" => $row['prod_name']);
}

$sql="SELECT id,device,mal_desc FROM malfunction";

$result=mysqli_query($conn,$sql);

while($row = $result->fetch_assoc()){
  $sub[$row['device']][] = array("id" => $row['id'], "val" => $row['mal_desc']);
}

$jCats = json_encode($cats);
$jSub = json_encode($sub);





$query = "SELECT id,man_name FROM manufacturers";
$result2 = $conn->query($query);

while($row = $result2->fetch_assoc()){
  $categories[] = array("id" => $row['id'], "val" => $row['man_name']);
}

$query = "SELECT id, manufacturer, model_name FROM model";
$result2 = $conn->query($query);

while($row = $result2->fetch_assoc()){
  $subcats[$row['manufacturer']][] = array("id" => $row['id'], "val" => $row['model_name']);
}

$jsonCats = json_encode($categories);
$jsonSubCats = json_encode($subcats);





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
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/global.css" type="text/css" media="all">
    
    <script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="assets/global.js"  type=" text/javascript"></script>
    


    <script type='text/javascript'>
      <?php
        echo "var cats = $jCats; \n";
        echo "var sub = $jSub; \n";
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>

      function loadCategories(){
        loadCategories1();
        loadCategories2();
      }

      function loadCategories1(){
        var select = document.getElementById("prodSelect");
        select.onchange = updateSubCats1;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(cats[i].val,cats[i].id);          
        }
      }
      
      function updateSubCats1(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("malSelect");
        
        subcatSelect.options.length = 0; 
        for(var i = 0; i < sub[catid].length; i++){
          subcatSelect.options[i] = new Option(sub[catid][i].val,sub[catid][i].id);
        }
      }
      
      function loadCategories2(){
        var select = document.getElementById("categoriesSelect");
        select.onchange = updateSubCats2;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);          
        }
      }
      
      function updateSubCats2(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcatsSelect");
        
        subcatSelect.options.length = 0; 
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>
    
    
</head>




<body onload='loadCategories()'>
     
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


    <main >

        

      <div class="container">
          <div><h2 >ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΠΡΟΙΟΝΤΟΣ</h2></div>
          <br>
          <?php
            if(isset($_GET['error'])){
              if($_GET['error']=="nocust"){
                echo '<p style="color:red;text-align:center">User Does Not Exist</p>';
              }
            }
          ?>
          <form action="resources/newdevice-res.php" method="POST" class="input-group" >
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputDevice">ΣΥΣΚΕΥΗ</label>
                <select name="device" id="prodSelect" class="form-control " required></select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputMan">ΚΑΤΑΣΚΕΥΑΣΤΗΣ</label>
                <select name="man" id='categoriesSelect' class="form-control " required></select>
                
              </div>
            
            
              <div class="form-group col-md-4">
                <label for="inputSN">S/N</label>
                <input type="text" name="sn"  class="form-control"  />
              </div>
              <div class="form-group col-md-4">
                <label for="inputMal">ΒΛΑΒΗ</label>
                <select name="malname" id='malSelect' class="form-control " required></select>
                
              </div>
              
            
            
              <div class="form-group col-md-4">
                <label for="inputModel">ΜΟΝΤΕΛΟ</label>
                <select name="modelname" id='subcatsSelect' class="form-control " required></select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputImei">IMEI</label>
                <input type="text" name="imei"  class="form-control "  required/>
              </div>
              <div class="form-group col-md-4">
                <label for="inputCid">ID ΠΕΛΑΤΗ</label>
                <input type="text" name="cid"  class="form-control "  />
              </div>
              
            </div>
            <button type="submit" name="submit" class="btn btn-primary">ΚΑΤΑΧΩΡΗΣΗ</button>
            
          </form>
        </div>

     </main>
     
     
</body>

</html>


