<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");
include 'koneksi.php';


$id = $_GET['id'];


mysqli_query($koneksi, "delete from kelas where id='$id'");

header("location:index.php");
