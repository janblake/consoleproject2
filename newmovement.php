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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Sandbox | CodeBlock</title>
    <meta name="description" content="Create pagination with filters using PHP, JQuery and Ajax">
    
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    

    <link rel="stylesheet" href="assets/global.css" type="text/css" media="all">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
    
    
</head>


<script type='text/javascript'>
      <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>

      
      
      function loadCategories(){
        var select = document.getElementById("categoriesSelect");
        select.onchange = updateSubCats;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);          
        }
      }
      
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcatsSelect");
        
        subcatSelect.options.length = 0; 
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>




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
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card" >
                        <div class="card-header">
                            ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΚΙΝΗΣΗΣ
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">IMEI</span>
                                            </div>
                                            <input type="text" name="imei" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="imeiVal" value="<?php echo isset($_POST['imei']) ? $_POST['imei'] : '' ?> <?php echo isset($_GET['imei']) ? $_GET['imei'] : '' ?>" required>
                                            <button type="submit" name="check1" class="btn btn-primary">Έλεγχος</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">S/N</span>
                                            </div>
                                            <input type="text" name="sn" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="snVal" value="<?php echo isset($_POST['sn']) ? $_POST['sn'] : '' ?> <?php echo isset($_GET['sn']) ? $_GET['sn'] : '' ?>" required>
                                            <button type="submit" name="check2" class="btn btn-primary">Έλεγχος</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div>
                        <?php require('resources/dismov-res.php');?>
                    </div>
                    <div>
                        <?php
                          if(isset($_GET['createcust'])){
                            if($_GET['createcust']=="yes"){
                              echo '<button class="btn btn-primary" type="button" name="create" id="custBtn" >Δημιουργία νέου πελάτη για την παρούσα συσκεύη</button>';?>
                              
                              <br>
                              <br>
                              <div class="col-8">
                              <form action="" method="POST">
                              <div class="input-group rounded">
                                <label for="" style="padding-top:10px;">Επώνυμο:    </label>
                                <input type="search" name="last" id="last" class="form-control rounded" placeholder="Αναζήτηση άλλου πελάτη" aria-label="Search" style="margin-left:20px;"
                                    aria-describedby="search-addon" />
                                    <button type="submit" name="searchcust" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                              </div>
                              </form>
                                <br>
                              <div>
                                <?php require('resources/searchcustomer-res.php');?>
                              </div>
                              
                              
                            <?php
                            }
                          }

                          if(isset($_GET['mov'])){
                            if($_GET['mov']=="yes"){
                              if(isset($_GET["imei"])){
                                  $imeisn = $_GET["imei"];
                                  $imeisnval="imeival";
                              } else{
                                $imeisn = $_GET["sn"];
                                $imeisnval="snval";
                              } 
                              echo '<table class="table">
                              <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Επώνυμο</th>
                                    <th scope="col">Όνομα</th>
                                    <th scope="col">Τηλέφωνο</th>
                                    <th scope="col">IMEI/SN</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td id="last_id">'.$_GET["last_id"].'</td>
                                    <td id="last">'.$_GET["last"].'</td>
                                    <td id="first">'.$_GET["first"].'</td>
                                    <td id="tel">'.$_GET["tel"].'</td>
                                    <td id='.$imeisnval.'>'.$imeisn.'</td>
                                </tr>
                              </tbody>
                            </table>';
                              echo '<button class="btn btn-primary" type="button" name="create" id="movBtn" >Δημιουργία νέας κίνησης για τον πελάτη </button>';
                            }
                          }
                        ?>
                    </div>
                </div>
            </div>
        </div>

     </main>
     
     
</body>


<?php
require 'resources/db-res.php'; 

$sql="SELECT * FROM products";

$result=mysqli_query($conn,$sql);

$sql2="SELECT * FROM nowarranty";
$results=mysqli_query($conn,$sql2);

$sql3="SELECT id,mal_desc from malfunction where
    id in (SELECT MAX(id) FROM malfunction group by mal_desc)";
$res=mysqli_query($conn,$sql3);

?>


<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">ΚΑΤΑΧΩΡΗΣΗ ΝΕΑΣ ΣΥΣΚΕΥΗΣ</h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form" action="resources/newdevice-res.php">  


                            <span> ΣΥΣΚΕΥΗ: </span>
                            <select name="device" id="prodSelect" class="form-control form-control-sm" required>
                            
                                <?php while($row=mysqli_fetch_array($result)):;?>
                                <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                                
                            </select>

                            <br>

                            <span> IMEI: </span>
                            <input type="text" name="imei" id="imei" class="form-control form-control-sm" />

                            <br>

                            <span> S/N: </span>
                            <input type="text" name="sn" id="sn" class="form-control form-control-sm"  />

                            <br>

                            <span> ΚΑΤΑΣΚΕΥΑΣΤΗΣ: </span>
                            <select name="man" id='categoriesSelect' class="form-control form-control-sm" required>
                            
                                
                                
                            </select>
                            
                            <br>

                            <span> ΜΟΝΤΕΛΟ: </span>
                            <select name="modelname" id='subcatsSelect' class="form-control form-control-sm" required>
                            
                              
                                
                            </select>


                            

                          <br>
                          <input type="hidden" name="dev_id" id="dev_id" />  
                          <input type="submit" name="subdev" id="update" value="ΚΑΤΑΧΩΡΗΣΗ" class="btn btn-success" />  
                          
                     </form>  
                </div>  
                 
           </div>  
      </div>  
 </div> 



 <div id="cust_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">ΚΑΤΑΧΩΡΗΣΗ ΝΕΟΥ ΠΕΛΑΤΗ</h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form" action="resources/customer-res.php">  
                        <div class="form-group">
                            <span> ΕΠΩΝΥΜΟ: </span>
                            <input type="text" name="lastname"  id="lastname"class="form-control form-control-sm" required />
                        </div>
                        <div class="form-group">
                            <span> ΟΝΟΜΑ: </span>
                            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm"  required/>
                        </div>
                        <div class="form-group">
                            <span> ΤΗΛΕΦΩΝΟ 1: </span>
                            <input type="text" name="tel1" id="tel1" class="form-control form-control-sm"  required/>
                        </div>
                        <div class="form-group">
                            <span> ΤΗΛΕΦΩΝΟ 2: </span>
                            <input type="text" name="tel2" id="tel2" class="form-control form-control-sm"  />
                        </div>
                        <div class="form-group">
                            <span> ΔΙΕΥΘΗΝΣΗ: </span>
                            <input type="text" name="ad" id="ad"  class="form-control form-control-sm" required />
                        </div>
                        <div class="form-group">
                            <span> ΤΑΧΥΔΡΟΜΙΚΟΣ ΚΩΔΙΚΑΣ: </span>
                            <input type="text" name="postcode" id="postcode" class="form-control form-control-sm"  required/>
                        </div>
                        <div class="form-group">
                            <span> ΠΟΛΗ: </span>
                            <input type="text" name="city" id="city" class="form-control form-control-sm"  required/>
                        </div>
                        <div class="form-group">
                            <span> Email: </span>
                            <input type="email" name="email" id="email" class="form-control form-control-sm"  required >
                        </div>
                        <div class="form-group">
                            <span> ΕΠΑΓΓΕΛΜΑ: </span>
                            <select class="form-control" name="job" id="job">
                                <option>ΕΛΕΥΘΕΡΟΣ ΕΠΑΓΓΕΛΜΑΤΙΑΣ</option>
                                <option>ΠΕΛΑΤΗΣ ΛΙΑΝΙΚΗΣ</option>
                                <option>ΠΕΛΑΤΗΣ ΧΟΝΔΡΙΚΗΣ</option>
                            
                            </select>
                        </div>
                            <input type="hidden" id="sn" name="sn" value="<?php echo isset($_GET['sn']) ? $_GET['sn'] : '' ?>"> 
                            <input type="hidden" id="imei" name="imei" value="<?php echo isset($_GET['imei']) ? $_GET['imei'] : '' ?>"> 
                            <input type="submit" name="createcust" id="update" value="ΚΑΤΑΧΩΡΗΣΗ" class="btn btn-success" />  
                           
                     </form>  
                </div>  
                 
           </div>  
      </div>  
 </div> 



 <div id="mov_Modal" class="modal fade">  
      <div class="modal-dialog" style="width:90%; max-width:1200px;">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">ΚΑΤΑΧΩΡΗΣΗ ΝΕΑΣ ΚΙΝΗΣΗΣ</h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form" action="resources/createmovement-res.php">  
                          
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span> IMEI: </span>
                                        <input type="text" name="imei"  id="imeiform" class="form-control form-control-sm"  />
                                    </div>
                                    <div class="form-group">
                                        <span> SN: </span>
                                        <input type="text" name="sn"  id="snform" class="form-control form-control-sm"  />
                                    </div>
                                    <div class="form-group">
                                        <span> ΕΠΩΝΥΜΟ: </span>
                                        <input type="text" name="lastnamemov" id="lastnamemov" class="form-control form-control-sm"  readonly/>
                                    </div>
                                    <div class="form-group">
                                        <span> ΟΝΟΜΑ: </span>
                                        <input type="text" name="firstnamemov" id="firstnamemov" class="form-control form-control-sm"  readonly/>
                                    </div>
                                    <div class="form-group">
                                        <span> ΤΥΠΟΣ ΒΛΑΒΗΣ: </span>
                                        <select name="maltype" id="maltype" class="form-control form-control-sm"  required >
                                            <?php while($row=mysqli_fetch_array($res)):;?>
                                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                            <?php endwhile;?>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <span> ΣΧΟΛΙΑ ΒΛΑΒΗΣ: </span>
                                        <input type="text" name="malcom" id="malcom" class="form-control form-control-sm"  />
                                    </div>
                                    
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                            <span> ΗΜΕΡΟΜΗΝΙΑ ΚΑΤΑΧΩΡΗΣΗΣ: </span>
                                            <input type="date" name="dateinput" id="dateinput"  class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"required />
                                        </div>
                                        <div class="form-group">
                                            <span>  ΚΑΤΑΣΤΑΣΗ ΒΛΑΒΗΣ: </span>
                                            <select name="malstage" id="malstage" class="form-control form-control-sm"  disabled >
                                                <option value="Έλεγχος">Έλεγχος</option>
                                                <option value="Υπό Επισκεύη">Υπό Επισκεύη</option>
                                                <option value="Ενημέρωση Κόστους">Ενημέρωση Κόστους</option>
                                                <option value="Αναμονή Ανταλακτικού">Αναμονή Ανταλακτικού</option>
                                                <option value="Επανέλεγχος">Επανέλεγχος</option>
                                                <option value="Έλεγχος Μητρικής">Έλεγχος Μητρικής</option>
                                                <option value="Έτοιμο Προς Παραλαβή">Έτοιμο Προς Παραλαβή</option>
                                                <option value="Παραδόθηκε">Παραδόθηκε</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <span> ΕΓΓΥΗΣΗ: </span>
                                            <select name="war" id="war" class="form-control form-control-sm" >
                                                <option value="ΟΧΙ">ΟΧΙ</option>
                                                <option value="ΝΑΙ">ΝΑΙ</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <span> ΑΙΤΙΑ ΜΗ-ΕΓΓΥΗΣΗΣ: </span>
                                        <select name="nowar" id="nowar" class="form-control form-control-sm">
                                            <?php while($row=mysqli_fetch_array($results)):;?>
                                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                            <?php endwhile;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <span> ΗΜΕΡΟΜΗΝΙΑ ΑΓΟΡΑΣ: </span>
                                        <input type="date" name="datebuy" id="datebuy" class="form-control form-control-sm" value=" " />
                                    </div>
                                    <div class="form-group">
                                        <span> ΤΟΠΟΣ ΑΓΟΡΑΣ: </span>
                                        <input type="text" name="place" id="place" class="form-control form-control-sm"  />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="form-group">
                                        <span> ΚΟΣΤΟΣ: </span>
                                        <input type="text" name="cost" id="cost" class="form-control form-control-sm"  required/>
                                        <i>&euro;</i>
                                    </div>
                                    <div class="form-group">
                                        <span> ΠΡΟΣΥΜΦΩΝΗΘΕΝ ΚΟΣΤΟΣ: </span>
                                        <input type="text" name="precost" id="precost" class="form-control form-control-sm"  />
                                        <i>&euro;</i>
                                    </div>
                                    <div class="form-group">
                                        <span> ΠΑΡΕΛΚΟΜΕΝΑ: </span>
                                        <input type="text" name="parel" id="parel" class="form-control form-control-sm"  />
                                    </div>
                                    <div class="form-group">
                                        <span> UNLOCK CODE: </span>
                                        <input type="text" name="unlockcode" id="unlock" class="form-control form-control-sm"  />
                                    </div>
                                    <div class="form-group">
                                        <span> ΑΡΙΘΜΟΣ ΠΑΡΑΓΓΕΛΕΙΑΣ: </span>
                                        <input type="text" name="no" id="no" class="form-control form-control-sm"  />
                                    </div>
                                    <div class="form-group">
                                        <span> ΠΑΡΑΤΗΡΗΣΕΙΣ: </span>
                                        <input type="text" name="notice" id="notice" class="form-control form-control-sm"  />
                                    </div>
                                    
                                    <input type="submit" name="createmov" id="update" value="ΚΑΤΑΧΩΡΗΣΗ" class="btn btn-success" />  
                                </div>
                          </div>
                        
                        
                           
                     </form>  
                </div>  
                 
           </div>  
      </div>  
 </div> 

</html>

<script>


    $(document).ready(function(){
        $("#createBtn").click(function(){
            $('#imei').val(document.getElementById("imeiVal").value);
            $('#sn').val(document.getElementById("snVal").value);
            $("#add_data_Modal").modal();
        });
        $("#custBtn").click(function(){
            $("#cust_Modal").modal();
        });
        $("#movBtn").click(function(){
            var imei = document.getElementById("imeival");
            if(imei){
                $('#imeiform').val(document.getElementById("imeival").innerHTML);
                document.getElementById('imeiform').readOnly = true;
            }else{
                $('#snform').val(document.getElementById("snval").innerHTML);
                document.getElementById('snform').readOnly = true;
            }
            
            $('#lastnamemov').val(document.getElementById("last").innerHTML);
            $('#firstnamemov').val(document.getElementById("first").innerHTML);
            
            $("#mov_Modal").modal();
        });
        $("#war").change(function() {
            var disabled = (this.value == "ΝΑΙ" || this.value == "default");
            $("#nowar").prop("disabled", disabled);
        }).change(); //to trigger on load
        });

        function get_id(clicked_id){
            $(clicked_id).trigger("click");
            
            var id = "#".concat(clicked_id);
            var idnum = id.replace(/\D/g,'');
            $(id).on('click',function(){
                var last = "cust-info".concat(idnum);
                var custid = "cust_id".concat(idnum);
                var first = "first".concat(idnum);
                var tel = "tel".concat(idnum);
                $.ajax({
                    type:'post',
                    url:'resources/link_cust_to_device.php',
                    data:{
                        sn: document.getElementById("snVal").value,
                        imei: document.getElementById("imeiVal").value,
                        cust_id: document.getElementById(custid).innerHTML,
                        last: document.getElementById(last).innerHTML,
                        first: document.getElementById(first).innerHTML,
                        tel: document.getElementById(tel).innerHTML
                    },
                    success: function(data) {
                        var array = data.split(" ");
                        if(array[0].localeCompare("0")==0){
                            url=["newmovement.php?imei=",array[2],"&last=",array[4],"&first=",array[5],"&tel=",array[6],"&last_id=",array[7],"&mov=yes"].join("");
                            //console.log(url);
                            //console.log(array);
                            window.location.replace(url);
                        }else{
                            url=["newmovement.php?sn=",array[2],"&last=",array[4],"&first=",array[5],"&tel=",array[6],"&last_id=",array[7],"&mov=yes"].join("");
                            //console.log(url);
                            //console.log(array[2]);
                            window.location.replace(url);
                        }
                    }
                });
            });
        }

       

</script>




