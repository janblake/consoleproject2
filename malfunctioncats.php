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
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/global.css" type="text/css" media="all">
    
    <script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
</head>

<?php
require 'resources/db-res.php';  

$sql="SELECT * FROM products";

$result=mysqli_query($conn,$sql);

?>



<body>
     
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ????????????????
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">????????????????</a>
            <a class="dropdown-item" href="movements.php">????????????????????</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ??????????????
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="necustomer.php">????????????????</a>
            <a class="dropdown-item" href="showcustomers.php">????????????????????</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ????????????????
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="newdevice.php">????????????????</a>
            <a class="dropdown-item" href="showdevices.php">????????????????????</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ????????????????????????
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">????????????????</a>
            <a class="dropdown-item" href="#">????????????????????</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="repairstatus.php">???????????? ??????????????????</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ADMIN
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="productcats.php">???????????????????? ??????????????????</a>
            <a class="dropdown-item" href="malfunctioncats.php">???????????????????? ????????????</a>
            <a class="dropdown-item" href="manufacturercats.php">???????????????????? ??????????????????????????</a>
            <a class="dropdown-item" href="modelcats.php">???????????????????? ???????????????? ??????????????????????????</a>
            <a class="dropdown-item" href="jobcats.php">???????????????????? ????????????????????????</a>
            <a class="dropdown-item" href="nowarcats.php">???????????????????? ????-????????????????</a>
            <a class="dropdown-item" href="users.php"> ???????????????????? ??????????????</a>
            </div>
        </li>
        </ul>
    </div>
    <div >
            <?php
                if(isset($_SESSION['usr'])){
                    echo "<h6 style='color:#FFFFFF; margin-right:40px;'>?????????????????? : ".$_SESSION['usr']."</h6>";
                }
            ?>
        </div>
        
        
        <div class="float-right">
            <form action="resources/logout-res.php" method="POST" class="form-inline my-2 my-lg-0 ">
                <button class="btn btn-light my-2 my-sm-0 " type="submit">????????????????????</button>
            </form>
        </div>
    </nav>


     <main class="container">

        <div class="row">
            <div class="col-sm-6">
                <h3>?????????? ????????????</h3>
                <div id="mal-div"></div>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <h3>????????????????</h3>
                <form action="resources/malcats-res.php" method="post">
                    <div class="form-group">

                        <span> ??????????????: </span>
                        <select name="device" class="form-control form-control-sm">
                        
                            <?php while($row=mysqli_fetch_array($result)):;?>
                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                            <?php endwhile;?>
                            
                        </select>

                        <label>?????????????????? ????????????</label>
                        <input type="text" name="name" class="form-control" placeholder="?????? ??????????">
                    </div>
                    <input type="submit" name="submit" value="????????????????" class="btn btn-sm btn-primary"/>
                </form>
            </div>
        </div>

     </main>
     
     
</body>

</html>

<script>
    $(document).ready(function(){
        
        load_data();

        function load_data()
        {
            $.ajax({
                url:"resources/maldisplay-res.php",
                mehtod:"POST",
                success:function(data)
                {
                    $("#mal-div").html(data);
                }
            });
        }


        $(document).on('click','.delete',function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this product?"))
            {
                $.ajax({
                    url:"resources/deletemals-res.php",
                    method:"POST",
                    data:{id:id},
                    success:function(data)
                    {
                        load_data();
                        alert("Data Removed");
                    }
                });
            }
        })
    });
</script>