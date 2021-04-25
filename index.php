
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




<body>


    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php
                          if(isset($_GET['error'])){
                            if($_GET['error']=="wrongpwd"){
                              echo '<p style="color:red;text-align:center">Λάθος Όνομα Χρήστη</p>';
                            }else{
                              echo '<p style="color:red;text-align:center">Λάθος Κωδικός Πρόσβασης</p>';
                            }
                          }
                         ?>
                    <div class="card">
                        
                        <div class="card-header">Σύνεση στην κονσόλα</div>
                            <div class="card-body">
                            <form action="resources/login-res.php" method="POST">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Όνομα Χρήστη</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="username" required autofocus>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Κωδικός Πρόσβασης</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>
    
                                
    
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                        Σύνδεση
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </main>
     
     
</body>

</html>