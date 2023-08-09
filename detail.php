<?php
//session
session_start();
if (!isset($_SESSION['role'])) {
    header('location:landing.php');
}

include('koneksi.php');
$db = new database();
$data_siswa = $db->tampil_data();

$id = $_GET['id'];
$mapelBySiswaId = $db->getsiswaMapel($id);
// print_r($mapelBySiswaId);
// die;

if (isset($_GET['id'])) {
    $data = $db->getdetail($id);
} else {
    header("Location: index.php");
    exit;
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
    </div>
    <br>
    <div class="container">
        <center>
            <h2>Detail Data Siswa</h2>
        </center>
        <a href="tambahmapel.php?id=<?php echo $data['id']; ?>" type="button" class="btn btn-outline-info">tambah mapel</a>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h4>Foto</h4>
                <img src="foto/<?php echo $data['foto']; ?>" width="200px">
            </div>
            <div class="col-md-6">
                <h4>Data Siswa</h4>
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $data['nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?php echo $data['nama_kelas']; ?></td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?php echo $data['nisn']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $data['alamat']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <div class="col-md-12">
            <h4>Nilai</h4>
            <table class="table">
                <tr>
                    <td>Mapel</td>
                    <td>Nilai</td>
                    <td>Status Nilai</td>
                </tr>
                <?php foreach ($mapelBySiswaId as $item) { ?>
                    <tr>
                        <td><?php echo $item['nama_mapel']; ?></td>
                        <td><?php echo $item['jumlah_nilai']; ?></td>
                        <td><?php echo $db->getNilaiStatus($item['jumlah_nilai']); ?></td>
                    </tr>
                <?php } ?>

            </table>

        </div>
    </div>
    <br>
    </div>
</body>

</html>