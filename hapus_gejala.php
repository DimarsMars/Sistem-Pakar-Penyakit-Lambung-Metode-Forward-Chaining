<?php

// Mengambil id dari parameter
$id_gejala=$_GET['id'];

$sql = "DELETE FROM tb_gejala WHERE id_gejala='$id_gejala'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=gejala");
}
$conn->close();
?>