<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");

if (isset($_POST["submit"])) {
    $nama_mapel = htmlspecialchars($_POST['nama_mapel']);
    $guru_mapel = htmlspecialchars($_POST['guru_mapel']);


    $sql_kelas = "INSERT INTO mapel (nama_mapel, guru_mapel) VALUES ('$nama_mapel', '$guru_mapel')";

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
    <title>Tambah Data mapel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Tambah Data mapel</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nama">nama mapel:</label>
                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
            </div>
            <div class="form-group">
                <label for="alamat">guru mapel:</label>
                <textarea class="form-control" id="guru_mapel" name="guru_mapel" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>