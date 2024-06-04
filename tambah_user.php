<?php

if(isset($_POST['simpan'])){

    // mengambil data dari form
    $username=$_POST['username'];
    $pass=md5($_POST['pass']);
    $role=$_POST['role'];
	
	//proses simpan
        $sql = "INSERT INTO tb_user VALUES (Null,'$username','$pass','$role')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=user");
        }
}

?>


<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-info text-white text-center border-dark"><strong>TAMBAH DATA USER</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="varchar" class="form-control" name="username" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="pass" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select class="form-control chosen" data-placeholder="Pilih Role" name="role">
                                <option value=""></option>
                                <option value="Admin">Admin</option>
                                <option value="Pasien">Pasien</option>
                            </select>
                        </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=user">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>