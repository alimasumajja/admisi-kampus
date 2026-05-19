<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

$pendaftaran_id   = $_POST['pendaftaran_id'];
$nama_pengirim    = $_POST['nama_pengirim'];
$tanggal_transfer = $_POST['tanggal_transfer'];

// Folder upload
$folder = __DIR__ . '/../uploads/pembayaran/';

// Buat folder jika belum ada
if(!is_dir($folder)){
    mkdir($folder, 0777, true);
}

// Upload file
$nama_file = $_FILES['bukti_pembayaran']['name'];
$tmp_file  = $_FILES['bukti_pembayaran']['tmp_name'];

// Rename file
$file_baru = time() . "_" . $nama_file;

// Pindahkan file
move_uploaded_file(
    $tmp_file,
    $folder . $file_baru
);

// Simpan ke database
$query = mysqli_query($koneksi,"
    INSERT INTO pembayaran(

        pendaftaran_id,
        nama_pengirim,
        tanggal_transfer,
        bukti_pembayaran,
        status_pembayaran

    ) VALUES(

        '$pendaftaran_id',
        '$nama_pengirim',
        '$tanggal_transfer',
        '$file_baru',
        'Pending'

    )
");

// Redirect
if($query){

    header("Location: ../mahasiswa/pembayaran.php?pesan=sukses");

}else{

    header("Location: ../mahasiswa/pembayaran.php?pesan=gagal");

}
?>