<?php
include('koneksi.php');
$db = new database();
$landing = $db->getLanding();

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

  <title>welcome</title>
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
          <a class="nav-link" href="#fitur">Fitur</a>
          <a class="nav-link me-5" href="#testi">testimoni</a>
        </div>
        <a href="./login.php" class="btn btn-outline-secondary shadow-sm d-sm d-block">login</a>
      </div>
    </div>
  </nav>
  <!-- hero -->
  <section class="hero">
    <div class="container">
      <div class="row">
        <!-- text -->
        <div class="col-md-6">
          <div class="text">

            <?php
            foreach ($landing as $row) {
              echo $row["text"];
            }
            ?>
          </div>
          <div class="buttons">
            <a href="./login.php" class="btn btn-primary">login</a>
          </div>
        </div>
        <!-- image -->
        <div class="col-md-6">
          <img src="./asset/img/siswa2.png" alt="siswa" class="w-100">
        </div>
      </div>
    </div>
  </section>

  <!-- setup -->
  <section class="setup">
    <div class="container">
      <div class="text-header text-center" id="fitur">
        <h3>Fitur Pada Website</h3>
        <p>fitur yang ada pada website ini</p>
      </div>
      <div class="items text-center">
        <div class="row">
          <div class="col-md-4">
            <div class="icons">
              <img src="./asset/img/logo1.png" class="w-25">
            </div>
            <div class="desc">
              <h5>berbasis crud</h5>
              <p>web berbasis create,read,update,delete sehingga dapat mudah di gunakan</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="icons">
              <img src="./asset/img/logo3.png" class="w-25">
            </div>
            <div class="desc">
              <h5>nilai mapel </h5>
              <p> dapat menambah nilai mapel untuk tiap siswa</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="icons">
              <img src="./asset/img/logo2.png" class="w-25">
            </div>
            <div class="desc">
              <h5> searching</h5>
              <p>memiliki fitur search yang memudahkan pencarian data siswa</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- contact -->

  <div class="container">
    <section>
      <div class="row d-flex justify-content-center" id="testi">
        <div class="col-md-10 col-xl-8 text-center">
          <h3 class="mb-4">Testimoni</h3>
          <p class="mb-4 pb-2 mb-md-5 pb-md-0">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet
            numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum
            quisquam eum porro a pariatur veniam.
          </p>
        </div>
      </div>

      <div class="row text-center">
        <div class="col-md-4 mb-5 mb-md-0">
          <div class="d-flex justify-content-center mb-4">
            <img src="https://cdn.pnghd.pics/data/290/gambar-bocah-afrika-lucu-39.jpg" class="rounded-circle shadow-1-strong" width="150" height="150" />
          </div>
          <h5 class="mb-3">Maria Smantha</h5>
          <h6 class="text-primary mb-3">guru</h6>
          <p class="px-xl-3">
            <i class="fas fa-quote-left pe-2"></i>Lorem ipsum dolor sit amet, consectetur
            adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic
            tenetur.
          </p>
        </div>
        <div class="col-md-4 mb-5 mb-md-0">
          <div class="d-flex justify-content-center mb-4">
            <img src="https://cdn.pnghd.pics/data/290/gambar-bocah-afrika-lucu-39.jpg" class="rounded-circle shadow-1-strong" width="150" height="150" />
          </div>
          <h5 class="mb-3">Lisa Cudrow</h5>
          <h6 class="text-primary mb-3">guru</h6>
          <p class="px-xl-3">
            <i class="fas fa-quote-left pe-2"></i>Ut enim ad minima veniam, quis nostrum
            exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid commodi.
          </p>
        </div>
        <div class="col-md-4 mb-0">
          <div class="d-flex justify-content-center mb-4">
            <img src="https://cdn.pnghd.pics/data/290/gambar-bocah-afrika-lucu-39.jpg" class="rounded-circle shadow-1-strong" width="150" height="150" />
          </div>
          <h5 class="mb-3">John Smith</h5>
          <h6 class="text-primary mb-3">guru</h6>
          <p class="px-xl-3">
            <i class="fas fa-quote-left pe-2"></i>At vero eos et accusamus et iusto odio
            dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.
          </p>
        </div>
      </div>
    </section>
  </div>

  <!-- footer -->

  <footer>
    <hr>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="row row-cols-1 rows-col-5 g-2 g-lg-3">
            <div class="col-md-3">
              <div>
                <small>
                  <a href="landing.php" class="text-decoration-none">Home</a>
                </small>
              </div>
            </div>
            <div class="col-md-3">
              <div>
                <small>
                  <a href="#fitur" class="text-decoration-none">Features</a>
                </small>
              </div>
            </div>
            <div class="col-md-3">
              <div>
                <small>
                  <a href="#testi" class="text-decoration-none">testimoni</a>
                </small>
              </div>
            </div>
            <div class="col-md-3">
              <div>
                <small>
                  <a href="index.php" class="text-decoration-none">Masuk Web</a>
                </small>
              </div>
            </div>
          </div>
        </div>
        <div class="copy">
          &copy; BilSchool
        </div>
      </div>
    </div>
  </footer>

  <!-- script -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>