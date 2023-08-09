<?php
include('koneksi.php');
$db = new database();
$landing = $db->getLanding();

//session
session_start();


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db->koneksi, $query);
    if ($result) {
        $data = mysqli_fetch_array($result); // Fetch the data
        $cekdata = mysqli_num_rows($result); // Get the number of rows
    } else {
    }
    if ($cekdata > 0) {
        if ($data['role'] == "ADMIN") {
            $_SESSION['role'] = $data['role'];
            $_SESSION['username'] = $data['username'];
            header('location: index.php');
        } elseif ($data['role'] == "USER") {
            $_SESSION['role'] = $data['role'];
            $_SESSION['username'] = $data['username'];
            header('location: user.php');
        }
    } else {
        echo "login gagal";
    }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="./asset/css/style.css">
    <title>Document</title>
</head>

<body>
    <!-- navbar -->
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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="#fitur">Fitur</a>
                    <a class="nav-link me-5" href="#testi">testimoni</a>
                </div>
                <a href="./login.php" class="btn btn-outline-secondary shadow-sm d-sm d-block">login</a>
            </div>
        </div>
    </nav>
    <!-- login page -->
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="./foto/<?php
                                            foreach ($landing as $row) {
                                                echo $row["foto"];
                                            }

                                            ?>" alt="brand" width="50">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">Username</label>
                                    <input name="username" id="email" type="email" class="form-control" value="" required autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright &copy; 2023-2030 &mdash; BilSchooll
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>