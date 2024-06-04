<?php

if(isset($_POST['simpan'])){

    // mengambil data dari form
    $nama_gejala=$_POST['nama_gejala'];
	
    // validasi
    $sql = "SELECT*FROM tb_gejala WHERE nama_gejala='$nama_gejala'";
    $sql = "SELECT*FROM tb_gejala WHERE id_gejala='$id_gejala'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data Sudah Ada</strong>
            </div>
        <?php
    }else{
	//proses simpan
        $sql = "INSERT INTO tb_gejala VALUES (Null,'$nama_gejala')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=gejala");
        }
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-info text-white text-center border-dark"><strong>TAMBAH DATA GEJALA</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Gejala</label>
                            <input type="text" class="form-control" name="nama_gejala" maxlength="255" required>
                        </div>

                    <input class="btn btn-info" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=gejala">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>