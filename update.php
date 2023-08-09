<?php

//session
session_start();
if ($_SESSION['role'] !== 'ADMIN') {
    header("location:add.php");
    exit();
}

include('koneksi.php');
$db = new database();
$id = $_GET['id'];
$data = $db->getid($id);

$result_kelas = $db->getKelas();
$result_mapel = $db->getMapel();
$result_nilai = $db->getNilai();


if (isset($_POST["submit"])) {
    $nama = $_POST['nama'];
    $kelas_id = $_POST['kelas'];
    $nisn = $_POST['nisn'];
    $alamat = $_POST['alamat'];
    $mapel_id = $_POST['mapel'];
    $nilai_id = $_POST['nilai'];


    if (!empty($_FILES["foto"]["name"])) {
        $rand = rand();
        $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $image_name = $rand . '_' . $filename;

        move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/' . $image_name);
    } else {
        $image_name = $data['foto'];
    }

    $result = $db->update(
        $id,
        $nama,
        $kelas_id,
        $nisn,
        $alamat,
        $mapel_id,
        $nilai_id,
        $image_name
    );

    if ($result) {
        header("Location: index.php");
        exit;
    } else {
        echo "Update failed.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="./asset/css/style.css">

    <title>aplikasi</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./foto/<?php
                                    foreach ($landing as $row) {
                                        echo $row["foto"];
                                    }

                                    ?>" alt="brand" width="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="./mapel/index.php">mapel</a>
                    <a class="nav-link me-5" href="./kelas/index.php">kelas</a>
                </div>
                <a href="./logout.php" class="btn btn-outline-secondary shadow-sm d-sm d-block">log out</a>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <div class="container">
        <center>
            <h2>Edit Data</h2>
        </center>
    </div>
    <br>
    <div class="container">
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama Siswa:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select class="form-control" id="kelas" name="kelas" required>
                    <option value="">Pilih Class</option>
                    <?php
                    while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                        $selected = ($row_kelas['id'] == $data['kelas_id']) ? "selected" : "";
                        echo '<option value="' . $row_kelas['id'] . '" ' . $selected . '>' . $row_kelas['nama_kelas'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nisn">NISN:</label>
                <input type="text" class="form-control" id="nisn" name="nisn" value="<?php echo $data['nisn']; ?>" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="mapel">Mapel:</label>
                <select class="form-control" id="mapel" name="mapel" required>
                    <option value="">Pilih Mapel</option>
                    <?php
                    while ($row_mapel = mysqli_fetch_assoc($result_mapel)) {
                        $selected = ($row_mapel['id'] == $data['mapel_id']) ? "selected" : "";
                        echo '<option value="' . $row_mapel['id'] . '" ' . $selected . '>' . $row_mapel['nama_mapel'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <select class="form-control" id="nilai" name="nilai" required>
                    <option value="">Pilih Nilai</option>
                    <?php
                    while ($row_nilai = mysqli_fetch_assoc($result_nilai)) {
                        $selected = ($row_nilai['id'] == $data['nilai_id']) ? "selected" : "";
                        echo '<option value="' . $row_nilai['id'] . '" ' . $selected . '>' . $row_nilai['jumlah_nilai'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Foto :</label>
                <img src="foto/<?php echo $data['foto']; ?>" width="100px">
                <input type="file" name="foto">
                <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>