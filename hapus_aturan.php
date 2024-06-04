<?php

// Mengambil id dari parameter
$id_relasi=$_GET['id'];

// hapus basis aturan
$sql = "DELETE FROM tb_relasi WHERE id_relasi='$id_relasi'";
$conn->query($sql);

// hapus detail basis aturan
$sql = "DELETE FROM tb_detail WHERE id_relasi='$id_relasi'";
$conn->query($sql);

$conn->close();

header("Location:?page=aturan");
?>