<?php
include('koneksi.php');
$db = new database();
$id = $_GET['id'];
$data = $db->getidlanding($id);

//session
session_start();
if ($_SESSION['role'] !== 'ADMIN') {
    header("location:add.php");
    exit();
}

if (isset($_POST["submit"])) {
    $text = $_POST['text'];



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

    $result = $db->editLanding(
        $id,
        $text,
        $image_name
    );

    if ($result) {
        header("location:index.php");
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
            <h2>landing page</h2>
        </center>
    </div>
    <br>
    <div class="container">


        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="text">text landing:</label>
                <input type="text" class="form-control" id="text" name="text" required autocomplete="off" value="<?php echo $data['text']; ?>">
            </div>
            <div class="form-group">
                <label>logo web :</label>
                <img src="foto/<?php echo $data['foto']; ?>" width="100px">
                <input type="file" name="foto">
                <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">submit</button>
        </form>
    </div>


</body>

</html>