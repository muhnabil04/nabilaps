<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");

if (isset($_POST["submit"])) {
    $wali_kelas = htmlspecialchars($_POST['wali_kelas']);
    $nama_kelas = htmlspecialchars($_POST['nama_kelas']);


    $sql_kelas = "INSERT INTO kelas (wali_kelas, nama_kelas) VALUES ('$wali_kelas', '$nama_kelas')";

    if (mysqli_query($koneksi, $sql_kelas)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Tambah Data kelas</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nama">wali kelas:</label>
                <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" required>
            </div>
            <div class="form-group">
                <label for="alamat">nama kelas:</label>
                <textarea class="form-control" id="nama_kelas" name="nama_kelas" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>