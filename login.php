<!-- proses login  -->
<?php
session_start();
require "config.php";

if(isset($_POST["submit"])){

    // mengambil data dari form
    $username=$_POST["username"];
    $pass=md5($_POST["pass"]);

    $sql = "SELECT*FROM tb_user WHERE username='$username' AND pass='$pass'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        
        // jika login berhasil
        // membuat session
        $_SESSION['username'] = $row["username"];
        $_SESSION['role'] = $row["role"];
        $_SESSION['status'] = "y";
    
       header("Location:index.php");

    } else {
        header("Location:?msg=n");
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>

    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

<!-- validasi login gagal-->
<?php 
if(isset($_GET['msg'])){
    if($_GET['msg'] == "n"){
    ?>
    <div class="alert alert-danger" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Login Gagal</strong>
    </div>
    <?php
    }       
}
?>

<div class="container-fluid" style="margin-top:190px">
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <form method="POST">
                <div class="card border-dark">
                    <div class="card-header bg-info text-light border-dark" align="center">
                        <strong>LOGIN</strong>
                    </div>
                    <div class="card-body border">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="pass" autocomplete="off" required>
                        </div>
                        <div class="tombol" align="center">
                            <input type="submit" class="btn btn-primary" name="submit" value="Login">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jquery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>