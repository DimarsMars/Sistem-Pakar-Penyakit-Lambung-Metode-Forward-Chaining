<div class="container mt-4 mb-4">
    <div class="card">
    <div class="card-header bg-info text-white text-center border-dark"><strong>DATA USER</strong></div>
    <div class="card-body">
    <a class="btn btn-info mb-2" href="?page=user&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="10px">No</th>
            <th width="300px">Username</th>
            <th width="300px">Role</th>
            <th width="100px"></th>
        </tr>
        </thead>
        <tbody>
        <?php
            $no=1;
            $sql = "SELECT*FROM tb_user ORDER BY username ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align ="center"><?php echo $no++; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td align ="center">
                    <a class="btn btn-primary" href="?page=user&action=update&id=<?php echo $row['id_user']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Data ini akan dihapus secara permanen. Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=user&action=hapus&id=<?php echo $row['id_user']; ?>">
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