<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $nama_mapel = htmlspecialchars($_POST['nama_mapel']);
    $guru_mapel = htmlspecialchars($_POST['guru_mapel']);

    $sql_mapel = "UPDATE mapel SET nama_mapel='$nama_mapel', guru_mapel='$guru_mapel' WHERE id='$id'";

    if (mysqli_query($koneksi, $sql_mapel)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query_get_data = "SELECT * FROM mapel WHERE id='$id'";
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
                <label for="nama_mapel">Nama Mapel:</label>
                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="<?php echo $data['nama_mapel']; ?>" required>
            </div>
            <div class="form-group">
                <label for="guru_mapel">Guru Mapel:</label>
                <textarea class="form-control" id="guru_mapel" name="guru_mapel" rows="3" required><?php echo $data['guru_mapel']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>