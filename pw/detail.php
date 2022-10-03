<?php

// session_start();

// if (!isset($_SESSION['login'])) {
//   header("Location: login.php");
//   exit;
// }


require 'functions.php';

$id = $_GET['id'];

$b = query("SELECT * FROM buku WHERE id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Buku</title>
</head>

<body>
  <h3 style="width:100%; text-align:center; padding-top: 100px;">Detail Buku</h3>
  <ul>
    <li><img src="img/<?= $b['gambar']; ?>" width="250px"></li>
    <li><?= $b['judul']; ?></li>
    <li><?= $b['deskripsi']; ?></li>
    <li><?= $b['detail']; ?></li>
    <li><a href="ubah.php?id=<?= $b['id']; ?>">Ubah</a>
      <a href="hapus.php?id=<?= $b['id']; ?>" onclick="return confirm ('apakah anda yakin hapus data?');">Hapus</a>
    </li>
    <li><a href=" index.php">Kembali Ke Daftar Mahasiswa</a>
    </li>
  </ul>
</body>

</html>