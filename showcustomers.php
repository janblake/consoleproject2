<?php
  session_start();
  if(!isset($_SESSION['usr'])){?>
      <script> location.replace("index.php");</script>
      <?php
  }
 ?>

<?php
require 'resources/db-res.php'; 

$sql="SELECT * FROM jobs";

$result=mysqli_query($conn,$sql);

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
    <script src="assets/customers.js"  type=" text/javascript"></script>
    
    
    
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


    <main class="container-fluid">

     

        
        <form id="filter-form" class="form" action='' method="GET">
            <div class="filters row">
                <div class="col-md-2">

                <span> ΕΠΩΝΥΜΟ: </span>
                <input type="text" name="lastname" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
                </div>

                <div class="col-md-2">
                <span> ΟΝΟΜΑ: </span>
                <input type="text" name="firstname" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
                </div>

                <div class="col-md-2">
                <span> ΤΗΛΕΦΩΝΟ 1: </span>
                <input type="text" name="tel1" placeholder="Search" class="form-control form-control-sm" title="Search by product name or SKU" />
                </div>

                <div class="col-md-2">
                    <span> ΕΠΑΓΓΕΛΜΑ: </span>
                    <select name="job" class="form-control form-control-sm">
                    
                        <?php while($row=mysqli_fetch_array($result)):;?>
                            <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                        <?php endwhile;?>
                        
                    </select>
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
                    <input type="submit" value="ΦΙΛΤΡΑΡΙΣΜΑ" class="btn btn-sm btn-primary"/>
                </div>
                
            </div>

            <div id="all-customers" class="row all-customers">
           
                <?php require('resources/showcust-res.php'); ?>
            
            </div>
        
        </form>

        <div id="post"></div>
        

        
    </main>
     
     
</body>

<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">ΕΝΗΜΕΡΩΣΗ ΣΤΟΙΧΕΙΩΝ ΠΕΛΑΤΗ</h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form" action="resources/editcust-res.php">  
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
                          <input type="hidden" name="cust_id" id="cust_id" />  
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
                url:"resources/showcust-res.php",
                mehtod:"POST",
                success:function(data)
                {
                    $("#all-customers").html(data);
                }
            });
        }

        $(document).on('click','.delete',function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this product?"))
            {
                $.ajax({
                    url:"resources/deletecust-res.php",
                    method:"POST",
                    data:{id:id},
                    success:function(data)
                    {
                        load_data();
                        alert("Data Removed");
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
            }
        });
        

        $(document).on('click','.edit',function(){
            var cust_id = $(this).attr("id");
            $.ajax({
                url:"resources/findcust-res.php",
                method:"POST",
                data:{cust_id:cust_id},
                dataType:"json",
                success:function(data){
                    $('#lastname').val(data.lastname);
                    $('#firstname').val(data.firstname);
                    $('#tel1').val(data.tel1);
                    $('#tel2').val(data.tel2);
                    $('#ad').val(data.ad);
                    $('#postcode').val(data.postcode);
                    $('#city').val(data.city);
                    $('#email').val(data.email);
                    $('#job').val(data.job);
                    $('#cust_id').val(data.id);
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