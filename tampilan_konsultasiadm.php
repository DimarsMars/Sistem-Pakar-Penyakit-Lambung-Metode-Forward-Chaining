<div class="container mt-4 mb-4">
    <div class="card">
    <div class="card-header bg-success text-white text-center border-dark"><strong>DATA HASIL KONSULTASI</strong></div>
    <div class="card-body">
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="30px">No</th>
            <th width="100px">Tanggal</th>
            <th width="600px">Nama Pasien</th>
            <th width="100px"></th>
        </tr>
        </thead>
        <tbody>
        <?php
            $no=1;
            $sql = "SELECT * FROM tb_konsultasi ORDER BY tanggal DESC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align ="center"><?php echo $no++; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td align ="center">
                    <a class="btn btn-warning" href="?page=konsultasiadm&action=detail&id=<?php echo $row['id_konsultasi']; ?>">
                        <i class="fas fa-list"></i>
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