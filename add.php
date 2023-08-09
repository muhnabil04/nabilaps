<?php
include('koneksi.php');
$koneksi = new database();
$result_kelas = $koneksi->getKelas();
$result_mapel = $koneksi->getMapel();
$result_nilai = $koneksi->getNilai();

//seession
session_start();
if ($_SESSION['role'] !== 'ADMIN') {
    header("location:user.php");
    exit();
}

if (isset($_POST["submit"])) {
    $nama = $_POST['nama'];
    $kelas_id = $_POST['kelas'];
    $nisn = $_POST['nisn'];
    $alamat = $_POST['alamat'];
    $mapel_id = $_POST['mapel'];
    $nilai_id = $_POST['nilai'];


    if (isset($_FILES["foto"])) {
        $rand = rand();
        $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $image_name = $rand . '_' . $filename;

        if (!in_array($ext, $ekstensi)) {
            header("location:index.php");
            exit;
        }

        if ($ukuran > 1044070) {
            header("location:index.php");
            exit;
        }

        move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/' . $image_name);
    }


    $result = $koneksi->tambah($nama, $kelas_id, $nisn, $alamat, $mapel_id, $nilai_id, $image_name);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <!-- navbar -->

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary navbar-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="./kelas/">kelas</a>
                    <a class="nav-item nav-link" href="./mapel/">mapel</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar -->
    <div class="container">
        <center>
            <h2>Add Data</h2>
        </center>
    </div>
    <br>
    <div class="container">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Siswa:</label>
                <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select class="form-control" id="kelas" name="kelas" required>
                    <option value="">Pilih Class</option>
                    <?php
                    while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                        echo '<option value="' . $row_kelas['id'] . '">' . $row_kelas['nama_kelas'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nisn">NISN:</label>
                <input type="text" class="form-control" id="nisn" name="nisn" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="mapel">Mapel:</label>
                <select class="form-control" id="mapel" name="mapel" required>
                    <option value="">Pilih Mapel</option>
                    <?php
                    while ($row_mapel = mysqli_fetch_assoc($result_mapel)) {
                        echo '<option value="' . $row_mapel['id'] . '">' . $row_mapel['nama_mapel'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <select class="form-control" id="nilai" name="nilai" required autocomplete="off">
                    <option value="">pilih Nilai</option>
                    <?php
                    while ($row_nilai = mysqli_fetch_assoc($result_nilai)) {
                        echo '<option value="' . $row_nilai['id'] . '">' . $row_nilai['jumlah_nilai'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Foto :</label>
                <input type="file" name="foto">
                <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
        </form>
    </div>
</body>

</html>