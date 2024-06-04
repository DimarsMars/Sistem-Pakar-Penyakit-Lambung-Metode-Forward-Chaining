<?php

if(isset($_POST['simpan'])){

    // mengambil data dari form
    $nama_penyakit=$_POST['nama_penyakit'];
    $id_penyakit=$_POST['id_penyakit'];
    $solusi=$_POST['solusi'];
	
    // validasi
    $sql = "SELECT*FROM tb_penyakit WHERE nama_penyakit='$nama_penyakit'";
    $sql = "SELECT*FROM tb_penyakit WHERE id_penyakit='$id_penyakit'";
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
        $sql = "INSERT INTO tb_penyakit VALUES ('$id_penyakit','$nama_penyakit','$solusi')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=penyakit");
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
                    <div class="card-header bg-danger text-white text-center border-dark"><strong>TAMBAH DATA PENYAKIT</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Id Penyakit</label>
                            <input type="varchar" class="form-control" name="id_penyakit" maxlength="4" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Penyakit</label>
                            <input type="text" class="form-control" name="nama_penyakit" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="">Solusi</label>
                            <input type="text" class="form-control" name="solusi" maxlength="2000" required>
                        </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=penyakit">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>