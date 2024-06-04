<!-- proses menampilkan data basis aturan -->
<?php 

// Mengambil id dari parameter
$id_relasi=$_GET['id'];

$sql = "SELECT tb_relasi.id_relasi,tb_relasi.id_penyakit,tb_penyakit.nama_penyakit,tb_penyakit.solusi FROM tb_relasi INNER JOIN tb_penyakit ON tb_relasi.id_penyakit=tb_penyakit.id_penyakit WHERE tb_relasi.id_relasi='$id_relasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<!-- tampilan halaman detail -->
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                        <div class="card-header bg-success text-white border-dark" align ="center"><strong>DETAIL HALAMAN BASIS ATURAN</strong></div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="">Nama Penyakit</label>
                                <input type="text" class="form-control" value="<?php echo $row['nama_penyakit'] ?>" name="nama" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Solusi</label>
                                <input type="text" class="form-control" value="<?php echo $row['solusi'] ?>" name="ket" readonly>
                            </div>

                            <!-- tabel gejala gejala -->
                            <label for="">Gejala Gejala Penyakitnya :</label>
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="40px">No</th>
                                <th width="700px">Nama Gejala</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no=1;
                                $sql = "SELECT tb_detail.id_relasi,tb_detail.id_gejala,tb_gejala.nama_gejala FROM tb_detail 
                                INNER JOIN tb_gejala ON tb_detail.id_gejala=tb_gejala.id_gejala WHERE tb_detail.id_relasi='$id_relasi'";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_gejala']; ?></td>
                                </tr>
                            <?php 
                                }
                                $conn->close();
                            ?>
                            </tbody>
                            </table>
                            <a class="btn btn-danger" href="?page=aturan">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>