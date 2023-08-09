<?php
//session

include("koneksi.php");
$koneksi = new database();

$id = $_GET['id'];

try {
    $koneksi->delete($id);
    header("location: index.php");
} catch (mysqli_sql_exception $e) {
    echo "<script>alert('Hapus gagal karena ada relasi dalam tabel'); window.location.href = 'index.php';</script>";
}
