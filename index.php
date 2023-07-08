<?php
  // buka koneksi dengan MySQL
     include("koneksi.php");
  
  // ambil pesan jika ada  
  if (isset($_GET["pesan"])) {
    $pesan = $_GET["pesan"];
  }

  // cek apakah form telah di submit
  // siapkan query 
  if (isset($_GET["submit"])) {
      
    // ambil nilai Merek hp
    $mobil = htmlentities(strip_tags(trim($_GET["mobil"])));
    
    // filter untuk $nama untuk mencegah sql injection
    $mobil = mysqli_real_escape_string($link,$mobil);
    
    // buat query pencarian
    $query  = "SELECT * FROM data WHERE mobil LIKE '%$mobil%' ";
    $query .= "ORDER BY mobil ASC";
    
    // buat pesan
    $pesan = "Hasil pencarian untuk Merek HP <b>\"$mobil\" </b>";
  } 
  else {
  // bukan dari form pencairan
  // siapkan query untuk menampilkan seluruh data dari tabel
    $query = "SELECT * FROM data ORDER BY id_mobil ASC";
  }
?>
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

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

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
              <a class="nav-link" href="#mobil">Mobil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pesan">Pesan</a>
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
        <div class="row text-center mb-4">
          <div class="col">
          <h1>Rental Mobil Murah Untuk Setiap Kebutuhan</h1>
          <img src="logo.png" class="rounded float-center" alt="logo" width="150">
          </div>
        </div>
        <div class="row justify-content-center fs-5">
          <div class="col-md-5">
            <p align="justify">
              Rental Mobil Kacangan menyediakan jasa sewa mobil Premium yang sudah mendapatkan kepercayaan di Kacangan.
              Untuk memberikan layanan terbaik serta mempertahankan kepercayaan pelanggan, kami hanya menyediakan armada mobil terbaru,
              bersih bebas virus penyakit serta memberikan kenyamanan.
            </p>
          </div>
          <div class="col-md-5">
            <p align="justify">
              Sewa Mobil di Rental Mobil Kacangan merupakan Perusahaan Rental Mobil Mewah yang telah mengantongi izin resmi, 
              sehingga anda akan merasa lebih tenang dan aman menggunakan jasa kami. 
              Kami telah dipercaya oleh pelanggan corporate dan bisa mengeluarkan faktur pajak untuk konsumen 
              dari perusahaan swasta ataupun instansi pemerintah.
            </p>
          </div>
        </div>
      </div>\
    </section>
    <!-- Awal -->

    <!-- Mobil -->
    <section id="mobil">
      <div class="container">
        <div class="row text-center mb-4">
          <div class="col">
            <h2>Daftar Mobil</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="avanza.jpg" class="card-img-top p-2" alt="img1" />
              <div class="card-body text-center">
                <h5 class="card-title">Avanza</h5>
                <p>Tarif Rp.200.000/hari</p>
                <p>Spesifikasi</p>
                <p align="justify">1. <i class="bi bi-bar-chart-fill"></i> Fuel</p>
                <p align="justify">2. <i class="bi bi-battery-charging"></i> Charger</p>
                <p align="justify">3. <i class="bi bi-play-btn"></i> Musik</p>
                <p align="justify">4. <i class="bi bi-fan"></i> AC</p>
                <br>
                <a href="avanza.php" class="btn btn-primary mt-2">Lihat Galeri</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3 ">
            <div class="card">
              <img src="xenia.jpg" class="card-img-top" alt="img1" />
              <div class="card-body text-center">
                <h5 class="card-title">Xenia</h5>
                <p>Tarif Rp.200.000/hari</p>
                <p>Spesifikasi</p>
                <p align="justify">1. <i class="bi bi-bar-chart-fill"></i> Fuel</p>
                <p align="justify">2. <i class="bi bi-file-medical"></i> P3K</p>
                <p align="justify">3. <i class="bi bi-battery-charging"></i> Charger</p>
                <p align="justify">4. <i class="bi bi-play-btn"></i> Musik</p>
                <p align="justify">5. <i class="bi bi-fan"></i> AC</p>
                <a href="xenia.php" class="btn btn-primary">Lihat Galeri</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="fortuner.jpg" class="card-img-top" alt="img1" />
              <div class="card-body text-center">
                <h5 class="card-title">Fortuner</h5>
                <p>Tarif Rp.200.000/hari</p>
                <p>Spesifikasi</p>
                <p align="justify">1. <i class="bi bi-battery-charging"></i> Charger</p>
                <p align="justify">2. <i class="bi bi-play-btn"></i> Musik</p>
                <p align="justify">3. <i class="bi bi-fan"></i> AC</p>
                <br><br><br>
                <a href="fortuner.php" class="btn btn-primary mt-2">Lihat Galeri</a>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Mobil -->

    <!-- Pesan -->
    <section id="pesan">
      <div class="container mb-5 pb-5">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="card">
              <div class="card-body">
              <center>
        <?php
            // tampilkan pesan jika ada
            if (isset($pesan)) {
                echo "<div class=\"pesan\">$pesan</div>";
             }
        ?>
        </center>
                <h5 class="card-title">Minat?</h5>
                <p class="card-text">Isi form dibawah sini.</p>
                <a href="pesan.php" class="btn btn-primary">Isi Form Disini</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
    <!-- Pesan -->

    <!-- Footer -->
    <footer class="bg-success text-light text-center fixed-bottom">
      <p>2021. <i class="bi bi-bicycle"></i> <a href="" class="text-light fw-bold">Rental</a></p>
    </footer>
    <!-- Akhir Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
