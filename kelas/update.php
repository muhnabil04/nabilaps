<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $wali_kelas = htmlspecialchars($_POST['wali_kelas']);
    $nama_kelas = htmlspecialchars($_POST['nama_kelas']);

    $sql_kelas = "UPDATE kelas SET wali_kelas='$wali_kelas', nama_kelas='$nama_kelas' WHERE id='$id'";

    if (mysqli_query($koneksi, $sql_kelas)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query_get_data = "SELECT * FROM kelas WHERE id='$id'";
    $result_get_data = mysqli_query($koneksi, $query_get_data);
    $data = mysqli_fetch_assoc($result_get_data);
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <center>
            <h2>Edit Data</h2>
        </center>
    </div>
    <br>
    <div class="container">
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="form-group">
                <label for="wali_kelas">Wali Kelas:</label>
                <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" value="<?php echo $data['wali_kelas']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas:</label>
                <textarea class="form-control" id="nama_kelas" name="nama_kelas" rows="3" required><?php echo $data['nama_kelas']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>