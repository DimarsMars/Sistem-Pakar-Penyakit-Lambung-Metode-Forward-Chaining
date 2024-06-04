<?php

// Mengambil id dari parameter
$id_relasi=$_GET['id_relasi'];
$id_gejala=$_GET['id_gejala'];

$sql = "DELETE FROM tb_detail WHERE id_relasi='$id_relasi' AND id_gejala='$id_gejala'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=aturan");
}
$conn->close();
?>