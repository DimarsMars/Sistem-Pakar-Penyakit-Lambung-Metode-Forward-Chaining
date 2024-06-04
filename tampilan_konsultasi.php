<?php 
date_default_timezone_set("Asia/Makassar");

if(isset($_POST['proses'])) {

    // mengambil data dari form
    $nama_pasien=$_POST['nama_pasien'];
    $tgl=date("Y/m/d");

    //proses simpan konsultasi
    $sql = "INSERT INTO tb_konsultasi VALUES (Null,'$tgl','$nama_pasien')";
    mysqli_query($conn,$sql);

    // proses mengambil id gejala
    $id_gejala=$_POST['id_gejala'];

    // proses mengambil data konsultasi
    $sql = "SELECT * FROM tb_konsultasi ORDER BY id_konsultasi DESC";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id_konsultasi = $row['id_konsultasi'];

    //proses simpan detail konsultasi
    $jumlah = count($id_gejala);
    $i=0;
    while($i < $jumlah){
        $id_gejalanya = $id_gejala[$i];
        $sql = "INSERT INTO tb_detail_konsul VALUES ($id_konsultasi,'$id_gejalanya')";
        mysqli_query($conn,$sql);
        $i++;
    }

    // mengambil data dari tabel penyakit untuk dicek di basis aturan
    $sql = "SELECT*FROM tb_penyakit ORDER BY nama_penyakit ASC";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {

        $id_penyakit = $row['id_penyakit'];
        $jyes=0;

        // mencari jumlah gejala di basis aturan berdasarkan penyakitnya
        $sql2 = "SELECT COUNT(id_penyakit) AS jumlah_gejala FROM tb_relasi INNER JOIN tb_detail ON tb_relasi.id_relasi=tb_detail.id_relasi WHERE id_penyakit='$id_penyakit'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $jumlah_gejala = $row2['jumlah_gejala'];

        // mencari gejalan pada basis aturan
        $sql3 = "SELECT id_penyakit, id_gejala FROM tb_relasi INNER JOIN tb_detail ON tb_relasi.id_relasi=tb_detail.id_relasi WHERE id_penyakit='$id_penyakit'";
        $result3 = $conn->query($sql3);
        while($row3 = $result3->fetch_assoc()) {

            $id_gejalanya=$row3['id_gejala'];

            // membandingkan apakah yang dipilih pada konsultasi sesuai
            $sql4 = "SELECT id_gejala FROM tb_detail_konsul WHERE id_konsultasi='$id_konsultasi' AND id_gejala='$id_gejalanya'";
            $result4 = $conn->query($sql4);
            if ($result4->num_rows > 0) {
                $jyes+=1;
            }

        }

        // mencari persentase
        if($jumlah_gejala > 0){
            $peluang = round(($jyes/$jumlah_gejala)*100,2);
        }else{
            $peluang = 0;
        }

        // simpan data detail penyakit
        if($peluang > 0){
            $sql = "INSERT INTO tb_detail_penyakit VALUES ($id_konsultasi,'$id_penyakit','$peluang')";
            mysqli_query($conn,$sql);
        }
        header("Location:?page=konsultasi&action=hasil&id_konsultasi=$id_konsultasi");
    }
}

?>


<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-danger text-white text-center border-dark"><strong>KONSULTASI PENYAKIT</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" class="form-control" name="nama_pasien" maxlength="255" required>
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

                        <input class="btn btn-primary" type="submit" name="proses" value="Proses">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    function validasiForm()
    {

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