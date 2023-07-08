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

      // ambil nilai ID mobil
      $id_mobil = htmlentities(strip_tags(trim($_POST["id_mobil"])));
      // filter data
      $id_mobil = mysqli_real_escape_string($link,$id_mobil);

      // ambil data dari database untuk menjadi nilai form
      $query = "SELECT * FROM data WHERE id_mobil='$id_mobil'";
      $result = mysqli_query($link, $query);

      if(!$result){
        die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
      }

      $data = mysqli_fetch_assoc($result);

      $mobil       = $data["mobil"];
      $nama        = $data["nama"];
      $tanggal          = $data["tanggal"];
      $telat        = $data["telat"];
      $denda  = $data["denda"];
      $total          = $data["total"];
      $bayar          = $data["bayar"];
      $no          = $data["no"];
      $alamat          = $data["alamat"];
      $keterangan          = $data["keterangan"];
      $status          = $data["status"];

    // bebaskan memory
    mysqli_free_result($result);
    }

    else if ($_POST["submit"]=="Edit Data") {
      // nilai form berasal dari halaman
      $id_mobil          = htmlentities(strip_tags(trim($_POST["id_mobil"])));
      $mobil       = htmlentities(strip_tags(trim($_POST["mobil"])));
      $nama        = htmlentities(strip_tags(trim($_POST["nama"])));
      $tanggal          = htmlentities(strip_tags(trim($_POST["tanggal"])));
      $telat        = htmlentities(strip_tags(trim($_POST["telat"])));
      $denda  = htmlentities(strip_tags(trim($_POST["denda"])));
      $total          = htmlentities(strip_tags(trim($_POST["total"])));
      $bayar          = htmlentities(strip_tags(trim($_POST["bayar"])));
      $no            = htmlentities(strip_tags(trim($_POST["no"])));
      $alamat            = htmlentities(strip_tags(trim($_POST["alamat"])));
      $keterangan            = htmlentities(strip_tags(trim($_POST["keterangan"])));
      $status            = htmlentities(strip_tags(trim($_POST["status"])));
    }

    // variabel untuk menampung error
    $error="";

    // cek apakah ID Mobil sudah diisi atau belum
    if (empty($id_mobil)) {
      $error .= "ID Sewa belum diisi <br>";
    }

    // cek apakah Nama sudah diisi atau belum
    if (empty($nama)) {
      $error .= "Nama belum diisi <br>";
    }

    // cek apakah Tanggal sudah diisi atau belum
    if (empty($tanggal)) {
      $error .= "Tanggal belum dipilih <br>";
    }

    // cek apakah Total Sewa sudah diisi atau belum
    if (empty($total)) {
      $error .= "Total belum diisi <br>";
    }

    // cek apakah Total Bayar sudah diisi atau belum
    if (empty($bayar)) {
      $error .= "Total Bayar belum diisi <br>";
    }

    // cek apakah Email sudah diisi atau belum
    if (empty($no)) {
      $error .= "No. HP belum diisi <br>";
    }

    // cek apakah Email sudah diisi atau belum
    if (empty($alamat)) {
      $error .= "Alamat belum diisi <br>";
    }

    // cek apakah Email sudah diisi atau belum
    if (empty($keterangan)) {
      $error .= "Keterangan belum diisi <br>";
    }

    // siapkan variabel pilihan
    $select_avanza=""; $select_xenia=""; $select_fortuner="";

    switch($mobil) {
     case "Avanza" : $select_avanza = "selected";  break;
     case "Xenia"  : $select_xenia  = "selected";  break;
     case "Fortuner"  : $select_fortuner  = "selected";  break;
    }

    // siapkan variabel pilihan
    $select_belum=""; $select_dibayar="";

    switch($status) {
     case "Belum Dibayar" : $select_belum = "selected";  break;
     case "Dibayar"  : $select_dibayar  = "selected";  break;
    }

    // jika tidak ada error, input ke database
    if (($error === "") AND ($_POST["submit"]=="Edit Data")) {

      // buka koneksi dengan MySQL
      include("koneksi.php");

      // filter semua data
      $id_mobil          = mysqli_real_escape_string($link,$id_mobil);
      $mobil       = mysqli_real_escape_string($link,$mobil);
      $nama        = mysqli_real_escape_string($link,$nama);
      $tanggal          = mysqli_real_escape_string($link,$tanggal);
      $telat        = mysqli_real_escape_string($link,$telat);
      $denda        = mysqli_real_escape_string($link,$denda);
      $total        = mysqli_real_escape_string($link,$total);
      $bayar        = mysqli_real_escape_string($link,$bayar);
      $no  = mysqli_real_escape_string($link,$no);
      $alamat          = mysqli_real_escape_string($link,$alamat);
      $keterangan            = mysqli_real_escape_string($link,$keterangan);
      $status            = mysqli_real_escape_string($link,$status);

      //buat dan jalankan query UPDATE
      $query  = "UPDATE data SET ";
      $query .= "mobil = '$mobil', nama = '$nama', ";
      $query .= "tanggal = '$tanggal', telat='$telat', ";
      $query .= "denda = '$denda', total = '$total', bayar = '$bayar', no = '$no', alamat = '$alamat', keterangan = '$keterangan', status = '$status' ";
      $query .= "WHERE id_mobil = '$id_mobil'";

      $result = mysqli_query($link, $query);

      //periksa hasil query
      if($result) {
      // INSERT berhasil
        $pesan = "ID Sewa \"<b>$id_mobil</b>\" berhasil di edit";
        $pesan = urlencode($pesan);
        header("Location: index.php?pesan={$pesan}");
      }
      else {
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
      }
    }
  }
  else {
    // redirect ke edit.php
    header("Location: edit.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="logo.png" />
    <link rel="stylesheet" href="style.css" />

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
            <a href="profil.php" class="nav-link active">
              <i class="bi bi-person-circle"><br />Profil</i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Akhir Navbar Bawah -->

    <!-- Body -->
    <div class="container mt-5 pt-3 mb-5 pb-3">
      <center>
      <?php
        // tampilkan error jika ada
        if ($error !== "") {
            echo "<div class=\"error\">$error</div>";
        }
      ?>
      </center>
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link active" aria-current="true" href="">Update</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="hapus.php">Hapus</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <form name="form" class="form pb-3" action="edit-data.php" method="post">
              <div class="mb-3">
              <label for="id_mobil" class="form-label">ID Sewa</label>
              <input type="text" class="form-control" name="id_mobil" id="id_mobil" aria-describedby="id_mobil" value="<?php echo $id_mobil ?>" readonly/>
            </div>  
              <div class="mb-3">
              <label for="mobil" class="form-label">Pilih Mobil</label>
              <select class="form-select" aria-label="mobil" id="mobil" name="mobil">
                <option value="Avanza" <?php echo $select_avanza ?> selected>Avanza</option>
                <option value="Fortuner" <?php echo $select_fortuner ?>>Fortuner</option>
                <option value="Xenia" <?php echo $select_xenia ?>>Xenia</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Penyewa</label>
              <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" value="<?php echo $nama ?>"/>
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal Sewa</label>
              <input type="date" class="form-control" name="tanggal" id="tanggal" aria-describedby="tanggal" value="<?php echo $tanggal ?>"/>
            </div>
            <div class="mb-3">
              <label for="total" class="form-label">Total Harga Sewa</label>
              <input type="number" class="form-control" name="total" id="total" aria-describedby="total" value="<?php echo $total ?>" onchange="change(this.value)"/>
            </div>
            <div class="mb-3">
            <label for="telat" class="form-label">Telat Pembembalian (hari)</label>
            <input type="number" class="form-control" name="telat" id="telat" aria-describedby="telat" value="<?php echo $telat ?>" onchange="change(this.value)"/>
          </div>
            <div class="mb-3">
              <label for="total" class="form-label">Total Denda</label>
              <input type="number" class="form-control" name="denda" id="denda" aria-describedby="denda" value="<?php echo $denda ?>"/>
            </div>
            <div class="mb-3">
              <label for="total" class="form-label">Total Bayar</label>
              <input type="number" class="form-control" name="bayar" id="bayar" aria-describedby="bayar" value="<?php echo $bayar ?>"/>
            </div>
            <div class="mb-3">
              <label for="no" class="form-label">No. Telepon</label>
              <input type="number" class="form-control" name="no" id="no" aria-describedby="no" value="<?php echo $no ?>"/>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat" rows="3"><?php echo $alamat ?></textarea>
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea class="form-control" name="keterangan" id="keterangan" rows="3"><?php echo $keterangan ?></textarea>
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" aria-label="status" id="status" name="status">
                <option value="Dibayar" <?php echo $select_dibayar ?>>Dibayar</option>
                <option value="Belum Dibayar" <?php echo $select_belum ?>>Belum Dibayar</option>
              </select>
            </div>
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Edit Data">
          </form>
        </div>
      </div>
    </div>
    <!-- Akhir Boddy -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function change(){
            var tlt = document.getElementById("telat").value;
            var total = document.getElementById("total").value;
            tlt = parseInt(tlt);
            total = parseInt(total);
            var telat = tlt * 150000;
            var bayar = tlt * 150000 + total;
            document.getElementById("denda").value = telat;
            document.getElementById("bayar").value = bayar;


        }
    </script>
  </body>
</html>
