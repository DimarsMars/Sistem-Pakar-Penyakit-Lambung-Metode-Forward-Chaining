<?php 

// Mengambil id dari parameter
$id_penyakit=$_GET['id'];

if(isset($_POST['update'])){
    $nama_penyakit=$_POST['nama_penyakit'];
    $solusi=$_POST['solusi'];

    // proses update
    $sql = "UPDATE tb_penyakit SET nama_penyakit='$nama_penyakit', solusi='$solusi' WHERE id_penyakit='$id_penyakit'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=penyakit");
    }
}


$sql = "SELECT * FROM tb_penyakit WHERE id_penyakit='$id_penyakit'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-danger text-white text-center border-dark"><strong>UPDATE DATA PENYAKIT</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Penyakit</label>
                            <input type="varchar" class="form-control" name="nama_penyakit" value="<?php echo $row['nama_penyakit']?>" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="">Solusi</label>
                            <input type="text" class="form-control" name="solusi" value="<?php echo $row['solusi']?>" maxlength="500" required>
                        </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=penyakit">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>