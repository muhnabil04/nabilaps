<?php
include('koneksi.php');
// session_start();
$db = new database();
$landing = $db->getLanding();

//sesion
session_start();
if ($_SESSION['role'] !== 'ADMIN') {
    header("location:landing.php");
    exit();
}

if (isset($_POST["cari"])) {
    $keyword = $_POST["cari"];
    $data_siswa = $db->cari($keyword);

    if (!is_array($data_siswa)) {
        $data_siswa = [];
    }
} else {
    $data_siswa = $db->tampil_data();
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $deleteResult = $db->delete($id);

    if (is_string($deleteResult)) {
        echo '<script>alert("' . $deleteResult . '");</script>';
    }
}


$itemsPerPage = 5;

// $status = $_SESSION['status_err'];

$totalItems = is_array($data_siswa) ? count($data_siswa) : 0;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$totalPages = ceil($totalItems / $itemsPerPage);

if ($page < 1) {
    $page = 1;
} elseif ($page > $totalPages) {
    $page = $totalPages;
}

$offset = ($page - 1) * $itemsPerPage;
$data_siswa = array_slice($data_siswa, $offset, $itemsPerPage);
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


    <!-- navbar -->

    <br>
    <div class="container">
        <h2>DATA SISWA</h2>

        <a href="add.php" type="button" class="btn btn-outline-primary">Tambah Data</a>

        <br>
        </br>

        <form method="post">
            <input type="text" name="cari" size="40" autofocus placeholder="masukan pencarian" autocomplete="">
            <button type="submit">cari</button>
        </form>
        <br>
        <table class="table table-bordered">
    </div>

    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NISN</th>
        <th>Alamat</th>
        <th>Kelas</th>
        <th>wali kelas</th>
        <th>Mapel</th>
        <th>guru mapel</th>
        <th>Nilai</th>
        <th>foto siswa</th>
        <th>aksi</th>
    </tr>

    <?php
    $no = ($page - 1) * $itemsPerPage + 1;
    foreach ($data_siswa as $row) {
        echo '<tr>';
        echo '<td>' . $no++ . '</td>';
        echo '<td>' . $row['nama'] . '</td>';
        echo '<td>' . $row['nisn'] . '</td>';
        echo '<td>' . $row['alamat'] . '</td>';
        echo '<td>' . $row['nama_kelas'] . '</td>';
        echo '<td>' . $row['wali_kelas'] . '</td>';
        echo '<td>' . $row['nama_mapel'] . '</td>';
        echo '<td>' . $row['guru_mapel'] . '</td>';
        echo '<td>' . $row['jumlah_nilai'] . '</td>';
        echo '<td><img src="foto/' . $row['foto'] . '" width="100"></td>'; // Fixed the image source here
        echo '<td><a href="delete.php?id=' . $row['id'] . '" type="button" class="btn btn-outline-danger">HAPUS</a>
            <a href="update.php?id=' . $row['id'] . '" type="button" class="btn btn-outline-info">edit</a>
            <a href="detail.php?id=' . $row['id'] . '" type="button" class="btn btn-outline-info">detail</a>
            </td>';
        echo '</tr>';
        // $no++;
    }
    ?>

    </table>
    <div class="pagination">
        <?php
        if ($page > 1) {
            echo "<a href='index.php?page=" . ($page - 1) . "'>&laquo; Previous</a>";
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i === $page) {
                echo "<span class='current-page'>$i</span>";
            } else {
                echo "<a href='index.php?page=$i'>$i</a>";
            }
        }
        if ($page < $totalPages) {
            echo "<a href='index.php?page=" . ($page + 1) . "'>Next &raquo;</a>";
        }
        ?>
    </div>

    </div>
    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>