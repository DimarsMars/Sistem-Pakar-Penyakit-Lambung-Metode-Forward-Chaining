<?php
session_start();
// koneksi database
include "config.php";

// koneksi gejala
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPL</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- datatables css -->
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <!-- font awesome css -->
    <link rel="stylesheet" href="assets/css/all.css">
    <!-- chosen css -->
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
    <!-- <style css> -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<!-- navbar -->
<nav class="navbar navbar-expand-sm bg-info navbar-dark ">
  <!-- Brand/logo -->
  <h1 class="navbar-brand"><strong>Diagnose</strong></h1>
  
  <!-- Links -->
  <ul class="navbar-nav ">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Home</a>
    </li>

    <?php
        if($_SESSION['role']=="Admin"){

        
    ?>

    <li class="nav-item">
      <a class="nav-link" href="?page=user">User</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="?page=gejala">Gejala</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="?page=penyakit">Penyakit</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="?page=aturan">Basis Aturan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="?page=konsultasiadm">Konsultasi</a>
    </li>

    <?php
        }else{
    ?>

    <li class="nav-item">
      <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
    </li>

    <?php
      }
    ?>

    <li class="nav-item">
      <a class="nav-link" href="?page=logout">Log Out</a>
    </li>
  </ul>
</nav>

<!-- cek status login -->
<?php 
    if($_SESSION['status']!="y"){
        header("Location:login.php");
    }
?>

<!-- container -->
<!-- <div class="container mt-4"> -->

<!-- setting menu -->
  <?php

  $page = isset($_GET['page']) ? $_GET['page'] : "";
  $action = isset($_GET['action']) ? $_GET['action'] : "";

  if ($page==""){
      include "home.php";
    }elseif ($page=="gejala"){
        if ($action==""){
            include "tampilan_gejala.php";
        }elseif ($action=="tambah"){
            include "tambah_gejala.php";
        }elseif ($action=="update"){
            include "update_gejala.php";
        }else{
            include "hapus_gejala.php";
        }
    }elseif ($page=="penyakit"){
        if ($action==""){
            include "tampilan_penyakit.php";
        }elseif ($action=="tambah"){
            include "tambah_penyakit.php";
        }elseif ($action=="update"){
            include "update_penyakit.php";
        }else{
          include "hapus_penyakit.php";
        }
    }elseif ($page=="aturan"){
      if ($action==""){
          include "tampilan_aturan.php";
      }elseif ($action=="tambah"){
          include "tambah_aturan.php";
      }elseif ($action=="detail"){
          include "detail_aturan.php";
      }elseif ($action=="update"){
          include "update_aturan.php";
      }elseif ($action=="hapus_gejala"){
        include "hapus_detail_aturan.php";
      }else{
        include "hapus_aturan.php";
      }
    }elseif ($page=="konsultasi"){
      if ($action==""){
          include "tampilan_konsultasi.php";
      }else{
        include "hasil_konsultasi.php";
      }
    }elseif ($page=="konsultasiadm"){
      if ($action==""){
          include "tampilan_konsultasiadm.php";
      }else{
        include "detail_konsultasiadm.php";
      }
    }elseif ($page=="user"){
      if ($action==""){
          include "tampilan_user.php";
      }elseif ($action=="tambah"){
          include "tambah_user.php";
      }elseif ($action=="update"){
          include "update_user.php";
      }else{
        include "hapus_user.php";
      }
  }else{
      include "logout.php";
  }
  ?>

<!-- </div> -->

<!-- jquery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- datatable js -->
<script src="assets/js/datatables.min.js"></script>
<script>
      $(document).ready(function() {
            $('#myTable').DataTable();
      } );
</script>

<!-- font awesome js -->
<script src="assets/js/all.js"></script>
<!-- chosen js -->
<script src="assets/js/chosen.jquery.min.js"></script>
<script>
      $(function() {
        $('.chosen').chosen();
      });
</script>

</body>
</html>