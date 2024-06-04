<?php 

// Mengambil id dari parameter
$id_user=$_GET['id'];

if(isset($_POST['update'])){
    $role=$_POST['role'];

    // proses update
    $sql = "UPDATE tb_user SET role='$role' WHERE id_user='$id_user'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=user");
    }
}


$sql = "SELECT * FROM tb_user WHERE id_user='$id_user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-info text-white text-center border-dark"><strong>UPDATE DATA USER</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="varchar" class="form-control" name="user" value="<?php echo $row['username']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="pass" value="ket" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select class="form-control chosen" data-placeholder="Pilih Role" name="role">
                                <option value="<?php echo $row['role']?>"><?php echo $row['role']?></option>
                                <option value="Admin">Admin</option>
                                <option value="Pasien">Pasien</option>
                            </select>
                        </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=user">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
