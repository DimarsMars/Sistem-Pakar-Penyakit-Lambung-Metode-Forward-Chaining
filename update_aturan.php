<?php 

// Mengambil id dari parameter
    $id_relasi=$_GET['id'];

// proses menampilkan data penyakit berdasarkan basis aturan yang dipilih
    $sql = "SELECT tb_relasi.id_relasi,tb_relasi.id_penyakit,tb_penyakit.nama_penyakit FROM tb_relasi INNER JOIN tb_penyakit ON tb_relasi.id_penyakit=tb_penyakit.id_penyakit WHERE id_relasi='$id_relasi'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

// proses update
    if(isset($_POST['update'])){
        $id_gejala=$_POST['id_gejala'];

        if($id_gejala!=Null){ 
            $jumlah = count($id_gejala);
            $i=0;
            while($i < $jumlah){
                $id_gejalanya = $id_gejala[$i];
                $sql = "INSERT INTO tb_detail VALUES ($id_relasi,'$id_gejalanya')";
                mysqli_query($conn,$sql);
                $i++;
            }
        }    
        header("Location:?page=aturan");
    }
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-success text-white text-center border-dark"><strong>UPDATE DATA BASIS ATURAN</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['nama_penyakit']; ?>" name="nama_penyakit" readonly>
                        </div>

                        <!-- tabel gejala -->
                        <div class="form-group">
                            <label for="">Pilih Gejala Gejala Berikut</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th width="50px"></th>
                                        <th width="50px">No.</th>
                                        <th width="700px">Nama Gejala</th>
                                        <th width="50px"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=1;
                                        $sql = "SELECT*FROM tb_gejala ORDER BY nama_gejala ASC";
                                        $result = $conn->query($sql);
                                        while($row = $result->fetch_assoc()) {

                                            $id_gejala=$row['id_gejala'];

                                            // cek tabel detail basis aturan
                                            $sql2 = "SELECT * FROM tb_detail WHERE id_relasi='$id_relasi' AND id_gejala='$id_gejala'";
                                            $result2 = $conn->query($sql2);
                                            if ($result2->num_rows > 0) {
                                                // jika ditemukan maka tampilkan datanya checklist mati hapus aktif
                                    ?>
                                        <tr>
                                            <td align="center"><input type="checkbox" class="check-item" disabled="disabled"></td>
                                            <td align="center"><?php echo $no++; ?></td>
                                            <td><?php echo $row['nama_gejala']; ?></td>
                                            <td align="center">
                                                <a onclick="return confirm('Data ini akan dihapus secara permanen. Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aturan&action=hapus_gejala&id_relasi=<?php echo $id_relasi ?>&id_gejala=<?php echo $id_gejala ?>">
                                                    <i class="fas fa-eraser"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        }else{
                                            // jika tidak ditemukan maka checklist mati hapus aktif
                                    ?>  
                                        <tr>
                                            <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'id_gejala[]'; ?>" value="<?php echo $row['id_gejala']; ?>"></td>
                                            <td align="center"><?php echo $no++; ?></td>
                                            <td><?php echo $row['nama_gejala']; ?></td>
                                            <td align="center">
                                                <i class="fas fa-eraser"></i>
                                            </td>
                                        </tr>                                    

                                    <?php
                                        }
                                    }
                                        $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>