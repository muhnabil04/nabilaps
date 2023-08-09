<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");
$result = mysqli_query($koneksi, "SELECT * FROM mapel ");


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mapel</title>
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
                    <a class="nav-item nav-link active" href="/siswa/">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="/siswa/kelas">kelas</a>
                    <a class="nav-item nav-link" href="index.php">mapel</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar -->
    <br>
    <div class="container">
        <h2>Data Mapel</h2>

        <a href="create.php" type="button" class="btn btn-outline-primary">Tambah Data</a>

        <br>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>nama mapel</th>
                <th>guru mapel</th>
                <th>aksi</th>

            </tr>

            <?php
            $no = 1;
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $row['nama_mapel'] . '</td>';
                echo '<td>' . $row['guru_mapel'] . '</td>';

                echo '<td><a href="delete.php?id=' . $row['id'] . '" type="button" class="btn btn-outline-danger">HAPUS</a>
                <a href="update.php?id=' . $row['id'] . '" type="button" class="btn btn-outline-info">edit</a>
                
                
                </td>';
                echo '</tr>';
                $no++;
            }
            ?>

        </table>
    </div>
</body>

</html>