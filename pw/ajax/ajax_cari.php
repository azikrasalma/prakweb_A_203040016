<?php

require '../functions.php';
$buku = cari($_GET['keyword']);
?>
<table border="1" cellpadding="10" cellspacing="0">

  <tr>
    <th>#</th>
    <th>Gambar</th>
    <th>Nama</th>
    <th>Aksi</th>
  </tr>

  <?php if (empty($buku)) : ?>
    <tr>
      <td colspan="4">
        <p>Data buku tidak ditemukan!!</p>
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