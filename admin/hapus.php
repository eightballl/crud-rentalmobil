<?php
  // cek kehadiran session name
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }

  // buka koneksi dengan MySQL
  include("koneksi.php");

  // form telah di submit (untuk menghapus data)
  if (isset($_POST["submit"])) {
    // form telah disubmit, proses data

    // ambil nilai
    $id_mobil = htmlentities(strip_tags(trim($_POST["id_mobil"])));
    // filter data
    $id_mobil = mysqli_real_escape_string($link,$id_mobil);

    //jalankan query DELETE
    $query = "DELETE FROM data WHERE id_mobil='$id_mobil' ";
    $hasil_query = mysqli_query($link, $query);

    //periksa query, tampilkan pesan kesalahan jika gagal
    if($hasil_query) {
        // DELETE berhasil, redirect ke index.php + pesan
          $pesan = "ID Sewa \"<b>$id_mobil</b>\" berhasil di hapus";
        $pesan = urlencode($pesan);
          header("Location: index.php?pesan={$pesan}");
      }
      else {
        die ("Query gagal dijalankan: ".mysqli_errno($link).
             " - ".mysqli_error($link));
      }
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
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link" aria-current="true" href="edit.php">Update</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="">Hapus</a>
            </li>
          </ul>
        </div>
        <div class="card-body table-responsive">
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
                    // buat query untuk menampilkan data tabel
                    $query = "SELECT * FROM data ORDER BY id_mobil ASC";
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
                        echo "<td>";
                        ?>
                        <form action="hapus.php" method="post" >
                        <input type="hidden" name="id_mobil" value="<?php echo "$data[id_mobil]"; ?>" >
                        <button class="btn btn-success" id="sub" type="submit" name="submit" value="Hapus" ><i class="bi bi-trash"></i></button>
                        </form>
                        <?php
                        echo "</td>";
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
    </div>
    <!-- Akhir Boddy -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
