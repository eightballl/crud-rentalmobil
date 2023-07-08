<?php
  // cek kehadiran session name
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }

  // buka koneksi dengan MySQL
  include("koneksi.php");

  // cek form submit
  if (isset($_POST["submit"])) {

    if ($_POST["submit"]=="Edit") {
      //nilai form berasal dari edit.php

      // ambil nilai ID Mobil
      $id_admin = htmlentities(strip_tags(trim($_POST["id_admin"])));
      // filter data
      $id_admin = mysqli_real_escape_string($link,$id_admin);

      // ambil data dari database untuk menjadi nilai form
      $query = "SELECT * FROM admin WHERE id_admin='$id_admin'";
      $result = mysqli_query($link, $query);

      if(!$result){
        die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
      }

      $data = mysqli_fetch_assoc($result);

      $username       = $data["username"];
      $password        = $data["password"];
      $nama_admin          = $data["nama_admin"];
      $email        = $data["email"];

    // bebaskan memory
    mysqli_free_result($result);
    }

    else if ($_POST["submit"]=="Edit Data") {
      // nilai form berasal dari halaman
      $id_admin          = htmlentities(strip_tags(trim($_POST["id_admin"])));
      $username       = htmlentities(strip_tags(trim($_POST["username"])));
      $password        = htmlentities(strip_tags(trim($_POST["password"])));
      $nama_admin          = htmlentities(strip_tags(trim($_POST["nama_admin"])));
      $email        = htmlentities(strip_tags(trim($_POST["email"])));
    }

    // variabel untuk menampung error
    $error="";

    // cek apakah Password sudah diisi atau belum
    if (empty($password)) {
      $error .= "Password harus diisi <br>";
    }

    // cek apakah Nama sudah diisi atau belum
    if (empty($nama_admin)) {
      $error .= "Nama belum diisi <br>";
    }

    // cek apakah Email sudah diisi atau belum
    if (empty($email)) {
      $error .= "Email belum diisi <br>";
    }

    // jika tidak ada error, input ke database
    if (($error === "") AND ($_POST["submit"]=="Edit Data")) {

      // buka koneksi dengan MySQL
      include("koneksi.php");

      // filter semua data
      $id_admin          = mysqli_real_escape_string($link,$id_admin);
      $username       = mysqli_real_escape_string($link,$username);
      $password        = mysqli_real_escape_string($link,$password);
      $nama_admin          = mysqli_real_escape_string($link,$nama_admin);
      $email        = mysqli_real_escape_string($link,$email);

      //enkripsi data

     $password_sha1 =  sha1($password);

      //buat dan jalankan query UPDATE
      $query  = "UPDATE admin  SET ";
      $query .= "username = '$username', password = '$password_sha1', ";
      $query .= "nama_admin = '$nama_admin', email = '$email' ";
      $query .= "WHERE id_admin = $id_admin";

      $result = mysqli_query($link, $query);

      //periksa hasil query
      if($result) {
      // INSERT berhasil
        $pesan = "Akun \"<b>$username</b>\" berhasil di edit";
        $pesan = urlencode($pesan);
        header("Location: profil.php?pesan={$pesan}");
      }
      else {
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
      }
    }
  }
  else {
    // redirect ke profil.php
    header("Location: profil.php");
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
      <img src="profil.jpg" alt="profil" width="100" class="profil rounded-circle img-thumbnail" />
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
    <div class="container pb-5 mb-5">
      <center>
        <?php
          // tampilkan error jika ada
          if ($error !== "") {
              echo "<div class=\"error\">$error</div>";
          }
        ?>
      </center>
      <div class="card">
        <div class="card-body">
          <form name="form" class="form pb-3" action="edit-profil.php" method="post">
            <div class="mb-3">
              <label for="id_admin" class="form-label visually-hidden">ID Admin</label>
              <input type="text" class="form-control visually-hidden" name="id_admin" id="id_admin" aria-describedby="id_admin" value="<?php echo $id_admin ?>" readonly/>
            </div>  
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" id="username" aria-describedby="username" value="<?php echo $username ?>" readonly/>
            </div>  
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" aria-describedby="password" value=""/>
            </div>  
            <div class="mb-3">
              <label for="nama_admin" class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama_admin" id="nama_admin"  value="<?= $nama_admin ?>" aria-describedby="nama_admin"/> 
            </div>  
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" id="email" aria-describedby="email" value="<?php echo $email ?>"/>
            </div>  
            <button class="btn btn-success" type="submit" name="submit" id="submit" value="Edit Data"><i class="bi bi-pencil-square"></i> Edit Data</button>
            <a href="profil.php" class="btn btn-warning"><i class="bi bi-x-circle"></i> Batal</a>
          </form>
        </div>
      </div>
    </div>
    <!-- Akhir Boddy -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
