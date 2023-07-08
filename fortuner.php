<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="logo.png" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- My CSS -->
    <style>
      body {
        background: #e2edff;
      }
      section {
        padding-top: 4rem;
      }
      .pesan {
        background: #c0ffa9;
        border-radius: 5px;
        box-shadow: 0px 1px 8px #24c64f;
        font-family: "Courier";
        margin-bottom: 10px;
        transition: 0.25s;
        width: 100%;
        text-align: center;
      }
    </style>
    <title>Rental Mobil Kacangan</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow fixed-top">
      <div class="container">
      <a class="navbar-brand" href=""> <img src="logo.png" alt="" width="40" height="30" /> Rental Mobil Kacangan </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#mobil">Mobil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#pesan">Pesan</a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Awal -->
    <section id="home">
      <div class="container">
        <div class="row text-center">
          <div class="col">
          <h1>Mobil Fortuner</h1>
          <p>
          Rental Mobil Kacangan menyediakan Sewa Mobil Fortuner dengan varian terlengkap di Kacangan. 
          Toyota Fortuner sangat diminati oleh masyarakat khususnya di Kacangan. 
          Fortuner menawarkan kenyamanan yang luar biasa, sangat cocok untuk perjalanan jauh namun dengan harga yang terjangkau.
          </p>
          </div>
        </div>
      </div>
    </section>
    <!-- Awal -->

    <!-- Mobil -->
    <section id="mobil">
      <div class="container mb-5 pb-5">
        <div class="row text-center mb-4">
          <div class="col">
            <h2>Foto - Foto Fortuner</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <img src="fortuner/1.jpg" class="img-thumbnail" alt="1">
          </div>
          <div class="col-md-4 mb-3">
            <img src="fortuner/2.jpg" class="img-thumbnail" alt="2">
          </div>
          <div class="col-md-4 mb-3">
            <img src="fortuner/3.jpg" class="img-thumbnail" alt="2">
          </div>
          <div class="col-md-6 mb-3">
            <img src="fortuner/4.jpg" class="img-thumbnail" alt="4">
          </div>
          <div class="col-md-6 mb-3">
            <img src="fortuner/5.jpg" class="img-thumbnail" alt="5">
          </div>
        </div>
      </div>
    </section>
    <!-- Mobil -->

    <!-- Footer -->
    <footer class="bg-success text-light text-center fixed-bottom">
      <p>2021. <i class="bi bi-bicycle"></i> <a href="index.php" class="text-light fw-bold">Rental</a></p>
    </footer>
    <!-- Akhir Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
