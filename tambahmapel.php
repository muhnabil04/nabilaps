<?php

session_start();
if ($_SESSION['role'] !== 'ADMIN') {
    header("location:add.php");
    exit();
}

include('koneksi.php');
$db = new database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $db->getdetail($id);
} else {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    if (isset($_POST['mapel_id']) && isset($_POST['nilai_id'])) {
        $mapel_id = $_POST['mapel_id'];
        $nilai_id = $_POST['nilai_id'];

        $db->tambahMapel($id, $mapel_id, $nilai_id);
    } else {
        header("Location: tambahmapel.php?id=$id");
        exit;
    }
}

$mapel_list = $db->getMapel();
$nilai_list = $db->getNilai();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mapel</title>
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
            <h2>Tambah Mapel</h2>
        </center>

        <form method="post">
            <div class="form-group">
                <label for="mapel_id">Pilih Mapel:</label>
                <select class="form-control" id="mapel_id" name="mapel_id">
                    <?php
                    while ($mapel = mysqli_fetch_assoc($mapel_list)) {
                        echo '<option value="' . $mapel['id'] . '">' . $mapel['nama_mapel'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nilai_id">Pilih Nilai:</label>
                <select class="form-control" id="nilai_id" name="nilai_id">
                    <?php
                    while ($nilai = mysqli_fetch_assoc($nilai_list)) {
                        echo '<option value="' . $nilai['id'] . '">' . $nilai['jumlah_nilai'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </form>
        <br>
        <a href="detail.php?id=<?php echo $data['id']; ?>" type="button" class="btn btn-outline-info">Kembali</a>
    </div>
</body>

</html>