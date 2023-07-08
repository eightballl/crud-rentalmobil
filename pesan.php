<?php
  // buka koneksi dengan MySQL
  include("koneksi.php");

  // cek apakah form telah di submit
  if (isset($_POST["submit"])) {
    // form telah disubmit, proses data

    // ambil semua nilai form
    $id_mobil          = htmlentities(strip_tags(trim($_POST["id_mobil"])));
    $mobil       = htmlentities(strip_tags(trim($_POST["mobil"])));
    $nama        = htmlentities(strip_tags(trim($_POST["nama"])));
    $tanggal          = htmlentities(strip_tags(trim($_POST["tanggal"])));
    $lama        = htmlentities(strip_tags(trim($_POST["lama"])));
    $harga        = htmlentities(strip_tags(trim($_POST["harga"])));
    $telat        = htmlentities(strip_tags(trim($_POST["telat"])));
    $denda  = htmlentities(strip_tags(trim($_POST["denda"])));
    $total          = htmlentities(strip_tags(trim($_POST["total"])));
    $bayar          = htmlentities(strip_tags(trim($_POST["bayar"])));
    $no  = htmlentities(strip_tags(trim($_POST["no"])));
    $alamat          = htmlentities(strip_tags(trim($_POST["alamat"])));
    $keterangan            = htmlentities(strip_tags(trim($_POST["keterangan"])));
    $status            = htmlentities(strip_tags(trim($_POST["status"])));

    // siapkan variabel untuk menampung pesan error
    $error="";

    // cek apakah ID mobil sudah diisi atau belum
    if (empty($id_mobil)) {
      $error .= "ID Sewa belum diisi <br>";
    }

    // filter ID mobil
    $id_mobil = mysqli_real_escape_string($link,$id_mobil);
    $query = "SELECT * FROM data WHERE id_mobil='$id_mobil'";
    $hasil_query = mysqli_query($link, $query);

    // cek jumlah record (baris), jika ada, ID mobil tidak bisa diproses
    $jumlah_data = mysqli_num_rows($hasil_query);
     if ($jumlah_data >= 1 ) {
       $error .= "ID Sewa sudah digunakan <br>";
    }

    // cek apakah Nama sudah diisi atau belum
    if (empty($nama)) {
      $error .= "Nama belum diisi <br>";
    }

    // cek apakah Tanggal sudah diisi atau belum
    if (empty($tanggal)) {
      $error .= "Tanggal belum diisi <br>";
    }

    // cek apakah Lama sewa sudah diisi atau belum
    if (empty($lama)) {
      $error .= "Lama Sewa belum diisi <br>";
    }

    // cek apakah Harga sudah diisi atau belum
    if (empty($harga)) {
      $error .= "Harga belum diisi <br>";
    }

    // cek apakah Total sudah diisi atau belum
    if (empty($total)) {
      $error .= "Total belum diisi <br>";
    }

    // cek apakah No HP sudah diisi atau belum
    if (empty($no)) {
      $error .= "No. Hp belum diisi <br>";
    }

    // cek apakah Alamat sudah diisi atau belum
    if (empty($alamat)) {
      $error .= "Alamat belum diisi <br>";
    }

    // cek apakah Keterangan sudah diisi atau belum
    if (empty($keterangan)) {
      $error .= "Keterangan belum diisi <br>";
    }

    // siapkan variabel pilihan Dibayar
    $select_belum=""; $select_dibayar="";

    switch($status) {
     case "Belum Dibayar" : $select_belum = "selected";  break;
     case "Dibayar"  : $select_dibayar  = "selected";  break;
    }

    // jika tidak ada error, input ke database
    if ($error === "") {

      // filter semua data
      $id_mobil          = mysqli_real_escape_string($link,$id_mobil);
      $mobil       = mysqli_real_escape_string($link,$mobil);
      $nama        = mysqli_real_escape_string($link,$nama);
      $tanggal          = mysqli_real_escape_string($link,$tanggal);
      $lama        = mysqli_real_escape_string($link,$lama);
      $harga        = mysqli_real_escape_string($link,$harga);
      $telat        = mysqli_real_escape_string($link,$telat);
      $denda        = mysqli_real_escape_string($link,$denda);
      $total        = mysqli_real_escape_string($link,$total);
      $bayar        = mysqli_real_escape_string($link,$bayar);
      $no  = mysqli_real_escape_string($link,$no);
      $alamat          = mysqli_real_escape_string($link,$alamat);
      $keterangan            = mysqli_real_escape_string($link,$keterangan);
      $status            = mysqli_real_escape_string($link,$status);

      //buat dan jalankan query INSERT
      $query = "INSERT INTO data VALUES ";
      $query .= "('$id_mobil', '$mobil', '$nama', ";
      $query .= "'$tanggal', '$lama', '$harga', '$total', '$no', '$alamat', '$keterangan', '$telat', '$denda', '$bayar', '$status')";

      $result = mysqli_query($link, $query);

      //periksa hasil query
      if($result) {
        // INSERT berhasil, redirect ke data.php + pesan
          $pesan  = "Pesanan Anda dengan ID \"<b>$id_mobil</b>\" berhasil kami terima. <br>Tunggu pesan dari kami selanjutnya. ";
          $pesan  = urlencode($pesan);
          header("Location: index.php?pesan={$pesan}#pesan");
        }
      else {
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
      }
    }
  }
  else {
    // form belum disubmit atau halaman ini tampil untuk pertama kali
    // berikan nilai awal untuk semua isian form
    $error    = "";
    $id_mobil          = "";
    $select_avanza = "selected";
    $select_xenia  = "";
    $select_fortuner  = "";
    $nama        = "";
    $tanggal        = "";
    $lama  = "";
    $harga  = "";
    $total  = "";
    $telat  = "";
    $denda  = "";
    $bayar  = "";
    $alamat          = "";
    $keterangan          = "";
    $select_belum = "selected";
    $select_dibayar  = "";
  }

  $id_mobil = base_convert(microtime(false), 3, 10);
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
      body {
        background: #e2edff;
      }
      .error {
            background: #FFECEC;
            border-radius: 21px;
            box-shadow: 1px 0px 3px red ;
            font-family: "Courier";
            margin-top: 10px;
            margin-bottom: 10px;
            transition: 0.25s;
            width: 100%;
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

    <!-- Body -->
    <div class="container mt-5 pt-3 mb-5 pb-5">
      <div class="row mb-3">
        <div class="col-12 text-center">
          <h1>Isi Form Dibawah ini</h1>
          <center>
            <?php
              // tampilkan error jika ada
                if ($error !== "") {
                    echo "<div class=\"error\">$error</div>";
                }
            ?>
          </center>
        </div>
        <form name="form" class="form" action="pesan.php" method="post">
            <div class="mb-3">
            <label for="id_mobil" class="form-label visually-hidden">ID Sewa</label>
            <input type="text" class="form-control visually-hidden" name="id_mobil" id="id" aria-describedby="id_mobil" value="<?php echo $id_mobil ?>" readonly/>
          </div>  
            <div class="mb-3">
            <label for="mobil" class="form-label">Pilih Mobil</label>
            <?php
                $query = "SELECT * FROM tb_mobil";
                $result = mysqli_query($link, $query);
                $jsArray = "var IdMobil = new Array();\n";
                echo '
              <select class="form-select" name="mobil" onchange="document.getElementById(\'id_mobil\').value = IdMobil[this.value]">
              <option>Pilih Mobil</option>';
                while ($row = mysqli_fetch_array($result)) {
              echo '
              <option value="' . $row['mobil'] . '">' . $row['mobil'] . '</option>';
              $jsArray .= "IdMobil['" . $row['mobil'] . "'] = '" . addslashes($row['harga']) . "';\n";
                }
                echo '
                </select>';
            ?>
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
            <label for="lama" class="form-label">Lama Sewa (hari)</label>
            <input type="number" class="form-control" name="lama" id="lama" aria-describedby="lama" value="<?php echo $lama ?>" onchange="change(this.value)"/>
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" name="harga" id="id_mobil" aria-describedby="harga" readonly/>
            <script type="text/javascript">
            <?php echo $jsArray; ?>
            </script> 
          </div>
          <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" name="total" id="total" aria-describedby="total" value="<?php echo $total ?>" readonly/>
          </div>
          <div class="mb-3">
            <label for="telat" class="form-label visually-hidden">Telat</label>
            <input type="number" class="form-control visually-hidden" name="telat" id="telat" aria-describedby="telat" value="<?php echo $telat ?>"/>
          </div>
          <div class="mb-3">
            <label for="denda" class="form-label visually-hidden">Denda</label>
            <input type="number" class="form-control visually-hidden" name="denda" id="denda" aria-describedby="denda" value="<?php echo $denda ?>"/>
          </div>
          <div class="mb-3">
            <label for="bayar" class="form-label visually-hidden">Total Bayar</label>
            <input type="number" class="form-control visually-hidden" name="bayar" id="bayar" aria-describedby="bayar" value="<?php echo $bayar ?>"/>
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
            <label for="status" class="form-label visually-hidden">Status</label>
            <select class="form-select visually-hidden" aria-label="status" id="status" name="status">
              <option value="Dibayar" <?php echo $select_dibayar ?>>Dibayar</option>
              <option value="Belum Dibayar" <?php echo $select_belum ?> selected>Belum Dibayar</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-kirim" name="submit" id="submit">Sewa</button>
        </form>
      </div>
    </div>
    <!-- Akhir Boddy -->

    <!-- Footer -->
     <footer class="bg-success text-light text-center fixed-bottom">
      <p>2021. <i class="bi bi-bicycle"></i> <a href="index.php" class="text-light fw-bold">Rental</a></p>
    </footer>
    <!-- Akhir Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function change(){
            var hrg = document.getElementById("id_mobil").value;
            var jml = document.getElementById("lama").value;
            hrg = parseInt(hrg);
            jml = parseInt(jml);
            var ttl = hrg * jml;
            document.getElementById("total").value = ttl;
            
        }
    </script>
  </body>
</html>
