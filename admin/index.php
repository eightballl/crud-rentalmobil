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

  // cek apakah form telah di submit
  // siapkan query 
  if (isset($_GET["submit"])) {
      
    // ambil nilai Mobil
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
            <a href="" class="nav-link active">
              <i class="bi bi-house-fill"><br />Home</i>
            </a>
          </li>
          <li class="nav-item">
            <a href="tambah.php" class="nav-link">
              <i class="bi bi-plus-square"><br />Tambah</i>
            </a>
          </li>
          <li class="nav-item">
            <a href="profil.php" class="nav-link">
              <i class="bi bi-person-circle"><br />Profil</i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Akhir Navbar Bawah -->

    <!-- Body -->
    <div class="container mt-5 pt-3 mb-5 pb-5">
      <div class="row mb-3">
        <div class="col-12 text-center">
          <h1>Rental Mobil Kacangan</h1>
        </div>
        <center>
        <?php
            // tampilkan pesan jika ada
            if (isset($pesan)) {
                echo "<div class=\"pesan\">$pesan</div>";
             }
        ?>
        </center>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead>
            <tr>
              <td>No.</td>
              <td>Mobil</td>
              <td>Nama</td>
              <td>No. HP</td>
              <td>Tanggal Sewa</td>
              <td>Lama</td>
              <td>Harga</td>
              <td>Total</td>
              <td>Telat</td>
              <td>Denda</td>
              <td>Total Bayar</td>
              <td>Status</td>
            </tr>
          </thead>
          <tbody>
          <?php
            // jalankan query
            $result = mysqli_query($link, $query);
            
            if(!$result){
                die ("Query Error: ".mysqli_errno($link).
                    " - ".mysqli_error($link));
            }
            
            //buat perulangan untuk tabel dari data
            while($data = mysqli_fetch_assoc($result))
            { 
                // konversi date MySQL (yyyy-mm-dd) menjadi dd-mm-yyyy
                $tanggal = strtotime($data["tanggal"]);
                $tanggal = date("d - m - Y", $tanggal);
                
                echo "<tr>";
                echo "<td>$data[id_mobil]</td>";
                echo "<td>$data[mobil]</td>";
                echo "<td>$data[nama]</td>";
                echo "<td>$data[no]</td>";
                echo "<td>$tanggal</td>";
                echo "<td>$data[lama]</td>";
                echo "<td>$data[harga]</td>";
                echo "<td>$data[total]</td>";
                echo "<td>$data[telat]</td>";
                echo "<td>$data[denda]</td>";
                echo "<td>$data[bayar]</td>";
                echo "<td>$data[status]</td>";
                echo "</tr>";
            }
            
            // bebaskan memory 
            mysqli_free_result($result);
            
            // tutup koneksi dengan database mysql
            mysqli_close($link);
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Akhir Boddy -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
