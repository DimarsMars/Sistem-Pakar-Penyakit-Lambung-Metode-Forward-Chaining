<div class="container mt-4 mb-4">
    <div class="card">
    <div class="card-header bg-success text-white text-center border-dark"><strong>DATA BASIS ATURAN</strong></div>
    <div class="card-body">
    <a class="btn btn-success mb-2" href="?page=aturan&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="20px">ID</th>
            <th width="130px">Nama Penyakit</th>
            <th width="700px">Solusi</th>
            <th width="150px"></th>
        </tr>
        </thead>
        <tbody>
        <?php
            $no=1;
            $sql = "SELECT tb_relasi.id_relasi,tb_relasi.id_penyakit,tb_penyakit.nama_penyakit,tb_penyakit.solusi FROM tb_relasi INNER JOIN tb_penyakit ON tb_relasi.id_penyakit = tb_penyakit.id_penyakit ORDER BY nama_penyakit ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align ="center"><?php echo $no++; ?></td>
                <td><?php echo $row['nama_penyakit']; ?></td>
                <td><?php echo $row['solusi']; ?></td>
                <td align ="center">
                    <a class="btn btn-warning" href="?page=aturan&action=detail&id=<?php echo $row['id_relasi']; ?>">
                        <i class="fas fa-list"></i>
                    </a>
                    <a class="btn btn-primary" href="?page=aturan&action=update&id=<?php echo $row['id_relasi']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Data ini akan dihapus secara permanen. Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aturan&action=hapus&id=<?php echo $row['id_relasi']; ?>">
                        <i class="fas fa-eraser"></i>
                    </a>
                </td>
            </tr>
        <?php
        }
        $conn->close();
        ?>
    </tbody>
    </table>
    </div>
    </div>
</div>