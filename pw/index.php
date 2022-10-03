<?php

// session_start();

// if (!isset($_SESSION['login'])) {
//   header("Location: login.php");
//   exit;
// }

require 'functions.php';

$buku = query("SELECT * FROM buku");

// ketika tombol cari di klik
if (isset($_POST['cari'])) {
  $buku = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">


</head>

<body style="background-color:aliceblue;">
  <header class="nav">
    <a><i>BUKU KARYA ASMA NADIA</i></a>
  </header>

  <h2 style="width:100%; padding:15px; text-align:center; padding-top: 100px;">Daftar Buku</h2>
  <button class="btn">
    <a href="tambah.php" style="color: black;">Tambah Data</a>
  </button>
  <br><br>

  <form action="" method="POST" style="text-align:center ;">
    <input type="text" name="keyword" size="30" placeholder="Masukan Keyword Pencarian" autocomplete="off" class="keyword">
    <button type="submit" name="cari" class="tombol-cari">Cari!</button>
  </form>
  <br>

  <div class="container">
    <table class="tabel" border="0.5" cellpadding="10" cellspacing="0">

      <tr>
        <th>#</th>
        <th>gambar</th>
        <th>judul</th>
        <th>penulis</th>
        <th>harga</th>
        <th>tahun</th>
        <th>jumlah halaman</th>
        <th>Selengkapnya</th>
      </tr>

      <?php if (empty($buku)) : ?>
        <tr>
          <td colspan="4">
            <p>Data mahasiswa tidak ditemukan!!</p>
          </td>
        </tr>
      <?php endif; ?>
      <?php $i = 1;
      foreach ($buku as $b) : ?>

        <tr>
          <td><?= $i++; ?></td>
          <td><img src="gambar/<?= $b['gambar']; ?>" width="60"></td>
          <td><?= $b['judul_buku']; ?></td>
          <td><?= $b['penulis_buku']; ?></td>
          <td><?= $b['harga_buku']; ?></td>
          <td><?= $b['tahun_terbit']; ?></td>
          <td><?= $b['jumlah_halaman']; ?></td>
          <td><button style="background-color:aqua ; border:0.5px     solid black;">
              <a style="color:black ;" href="ubah.php?id=<?= $b['id']; ?>">Ubah</a>
            </button>
            <button style="background-color:red; border:0.5px solid black;">
              <a style="color:white;" href="hapus.php?id=<?= $b['id']; ?>" onclick="return confirm ('apakah anda yakin hapus data?');">Hapus</a>
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <script src="js/script.js"></script>
</body>

</html>