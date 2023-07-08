<?php

  // ambil pesan jika ada
  if (isset($_GET["pesan"])) {
      $pesan = $_GET["pesan"];
  }

  // cek apakah form telah di submit
  if (isset($_POST["submit"])) {
    // form telah disubmit, proses data

    // ambil nilai form
    $username = htmlentities(strip_tags(trim($_POST["username"])));
    $password = htmlentities(strip_tags(trim($_POST["password"])));

    // siapkan variabel untuk menampung pesan error
    $error="";

    // cek apakah "username" sudah diisi atau belum
    if (empty($username)) {
      $error .= "Username harap diisi <br>";
    }

    // cek apakah "password" sudah diisi atau belum
    if (empty($password)) {
      $error .= "Password harap diisi <br>";
    }

    // buat koneksi ke mysql
    include("koneksi.php");

    // filter dengan mysqli_real_escape_string
    $username = mysqli_real_escape_string($link,$username);
    $password = mysqli_real_escape_string($link,$password);

    // generate hashing
    $password_sha1 = sha1($password);

    // cek apakah username dan password ada di tabel admin
    $query = "SELECT * FROM admin WHERE username = '$username'
              AND password = '$password_sha1'";
    $result = mysqli_query($link,$query);

    if(mysqli_num_rows($result) == 0 )  {
      // data tidak ditemukan, buat pesan error
      $error .= "Username dan Password tidak sesuai!";
    }

      // bebaskan memory
      mysqli_free_result($result);

      // tutup koneksi dengan database MySQL
      mysqli_close($link);

    // jika lolos validasi, set session
    if ($error === "") {
      session_start();
      $_SESSION["nama"] = $username;
      header("Location: index.php");
    }
  }
  else {
    // form belum disubmit atau halaman ini tampil untuk pertama kali
    // berikan nilai awal untuk semua isian form
    $error = "";
    $username = "";
    $password = "";
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="logo.png" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Rental Mobil Kacangan</title>

    <style type="text/css">
     body{
      background-color: #e2edff;
     }
     .error {
        background: #FFECEC;
        font-size: 10pt;
        border: 1px solid red;
        border-radius: 5px;
        box-shadow: 0px 1px 8px red;
        font-family: "Courier";
        margin-bottom: 10px;
        transition: 0.25s;
        width: 70%;
        text-align: center;
     }
    </style>
  </head>
  <body>
   
    <div class="container">
    <div class="row vh-100 d-flex justify-content-center align-items-center">
      <div class="col-md-7 col-lg-5">
        <div class="card shadow-lg">
          <div class="card-body">
            <div class="text-center mb-5 mt-3">
                <img src="logo.png" alt="logo" width="70" height="50" />
                <h3 class="text-success">Rental Mobil Kacangan</h3>
                <center>
                  <div class="mt-3">
                    <?php
                    // tampilkan error jika ada
                    if ($error !== "") {
                        echo "<div class=\"error\">$error</div>";
                    }
                    ?>
                  </div>
                </center>
            </div>
              
             <form class="mb-3" action="login.php" method="post">

              <div class="mb-3">
                <label for="username">
                    <h6>&nbsp;Username</h6>
                </label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>" placeholder="Username">
              </div>

              <div class="mb-3">
                <label for="password">
                    <h6>&nbsp;Password</h6>
                </label>
                <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>" placeholder="Password">
              </div>
 
              <div class="d-grid gap-2">
              <button class="btn btn-success" id="submit" type="submit" name="submit" value="LOGIN">LOGIN</button>
              </div>

             </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  
  </body>
</html>