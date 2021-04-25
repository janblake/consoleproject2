<?php
require 'db-res.php';
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(empty($username)||empty($password)){?>
        <script> location.replace("../index.php?error=emptyfields");</script>
        <?php
        exit();
    }else{
        $sql="SELECT * FROM users WHERE username=?";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){?>
          <script> location.replace("../index.php?error=sqlerror");</script>
          <?php
          exit();
        }else{
            mysqli_stmt_bind_param($stmt,'s',$username);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)){
                $pwdcheck=password_verify($password,$row['pwd']);
                if($pwdcheck==false){?>
                 <script> location.replace("../index.php?error=wrongpwd");</script>
                 <?php
                 exit();
                }else{
                    session_start();
                    $_SESSION['usr']=$row['username'];?>
                    <script> location.replace("../movements.php");</script>
                    <?php
                    exit();
                }
            }else{?>
                <script> location.replace("../index.php?error=noUser");</script>
                <?php
                exit();
            }
        }
    }
}