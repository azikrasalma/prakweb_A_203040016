<?php

// session_start();

// if (!isset($_SESSION['login'])) {
//   header("Location: login.php");
//   exit;
// }

require 'functions.php';


if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
          alert('data berhasil ditambahkan');
          document.location.href = 'index.php';
          </script>";
  } else {
    echo "data gagal ditambahkan";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Buku</title>
</head>

<body>
  <h3>Form Tambah Data Buku</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <ul>
      <li>
        <label>
          Judul :
          <input type="text" name="judul" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          Deskripsi :
          <input type="text" name="penulis" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          Detail :
          <input type="text" name="harga" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        </li>
      <li>
        <label>
          Detail :
          <input type="text" name="tahun" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          Detail :
          <input type="text" name="jumlah_halaman" autofocus autocomplete="off" required>
        </label>
      </li>


      <li>
        <label>
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
        <img src="img/nophoto.jpg" width="120" style="display: block;" class="img-preview">
      </li>
      <li>
        <button type="submit" name="tambah">Tambah Data!</button>
        <button><a href="index.php" style="color: black;">Kembali</a></button>
      </li>
    </ul>

  </form>

  <script src="js/script.js"></script>

</body>

</html>