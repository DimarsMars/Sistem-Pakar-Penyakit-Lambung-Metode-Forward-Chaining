<?php 

// Mengambil id dari parameter
$id_gejala=$_GET['id'];

if(isset($_POST['update'])){
    $nama_gejala=$_POST['nama_gejala'];

    // proses update
    $sql = "UPDATE tb_gejala SET nama_gejala='$nama_gejala' WHERE id_gejala='$id_gejala'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=gejala");
    }
}


$sql = "SELECT * FROM tb_gejala WHERE id_gejala='$id_gejala'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-info text-white text-center border-dark"><strong>UPDATE DATA GEJALA</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Gejala</label>
                            <input type="varchar" class="form-control" name="nama_gejala" value="<?php echo $row['nama_gejala']?>" maxlength="255" required>
                        </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=gejala">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>