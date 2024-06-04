<div class="container mt-4 mb-4">
    <div class="card">
    <div class="card-header bg-info text-white text-center border-dark"><strong>DATA GEJALA</strong></div>
    <div class="card-body">
    <a class="btn btn-info mb-2" href="?page=gejala&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="15px">ID</th>
            <th width="700px">Nama Gejala</th>
            <th width="100px"></th>
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
                <!-- <td><?php echo $no++; ?></td> -->
                <td align ="center"><?php echo $row['id_gejala']; ?></td>
                <td><?php echo $row['nama_gejala']; ?></td>
                <td align ="center">
                    <a class="btn btn-primary" href="?page=gejala&action=update&id=<?php echo $row['id_gejala']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Data ini akan dihapus secara permanen. Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=gejala&action=hapus&id=<?php echo $row['id_gejala']; ?>">
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