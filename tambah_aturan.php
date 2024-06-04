<?php

if(isset($_POST['simpan'])){

    // mengambil data dari form
    $nama_penyakit=$_POST['nama_penyakit'];
	
    // validasi
    $sql = "SELECT tb_relasi.id_relasi,tb_relasi.id_penyakit,tb_penyakit.nama_penyakit FROM tb_relasi INNER JOIN tb_penyakit ON tb_relasi.      id_penyakit=tb_penyakit.id_penyakit WHERE nama_penyakit='$nama_penyakit'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data Sudah Ada</strong>
            </div>
        <?php
    }else{

        // mengambil data penyakit
        $sql = "SELECT * FROM tb_penyakit WHERE nama_penyakit='$nama_penyakit'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_penyakit = $row['id_penyakit'];

	    //proses simpan basis aturan
        $sql = "INSERT INTO tb_relasi VALUES (Null,'$id_penyakit')";
        mysqli_query($conn,$sql);

        // proses simpan detail basis aturan
        $id_gejala=$_POST['id_gejala'];

        // proses mengambil data aturan
        $sql = "SELECT * FROM tb_relasi ORDER BY id_relasi DESC";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_relasi = $row['id_relasi'];

	    //proses simpan detail aturan
        $jumlah = count($id_gejala);
        $i=0;
        while($i < $jumlah){
            $id_gejalanya = $id_gejala[$i];
            $sql = "INSERT INTO tb_detail VALUES ($id_relasi,'$id_gejalanya')";
            mysqli_query($conn,$sql);
            $i++;
        }
        header("Location:?page=aturan");
    }
}
?>

<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-success text-white text-center border-dark"><strong>TAMBAH DATA BASIS ATURAN</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Penyakit</label>
                            <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nama_penyakit">
                                <option value=""></option>
                                <?php
                                    $sql = "SELECT * FROM tb_penyakit ORDER BY nama_penyakit ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nama_penyakit']; ?>"><?php echo $row['nama_penyakit']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=1;
                                        $sql = "SELECT*FROM tb_gejala ORDER BY nama_gejala ASC";
                                        $result = $conn->query($sql);
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'id_gejala[]'; ?>" value="<?php echo $row['id_gejala']; ?>"></td>
                                        <td align="center"><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama_gejala']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                        $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    function validasiForm()
    {
        // validasi nama penyakit
        var nama_penyakit = document.forms["Form"]["nama_penyakit"].value;

        if(nama_penyakit=="")
        {
            alert("Pilih Nama Penyakit");
            return false;
        }

        // validasi gejala yang belum dipilih
        var checkbox=document.getElementsByName('<?php echo 'id_gejala[]'; ?>');

        var isChecked=false;

        for(var i=0;i<checkbox.length;i++){
            if(checkbox[i].checked){
                isChecked = true;
                break;
            }
        }

        // jika belum ada yang di check
        if(!isChecked){
            alert('Pilih Setidaknya Satu Gejala !!');
            return false;
        }

        return true;
    }

</script>