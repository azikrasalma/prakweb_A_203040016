<?php

// session_start();

// if (!isset($_SESSION['login'])) {
//   header("Location: login.php");
//   exit;
// }

require 'functions.php';

// jika tidak ada id di url
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// ambil id dari url
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$b = query("SELECT * FROM buku WHERE id = $id");


if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
          alert('data berhasil diubah');
          document.location.href = 'index.php';
          </script>";
  } else {
    echo "data gagal diubah";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ubah Data BUku/title>
</head>

<body>
  <h3>Form ubah Data Buku</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $b['id']; ?>">
    <ul>
      <li>
        <label>
          Judul :
          <input type="text" name="judul" autofocus autocomplete="off" required value="<?= $b['judul']; ?>">
        </label>
      </li>
      <li>
        <label>
          Deskripsi :
          <input type="text" name="penulis" autofocus autocomplete="off" required value="<?= $b['penulis']; ?>">
        </label>
      </li>
      <li>
        <label>
          Detail :
          <input type="text" name="harga" autofocus autocomplete="off" required value="<?= $b['harga']; ?>">
        </label>
      </li>
      <li>
        <label>
          Detail :
          <input type="text" name="jumlah_halaman" autofocus autocomplete="off" required value="<?= $b['jumlah_halaman']; ?>">
        </label>
      </li>
      <li>
        <input type="hidden" name="tahun" value="<?= $b['tahun']; ?>">
        <label>
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
        <img src="img/<?= $b['gambar']; ?>" width="120" style="display: block;" class="img-preview">
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data!</button>
        <button><a href="index.php">Kembali</a></button>
      </li>
    </ul>

  </form>

  <script src="js/script.js"></script>
</body>

</html>