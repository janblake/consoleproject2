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
    <script src="assets/devices.js"  type=" text/javascript"></script>
    
    
    
</head>


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


    <main class="container-fluid">

     

        
        <form id="filter-form" class="form" action='' method="GET">
            <div class="filters row">
                

                <div class="col-md-2">
                    <span> ΚΑΤΗΓΟΡΙΑ: </span>
                    <select name="cat" class="form-control form-control-sm">
                    
                        <?php while($row=mysqli_fetch_array($result)):;?>
                            <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                        <?php endwhile;?>
                        
                    </select>
                </div>

                <div class="col-md-2">
                    <span> ΚΑΤΑΣΚΕΥΑΣΤΗΣ: </span>
                    <select name="man" class="form-control form-control-sm">
                    
                        <?php while($row=mysqli_fetch_array($result2)):;?>
                            <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                        <?php endwhile;?>
                        
                    </select>
                </div>
                
                <div class="col-md-2">

                <span> IMEI: </span>
                <input type="text" name="imei" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
                </div>

                <div class="col-md-2">
                <span> ΜΟΝΤΕΛΟ: </span>
                <input type="text" name="modelname" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
                </div>
                
                <div class="col-md-1 " ></div>
                <div class="col-md-1">
                    <span> ΕΜΦΑΝΙΣΗ: </span>
                    <select name="per-page" class="form-control form-control-sm">
                        <option value="12">12</options>
                        <option value="24">24</options>
                        <option value="36">36</options>
                        <option value="48">48</options>
                    </select>
                    
                </div>
                
                <div class="col-md-2 " id="filsub">
                    <input type="submit" value="Filter"  class="btn btn-sm btn-primary "/>
                </div>
                
            </div>
            <div><?php
                          if(isset($_GET['error'])){
                            if($_GET['error']=="nocust"){
                              echo '<p style="color:red;text-align:center">Customer ID Does Not Exist. Edit Canceled. </p>';
                            }
                          }
                        ?></div>

            <div id="all-devices" class="row all-devices">
           
                <?php require('resources/showdev-res.php'); ?>
            
            </div>
        
        </form>

        <div id="post"></div>
        

        
    </main>
     
     
</body>

<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">ΕΝΗΜΕΡΩΣΗ ΣΤΟΙΧΕΙΩΝ ΣΥΣΚΕΥΗΣ</h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form" action="resources/editdevice-res.php">  


                            <span> ΣΥΣΚΕΥΗ: </span>
                            <select name="device" id="prodSelect" class="form-control form-control-sm" required>
                            
                        
                                
                            </select>

                            <br>

                            <span> IMEI: </span>
                            <input type="text" name="imei" id="imei" class="form-control form-control-sm"  required/>

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

                            <span> ID ΠΕΛΑΤΗ: </span>
                            <input type="text" name="cid" id="cid"  class="form-control form-control-sm"  required/>

                            <br>

                            <span> ΒΛΑΒΗ: </span>
                            <select name="malname" id='malSelect' class="form-control form-control-sm" required>
                            </select>
                            <br>
                            <span> ΚΑΤΑΣΤΑΣΗ: </span>
                            <select name="status" id='status' class="form-control form-control-sm" required>
                                <option value="ΕΛΕΓΧΟΣ">ΕΛΕΓΧΟΣ</option>
                                <option value="ΥΠΟ ΕΠΙΣΚΕΥΗ">ΥΠΟ ΕΠΙΣΚΕΥΗ</option>
                                <option value="ΕΝΗΜΕΡΩΗΣΗ ΚΟΣΤΟΥΣ">ΕΝΗΜΕΡΩΗΣΗ ΚΟΣΤΟΥΣ</option>
                                <option value="ΑΝΑΜΟΝΗ ΑΝΤΑΛΑΚΤΙΚΟΥ">ΑΝΑΜΟΝΗ ΑΝΤΑΛΑΚΤΙΚΟΥ</option>
                                <option value="ΕΠΑΝΕΛΕΓΧΟΣ">ΕΠΑΝΕΛΕΓΧΟΣ</option>
                                <option value="ΕΛΕΓΧΟΣ ΜΗΤΡΙΚΗΣ">ΕΛΕΓΧΟΣ ΜΗΤΡΙΚΗΣ</option>
                                <option value="ΕΤΟΙΜΟ ΓΙΑ ΠΑΡΑΛΑΒΗ">ΕΤΟΙΜΟ ΓΙΑ ΠΑΡΑΛΑΒΗ</option>
                                <option value="ΠΑΡΑΔΟΘΗΚΕ">ΠΑΡΑΔΟΘΗΚΕ</option>

                            </select>

                          <br>
                          <input type="hidden" name="dev_id" id="dev_id" />  
                          <input type="submit" name="update" id="update" value="ΕΝΗΜΕΡΩΣΗ" class="btn btn-success" />  
                          
                     </form>  
                </div>  
                 
           </div>  
      </div>  
 </div> 

</html>



<script>
    $(document).ready(function(){

        load_data();

        function load_data()
        {
            $.ajax({
                url:"resources/showdev-res.php",
                mehtod:"POST",
                success:function(data)
                {
                    $("#all-devices").html(data);
                }
            });
        }
        

        $(document).on('click','.edit',function(){
            var dev_id = $(this).attr("id");
            $.ajax({
                url:"resources/finddevice-res.php",
                method:"POST",
                data:{dev_id:dev_id},
                dataType:"json",
                success:function(data){
                    $('#prodSelect').val(data.category);
                    $('#imei').val(data.imei);
                    $('#sn').val(data.sn);
                    $('#categoriesSelect').val(data.manufacturer);
                    $('#subcatsSelect').val(data.model_name);
                    $('#malSelect').val(data.mal_desc);
                    $('#cid').val(data.cust_id);
                    $('status').val(data.order_status);
                    $('#dev_id').val(data.id);
                    $('#add_data_Modal').modal('show');
                    
                    
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    $('#post').html(msg);
                }
            });
        });
    });
</script>