<?php
  // cek kehadiran session name
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }

  // buka koneksi dengan MySQL
  include("koneksi.php");

  // ambil pesan jika ada  
  if (isset($_GET["pesan"])) {
    $pesan = $_GET["pesan"];
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

    <!-- My CSS -->
    <style>
      .pesan {
        background: #c0ffa9;
        border-radius: 21px;
        box-shadow: 0px 1px 8px #24c64f;
        font-family: "Courier";
        margin-bottom: 10px;
        transition: 0.25s;
        width: 70%;
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
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="logout.php" onclick="return confirm('Yakin keluar?')"><i class="bi bi-box-arrow-right"></i> Keluar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Navbar Bawah -->
    <nav class="navbar navbar-expand navbar-dark bg-success fixed-bottom">
      <div class="container">
        <ul class="navbar-nav nav-justified w-100">
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="bi bi-house-fill"><br />Home</i>
            </a>
          </li>
          <li class="nav-item">
            <a href="tambah.php" class="nav-link">
              <i class="bi bi-plus-square"><br />Tambah</i>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link active">
              <i class="bi bi-person-circle"><br />Profil</i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Akhir Navbar Bawah -->

    <!-- Profil -->
    <section class="jumbotron text-center mt-5 pt-3 mb-5">
        <center>
        <?php
            // tampilkan pesan jika ada
            if (isset($pesan)) {
                echo "<div class=\"pesan\">$pesan</div>";
             }
        ?>
        </center>
      <img src="profil.jpg" alt="profil" width="150" class="profil rounded-circle img-thumbnail" />
          <?php
            // buat query untuk menampilkan data tabel
            $query = "SELECT * FROM admin ORDER BY id_admin ASC";
            $result = mysqli_query($link, $query);

            if($data = mysqli_fetch_assoc($result)) {   
                echo "<h3>$data[nama_admin]</h3>";
            }
          ?>
    </section>
    <!-- Akhir Profil -->

    <!-- Body -->
    <div class="container text-center">
      <div class="row">
        <div class="col-12 pb-3">
          <form action="edit-profil.php" method="post" >
            <input type="hidden" name="id_admin" value="<?php echo "$data[id_admin]"; ?>" >
            <button class="btn btn-success" id="sub" type="submit" name="submit" value="Edit" ><i class="bi bi-pencil-square"></i> Update Akun</button>
          </form>
        </div>
        <div class="col-12 pb-3">
          <h3>
            <a href="edit.php" class="btn btn-success"><i class="bi bi-pencil-square"></i> Update Data</a>
          </h3>
        </div>
        <div class="col-12">
          <h3>
            <a href="logout.php" class="btn btn-success" onclick="return confirm('Yakin keluar?')"><i class="bi bi-box-arrow-right"></i> Keluar</a>
          </h3>
        </div>
      </div>
    </div>
    <!-- Akhir Boddy -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
