<?php

// Mengambil id dari parameter
$id_penyakit=$_GET['id'];

$sql = "DELETE FROM tb_penyakit WHERE id_penyakit='$id_penyakit'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=penyakit");
}
$conn->close();
?>