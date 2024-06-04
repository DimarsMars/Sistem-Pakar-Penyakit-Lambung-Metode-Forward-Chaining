<div class="container mt-4 mb-4">
    <div class="card">
    <div class="card-header bg-danger text-white text-center border-dark"><strong>DATA PENYAKIT</strong></div>
    <div class="card-body">
    <a class="btn btn-danger mb-2" href="?page=penyakit&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="20px">ID</th>
            <th width="150px">Nama Penyakit</th>
            <th width="700px">Solusi</th>
            <th width="100px"></th>
        </tr>
        </thead>
        <tbody>
        <?php
            $no=1;
            $sql = "SELECT*FROM tb_penyakit ORDER BY nama_penyakit ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <!-- <td><?php echo $no++; ?></td> -->
                <td><?php echo $row['id_penyakit']; ?></td>
                <td><?php echo $row['nama_penyakit']; ?></td>
                <td><?php echo $row['solusi']; ?></td>
                <td align ="center">
                    <a class="btn btn-primary" href="?page=penyakit&action=update&id=<?php echo $row['id_penyakit']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Data ini akan dihapus secara permanen. Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=penyakit&action=hapus&id=<?php echo $row['id_penyakit']; ?>">
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