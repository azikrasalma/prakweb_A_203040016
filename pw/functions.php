<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'prakweb_A_203040016_pw');
}

function query($query)
{
  // Query isi tabel mahasiswa
  $conn = koneksi();

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}


function upload()
{
  $nama_file = $_FILES['gambar']['name'];
  $tipe_file = $_FILES['gambar']['type'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  // ketika tidak ada gambar yang di pilih
  if ($error == 4) {
    // echo "<script> 
    //           alert('pilih gambar terlebih dahulu!');
    //       </script>";
    return 'nophoto.jpg';
  }

  // cek ekstensi file
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script> 
              alert('Yang anda pilih bukan gambar!');
          </script>";
    return false;
  }

  // cek type file
  if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script> 
              alert('Yang anda pilih bukan gambar!');
          </script>";
    return false;
  }

  // cek ukuran file
  // maksimal 5mb

  if ($ukuran_file > 5000000) {
    echo "<script> 
              alert('Ukuran file terlalu besar!');
          </script>";
    return false;
  }
  // siap upload file
  // generate nama file baru
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;
  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

  return $nama_file_baru;
}

function tambah($data)
{

  $conn = koneksi();

  $judul = htmlspecialchars($data['judul']);
  $penulis = htmlspecialchars($data['penulis']);
  $harga = htmlspecialchars($data['harga']);
  $tahun = htmlspecialchars($data['tahun']);
  $jumlah_halaman = htmlspecialchars($data['jumlah_halaman']);


  // $gambar = htmlspecialchars($data['gambar']);

  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }


  $query = "INSERT INTO
            buku
            VALUES
            (null, '$judul', '$penulis', '$harga', '$tahun', '$gambar', '$jumlah_halaman);
  ";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();

  $bku = query("SELECT * FROM buku WHERE id = $id");
  if ($bku['gambar'] != 'nophoto.jpg') {
    unlink('img/' . $bku['gambar']);
  }


  mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
function ubah($data)
{

  $conn = koneksi();

  $id = $data['id'];
  $judul = htmlspecialchars($data['judul']);
  $penulis = htmlspecialchars($data['penulis']);
  $harga = htmlspecialchars($data['harga']);
  $tahun = htmlspecialchars($data['tahun']);
  $gambar_lama = htmlspecialchars($data['gambar_lama']);
  $jumlah_halaman = htmlspecialchars($data['jumlah_halaman']);

  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  if ($gambar == 'nophoto.jpg') {
    $gambar = $gambar_lama;
  }

  $query = "UPDATE buku SET 
            judul = '$judul',
            penulis = '$penulis',
            harga = '$harga',
            tahun = '$tahun',
            gambar = '$gambar'
            jumlah_halaman = '$jumlah_halaman'
            WHERE id = $id";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM buku
              WHERE judul LIKE '%$keyword%'";
  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // cek username
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    // cek password
    if (password_verify($password, $user['password'])) {
      // set session
      $_SESSION['login'] = true;

      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah!'
  ];
}

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
          alert('username / password tidak boleh kosong!');
          document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  // jika username nya sudah ada di database
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
            alert('username sudah terdaftar!');
            document.location.href = 'registrasi.php';
            </script>";
    return false;
  }

  // jika konfirmasi pass tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai!!');
            document.location.href = 'registrasi.php';
            </script>";
    return false;
  }
  // jika password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
            alert('password terlalu pendek!');
            document.location.href = 'registrasi.php';
            </script>";
    return false;
  }
  // jika username dan pass nya udah sesuai
  // enkripsi pass
  $pass_baru = password_hash($password1, PASSWORD_DEFAULT);
  // insert ke tabel user
  $query = "INSERT INTO user
            VALUES 
            (null, '$username', '$pass_baru')
            ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
