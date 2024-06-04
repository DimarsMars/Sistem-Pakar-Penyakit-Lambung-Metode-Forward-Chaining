<?php

// Mengambil id dari parameter
$id_user=$_GET['id'];

$sql = "DELETE FROM tb_user WHERE id_user='$id_user'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=user");
}
$conn->close();
?>